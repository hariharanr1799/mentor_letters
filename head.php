<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 	
<link rel="shortcut icon" type="image/x-icon" href="static/img/favicon.png" />

<link href="https://fonts.googleapis.com/css?family=Yrsa" rel="stylesheet"><!-- serif font -->
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"><!-- sans-serif font -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!-- icons -->

<title> Mentor Letters </title>

<style type="text/css">

	body {
		font-family: 'Poppins', sans-serif;
		background-image: url('static/img/bg.jpg');
		background-size: cover;
		background-position: top right;
		background-attachment: fixed;
		background-repeat: no-repeat;
		color: black;
		overflow-x: hidden;
	}

    a:hover {
        text-decoration: none;
    }

    hr {
    	background-color: rgba(255,255,255,0.5);
    	height: 0.7px;
    	width: 93%;
    }

    .footer-copyright {
    	background: #343a40;
    	color: white;
    	margin-top: 50px;
    	height: 55px;
    	z-index: -1;
    }

    .navlogo {
		width: 73vw;
		margin-left: 5vw;
	}

	.nav-link {
		text-align: center;
	}

	.logout {
		margin-left: 5px;
	}

	.logoutform {
		text-align: center;
	}

	.writeletter {
		position: fixed;
		bottom: 10px;
		right: 15px;
		height: 60px;
		width: 60px;
		border-radius: 50%;
		border: 1px solid white;
		background: transparent;
		cursor: pointer;
		background-image: url('static/img/57-512.png');
		background-position: center;
		background-size: 50px 50px;
		z-index: 5;
	}

	.wl {
		position: fixed;
		bottom: 18px;
		right: 60px;
		color: rgb(52,58,64);
		background-color: #3296ff;
		padding: 10px 20px;
		border-top-left-radius: 20px;
		border-bottom-left-radius: 20px;
		cursor: pointer;
	}

	.modal {
		background-color: rgba(0,0,0,0.5);
	}

	.modal-footer {
		display: block;
		text-align: center;
	}

	@media (min-width: 576px) {
		.container {
		    max-width: 560px;
		}
	}

	@media (min-width: 620px) {
		.container {
		    max-width: 600px;
		}
	}

	@media (min-width: 680px) {
		.container {
		    max-width: 660px;
		}
	}

	@media (min-width: 768px) {
		.container {
		    max-width: 740px;
		}
	}

	@media (min-width: 870px) {
		.container {
		    max-width: 840px;
		}
	}

	@media (min-width: 900px) {
		.container {
		    max-width: 860px;
		}
	}
	
	@media (min-width: 992px) {
		.container {
		    max-width: 960px;
		}
	}

	@media (min-width: 1200px) {
		.container {
		    max-width: 1140px;
		}
	}

	@media (max-width: 768px) {
		#collapsibleNavbar {
			padding-bottom: 10px;
		}
		.nav-link {
			padding-top: 10px;
			padding-bottom: 10px;
			border-top: 0.7px solid rgba(0,0,0,0.1);
			border-bottom: 0.7px solid rgba(0,0,0,0.1);
		}
		.logout {
			position: relative;
			top: 9px;
		}
		.navlogo {
			margin-left: 1vw;
		}
	}

	@media (max-width: 550px) {
		body {
			background-image: url('static/img/bgphone.jpg') !important;
		}
	}

	@media (max-width: 420px) {
		body {
			background-image: url('static/img/bgphone2.jpg') !important;
		}
	}

	@media (max-width: 690px) {
		.footer-copyright {
			height: 80px;
		}
	}

</style>

<script type="text/javascript">

	var footerini = false;

	var footheight = 55;

	if(window.innerWidth<=690) footheight = 80;
	
	function getPosition(el) {
	  var xPos = 0;
	  var yPos = 0;
	 
	  while (el) {
	    if (el.tagName == "BODY") {
	      // deal with browser quirks with body/window/document and page scroll
	      var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
	      var yScroll = el.scrollTop || document.documentElement.scrollTop;
	 
	      xPos += (el.offsetLeft - xScroll + el.clientLeft);
	      yPos += (el.offsetTop - yScroll + el.clientTop);
	    } else {
	      // for all other non-BODY elements
	      xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
	      yPos += (el.offsetTop - el.scrollTop + el.clientTop);
	    }
	 
	    el = el.offsetParent;
	  }
	  return {
	    x: xPos,
	    y: yPos
	  };
	}

</script>


