<?php
   session_start();
   require 'config.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Login Page</title>
      <!--<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">-->
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
            <form action="employee_insert.php" method="post">
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