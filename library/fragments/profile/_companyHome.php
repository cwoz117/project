
<script>
  function deleteObject(objRef, payloadID, woNum) {
    //If path --> payloads
    if (objRef == 0) {
      document.getElementById('dPayID').value = payloadID;
      document.getElementById('deleteP').style.display = 'block';
     
    //Else path --> Workorders
    } else { 
      document.getElementById('dWPayID').value = payloadID;
      document.getElementById('dWNo').value = woNum;
      document.getElementById('deleteW').style.display = 'block';
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


  //Info Codes
  //0 = payloads 
  //1 = workorders (all)
  //2 = Active Orders
  //3 = ?????
  function getInfo(infoCode){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (infoCode == 0) {
          document.getElementById('payload').innerHTML = this.responseText;
        } else if (infoCode == 1) {
          document.getElementById('workorders').innerHTML = this.responseText;
	} else if (infoCode == 2) {
          document.getElementById('active_orders').innerHTML = this.responseText;
	} else {
	
	}
      }
    };

    if (infoCode == 0) 
      xmlhttp.open("GET", "action/fill_payloads.php", true);
    else if (infoCode == 1) 
      xmlhttp.open("GET", "action/fill_workorders.php", true);
    else if (infoCode == 2) 
      xmlhttp.open("GET", "action/fill_active_orders.php", true);
   // else 

    xmlhttp.send();
  }

  function createWorkorder() {
    document.getElementById('wHeaderID').innerHTML = "Create Workorder";
    document.getElementById('wInstructID').value = 0;
    document.getElementById('manageWO').style.display = 'block';
    woVisibilityToggle(0);
    document.getElementById('woPID').value = "";
    document.getElementById('woID').value = "";
    document.getElementById('woPID').value = "";
    document.getElementById('woID').value = "";
    document.getElementById('pAddrID').value = "";
    document.getElementById('dAddrID').value = "";
    document.getElementById('startID').value = "";
    document.getElementById('deadID').value = "";
    document.getElementById('priceID').value = "";
    document.getElementById('compID').value = 0;
    document.getElementById('manageWO').style.display = 'block';
  }


  //0 = Add Work Order
  //1 = Edit Work Order
  function woVisibilityToggle(setting) {	
    var pid=document.getElementById('woPID');
    var pidLabel=document.getElementById('pidLabel');
    var wNo=document.getElementById('woID'); 
    var wNoLabel=document.getElementById('woLabel');
    var compLabel=document.getElementById('compLabelID');
    var comp=document.getElementById('compID');

    if (setting == 0) {
      if (pid.className.indexOf("w3-hide") != -1) {
        pid = pid.className.replace(" w3-hide", "");
        pidLabel = pidLabel.className.replace(" w3-hide", "");
        wNo = wNo.className.replace(" w3-hide", "");
        wNoLabel = wNoLabel.className.replace(" w3-hide", "");
      }
      if (comp.className.indexOf("w3-hide") == -1) {
        compLabel.className += " w3-hide";
        comp.className += " w3-hide";
      }
    } else {
      if (comp.className.indexOf("w3-hide") != -1) {
        compLabel = compLabel.className.replace(" w3-hide", "");
        comp = comp.className.replace(" w3-hide", "");
      }
      if (pid.className.indexOf("w3-hide") == -1) {
        pid.className += " w3-hide";
        pidLabel.className += " w3-hide";
        wNo.className += " w3-hide";
        wNoLabel.className += " w3-hide";
      }
    }
  }

  function editWorkorder(payID, workNo, pickup, dropoff, start, deadline, price, completed) {
    document.getElementById('wHeaderID').innerHTML = "Edit Workorder";
    document.getElementById('wInstructID').value = 1;
    woVisibilityToggle(1);
    document.getElementById('woPID').value = payID;
    document.getElementById('woID').value = workNo;
    document.getElementById('woPID').value = payID;
    document.getElementById('woID').value = workNo;
    document.getElementById('pAddrID').value = pickup;
    document.getElementById('dAddrID').value = dropoff;
    document.getElementById('startID').value = start;
    document.getElementById('deadID').value = deadline;
    document.getElementById('priceID').value = price;
    document.getElementById('compID').value = completed;
    document.getElementById('manageWO').style.display = 'block';
  }

  //CallerTab
  //0 = Show payloads 
  //1 = Show Workorders
  //2 = Show Active orders
  function switchView(callerTab) {
	switch (callerTab) {
	  case 0:
	    document.getElementById('active_orders').style.display = 'none';  
	    document.getElementById('workorders').style.display = 'none';  
	    document.getElementById('payload').style.display = 'block';  
	    break;

	  case 1:
	    document.getElementById('payload').style.display = 'none';
	    document.getElementById('workorders').style.display = 'block';  
	    document.getElementById('active_orders').style.display = 'none';  
	    break;

	  case 2:
	    document.getElementById('payload').style.display = 'none';   
	    document.getElementById('workorders').style.display = 'none';  
	    document.getElementById('active_orders').style.display = 'block';  
	    break;
    }
  }

  
