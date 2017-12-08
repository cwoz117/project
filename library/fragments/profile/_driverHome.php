
<script>
    function expandActive(id){
        var x = document.getElementById(id);
        var y = document.getElementById("b" + id);
        if (x.className.indexOf("w3-show") == -1){
            x.className +=  " w3-show";
            y.className += " w3-card-4";
        } else {
            x.className = x.className.replace(" w3-show","");
            y.className = y.className.replace(" w3-card-4","");
        }
    }

    function getActiveOrders(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('active_orders_tub').innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "action/fill_active_orders.php", true);
        xmlhttp.send();
    }


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

    function assignWoID(id) {
        //var y = document.getElementById("wo" + id);
        var x = document.getElementById("wo" + id);
        if (x.className.indexOf("w3-show") == -1) {
        //    y.className += " w3-card-4";
            x.className += " w3-show";
        } else {
         //   y.className = y.className.replace(" w3-card-4", "");
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function getWorkorder() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("workorder_tub").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "action/fill_workorder.php", true);
        xmlhttp.send();
    }


</script>

<div class="w3-container">
    <div class="w3-card w3-section w3-round-large">
        <div class="w3-container" style="min-height:400px;">
            <h2>Home</h2>
            <div class="w3-container w3-twothird" style="min-height:inherit;">
                <div id="active_orders" class="w3-container w3-padding w3-margin w3-card w3-round-large" style="min-height:inherit;">
                    <h3 class="w3-center">Orders in Progress</h3><hr>
                    <div id="active_orders_tub" class="w3-container w3-margin" style="min-height:400px;">
                        <script type="text/javascript">
                            getActiveOrders();
                        </script>
                    </div>
                </div>
            </div>

            <div class="w3-container w3-third" style="min-height:inherit;">
                <div class="w3-container w3-margin w3-right w3-card w3-round-large" style="min-height:inherit;">
                    <h3 class="w3-center">Quick Links</h3><hr>
                    <ul class="w3-right-align" style="list-style: none;">
                        <li><a href='#' onclick="document.getElementById('viewCompletedJobs').style.display = 'block'" >View Completed jobs</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- View jobs Modal -->
<div class="w3-modal" id="viewCompletedJobs">
    <div class="w3-modal-content w3-animate-top w3-round-large">
        <div class="w3-container">
            <h2>Completed Jobs</h2>
        </div>
        <div id="workorder_tub" class="w3-container w3-padding-16">
            <script type="text/javascript">
                getWorkorder();
            </script>

        </div>
    </div>
</div>



<script>
    var modal = document.getElementById('viewCompletedJobs');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


