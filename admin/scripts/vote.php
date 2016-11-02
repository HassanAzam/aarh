<?php

require('connection.php');

//***   Vote Script
//---------------------------------------------
// - All Voter related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add Voter Code
//-----------------------------------------------------------------------------------

// Confirm that it's add voter request
if (isset($_POST['action'])) {
if ($_POST['action']=="addvote") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$cnic = $_POST['cnic'];
	$partyid = $_POST['partyid'];
	$pollid = $_POST['pollid'];

	$q1 = "Select nominee_ID from nominee where party_ID = '$partyid' and const_ID = (Select const_ID from town where town_ID = (Select town_ID from pollingstation where poll_ID = '$pollid' ))";
	$r = $mysqli->query($q1);
	$nominee = $r->fetch_row();
	$nomineeid = $nominee[0];
	
	//preparing query
	$q = $mysqli->prepare("INSERT INTO vote (CNIC, poll_ID, nominee_ID) VALUES (?, ?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("sii", $cnic, $pollid, $nomineeid);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = 1;
}
}
//*** Add Voter Code Ends
//-----------------------------------------------------------------------------------


//*** Count total num of voters
//-----------------------------------------------------------------------------------

// Confirm that it's count voter request
if(isset($_POST['countvoter'])) {
if ($_POST['countvoter']=="countvoter") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM voter";		//return total num of rows in voter table
	
	$r = $mysqli->query($q); //executing query
	
	$count = $r->fetch_row();
	/*
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			}
		} 
		else {
			echo "0 results";
		}
	*/
	
	$result = $count[0];
}
}
//*** Add Voter Code Ends
//-----------------------------------------------------------------------------------


if(isset($_POST['action'])) {
if ($_POST['action']=="cnicexist") {
	$cnic = $_POST['cnic'];
	$pollid = $_POST['pollid'];
	//preparing query
	$q = "Select poll_ID from pollingstation WHERE town_ID = (SELECT town_ID FROM voter WHERE CNIC = '$cnic')";		//return total num of rows in voter table
	$r = $mysqli->query($q); //executing query
	$a = $r->num_rows;
	$poll = $r->fetch_row();
	$poll = $poll[0];
	
	if($poll == $pollid)
		$result = 1;
	else
		$result = 2;

        if($a == 0)
		$result = 0;
	
}
}

if(isset($_POST['action'])) {
if ($_POST['action']=="getvotername") {
	$cnic = $_POST['cnic'];
	//preparing query
	$q = "SELECT voter_Name FROM voter WHERE CNIC = '$cnic'";		//return total num of rows in voter table
	
	$r = $mysqli->query($q); //executing query
	
	$result = $r->fetch_row();
	$result = $result[0];
	
}
}





// Return result

echo $result;
$mysqli->close();

?>