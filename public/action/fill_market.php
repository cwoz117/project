<?php

function get_market_details(){
  #$sql = "select * from Workorder JOIN Company where user_id = company_id and completed = false;";
  $sql = "SELECT company_id, payload_id, workorder_no FROM Workorder WHERE Workorder.completed = 0 
          EXCEPT 
          SELECT company_id, payload_id, workorder_no FROM AcceptedOrders WHERE 1;";
  require('global/db.php');
  $result = $link->query($sql);

  if ($result == false){
    echo "<p>THE SUBTRACTION HAS AN ERROR!!!! AAAAH</p>";
  }
  
  if ($result->num_rows > 0 )
    print_rows($result, $link);
  else
    echo "<p>There are no market orders available</p>";

  $link->close();
}

function print_rows($result, $link){
  $i = 1;
  while ($row = $result->fetch_assoc()){
    $companyID = $row["company_id"];
    $payloadID = $row["payload_id"];
    $workorderNo = $row["workorder_no"];
    # this gives me a key, now go back into workorder and find this wo
    $sql2 = "SELECT * FROM Workorder WHERE Workorder.company_id = '$companyID' AND 
                                           Workorder.payload_id = '$payloadID' AND 
                                           Workorder.workorder_no = '$workorderNo';";
    $result2 = $link->query($sql2);

    if($result2 == true){
      $row = $result2->fetch_assoc();
    }else{
      echo "cannot select workorder!";
    }

    $sql2 = "SELECT * FROM Payload WHERE Payload.payload_id = '$payloadID';";
    $result2 = $link->query($sql2);

    if($result == true){
      $rowP = $result2->fetch_assoc();
    }else{
      echo "cannot select payload";
    }

    # button
    echo "<button id='b$i' onclick=\"myFunction('$i')\"";
    echo "class=\"w3-btn w3-block w3-left-align w3-round w3-border w3-white\">";
    $start = $row['start_time'];
    $end = $row['deadline'];
    $price = $row['contract_price'];
    $deadline = $row["deadline"];
    #$payloadID = $row["payload_id"];
    #$workorderNo = $row["workorder_no"];
    $companyName = $row["company_id"];
    $sql2 = "SELECT name FROM Company WHERE Company.user_id = '$companyName';";
    $result2=$link->query($sql2);
    if($result2==true){
      $r = $result2->fetch_assoc();
      $companyName = $r["name"];
    }else{
      $companyName = "N/A";
    }

    echo "<span>$workorderNo $payloadID $companyName $deadline <span class='w3-align-right'>$price</span></span></button>";

    $pickupAddress = $row["pickup_address"];
    $dropoffAddress = $row["dropoff_address"];
    $startTime = $row["start_time"];
    $manifest = $rowP["manifest"];
    $assetValue = $rowP["asset_value"];
    $cargoType = $rowP["cargo_type"];
    $weight = $rowP["gross_weight"];
    $contactInfo = $rowP["contact_info"];

      # hidden
      echo "<div id='$i' class='w3-container w3-hide'>";
      echo "<div class='w3-container w3-border w3-padding w3-white'>";
      echo "<h3>Workorder Details</h3>";
      echo "<p>Workorder Number: $workorderNo<br>
                 Offered price: $price<br>          
                 Pickup Address: $pickupAddress<br>          
                 Dropoff Address: $dropoffAddress<br> 
                 Start Time: $startTime<br>  
                 Deadline: $deadline</p><hr>";
      echo "<h3>Payload Details</h3>";
      echo "<p>Payload ID: $payloadID<br>                    
                 Manifest File(s): $manifest<br>
                 Asset Value: $assetValue<br>
                 Cargo Type: $cargoType<br>
                 Gross Weight: $weight<br>
                 For more information, please contact: $contactInfo</p>";
      echo "</div></div>";

    $i++;
  }
}

get_market_details();
?>
