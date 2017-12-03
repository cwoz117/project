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
  
  function check_pass(buttonName, passN, rePassN, error) {
    if (document.getElementById(passN).value == document.getElementById(rePassN).value) {
       document.getElementById(buttonName).disabled = false;
       document.getElementById(error).style.color="#00FF00";
       document.getElementById(error).value = "Password match";	
    } else {
       document.getElementById(buttonName).disabled = true;
       document.getElementById(error).style.color="#FF0000";
       document.getElementById(error).value = "Passwords do not match";
    }
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
      <input class="w3-input w3-round" type="text" name="usernameD">
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" id="passD" name="password" onblur="check_pass('submitD','passD', 'repassD', 'pwd_error')">
      <label>Re-enter Password:</label> 
      <input class="w3-input w3-round" type="password" id="repassD" name="repass" onblur="check_pass('submitD', 'passD', 'repassD' ,'pwd_error')">
      <label>WCB number:</label> 
      <input class="w3-input w3-round" type="text" name="wcb" pattern="[0-9]+">
      <label>Driver License:</label> 
      <input class="w3-input w3-round" type="text" name="license" pattern="[0-9]+">
      <label>Banking Information:</label> 
      <input class="w3-input w3-round" type="text" name="bankinfo" pattern="[0-9]+">
      <input class="w3-button w3-blue w3-round w3-margin-top" type="submit" id="submitD" value="Register">
      <input class="w3-input w3-round" type="text" id="pwd_error" readonly>
    </form>

    <form id="register_company" class="form w3-container w3-padding" action="action/companyRegister.php" method="post" style="display:none">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username">
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" id="passC" name="password" onblur="check_pass('submitC', 'passC', 'repassC', 'pwd_error2')">
      <label>Re-enter Password:</label> 
      <input class="w3-input w3-round" type="password" id="repassC" name="repass" onblur="check_pass('submitC', 'passC', 'repassC', 'pwd_error2')">
      <label>Company Name:</label> 
      <input class="w3-input w3-round" type="text" name="companyname">
      <label>Banking information:</label> 
      <input class="w3-input w3-round" type="text" name="bankinfo" pattern="[0-9]+">
      <label>Address:</label> 
      <input class="w3-input w3-round" type="text" name="address">
      <input class="w3-button w3-blue w3-round w3-margin-top" id="submitC" type="submit" value="Register">
      <input class="w3-input w3-round" type="text" id="pwd_error2" readonly>
    </form> 
  </div>
</body>
</html>

