<?php
  require('fragments/_head.php');
  require('fragments/_nav.php');

  switch($_SESSION['type']){
    case 1:
      require('fragments/profile/_company.php');
      break;
    case 2:
      require('fragments/profile/_driver.php');
      break;
  }

  require('fragments/_footer.php');
?>
