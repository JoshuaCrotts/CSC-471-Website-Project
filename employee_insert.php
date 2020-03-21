<!--

Code is produced and written by Joshua Crotts. This project is for
CSC - 471: Principles of Database Systems for the Spring 2020 semester
at the University of North Carolina at Greensboro.

-->

<?php
	require 'config.php';
	session_start();
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
			<center>
				<p>Select a table you want to insert into.</p>
				<form method="post">
					<select name="table_select" id="table_select">  
						<option value="">--- Select ---</option>  
						<?
							// Here, we query the database for the tables.
							// The user can choose which table they want to view.
							$query = "SHOW TABLES";
							$query_res = mysqli_query($con, $query);
							
							if(empty($query_res)) {
								echo '<script type="text/javascript"> alert("Error querying for tables.") </script>';
							} else {
								while($row = mysqli_fetch_array($query_res)) {
									echo "<option value=" .$row[0]. ">" .$row[0]. "</option>";
								}
							}
						?>
					</select>  
					<input type="submit" name="submit_table", value="Select" />
				</form>			
			</center>
			
			<?php
				if(isset($_POST['submit_table'])) {
					$_SESSION['table_name'] = $_POST['table_select'];
					$table_name = $_SESSION['table_name'];

					// Display the columns (input fields).
					$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
					$col_query_res = mysqli_query($con, $col_query);

					if (!$col_query) {
						printf("Error: %s\n", mysqli_error($con));
						exit();
					}
					
					echo "<br>";
					echo "<form method='post'>";
					echo "<table><tr>";
				
					// Display each row with a label and an input field.
					while ($property = mysqli_fetch_field($col_query_res)) {
						// Display the labels then the respective input fields.
						echo "<label>" . $property->name . "</label><br>";
						echo "<input name=" . $property->name . " style='width: 98%;' type='text' class='inputvalues' placeholder='' required/><br><br>";
					}
					echo "</form>";
					
					echo "<center>";
					echo "<input name='submit_btn' type='submit' id='add_button' value='Add To Table' required/><br>";
					echo "</center>";
				}
			?>
			<?php
				if(isset($_POST['submit_btn'])) {
					$table_name = $_SESSION['table_name'];
					
					// Display the columns (input fields).
					$col_query = "SELECT * FROM $table_name LIMIT 1";
					$col_query_res = mysqli_query($con, $col_query);
					
					$col_size = mysqli_num_fields($col_query_res);

					if (!$col_query) {
						printf("Error: %s\n", mysqli_error($con));
						exit();
					}
					
					$insert_query = "INSERT INTO $table_name VALUES(";
					
					$field_current_index = 1;
					
					while ($property = mysqli_fetch_field($col_query_res)) {
						$field_value = $_POST[$property->name];
						
						if(empty($field_value)) {
							echo "Error, the new value for the field " . $property->name . " is empty.";
						} else {
							if($field_current_index == $col_size) {
								$insert_query = $insert_query . "'$field_value');";
							} else {
								$insert_query = $insert_query . "'$field_value', ";
							}
						}
						
						$field_current_index += 1;
					}
					
					//echo $insert_query;
					
					$real_update = mysqli_query($con, $insert_query);
				}
			?>
			
			<input type="submit" id="back_button" value="<< Back" onclick="document.location.href='index.php'" required/>	
		</div>
	</body>
</html>