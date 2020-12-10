<?php


namespace Emag\Skills;


use Emag\Config\FighterConfig;

/**
 * Class RapidStrike
 * @package Emag\Skills
 */
class RapidStrike extends Skill implements SkillInterface
{
    /**
     *
     */
    const CHANCE = 10;
    /**
     * @var string
     */
    protected $name = __CLASS__;
    /**
     * @var string
     */
    protected $effect = "Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks";
    /**
     * @var int
     */
    protected $round = FighterConfig::ATTACK_SKILL;

    /**
     * @param $fighter
     * @return mixed
     */
    public function activate($fighter)
    {
        $strikes = $fighter->getStrikes() + 1;
        $fighter->setStrikes($strikes);
        return $fighter->getStrength();
    }

    /**
     * @param $player
     */
    public function deactivate($player)
    {
        $player->setStrikes(FighterConfig::STRIKES);
    }
}