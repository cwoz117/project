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

    function getMarketOrders(){
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
             getMarketOrders();
          </script>
        </div>
      </div>
    </div>
  </div>

<?php
  require('fragments/_footer.php');
?>



<!--

              <button id="b1" onclick="myFunction('1')" class="w3-btn w3-block w3-left-align w3-round w3-border w3-white">Open Order 1</button>
              <div id="1" class="w3-container w3-hide">
                <div class="w3-container w3-border w3-padding w3-white">
                  <h2>Walmart</h2>
                  <p>destination</p>
                  <p>pick-up location</p>
                  <p>ome cool flavour text showing how baller we are at this</p>
                </div>
              </div>
              <button id="b2" onclick="myFunction('2')" class="w3-btn w3-block w3-left-align w3-round w3-border w3-white">Open Order 2</button>
              <div id="2" class="w3-container w3-hide">
                <div class="w3-container w3-border w3-padding w3-white">
                  <h2>Walmart</h2>
                  <p>destination</p>
                  <p>pick-up location</p>
                  <p>ome cool flavour text showing how baller we are at this</p>
                </div>
              </div>
              <button id="b3" onclick="myFunction('3')" class="w3-btn w3-block w3-left-align w3-round w3-border w3-white">Open Order 3</button>
              <div id="3" class="w3-container w3-hide">
                <div class="w3-container w3-border w3-padding w3-white">
                  <h2>Walmart</h2>
                  <p>destination</p>
                  <p>pick-up location</p>
                  <p>ome cool flavour text showing how baller we are at this</p>
                </div>
              </div>
-->
