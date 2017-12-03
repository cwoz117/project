<?php
  session_start();
  require("global/db.php");
  
  $user = $_POST["username"];
  $pass = $_POST["password"];
  
  $sql = "SELECT * FROM User WHERE username='$user' and password='$pass';";
  $result = $link->query($sql);

  if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION['login'] = "OK";

    $_SESSION['userID'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['type'] = $row['acc_type'];
     
    if ($_SESSION['type'] === 1) {
      $_SESSION['testo'] = "hello world";
      $id = $row['user_id'];
      $corporate_sql = "SELECT * from Company where user_id = '$id';";
      $corporate = $link->query($corporate_sql)->fetch_assoc();
      $_SESSION['company_name'] = $corporate['name'];

    }


    $redirect = "../home.php";
  } else {
    $_SESSION['flash'] = "Invalid Password";
    $redirect = "../index.php";
  }
  $link->close();
  header("Location: $redirect");
?>
