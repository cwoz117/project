<div id="id01" class="w3-modal">
  <div class="w3-modal-content w3-animate-top">
    <div class="w3-container">
      <h2>Add a Truck</h2>
    </div>
    <form class="w3-container w3-card-4 w3-padding" action="action/add_a_truck.php" method="post">
      <label class="w3-text-grey w3-padding-small">Name</label>
      <input type="text" class="w3-input w3-border"></input>  
      <label class="w3-text-grey w3-padding-small">Registration</label>
      <input type="text" class="w3-input w3-border"></input>  
      <label class="w3-text-grey w3-padding-small">Insurance</label>
      <input type="text" class="w3-input w3-border"></input>  
      <span>
      <input class="w3-button w3-margin-top w3-blue w3-round w3-align-left" type="submit" value="Add">
      <a href="profile.php" class="w3-button w3-margin-top w3-red w3-round w3-align-right">Cancel</a>
      </span>
    </form>
  </div>
</div>

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
        <ul class="w3-ul w3-hoverable">
          <h2 class="w3-center">Trucks</h2>
          <li class="w3-border">Truck A <span style="float:right;">Active</span></li>
          <li class="w3-border">Truck B</li>
          <li class="w3-border w3-center w3-light-grey" onclick="document.getElementById('id01').style.display='block'"> 
            <i class='fa fa-plus-square-o'></i>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
