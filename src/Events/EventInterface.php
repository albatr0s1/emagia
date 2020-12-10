<?php

namespace Emag\Events;

/**
 * Interface EventInterface
 * @package Emag\Events
 */
interface EventInterface
{
    /**
     * @param $action
     * @return mixed
     */
    public function initiate($action);

    /**
     * @param $prop
     * @return mixed
     */
    public function check($prop);
}