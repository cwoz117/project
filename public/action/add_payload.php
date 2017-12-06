<?php
session_start();
require("global/db.php");
$userID = $_SESSION['userID'];
$manifest = $_POST['manifest'];
$assetV = $_POST['assetV'];
$cargo = $_POST['cargotype'];
$weight = $_POST['weight'];
$contact = $_POST['contact'];


$sql = "insert into Payload(company_id, manifest, asset_value, cargo_type, gross_weight, contact_info) values ($userID, '$manifest', $assetV, '$cargo', $weight, '$contact');";

if ($link->query($sql) === false) {
	$_SESSION['flash'] = "Unable to add payload";
}


header("Location: ../home.php");
$link->close();
?>
