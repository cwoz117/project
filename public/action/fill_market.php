<?php

function get_market_details(){
  #$sql = "select * from Workorder JOIN Company where user_id = company_id and completed = false;";
  $sql = "SELECT company_id, payload_id, workorder_no FROM Workorder WHERE completed = 0 
          EXCEPT 
          SELECT company_id, payload_id, workorder_no FROM AcceptedOrders WHERE 1;";
  require('global/db.php');
  $result = $link->query($sql);
  
  if ($result->num_rows > 0 )
    print_rows($result, $link);
  else
    echo "<p>There are no market orders available</p>";

  $link->close();
}

function print_rows($result, $link){
  $i = 1;
  while ($row = $result->fetch_assoc()){
    # this gives me a key, now go back into workorder and find this wo

    # button
    echo "<button id='b$i' onclick=\"myFunction('$i')\"";
    echo "class=\"w3-btn w3-block w3-left-align w3-round w3-border w3-white\">";
    $name = $row['name'];
    $start = $row['start_time'];
    $end = $row['deadline'];
    $price = $row['contract_price'];
    echo "<span>$name $start $end <span class='w3-align-right'>$price</span></span></button>";

    # hidden
    echo "<div id='$i' class='w3-container w3-hide'>";
    echo "<div class='w3-container w3-border w3-padding w3-white'>";
    echo "<h2>$name</h3>";
    echo "<p>A Description somehow</p>";
    echo "</div></div>";

    $i++;
  }
}

get_market_details();
?>
