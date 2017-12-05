<?php 
function printRows($result, $userID) {	
	$length=$result->num_rows;
	echo "<ul class='w3-ul w3-center'>";
	for ($index=0; $index<$length; $index++) {
		$row = $result->fetch_assoc();
		$payID = $row['payload_id'];
		$workNo = $row['workorder_no'];
		$pickup = $row['pickup_address'];
		$start = $row['start_time'];
		$dropoff = $row['dropoff_address'];
		$deadline = $row['deadline'];
		$completed = (int) $row['completed'];
		if ($completed == 0)
			$completion = "Pending";
		else 
			$completion = "Completed";
		$price = $row['contract_price'];

		echo "<li id='title' class='w3-bar'>
			<header class='w3-bar-item'>Payload: $payID Workorder #$workNo</header>
			<button class='w3-button w3-bar-item w3-right w3-red w3-round' onclick=\"deleteObject('1', '$payID', '$workNo');\">Delete</button>
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"editWorkorder('$payID', '$workNo', '$pickup', '$dropoff', '$start', '$deadline', '$price', $completed)\">Edit</button>    
			<button class='w3-button w3-bar-item w3-right w3-round' onclick=\"toggleView('w'+$index)\">View</button>	     
                      </li>
			<div class='w3-border w3-container w3-hide' id='w$index'>
			  <div class=w3-container>
			  <h4><b> Workorder details </b></h4>
			    <table class='w3-table'>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Pick-up Address</th>
			        <th style='font-weight:normal'>$pickup</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Drop off Address</th>
			        <th style='font-weight:normal'>$dropoff</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Start Time</th>
			        <th style='font-weight:normal'>$start</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Deadline</th>
			        <th style='font-weight:normal'>$deadline</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Contract Price</th>
			        <th style='font-weight:normal'>$price</th>
			      </tr>
			      <tr class='w3-border'>
			        <th style='font-weight:normal'>Completion Status</th>
			        <th style='font-weight:normal'>$completion</th>
			      </tr>
			    </table>
			  </div>
			</div>
		";
	}
	echo "</ul>";
}

require("global/db.php");
session_start();
$userID = $_SESSION['userID'];
$sql = "select * from Workorder where company_id = '$userID';";
$result = $link->query($sql);

if ($result->num_rows > 0)
	printRows($result, $userID);
else
	echo "<p> There are no workorders</p>";

$link->close();
?>
