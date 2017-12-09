<div class="w3-container">
    <div class="w3-card w3-section w3-round-large">


      <div class="w3-container w3-cell" style="width:40%;">
          <h2><?php echo $_SESSION['company_name']; ?></h2>
          <h3>COMPANY INFORMATION</h3>
          <p style="min-height:400px;">
              <?php
              require("action/getProfileDescription.php");
              ?>
          </p>
      </div>
    </div>
</div>
