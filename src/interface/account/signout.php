<?php
session_start();

$_SESSION = array();
session_destroy();

header("Location: ../games/main_index.php");
die;