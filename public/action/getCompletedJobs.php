<?php
function print_rows($result, $link){
    $i = 1;
    while ($row = $result->fetch_assoc()){
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

session_start();
$userID = $_SESSION["userID"];
require('global/db.php');

$sql = "SELECT contractor_id FROM Driver WHERE user_id = '$userID';";
$result = $link->query($sql);
if($result==true){
    $row=$result->fetch_assoc();
    $contractorID = $row["contractor_id"];

    $max=10;
    $sql = "SELECT * FROM AcceptedOrders JOIN Workorder WHERE AcceptedOrders.contractor_id = '$contractorID' AND Workorder.completed=1;";
    $result = $link->query($sql);
    if($result==true){
        #$wNo=1;
        #$detailInfo="";
        while ($row = $result->fetch_assoc()) {
            #$row = $result->fetch_assoc();
            $companyID = $row["company_id"];
            $workorderNo = $row["workorder_no"];
            $payloadID = $row["payload_id"];
            $contractPrice = $row["contract_price"];
            $pickupAddress = $row["pickup_address"];
            $dropoffAddress = $row["dropoff_address"];
            $deadline = $row["deadline"];

            $sql2 = "SELECT name FROM Company WHERE user_id = '$companyID'";
            $result2 = $link->query($sql2);
            if($result2==true){
                $c = $result2->fetch_assoc();
                $companyName = $c["name"];
            }else{
                $companyName = "N/A";
            }
            #echo "CompanyID = $companyID, workorderNo = $workorderNo, payloadID = $payloadID, contractPrice=$contractPrice";

            echo "<tr onclick=\"openWorkorder('w$wNo')\"><td>$workorderNo</td>
                  <td>$payloadID</td>
                  <td>$companyName</td>
                  <td>$contractPrice</td></tr>";

            $detailInfo .= "<div id=\"w$wNo\" class=\"w3-container w3-display-container workorder\" style=\"display:none\">
                  <span onclick=\"this.parentElement.style.display='none'\" class=\"w3-button w3-large w3-display-topright\">&times;</span>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-left\">Pickup Address</div>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-right\">$pickupAddress</div>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-left\">Dropoff Address</div>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-right\">$dropoffAddress</div>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-left\">Deadline</div>
                  <div class=\"w3-panel w3-text-grey w3-padding-small w3-display-right\">$deadline</div>
                  </div>";

            $wNo++;
            if($wNo==$max){
                break;
            }
        }
        $_SESSION["temp"]=$detailInfo;

    }else{
        echo "FOUND CONTRACTOR BUT COULDN'T FIND ANY ORDERS";
    }

}else{
    echo "COULDN'T FIND CONTRACTOR";
    $_SESSION["flash"] = "Failed to find this contractor.";
}

?>
