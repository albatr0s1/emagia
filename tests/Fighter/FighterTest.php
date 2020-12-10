<?php

namespace Emag\Tests;

use Emag\Config\FighterConfig;
use Emag\Emagia;
use Emag\Fighter\Fighter;
use PHPUnit\Framework\TestCase;


class FighterTest extends TestCase
{

    public function testActivateEventsNullInstantiation()
    {
        $fighter = new Fighter(FighterConfig::$orderus);
        $this->assertEquals([], $fighter->getEvents());
    }
    public function testActivateEventsPopulation()
    {
        $fighter = new Fighter(FighterConfig::$orderus);
        // set luck to 100
        $fighter->setLuck(100);
        $fighter->activateEvents();
        $this->assertNotEmpty($fighter->getEvents());
    }


    public function testConsumeSkillAfterRound()
    {
        $fighter1 = new Fighter(FighterConfig::$orderus);
        $fighter1->setLuck(100); // luck 100 to be positive about getting the GetLucky event
        $fighter1->activateEvents();
        $fighter2 = new Fighter(FighterConfig::$orderus);
        $fighter2->setLuck(100);
        $fighter2->activateEvents();
        $emagia = new Emagia();
        $emagia->playerOne = $fighter1;
        $emagia->playerTwo = $fighter2;
        $emagia->restartEvents();
        $this->assertEmpty($emagia->playerOne->getEvents());
        $this->assertEmpty($emagia->playerTwo->getEvents());
    }

    public function test__construct()
    {
        $orderusConfig = FighterConfig::$orderus;
        $this->assertInstanceOf(
            Fighter::class,
            (new Fighter($orderusConfig))
        );
    }
}
