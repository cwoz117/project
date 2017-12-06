<?php

function get_market_details(){
  $sql = "select * from Workorder JOIN Company where user_id = company_id and completed = false;";
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
    make_details($i);
    $i++;
  }
}

function make_button($i, $name, $start, $end, $price){
    echo "<button id='b$i' onclick='myFunction($i);' ";
    echo "class='w3-btn w3-block w3-left-align w3-round w3-border w3-white'>";
    echo "<table class='w3-table w3-small'><tr>";
    echo array_map("make_data_rows", func_get_args());
    echo "</tr></table></button>";
}

function make_details($i){
  echo "<div id='$i' class='w3-container w3-hide'>";
  echo "  <div class='w3-container w3-border w3-padding w3-white'>";
  echo "    <p>Pickup Address, Destination Address, asset_value, cargo type, gross weight, contact info</p>";
  echo "    <button class='w3-btn'>Accept Contract</button></div></div>";
}

function make_data_rows($record){
  return "<td>$record</td>";
}

get_market_details();
?>
