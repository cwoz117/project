<?php 
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>

<div class="w3-container">
<div class="w3-card w3-section w3-round-large">

  <div class="w3-container" style="min-height:400px;">
    <div class="w3-left">
      <h2>Home</h2>
      <p>NEWS AND ADS YO</p>
    </div>
    <div class="w3-margin w3-right w3-card w3-padding w3-round-large">
      <h3 class="w3-center">Quick Links</h3><hr>
      <ul class="w3-right-align" style="list-style: none;">
        <li><a href='#'>Add a Payload</a></li>
        <li><a href='#'>Create a Workorder</a></li>
        <li><a href='#'>View Completed jobs</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
<?php
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
