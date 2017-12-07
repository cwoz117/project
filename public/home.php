<?php 
  require('fragments/_head.php');
  require('fragments/_nav.php');


  switch($_SESSION['type']) {
    case 1: #company
      require('fragments/profile/_companyHome.php');
      break;
    case 2: #driver
      require('fragments/profile/_driverHome.php');
      break;
  }


  require('fragments/_footer.php');
?>






<!--
<    ?php 
      switch($_SESSION['type']){
        case(1):
          echo "<button class='w3-btn w3-green w3-round w3-right'>New Payload</button>";
          break;
      }?>
-->
