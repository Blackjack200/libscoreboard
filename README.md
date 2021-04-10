# libscoreboard

```php
use libscoreboard\LibScoreboard;
use libscoreboard\Scoreboard;
use libscoreboard\ScoreBoardData;
use libscoreboard\ScoreTag;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;


/** @var PluginBase $plugin */
LibScoreboard::setup($plugin);

$template = new ScoreBoardData([],'TEST');
$template->setTags([
new ScoreTag('line 1',$template),
new ScoreTag('line 2',$template),
new ScoreTag('line 3',$template),
new ScoreTag('line 4',$template),
new ScoreTag('line 5',$template),
]);

$scoreboard = new Scoreboard($template);
LibScoreboard::register($scoreboard);

/** @var Player $player */
$scoreboard->register($player);

```impl