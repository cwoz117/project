<?php
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>
<div class="w3-container">
<div class="w3-card w3-section w3-round-large">
  <div class="w3-container" style="min-height:400px; padding-bottom: 20px;">
    <h2>Account Settings</h2>
	
	<div class="w3-bar-block" style="width: 200px; float: left; width: 20%; padding: 10px;">
	    <a href="#" class="w3-bar-item w3-button w3-blue" >Profile</a> <br>
	    <a href="business_account_settings.php" class="w3-bar-item w3-button w3-light-grey">Business</a>  <br>
	    <a href="security_account_settings.php" class="w3-bar-item w3-button w3-light-grey">Security</a>
	</div>

	<!--Load different pages depending on account type and the setting requested-->
      <?php
      switch($_SESSION['type']){
      case 1:
	  require('fragments/accSetting/_companyProfileSetting.php');
      break;
      case 2:
	  require('fragments/accSetting/_driverProfileSetting.php');
      break;
	  case 3:
	  require('fragments/accSetting/_employerProfileSetting.php');
	  break;
      }
      ?>

  </div>
</div>
</div>
<?php
  require('fragments/_footer.php');
?>
