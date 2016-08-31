<!--
Vikram Sringari
5/25/2016
CSE 154 AC
HW6: ToDoList
This PHP file displays the starting page for login
It keeps track of when someone last loggedin
-->
<?php
	session_start();
	include("common.php");
	redirection(true);
	top_bar();
?>
		<div id="main">
			<p>
				The best way to manage your tasks.
				<br>
				Never forget the cow (or anything else) again!
			</p>
			<p>
				Log in now to manage your to-do list.
				<br>
				If you do not have an account, one will be created for you.
			</p>
			<?php
				displayed_error();
			?>
			<form id="loginform" method="post" action="login.php">
				<div>
					<input type="text" autofocus="autofocus" size="8" name="name">
					<strong>User Name</strong>
				</div>
				<div>
					<input type="password" size="8" name="password">
					<strong>Password</strong>
				</div>
				<div>
					<input type="submit" value="Log in">
				</div>
			</form>
			<?php
				if (isset($_COOKIE["time/date"])) {
			?>
					<p>
						<em>(last login from this computer was <?=$_COOKIE["time/date"]?>)</em>
					</p>
			<?php
				}
			?>
		</div>	
<?php
	bottom_bar();
?>
