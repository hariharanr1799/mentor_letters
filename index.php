<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(loggedin() && $_SESSION['ac'] == 'A') {
	include 'mentorindex.php';
}

else if(loggedin() && $_SESSION['ac'] == 'S') {
	include 'menteeindex.php';
}

else {
	include 'login.php';
}	

?>