
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

  function getPayloads(id) {
   
  }
</script>

<div class="w3-container">
  <div class="w3-card w3-section w3-round-large">
    <div class="w3-container" style="min-height:400px;"> 
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
        <li><a href='#' onclick="document.getElementById('addPayload').style.display = 'block'" >Add a Payload</a></li>
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


<!-- Workorder Adding Modal -->
<div class="w3-modal" id="addWO">
  <div class="w3-modal-content w3-animate-top w3-round-large">
    <div class="w3-container">
      <h2>Add Workorder</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/add_workorder.php" method="POST">
      <label class="w3-text-grey w3-padding-small">Workorder Number</label>
      <input class="w3-input w3-:qborder" type="text" name="woNum" pattern="[0-9].{1,20}" title="Must be a number between 1 to 20 characters" required> 
      <label class="w3-text-grey w3-padding-small">Pickup Address</label>
      <input class="w3-input w3-border"  type=="text" name="pAddr" maxlength=2 required> 
      <label class="w3-text-grey w3-padding-small">Dropoff Address</label>
      <input class="w3-input w3-border"  type=="number" name="dAddr" required> 
      <label class="w3-text-grey w3-padding-small">Start Time</label>
      <input class="w3-input w3-border"  type=="date" name="start" required>
      <label class="w3-text-grey w3-padding-small">Deadline</label>
      <input class="w3-input w3-border" type=="date" name="dead" required> 
      <label class="w3-text-grey w3-padding-small">Contract Price</label>
      <input class="w3-input w3-border" type=="number" name="price" required> 
      <input class="w3-button w3-margin-top w3-round w3-align-left" type="submit" value="Create">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right">Cancel</a>  
    </form>
  </div>
</div>

