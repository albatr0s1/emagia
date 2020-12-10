<?php

namespace Emag;

use Emag\Config\FighterConfig;
use Emag\Fighter\Fighter;


/**
 * Class Emagia
 * @package Emag
 */
class Emagia
{
    /**
     * @var Fighter
     */
    public $playerOne;
    /**
     * @var Fighter
     */
    public $playerTwo;

    /**
     * Emagia constructor.
     */
    public function __construct()
    {
        $this->playerOne = new Fighter(FighterConfig::$orderus);
        $this->playerTwo = new Fighter(FighterConfig::$beast);
    }

    /**
     *
     */
    public function start()
    {
        Helpers::startGame($this->playerOne, $this->playerTwo);
        // decide who strikes first
        $this->setFirstStriker();
        for ($round = 1; $round <= FighterConfig::ROUNDS; $round++) {
            Helpers::roundMoment($round, 1);
            $this->checkSkillChances();
            $this->checkEvents();
            $this->battle();
            Helpers::roundMoment($round, 0);
            $this->restartEvents();
            $this->nextRound();
        }
        if ($this->playerOne->getHealth() > $this->playerTwo->getHealth()) {
            Helpers::gameOver($this->playerOne->getName());
        } elseif ($this->playerTwo->getHealth() > $this->playerOne->getHealth()) {
            Helpers::gameOver($this->playerTwo->getName());
        } else {
            Helpers::draw();
        }
    }

    /**
     *
     */
    public function setFirstStriker()
    {
        if ($this->playerOne->getSpeed() == $this->playerTwo->getSpeed()) {
            if ($this->playerOne->getLuck() > $this->playerTwo->getLuck()) {
                $this->playerOne->setStriker(1);
                Helpers::announceFirstStriker($this->playerOne->getName());
            } else {
                $this->playerTwo->setStriker(1);
                Helpers::announceFirstStriker($this->playerTwo->getName());
            }
        } else {
            if ($this->playerOne->getSpeed() > $this->playerTwo->getSpeed()) {
                $this->playerOne->setStriker(1);
                Helpers::announceFirstStriker($this->playerOne->getName());
            } else {
                $this->playerTwo->setStriker(1);
                Helpers::announceFirstStriker($this->playerTwo->getName());
            }

        }
    }

    /**
     *
     */
    public function checkSkillChances()
    {
        if ($this->playerOne->getHasSkills()) {
            $this->playerOne->setSkills([]);
            $this->playerOne->activateSkills();
        }
        if ($this->playerTwo->getHasSkills()) {
            $this->playerOne->setSkills([]);
            $this->playerTwo->activateSkills();
        }
    }

    /**
     *
     */
    public function checkEvents()
    {
        $this->playerOne->activateEvents();
        $this->playerTwo->activateEvents();
    }

    /**
     *
     */
    public function battle()
    {
        if ($this->playerOne->getStriker()) {
            $this->playerOne->strike($this->playerTwo);
        } else {
            $this->playerTwo->strike($this->playerOne);
        }
    }

    /**
     *
     */
    public function restartEvents()
    {
        $this->playerOne->setEvents([]);
        $this->playerTwo->setEvents([]);
    }

    /**
     *
     */
    public function nextRound()
    {
        $this->playerOne->setStriker(!$this->playerOne->getStriker());
        $this->playerTwo->setStriker(!$this->playerTwo->getStriker());
    }
}