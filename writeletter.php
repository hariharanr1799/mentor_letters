<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['query']) && isset($_POST['description'])) {

	$question = $_POST['query'];
	$description = $_POST['description'];
	$askedby = $_SESSION['username'];
	$date = date("Y-m-d");

	if(!empty($question) && !empty($description) && !empty($askedby) && !empty($date)){

		if(strlen($question) <= 1000 && strlen($description) <= 1000 && strlen($askedby) <= 30) {

			$query = $conn->prepare("INSERT INTO LETTERS VALUES('', '$question', '$description', '$askedby', '$date')");
			$query->execute();

			header('Location: index.php');

		}
	}
}

?>