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
	
	$pname = $mysqli->real_escape_string($_POST['pollname']);
//	$pollid = $_POST['pollid'];
	$townid = $_POST['townid'];
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO pollingstation (poll_Name,town_ID) VALUES (?, ?)");
	
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("si", $pname, $townid);
	
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Polling Station added Successfully!";
}
}
//*** Add town Code Ends
//-----------------------------------------------------------------------------------


//*** return all of Towns
//-----------------------------------------------------------------------------------



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

if(isset($_POST['action'])) {
if ($_POST['action']=="listallpollforro") {
	
	$cnic = $_POST['cnic'];
	
	//preparing query
	$q = "SELECT * FROM pollingstation WHERE town_ID = (SELECT town_ID from voter WHERE CNIC = '$cnic')";
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['poll_ID'];
				$result .= "'>";
				$result .= $row['poll_Name'];
				$result .= "</option>";
			}
		} 
		else {
			$result = "No poll in DB";
		}
	
	
	
}
}

// Return result
echo $result;
$mysqli->close();

?>