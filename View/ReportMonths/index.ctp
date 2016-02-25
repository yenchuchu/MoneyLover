<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="../MoneyLover/Wallets/index">
                    <i class="fa fa-play-circle"></i>  <span class="light">Money</span> Lover
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li>
                    <?php echo $this->Html->link(__('My Wallets'), array('controller' => 'Wallets', 'action' => 'index')); ?>
                    </li>
                    <li>
                    <?php echo $this->Html->link(__('Transfer Wallet'), array('controller' => 'TransferWallets', 'action' => 'index')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link(__('Transactions'), array('controller' => 'Transactions', 'action' => 'index')); ?>
                    </li>
                    <li>
                    <?php echo $this->Html->link(__('Report Month'), array('controller' => 'Report', 'action' => 'index')); ?>
                    </li>
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img src="../startbootstrap-grayscale-edit/img/noel.jpg" style="width:20px; height:20px">  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>  Update Avatar</a>
                        </li>
                        <li><a href="#change-password"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a class="page-scroll" href="main.html">Log Out</a>
                        </li>
                    </ul>
                       </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
                    <div id="change-password" class="modalDialog ">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Change Password</h3>
                        </div>
                        <div class="panel-body" style="color:black;">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Current Password" name="current-password" type="password" value="">
                                    </div>
                                     <div class="form-group">
                                        <input class="form-control" placeholder="New Password" name="new-password" type="password" value="">
                                    </div>
                                      <div class="form-group">
                                        <input class="form-control" placeholder="Retype New Password" name="retype-password" type="password" value="">
                                    </div>
                                    <a href="#" class="" style="color: black;">Forgotten your password? </a>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <div class="submit-passsword">
                                        <a href="#" class="btn password-save">Save</a>
                                        <a href="#close" class="btn password-cancel">Cancel</a>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div> 
                <!-- /#change-password -->
                <form id="search" role="form" action="#" method="GET" class="form-inline form-search-top">
            <select name="category" class="select-style select2-offscreen" tabindex="-1" style="background-color: rgba(251, 248, 248, 0.95)">
                <option value="Month" style="color: red;">--Select Month--</option>
                <option value="">1</option>
                <option value="10">2</option>
                <option value="">3</option>
                <option value="">4</option>
                <option value="">5</option>
                <option value="">6</option>
                <option value="">7</option>
                <option value="10">8</option>
                <option value="">9</option>
                <option value="">10</option>
                <option value="">11</option>
                <option value="">12</option>
            </select>
                <input type="text" style="padding: 6px;" placeholder="Enter Year..." >
                <button class="btn btn-default" type="button" style="    color: rgba(255,255,255,.5); background: rgba(0,0,0,.13); border: 1px solid rgba(0,0,0,.13);     border: none;" title="search">
                    <i class="fa fa-search"></i>
                </button>
                   </form>  

    <!-- Contact Section -->
    <section id="report-month" class="content-section text-center">
         <h1>Report Month</h1>
         <div style="">
             <span style="float: right;
            position: relative;
            top: -123px;
            right: 30%;">
             <div style="width: 30px; height: 20px;    background-color: #FF8153;float: left; margin-bottom:10px; padding-left:4px;"></div> <span style="float: left;"> Tiền thu </span><br><br>
             <div style="width: 30px; height: 20px; background-color: #4ACAB4;float: left;; margin-bottom:10px; padding-left:4px;"></div> <span style="float: left;"> Tiền chi</span> 
        </span>
        <span style="float: right;
            position: relative;
            top: -123px;
            right: 13%;">
             <div style="width: 30px; height: 20px; background-color: #878BB6;float: left; padding-left:4px;"></div> <span style="float: left;">  Shopping</span><br><br>   
             <div style="width: 30px; height: 20px; background-color: #53CFFF;float: left; padding-left:4px;"></div> <span style="float: left;"> Travel</span><br><br>
             <div style="width: 30px; height: 20px; background-color: #F567A9;float: left; padding-left:4px;"></div> <span style="float: left;"> Gifts</span><br><br>
        </span>
        <span style="float: right;
            position: relative;
            top: -123px;
            right: -9%;">
             <div style="width: 30px; height: 20px; background-color: #F52844;float: left; padding-left:4px;"></div> <span style="float: left;"> Friends and lover </span><br><br>
             <div style="width: 30px; height: 20px; background-color: #6ADE4D;float: left; padding-left:4px;"></div> <span style="float: left;"> food</span><br>
       </span>
        
         </div>
         
        <div class="row" style="margin-right:0px; margin-bottom: 10px">
            <div class="col-lg-10 col-lg-offset-1" style="margin-bottom: 30px; top:-51px">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw" style="    font-size: 24px;
                    float: left;"></i> <span style="    font-size: 20px;
                    font-weight: bold;">May</span> 
                </div>
                <div class="panel-body" style="border: 1px solid #83202E; background-color: rgba(255, 255, 255, 0.23)" >
                    <div style="float: left; width: 50%;">
                        <h3>Thu-Chi</h3>
                        <canvas id="countries" width="600" height="400" style="position: relative; left: -47px;"></canvas>
                        <!-- <canvas id="aaaa" width="600" height="400" style="position: relative; left: -47px;"></canvas> -->
                    </div>
                    <div style="float: left; width: 50%;">
                        <h3>categories</h3>
                        <canvas id="chart-categories" width="600" height="400" style="position: relative; left: -47px;"></canvas>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
          
                <!-- phan trang -->

<!-- <div class="page" style="    position: absolute;
    bottom: 5px;    width: 100%;">
<ul id="pagination-digg" style="    width: 50%;">
   <li class="previous-off">«Previous</li>
   <li class="active">1</li>
   <li><a href="?page=2">2</a></li>
   <li><a href="?page=3">3</a></li>
   <li><a href="?page=4">4</a></li>
   <li><a href="?page=5">5</a></li>
   <li><a href="?page=6">6</a></li>
   <li><a href="?page=7">7</a></li>
   <li class="next"><a href="?page=2">Next »</a></li>
</ul>        
  
</div> -->
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>
<script type="text/javascript">
    // pie chart data
    var pieData = [
        // {
        //     value: 20,
        //     color:"#878BB6"
        // },
        {
            value : 60,
            color : "#4ACAB4"
        },
        {
            value : 40,
            color : "#FF8153"
        }
    ];
     var pieData2 = [
        {
            value: 10,
            color:"#878BB6"
        },
        {
            value : 30,
            color : "#53CFFF" 
        },
        {
            value : 30,
            color : "#F567A9"
        },
        {
            value: 12,
            color:"#F52844"
        },
        {
            value : 18,
            color : "#6ADE4D"
        }
    ];
 
    // pie chart options
    var pieOptions = {
        segmentShowStroke : false,
        animateScale : true
    }
 
    // get pie chart canvas
    var countries= document.getElementById("countries").getContext("2d");

    var categories= document.getElementById("chart-categories").getContext("2d");
 // var aaaa= document.getElementById("aaaa").getContext("2d");
 
    // draw pie chart
    new Chart(countries).Pie(pieData, pieOptions);

    new Chart(categories).Pie(pieData2, pieOptions);
    // new Chart(aaaa).Pie(pieData, pieOptions);
</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->