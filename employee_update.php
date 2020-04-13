<?php
   session_start();
   require 'config.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Update Data Records</title>
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
			font-size: 16px;
        }
        thead {
			background-color: #4CAF50;
			color: white;
        }
        .customrow:hover {
			background-color: #f5f5f5;
        }
		
		.select_table_button {
			box-shadow: 0px 10px 14px -7px #276873;
			background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
			background-color:#599bb3;
			border-radius:0px;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:12px;
			font-weight:bold;
			padding:2px 10px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
		}
		.select_table_button:hover {
			background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
			background-color:#408c99;
		}
		.select_table_button:active {
			position:relative;
			top:1px;
		}
		.select_row_button {
			box-shadow: 0px 10px 14px -7px #3e7327;
			background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
			background-color:#77b55a;
			border-radius:0px;
			border:1px solid #4b8f29;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:12px;
			font-weight:bold;
			padding:2px 17.5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #5b8a3c;
		}
		.select_row_button:hover {
			background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
			background-color:#72b352;
		}
		.select_row_button:active {
			position:relative;
			top:1px;
		}
		.delete_row_button {
			box-shadow: 0px 1px 0px 0px #f5978e;
			background:linear-gradient(to bottom, #f24537 5%, #c62d1f 100%);
			background-color:#f24537;
			border-radius:0px;
			border:1px solid #d02718;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:12px;
			font-weight:bold;
			padding:2px 17.5px;
			text-decoration:none;
			text-shadow:0px 1px 0px #810e05;
		}
		.delete_row_button:hover {
			background:linear-gradient(to bottom, #c62d1f 5%, #f24537 100%);
			background-color:#c62d1f;
		}
		.delete_row_button:active {
			position:relative;
			top:1px;
		}
		.select-css {
			font-size: 12px;
			font-family: sans-serif;
			font-weight: 700;
			color: #444;
			line-height: 1.3;
			padding: .3em 1.4em .5em .8em;
			width: 16%;
			max-width: 100%;
			box-sizing: border-box;
			margin: 0;
			border: 1px solid #aaa;
			box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
			border-radius: .5em;
			-moz-appearance: none;
			-webkit-appearance: none;
			appearance: none;
			background-color: #fff;
			background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
			  linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
			background-repeat: no-repeat, repeat;
			background-position: right .7em top 50%, 0 0;
			background-size: .65em auto, 100%;
		}
		.select-css::-ms-expand {
			display: none;
		}
		.select-css:hover {
			border-color: #888;
		}
		.select-css:focus {
			border-color: #aaa;
			box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
			box-shadow: 0 0 0 3px -moz-mac-focusring;
			color: #222;
			outline: none;
		}
		.select-css option {
			font-weight:normal;
		}
		
		.new_p_style {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		}
      </style>
   </head>
   <body style="background-color: #d3d3d3;">
      <div id="main-wrapper">
         <center>
            <h2>Update Data Records</h2>
            <img src="res/title_image.png" class="uncg"/><br>
         </center>
         <center>
            <p class="new_p_style">Select a table you want to update, then choose a specific row to update:</p>
            <form action="employee_update.php" method="post">
               <select class="select-css" name="table_select">
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
			   <input type="submit" class="select_table_button" name="submit_table" value="Select" />
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
            		echo "<br><center><input type='submit' class='select_row_button' name='select_row_btn' style='margin: 5px;' value='Update Row' readonly/><input type='submit' class='delete_row_button' name='delete_row_btn' style='margin: 5px;' value='Delete Row' readonly/></center>";
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
            		echo "<input type='submit' class='select_row_button' name='select_row_btn' style='margin: 5px;' value='Update Row' readonly/>";
					echo "<input type='submit' class='delete_row_button' name='delete_row_btn' style='margin: 5px;' value='Delete Row' readonly/>";
            		echo "</form>";
            		echo "</center>";
            	}
            }
         ?>
         <? 
			/*
				When the user deletes a row.
			*/
            if(isset($_POST['delete_row_btn'])) {
            	$offset_no = $_POST['radio_button'];
            	$table_name = $_SESSION["table_name"];
            	
            	if(empty($table_name)) {
            		echo '<script type="text/javascript"> alert("Cannot load table name!") </script>';
            	} 
            	
            	$query = "SELECT * FROM $table_name LIMIT 1 OFFSET " .($offset_no - 1). ";";
            	$query_set = mysqli_query($con, $query);
            	
            	$col_query = "SELECT * FROM $table_name LIMIT 1";
            	$col_query_res = mysqli_query($con, $col_query);
            	$col_size = mysqli_num_fields($col_query_res);
           
				
            	if (!$query_set) {
            		printf("Error: %s\n", mysqli_error($con));
            		exit();
            	}
            	
            	$row = mysqli_fetch_row($query_set);
            	$delete_query = "DELETE FROM ".$table_name." WHERE ";
				
				
            	echo "<br>";
            	echo "<form method='post'>";
            	echo "<table><tr>";
            	
            	$row_index = 1;
				
            	foreach($row as $cell) {
            		$property = mysqli_fetch_field($col_query_res);
            		$attribute_name = $property->name;
					
					if($row_index == $col_size) {
						$delete_query = $delete_query .$attribute_name. "=\"" .$cell. "\";";
					} else {
						$delete_query = $delete_query .$attribute_name. "=\"" .$cell. "\" AND ";
					}
            		
            		$row_index += 1;
            	}
				
				$real_delete = mysqli_query($con, $delete_query);
            	
            	if($real_delete) {
            		echo '<script type="text/javascript"> alert("Deletion successful!") </script>';
            	} else {
            		echo '<script type="text/javascript"> alert("Deletion failed!") </script>';
            	}
				
            	echo "</tr></table>";
            }
         ?>
         <? 
			/*
				When the user selects a row (presses the button to actually begin to 
				update).
			*/
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