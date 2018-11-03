<?php 

require 'core.inc.php';
require 'sqlconnect.php';

// if(isset($_POST['uname']) && !empty($_POST['uname'])) {

	// $username = $_POST['uname'];
	
	// $query = $conn->prepare("SELECT EMAIL FROM USERACCOUNTS WHERE USERNAME = '$username'");
	// $query->execute();

	// if($query->rowCount()==0) {
		// $forgotfound = false;
	// }
	
	// else {

		// $result = $query->fetch(PDO::FETCH_ASSOC);
		// $emailto = $result['EMAIL'];

		ini_set('SMTP','127.0.0.1');
		// ini_set('smtp_port',25);

		$emailto = "hariharanr1799@gmail.com";
		$subject = "Link to Reset Password";
		$txt = "Hello world!";
		$headers = "From: donotreply@mentorletters.com";

		mail($emailto,$subject,$txt,$headers);

		// header('Location: index.php');
	// }
// }

?>