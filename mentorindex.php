<!DOCTYPE html>

<html>

<head>

	<?php include 'head.php'; ?>

	<style type="text/css">

		.navlogo {
			width: 77vw;
			margin-left: 5vw;
		}

		.letter {
			background-color: rgba(52,58,64,0.9);
			margin: 20px auto 0 auto;
			color: white;
			border-radius: 0.5rem;
		}

		.mentee {
			padding: 40px 40px 15px 40px;
			font-size: 0.77em;
			color: #3296ff;
		}

		.question {
			padding: 0px 40px 0 40px;
		}

		.question-description {
			padding: 10px 40px;
			font-size: 1em;
		}

		.view-comments {
			padding: 4px 40px 20px 40px;
			font-size: 0.8em;
			color: #3296ff;
		}

		.view-comments a {
			color: white;
		}

		.comments {
			position: relative;
			margin: 0 40px 20px 40px;
		}

		.mentor {
			font-size: 0.9em;
			padding-left: 30px;
		}

		.reply {
			padding-top: 10px;
			padding-left: 45px;
		}

		.query {
			height: 10vh !important;
		}

		.description {
			height: 40vh !important;
		}

		.writecomment {
			padding: 0 40px;
			animation: none;
		}

		.commenttext {
			background-color: transparent;
			border-radius: 0;
			border: none;
			padding-left: 0;
			display:block;
			box-sizing: padding-box;
			overflow:hidden;		 
			color: white;
			font-size: 0.85em;
			line-height: 170%;
		}

		.commenttext::placeholder {
    		color: rgba(255,255,255,0.7);
		}

		.commenttext:focus {
			background-color: transparent;
			color: white;
			border: none;
			box-shadow: none;
			border-bottom: 1px solid white;
		}

		.commentsend {
			background-color: transparent;
			border: none;
		}

		.commentsend:hover {
			background-color: transparent;
		}

		.deletecomment {
			font-size: 0.8em;
			color: rgba(255,255,255,0.7);
			background-color: transparent;
			border: none;
			cursor: pointer;
			padding: 0;
		}

		.deletecomment:hover {
			color: #3296ff;
		}

		@media (max-width: 768px) {
			.navlogo {
				width: 65vw;
			}
		}

		@media (max-width: 600px) {
			.mentee {
				padding: 30px 20px 15px 20px;
			}

			.question {
				padding: 0px 20px 0 20px;
			}

			.question-description {
				padding: 10px 20px;
			}

			.view-comments {
				padding: 4px 20px 20px 20px;
			}

			.comments {
				margin: 0 20px 20px 20px;
			}

			.mentor {
				padding-left: 10px;
			}

			.reply {
				padding-top: 10px;
				padding-left: 20px;
			}
			.writecomment {
				padding: 0 20px;
			}
		}

		@media (max-width: 768px) {
			.navlogo {
				margin-left: 1vw;
			}
		}

	</style>

</head>

