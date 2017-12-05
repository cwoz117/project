<?php 
function printRows($result, $userID) {
	$length=$result->num_rows;
	echo "<ul class='w3-ul w3-center'>";
	for ($index=0; $index<$length; $index++) {
		$row = $result->fetch_assoc();
		$payID = $row['payload_id'];
		$manifest = $row['manifest'];
		$assetV = $row['asset_value'];
		$cargo = $row['cargo_type'];
		$weight = $row['gross_weight'];
		$contact = $row['contact_info'];

		echo "<li id='title' class='w3-bar'>
			<header class='w3-bar-item'>Payload ID: $payID</header>
			<button class='w3-button w3-bar-item w3-right w3-red w3-round' onclick=\"deleteObject($payID, 0)\">Delete</button>
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"editPayload($payID, '$manifest', '$assetV', '$cargo', '$weight', '$contact')\">Edit</button>    
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"toggleView('p'+$index)\">View</button>	     
                      </li>
			<div class='w3-border w3-container w3-hide' id='p$index'>
			  <div class=w3-container>
			  <h4><b> Payload details </b></h4>
			    <table class='w3-table'>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Asset Value</th>
			        <th style='font-weight:normal'>$assetV</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Cargo Type</th>
			        <th style='font-weight:normal'>$cargo</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Gross Weight</th>
			        <th style='font-weight:normal'>$weight</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Contact Information</th>
			        <th style='font-weight:normal'>$contact</th>
			      </tr>
			    </table>
			    <h3 class='w3-center'>Manifest</h3>
			    <p>$manifest</p>
			  </div>
			</div>
		";
	}
	echo "</ul>";
}

session_start();
require("global/db.php");
$userID = $_SESSION['userID'];
$sql = "select * from Payload where company_id = '$userID';";
$result = $link->query($sql);

if ($result->num_rows > 0)
	printRows($result, $userID);
else
	echo "<p> There are no payloads. </p>";

$link->close();

?>
