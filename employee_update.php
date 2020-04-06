<?php
   session_start();
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
         thead {
         background-color: #4CAF50;
         color: white;
         }
         .customrow:hover {
         background-color: #f5f5f5;
         }
      </style>
   </head>
   <body style="background-color: #d3d3d3;">
      <div id="main-wrapper">
         <center>
            <h2>Update Employee Record</h2>
            <img src="res/title_image.png" class="uncg"/><br>
         </center>
         <center>
            <p>Select a table you want to update, then choose a specific row to update:</p>
            <form action="employee_update.php" method="post">
               <select name="table_select" id="table_select">
                  <option value="">--- Select ---</option>
                  <option value="Employee">Employees</option>
                  <option value="SalaryEmp">Salaried Employees</option>
                  <option value="HourlyEmp">Hourly Employees</option>
                  <option value="Dependent">Dependents</option>
                  <option value="Department">Departments</option>
                  <option value="DepartmentLocation">Department Location</option>
                  <option value="Project">Projects</option>
                  <option value="Works">Works In Relationship</option>
               </select>
               <input type="submit" name="submit_table", value="Select" />
            </form>
         </center>
         <?
            if(isset($_POST['submit_table'])) {
            	
            	// Save the variable for use later.
            	$_SESSION["table_name"] = $_POST['table_select'];
            	$table_name = $_SESSION["table_name"];
            	
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
            
            		echo "<form method='post'>";
            		echo "<br><center><input type='submit' name='select_row_btn' value='Select Row' readonly/></center>";
            		echo "<br>";
            		echo "<table><thead><tr>";
            		
            		// The first column is the checkbox column.
            		echo "<td>Select A Row</td>";
            		
            		while ($property = mysqli_fetch_field($col_query_res)) {
            			echo "<td>" .$property->name. "</td>";
            		}
            		
            		$row_index = 1;
            		// Now print out the form inputs for the fields.
            		echo "</tr></thead><tbody>";
            		
            		// Fetch each row and print the corresponding data.
            		while($row = mysqli_fetch_row($query_res)) {
            			echo "<tr class='customrow'>";
            			
            			echo "<td><input type='radio' name='radio_button' class='inputvalues' value=" .$row_index. " /></td>";
            			
            			foreach($row as $cell) {
            				echo "<td>" .$cell. "</td>";
            			}
            			
            			echo "</tr>";
            			
            			$row_index += 1;
            		}
            		echo "</tbody></table><br>";
            		
            		echo "<center>";
            		echo "<input type='submit' name='select_row_btn' value='Select Row' readonly/>";
            		echo "</form>";
            		echo "</center>";
            	}
            }
            ?>
         <?
            if(isset($_POST['select_row_btn'])) {
            	$offset_no = $_POST['radio_button'];
            	$table_name = $_SESSION["table_name"];
            	
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
            		
            		//	If the field is a primary key, we can't update it.
            		if($property->flags & MYSQLI_PRI_KEY_FLAG) {
            			echo "<td><input type='text' name='$row_index' value='" .$cell. "' style='width: 90%'; readonly/></td>";
            		} else {
            			echo "<td><input type='text' name='$row_index' value='" .$cell. "' style='width: 90%'; /></td>";
            		}
            		
            		$row_index += 1;
            	}
            	
            	echo "</tr></table>";
            	echo "<center><input type='submit' name='update_btn' id='update_button' value='Update '" .$table_name."' /></center><br>";
            	echo "</form>";
            }
            ?>
         <?
            if(isset($_POST['update_btn'])) {
            	$table_name = $_SESSION["table_name"];
            	
            	$col_query = "SELECT * FROM $table_name LIMIT 1";
            	$col_query_res = mysqli_query($con, $col_query);
            	
            	$update_query = "UPDATE $table_name SET ";
            	$row_index = 1;
            	
            	$col_query = "SELECT * FROM $table_name LIMIT 1";
            	$col_size = mysqli_num_fields(mysqli_query($con, $col_query));
            
            	$prime_field_val = 0;
            	$prime_field = '';
            	
            	while($property = mysqli_fetch_field($col_query_res)) {
            		
            		//If the field is primary, just keep the old text.
            		if($property->flags & MYSQLI_PRI_KEY_FLAG) {
            			$prime_field_val = $_POST[$row_index];
            			$prime_field = $property->name;
            			$row_index += 1;
            			continue;
            		} else {
            			$new_val = $_POST[$row_index];
            			
            			if(empty($new_val)) {
            				echo "Error, the new value for the field " . $property->name . " is empty.";
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
            	
            	if($real_update) {
            		echo '<script type="text/javascript"> alert("Update successful!") </script>';
            	} else {
            		echo '<script type="text/javascript"> alert("Update failed!") </script>';
            	}
            }
            ?>
         <br>
         <input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
      </div>
   </body>
</html>