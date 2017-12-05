
<script>
  function deleteObject(pk, objRef) {
    //If path --> payloads
    if (objRef == 0) {
      document.getElementById('dPayID').value = pk;
      document.getElementById('deleteP').style.display = 'block';
     
    //Else path --> Workorders
    } else { 
      
     
    }
  }

  function editPayload(payID, manifest, assetV, cargo, weight, contact) {
    document.getElementById('assetID').value = assetV;
    document.getElementById('manifestID').value = manifest;
    document.getElementById('cargoID').value = cargo;
    document.getElementById('weightID').value = weight;
    document.getElementById('contactID').value = contact;
    document.getElementById('payloadID').value = payID;
    document.getElementById('instructID').value = 1;
    document.getElementById('headerID').innerHTML = "Edit Payload";
    document.getElementById('manage_payload').style.display = 'block';
  }

  function addPayload() {
    document.getElementById('assetID').value = "";
    document.getElementById('manifestID').value = "";
    document.getElementById('cargoID').value = "";
    document.getElementById('weightID').value = "";
    document.getElementById('contactID').value = "";
    document.getElementById('payloadID').value = "";
    document.getElementById('instructID').value = 0;
    document.getElementById('headerID').innerHTML = "Add Payload";
    document.getElementById('manage_payload').style.display = 'block';
  }

  function toggleView(id){
    var x = document.getElementById(id);
    //var y = document.getElementById("b" + id);
    if (x.className.indexOf("w3-show") == -1){
      x.className +=  " w3-show";
      //y.className += " w3-card-4";
    } else {
      x.className = x.className.replace(" w3-show","");
      //y.className = y.className.replace(" w3-card-4","");
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

  function getPayloads() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('payload').innerHTML = this.responseText;
      }
    };
   xmlhttp.open("GET", "action/fill_payloads.php", true);
   xmlhttp.send(); 
  }
  
</script>

<div class="w3-container">
  <div class="w3-card w3-section w3-round-large">
    <div class="w3-container" style="min-height:400px;"> 
      <h2>Home</h2>
      <div class="w3-container w3-twothird" style="min-height:inherit;">
        <header class="w3-bar w3-card w3-round-large">
          <button class="w3-bar-item w3-button"> Payloads </button>
          <button class="w3-bar-item w3-button"> Active Workorders </button>
        </header>
        <!--<div id="active_orders" class="w3-container w3-bar w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit;">
          <script type="text/javascript">getActiveOrders();</script>
        </div>-->
        <div id="payload" class="w3-container w3-bar w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit;">
          <script type="text/javascript">getPayloads();</script>
        </div>
      </div>

      <div class="w3-container w3-third" style="min-height:inherit;">
        <div class="w3-container w3-margin w3-right w3-card w3-round-large" style="min-height:inherit;">
          <h3 class="w3-center">Quick Links</h3><hr>
          <ul class="w3-right-align" style="list-style: none;">
            <li><a href='#' onclick="addPayload();" >Add a Payload</a></li>
            <li><a href='#'>Create a Workorder</a></li>
            <li><a href='#'>View Completed jobs</a></li>
          </ul>
          </div>
        </div>
     </div>
  </div>
</div>


<!-- Payload Add/edit Modal -->
<div class="w3-modal" id="manage_payload">
  <div class="w3-modal-content w3-animate-top w3-round-large" style="width:400px">
    <div class="w3-container">
      <h2 id="headerID"></h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/manage_payload.php" method="POST">
      <input class="w3-hide" id="instructID" name="instruct">
      <input class="w3-hide" id="payloadID" name="payID" readonly>
      <label class="w3-text-grey w3-padding-small">Asset Value</label>
      <input class="w3-input w3-border" id="assetID" type="number" name="assetV"> 
      <label class="w3-text-grey w3-padding-small">Cargo </label>
      <input class="w3-input w3-border" id="cargoID" type=="text" name="cargotype" maxlength=2 required> 
      <label class="w3-text-grey w3-padding-small">Gross Weight</label>
      <input class="w3-input w3-border" id="weightID" type=="number" name="weight" required> 
      <label class="w3-text-grey w3-padding-small">Contact Info</label>
      <input class="w3-input w3-border" id="contactID" type=="text" name="contact" required>
      <label class="w3-text-grey w3-padding-small">Manifest</label>
      <textarea class="w3-input w3-border" id="manifestID" name="manifest" style="height:200px" required></textarea> 
      <input class="w3-button w3-margin-top w3-round w3-align-left w3-blue" type="submit" value="Confirm">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right w3-red">Cancel</a>  
    </form>
  </div>
</div>

<!-- Delete Payload -->
<div class="w3-modal" id="deleteP">
  <div class="w3-modal-content w3-animate-top w3-round-large" style="width:300px">
    <div class="w3-container">
      <h2>Delete Payload</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/manage_payload.php" method="POST">
      <input class="w3-hide" type="text" id="command" name="instruct" value=2> 
      <label class="w3-text-grey w3-padding-small">Payload ID </label>
      <input class="w3-round w3-input" id="dPayID" type="text" name="payID" readonly> 
      <input class="w3-button w3-margin-top w3-round w3-align-left w3-blue" type="submit" value="Confirm">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right w3-red">Cancel</a>  
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
      <input class="w3-button w3-margin-top w3-round w3-align-left w3-blue" type="submit" value="Create">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right w3-red">Cancel</a>  
    </form>
  </div>
</div>

