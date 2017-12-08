<?php
session_start();

$userID = $_SESSION['userID'];
$command = (int) $_POST['command'];
$prov = $_POST['prov'];
$reg = $_POST['reg'];
$pvdr = $_POST['provider'];
$polNum = $_POST['polNum'];
$plate = $_POST['plate'];
$make = $_POST['make'];
$model = $_POST['model'];
$trailer = $_POST['trailer'];
$year =  $_POST['year'];

$conID;

echo "Trailer Type is $trailer <br>";

require("global/db.php");
header("Location: ../profile.php");

$sql = "select contractor_id from Driver where '$userID' = user_id;";

$result = $link->query($sql);
$row = $result->fetch_assoc();
$conID = $row['contractor_id'];

#echo "The command is : $command <br>";
#echo "Registration is : $reg <br>";
#echo "Past checks <br>";

#Checking which command needed
#Command 0 is add
if ($command == 0) {

	####Checks the primary key not already used####
	#TO DO implement error message#
	$sql = "select * from Truck where '$reg' = registration and $conID = contractor_id;";
	$result=$link->query($sql);

	if ($result->num_rows > 0) {
		echo "Check failed <br>";
    $_SESSION['flash'] = "Registration number is already in use";
    $_SESSION['flash_color'] = "w3-red";
		exit();	
	}
	##################################################


	$sql = "insert into Truck(registration, contractor_id, provider, policy_num, plate_num, make, model, year, province, trailer_type) values ('$reg', $conID, '$pvdr', '$polNum', '$plate', '$make', '$model', '$year', '$prov', '$trailer');";

	if ($link->query($sql) === true) {
		echo "Success";
	} else {
		echo "Failed";
		$_SESSION['flash'] = "Error: Truck could not be added";
    $_SESSION['flash_color'] = "w3-red";
	}
} else {
#Command is to edit

	$sql = "update Truck set provider = '$pvdr', policy_num = '$polNum', plate_num = '$plate', make = '$make', model = '$model', trailer_type = '$trailer', year = '$year', province = '$prov' where registration = $reg;";


	if ($link->query($sql) === true) {
		echo "Success";
	} else {
		echo "Failure";
		$_SESSION['flash'] = "Error: Truck could not be modified";
    $_SESSION['flash_color'] = "w3-red";
	}
}
$link->close();
