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

		.modal {
			color: black;
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
			<img src="static/img/logo.png" class="logoimg"><br><br><br><br>
			<h4 style="text-align: center; font-weight: bold;">LOG IN</h4><br>
			<form method="POST" action="<?php echo $current_file; ?>">
				<label for="username" id="username">Username</label><br>
				<input type="text" name="username" required="true" class="textbox"><br><br>
				<label for="password" id="pass">Password</label><br>
				<input type="password" name="password" required="true" class="textbox"><br><br><br>
				<div style="text-align: center;">
					<button type="submit" class="btn btn-primary">LOGIN</button><br><br>
					<div id="errormsg" style="color: red;"><br><br><br></div>
					<a href="signup.php">Click here to Signup</a>
				</div><!--div just for centering the button-->
			</form>
		</div>
	</div>

	<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-body">
		      		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        		<span aria-hidden="true">&times;</span>
		        	</button>
		        	<form action="forgot.php" method="POST" style="margin-top: 30px">
		        		<div class="form-group">
						    <label for="uname">Username:</label><br>
						    <input type="text" name="uname" class="textbox">
						</div>
						<p>A link to reset your password will be sent to the registered E-mail ID</p>
						<div style="text-align: center; margin: 30px auto;"><button type="submit" class="btn btn-primary">Send link</button><br><br><p style="color: red; font-size: 0.9em;">No account found with this username</p></div>
					</form>
		      	</div>
	    	</div>
	  	</div>
	</div> -->

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

if(isset($_POST['username']) && isset($_POST['password'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_hash = md5($password);

	if(!empty($username) && !empty($password)) {

		$query = $conn->prepare("SELECT USERNAME FROM USERACCOUNTS WHERE USERNAME = '$username'");
		$query->execute();

		if($query->rowCount()==0) {
			echo '<script type="text/javascript">';
			echo 'document.getElementById("errormsg").innerHTML = "<br>You have not registered yet. Register first!<br><br>";';
			echo '</script>';
		}
		else {
			$query = $conn->prepare("SELECT ID, USERNAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND PASSWORD = '$password_hash'");
			$query->execute();
					
			if($query->rowCount()==0) {
				echo '<script type="text/javascript">';
				echo 'document.getElementById("errormsg").innerHTML = "<br>Wrong Password!<br><br>";';
				echo '</script>';
			}
			else {
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