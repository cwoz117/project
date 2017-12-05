<?php
session_start();
require("global/db.php");
$command = $_POST['instruct'];

//Create = 0
//Edit   = 1
//Delete = 2
if ($command == 2) {
	$locationID = $_POST['location'];
	$sql = "delete from Location where location_id = $locationID;";
	
	if ($link->query($sql) === false) {
		$_SESSION['flash'] = "Unable to delete location";
	}

} else {
	$userID = $_SESSION['userID'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];

	//Create query
	if ($command == 0) {
		$sql = "insert into Location(company_id, address, contact_number) values ($userID, '$address', '$contact');";
		if ($link->query($sql) === false) {
			$_SESSION['flash'] = "Unable to add Location";
		}
	//Edit query
	} else {
		$locID = $_POST['location'];
		$sql = "update Location set address = '$address', contact_number = '$contact' where location_id = $locID;";
		if ($link->query($sql) === false) {
			$_SESSION['flash'] = "Location edit failed";
		}
	}
}

header("Location: ../home.php");
$link->close();


?>
