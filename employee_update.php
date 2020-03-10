<?php
	require 'config.php';
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Update Employee Record</title>
		<link rel="stylesheet" href="css/styles.css">
		<meta charset="utf-8">
		<style type="text/css">
			table {
				border-collapse: collapse;
				text-align: center;
				border: 1px solid black;
				width: 100%;
				font-size: 24px;
			}
			
			td {
				border: 1px solid black;
			}
			
			td input {
				width: 100%;
				box-sizing: border-box;
			}
			
			th {
				background-color: red;
				font-color: white;
			}
		</style>
	</head>
	<body style="background-color: #d8d8d8;">
		<div id="main-wrapper">
			<center>
				<h2>Update Employee Record</h2>
				<img src="res/title_image.png" class="uncg"/><br>
			</center>
			<center>
				<p>Select a table you want to update, then fill in the forms:</p>
				<form action="employee_update.php" method="post">
					<select name="table_select" id="table_select">  
						<option value="">--- Select ---</option>  
						<option value="Employee">Employee</option>
						<option value="Dependent">Dependent</option>
						<option value="Project">Project</option>
					</select>  
					<input type="submit" name="submit_table", value="Select" />
				</form>				
			</center>
			
			<?
				if(isset($_POST['submit_table'])) {
					$table_name = $_POST['table_select'];
					if(empty($table_name)) {
						echo '<script type="text/javascript"> alert("Cannot load table name!") </script>';
					} else {
						// TODO: Prepared statement tf out of this
						$query = "SELECT * FROM " .$table_name;
						$query_res = mysqli_query($con, $query);
						$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
						$col_query_res = mysqli_query($con, $col_query);
						
						// Begin printing out the fields and 
						// the things they want to update.
						echo "<table><tr>";
						while ($property = mysqli_fetch_field($col_query_res)) {
							echo "<td>" .$property->name. "</td>";
						}
						
						$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
						$col_query_res = mysqli_query($con, $col_query);
						// Now print out the form inputs for the fields.
						echo "</tr><tr>";
						while ($property = mysqli_fetch_field($col_query_res)) {
							echo "<td><input name=" .$property->name. " type='text' size='30'/></td>";
						}
						echo "</tr></table>";
					}
				}
			?>
			
			<br>
			<center>
				<form action="employee_update.php" method="post">
					<input type="submit" name="update_btn" id="update_button" value="Update Employee" required/><br>
					<input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
				</form>
			</center>
		</div>
	</body>
</html>