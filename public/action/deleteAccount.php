<?php
session_start();

$userID = $_SESSION['userID'];
$sql = "DELETE FROM User WHERE user_id='$userID'";
require("global/db.php");
if($link->query($sql)==true) {
    header("Location: ../action/logout.php");
}else{
    $_SESSION['flash'] = "Failed to delete account.";
    header("Location: ../security_account_settings.php");
}

?>