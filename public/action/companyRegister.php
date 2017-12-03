<?php
$user = $_POST["username"];
$pass = $_POST["password"];
$repass = $_POST["repass"];
$compName = (int) $_POST["companyname"];
$bank = (int) $_POST["bankinfo"];
$addr = $_POST["address"];
	
if ($pass === $repass) {
	
} else {
	#ERROR HERE
	header("Location: ../home.php");
}

require("global/db.php");
	
$sql = "select username from User;"
$result = $link->query($sql);

while ($row = $result->fetch_assoc()) {
	if ($user == $row["username"]) {
		#ERROR HERE
		header("Location: ../home.php");
	}
}

#Inserting entry into users
$sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 1);";

#Do I need error checking here?
$link->query($sql);

#Getting highest user_id (assuming that highest ID = last created)
$sql = "select max(user_id) from User;";

$result = $link->query($sql);
$userID = (int) $result;

#
$sql = "insert into Company (user_id, name, banking_info, address) values ($userID, '$compName', $bank, '$addr');";

#Need error check here?
$link->query($sql);

$link->close();
?>
