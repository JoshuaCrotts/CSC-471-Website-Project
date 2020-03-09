<?php

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="css/styles.css">
		<meta charset="utf-8">
	</head>
	<body style="background-color:#7f8c8d;">
		<div id="main-wrapper">
			<center>
				<h2>Employee Entry Form</h2>
				<img src="res/title_image.png" action="employee_insert.php" class="uncg"/>
			</center>
			<form class="loginform" method="post">
				<label>First Name:</label><br>
				<input name="fname" type="text" class="inputvalues" placeholder="Type your first name"/><br><br>
				
				<label>Middle Initial:</label><br>
				<input name="minit" type="text" class="inputvalues" placeholder="Type your middle initial"/><br><br>
				
				<label>Last Name:</label><br>
				<input name="lname" type="text" class="inputvalues" placeholder="Type your last name"/><br><br>
				
				<center>
					<input name="submit_btn" type="submit" id="add_button" value="Add Employee" /><br>
				</center>
				<input type="sonubmit" id="back_button" value="<< Back" onclick="document.location.href='index.php'"/>	
			</form>	
		</div>
	</body>
</html>