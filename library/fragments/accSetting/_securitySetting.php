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
?>

<div id="inputForm" class="right">
    <form id="basic_info" class="w3-container w3-padding" action="action/updateAccount.php" method="post">
        <input type="hidden" name="formname" value="security"/>
        <?php
        require("global/db.php");
        $userID = $_SESSION['userID'];
        $sql = "SELECT username FROM User WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $result = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="un">Username</label>
        <input type="text" id="un" name="un" placeholder=<?php echo $result["username"]?>>


        <label for="pw">New password</label>
        <input type="text" id = "pw" name="pw" placeholder="">

        <label for="pw2">Retype password</label>
        <input type="text" id = "pw2" name="pw2" placeholder="">

        <input class="w3-button w3-blue w3-round w3-margin-top" type = "submit" value="Submit">
        <button type="submit" formaction="action/deleteAccount.php" class="w3-button w3-red w3-round w3-margin-top w3-right" >Delete Account</button>
    </form>
</div>

</body>