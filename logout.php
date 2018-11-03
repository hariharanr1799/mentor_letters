<?php

require 'core.inc.php';

$loc = "index.php";

if($_SESSION['ac'] == 'A') {
	$loc = "mentorlogin.php";
}

session_destroy();

header('Location: '.$loc);

?>