<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Game.php");
include_once("../../../classes/Memory.php");

$game = new Memory();
$game->matchSelectedCards();
