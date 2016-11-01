<?php

require('connection.php');

//***   Voter Script
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
if ($_POST['action']=="addvoter") {
	
	// getting incoming data via post
	// real_escape_string cleans the string from special characters
	
	$cnic = $mysqli->real_escape_string($_POST['cnic']);
	$name = $mysqli->real_escape_string($_POST['name']);
	$gender = $mysqli->real_escape_string($_POST['gender']);
	$address = $mysqli->real_escape_string($_POST['address']);
	$mobile = $mysqli->real_escape_string($_POST['mobile']);
	$cityid = $_POST['cityID'];
	$townid = $_POST['townid'];
	echo $cityid;
	//preparing query
	$q = $mysqli->prepare("INSERT INTO voter (CNIC, voter_Name, gender, address, mobileNumber, city_ID, town_ID) VALUES (?, ?, ?, ?, ?, ?, ?)");
	
	//binding params - for strict checking of the type of incoming data 's' for string 'i' for integer
	$q->bind_param("sssssii", $cnic, $name, $gender, $address, $mobile, $cityid, $townid);
	
	//execute query
	$q->execute();
	
	//close query connection_aborted
	$q->close();
	
	$result = "Voter addded Successfully!";
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
	//preparing query
	$q = "SELECT * FROM voter WHERE CNIC = '$cnic'";		//return total num of rows in voter table
	
	$r = $mysqli->query($q); //executing query
	
	$result = $r->num_rows;
	
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