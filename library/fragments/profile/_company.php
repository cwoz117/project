<div class="w3-container">
    <div class="w3-card w3-section w3-round-large">


      <div class="w3-container w3-cell" style="width:40%;">
          <h2><?php echo $_SESSION['company_name']; ?></h2>
          <h3>COMPANY INFORMATION</h3>
          <p>
          <p>
              <?php
              require("action/getProfileDescription.php");
              ?>
          </p>
          </p>
      </div>
      
      <div class="w3-container w3-cell">
        <div class="w3-card w3-padding w3-section" style="min-height:200px;">
          OPEN CONTRACTS
        </div>
        <div class="w3-card w3-padding w3-section" style="min-height:200px;">
          'RECENT' COMPLETED CONTRACTS
        </div>
      </div>


    </div>
</div>
