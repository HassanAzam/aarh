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
if(isset($_POST['action'])) {
if ($_POST['action']=="totalvotescount") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM vote";		//return total num of rows in voter table
	
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


if(isset($_POST['action'])) {
if ($_POST['action']=="constvotescount") {
	
	$constid = $_POST['constid'];
	
	//Golden Query for counting votes
			$query = "SELECT C.const_Name, P.party_Name, COUNT( V.vote_ID ) AS votes
					FROM party P, vote V, nominee N, constituency C
					WHERE V.nominee_ID = N.nominee_ID
					AND N.party_ID = P.party_ID
					AND N.const_ID = C.const_ID
					AND C.const_ID =  '$constid'
					GROUP BY C.const_Name, P.party_Name";
					
			$re = $mysqli->query($query);
			$u=0;
			while($row = $re->fetch_assoc())
			{
				$partyNames[$u] = $row['party_Name'];
				$partyVotes[$u++] = $row['votes'];
			}

	$result = array();
	$result[0] = $partyNames;
	$result[1] = $partyVotes;
	
	//return array from php to js
}
}





// Return result

echo $result;
$mysqli->close();

?>