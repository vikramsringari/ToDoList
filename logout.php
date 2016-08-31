<?php
	/*
	Vikram Sringari
	5/25/2016
	CSE 154 AC
	HW6: ToDoList
	This PHP file closes out of the current session.
	It takes the User back to the main start page.
	*/
	session_start();
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: start.php");
?>
