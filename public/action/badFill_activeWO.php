<?php
    session_start();
    function get_active_order_details(){
    require('global/db.php');

    $type = $_SESSION["type"];
    $id = $_SESSION['userID'];

    switch($type) {
        case 1:     # company
            $sql = "select * from AcceptedOrders NATURAL JOIN Workorder where company_id = '$id' AND 
                    Workorder.completed = 0
                    ORDER BY Workorder.deadline DESC;";
            $result = $link->query($sql);
            if ($result->num_rows > 0)
                print_rowsC($result, $link);
            else
                echo "<p> There are no active orders available</p>";
            break;
    }
    $link->close();  
  }


function print_rowsC($result, $link){
    $type = $_SESSION["type"];
    $i = 1;
    while ($row = $result->fetch_assoc()){
        # button
        echo "<div>";
        # button for completing order
        #echo "<form class=\"w3-container w3-padding\" action=\"action/complete_workorder.php\" method=\"post\">";
        #echo "<input id='cB$i' class=\"w3-button w3-green w3-right-align w3-margin-top\" style=\"width=20%\" type = \"submit\" value=\"Complete\">";

        # button for showing order details
        echo "<button id='b$i' onclick=\"toggleView('$i')\"";
        echo "class=\"w3-btn w3-block w3-left-align w3-round w3-border w3-white\" style=\"width=70%\">";
        $workorderNo = $row["workorder_no"];
        $payloadID = $row["payload_id"];
        $price = $row["contract_price"];
        $companyID = $row["company_id"];

        echo "<input type=\"hidden\" name=\"companyID\" value='$companyID'/>";
        echo "<input type=\"hidden\" name=\"payloadID\" value='$payloadID'/>";
        echo "<input type=\"hidden\" name=\"woNo\" value='$workorderNo'/>";
        echo "<input type=\"hidden\" name=\"button\" value='cB$i'/>";

        # Find the name of contractor.
        $contractorName = $row["contractor_id"];
        $sql2 = "SELECT name FROM Driver WHERE Driver.contractor_id ='$contractorName';";
        $result2=$link->query($sql2);

        if($result2->num_rows > 0){
            $r = $result2->fetch_assoc();
            $contractorName = $r["name"];
        }else{
            $sql2 = "SELECT name FROM ContractEmployer WHERE ContractEmployer.contractor_id ='$contractorName';";
            $result2=$link->query($sql2);
            if($result2->num_rows > 0){
                $r = $result2->fetch_assoc();
                $contractorName = $r["name"];
            }
        }
        $companyName = $row["company_id"];
        $sql2 = "SELECT name FROM Company WHERE Company.user_id = '$companyName';";
        $result2=$link->query($sql2);
        if($result2==true){
            $r = $result2->fetch_assoc();
            $companyName = $r["name"];
        }else{
            $companyName = "N/A";
        }

        switch($type){
            case 1:             # company
                echo "<span>$workorderNo $payloadID $contractorName <span class='w3-align-right'>$price</span></span></button>";

                break;

            case 2:             # employer or Driver
            case 3:
                # Show the company name instead
                echo "<span>$workorderNo $payloadID $companyName <span class='w3-align-right'>$price</span></span></button>";

            break;
        }
        $pickupAddress = $row["pickup_address"];
        $dropoffAddress = $row["dropoff_address"];
        $startTime = $row["start_time"];
        $deadline = $row["deadline"];
        $manifest = $row["manifest"];
        $assetValue = $row["asset_value"];
        $cargoType = $row["cargo_type"];
        $weight = $row["gross_weight"];
        $contactInfo = $row["contact_info"];
        # hidden
        echo "<div id='$i' class='w3-container w3-hide'>";
        echo "<div class='w3-container w3-border w3-padding w3-white'>";
        echo "<h3>Contract Information</h3>";
        echo "<p>Company Name: $companyName<br>              
                 Contractor Name: $contractorName<br>        
                 Agreed price: $price</p><hr>";
        echo "<h3>Workorder Details</h3>";
        echo "<p>Workorder Number: $workorderNo<br>          
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
        echo "</div></div></form></div>";

        $i++;
    }
}
  get_active_order_details();
?>
