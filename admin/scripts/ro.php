<?php

require('connection.php');

//***   RO Script
//---------------------------------------------
// - All RO related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add RO Code
//-----------------------------------------------------------------------------------

// Confirm that it's add RO request
if (isset($_POST['action'])) {
if ($_POST['action']=="addro") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$cnic = $mysqli->real_escape_string($_POST['cnic']);
	$pollid = $_POST['pollid'];	
	$prkey = $mysqli->real_escape_string($_POST['prkey']);
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO ro (CNIC, poll_ID, proctoringKey) VALUES (?, ?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("sis", $cnic, $pollid, $prkey);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "RO adddeed Successfully!";
}
}
//*** Add RO Code Ends
//-----------------------------------------------------------------------------------



//*** List RO Ends
//-----------------------------------------------------------------------------------

// Return result
echo $result;
$mysqli->close();

?>