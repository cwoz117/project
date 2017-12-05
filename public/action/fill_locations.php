<?php

function printRows($result, $userID) {
	$length=$result->num_rows;
	echo "<ul class='w3-ul w3-center'>";
	for ($index=0; $index<$length; $index++) {
		$row = $result->fetch_assoc();
		$locID = $row['location_id'];
		$address = $row['address'];
		$contact = $row['contact_number'];

		echo "<li id='title' class='w3-bar'>
			<header class='w3-bar-item'>Location ID: $locID</header>
			<button class='w3-button w3-bar-item w3-right w3-red w3-round' onclick=\"deleteObject('2', '$locID')\">Delete</button>
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"editLocation('$locID', '$address', '$contact')\">Edit</button>    
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"toggleView('l'+$index)\">View</button>	     
                      </li>
			<div class='w3-border w3-container w3-hide' id='l$index'>
			  <div class=w3-container>
			  <h4><b> Location details </b></h4>
			    <table class='w3-table'>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Address</th>
			        <th style='font-weight:normal'>$address</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Contact Number</th>
			        <th style='font-weight:normal'>$contact</th>
			      </tr>
			    </table>
			  </div>
			</div>
		";
	}
	echo "</ul>";
}

session_start();
require("global/db.php");
$userID = $_SESSION['userID'];
$sql = "select * from Location where company_id = $userID;";
$result = $link->query($sql);

if ($result->num_rows > 0)
	printRows($result, $userID);
else
	echo "<p> There are no Locations. </p>";





?>
