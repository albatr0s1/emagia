<?php

namespace Emag\Events;

use Emag\Config\FighterConfig;

/**
 * Class GetLucky
 * @package Emag\Events
 */
class GetLucky extends Events implements EventInterface
{
    /**
     * @var mixed|string
     */
    public $prop = '';
    /**
     * @var string
     */
    protected $effect = "The attacker missed the turn. The enemy got lucky.";
    /**
     * @var int
     */
    protected $action = FighterConfig::DAMAGE_EVENT;
    /**
     * @var string
     */
    protected $name = __CLASS__;

    /**
     * GetLucky constructor.
     * @param $eventClassName
     */
    public function __construct($eventClassName)
    {
        $this->prop = FighterConfig::$props[FighterConfig::LUCK];
        parent::__construct($eventClassName);
    }

    /**
     * @param $damage
     * @return int
     */
    public function initiate($damage)
    {
        return 0;
    }

    /**
     * @param $luck
     * @return bool
     */
    public function check($luck)
    {
        if ($luck >= $threshold = rand(0, 100)) {
            return true;
        }
        return false;
    }
}