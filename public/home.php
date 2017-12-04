<?php 
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>

<script>
  function expandActive(id){
    var x = document.getElementById(id);
    var y = document.getElementById("b" + id);
    if (x.className.indexOf("w3-show") == -1){
      x.className +=  " w3-show";
      y.className += " w3-card-4";
    } else {
      x.className = x.className.replace(" w3-show","");
      y.className = y.className.replace(" w3-card-4","");
    }
  }

  function getActiveOrders(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('active_orders').innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "action/fill_active_orders.php", true);
    xmlhttp.send();
  }
</script>

<div class="w3-container">
<div class="w3-card w3-section w3-round-large">
<div class="w3-container" style="min-height:400px;">
 <!-- 
          <button id="b1" onclick="expandActive('1')"
                  class="w3-btn w3-block w3-left-align w3-round w3-border">Active Order 1</button>
          <div id="1" class="w3-container w3-hide">
            <div class="w3-container w3-border w3-padding w3-white">
              <h2>Active Order</h2>
              <p>Some information of a cool active order in transit!</p>
            </div>
          </div>
      <h2>Home</h2>
      <div class="w3-card w3-round-large w3-white">
        <header class="w3-container w3-blue w3-center" style="border-top-right-radius:8px;border-top-left-radius:8px";>
          Active Deliveries
        </header>
        <div id="active_orders" class="w3-container w3-margin" style="min-height:400px;"> -->
  <h2>Home</h2>
  <div class="w3-container w3-twothird" style="min-height:inherit;">
    <div id="active_orders" class="w3-container w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit;">
          <script type="text/javascript">getActiveOrders();</script>
    </div>
  </div>

  <div class="w3-container w3-third" style="min-height:inherit;">
    <div class="w3-container w3-margin w3-right w3-card w3-round-large" style="min-height:inherit;">
      <h3 class="w3-center">Quick Links</h3><hr>
      <ul class="w3-right-align" style="list-style: none;">
        <li><a href='#'>Add a Payload</a></li>
        <li><a href='#'>Create a Workorder</a></li>
        <li><a href='#'>View Completed jobs</a></li>
      </ul>
    </div>
  </div>

</div>
</div>
</div>


<!-- Payload Adding Modal -->
<div class="w3-modal" id="addPayload">
  <div class="w3-modal-content w3-animate-top w3-round-large">
    <div class="w3-container">
      <h2>Add Payload</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/add_payload.php" method="POST">
      <label class="w3-text-grey w3-padding-small">Asset Value</label>
      <input class="w3-input w3-border" type="number" name="assetV"> 
      <label class="w3-text-grey w3-padding-small">Cargo </label>
      <input class="w3-input w3-border"  type=="text" name="cargotype" maxlength=2 required> 
      <label class="w3-text-grey w3-padding-small">Gross Weight</label>
      <input class="w3-input w3-border"  type=="number" name="weight" required> 
      <label class="w3-text-grey w3-padding-small">Contact Info</label>
      <input class="w3-input w3-border"  type=="text" name="contact" required>
      <label class="w3-text-grey w3-padding-small">Manifest</label>
      <input class="w3-input w3-border" type=="text" name="manifest" required> 
      <input class="w3-button w3-margin-top w3-round w3-align-left" type="submit" value="Create">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right">Cancel</a>  
    </form>
  </div>
</div>



<?php
  require('fragments/_footer.php');
?>






<!--
<    ?php 
      switch($_SESSION['type']){
        case(1):
          echo "<button class='w3-btn w3-green w3-round w3-right'>New Payload</button>";
          break;
      }?>
-->
