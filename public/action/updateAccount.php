<?php
require("global/db.php");

$user = $_SESSION['userID'];
$accType = $_SESSION['type'];

echo "acc type = '$accType'";

switch($accType){
    case 1:

        break;
    case 2:
        $name = $_POST["fullname"];
        $des = $_POST["description"];
        $license = $_POST["driverLicense"];

        echo "new name = '$name'";

        $sql ="UPDATE Driver SET name='$name', driver_license='$license' WHERE user_id = '$user';";
        if ($link->query($sql) === true) {
            echo 'Profile update 1 success';
        } else {
            echo 'Profile update 1 failed';
        }

        $sql = "UPDATE User SET profile_text='$des' WHERE user_id = '$user';";
        if ($link->query($sql) === true) {
            echo 'Profile update 2 success';
        } else {
            echo 'Profile update 2 failed';
        }
        $link->close();
        break;
}

#Maybe success message somehow
header("Location: ../account_settings.php");
?>