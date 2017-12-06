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

<script>
    function check_pass(buttonName, passN, rePassN, error) {
        if (document.getElementById(passN).value == document.getElementById(rePassN).value) {
            document.getElementById(buttonName).disabled = false;
            document.getElementById(error).style.color="#00FF00";
            document.getElementById(error).value = "Password match";
        } else {
            document.getElementById(buttonName).disabled = true;
            document.getElementById(error).style.color="#FF0000";
            document.getElementById(error).value = "Passwords do not match";
        }
    }
</script>

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
        <input type="text" id="un" name="un" value='<?php echo $result['username']?>'>


        <label for="pw">New password</label>
        <input type="text" id = "pw" name="pw" onblur="check_pass('updateSecurityButton','pw', 'pw2', 'pwd_error')" pattern=".{4,}" title="password must be longer that 4 characters">

        <label for="pw2">Retype password</label>
        <input type="text" id = "pw2" name="pw2" onblur="check_pass('updateSecurityButton','pw', 'pw2', 'pwd_error')" pattern=".{4,}" title="password must be longer that 4 characters">

        <input class="w3-input w3-light-grey w3-border-0" type="text" id="pwd_error" readonly>
        <input id="updateSecurityButton" class="w3-button w3-blue w3-round w3-margin-top" type = "submit" value="Submit">
        <button type="submit" formaction="action/deleteAccount.php" class="w3-button w3-red w3-round w3-margin-top w3-right" >Delete Account</button>
    </form>
</div>

</body>