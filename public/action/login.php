<?php
  session_start();
  require("global/db.php");
  
  $user = $_POST["username"];
  $pass = $_POST["password"];
  
  $sql = "SELECT * FROM Users WHERE username='$user' and password='$pass';";
  $result = $link->query($sql);

  if ($result->num_rows == 1){
    echo 'so we got a value back <br>';
    $row = $result->fetch_assoc();
    echo "$row";
    $_SESSION['username'] = $row['username'];
    $_SESSION['login'] = "OK";

    echo 'returned from the function call<br>';
    $redirect = "../home.php";
  } else
    $redirect = "../index.php";

  $link->close();
  header("Location: $redirect");
?>
