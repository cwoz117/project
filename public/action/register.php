<?php
  $user = $_POST["username"];
  $pass = $_POST["password"];

  # should probably add a 2nd password for confirmation, then redirect with a flash
  # message update if its wrong, but w/e for now we got root
    
  require("global/db.php");  


  $sql = "insert into Users (username, password) values ('$user', '$pass');";
  if ($link->query($sql) === true)
    header("Location: ../home.php");
  else
    echo 'soemthing dun fucked up';

  $link->close();
?>
