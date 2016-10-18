<?php

require('connection.php');

//***   City Script
//---------------------------------------------
// - All City related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add City Code
//-----------------------------------------------------------------------------------

// Confirm that it's add city request
if (isset($_POST['action'])) {
if ($_POST['action']=="addcity") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$name = $mysqli->real_escape_string($_POST['cityName']);
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO city (city_Name) VALUES (?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("s", $name);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "City adddeed Successfully!";
}
}
//*** Add City Code Ends
//-----------------------------------------------------------------------------------


//*** Count total num of Cities
//-----------------------------------------------------------------------------------

// Confirm that it's count cities request
if(isset($_POST['countcities'])) {
if ($_POST['countcities']=="countcities") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM city";		//return total num of rows in city table
	
	$r = $mysqli->query($q); //executing query
	
	$count = $r->fetch_row();
	
	$result = $count[0];
	
}
}
//*** Count cities Code Ends
//-----------------------------------------------------------------------------------


//*** return list of Cities
//-----------------------------------------------------------------------------------

// Confirm that it's list cities request
if(isset($_POST['listcities'])) {
if ($_POST['listcities']=="listcities") {
	
	//preparing query
	$q = "SELECT * FROM city";		//return name,id of all cities in DB
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			$result = '<option>Select City</option>';
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['city_ID'];
				$result .= "'>";
				$result .= $row['city_Name'];
				$result .= "</option>";
			}
			
		} 
		else {
			$result = "No Cities in DB";
		}
	
	
	
}
}
//*** List City Ends
//-----------------------------------------------------------------------------------

// Return result
echo $result;
$mysqli->close();

?>