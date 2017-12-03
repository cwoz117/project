<?php

$userID = $_SESSIONS['userID'];
$prov = $_POST['provider'];
$reg = $_POST['reg'];
$ins = $_POST['insurance'];
$pvdr = $_POST['provider'];
$polNum = $_POST['polNum'];
$plate = $_POST['plate'];
$make = $_POST['make'];
$model = $_POST['model'];
$trailer = $_POST['trailer'];
$year = $_POST['year'];

require("global/db.php");

#How do I insert a year value???
$sql = "insert into Truck(registration, contractor_id, provider, policy_num, plate_num, make, model, year, province, trailer_type) values ('$reg', $userID, '$prov', '$polNum', '$plate', '$make', '$model', '$year', '$prov', '$trailer');";

if ($link->query($sql) === true) {
	echo "Success";
} else {
	echo "Failure";
}

$link->close();
