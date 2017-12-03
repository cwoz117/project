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
  

  #Inserting entry into users
  $sql = "insert into User (username, password, acc_type) values ('$user', '$pass', 2);";
  if ($link->query($sql) === true)
    header("Location: ../home.php");
  else
    echo 'soemthing dun fucked up';
  
  #Getting User ID --> May be wrong
  $sql = "select max(user_id) from User;";
  
  #Are these steps necessary?
  $result = $link->query($sql);
  $userID = (int) $result;
  ##############################


  #Creation of a contractor
  $sql = "insert into Contractor () values ();"; 
  $link->query($sql);
  
  #This might be entirely wrong --> Trying to get latest created ID for contractor

  $sql = "select max(contractor_id) from Contractor;";
  
  #Are these steps necessary?
  $result = $link->query($sql);
  $cID = (int) $result;
  ##############################
  echo $cID;
  #Inserting entry into just driver for now
  $sql = "insert into Driver(user_id, wcb_no, driver_license, banking_info, contractor_id) values ($userID, $wcb, $lic, $banking, $cID);";
  if ($link->query($sql) == false) 
    echo " motherfucker";


  $link->close();
?>
