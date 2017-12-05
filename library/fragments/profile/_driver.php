<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top w3-round-large">
    <div class="w3-container">
      <h2 id="header"></h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/manage_truck.php" method="post">
      <input type="text" class="w3-hide" id="instruction" name="command">
      <label class="w3-text-grey w3-padding-small" id="regLabel">Registration</label>
      <input type="text" class="w3-input w3-border" id="regID" name="reg" pattern="[0-9].{3,10}" title="Must be between 3 to 10 characters" required>   
      <label class="w3-text-grey w3-padding-small">Provider</label>
      <input type="text" class="w3-input w3-border" id="pvrID" name="provider" pattern=".{1,30}" title="Must be between 3 to 30 characters" required>  
      <label class="w3-text-grey w3-padding-small">Policy Number</label>
      <input type="text" class="w3-input w3-border" id="polnumID" name="polNum" pattern=".{1,10}" title="Must be between 1 to 10 characters" required>  
      <label class="w3-text-grey w3-padding-small">Plate Number</label>
      <input type="text" class="w3-input w3-border" id="plateID" name="plate" pattern="[A-Z0-9].{1,8}" title="Must be between 1 to 8 characters with only capital letters and numbers" required> 
      <label class="w3-text-grey w3-padding-small">Make</label>
      <input type="text" class="w3-input w3-border" id="makeID" name="make" pattern=".{1,15}" title="Must be between 1 to 15 characters" required>  
      <label class="w3-text-grey w3-padding-small">Model</label>
      <input type="text" class="w3-input w3-border" id="modelID" name="model" pattern=".{1,15}" title="Must be between 1 to 15 characters" required>  
      <label class="w3-text-grey w3-padding-small">Trailer Type</label>
      <input type="text" class="w3-input w3-border" id="trailerID" name="trailer" maxlength=2 required> 
      <label class="w3-text-grey w3-padding-small">Year</label>
      <input type="text" class="w3-input w3-border" id="yearID" name="year" pattern="[0-9]{2}" required> 
      <label class="w3-text-grey w3-padding-small">Province</label>
      <select required="required" class="w3-input w3-border" id="provID" name="prov"> 
         <option value="AB">Alberta</option>
         <option value="BC">British Columbia</option>  
         <option value="MB">Manitoba</option>
         <option value="NB">New Brunswick</option>  
         <option value="NL">Newfoundland</option>
         <option value="NS">Nova Scotia</option>  
         <option value="NT">Northwest Territories</option>
         <option value="NU">Nunavut</option>  
         <option value="ON">Ontario</option>
         <option value="PE">Prince Edward Island</option>  
         <option value="QC">Quebec</option>
         <option value="SK">Sasketchewan</option>
         <option value="YT">Yukon</option>  
      </select> 
      <span>
      <input class="w3-button w3-margin-top w3-blue w3-round w3-align-left" type="submit" value="Confirm">
      <a href="profile.php" class="w3-button w3-margin-top w3-red w3-round w3-align-right">Cancel</a>
      </span>
    </form>
  </div>
</div>

<div id="delete" class="w3-modal">
  <div class="w3-modal-content w3-animate-top w3-round-large" style="max-width:300px">
    <div class="w3-container">
      <h2 style="text-align:center">Delete Truck</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/delete_truck.php" method="post">
      <input type="text" class="w3-border-0" value="Truck with Registration: " readonly>
      <input type="text" class="w3-input w3-center w3-border-0 w3-padding-small" name="registration" id="dReg" readonly>
      <input class="w3-button w3-margin w3-red w3-round w3-align-left" type="submit" value="Delete">
      <a href="profile.php" class="w3-button w3-margin w3-blue w3-round w3-align-right">Cancel</a>
    </form>
  </div>
</div>

