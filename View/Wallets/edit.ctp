<!-- Navigation -->
<nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000 !important; margin-bottom: 0px;">
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
<section id="wallet" class="content-section text-center">
    <span style="    position: relative;
          top: -50px;">
        <h1 style="color: black;top: 37px;
            position: relative;">Edit Wallets</h1> 
    </span>  
    <div class="row" style="margin-right:0px"> 

        <div class="col-lg-5  " style=" margin-left: 30%;
             ">

            <?php echo $this->Form->create('Wallet'); ?>
            <?php
            echo $this->Form->input('id');
            //echo $this->Form->input('user_id');
            ?>
            <h2 style="border-bottom: 1px solid;  padding-top: 8px;">
                <?php echo $this->Form->input('name', array('label' => false, 'style' => 'text-align: center; 
    border-radius: 5px;   margin-bottom: 15px;    width: 85%;
    margin-left: 37px;', 'class' => 'form-control')); ?>
            </h2>

            <span class="wallet-info"><i class="fa fa-smile-o"></i> Wallet Info:</span>
            <?php echo $this->Form->textarea('info', array('label' => false, 'style' => 'padding-left: 8px;    position: relative;
    width: 64%;
    border-radius: 5px;', 'class' => 'form-control')); ?>  <br> 
            <span class="wallet-current-money"><i class="fa fa-smile-o"></i> Current money: </span>
            <?php echo $this->Form->input('money_current', array('label' => false, 'style' => '    padding-left: 8px;
    width: 43%;
    position: relative;
    right: 1%;
    border-radius: 5px;', 'class' => 'form-control')); ?>  <span class="type-money">VND</span>     
        </div>
        <?php
        $sumbit = array(
            'class' => 'btn wallet-save',
            'style' => ' margin-left: 30%; width: 20%;',
            'div' => array(
                'class' => 'submit-wallet',
                'style' => 'margin-top:30px;'
            )
        );
        echo $this->Form->end($sumbit);
        ?>
</section> 
