<?php
session_start();
require("global/db.php");
$command = $_POST['instruct'];

//Create = 0
//Edit   = 1
//Delete = 2
if ($command == 2) {
	$payID = $_POST['payID'];
	$sql = "delete from Payload where payload_id = $payID;";
	
	if ($link->query($sql) === false) {
    $_SESSION['flash'] = "Unable to delete payload";
    $_SESSION['flash_color'] = "w3-red";
	}

} else {
	$userID = $_SESSION['userID'];
	$manifest = $_POST['manifest'];
	$assetV = $_POST['assetV'];
	$cargo = $_POST['cargotype'];
	$weight = $_POST['weight'];
	$contact = $_POST['contact'];

	//Create query
	if ($command == 0) {
		$sql = "insert into Payload(company_id, manifest, asset_value, cargo_type, gross_weight, contact_info) values ($userID, '$manifest', $assetV, '$cargo', $weight, '$contact');";
		if ($link->query($sql) === false) {
      $_SESSION['flash'] = "Unable to add payload";
      $_SESSION['flash_color'] = "w3-red";
		}
	//Edit query
	} else {
		$payID = $_POST['payID'];
		$sql = "update Payload set manifest='$manifest', asset_value='$assetV', cargo_type='$cargo', gross_weight='$weight', contact_info='$contact' where payload_id = $payID";
		if ($link->query($sql) === false) {
			$_SESSION['flash'] = "Payload edit failed";
      $_SESSION['flash_color'] = "w3-red";
		}
	}
}

header("Location: ../home.php");
$link->close();
?>
