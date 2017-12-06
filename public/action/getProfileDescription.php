<?php
session_start();
require("global/db.php");
$userID = $_SESSION["userID"];
$sql = "SELECT * FROM User WHERE user_id='$userID'";
$result = $link->query($sql);
$row = $result->fetch_assoc();
echo $row["profile_text"];
?>