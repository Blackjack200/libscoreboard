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
new ScoreTag('line 1'),
new ScoreTag('line 2'),
new ScoreTag('line 3'),
new ScoreTag('line 4'),
new ScoreTag('line 5'),
]);

$scoreboard = new Scoreboard($template);
LibScoreboard::register($scoreboard);

/** @var Player $player */
$scoreboard->register($player);

$data = $scoreboard->getData($player);

$data->updateTag(0, 'idk');

$data->whenTick(static function () use($data) {
    $data->updateTag(0,random_int(1,16));
});
```