<script>
	function confirmDelete(reg) {
		document.getElementById("delete").style.display = 'block';
		document.getElementById("dReg").value = reg;
	}

	function toggleView(element) {
		var doc=document.getElementById(element);
		if (doc.className.indexOf("w3-show")==-1) {
			doc.className += " w3-show";
		} else {
			doc.className = doc.className.replace(" w3-show", "");
		}
	}

	function manageTruck(command, reg, pvr, polnum, plate, make, model, year, prov, trailer) {
		document.getElementById("instruction").value=command;
		var truckPK=document.getElementById("regID");
		var labelPK=document.getElementById("regLabel");
		
		//Add Command
		if (command == 0) {
		  document.getElementById("header").innerHTML="Add truck";
		  reg = pvr = polnum = plate = make = model = year = prov = trailer = "";
		  if (truckPK.className.indexOf("w3-hide") != -1) {
		     truckPK = truckPK.className.replace(" w3-hide", "");
		     labelPK = labelPK.className.replace(" w3-hide", "");
		  }
		//Edit Command
		} else {
	          document.getElementById("header").innerHTML="Edit truck";
		  truckPK.className += " w3-hide";
		  labelPK.className += " w3-hide";
		}
		truckPK.value=reg;
		document.getElementById("pvrID").value=pvr;
		document.getElementById("polnumID").value=polnum;
		document.getElementById("plateID").value=plate;
		document.getElementById("makeID").value=make;
		document.getElementById("modelID").value=model;
		document.getElementById("yearID").value=year;
		document.getElementById("provID").value=prov;
		document.getElementById("trailerID").value=trailer;
		document.getElementById('id01').style.display = 'block';	
	}
</script>

<div class="w3-container">
  <div class="w3-card w3-section w3-round-large">
    <div class="w3-container w3-cell" style="width:40%;">
      <h2><?php echo $_SESSION["username"]?> </h2>
        <div class="w3-container w3-cell" style="width:60%;">
        <p>
            <?php
            require("action/getProfileDescription.php");
            ?>
        </p>
    </div>
    <div class="w3-container w3-cell">      
      <div class="w3-card w3-padding w3-section" style="min-height:200px; width:550px;">
        <ul class="w3-ul w3-center">
          <h2 class="w3-center">Trucks</h2>
	  <?php
              require("global/db.php");

              $userID = $_SESSION["userID"];
              $conID;
	
	      $sql = "select contractor_id from Driver where $userID = user_id;";
              $conID = (int) $link->query($sql);

              $sql = "select * from Truck where $conID = contractor_id;";
	      $result = $link->query($sql);
              $length = $result->num_rows;
              if ($length > 0) {
	        for ($index=0; $index < $length; $index++) {
		  $row = $result->fetch_assoc();
                  $reg = $row["registration"];
                  $pro = $row["provider"];
		  $polnum = $row["policy_num"];
                  $plate = $row["plate_num"];
                  $make = $row["make"];
		  $model = $row["model"];
                  $year = $row["year"];
                  $prov = $row["province"];
                  $trailer = $row["trailer_type"];
		  $truckNum = $index+1;
                  echo "<li id='title' class='w3-display-container w3-border-blue w3-light-grey w3-bottombar'>$year' $model $make Truck, License Plate $plate
			    <span class='w3-button w3-display-left w3-border-right'  id='view' onclick=\"toggleView($index)\" >View</span>
			    <button class='w3-button w3-display-right w3-border-left' id='close' onclick=\"confirmDelete($reg)\">&times;</button>
			  </li>
                          <div class='w3-hide w3-border w3-container' id='$index'>
			    <div class=w3-container> 
                            <h4><b>Truck Information</b></h4>
		              <table class='w3-table'>
                                <tr class='w3-border'>
                                  <th>Registration</th>
                                  <th>$reg</th
                                </tr>
                                <tr class='w3-border'>
                                  <th>Provider</th>
                                  <th>$pro</th
                                </tr>
                                <tr class='w3-border'>
                                  <th>Policy Number</th>
                                  <th>$polnum</th
                                </tr>
                                <tr class='w3-border'>
                                  <th>Province</th>
                                  <th>$prov</th
                                </tr>
                                <tr class='w3-border'>
                                  <th>Trailer Type</th>
                                  <th>$trailer</th
                                </tr>
                              </table>
                              <button class='w3-button w3-right w3-blue w3-margin-bottom' onclick=\"manageTruck(1, '$reg', '$pro', '$polnum', '$plate', '$make', '$model', '$year', '$prov', '$trailer')\">Edit</button>
                            </div>
                          </div>";
                }
              } else {
		echo "You currently have not registered a truck.<br>";
              }      
          ?>
          <li class="w3-border w3-center w3-light-grey" onclick="manageTruck(0)">

            <i class='fa fa-plus-square-o'></i>
          </li>
        </ul>
        <p class="w3-red w3-center"> <?php echo $_SESSION['flash']; $_SESSION['flash'] = "" ?> </p>
      </div>
    </div>
  </div>
</div>
<script>
  var deleteM = document.getElementById('delete');
  var manageM = document.getElementById('id01');
  window.onclick = function(event) {
    if (event.target == manageM) {
       manageM.style.display = "none";
    } else if (event.target == deleteM) {
       deleteM.style.display = "none";
    }
  }
</script>
