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

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    #inputForm {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        padding-bottom: 10px;
    }

    .vertical-menu {
        width: 200px;
        float: left;
        width: 20%;
        padding: 10px;
    }

    .vertical-menu a {
        background-color: #eee;
        color: black;
        display: block;
        padding: 12px;
        text-decoration: none;
    }

    .vertical-menu a:hover {
        background-color: #ccc;
    }

    .vertical-menu a.active {
        background-color: #4CAF50;
        color: white;
    }


    .right {
        float: right;
        width: 75%;
        padding: 10px;
    }

</style>

<body>
<?php
$user = $_POST["username"];
$pass = $_POST["password"];
$wcb = $_POST["wcb"];
$lic = $_POST["license"];
$banking = $_POST["bankinfo"];
?>



<div class="vertical-menu">
    <a href="#" class="active">Profile</a>
    <a href="#">Business</a>
    <a href="#">Security</a>
</div>


<div id="inputForm" class="right">
    <form action="~/public/action/updateAccount.php" method="post">
        <?php
        require("global/db.php");

        $userID = $_SESSION['userID'];
        $sql = "SELECT name FROM Driver WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $link->close();
        ?>
        <label for="name">Full name</label>
        <input type="text" id="name" name="fullname" placeholder= <?php echo $result; ?>>


        <!-- SQL Query to get profile description from database-->
        <?php
        require("global/db.php");

        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM Driver WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $link->close();
        ?>
        <label>Profile description</label>
        <form><textarea name="description" placeholder=<?php echo $row["profile_text"] ?>></textarea></form>

        <!-- SQL Query to get driver license from database-->
        <?php
        require("global/db.php");

        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM Driver WHERE user_id = '$userID';";
        $result = $link->query($sql);
        $row = $result->fetch_assoc();
        $link->close();
        ?>
        <label for="driverLicense">Driver license</label>
        <input type="text" id="driverLicense" name="driverLicense" maxlength="12" placeholder=<?php echo $row["driver_license"];?>
        >

        <input type="submit" value="Submit">
    </form>
</div>

<!--
<div id="sideBarNav" class="w3-margin w3-right w3-card w3-padding w3-round-large">
    <h3 class="w3-center">Account Setting</h3><hr>
    <ul class="w3-left-align w3-hoverable">
        <li class="w3-border"><a href='#'>Basic</a></li>
        <li class="w3-border"><a href='#'>Business</a></li>
        <li class="w3-border"><a href='#'>Security</a></li>
    </ul>
</div>

<!--
<div class="w3-container w3-cell">
    <div class="w3-card w3-padding w3-section" style="min-height:200px;">
        <ul class="w3-ul w3-hoverable">
            <h2 class="w3-center">Trucks</h2>
            <li class="w3-border">Truck A <span style="float:right;">Active</span></li>
            <li class="w3-border">Truck B</li>
            <li class="w3-border w3-center w3-light-grey" onclick="document.getElementById('id01').style.display='block'">
                <i class='fa fa-plus-square-o'></i>
            </li>
        </ul>
    </div>
</div>
-->