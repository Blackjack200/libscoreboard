<?php


namespace libscoreboard;


use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\Player;

class Scoreboard {
	/** @var Player[] */
	protected array $players;
	/** @var ScoreBoardData[] */
	protected array $tags = [];
	protected ScoreBoardData $template;

	public function __construct(ScoreBoardData $template) {
		$this->template = $template;
	}

	public function register(Player $player) : bool {
		$hash = spl_object_hash($player);
		if (isset($this->players[$hash])) {
			return false;
		}
		$this->players[$hash] = $player;
		$this->tags[$hash] = clone $this->template;
		return true;
	}

	public function unregister(Player $player) : void {
		//seems prevent memory leak
		$this->tags[spl_object_hash($player)]->setTags([]);
		unset($this->players[spl_object_hash($player)], $this->tags[spl_object_hash($player)]);
	}

	public function tick() : void {
		foreach ($this->players as $player) {
			$this->display($player);
		}
	}

	public function display(Player $player) : void {
		$data = $this->getData($player);
		$data->onTick();
		if ($data->titleNeedUpdate()) {
			$pk = new SetDisplayObjectivePacket();
			$pk->displaySlot = 'sidebar';
			$pk->objectiveName = 'objective';
			$pk->displayName = $data->getTitle();
			$pk->criteriaName = 'dummy';
			$pk->sortOrder = 0;
			$player->sendDataPacket($pk);
		}
		if ($data->contentNeedUpdate()) {
			$pk = new RemoveObjectivePacket();
			$pk->objectiveName = 'objective';
			$player->sendDataPacket($pk);
			$pk = new SetScorePacket();
			$pk->type = $pk::TYPE_CHANGE;
			$pk->entries = array_map(static function (ScoreTag $tag) : string {
				return $tag->get();
			}, $data->getTags());
			$player->sendDataPacket($pk);
		}
		$data->resetUpdate();
	}

	public function getData(Player $player) : ScoreBoardData {
		return $this->tags[spl_object_hash($player)];
	}

	/**
	 * @param ScoreTag[] $tags
	 */
	public function setTags(Player $player, array $tags) : void {
		$this->tags[spl_object_hash($player)] = $tags;
	}

	public function getPlayers() : array {
		return $this->players;
	}
}