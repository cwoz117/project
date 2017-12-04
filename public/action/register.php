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
  $sql = "select username from User;";
  $result = $link->query($sql);
  
    if ($result->num_rows > 0) {
      $_SESSION['flash'] = "Username already in use";
  
    } else {

      $userID;
      #Inserting entry into users
      $sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 2);";
      if ($link->query($sql) === true) {
        $userID = (int) $link->insert_id; 
      } else {
        echo 'soemthing dun fucked up';
      }

    #Creation of a contractor
      $sql = "insert into Contractor () values ();"; 
  
      $cID;
      if ($link->query($sql) === true) {
        $cID = (int) $link->insert_id;
      } else {
       echo "some error happened here";
      }
  
      #Inserting entry into just driver for now
      $sql = "insert into Driver(user_id, name, wcb_no, driver_license, banking_info, contractor_id) values ($userID, '$name', '$wcb', '$lic', '$banking', $cID);";
      if ($link->query($sql) == false) 
         $_SESSION['flash'] = "Account could not be created properly";

    } 
  $link->close();

  #Maybe success message somehow
  header("Location: ../index.php");
?>
