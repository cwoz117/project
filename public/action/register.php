<?php
  session_start();
  $user = $_POST["username"];
  $pass = $_POST["password"];  
  $name = $_POST["name"];
  $wcb = $_POST["wcb"];
  $lic = $_POST["license"];
  $banking = $_POST["bankinfo"];

  require("global/db.php");  

  #Checking if username is used
  $sql = "select * from User where username = $user;";

  $result = $link->query($sql);
  
    if ($result->num_rows > 0) {
      $_SESSION['flash'] = "Username already in use";
      $_SESSION['flash_color'] = "w3-red";
    } else {

      $userID;
      #Inserting entry into users
      $sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 2);";
      if ($link->query($sql) === true) {
        $userID = (int) $link->insert_id; 
      } else {
        echo 'Something messed up in register into User.';
      }

    #Creation of a contractor
      $sql = "insert into Contractor () values ();"; 
  
      $cID;
      if ($link->query($sql) === true) {
        $cID = (int) $link->insert_id;
        echo "This is $cID";
      } else {
       echo "Something messed up in register into Contractor.";
      }
  
      #Inserting entry into just driver for now

      $sql = "insert into Driver(user_id, name, wcb_no, driver_license, banking_info, contractor_id) values ('$userID', '$name', '$wcb', '$lic', '$banking', '$cID');";
      if ($link->query($sql) == false) {
         $_SESSION['flash_color'] = " w3-red";
         $_SESSION['flash'] = "Account could not be created properly";
         $sql = "delete from Contractor where contractor_id = '$cID';";
         $link->query($sql);
         $sql = "delete from User where user_id = '$userID';";
         $link->query($sql);
         
      } else {
         $_SESSION['flash_color'] = " w3-green";
         $_SESSION['flash'] = "Account successfully created";
      }
    } 
  $link->close();

  #Maybe success message somehow
  header("Location: ../index.php");
?>
