<?php
session_start();
require("global/db.php");

$companyID = $_POST["companyID"];
$payloadID = $_POST["payloadID"];
$woNo = $_POST["woNo"];
$callerID = $_POST["button"];

$sql = "UPDATE Workorder SET completed = 1 WHERE Workorder.company_id = '$companyID' AND 
Workorder.payload_id = '$payloadID' AND 
Workorder.workorder_no = '$woNo';";

if($link->query($sql)==true){
    $link->close();
    header("Location: ../home.php");
}else{
    $link->close();
    # Error
    $_SESSION['flash'] = "Error: could not complete order.";
    $_SESSION['flash_color'] = "w3-red";
    header("Location: ../home.php");
}

?>
