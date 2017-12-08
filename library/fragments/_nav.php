<nav class="w3-bar w3-border w3-card-4 w3-light-grey">
  <a href='home.php' class="w3-bar-item w3-button">Home</a>
  <a href='market.php' class="w3-bar-item w3-button">Market</a>
  <div class="w3-dropdown-hover w3-right">
    <button class="w3-button">
      <?php 
      $acc_type = $_SESSION['type'];
      if ($acc_type == 1) {
        echo $_SESSION['company_name'];
      } else if ($acc_type == 2) {
        echo $_SESSION['driverName'];
      }
      ?>
      </button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4 w3-align-left">
      <a href="profile_account_settings.php" class="w3-bar-item w3-button">Account Settings</a>
      <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
      <a href="action/logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</nav>

<div class="w3-center w3-panel w3-red">
<?php 
  echo $_SESSION['flash']; 
  $_SESSION['flash'] = "";
?>
</div>
