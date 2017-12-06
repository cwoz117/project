<?php
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>
<div class="w3-container">
<div class="w3-card w3-section w3-round-large">
  <div class="w3-container" style="min-height:400px; padding-bottom: 20px;">
    <h2>Account Settings</h2>
	
	<div class="w3-bar-block" style="width: 200px; float: left; width: 20%; padding: 10px;">
	    <a href="profile_account_settings.php" class="w3-bar-item w3-button w3-light-grey" >Profile</a> <br>
	    <a href="business_account_settings.php" class="w3-bar-item w3-button w3-light-grey">Business</a>  <br>
	    <a href="#" class="w3-bar-item w3-button w3-blue">Security</a>
	</div>

      <?php
      require('fragments/accSetting/_securitySetting.php');
      ?>

  </div>
</div>
</div>
<?php
  require('fragments/_footer.php');
?>
