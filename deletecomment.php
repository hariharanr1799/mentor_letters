<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['rid']) and !empty($_POST['rid'])) {

	$id = $_POST['rid'];

	$query = $conn->prepare("DELETE FROM REPLIES WHERE ID = $id");
	$query->execute();

	header('Location: index.php');

}

?>