</script>

<div class="w3-container">
  <div class="w3-card w3-section w3-round-large">
    <div class="w3-container" style="min-height:400px;"> 
      <h2>Home</h2>
      <div class="w3-container w3-twothird" style="min-height:inherit;">
        <header class="w3-bar w3-card w3-round-large">
          <button class="w3-bar-item w3-button" onclick="switchView(0);"> Payloads </button>
          <button class="w3-bar-item w3-button" onclick="switchView(1);"> Workorders </button>
          <button class="w3-bar-item w3-button" onclick="switchView(2);"> Active Workorders </button>
        </header>
        <div id="payload" class="w3-container w3-bar w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit;">
          <script type="text/javascript">getInfo(0);</script>
        </div>
        <div id="workorders" class="w3-container w3-bar w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit; display:none">
          <script type="text/javascript">getInfo(1);</script>
        </div>
        <div id="active_orders" class="w3-container w3-bar w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit; display:none">
          <script type="text/javascript">getInfo(2);</script>
        </div>
      </div>

      <div class="w3-container w3-third" style="min-height:inherit;">
        <div class="w3-container w3-margin w3-right w3-card w3-round-large" style="min-height:inherit;">
          <h3 class="w3-center">Quick Links</h3><hr>
          <ul class="w3-right-align" style="list-style: none;">
            <li><a href='#' onclick="addPayload();" >Add a Payload</a></li>
            <li><a href='#' onclick="createWorkorder()">Create a Workorder</a></li>
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

<!-- Workorder Adding/Editing Modal -->
<div class="w3-modal" id="manageWO">
  <div class="w3-modal-content w3-animate-top w3-round-large">
    <div class="w3-container">
      <h2 id="wHeaderID">Add Workorder</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/manage_workorder.php" method="POST">
      <input class="w3-hide" id="wInstructID" name="instruct" value="">
      <label class="w3-text-grey w3-padding-small" id="pidLabel">Payload</label>
      <select class="w3-select" id="woPID" name="payID">
        <?php
	require("global/db.php");
        session_start();
	$userID = $_SESSION['userID'];
        $sql = "select payload_id from Payload where company_id = $userID;";
        $result = $link->query($sql);
        while ($row = $result->fetch_assoc()) {
          $payID = $row['payload_id'];
          echo "<option value='$payID'>Payload ID: $payID</option>";
        }
        $link->close();
        ?>
      </select>
      <label class="w3-text-grey w3-padding-small" id="woLabel">Workorder Number</label>
      <input class="w3-input w3-border" type="text" id="woID" name="woNum" pattern="[0-9].{1,20}" title="Must be a number between 1 to 20 characters" required> 
      <label class="w3-text-grey w3-padding-small">Pickup Address</label>
      <input class="w3-input w3-border"  type="text" id="pAddrID" name="pAddr" required> 
      <label class="w3-text-grey w3-padding-small">Dropoff Address</label>
      <input class="w3-input w3-border"  type="text" id="dAddrID" name="dAddr" required> 
      <label class="w3-text-grey w3-padding-small">Start Time</label>
      <input class="w3-input w3-border"  type="date" id="startID" name="start" required>
      <label class="w3-text-grey w3-padding-small">Deadline</label>
      <input class="w3-input w3-border" type="date" id="deadID" name="dead" required> 
      <label class="w3-text-grey w3-padding-small">Contract Price</label>
      <input class="w3-input w3-border" type="number" id="priceID" name="price" required> 
      <label class="w3-text-grey w3-padding-small" id="compLabelID">Completed?</label>
      <select class="w3-select" id="compID" name="completed" required> 
        <option value=0>Pending</option>
        <option value=1>Completed</option>
      </select>
      <input class="w3-button w3-margin-top w3-round w3-align-left w3-blue" type="submit" value="Confirm">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right w3-red">Cancel</a>  
    </form>
  </div>
</div>


<!-- Delete Workorder -->
<div class="w3-modal" id="deleteW">
  <div class="w3-modal-content w3-animate-top w3-round-large" style="width:300px">
    <div class="w3-container">
      <h2>Delete Workorder</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/manage_workorder.php" method="POST">
      <input class="w3-hide" type="text" id="command" name="instruct" value=2> 
      <label class="w3-text-grey w3-padding-small">Payload ID </label>
      <input class="w3-round w3-input" id="dWPayID" type="text" name="payID" readonly> 
      <label class="w3-text-grey w3-padding-small">Workorder #</label>
      <input class="w3-round w3-input" id="dWNo" type="text" name="workID" readonly> 
      <input class="w3-button w3-margin-top w3-round w3-align-left w3-blue" type="submit" value="Confirm">
      <a href="" class="w3-button w3-margin-top w3-round w3-align-right w3-red">Cancel</a>  
    </form>
  </div>
</div>

