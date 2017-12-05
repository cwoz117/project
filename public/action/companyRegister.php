<?php
session_start();
$user = $_POST["username"];
$pass = $_POST["password"];
$compName = $_POST["companyname"];
$bank = $_POST["bankinfo"];
$addr = $_POST["address"];
	
require("global/db.php");

$sql = "select username from User where username='$user';";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['flash'] = "That Username is already in use";
  $_SESSION['flash_color'] = " w3-red";
  header("Location: ../index.php");
  $link->close();
	exit();
}

#Inserting entry into users
$sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 1);";

#Retrieving the ID of last insert
$userID;
if ($link->query($sql) === true) {
	$userID = (int) $link->insert_id;
} else {
  $_SESSION['flash'] = "This company could not be entered into the database. Error: $link->error";
  $_SESSION['flash_color'] = " w3-red";
}



$sql = "insert into Company (user_id, name, banking_info, address) values ($userID, '$compName', $bank, '$addr');";

if ($link->query($sql) === false) {
  $_SESSION['flash_color'] = " w3-red";
  $_SESSION['flash'] = "Company could not be created";
  $sql = "delete from User where user_id = '$userID';";
  $link->query($sql);


} else {
  $_SESSION['flash_color'] = " w3-green";
  $_SESSION['flash'] = "Company created successfully";
}
$link->close();

header("Location: ../index.php");
?>
