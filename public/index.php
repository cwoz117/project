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

  <style>

    body, html {
      height: 100%;
      margin: 0;
    }
    .bg {
      background-image: url('Truck.jpg');
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body>
  
  <div class="bg w3-opacity"></div>
  <div class="w3-card-4 w3-hover-shadow w3-round-large w3-display-middle w3-white" style="min-width:30%;">
    <header class="w3-container w3-blue w3-center" style="border-top-right-radius:8px;border-top-left-radius:8px;">
      <h1>Truckco</h1>
    </header>    
    <form class="w3-container w3-padding" action="action/login.php" method="post">
      <fieldset>
        <legend>Login</legend>
        <label>Username:</label> 
        <input class="w3-input w3-round" type="text" name="username">
        <label>Password:</label> 
        <input class="w3-input w3-round" type="password" name="password">
        <p class="w3-red"><?php echo $_SESSION['flash']; $_SESSION['flash'] = ""; ?></p>
        
        <div><input class="w3-button w3-blue w3-round w3-margin-top" type="submit" value="Login"></div>
        <a href="#" onclick="document.getElementById('forgotModal').style.display='block'">Forgot Password?</a>
      </fieldset>
    </form>
    <div class="w3-center w3-margin"><a onclick="document.getElementById('modal').style.display='block'" href='#'>Register Here!</a></div>
  </div>
</body>
</html>

<div id="forgotModal" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round-xlarge" style="max-width:350px">
    <header class="w3-container w3-blue" style="border-top-right-radius:8px;border-top-left-radius:8px;">
      <h1> Reset Password </h1>
    </header>
    <form id="resetPassword" class="form w3-container w3-padding" action="action/reset_userpass.php" method="post">
      <label>Username:</label>
      <input class="w3-input" type="text" name="usern" pattern=".{4,16}" title="Username must be between 4-16 characters" required>
      <label>Enter New Password:</label>
      <input class="w3-input w3-round" type="password" id="passR" name="pass" onblur="check_pass('submitR', 'passR', 'repassR', 'pwd_errorR')" pattern=".{4,}" title="password must be longer that 4 characters">
      <label>Re-enter New Password:</label>
      <input class="w3-input w3-round" type="password" id="repassR" name="repass" onblur="check_pass('submitR', 'passR', 'repassR', 'pwd_errorR')">
      <input class="w3-button w3-blue w3-round w3-margin-top w3-cell" type="submit" id="submitR" value="Change Password">
      <input class="w3-input w3-round w3-cell" type="text" id="pwd_errorR" readonly>
    </form>
  </div>
</div>

<div id="modal" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round-large" style="max-width:100%">
    <header class="w3-bar w3-blue w3-round-large">
      <button class="w3-bar-item w3-button w3-blue" onclick="openForm('register_driver')">Driver Registration</button>
      <button class="w3-bar-item w3-button w3-blue" onclick="openForm('register_company')">Company Registration</button>
    </header>
    <form id="register_driver" class="form w3-container w3-padding" action="action/register.php" method="post">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username" pattern=".{4,16}" title="Username must be between 4-16 characters" required>
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" id="passD" name="password" onblur="check_pass('submitD','passD', 'repassD', 'pwd_error')" pattern=".{4,}" title="Password must be longer than 4 characters" required>
      <label>Re-enter Password:</label> 
      <input class="w3-input w3-round" type="password" id="repassD" name="repass" onblur="check_pass('submitD', 'passD', 'repassD' ,'pwd_error')">
      <label>Name:</label> 
      <input class="w3-input w3-round" type="text" name="name" required>
      <label>WCB number:</label> 
      <input class="w3-input w3-round" type="text" name="wcb" pattern="[0-9]+" required>
      <label>Driver License:</label> 
      <input class="w3-input w3-round" type="text" name="license" pattern="[0-9]+" required>
      <label>Banking Information:</label> 
      <input class="w3-input w3-round" type="text" name="bankinfo" pattern="[0-9]+" required>
      <input class="w3-button w3-blue w3-round w3-margin-top" type="submit" id="submitD" value="Register">
      <input class="w3-input w3-round" type="text" id="pwd_error" readonly>
    </form>

    <form id="register_company" class="form w3-container w3-padding" action="action/companyRegister.php" method="post" style="display:none">
      <label>Username:</label> 
      <input class="w3-input w3-round" type="text" name="username" pattern=".{4,16}" title="Username must be between 4-16 characters" required>
      <label>Password:</label> 
      <input class="w3-input w3-round" type="password" id="passC" name="password" pattern=".{4,}" title="Password must be longer than 4 characters" required onblur="check_pass('submitC', 'passC', 'repassC', 'pwd_error2')">
      <label>Re-enter Password:</label> 
      <input class="w3-input w3-round" type="password" id="repassC" name="repass" onblur="check_pass('submitC', 'passC', 'repassC', 'pwd_error2')">
      <label>Company Name:</label> 
      <input class="w3-input w3-round" type="text" name="companyname" required>
      <label>Banking information:</label> 
      <input class="w3-input w3-round" type="text" name="bankinfo" pattern="[0-9]+" required>
      <label>Address:</label> 
      <input class="w3-input w3-round" type="text" name="address" required>
      <input class="w3-button w3-blue w3-round w3-margin-top" id="submitC" type="submit" value="Register">
      <input class="w3-input w3-round" type="text" id="pwd_error2" readonly>
    </form> 
  </div>
</div>
<script>
  var modal = document.getElementById('modal');
  var fmodal = document.getElementById('forgotModal');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    } else if (event.target == fmodal) {
      fmodal.style.display = "none";
    }

  }
</script>
