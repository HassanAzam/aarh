<?php

require('connection.php');

//***   Nominee Script
//---------------------------------------------
// - All Nominee related queries will come here
// - This script will pNomineecess them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add Nominee Code
//-----------------------------------------------------------------------------------

// Confirm that it's add Nominee request
if (isset($_POST['action'])) {
if ($_POST['action']=="addnominee") {
	
	// getting incoming data via post
	// real_escape_string cleans the string fNomineem special characters
	
	$cnic = $mysqli->real_escape_string($_POST['cnic']);
	$partyid = $_POST['partyid'];	
	$constid = $_POST['constid'];
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO nominee (CNIC, party_ID, const_ID) VALUES (?, ?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("sii", $cnic, $partyid, $constid);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Nominee adddeed Successfully!";
}
}
//*** Add Nominee Code Ends
//-----------------------------------------------------------------------------------



// Return result
echo $result;
$mysqli->close();

?>