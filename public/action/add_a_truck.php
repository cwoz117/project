<?php
session_start();

$userID = $_SESSION['userID'];
$prov = $_POST['provider'];
$reg = $_POST['reg'];
$ins = $_POST['insurance'];
$pvdr = $_POST['provider'];
$polNum = $_POST['polNum'];
$plate = $_POST['plate'];
$make = $_POST['make'];
$model = $_POST['model'];
$trailer = $_POST['trailer'];
$year =  $_POST['year'];

$conID;

require("global/db.php");

echo "This is userID '$userID'.<br>";

$sql = "select contractor_id from Driver where '$userID' = user_id;";

$conID = (int) $link->query($sql);
echo $conID;

	

$sql = "insert into Truck(registration, contractor_id, provider, policy_num, plate_num, make, model, year, province, trailer_type) values ('$reg', $conID, '$prov', '$polNum', '$plate', '$make', '$model', '$year', '$prov', '$trailer');";

if ($link->query($sql) === true) {
	echo "Success";
} else {
	echo "FAILED value returned: ";
	echo $year;
}

$link->close();
