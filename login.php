<?php
	/*
	Vikram Sringari
	5/25/2016
	CSE 154 AC
	HW6: ToDoList
	This PHP file takes the username and password from the inputs
	and if it is a new username and password that is valid it takes
	the user to a new todo list. If it is a reoccuring user it will takes
	the user back to his original todo page. If the password is wrong
	or if the username or password do not fit the valid pattern errors
	are displayed.
	Extra feature number 1 is displayed along with other extra features
	*/
	session_start();
	include("common.php");
	redirection(true);
	$username = $_POST["name"];# takes the value from username input
	$password = $_POST["password"];# takes the value from password input
	
	# This dettermines whether the password is right
	# If it is the user is taken to his/her todolist
	# If not an error is shown
	if (login($username, $password)) {
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		date_default_timezone_set("America/New_York");
		$date = date("D y M d, g:i:s a");
		$time = time()+ 60 * 60 * 24 * 7;
		setcookie("time/date", $date, $time);
		header("Location: todolist.php");
	} else {
		error("start.php", "Password Incorrect");
	}
	
	# This function takes in the username and password inputted and dettermines if 
	# that password is valid (fits pattern)
	function login($username, $password){
		$passwordData = array();
		$users = file("users.txt", FILE_IGNORE_NEW_LINES);
		foreach ($users as $user) {
			list($name, $code) = explode(":", $user);
			$passwordData[$name] = $code; # sets username index for password
		}
		# Dettermines if the userusername or/and password fits the pattern
		if (!array_key_exists($username, $passwordData)) {
			$correctpassword = preg_match("/^\d.{4,10}\W$/", $password);
			$correctusername = preg_match("/^[a-z]([a-z]|\d){2,7}$/", $username);
			if ($correctusername && $correctpassword) {
				$passwordData[$username] = $password;
				file_put_contents("users.txt", $username . ":" . $password . "\n" , FILE_APPEND);
			} elseif (!$correctpassword && !$correctusername) {
				error("start.php", "Invalid username and password");
			} elseif (!$correctpassword) {
				error("start.php", "Invalid password");
			} elseif (!$correctusername) {
				error("start.php", "Invalid username");
			}
		}
		return $password == $passwordData[$username];
	}

?>
