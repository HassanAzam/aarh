<?php

//Credentials

$user = 'aarh';
$pw = 'aarh';
$db = 'aarh';

// Try and connect to the database
$mysqli = new mysqli('localhost',$user,$pw,$db);

// If connection was not successful, handle the error
if($mysqli->connect_error) {
    // Handle error
	die("Connection to DB failed: " . $conn->connect_error);
}
else
{
	//echo 'Success connecting to DB';
}

?>

