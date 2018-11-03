<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(loggedin()) header('Location: index.php');

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<?php include 'head.php'; ?>

	<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="651955285072-uqu6tp8qii8cldhd3sq2ssncu6269o0s.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

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
			<h6 style="text-align: center; margin-bottom: 150px; color: #007bff;">(Only for Mentors/Alumni)</h6>
			<div class="g-signin2" style="max-width: 120px; margin: auto; transform: scale(1.2);" data-onsuccess="onSignIn"></div>
			<div id="errormsg" style="color: red; text-align: center;"><br><br><br><br><br></div>
		</div>
	</div>

	<script type="text/javascript">
		
		var h = (window.innerHeight - 680)/2;
		if(h>0) {
			document.getElementById("box").style.marginTop = h + 'px';
			document.getElementById("box").style.marginBottom = h + 'px';
		}

		function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        // var id_token = googleUser.getAuthResponse().id_token;
        var email = profile.getEmail();
        // console.log("ID Token: " + id_token);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'tokensignin.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
        	console.log(xhr.responseText);
          if (xhr.responseText == "error") {
            document.getElementById("errormsg").innerHTML = "<br><br><br><br><br>There was a problem in signing in. Please try again";
          }
          else if(xhr.responseText == "success") {
            window.location.replace("index.php");
          }
        };
        xhr.send('email=' + email);
      };

	</script>

</body>

</html>