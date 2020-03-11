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
				<p>Select a table you want to update, then choose a specific row to update:</p>
				<form action="employee_update.php" method="post">
					<?
						echo "<select name='table_select' id='table_select'>";
					?>
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
						echo "<br><table><tr>";
						
						// The first column is the checkbox column.
						echo "<td>Select A Row</td>";
						
						while ($property = mysqli_fetch_field($col_query_res)) {
							echo "<td>" .$property->name. "</td>";
						}
						
						
						//$row_count = mysqli_num_rows(mysqli_query("SELECT COUNT(*) FROM '.$table_name.';"));
						$row_index = 1;
						// Now print out the form inputs for the fields.
						echo "</tr>";
						
						// Fetch each row and print the corresponding data.
						while($row = mysqli_fetch_row($query_res)) {
							echo "<tr>";
							
							echo "<td><input type='radio' name='radio_button' class='inputvalues' value=".$row_index." /></td>";
							
							foreach($row as $cell) {
								echo "<td>" .$cell. "</td>";
							}
							
							echo "</tr>";
							
							$row_index += 1;
						}
						echo "</table><br>";
						
						echo "<center>";
						echo "<form method='post'>";
						echo "<input type='text' name='select_row_btn' value='Select Row' />";
						echo "<input type='submit' name='table_select_btn' value='$table_name' readonly/>";
						echo "</form>";
						echo "</center>";
					}
				}
			?>
			<?
				if(isset($_POST['select_row_btn'])) {
					$offset_no = $_POST['select_row_btn'];
					$table_name = $_POST['table_select_btn'];
					
					if(empty($table_name)) {
						echo '<script type="text/javascript"> alert("Cannot load table name!") </script>';
					} 
					
					$query = "SELECT * FROM $table_name LIMIT 1 OFFSET " .($offset_no - 1). ";";
					$query_set = mysqli_query($con, $query);
					
					$col_query = "SELECT * FROM $table_name LIMIT 1";
					$col_query_res = mysqli_query($con, $col_query);

					if (!$query_set) {
						printf("Error: %s\n", mysqli_error($con));
						exit();
					}
					
					$row = mysqli_fetch_row($query_set);
					
					echo "<br>";
					echo "<form method='post'>";
					echo "<table><tr>";
					
					$row_index = 1;
					foreach($row as $cell) {
						$property = mysqli_fetch_field($col_query_res);
						if($property->name == 'SSN') {
							echo "<td><input type='text' name='$row_index' value='" .$cell. "' readonly/></td>";
						} else {
							echo "<td><input type='text' name='$row_index' value='" .$cell. "' /></td>";
						}
						
						$row_index += 1;
					}
					
					echo "</tr></table>";
					echo "<center><input type='submit' name='update_btn' id='update_button' value='Update '" .$table_name."' /></center><br>";
					echo "<input type='submit' name='table_select_btn' value='$table_name'/>";
					echo "</form>";
				}
			?>

			<?
				if(isset($_POST['update_btn'])) {
					$table_name = $_POST['table_select_btn'];
					
					$col_query = "SELECT * FROM $table_name LIMIT 1";
					$col_query_res = mysqli_query($con, $col_query);
					
					$update_query = "UPDATE $table_name SET ";
					$row_index = 1;
					
					$col_query = "SELECT * FROM $table_name LIMIT 1";
					$col_size = mysqli_num_fields(mysqli_query($con, $col_query));

					$prime_field_val = 0;
					$prime_field = '';
					
					while($property = mysqli_fetch_field($col_query_res)) {
						//	The first field should always be the primary one.
						if($row_index == 1) {
							$prime_field_val = $_POST['1'];
							$prime_field = $property->name;
							$row_index += 1;
							continue;
						} else {
							$new_val = $_POST[$row_index];
							
							if(empty($new_val)) {
								echo "Error.";
							} else {
								if($row_index == $col_size) {
									$update_query = $update_query . $property->name . '=' . "'$new_val' ";
								} else {
									$update_query = $update_query . $property->name . '=' . "'$new_val', ";
								}
							}
						}
						
						$row_index += 1;
					}
					
					$update_query = $update_query . " WHERE " .$prime_field_val. "=" .$prime_field. ";";
					
					$real_update = mysqli_query($con, $update_query);
				}
			?>
									
			<br>
			<input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
		</div>
	</body>
</html>