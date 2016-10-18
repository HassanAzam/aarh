<?php

require('connection.php');

//***   town Script
//---------------------------------------------
// - All town related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add town Code
//-----------------------------------------------------------------------------------

// Confirm that it's add town request
if (isset($_POST['action'])) {
if ($_POST['action']=="addpoll") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$name = $mysqli->real_escape_string($_POST['pollname']);
	$pollid = $_POST['pollid'];
	$townid = $_POST['townid'];
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO town (poll_ID,poll_Name,town_ID) VALUES (?, ?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("isi", $name, $pollid, $townid);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Polling Station added Successfully!";
}
}
//*** Add town Code Ends
//-----------------------------------------------------------------------------------


//*** Count total num of town
//-----------------------------------------------------------------------------------

// Confirm that it's count cities request
if(isset($_POST['counttown'])) {
if ($_POST['counttown']=="counttown") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM town";		//return total num of rows in town table
	
	$r = $mysqli->query($q); //executing query
	
	$count = $r->fetch_row();
	
	$result = $count[0];
	
}
}
//*** Count Towns Code Ends
//-----------------------------------------------------------------------------------


//*** return list of Towns
//-----------------------------------------------------------------------------------

// Confirm that it's list cities request
if(isset($_POST['listtown'])) {
if ($_POST['listtown']=="listtown") {
	
	$cityid = $_POST['cid'];
	
	//preparing query
	$q = "SELECT * FROM town WHERE city_ID='$cityid'";		//return name,id of all cities in DB
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			$result = '<option>Select Town</option>';
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['town_ID'];
				$result .= "'>";
				$result .= $row['town_Name'];
				$result .= "</option>";
			}
			
		} 
		else {
			$result = "No town in DB";
		}
	
	
	
}
}
//*** List town Ends


if(isset($_POST['listalltowns'])) {
if ($_POST['listalltowns']=="listalltowns") {
	
	
	//preparing query
	$q = "SELECT * FROM town";		//return name,id of all cities in DB
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			$result = '<option>Select Town</option>';
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['town_ID'];
				$result .= "'>";
				$result .= $row['town_Name'];
				$result .= "</option>";
			}
		} 
		else {
			$result = "No town in DB";
		}
	
	
	
}
}

//-----------------------------------------------------------------------------------

// Return result
echo $result;
$mysqli->close();

?>