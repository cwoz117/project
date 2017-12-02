<!DOCTYPE html>
<html>
  <head>
  </head>
    <body>
    <?php 
      if (isset($_POST['username'])){
        if (empty($_POST['username'])){
          $username = "Anonymous";
        } else {
          $username = $_POST['username'];
        }
      }
      echo $username;
    ?>
    <form action='/landing.php' method='post'>
      username: <input type="text" name="username"><br>
      password: <input type="password" name="password"><br>
      <input type="submit">
    </form>

    <?php
      $server = "localhost";
      $user = "root";
      $pass = "";

      $conn = mysqli_connect($server, $user, $pass);
      if (!$conn){
        die ("Connection Failed: " . mysqli_connect_error());
      }
      echo 'Connected';

    ?>
  </body>
</html>
