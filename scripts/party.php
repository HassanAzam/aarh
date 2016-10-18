<?php

require('connection.php');

//***   Party Script
//---------------------------------------------
// - All Party related queries will come here
// - This script will pPartycess them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add Party Code
//-----------------------------------------------------------------------------------

// Confirm that it's add Party request
if (isset($_POST['action'])) {
if ($_POST['action']=="addparty") {
	
	// getting incoming data via post
	// real_escape_string cleans the string fPartym special characters
	
	$partyname = $mysqli->real_escape_string($_POST['partyname']);
	
	$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
	$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
	move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO party (party_Name, party_Flag) VALUES (?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("ss", $partyname, $targetPath);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Party adddeed Successfully!";
}
}
//*** Add Party Code Ends
//-----------------------------------------------------------------------------------



// Return result
echo $result;
$mysqli->close();

?>