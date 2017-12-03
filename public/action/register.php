<?php
  $user = $_POST["username"];
  $pass = $_POST["password"];
  $repass = $_POST["repass"];  
  $wcb = ((int) $_POST["wcb"]);
  $lic = ((int) $_POST["license"]);
  $banking = ((int) $_POST["bankinfo"]);

  # should probably add a 2nd password for confirmation, then redirect with a flash
  # message update if its wrong, but w/e for now we got root
  if ($pass === $repass) {
    #Good
  } else {
    #Error message back in front page?
    header("Location: ../home.php");
  }    

  require("global/db.php");  

  #Checking if username is used
  $sql = "select username from User;";
  $result = $link->query($sql);
  
  while($row = $result->fetch_assoc()) {
    if ($user == $row["username"]) {
         #Error message edit here???
         header("Location: ../home.php");
       }

  }
  

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
  $sql = "insert into Driver(user_id, wcb_no, driver_license, banking_info, contractor_id) values ($userID, $wcb, $lic, $banking, $cID);";
  if ($link->query($sql) == false) 
    echo " motherfucker";


  $link->close();

  #Maybe success message somehow
  header("Location: ../home.php");
?>
