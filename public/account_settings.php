<?php
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>
<div class="w3-container"">
<div class="w3-card w3-section w3-round-large">
  <div class="w3-container" style="min-height:400px; padding-bottom: 20px;">
    <h2>Account Settings</h2>
      <p>
      Password reset forms and name changers if we want to do anything like that, 
      but I don't think we needed to right? Anyways at least password reset should be here.
    </p>

      <!--
       Check if user is Driver - if yes, load driver _driverAccSetting.php
       -->

      <!--
        Check if user is Driver - if yes, load driver _companyAccSetting.php
       -->

      <!--
       Check if user is Driver - if yes, load driver _employerAccSetting.php
      -->
      <?php
      switch($_SESSION['type']){
      case 1:
      require('fragments/accSetting/_companyAccSetting.php');
      break;
      case 2:
      require('fragments/accSetting/_driverAccSetting.php');
      break;
      }
      ?>

  </div>
</div>
</div>
<?php
  require('fragments/_footer.php');
?>
