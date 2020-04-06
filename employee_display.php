<?php
   session_start();
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
         thead {
         background-color: #4CAF50;
         color: white;
         }
         .customrow:hover {
         background-color: #f5f5f5;
         }
      </style>
   </head>
   <body style="background-color: #a9a9a9;">
      <div id="main-wrapper">
         <center>
            <h2>View Employee Records</h2>
            <img src="res/title_image.png" class="uncg"/><br>
            <p>Select a table to view:</p>
            <form action="employee_display.php" method="post">
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
               <input type="submit" name="submit_table", value="Select" /><br><br>
            </form>
         </center>
         <?
            if(isset($_POST['order_by_button'])) {
            	$table_name = $_SESSION['table_name'];
            	
            	if(isset($_POST['order_by'])) {
            		
            		$order_by_col = $_POST['order_by'];
            		
            		echo "<form method='post'>";
            		echo "<center><input type='submit' name='order_by_button' value='Order By' readonly/></center>";
            		echo "<br>";
            		
            		// We want the col names first so we can order by the first field.
            		$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
            		$col_query_res = mysqli_query($con, $col_query);
            		
            		//	If the column button is set, then we'll order it by that.
            		if ($order_by_col) {
            			$query = "SELECT * FROM " .$table_name. " ORDER BY " .$order_by_col. ";";
            		}
            		
            		$query_res = mysqli_query($con, $query);
            
            		$row_index = 1;
            
            		// Begin printing the headers of the rows.
            		echo "<table><thead><tr>";
            		while ($property = mysqli_fetch_field($col_query_res)) {
            			echo "<td><input type='radio' name='order_by' class='inputvalues' value='". $property->name. "'/>" .$property->name. "</td>";
            			$row_index += 1;
            		}
            		
            		echo "</tr></thead><tbody>";
            		
            		// Fetch each row and print the corresponding data.
            		while($row = mysqli_fetch_row($query_res)) {
            			echo "<tr class='customrow'>";
            			
            			foreach($row as $cell) {
            				echo "<td>" .$cell. "</td>";
            			}
            			echo "</tr>";
            		}
            		echo "</tbody></table></form>";
            		
            	} else {
            		echo "ERROR";
            	}
            }
            ?>
         <?
            if(isset($_POST['submit_table'])) {
            	// TODO: Prepared statement tf out of this.
            	
            	if(!$_POST['table_select']) {
            		echo '<script type="text/javascript"> alert("You have to select a table!") </script>';
            	} else {
            		$_SESSION['table_name'] = $_POST['table_select'];
            		$table_name = $_SESSION['table_name'];
            		
            		echo "<form method='post'>";
            		echo "<center><input type='submit' name='order_by_button' value='Order By' readonly/></center>";
            		echo "<br>";
            		
            		// We want the col names first so we can order by the first field.
            		$col_query = "SELECT * FROM " .$table_name. " LIMIT 1";
            		$col_query_res = mysqli_query($con, $col_query);
            		
            		//	If the column button is set, then we'll order it by that.
            		if ($order_by_col) {
            			$query = "SELECT * FROM " .$table_name. " ORDER BY " .$order_by_col. ";";
            		} else {
            			$query = "SELECT * FROM " .$table_name;
            		}
            		
            		$query_res = mysqli_query($con, $query);
            
            		$row_index = 1;
            
            		// Begin printing the headers of the rows.
            		echo "<table><thead><tr>";
            		while ($property = mysqli_fetch_field($col_query_res)) {
            			echo "<td><input type='radio' name='order_by' class='inputvalues' value='". $property->name. "'/>" .$property->name. "</td>";
            			$row_index += 1;
            		}
            		
            		echo "</tr></thead><tbody>";
            		
            		// Fetch each row and print the corresponding data.
            		while($row = mysqli_fetch_row($query_res)) {
            			echo "<tr class='customrow'>";
            			
            			foreach($row as $cell) {
            				echo "<td>" .$cell. "</td>";
            			}
            			echo "</tr>";
            		}
            		echo "</tbody></table></form>";
            	}
            }
            ?>
         <input type="submit" id="back_button" value="<< Back" onClick="document.location.href='index.php'"/>
      </div>
   </body>
</html>