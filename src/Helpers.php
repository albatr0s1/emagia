<?php


namespace Emag;


use Emag\Config\FighterConfig;
use Emag\Fighter\Fighter;
/*
 *
 */

/**
 * Class Helpers
 * @package Emag
 */
class Helpers
{
    /**
     * @param Fighter $playerOne
     * @param Fighter $playerTwo
     */
    public static function startGame(Fighter $playerOne, Fighter $playerTwo)
    {
        $announcement = "Game started." . PHP_EOL . '--- ' . $playerOne->getName() . ' Stats ---' . PHP_EOL;
        $announcement .= $playerOne->getPlayerStats() . PHP_EOL;
        $announcement .= '--- ' . $playerTwo->getName() . ' Stats ---' . PHP_EOL;
        $announcement .= $playerTwo->getPlayerStats() . PHP_EOL;
        echo $announcement;
    }

    /**
     * @param $className
     * @return string
     */
    public static function getClassBasename($className)
    {
        $className = basename(str_replace('\\', '/', $className));
        return $className;
    }

    /**
     * @param $name
     */
    public static function announceFirstStriker($name)
    {
        echo "The first striker is " . $name . PHP_EOL;
    }

    /**
     * @param $attacker
     * @param $defender
     */
    public static function strikes($attacker, $defender)
    {
        echo $attacker . ' strikes ' . $defender . PHP_EOL;
    }

    /**
     * @param $round
     * @param int $start
     */
    public static function roundMoment($round, $start = 1)
    {
        echo 'The #' . $round . ' round has ' . ($start ? 'started' : 'finished' . PHP_EOL . self::separator()) . PHP_EOL;
    }

    /**
     * @return string
     */
    public static function separator()
    {
        $separator = '';
        for ($i = 0; $i < 40; $i++) {
            $separator .= '-';
        }
        return $separator;
    }

    /**
     * @param $playerName
     * @param $skillName
     */
    public static function activatedSkill($playerName, $skillName)
    {
        echo 'The ' . $skillName . ' Skill was activated for ' . $playerName . PHP_EOL;
    }

    /**
     * @param $skillName
     * @param $strength
     * @param $damage
     */
    public static function actualDamage($skillName, $strength, $damage)
    {
        echo "Due to " . $skillName . ' activation, the total damage is ' . $damage . ' instead of ' . $strength . PHP_EOL;
    }

    /**
     * @param $damage
     */
    public static function Damage($damage)
    {
        echo 'Inflicted damage: ' . $damage . PHP_EOL;
    }

    /**
     * @param $name
     * @param $health
     */
    public static function remainingHealth($name, $health)
    {
        echo $name . '\'s health: ' . $health . PHP_EOL;
    }

    /**
     * @param $damage
     */
    public static function inflictedDamage($damage)
    {
        echo "Total Inflicted Damage: " . $damage . PHP_EOL;
    }

    /**
     * @param $winner
     */
    public static function gameOver($winner)
    {
        echo 'GAME OVER' . PHP_EOL . 'The winner is ' . $winner;
        Helpers::keepScore($winner);
        exit();
    }

    /**
     *
     */
    public static function draw()
    {
        echo "DRAW.";
        exit();
    }

    /**
     * @param $winner
     */
    public static function keepScore($winner) {
        $score = file_get_contents(__DIR__."/score.json");
        $score = json_decode($score, true);
        if($winner == FighterConfig::ORDERUS) {
            $score['orderus']++;
        } else {
            $score['beast']++;
        }
        file_put_contents(__DIR__.'/score.json', json_encode($score));
        echo PHP_EOL.Helpers::separator().PHP_EOL."Score: ".
            PHP_EOL."Orderus: ".$score['orderus'].
            PHP_EOL."Beast: ".$score['beast'].PHP_EOL;
    }

    /**
     *
     */
    public static function resetScore() {
        $score = file_get_contents(__DIR__."/score.json");
        $score = json_decode($score, true);
        $score['orderus'] = 0;
        $score['beast'] = 0;
        file_put_contents(__DIR__.'/score.json', json_encode($score));
        echo PHP_EOL.'Score reset.'.PHP_EOL;
    }
}