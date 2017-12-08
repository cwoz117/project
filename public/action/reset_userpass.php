<?php
session_start();
$user=$_POST['usern'];
$pass=$_POST['pass'];
echo "Hello? <br>";
require("global/db.php");

header("Location: ../index.php");

$sql = "select * from User where username = '$user';";
$result = $link->query($sql);
if ($result->num_rows == 0) {
	echo "Username doesn't exists";
  $_SESSION['flash'] = "Username does not exist";
  $_SESSION['flash_color'] = "w3-red";
	exit();
}


$sql = "update User set password = '$pass' where username = '$user';";


if ($link->query($sql) === true) {
	echo "Success <br>";
} else {
	echo "Failure <br>";
	$_SESSION['flash'] = "Password could not be reset";
  $_SESSION['flash_color'] = "w3-red";
}
 


$link.close();

?>
