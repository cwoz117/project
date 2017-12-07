<?php
  session_start();
  require('global/db.php');

  # accept a contract
  $contractor_id = $_SESSION['contractor_id'];
  $workorder_no = $_POST['workorder_no'];

  $sql = "insert into AcceptedOrders (contractor_id, workorder_no) VALUES ($contractor_id, $workorder_no)";
  if ($result = $link->query($sql) === true){
    $_SESSION['flash'] = "Accepted the Contract";
  } else
    $_SESSION['flash'] = "An Error Occured"

  header("Location: ../market.php");

?>
