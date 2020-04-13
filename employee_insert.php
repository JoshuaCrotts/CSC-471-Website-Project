<?php
   session_start();
   require 'config.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Add To Database</title>
      <!--<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">-->
      <link rel="stylesheet" href="css/styles.css">
      <meta charset="utf-8">
	  <style type="text/css">
	  .new_p_style {
	      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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
	  </style>
   </head>
   <body style="background-color:#7f8c8d;">
      <div id="main-wrapper">
         <center>
            <h2>Data Entry Form</h2>
            <img src="res/title_image.png" action="employee_insert.php" class="uncg"/>
         </center>
         <center>
            <p class="new_p_style">Select a table you want to insert into.</p>
            <form action="employee_insert.php" method="post">
               <select class="select-css" name="table_select" id="table_select">
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
               <input type="submit" class="select_table_button" name="submit_table", value="Select" />
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
            
				$_SESSION['has_ssn'] = False;
				
            	// Display each row with a label and an input field.
            	while ($property = mysqli_fetch_field($col_query_res)) {
            		// Display the labels then the respective input fields.
            		echo "<label>" . $property->name . "</label><br>";
            		echo "<input name=" . $property->name . " style='width: 98%;' type='text' class='inputvalues' placeholder='' required/><br><br>";
					
					// If there's an SSN field, mark it as seen in the session so we can
					// pain-stakingly error-check it later.
					if($property->name == 'SSN' || $property->name == 'E_SSN') {
						$_SESSION['has_ssn'] = True;
					}
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
				
				// Stupid input validation is gonna have to be hard-coded.
				if($_SESSION['has_ssn'] == True) {
					
					// Grab either SSN field if they exist.
					$ssn_field = $_POST['SSN'] | $_POST['E_SSN'];
					
					if(strlen($ssn_field) != 9) {
						echo '<script type="text/javascript"> alert("SSN must be 9 numbers!") </script>';
						echo '<input type="submit" id="back_button" value="<< Back" onclick="document.location.href="index.php"" required/>';
						return;
					}	 
				}

            	
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
            	
            	$real_insert = mysqli_query($con, $insert_query);
				
            	if($real_insert) {
            		echo '<script type="text/javascript"> alert("Insertion successful!") </script>';
            	} else {
            		echo '<script type="text/javascript"> alert("Insertion failed!") </script>';
            	}
            }
            ?>
         <input type="submit" id="back_button" value="<< Back" onclick="document.location.href='index.php'" required/>	
      </div>
   </body>
</html>