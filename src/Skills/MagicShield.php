<?php

namespace Emag\Skills;

use Emag\Config\FighterConfig;

/**
 * Class MagicShield
 * @package Emag\Skills
 */
class MagicShield extends Skill implements SkillInterface
{
    /**
     *
     */
    const CHANCE = 20;
    /**
     * @var string
     */
    protected $name = __CLASS__;
    /**
     * @var string
     */
    protected $effect = "Takes only half of the usual damage when an enemy attacks; there’s a 20% chance he’ll use this skill every time he defends";
    /**
     * @var int
     */
    protected $round = FighterConfig::DEFENSE_SKILL;

    /**
     * @param $strength
     * @return float|int
     */
    public function activate($strength)
    {
        return $strength / 2;
    }

    /**
     * @param $player
     */
    public function deactivate($player)
    {
    }
}
