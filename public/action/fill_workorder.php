<?php

function get_workorder_details()
{
    session_start();
    $userID = $_SESSION["userID"];
    require('global/db.php');

    $sql = "SELECT contractor_id FROM Driver WHERE user_id = '$userID';";
    $result = $link->query($sql);
    echo "<table class=\"w3-table-all w3-hoverable\">
                <tr class=\"w3-blue\">
                    <th>Job Number</th>
                    <th>Payload ID</th>
                    <th>Company</th>
                    <th>Job Price</th>
                </tr>";

    if($result==true){
        $row=$result->fetch_assoc();
        $contractorID = $row["contractor_id"];

        $max=10;
        $sql = "SELECT * FROM AcceptedOrders NATURAL JOIN Workorder 
                WHERE AcceptedOrders.contractor_id = '$contractorID' AND 
                Workorder.completed=1 
                ORDER BY deadline DESC;";
        $result = $link->query($sql);
        if($result==true){
            print_rows($result, $link);
        }else{
            echo "<p>There are no completed jobs</p>";
        }
    }

    echo "</table>";
    $link->close();

}

function print_rows($result, $link){
    $i = 1;
    while ($row = $result->fetch_assoc()) {
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

        # button
        echo "<tr id='b$i' onclick=\"myFunction('$i')\">";
        #echo "class=\"w3-btn w3-block w3-left-align w3-round w3-border w3-white\">";
        #echo "<span>$workorderNo $payloadID $companyName <span class='w3-align-right'>$contractPrice</span></span></button>";
        echo "<td>$workorderNo</td>
                  <td>$payloadID</td>
                  <td>$companyName</td>
                  <td>$contractPrice</td></tr>";


        # hidden
        echo "<div id='$i' class='w3-container w3-display-container w3-hide'>";
        echo "<div class='w3-container w3-border w3-padding w3-white'>";
        echo "<h4>Order details</h4>";
        echo "<p>Pickup Address: $pickupAddress</p>";
        echo "<p>Dropoff Address: $dropoffAddress</p>";
        echo "<p>Deadline: $deadline</p>";
        echo "</div></div>";


        $i++;
    }
}

get_workorder_details();
?>
