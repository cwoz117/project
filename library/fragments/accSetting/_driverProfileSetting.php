<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        width: 100%;
        height: 200px;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: none;
<<<<<<< HEAD
=======
        rows="4";
        cols="50";
>>>>>>> 01165a85c4798dc21256812490d29d26ddc59458
    }

    #inputForm {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        padding-bottom: 10px;
    }


    .right {
        float: right;
        width: 75%;
        padding: 10px;
    }

</style>

<body>
<?php
session_start();
$userID = $_SESSION['userID'];
?>

<div id="inputForm" class="right">
    <form id="basic_info" class="w3-container w3-padding" action="action/updateAccount.php" method="post">
        <input type="hidden" name="formname" value="profile"/>
        <?php
        require("global/db.php");
        $sql = "SELECT * FROM Driver WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="name">Full name</label>
        <input type="text" id="name" name="fullname" placeholder=<?php echo $row["name"]?>>

        <label>Profile description</label>
        <textarea name="description" placeholder="Enter profile description..."></textarea>

        <!-- SQL Query to get driver license from database-->
        <?php
        require("global/db.php");
        $sql = "SELECT * FROM Driver WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="driverLicense">Driver license</label>
        <input type="text" id="driverLicense" name="driverLicense" maxlength="12" placeholder=<?php echo $row["driver_license"];?>
        >

        <input class="w3-button w3-blue w3-round w3-margin-top" type = "submit" value="Submit">
    </form>
</div>

</body>