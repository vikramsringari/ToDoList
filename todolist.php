<!--
Vikram Sringari
5/25/2016
CSE 154 AC
HW6: ToDoList
This PHP file displays the todo list page for the user when logged in
This page is shown if the user is logged but goes to another page and comes back.
-->
<?php
	session_start();
	include("common.php");
	top_bar();
	redirection(false);
	$password = $_SESSION["password"];
	$username = $_SESSION["username"];
?>
		<div id="main">
			<h2><?= $username ?>'s To-Do List</h2>
			<ul id="todolist">
				<?php
					displayed_error();
					if (file_exists("todo-$username.txt")) {
						$users = file("todo-$username.txt", FILE_IGNORE_NEW_LINES);
						for ($i=0; $i<count($users); $i++) { 
				?>
							<li>
								<form method="post" action="submit.php">
									<input type="hidden" value="delete" name="action">
									<input type="hidden" value=<?= $i ?> name="index">
									<input type="submit" value="Delete">
								</form>
								<?= $users[$i] ?>
							</li>
				<?php
						}		
					}
				?>
				<li>
					<form method="post" action="submit.php">
						<input type="hidden" value="add" name="action">
						<input type="text" autofocus="autofocus" size="25" name="item">
						<input type="submit" value="Add">
					</form>
				</li>
			</ul>

			<div>
				<a href="logout.php">
				<strong>Log Out</strong>
				</a>
				<em>(logged in since <?=$_COOKIE["time/date"]?>)</em>
			</div>
		</div>
<?php
	bottom_bar();
?>
