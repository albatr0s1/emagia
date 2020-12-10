<?php

namespace Emag\Fighter;

use Emag\Config\FighterConfig;
use Emag\Events\Events;
use Emag\Helpers;
use Emag\Skills\Skill;
use PHPUnit\Exception;
use function PHPUnit\Framework\throwException;

/**
 * Class Fighter
 * @package Emag\Fighter
 */
class Fighter
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $health;
    /**
     * @var
     */
    protected $strength;
    /**
     * @var
     */
    protected $defence;
    /**
     * @var
     */
    protected $speed;
    /**
     * @var
     */
    protected $luck;
    /**
     * @var
     */
    protected $strikes;
    /**
     * @var
     */
    protected $striker;
    /**
     * @var
     */
    protected $hasSkills;
    /**
     * @var array
     */
    protected $skills = [];
    /**
     * @var
     */
    protected $hasEvents;
    /**
     * @var array
     */
    protected $events = [];

    /**
     * Fighter constructor.
     * @param $fighterConfig
     */
    public function __construct($fighterConfig)
    {
        $this->generateProps($fighterConfig);
    }

    /**
     * @param $fighterConfig
     */
    public function generateProps($fighterConfig)
    {
        $this->strikes = FighterConfig::STRIKES;
        $this->name = $fighterConfig['name'];
        $this->hasSkills = $fighterConfig['hasSkills'];
        $this->hasEvents = $fighterConfig['hasEvents'];
        foreach (FighterConfig::$props as $prop) {
            $this->$prop = rand($fighterConfig['props'][$prop]['min'], $fighterConfig['props'][$prop]['max']);
        }
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param $defence
     */
    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    /**
     * @return mixed
     */
    public function getHasEvents()
    {
        return $this->hasEvents;
    }

    /**
     * @param $hasEvents
     */
    public function setHasEvents($hasEvents)
    {
        $this->hasEvents = $hasEvents;
    }

    /**
     * @return mixed
     */
    public function getStrikes()
    {
        return $this->strikes;
    }

    /**
     * @param $strikes
     */
    public function setStrikes($strikes)
    {
        $this->strikes = $strikes;
    }

    /**
     * @return mixed
     */
    public function getHasSkills()
    {
        return $this->hasSkills;
    }

    /**
     * @param $hasSkills
     */
    public function setHasSkills($hasSkills)
    {
        $this->hasSkills = $hasSkills;
    }

    /**
     *
     */
    public function activateSkills()
    {
        foreach (Skill::getRegisteredSkills() as $skill) {
            try {
                $skillClassName = '\Emag\Skills\\' . $skill;
                $skillObj = new $skillClassName($skillClassName);
            } catch (Exception $exception) {
                throwException($exception);
            }
            // verify chance & fighter round (attack/defense)
            if (isset($skillObj) && rand(1, 100) < $skillObj::CHANCE && ($skillObj->getRound() == $this->getStriker())) {
                array_push($this->skills, $skillClassName);
            }

        }
    }

    /**
     * @return mixed
     */
    public function getStriker()
    {
        return $this->striker;
    }

    /**
     * @param $striker
     */
    public function setStriker($striker)
    {
        $this->striker = $striker;
    }

    /**
     * @param Fighter $defender
     */
    public function strike(Fighter $defender)
    {
        // execute the number of strikes of the fighter for the current round
        $totalDamage = 0;
        $defaultDamage = $this->strength - $defender->defence;
        for ($i = 0; $i < $this->strikes; $i++) {
            if (isset($previousActivatedSkill)) {
                $this->consumeSkill($previousActivatedSkill);
            }
            Helpers::strikes($this->getName(), $defender->getName());
            if ($this->hasSkills && count($this->getSkills())) {
                foreach ($this->getSkills() as $skillClassName) {
                    $skill = new $skillClassName($skillClassName);
                    $damage = $defender->defend($skill->activate($this));
                    $totalDamage += $damage;
                    $defender->health -= $damage;
                    Helpers::activatedSkill($this->name, $skill->getName());
                    $previousActivatedSkill = $skillClassName;
                }
            } else {
                $damage = $defender->defend($this->strength);
                $totalDamage += $damage;
                $defender->health -= $damage;
            }
        }
        Helpers::inflictedDamage($totalDamage);
        Helpers::remainingHealth($this->name, $this->health);
        Helpers::remainingHealth($defender->name, $defender->health);
        if ($defender->health <= 0) {
            Helpers::gameOver($this->name);
        }
    }

    /**
     * @param $skillClassName
     */
    public function consumeSkill($skillClassName)
    {
        if (($key = array_search($skillClassName, $this->skills)) !== false) {
            $skills = array_diff($this->skills, array($skillClassName));
            $this->setSkills($skills);
        }
        (new $skillClassName($skillClassName))->deactivate($this);
    }

    /**
     * @return mixed
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
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @param $strength
     * @return mixed
     */
    public function defend($strength)
    {
        // execute the number of strikes of the fighter for the current round
        $damage = $strength - $this->defence;
        if ($this->hasSkills && count($this->getSkills())) {
            foreach ($this->getSkills() as $skillClassName) {
                $skill = new $skillClassName($skillClassName);
                $damage = $skill->activate($damage);
                Helpers::activatedSkill($this->name, $skill->getName());
//                    Helpers::actualDamage($skill->getName(), $defaultDamage, $damage);
                $this->consumeSkill($skillClassName);
            }
        }
        // watch for strike events that modify damage based on a prop. initiate first event
        if ($this->hasEvents && count($this->getEvents())) {
            foreach ($this->getEvents() as $eventClassName) {
                $event = new $eventClassName($eventClassName);
                if ($event->getAction() == FighterConfig::DAMAGE_EVENT) {
                    $damage = $event->initiate($this->{$event->getProp()}, $damage);
                    echo $event->getEffect() . PHP_EOL;
                    break;
                }
            }
        }
        return $damage;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     *
     */
    public function activateEvents()
    {
        foreach (Events::getRegisteredEvents() as $event) {
            try {
                $eventClassName = '\Emag\Events\\' . $event;
                $eventObj = new $eventClassName($eventClassName);
            } catch (Exception $exception) {
                throwException($exception);
            }
            // verify chance & fighter round (attack/defense)
            if ($eventObj->check($this->{$eventObj->prop})) {
                array_push($this->events, $eventClassName);
            }
        }
    }

    /**
     * @return string
     */
    public function getPlayerStats()
    {
        $stats = '';
        foreach (FighterConfig::$props as $prop) {
            $stats .= $prop . ' : ' . $this->$prop . PHP_EOL;
        }
        return $stats;
    }
}