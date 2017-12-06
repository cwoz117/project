<?php
  session_start();
  $user = $_POST["username"];
  $pass = $_POST["password"];  
  $wcb = $_POST["wcb"];
  $lic = $_POST["license"];
  $banking = $_POST["bankinfo"];

  require("global/db.php");  

  #Checking if username is used
  $sql = "SELECT * FROM User WHERE username = '$user';";
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
      $sql = "insert into Driver(user_id, wcb_no, driver_license, banking_info, contractor_id) values ($userID, '$wcb', '$lic', '$banking', $cID);";
      if ($link->query($sql) == false) 
        echo " motherfucker";

    } 
  $link->close();

  #Maybe success message somehow
  header("Location: ../index.php");
?>
