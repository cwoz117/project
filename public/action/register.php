<?php
  $user = $_POST["username"];
  $pass = $_POST["password"];
  $repass = $_POST["repass"];  

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
  $sql = "select username from User";
  $result = $link->query($sql);
  
  while($row = $result->fetch_assoc()) {
    if ($user == $row["username"]) {
         #Error message edit here???
         header("Location: ../home.php");
       }

  }
  


  $sql = "insert into User (username, password) values ('$user', '$pass');";
  if ($link->query($sql) === true)
    header("Location: ../home.php");
  else
    echo 'soemthing dun fucked up';

  $link->close();
?>
