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
			<form action="employee_insert" class="loginform" method="post">
			<label>Social Security Number (SSN):</label><br>
				<input name="ssn" type="text" class="inputvalues" placeholder="Type your SSN" required/><br><br>
				
				<label>First Name:</label><br>
				<input name="fname" type="text" class="inputvalues" placeholder="Type your first name" required/><br><br>
				
				<label>Middle Initial:</label><br>
				<input name="minit" type="text" class="inputvalues" placeholder="Type your middle initial" required/><br><br>
				
				<label>Last Name:</label><br>
				<input name="lname" type="text" class="inputvalues" placeholder="Type your last name" required/><br><br>
				
				<label>Address:</label><br>
				<input name="address" type="text" class="inputvalues" placeholder="Type your address" /><br><br>
				
				<label>Phone Number:</label><br>
				<input name="phoneno" type="text" class="inputvalues" placeholder="Type your phone number" /><br><br>
				
				<center>
					<input name="submit_btn" type="submit" id="add_button" value="Add Employee" required/><br>
				</center>
				<input type="submit" id="back_button" value="<< Back" onclick="document.location.href='index.php'" required/>	
			</form>	
			
			<?php
				if(isset($_POST['submit_btn'])) {
					//	Grab the input values from the fields.
					$ssn = $_POST['ssn'];
					$firstname = $_POST['fname'];
					$middleinit = $_POST['minit'];
					$lastname = $_POST['lname'];
					$address = $_POST['address'];
					$phonenumber = $_POST['phoneno'];
					
					//	TODO: Add value checking.
					$query = mysqli_prepare($con, "INSERT INTO Employee VALUES(?, ?, ?, ?, ?, ?)");
					mysqli_stmt_bind_param($query, 'isssss', $ssn, $firstname, $middleinit, $lastname, $address, $phonenumber);
						
					$query_run = mysqli_stmt_execute($query);
						
					if($query_run) {
						echo '<script type="text/javascript"> alert("Success!") </script>';
					} else {
						echo '<script type="text/javascript"> alert("Error!") </script>';
					}
					
				}
			?>
		</div>
	</body>
</html>