<?php
  session_start();
  if((isset($_SESSION["login"]) && $_SESSION['login'] == "OK")){
    header("Location: ../home.php");
  }
?>

<!Doctype html>
<html>
<head>
  <title>Truckco</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script>
  function openForm(formName) {
    var i;
    var x = document.getElementsByClassName("form");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    document.getElementById(formName).style.display = "block";
  }  
  </script>
</head>
<body>
  <div class="w3-card-4 w3-hover-shadow w3-round w3-display-middle">
    
    <header class="w3-bar w3-blue">
      <button class="w3-bar-item w3-button" onclick="openForm('login')">Login</button>
      <button class="w3-bar-item w3-button" onclick="openForm('register_driver')">Driver Registration</button>
      <button class="w3-bar-item w3-button" onclick="openForm('register_company')">Company Registration</button>
    </header>
    
    <form id="login" class="form w3-container w3-padding" action="action/login.php" method="post">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username">
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" name="password">
      <input class="w3-button w3-blue w3-round w3-margin-top" type="submit" value="Login">
    </form>

    <form id="register_driver" class="form w3-container w3-padding" action="action/register.php" method="post" style="display:none">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username">
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" name="password">
      <input class="w3-button w3-blue w3-round w3-margin-top" type="submit" value="Register">
    </form>

    <form id="register_company" class="form w3-container w3-padding" action="action/register.php" method="post" style="display:none">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username">
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" name="password">
      <input class="w3-button w3-blue w3-round w3-margin-top" type="submit" value="Register">
    </form>
  </div>
</body>
</html>

