<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top">
    <div class="w3-container">
      <h2>Add a Truck</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/add_a_truck.php" method="post">
      <label class="w3-text-grey w3-padding-small">Registration</label>
      <input type="text" class="w3-input w3-border" name="reg">  
      <label class="w3-text-grey w3-padding-small">Insurance</label>
      <input type="text" class="w3-input w3-border" name="insurance"> 
      <label class="w3-text-grey w3-padding-small">Provider</label>
      <input type="text" class="w3-input w3-border" name="provider">  
      <label class="w3-text-grey w3-padding-small">Policy Number</label>
      <input type="text" class="w3-input w3-border" name="polNum">  
      <label class="w3-text-grey w3-padding-small">Plate Number</label>
      <input type="text" class="w3-input w3-border" name="plate"> 
      <label class="w3-text-grey w3-padding-small">Make</label>
      <input type="text" class="w3-input w3-border" name="make">  
      <label class="w3-text-grey w3-padding-small">Model</label>
      <input type="text" class="w3-input w3-border" name="model">  
      <label class="w3-text-grey w3-padding-small">Trailer Type</label>
      <input type="text" class="w3-input w3-border" name="trailer" maxlength=2> 
      <label class="w3-text-grey w3-padding-small">Year</label>
      <input type="text" class="w3-input w3-border" name="year" pattern="[0-9]{2}"> 
      <label class="w3-text-grey w3-padding-small">Province</label>
      <select class="w3-input w3-border" name="prov"> 
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
      <input class="w3-button w3-margin-top w3-blue w3-round w3-align-left" type="submit" value="Add">
      <a href="profile.php" class="w3-button w3-margin-top w3-red w3-round w3-align-right">Cancel</a>
      </span>
    </form>
  </div>
</div>

<div id="delete" class="w3-modal">
  <div class="w3-modal-content w3-animate-top" style="max-width:300px">
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

	function editTruckInfo(reg, cID, pvr, polnum, plate, make, model, year, prov, trailer) {i



	}
</script>

<div class="w3-container">
  <div class="w3-card w3-section w3-round-large">

    <div class="w3-container w3-cell" style="width:40%;">
      <h2><?php echo $_SESSION["username"]?> </h2>
      <p>
        I'v always preferred Cards cause they're rad. Maybe just some first/last name stuff, bio if we want
        to consider it important. but tbh its more just to flush out the links in the nav bar
      </p>
      <p>
        As an additional note, I think a truck form here would be legit, have a modal bound to the '+' 
        button which will always be added once we make the list dynamic, then they can hit it
        and get a screen drop down in front of them to add vehical info.
      </p>
    </div>
    <div class="w3-container w3-cell">      
      <div class="w3-card w3-padding w3-section" style="min-height:200px;">
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
                  $trailer = $row["trailer"];
		  $truckNum = $index+1;
                  echo "
                          <li id='title' class='w3-display-container w3-border-blue w3-light-grey w3-bottombar'>$year $model $make Truck, License Plate $plate
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
                                  <th>$prov</th
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
                              <button class='w3-button w3-right w3-blue w3-margin-bottom' onclick=\"\">Edit</button>
                            </div>
                          </div>
                          
                        ";
                }
              } else {
		echo "You currently have not registered a truck.<br>";
              }      
   

          ?>
          <!--<li class="w3-border">Truck A <span style="float:right;">Active</span></li>
          <li class="w3-border">Truck B</li> -->
          <li class="w3-border w3-center w3-light-grey" onclick="document.getElementById('id01').style.display='block'">

            <i class='fa fa-plus-square-o'></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

			     <!-- <h4 class='w3-border'>Registration</h4>
			      <p> $reg </p>
			      <h4 class='w3-border'>Provider</h4>
			      <p> $pro </p>
			      <h4 class='w3-border'>Policy Number</h4>
		              <p> $polnum </p>
			      <h4 class='w3-border'>Plate Number</h4>
			      <p> $plate </p>
			      <h4 class='w3-border'>Province</h4>
			      <p> $prov </p>
			      <h4 class='w3-border'>Trailer Type</h4>
			      <p> $trailer </p>
		              <button class='w3-button w3-display-right w3-border w3-blue' id='edit'>Edit</button> -->
