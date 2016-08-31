<?php
	/*
	Vikram Sringari
	5/25/2016
	CSE 154 AC
	HW6: ToDoList
	This PHP file contains functions used to display common elements displayed on the pages.
	This also contains other functions that helps sends errors or redirects the user 
	after an action.
	*/
	
	# This function takes in a value that tells whether if the todolist is displayed
	# If the todolist is in display and the user is logged in, this function takes the user to
	# the todolist page, otherwise takes the user to the start page.
	function redirection($inTodoList) {
		if ((isset($_SESSION["username"]) || isset($_SESSION["password"])) && $inTodoList) {
			header("Location: todolist.php");
			die();
		}elseif((!isset($_SESSION["username"]) || !isset($_SESSION["password"])) && !$inTodoList){
			header("Location: start.php");
			die();
		}
	}
	
	# Shows the top bar of the todolist and start page
	function top_bar() { 
?>	
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>Remember the Cow</title>
				<link rel="stylesheet" type="text/css" href="https://webster.cs.washington.edu/css/cow-provided.css">
				<link rel="stylesheet" type="text/css" href="cow.css">
				<link rel="shortcut icon" type="image/ico" href="https://webster.cs.washington.edu/images/todolist/favicon.ico">
			</head>
			<body>
				<div class="headfoot">
					<h1>
						<img alt="logo" src="https://webster.cs.washington.edu/images/todolist/logo.gif">
						Remember
						<br>
						the Cow
					</h1>
				</div>
<?php		
	}
	
	# Shows the bottom bar of the todolist and start page
	function bottom_bar() {
?>
				<div class="headfoot">
					<p>
						"Remember The Cow is nice, but it's a total copy of another site." - PCWorld
						<br>
						All pages and content © Copyright CowPie Inc.
					</p>
					<div id="w3c">
						<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
						<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
					</div>
				</div>
			</body>
		</html>
<?php
	}
	
	# Takes the location of the current page displayed and an error message.
	# Uses these to send an error message to the user.
	function error($location, $message) {
		$_SESSION["error"] = $message;
		header("Location: $location");
		die();
	}
	
	# Displays the error message that was sent.
	# This shows up on the page.
	function displayed_error() {
		if (isset($_SESSION["error"])) {
?>
		<p id="error">
			<?= $_SESSION["error"] ?>
		</p>
<?php
			unset($_SESSION["error"]);
		}
	}
?>
