<?php

namespace Emag\Config;

/**
 * Class FighterConfig
 * @package Emag\Config
 */
class FighterConfig
{
    /**
     *
     */
    const ROUNDS = 20;
    /**
     *
     */
    const STRIKES = 1;
    /**
     *
     */
    const ORDERUS = 'Orderus';
    /**
     *
     */
    const BEAST = 'Celro Beast';
    /**
     *
     */
    const REGISTERED_SKILLS = ['MagicShield', 'RapidStrike'];
    /**
     *
     */
    const REGISTERED_EVENTS = ['GetLucky'];
    /**
     *
     */
    const HEALTH = 0;
    /**
     *
     */
    const STRENGTH = 1;
    /**
     *
     */
    const DEFENCE = 2;
    /**
     *
     */
    const SPEED = 3;
    /**
     *
     */
    const LUCK = 4;
    /**
     *
     */
    const ATTACK_SKILL = 1;
    /**
     *
     */
    const DEFENSE_SKILL = 0;
    /**
     *
     */
    const DAMAGE_EVENT = 1;
    /**
     *
     */
    const HEALTH_EVENT = 0;
    /**
     * @var array
     */
    public static $props = [self::HEALTH => 'health', self::STRENGTH => 'strength', self::DEFENCE => 'defence',
        self::SPEED => 'speed', self::LUCK => 'luck'];
    /**
     * @var array
     */
    public static $orderus = [
        'name' => self::ORDERUS,
        'hasSkills' => 1,
        'hasEvents' => 1,
        'props' => [
            'health' => [
                'min' => 70,
                'max' => 100,
            ],
            'strength' => [
                'min' => 70,
                'max' => 80,
            ],
            'defence' => [
                'min' => 45,
                'max' => 55,
            ],
            'speed' => [
                'min' => 40,
                'max' => 50,
            ],
            'luck' => [
                'min' => 10,
                'max' => 30,
            ],
        ]
    ];
    /**
     * @var array
     */
    public static $beast = [
        'name' => self::BEAST,
        'hasSkills' => 0,
        'hasEvents' => 1,
        'props' => [
            'health' => [
                'min' => 60,
                'max' => 90,
            ],
            'strength' => [
                'min' => 60,
                'max' => 90,
            ],
            'defence' => [
                'min' => 40,
                'max' => 60,
            ],
            'speed' => [
                'min' => 40,
                'max' => 60,
            ],
            'luck' => [
                'min' => 25,
                'max' => 40,
            ],
        ]
    ];
    /**
     *
     */
    const RESET_SCORE_ARG = '-rs';
}
