<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "mini_gamebox";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
	}
	header("Location: signin.php");
	die;
}
