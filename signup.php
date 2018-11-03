<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(loggedin()) header('Location: index.php');

?>

<!DOCTYPE html>

<html>

<head>

	<?php include 'head.php'; ?>

	<style type="text/css">
		body {
			overflow-x: hidden;
			background-image: url('static/img/bg.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			color: white;
		}

		.logoimg {
			width: 24%;
			position: relative;
			left: 38%;
			top: 40px;
		}

		.box {
			height: 680px;
			background: #343a40;
			margin: auto;
			border-radius: 0.7rem;
			border: 2px solid rgb(39,48,65);
			margin-top: 3vh;
			margin-bottom: 3vh;
		}

		.textbox {
			width: 100%;
			position: relative;
			margin: auto;
			outline: none;
			border: none;
			border-bottom: 1.1px solid rgb(2,81,160);
			padding: .2em 0.4rem;
			background: transparent;
			animation: none;
			color: rgb(60,150,255);
		}

		.textbox:focus {
			animation: textan 0.5s;
			border-bottom: 1.2px solid #007bff;
		}

		form {
			width: 84%;
			position: relative;
			margin: auto;
		}

		.btn {
			border-radius: 20px;
			width: 96px;
			height: 44px;
			margin: auto;
			border: none;
			color: #343a40;
		}

		a:hover {
			color: #0069d9;
		}

		.errormsg {
			color: red;
			font-size: 0.8em;
			text-align: right;
		}

		@keyframes textan {
			from {width: 0}
			to {width: max-width}
		}

		@media (min-width: 440px) {
			.container {
				max-width: 450px;
			}
		}

		@media (min-width: 768px) {
			.container {
				max-width: 860px;
			}	
		}

		@media (min-width: 992px) {
			.container {
				max-width: 1050px;
			}	
		}

	</style>

</head>

<body>

	<div class="container">
		<div class="col-md-6 box" id="box"><br>
			<h4 style="text-align: center; font-weight: bold;">SIGN UP</h4>
			<h6 style="text-align: center; color: #007bff;">(Only for Mentees/Students)</h6><br>
			<form method="POST" action="<?php echo $current_file; ?>">
				<label for="rollno" id="roll">Roll No. &nbsp&nbsp&nbsp&nbsp&nbsp<span class="errormsg" id="rnerror"></span></label><br>
				<input type="text" name="rollno" required="true" class="textbox" maxlength="9"><br><br>
				<label for="emailid" id="email">Email ID</label><br>
				<input type="email" name="emailid" required="true" class="textbox" maxlength="30"><br><br>
				<label for="username" id="username">Username &nbsp&nbsp&nbsp&nbsp&nbsp<span class="errormsg" id="unerror"></span></label><br>
				<input type="text" name="username" required="true" class="textbox" maxlength="30"><br><br>
				<label for="pass" id="pass">Password</label><br>
				<input type="password" name="pass" required="true" class="textbox"><br><br>
				<label for="cpass" id="cpass">Confirm Password &nbsp&nbsp&nbsp&nbsp&nbsp<span class="errormsg" id="pwderror"></span></label><br>
				<input type="password" name="cpass" required="true" class="textbox"><br><br>
				<div style="text-align: center;"><button type="submit" class="btn btn-primary">SIGN UP</button><br><br>
				<a href="index.php">Click here to Login</a></div><!--div just for centering the button-->
			</form>
		</div>

	</div>

	<script type="text/javascript">
		
		var h = (window.innerHeight - 680)/2;
		if(h>0) {
			document.getElementById("box").style.marginTop = h + 'px';
			document.getElementById("box").style.marginBottom = h + 'px';
		}

	</script>

</body>

</html>

<?php

if(isset($_POST['emailid']) && isset($_POST['username']) && isset($_POST['rollno']) && isset($_POST['pass']) && isset($_POST['cpass'])) {

	$rollno = $_POST['rollno'];
	$emailid = $_POST['emailid'];
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$cpassword = $_POST['cpass'];

	if(!empty($rollno) && !empty($emailid) && !empty($username) && !empty($password) && !empty($cpassword)){

		if(strlen($rollno) == 9 && strlen($username) <= 30 && strlen($emailid) <= 30) {

			$query1 = $conn->prepare("SELECT ROLLNO FROM USERACCOUNTS WHERE ROLLNO = '$rollno'");
			$query1->execute();
			$query2 = $conn->prepare("SELECT USERNAME FROM USERACCOUNTS WHERE USERNAME = '$username'");
			$query2->execute();
			
			if($query1->rowCount()==1) {
				echo '<script type="text/javascript">';
				echo 'document.getElementById("rnerror").innerHTML = "Roll No. already registered";';
				echo '</script>';
			}

			else if($query2->rowCount()==1) {
				echo '<script type="text/javascript">';
				echo 'document.getElementById("unerror").innerHTML = "Username already taken";';
				echo '</script>';
			}

			else if($password != $cpassword) {
				echo '<script type="text/javascript">';
				echo 'document.getElementById("pwderror").innerHTML = "Passwords do not match";';
				echo '</script>';
			}

			else {

				$password_hash = md5($password);

				$query = $conn->prepare("INSERT INTO USERACCOUNTS VALUES('', '$rollno', '$emailid', '$username', '$password_hash', 'S')");
				$query->execute();

				$query = $conn->prepare("SELECT ID, USERNAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND PASSWORD = '$password_hash'");
				$query->execute();
				$result = $query->fetch(PDO::FETCH_ASSOC);

				$_SESSION['user_id'] = $result['ID'];
				$_SESSION['username'] = $result['USERNAME'];
				$_SESSION['ac'] = $result['ACCTYPE'];
					
				header('Location: index.php');

			}
		}
	}
}

?>