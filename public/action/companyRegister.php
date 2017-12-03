<?php
$user = $_POST["username"];
$pass = $_POST["password"];
$repass = $_POST["repass"];
$compName = $_POST["companyname"];
$bank = (int) $_POST["bankinfo"];
$addr = $_POST["address"];
	
if ($pass === $repass) {
	
} else {
	#ERROR HERE
	header("Location: ../home.php");
}

require("global/db.php");
	
$sql = "select username from User;";
$result = $link->query($sql);

while ($row = $result->fetch_assoc()) {
	if ($user == $row["username"]) {
		#ERROR HERE
		header("Location: ../home.php");
	}
}

#Inserting entry into users
$sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 1);";

#Retrieving the ID of last insert
$userID;

if ($link->query($sql) === true) {
	$userID = (int) $link->insert_id;
	echo $userID;
} else {
	echo "Error encountered";
}


$sql = "insert into Company (user_id, name, banking_info, address) values ($userID, '$compName', $bank, '$addr');";

#Need error check here?
$link->query($sql);

$link->close();

#Correct redirect --> Need message?
header("Location: ../home.php");

?>
