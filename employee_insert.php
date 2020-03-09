<?php
	require 'config.php';
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
				<input name="fname" type="text" class="inputvalues" placeholder="Type your first name" required/><br><br>
				
				<label>Middle Initial:</label><br>
				<input name="minit" type="text" class="inputvalues" placeholder="Type your middle initial" required/><br><br>
				
				<label>Last Name:</label><br>
				<input name="lname" type="text" class="inputvalues" placeholder="Type your last name" required/><br><br>
				
				<center>
					<input name="submit_btn" type="submit" id="add_button" value="Add Employee" required/><br>
				</center>
				<input type="submit" id="back_button" value="<< Back" onclick="document.location.href='index.php'" required/>	
			</form>	
			
			<?php
				if(isset($_POST['submit_btn'])) {
					//	Grab the three values from the fields.
					$firstname = $_POST['fname'];
					$middleinit = $_POST['minit'];
					$lastname = $_POST['lname'];
					
					//	Check to see if middle init length is exactly one.
					if(strlen($middleinit) == 1) {
						
						$query = "INSERT INTO USERS VALUES(DEFAULT, '$firstname', '$middleinit', '$lastname')";
						
						$query_run = mysqli_query($con, $query);
						
						if($query_run) {
							echo '<script type="text/javascript"> alert("Success!") </script>';
						} else {
							echo '<script type="text/javascript"> alert("Error!") </script>';
						}
					} else {
						echo '<script type="text/javascript"> alert("Error, the middle initial should be one character only!") </script>';
					}
				}
			?>
		</div>
	</body>
</html>