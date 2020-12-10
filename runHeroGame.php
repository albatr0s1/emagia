<?php

use Emag\Config\FighterConfig;
use Emag\Emagia;
use Emag\Helpers;

require dirname(__FILE__) . '/vendor/autoload.php';

// create Emagia
$emagia = new Emagia();
for ($i=0; $i < $argc; $i++) {
    if($argv[$i] == FighterConfig::RESET_SCORE_ARG) {
        print_r($argv[$i]);
        Helpers::resetScore();
    }
}
$emagia->start();
