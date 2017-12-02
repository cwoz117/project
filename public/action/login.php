<?php
  require("global/db.php");
  
  $user = $_POST["username"];
  $pass = crypt($_POST["password"]);
  
  $sql = "SELECT * FROM Users WHERE username='$user' and password='$pass';";
  $result = $link->query($sql);

  if ($result->num_rows == 1)
    $redirect = "../home.php";
  else
    $redirect = "../index.php";

  $link->close();
  header("Location: $redirect");
?>
