<?php

require('connection.php');

//***   Const Script
//---------------------------------------------
// - All Const related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add Const Code
//-----------------------------------------------------------------------------------

// Confirm that it's add const request
if (isset($_POST['action'])) {
if ($_POST['action']=="addconst") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$name = $mysqli->real_escape_string($_POST['constname']);
	$cityid = $mysqli->real_escape_string($_POST['cityid']);
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO constituency (const_Name,city_ID) VALUES (?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("si", $name, $cityid);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Constituency added Successfully!";
}
}
//*** Add City Code Ends
//-----------------------------------------------------------------------------------


//*** Count total num of Const
//-----------------------------------------------------------------------------------

// Confirm that it's count cities request
if(isset($_POST['countconst'])) {
if ($_POST['countconst']=="countconst") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM constituency";		//return total num of rows in city table
	
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
if(isset($_POST['listconst'])) {
if ($_POST['listconst']=="listconst") {
	
	$cityid = $_POST['cid'];
	
	//preparing query
	$q = "SELECT * FROM constituency WHERE city_ID='$cityid'";		//return name,id of all cities in DB
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			$result = '<option>Select Constituency</option>';
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['const_ID'];
				$result .= "'>";
				$result .= $row['const_Name'];
				$result .= "</option>";
			}
			
		} 
		else {
			$result = "<option>No Constituency in this city</option>";
		}
	
	
	
}
}
//*** List City Ends
//-----------------------------------------------------------------------------------

// Return result
echo $result;
$mysqli->close();

?>