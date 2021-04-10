<?php


namespace libscoreboard;


use pocketmine\scheduler\Task;

class ScoreboardUpdateTask extends Task {
	public function onRun(int $currentTick) : void {
		foreach (LibScoreboard::getScoreboards() as $scoreboard) {
			$scoreboard->tick();
		}
	}
}