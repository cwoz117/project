<?php
session_start();
require("global/db.php");

$user = $_SESSION['userID'];
$accType = $_SESSION['type'];


switch($accType) {
    case 1:
        if ($_POST["formname"] == "profile") {

        } elseif ($_POST["formname"] == "business") {

        } elseif ($_POST["formname"] == "security") {

        } else {
            $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
        }
        break;
    case 2:
        if ($_POST["formname"] == "profile") {
            $name = $_POST["fullname"];
            $des = $_POST["description"];
            $license = $_POST["driverLicense"];

            $sql = "";
            if ($name <> "") {
                $sql .= "UPDATE Driver SET name='$name' WHERE user_id = '$user';";
            }
            if ($des <> "") {
                $sql .= "UPDATE User SET profile_text='$des' WHERE user_id = '$user';";
            }
            if ($license <> "") {
                $sql .= "UPDATE Driver SET driver_license='$license' WHERE user_id = '$user';";
            }

            if ($link->multi_query($sql) === true) {
                $_SESSION['flash'] = "Profiled updated: '$name','$des','$license'";
            } else {
                $_SESSION['flash'] = "Profile update failed.";
            }
            $link->close();
        } elseif ($_POST["formname"] == "business") {

        } elseif ($_POST["formname"] == "security") {
            $un = $_POST["un"];
            $pw1 = $_POST["pw"];
            $pw2 = $_POST["pw2"];

            if($pw1=="" || $pw2==""){

            }elseif

        } else {
            $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
        }
        break;
    case 3:
        if($_POST["formname"] == "profile"){

        }elseif ($_POST["formname"] == "business"){

        }elseif ($_POST["formname"] == "security"){

        }else{
            $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
        }
        break;
}

#Maybe success message somehow
header("Location: ../profile_account_settings.php");
?>
