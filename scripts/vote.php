<?php

require('connection.php');

//***   vote Script
//---------------------------------------------
// - All vote related queries will come here
// - This script will process them and communicate to DB
// - And return result in $result;
//---------------------------------------------
//***

$result = '';

//*** Add Vote Code
//-----------------------------------------------------------------------------------


//*** Add Vote Code Ends
//-----------------------------------------------------------------------------------


//*** Count total num of votes
//-----------------------------------------------------------------------------------

// Confirm that it's count cities request
if(isset($_POST['totalvotes'])) {
if ($_POST['totalvotes']=="totalvotes") {
	
	//preparing query
	$q = "SELECT COUNT(*) FROM votes";		//return total num of rows in town table
	
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


//-----------------------------------------------------------------------------------

// Return result
echo $result;
$mysqli->close();

?>