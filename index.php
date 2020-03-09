<?php
	require 'config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Main Page</title>
		<link rel="stylesheet" href="css/styles.css">
		<meta charset="utf-8">
	</head>
	<body style="background-color:#404040;">
		<div id="main-wrapper">
			<center>
				<h2>Home Page</h2>
				<img src="res/title_image.png" class="uncg"/><br>
				<input type="submit" id="add_button" value="Add Employee" onClick="document.location.href='employee_insert.php'"/><br>
				<input type="submit" id="update_button" value="Update Employee" onClick="document.location.href='employee_update.php'"/><br>
				<input type="submit" id="delete_button" value="Delete Employee" onClick="document.location.href='employee_delete.php'"/><br>
				<input type="submit" id="display_button" value="View All Employees" onClick="document.location.href='employee_display.php'"/><br>
			</center>
		</div>
	</body>
</html>