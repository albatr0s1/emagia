<?php

namespace Emag\Skills;

use Emag\Config\FighterConfig;
use Emag\Helpers;

/**
 * Class Skill
 * @package Emag\Skills
 */
class Skill
{
    /**
     * @var
     */
    protected $round;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var
     */
    protected $effect;

    /**
     * Skill constructor.
     * @param $skillClassName
     */
    public function __construct($skillClassName)
    {
        $this->name = Helpers::getClassBasename($skillClassName);
    }

    /**
     * @return array
     */
    public static function getRegisteredSkills()
    {
        return FighterConfig::REGISTERED_SKILLS;
    }

    /**
     * @return mixed
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @param $round
     */
    public function setRound($round)
    {
        $this->round = $round;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * @param $effect
     */
    public function setEffect($effect)
    {
        $this->name = $effect;
    }

}
