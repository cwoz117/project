<?php 
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>
<!--   I'd prefer to have 3 possible fragments here, 
       one for each type of person: Business, Driver, Contractor

       ie: if ($_SESSION['type'] == 'driver')
             require('fragments/driver_home.php');
           else ($_SESSION['type'] == 'employee')
             require('fragments/employee_home.php');
           end
-->

  <div class='w3-container' style="min-height:400px;">
    <p>Content Here bitchez </p>
  </div>

<?php 
  require('fragments/_footer.php');
?>
