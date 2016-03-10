<?php echo $this->Flash->render('positive') ?>

<!--Navigation -->
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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="padding-top: 0px">
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

<!-- Contact Section -->
<section id="wallet" class="content-section text-center">
    <span style="    position: relative;
          top: -50px;">
        <h1 style="color: black;top: 37px;
            position: relative;">My Wallets</h1> 
    </span> 
    <a href="#add-category" style="position: relative;
       top: -79px;
       right: -250px;
       border: none;
       padding: 7px 24px;
       font-size: 17px;
       border-radius: 5px;
       background-color: rebeccapurple;
       color: white;
       "> Add Wallet</a> 
    <div class="row" style="margin-right:0px">
        <?php foreach ($wallets as $wallet): ?> 
    <?php //echo h($users[$wallet['Wallet']['user_id']]);   ?>
            <div class="col-lg-5 " style=" ">
                <h2 style="border-bottom: 1px solid;  padding-top: 8px;">
    <?php echo h($wallet['Wallet']['name']); ?> 
                </h2>

                <span class="wallet-info"><i class="fa fa-smile-o"></i> Wallet Info:</span>
                <p style="text-align: left; font-size: 16px; padding-top: 3px;"><i>
                        <?php
                        if ($wallet['Wallet']['info'] == NULL) {
                            echo "--No description--";
                        } else
                            echo h($wallet['Wallet']['info']);
                        ?> <br> 
                    </i></p>
                <span class="wallet-current-money"><i class="fa fa-smile-o"></i> Current money: </span>
                <p style="text-align: left;"> 
    <?php
    echo $this->Number->currency($wallet['Wallet']['money_current'], ' VND', $options = array('thousands' => '.',
        'wholePosition' => 'after', 'places' => 0
    ));
    ?> </p>
                <span style="float: left; margin-bottom: 20px;">
                    <i> Create:    &nbsp; <?php echo $this->Time->format($wallet['Wallet']['created'], '%B %e, %Y'); ?><br>
                        Modified:  &nbsp;  <?php echo $this->Time->format($wallet['Wallet']['modified'], '%B %e, %Y'); ?><br>
                    </i>
                </span>
                <div class="action-wallet" style="    margin-top: 80px; border-top: 1px solid;"> 
                    <button class="edit-wallet" style=" float: left;    width: 40%;"> <?php echo $this->Html->link('Edit', array('action' => 'edit', $wallet['Wallet']['id']), array('id' => 'edit-wallet', 'style' => 'width:10%')); ?> </button>
                    <button class="delete-wallet"  style="  width: 40%;"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wallet['Wallet']['id']), array('style' => 'color: white'), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?></button>
                </div>

            </div>
<?php endforeach; ?>
    </div>
</section> 
<div id="add-category" class="modalDialog">      
    <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
        <div class="panel-heading">
            <h3 class="panel-title" style="margin-bottom: 15px !important; padding-top: 15px;">Add Wallet</h3>
        </div> 
        <div class="panel-body" style="color: black;">
            <form action="/MoneyLover/wallets/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                <div style="display:none;"><input type="hidden" name="_method" value="POST"></div> 
                <div class="form-group">
                    <label class="control-label" for="CategoryName" style="    padding-right: 0;">Wallet Name:</label>
                    <input name="data[Wallet][name]" class="form-control" placeholder="Wallet Name" maxlength="64" type="text" id="WalletName" required="required">
                </div>
                <div class="form-group" style="height: 60px;">
                    <label class="control-label" for="CategoryName" style="    padding-right: 0;">Current Money:</label>
                    <input name="data[Wallet][money_current]" step="any" type="number" class="form-control" placeholder="Wallet Name" id="WalletMoneyCurrent" required="required">

                </div>
                <div class="form-group">
                    <label class="control-label" for="CategoryName" style="    padding-right: 0;">Info Wallet:</label>
                    <input name="data[Wallet][info]"  class="form-control" placeholder="Wallet Name" maxlength="500" type="text" id="WalletInfo">
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10 submit-wallet" style = "margin-top: 16px;
                         width: 100%;
                         margin-left: -10px"> 
                        <a href="#close"  class="btn wallet-save " style="color: white;
                           text-decoration: none;float: left;
                           margin-right: -13px;">Cancel</a>
                        <button type="submit" class="btn wallet-save" style="float: right;
                                margin-right: -13px;
                                ">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /#add-Wallet --> 
