<?php

namespace Emag\Fighter;
/**
 * Interface FighterInterface
 * @package Emag\Fighter
 */
Interface FighterInterface
{
    /**
     * @param Fighter $fighter
     * @return mixed
     */
    public function strike(Fighter $fighter);
}