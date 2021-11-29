<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Game.php");
include_once("../../../classes/Spelling.php");
include_once("../../../classes/Constants.php");

$spell = new Spelling();
if (isset($_POST['picked_word_0'])) {
    $pickedWords = array($_POST['picked_word_0'], $_POST['picked_word_1'], $_POST['picked_word_2'], $_POST['picked_word_3'], $_POST['picked_word_4']);
    $spell->matchSelectedWords($pickedWords,$_POST['time_left']);    
} else {
    header("Location: spell_index.php");
    die;
}

