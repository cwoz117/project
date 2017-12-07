<?php

function get_market_details(){
  $sql = "select * 
          from Workorder 
          natural join Company
          natural join Payload 
          where user_id = company_id and completed = false and not exists(
            select distinct workorder_no
            from AcceptedOrders
          );";
  require('global/db.php');
  $result = $link->query($sql);
  
  if ($result->num_rows > 0 )
    print_rows($result, $link);
  else
    echo "<p>There are no market orders available</p>";

}

function print_rows($result, $link){
  $i = 1;
  while ($row = $result->fetch_assoc()){
    make_button($i, $row['name'], $row['start_time'], $row['deadline'], $row['contract_price']);
    make_details($i, $row['pickup_address'],$row['dropoff_address'],$row['asset_value'],$row['cargo_type'],$row['gross_weight'],$row['contact_info']);
    $i++;
  }
}

function make_button($i, $name, $start, $end, $price){
    echo "<button id='b$i' onclick='myFunction($i);' ";
    echo "class='w3-btn w3-block w3-left-align w3-round w3-border w3-white'>";
    echo "<table class='w3-table w3-small'><tr>";
    foreach (array_map("make_data_rows", func_get_args()) as $row)
      echo $row;
    echo "</tr></table></button>";
}

function make_details($i, $pickup, $destination, $asset, $cargo, $weight, $contact){
  echo "<div id='$i' class='w3-container w3-hide'>";
  echo "  <div class='w3-container w3-border w3-padding w3-white'>";
  echo "    <p>$pickup, $destination, $asset, $cargo, $weight</p><p>$contact</p>";
  echo "    <button class='w3-btn w3-round w3-blue'>Accept Contract</button></div></div>";
}

function make_data_rows($record){
  return "<td>$record</td>";
}

get_market_details();
?>
