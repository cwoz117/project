<?php
session_start();
require("global/db.php");

$user = $_SESSION['userID'];
$accType = $_SESSION['type'];

if ($_POST["formname"] == "security") {
    $un = $_POST["un"];
    $pw1 = $_POST["pw"];
    $pw2 = $_POST["pw2"];

    #=================================
    if($un<>""){
        #Checking if username is used
        $sql1 = "SELECT * FROM User WHERE username = '$un';";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            $_SESSION['flash'] = "Username already in use";

        } else {
            $sql = "UPDATE User SET username='$un' WHERE user_id='$user'";
            if($link->query($sql)== true){
                #$_SESSION['flash'] = "Username updated. ";
            }else{
                $_SESSION['flash'] = "Username failed to update. ";
            }
        }
    }

    if($pw1 <> "" && $pw2 <> ""){
       # if($pw2 <> $pw1){
       #     $_SESSION['flash'].="Password did not match. Please re-enter.";
       # }else{
            # check existing pw
            $sql2 = "SELECT * FROM User WHERE user_id='$user';";
            $result=$link->query($sql2);
            $row = $result->fetch_row();
            if($row[2]==$pw1){
                $_SESSION['flash'].="New password must be different from old password";
            }else{
                $sql = "UPDATE User SET password='$pw1' WHERE user_id='$user'";
                if($link->query($sql)== true){
                    #$_SESSION['flash'] .= "Password updated. ";
                }else{
                    $_SESSION['flash'] .= "Password failed to update. ";
                }
            }
       # }
    }
    #==================================
    $link->close();
    header("Location: ../security_account_settings.php");

}else {
    switch ($accType) {
        # company
        case 1:
            if ($_POST["formname"] == "profile") {
                $name = $_POST["companyName"];
                $des = $_POST["description"];
                $address = $_POST["address"];

                $sql = "";
                if ($name <> "") {
                    $sql .= "UPDATE Company SET name='$name' WHERE user_id = '$user';";
                }
                if ($des <> "") {
                    $sql .= "UPDATE User SET profile_text='$des' WHERE user_id = '$user';";
                }
                if ($address <> "") {
                    $sql .= "UPDATE Company SET address='$address' WHERE user_id = '$user';";
                }

                if ($link->multi_query($sql) === true) {
                    #$_SESSION['flash'] = "Profiled updated.";
                    $_SESSION['flash'] = "Profiled updated.";
                    $_SESSION['company_name'] = $name;
                } else {
                    $_SESSION['flash'] = "Profile update failed.";
                }

            } elseif ($_POST["formname"] == "business") {
                $banking = $_POST["banking"];

                if($banking <> ""){
                    $sql = "UPDATE Company SET banking_info='$banking' WHERE user_id='$user';";
                    if($link->query($sql) === true){
                        #$_SESSION['flash'] = "Information updated.";
                    }else{
                        $_SESSION['flash'] = "Information update failed.";
                    }
                }
            } else {
                $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
            }
            break;
        case 2:     #driver
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
                    #$_SESSION['flash'] = "Profiled updated.";
                    $_SESSION['flash'] = "Profiled updated.";
                    $_SESSION['driverName'] = $name;
                } else {
                    $_SESSION['flash'] = "Profile update failed.";
                }
            } elseif ($_POST["formname"] == "business") {
                $wcb = $_POST["wcb"];
                $banking = $_POST["banking"];

                $sql = "";
                if ($wcb <> "") {
                    $sql .= "UPDATE Driver SET wcb_no = '$wcb' WHERE user_id = '$user';";
                }
                if ($banking <> "") {
                    $sql .= "UPDATE Driver SET banking_info='$banking' WHERE user_id = '$user';";
                }

                if ($link->multi_query($sql) === true) {
                    #$_SESSION['flash'] = "Profiled updated: '$wcb','$banking'";
                } else {
                    $_SESSION['flash'] = "Profile update failed.";
                }

            } else {
                $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
            }
            break;
        case 3:     # employer
            if ($_POST["formname"] == "profile") {
                $name = $_POST["name"];
                $des = $_POST["description"];


                if($name <> ""){
                    $sql = "UPDATE ContractEmployer SET name='$name' WHERE user_id='$user';";
                }
                if($des <> "")
                {

                }
                if($link->query($sql) === true){
                    #$_SESSION['flash'] = "Profile updated.";
                }else{
                    $_SESSION['flash'] = "Profile update failed.";
                }
            } elseif ($_POST["formname"] == "business") {
                $busID = $_POST["busID"];
                $banking = $_POST["banking"];

                $sql = "";
                if ($wcb <> "") {
                    $sql .= "UPDATE ContractEmployer SET business_id = '$busID' WHERE user_id = '$user';";
                }
                if ($banking <> "") {
                    $sql .= "UPDATE ContractEmployer SET banking_info='$banking' WHERE user_id = '$user';";
                }

                if ($link->multi_query($sql) === true) {
                    #$_SESSION['flash'] = "Information updated.";
                } else {
                    $_SESSION['flash'] = "Information update failed.";
                }

            } else {
                $_SESSION['flash'] = "Invalid form submitted to updateAccount.";
            }
            break;
    }

}
$link->close();
#Maybe success message somehow
header("Location: ../profile_account_settings.php");
?>
