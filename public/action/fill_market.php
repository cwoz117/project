<?php
function get_market_details(){

  $sql = "select * 
          from Workorder as w, Payload as p 
          where completed = false and p.payload_id = w.payload_id and workorder_no not in 
            (select workorder_no 
             from AcceptedOrders as a 
             where a.company_id = w.company_id and 
                                  a.payload_id = w.payload_id and 
                                  a.workorder_no = w.workorder_no);";
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
        make_button($i, $row['name'], $row['start_time'], $row['deadline'], $row['contract_price']);
        make_details($i, $row['pickup_address'],$row['dropoff_address'],$row['asset_value'],$row['cargo_type'],$row['gross_weight'],$row['contact_info'], $row['workorder_no'], $row['payload_id'], $row['company_id']);
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

function make_details($i, $pickup, $destination, $asset, $cargo, $weight, $contact, $workorder_no, $cargo, $company_id){
    echo "<div id='$i' class='w3-container w3-hide'>";
    echo "  <div class='w3-container w3-border w3-padding w3-white'>";
    echo "    <p>$pickup, $destination, $asset, $cargo, $weight</p><p>$contact</p>";
    echo "    <button onclick=\"acceptContract($workorder_no, $cargo, $company_id);\" class='w3-btn w3-round w3-blue'>Accept Contract</button></div></div>";
}

function make_data_rows($record){
    return "<td>$record</td>";
}

get_market_details();
?>