<body>

	<!-- HEADER STARTS HERE -->

	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<!-- Logo -->
		<div class="navlogo">
			<a class="navbar-brand" href="index.php"><img src="static/img/logo.png" style="max-height: 40px;">&nbsp&nbspMentor Letters</a>
		</div>

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<form action="logout.php" class="logoutform">
				<button type="submit" class="btn btn-primary logout">Logout</button>
			</form>
		</div> 
	</nav>

	<!-- HEADER ENDS HERE -->

	<div class="container">

		<div class="row">
			<div class="col-md-12" style="text-align: center; font-size: 2em; margin-top: 20px;">
				ALL LETTERS
			</div>
		</div>

		<?php

			$query = $conn->prepare("SELECT ID, QUESTION, DESCRIPTION, ASKEDBY, DATE FROM LETTERS ORDER BY ID DESC");
			$query->execute();

			if($query->rowCount()==0) {
				echo "<div class='row' style='text-align: center; margin: 50px auto; font-size: 2em; font-weight: bold;'>";
				echo "<div class='col-md-12'>No Letters found!</div>";
				echo "</div>";
			}
				
			else {

				$result = $query->fetchAll(PDO::FETCH_ASSOC);
						
				for($index = 0; $index < $query->rowCount() ; $index++) {

					$id = $result[$index]['ID'];
					$question = $result[$index]['QUESTION'];
					$description = $result[$index]['DESCRIPTION'];
					$askedby = $result[$index]['ASKEDBY'];
					$date = $result[$index]['DATE'];

					$date_refined = date("M d", strtotime($date));

					echo'<div class="row">';
					echo'<div class="letter col-md-12">';
					echo'<div class="mentee">'.$askedby.' • '.$date_refined.'</div>';
					echo'<h4 class="question">'.$question.'</h4>';
					echo'<p class="question-description">'.$description.'</p>';
					echo'<hr>';
					echo'<form action="reply.php" method="POST" class="writecomment">';
					echo'<input type="number" value='.$id.' style="display: none;" name="qid">';
					echo'<div class="input-group mb-3">';
					echo'<textarea name="reply" class="form-control commenttext" rows="1" data-min-rows="1" placeholder="Write a comment...""></textarea>';
					echo'<div class="input-group-append">';
					echo'<button class="btn btn-primary commentsend" type="submit"><i class="fa fa-paper-plane"></i></button>';
					echo'</div>';
					echo'</div>';
					echo'</form>';

					$query2 = $conn->prepare("SELECT ID, ANSWER, MENTOR FROM REPLIES WHERE QID = ".$id." ORDER BY ID DESC");
					$query2->execute();
					$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

					$no_comm = $query2->rowCount();
					$hr = false;
					
					if($no_comm > 1) $hr = true;

					if($no_comm == 0) {
						echo'<div class="view-comments"><a class="vc" style="cursor: auto;">No Comments</a></div>';
					}

					else {
						echo'<div class="view-comments"><a data-toggle="collapse" data-target="#demo'.$index.'" style="cursor: pointer;" class="vc" onclick="change('.$index.')">View Comments</a></div>';
						echo'<div class="collapse comments" id="demo'.$index.'">';
						echo'<h5 style="padding-bottom: 10px;">Comments</h5>';

						for($ind = 0; $ind < $query2->rowCount() ; $ind++) {

							$answer = $result2[$ind]['ANSWER'];
							$mentor = $result2[$ind]['MENTOR'];

							echo'<div class="mentor">'.$mentor.' :</div>';
							
							if($_SESSION['username'] == $mentor) {
								echo '<div class="reply"><p style="margin-bottom: 5px;">'.$answer.'</p>';
								echo '<form action="deletecomment.php" method="POST">';
								echo '<input name="rid" value='.$result2[$ind]['ID'].' style="display: none;">';
								echo '<button type="submit" class="deletecomment">Delete Comment</a>';
								echo '</form></div>';
							}
							else {
								if($no_comm < 5 and $ind == $no_comm - 1)echo'<div class="reply" style="padding-bottom: 2px;"><p>'.$answer.'</p></div>';
								else echo'<div class="reply"><p>'.$answer.'</p></div>';
							}

							if($ind != $no_comm - 1) echo'<hr style="background-color: rgba(0,0,0,0.1); width: 97%; height: 0.5px;">';
						}

						if($no_comm >= 5) {
							echo'<a data-toggle="collapse" data-target="#demo'.$index.'" style="cursor: pointer; font-size: 0.8em;" class="vc" onclick="change('.$index.')">Hide Comments</a>';
						}
						echo'</div>';
					}
					echo'</div>';
					echo'</div>';
		  		}
			}

		?>

	</div>

	<!-- FOOTER STARTS HERE -->

	<div class="footer-copyright text-center py-3" id="foot">© 2018 Copyrights: Aero Society, Department of Aerospace Engineering, IIT Kharagpur</div>

	<!-- FOOTER ENDS HERE -->

	<script type="text/javascript">

		$(document)
    		.one('focus.textarea', '.commenttext', function(){
        	var savedValue = this.value;
        	this.value = '';
        	this.baseScrollHeight = this.scrollHeight;
        	this.value = savedValue;
    	})
    	.on('input.textarea', '.commenttext', function(){
	        var minRows = this.getAttribute('data-min-rows')|0,
            	rows;
        	this.rows = minRows;
        	rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 22.5);
        	this.rows = minRows + rows;
    	});

		function change(index) {
			var text = document.getElementsByClassName("vc")[index].innerHTML;

			if(text == "View Comments") {
				document.getElementsByClassName("vc")[index].innerHTML = "Hide Comments";
				if(document.getElementById("foot").style.position == "absolute") {
					document.getElementById("foot").style.position = "relative";
					document.getElementById("foot").style.top = '0';
				}
			}
			else {
				document.getElementsByClassName("vc")[index].innerHTML = "View Comments";
				if(footerini) {
					var reqdtop = window.innerHeight-105;
					var myElement = document.querySelector("#foot"); 
					var position = getPosition(myElement);
					document.getElementById("foot").style.position = "absolute";
					document.getElementById("foot").style.top = reqdtop+'px';
					document.getElementById("foot").style.width = "100%";
				}
			}	
		}
		
		$(document).ready(function(){
			if(window.innerWidth <= 690) var reqdtop = window.innerHeight-130;
			else var reqdtop = window.innerHeight-105;
			var myElement = document.querySelector("#foot"); 
			var position = getPosition(myElement);
			if(position.y < reqdtop) {
				document.getElementById("foot").style.position = "absolute";
				document.getElementById("foot").style.top = reqdtop+'px';
				document.getElementById("foot").style.width = "100%";
				footerini = true;
			}
		});

	</script>

</body>

</html>