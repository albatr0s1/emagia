<?php

namespace Emag\Skills;

/**
 * Interface SkillInterface
 * @package Emag\Skills
 */
interface SkillInterface
{
    /**
     * @param $player
     * @return mixed
     */
    public function activate($player);

    /**
     * @param $player
     * @return mixed
     */
    public function deactivate($player);
}