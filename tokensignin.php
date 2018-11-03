<?php 

require 'core.inc.php';
require 'sqlconnect.php';

$email = $_POST['email'];
$username = explode("@",$email)[0];

$query = $conn->prepare("SELECT * FROM USERACCOUNTS WHERE USERNAME = '$username' AND ACCTYPE = 'A'");
$query->execute();

if($query->rowCount()==0) {
    $query = $conn->prepare("INSERT INTO USERACCOUNTS VALUES('', '', '$email', '$username', 'aero@KGP', 'A')");
    $query->execute();
}
        
$query = $conn->prepare("SELECT ID, USERNAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND ACCTYPE = 'A'");
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
	
$_SESSION['user_id'] = $result['ID'];
$_SESSION['username'] = $result['USERNAME'];
$_SESSION['ac'] = $result['ACCTYPE'];

echo "success";

?>