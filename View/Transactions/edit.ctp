<!-- Navigation -->
<nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="../Users/index">
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
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div> 
<!-- /#change-password --> 

<!-- Contact Section -->
<section id="transaction" class="content-section text-center">
    <div class="categories-section">
        <div class="container">
            <div class="panel-heading" style="background-color: transparent !important;  padding-bottom: 0;">
                <h1><?php echo __('Edit Transactions'); ?></h1>
                <div class="panel-body"> 
                    <div class="col-lg-8 col-lg-offset-2 categories-income"> 
                        <table style="    width: 100%;" class="table table-striped table-hover">
                            <thead>
                            <th><?php echo $this->Paginator->sort('Category'); ?></th>
                            <th><?php echo $this->Paginator->sort('Wallet'); ?></th> 
                            <th><?php echo $this->Paginator->sort('Money'); ?></th>            
                            </thead>
                            <?php //foreach ($categories as $category): ?>
                            <?php echo $this->Form->create('Transaction'); ?>
                            <tr> 
                                <?php echo $this->Form->input('id'); ?>
                                <td><?php echo $this->Form->input('categorie_id', array('label' => false, 'style' => '    padding-left: 10px;
    border: 1px solid gray;
    border-radius: 5px;    position: relative;
    top: 5px;color: black;')); ?>&nbsp;</td> 
                                <td><?php echo $this->Form->input('wallet_id', array('label' => false, 'style' => '    padding-left: 10px;
    border: 1px solid gray;
    border-radius: 5px;    position: relative;
    top: 5px;color: black;')); ?>&nbsp;</td>
                                <td><?php echo $this->Form->input('transaction_money', array('label' => false, 'placeholder' => 'enter money', 'style' => '    padding-left: 10px;
    border: 1px solid gray;
    border-radius: 5px;    position: relative;
    top: 5px;color: black;')); ?>&nbsp;</td>
                            <span class="type-money" style="    top: 80px;
                                  left: 40%;    color: black;">VND</span>   
                            </tr>
                            <?php //endforeach; ?>
                        </table> 
                        <?php
                        $sumbit = array(
                            'class' => 'btn wallet-save',
                            'div' => array(
                                'class' => 'submit-wallet',
                                'style' => 'margin-top:30px;'
                            )
                        );
                        echo $this->Form->end($sumbit);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
