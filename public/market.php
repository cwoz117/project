<?php
  require('fragments/_head.php');
  require('fragments/_nav.php');
?>
  <script>
    function myFunction(id) {
      var y = document.getElementById("b" + id);
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        y.className += " w3-card-4";
        x.className += " w3-show";
      } else {
        y.className = y.className.replace(" w3-card-4", "");
        x.className = x.className.replace(" w3-show", "");
      }
    }

    function acceptContract(id){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("market_tub").innerHTML = this.responseText;
        }
      };
      
      xmlhttp.open("POST", "action/accept_contract.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("workorder_no=" + id);
    }
    function fillMarket(){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("market_tub").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "action/fill_market.php", true);
      xmlhttp.send();
    }

  </script>
  
  <div class="w3-container">
    <div class="w3-card w3-section w3-round-large w3-padding-bottom">
      <div class="w3-container">
        <h2>Market</h2>
        <div id="market_tub" class="w3-container w3-margin" style="min-height:400px;">
          <script type="text/javascript">
            fillMarket();
          </script>
        </div>
      </div>
    </div>
  </div>

<?php
  require('fragments/_footer.php');
?>
