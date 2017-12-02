<?php
  $link = new mysqli("localhost", "root", "", "truckco");

  if ($link->connect_error){
    echo("Error: Cannot connect to the database server " . $link->connect_error);
    exit;
  }
?>
