<?php
$user=$_POST['usern'];
$pass=$_POST['pass'];
echo "Hello? <br>";
require("global/db.php");
header("Location: ../index.php");
$sql = "update User set password = '$pass' where username = '$user';";

if ($link->query($sql) === true)
	echo "Success <br>";
else
	echo "Failure <br>";
 


$link.close();

?>
