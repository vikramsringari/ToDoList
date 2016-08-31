<?php
	/*
	Vikram Sringari
	5/25/2016
	CSE 154 AC
	HW6: ToDoList
	This PHP file allows the user to add new items or delete old items on the 
	todo list. If the user is doing anything malicious an error shown.
	*/
	session_start();
	include("common.php");
	redirection(false);
	$username = $_SESSION["username"];
	
	# This adds an item when the user clicks the add button
	 if ($_POST["action"] == "add") {
		$item = $_POST["item"];
		$item = htmlspecialchars($item, ENT_QUOTES); #Allows special characters
		file_put_contents("todo-$username.txt", $item . "\n", FILE_APPEND);
	}elseif ($_POST["action"] == "delete") {
		# This deletes an item when the user clicks the delete button
		$toDo = file("todo-$username.txt");
		$item = $_POST["index"];
		if ($toDo[$item] == null || !preg_match("/\d/", $item)) {
			error("todolist.php", "Malicious Action Detected");# protects against malicious action
		}
		$toDo[$item] = "";
		file_put_contents("todo-$username.txt", $toDo);
	}else {
		error("todolist.php", "Malicious Action Detected");# protects against malicious action
	}
	
	# Keeps User in the todolist page after done.
	header("Location: todolist.php");
?>
