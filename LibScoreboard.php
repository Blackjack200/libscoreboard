<?php


namespace libscoreboard;


use pocketmine\plugin\Plugin;
use pocketmine\scheduler\Task;

final class LibScoreboard {
	private static ?Task $scoreBoardTask = null;
	/** @var Scoreboard[] */
	private static array $scoreboards = [];

	public static function setup(Plugin $plugin) : void {
		if (self::$scoreBoardTask !== null) {
			return;
		}
		self::$scoreBoardTask = new ScoreboardUpdateTask();
		$plugin->getScheduler()->scheduleRepeatingTask(self::$scoreBoardTask, 20);
	}

	public static function register(Scoreboard $scoreboard) : void {
		self::$scoreboards[spl_object_hash($scoreboard)] = $scoreboard;
	}

	public static function unregister(Scoreboard $scoreboard) : void {
		unset(self::$scoreboards[spl_object_hash($scoreboard)]);
	}

	public static function getScoreboards() : array {
		return self::$scoreboards;
	}
}