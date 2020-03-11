<?php
	require 'config.php';
?>

<!DOCTYPE html>

<html>
	<head>
		<title>View Employee Records</title>
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
			
			th {
				background-color: red;
				font-color: white;
			}
		</style>
	</head>
	<body style="background-color: #d8d8d8;">
		<div id="main-wrapper">
			<center>
				<h2>View Employee Records</h2>
				<img src="res/title_image.png" class="uncg"/><br>
				<p>Select a table to view:</p>
				<form action="employee_display.php" method="post">
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
			
			<?
				if(isset($_POST['submit_table'])) {
					
					// TODO: Prepared statement tf out of this
					$table_name = $_POST['table_select'];
					
					$query = "SELECT * FROM " .$table_name;
					$query_res = mysqli_query($con, $query);
					$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
					$col_query_res = mysqli_query($con, $col_query);
				
					// Begin printing the headers of the rows.
					echo "<table><tr>";
					while ($property = mysqli_fetch_field($col_query_res)) {
						echo "<td>" .$property->name. "</td>";
					}
					echo "</tr>";
					
					// Fetch each row and print the corresponding data.
					while($row = mysqli_fetch_row($query_res)) {
						echo "<tr>";
						
						foreach($row as $cell) {
							echo "<td>" .$cell. "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				}
			?>
			<input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
		</div>
	</body>
</html>