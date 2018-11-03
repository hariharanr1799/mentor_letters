<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['qid']) && isset($_POST['reply'])) {

	$questionid = $_POST['qid'];
	$answer = $_POST['reply'];
	$mentor = $_SESSION['username'];

	if(!empty($questionid) && !empty($answer) && !empty($mentor)){

		if(strlen($answer) <= 5000 && strlen($mentor) <= 30) {

			$query = $conn->prepare("INSERT INTO REPLIES VALUES('', '$answer', '$mentor', '$questionid')");
			$query->execute();

			header('Location: index.php');

		}
	}
}

?>