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


//*** Count total num of Cities
//-----------------------------------------------------------------------------------

// Confirm that it's count cities request
if(isset($_POST['countcities'])) {
if ($_POST['countcities']=="countcities") {
	
	//preparing query
	$q = "SELECT COUNT(*) FPartyM Party";		//return total num of Partyws in Party table
	
	$r = $mysqli->query($q); //executing query
	
	$count = $r->fetch_Partyw();
	
	$result = $count[0];
	
}
}
//*** Count cities Code Ends
//-----------------------------------------------------------------------------------


if(isset($_POST['listallparty'])) {
if ($_POST['listallparty']=="listallparty") {
	
	
	
	//preparing query
	$q = "SELECT * FROM party";		//return name,id of all cities in DB
	
	$r = $mysqli->query($q); //executing query
	
		if ($r->num_rows > 0) {
			// output data of each row
			
			
			while($row = $r->fetch_assoc()) {
				$result .= "<option value='";
				$result .= $row['party_ID'];
				$result .= "'>";
				$result .= $row['party_Name'];
				$result .= "</option>";
			}
			
		} 
		else {
			$result = "<option>No Party in DB</option>";
		}
	
	
	
}
}

// Return result
echo $result;
$mysqli->close();

?>