<!--Navigation -->
    <nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000 !important; margin-bottom: 0px;">
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
                <?php //echo h($users[$wallet['Wallet']['user_id']]);  ?>
            <div class="col-lg-5 " style=" ">
                <h2 style="border-bottom: 1px solid;  padding-top: 8px;">
                <?php echo h($wallet['Wallet']['name']); ?> 
                </h2>
               
                <span class="wallet-info"><i class="fa fa-smile-o"></i> Wallet Info:</span>
                <p style="text-align: left; font-size: 16px; padding-top: 3px;"><i><?php echo h($wallet['Wallet']['info']); ?> <br>
                    Create:    &nbsp; <?php echo h($wallet['Wallet']['created']); ?><br>
                    Modified:  &nbsp;  <?php echo h($wallet['Wallet']['modified']); ?><br>
                </i></p>
                <span class="wallet-current-money"><i class="fa fa-smile-o"></i> Current money: </span>
                <p style="text-align: left;"> <?php echo h($wallet['Wallet']['money_current']); ?></p>
                <span class="wallet-transfer"><i class="fa fa-smile-o"></i> Transfer:  </span><br><br>
                <table>
                    <tr>
                        <td>recive/send</td>
                        <td>transfer wallet</td>
                        <td>money</td>
                        <td>date</td>
                    </tr>
                    <tr>
                    <?php array('controller' => 'transactions', 'action' => 'index') ?>
                        <td>recive</td>
                        <td>wallet 01</td>
                        <td>50.000</td>
                        <td>15/3/2015</td>
                    </tr>
                    <tr>
                        <td>send</td>
                        <td>wallet 02</td>
                        <td> 2.000.000</td>
                        <td>19/6/2015</td>
                    </tr>
                </table>
                <div class="action-wallet" style="    margin-top: 55px; border-top: 1px solid;">
                 
                <a href="#add-transfer" style="float: left;    padding: 9px 12px; width: 30%;margin-top: 20px;    background-color: #7049A2;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    "> Add Transfer</a> 
                <!-- <button type="button" style="    position: relative;
                top: -72px;
                right: -250px;
                border: none;
                padding: 7px 24px;
                font-size: 17px;
                border-radius: 5px;
                background-color: rebeccapurple;
                " > <a href="#edit-category" style="color: white;">Edit Wallet</a> </button> -->
<button class="edit-wallet"> <?php echo $this->Html->link('Edit', array('action' => 'edit', $wallet['Wallet']['id']), array('id' => 'edit-wallet', 'style' => 'width:10%')); ?> </button>
                <button class="delete-wallet"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wallet['Wallet']['id']),array('style' => 'color: white'), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?></button>
</div>
                
            </div>
            <?php endforeach; ?>
        </div>
    </section> 
                    <div id="add-transfer" class="modalDialog">      
                        <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="    margin-bottom: 15px !important; padding-top: 15px;">Add Wallet</h3>
                            </div> 
                            <div class="panel-body" style="color: black;">
                                <form action="/MoneyLover/transfer/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                                <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                                  <div class="form-group">
                                  <label class="control-label" for="CategoryName" style="    padding-right: 0;">Wallet Name:</label>
                                        <input name="data[Wallet][name]" class="form-control" placeholder="Wallet Name" maxlength="64" type="text" id="WalletName" required="required">
                                    </div>
                                     <div class="form-group">
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
    <button type="submit" class="btn wallet-save " style="float: left;
    margin-right: -13px;
"><a href="#close" style="color: white;
    text-decoration: none;">Cancel</a></button>
                                        <button type="submit" class="btn wallet-save" style="float: right;
    margin-right: -13px;
">Add</button>
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /#add-transfer --> 

                <div id="add-category" class="modalDialog">      
                        <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="    margin-bottom: 15px !important; padding-top: 15px;">Add Wallet</h3>
                            </div> 
                            <div class="panel-body" style="color: black;">
                                <form action="/MoneyLover/wallets/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                                <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                                  <div class="form-group">
                                  <label class="control-label" for="CategoryName" style="    padding-right: 0;">Wallet Name:</label>
                                        <input name="data[Wallet][name]" class="form-control" placeholder="Wallet Name" maxlength="64" type="text" id="WalletName" required="required">
                                    </div>
                                     <div class="form-group">
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
    <button type="submit" class="btn wallet-save " style="float: left;
    margin-right: -13px;
"><a href="#close" style="color: white;
    text-decoration: none;">Cancel</a></button>
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