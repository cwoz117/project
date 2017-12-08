<?php
  session_start();
  require('global/db.php');

  # accept a contract
  $contractor_id = $_SESSION['contractor_id'];
  $workorder_no = $_POST['workorder_no'];
  $company_id = $_POST['company_id'];
  $payload_id = $_POST['payload_id'];

  $sql = "insert into AcceptedOrders VALUES ($company_id, $payload_id, $workorder_no, $contractor_id);";
  if ($result = $link->query($sql) === true){
    $_SESSION['flash'] = "Accepted the Contract";
    $_SESSION['flash_color'] = "w3-green";
  } else {
    $_SESSION['flash'] = "An Error occured a: $company_id, b: $payload_id, c: $workorder_no, d: $contractor_id\n$link->error";
    $_SESSION['flash_color'] = "w3-red";
  }
  
?>
