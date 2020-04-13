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
		.order_by_button_id {
			box-shadow:inset 0px 1px 0px 0px #fff6af;
			background:linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
			background-color:#ffec64;
			border-radius:6px;
			border:1px solid #ffaa22;
			display:inline-block;
			cursor:pointer;
			color:#333333;
			font-family:Arial;
			font-size:13px;
			font-weight:bold;
			padding:2px 10px;
			text-decoration:none;
			text-shadow:0px 1px 0px #ffee66;
		}
		.order_by_button_id:hover {
			background:linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
			background-color:#ffab23;
		}
		.order_by_button_id:active {
			position:relative;
			top:1px;
		}
		.new_p_style {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		}		
      </style>
   </head>
   <body style="background-color: #a9a9a9;">
      <div id="main-wrapper">
         <center>
            <h2>View Employee Records</h2>
            <img src="res/title_image.png" class="uncg"/><br>
            <p class="new_p_style">Select a table to view:</p>
            <form action="employee_display.php" method="post">
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
               <input type="submit" class="select_table_button" name="submit_table", value="Select" /><br><br>
            </form>
         </center>
         <?
            if(isset($_POST['order_by_button'])) {
            	$table_name = $_SESSION['table_name'];
            	
            	if(isset($_POST['order_by'])) {
            		
            		$order_by_col = $_POST['order_by'];
            		
            		echo "<form method='post'>";
            		echo "<center><input type='submit' class='order_by_button_id' name='order_by_button' value='Order By' readonly/></center>";
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
            		echo '<script type="text/javascript"> alert("Error: did you try to order by without selecting an attribute?") </script>';
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
            		echo "<center><input type='submit' class='order_by_button_id' name='order_by_button' value='Order By' readonly/></center>";
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