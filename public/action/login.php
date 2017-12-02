<?php
  session_start();
  require("global/db.php");
  require("global/session.php");
  
  $user = $_POST["username"];
  $pass = $_POST["password"];
  
  $sql = "SELECT * FROM Users WHERE username='$user' and password='$pass';";
  $result = $link->query($sql);

  if ($result->num_rows == 1){
    fill_user_session($result->fetch_assoc());
    $redirect = "../home.php";
  } else
    $redirect = "../index.php";

  $link->close();
  header("Location: $redirect");
?>
