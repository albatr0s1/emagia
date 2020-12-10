<?php

namespace Emag\Events;

use Emag\Config\FighterConfig;
use Emag\Helpers;

// Alterate damage/defence based on entity props

/**
 * Class Events
 * @package Emag\Events
 */
class Events
{
    /**
     * @var
     */
    public $prop;
    /**
     * @var
     */
    protected $effect;
    /**
     * @var
     */
    protected $action;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var
     */
    protected $description;

    /**
     * Events constructor.
     * @param $eventClassName
     */
    public function __construct($eventClassName)
    {
        $this->name = Helpers::getClassBasename($eventClassName);
    }

    /**
     * @return array
     */
    public static function getRegisteredEvents()
    {
        return FighterConfig::REGISTERED_EVENTS;
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
        $this->effect = $effect;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action;
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
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @param $prop
     */
    public function setProp($prop)
    {
        $this->prop = $prop;
    }

}