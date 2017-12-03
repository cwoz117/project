<?php
require("global/db.php");

$regi = $_POST['registration'];

$sql = "delete from Truck where registration = $regi;";

if ($link->query($sql) === true) {
	echo "Delete Successful";
} else {
	echo "Delete Failed";

}

header("Location: ../profile.php");
$link.close();
?>
