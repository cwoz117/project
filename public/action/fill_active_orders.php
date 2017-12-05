<?php
  session_start();
  function get_active_order_details(){
    require('global/db.php');

    $id = $_SESSION['id'];
    $sql = "select * from AcceptedOrders where company_id = $id";
    $result = $link->query($sql);
    if ($result->num_rows > 0)
      print_rows($result, $link, $id);
    else
      echo "<p> There are no active orders available</p>";

    $link->close();  
  }

  function print_rows($result, $link, $company){
    $id = 1;
    while ($row = $result->fetch_assoc()){
      $payload = $row['payload_id'];
      $sql = "Select * from AcceptedOrders natural join Payload natural join Workorder where payload_id='$payload'";      
      $data = $link->query($sql);

    
      
      
      #button
      echo "<button id='b$id' onclick='myFunction('$id')'";
      echo "class='w3-btn w3-block w3-left-align w3-round w3-border'";
      echo "";
      #hidden

      $id++;
    }

  }

  get_active_order_details();
?>
