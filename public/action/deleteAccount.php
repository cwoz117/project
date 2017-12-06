<?php
session_start();
require ("global/db.php");

$userID = $_SESSION['userID'];

$sql = "DELETE FROM User WHERE user_id='$userID'";

if ($link->query($sql)==true) {
    $link->close();
    header("Location: ../action/logout.php");
} else{
    $link->close();
    $_SESSION['flash'] = "Failed to delete account.";
    header("Location: ../security_account_settings.php");
}

?>