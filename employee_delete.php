<!--

Code is produced and written by Joshua Crotts. This project is for
CSC - 471: Principles of Database Systems for the Spring 2020 semester
at the University of North Carolina at Greensboro.

-->

<?php
	require 'config.php';
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Delete Employee Record</title>
		<link rel="stylesheet" href="css/styles.css">
		<meta charset="utf-8">
	</head>
	<body style="background-color: #d8d8d8;">
		<div id="main-wrapper">
			<center>
				<h2>Delete Employee Record</h2>
				<img src="res/title_image.png" class="uncg"/>
			
				<form action="employee_delete.php" class="loginform" method="post">
					<label>Enter the SSN of the Employee you want to Delete:</label><br><br>
					<input type="text" name="essn"class="inputvalues" placeholder="Enter SSN" required/><br><br>
					<input type="submit" name="submit_btn" id="delete_button" value="Delete Employee" required/><br>
				</center>
				<input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
			</form>
			<?php
				if(isset($_POST['submit_btn'])) {
					$deleteSSN = $_POST['essn'];
					
					if(strlen($deleteSSN) != 9) {
						echo '<script type="text/javascript"> alert("SSN must be 9 numbers!") </script>';
					} else {
						$query = "DELETE FROM Employee WHERE SSN='$deleteSSN';";
						$query_res = mysqli_query($con, $query);
						
						if($query_res) {
							echo '<script type="text/javascript"> alert("Deletion Successful!") </script>';
						} else {
							echo '<script type="text/javascript"> alert("Deletion Failed!") </script>';
						}
					}
				}
			?>
		</div>
	</body>
</html>