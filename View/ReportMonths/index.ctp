<!--Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <i class="fa fa-play-circle" id="icon-banner"></i>
            <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'wallets', 'action' => 'index'), array('id' => 'banner')); ?> 
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
                    <?php echo $this->Html->link(__('Report Month'), array('controller' => 'ReportMonths', 'action' => 'index')); ?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 0px">
                        <?php
                        echo $this->Form->create('User', array('url' => array('controller' => 'User', 'action' => 'index')));
                        $avatar = AuthComponent::user('avatar');
                        if ($avatar != NULL) {
                            echo $this->Html->image('../image_avatar/' . $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                        }
                        ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Update Avatar', array('controller' => 'users', 'action' => 'UploadImage', $id));
                            ?>
                        </li> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password', $id));
                            ?>
                        </li> 
                        <li>
<?php echo $this->Html->link(__('Log out'), array('controller' => 'users', 'action' => 'logout')); ?>
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
<!--      <form id="search" role="form" action="#" method="GET" class="form-inline form-search-top">
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
        </form>   -->

<!-- Contact Section -->

<section id="report-month" class="content-section text-center">
    <span style="    position: relative;
          top: -50px;">
        <h1 style="    top: 65px;
            position: relative;">Report Month</h1>  
    </span>

    <div class="row" style=" margin-right:0px; 
         margin-bottom: 10px;    margin-top: 10%;">
        <div class="col-lg-10 col-lg-offset-1" style="margin-bottom: 30px; top:-51px">
<?php foreach ($months as $key => $month) { ?>
                <div class="panel-heading" style="    text-align: left;">
                    <i class="fa fa-bar-chart-o fa-fw" style="    font-size: 24px;
                       float: left;"></i> 
                    <span style="    font-size: 20px; font-weight: bold;    padding-left: 5px;">
    <?php //echo $this->Time->format($month, '%B  %Y') 
    echo h($month)
    ?>
                    </span> 
                </div>
                <div class="panel-body" style="margin-bottom: 4%;border: 1px solid #83202E; background-color: rgba(255, 255, 255, 0.23)" >
                    <div style="float: left; width: 50%;">
                        <h3>Thu-Chi</h3>
                        <canvas id="<?php echo h($month); ?>" width="600" height="400" style="position: relative; left: -47px;"></canvas> 
                    </div>
                    <div style="float: left; width: 50%;">
                        <h3>categories</h3>
                        <canvas id="<?php echo h($month) . "-cate"; ?>" width="600" height="400" style="position: relative; left: -47px;"></canvas>
                    </div>
                </div>
<?php } ?>
            <!-- /.panel-body -->
        </div>
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




    var pieDataCategories = <?php echo json_encode($pieDataCategories) ?>;
    var pieData = <?php echo json_encode($pieData); ?>;
    var months = <?php echo json_encode($months); ?>
    // pie chart options
    var pieOptions = {
        segmentShowStroke: false,
        animateScale: true
    }
    var i;
    var countries = new Array();
    var categories = new Array();
    // get pie chart canvas
    for (i = 0; i < months.length; i++) {
        // alert(months[i]+"-cate");
        countries[i] = document.getElementById(months[i]).getContext("2d");

        categories[i] = document.getElementById(months[i] + "-cate").getContext("2d");
    }
    // console.log(categories);
    // var categories = document.getElementById("chart-categories").getContext("2d");
    // var aaaa= document.getElementById("aaaa").getContext("2d");

    // draw pie chart

    for (i = 0; i < months.length; i++) {
        var month = months[i];
        new Chart(countries[i]).Pie(pieData[month], pieOptions);
        new Chart(categories[i]).Pie(pieDataCategories[month], pieOptions);
    }


    // new Chart(categories).Pie(pieDataCategories, pieOptions);
    // new Chart(aaaa).Pie(pieData, pieOptions);
</script>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>


<!-- Custom Theme JavaScript