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
$userID = $_SESSION['userID'];
?>

<div id="inputForm" class="right">
    <form id="basic_info" class="w3-container w3-padding" action="action/updateAccount.php" method="post">
        <input type="hidden" name="formname" value="business"/>
        <?php
        require("global/db.php");
        $userID = $_SESSION['userID'];
        $sql = "SELECT business_id FROM ContractEmployer WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $result = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="busID">WCB Number</label>
        <input type="text" id="busID" name="busID" pattern=".{4,}" title="WCB number must be longer that 4 characters" value='<?php echo $result["business_id"]?>'>

        <?php
        require("global/db.php");
        $sql = "SELECT banking_info FROM ContractEmployer WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $result = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="banking">Banking Information</label>
        <input type="text" id = "banking" name="banking" pattern=".{4,}" title="Bank info must be longer that 4 characters" value='<?php echo $result["banking_info"]?>'>

        <input class="w3-button w3-blue w3-round w3-margin-top" type = "submit" value="Submit">
    </form>
</div>

</body>