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
                        <a class="page-scroll" href="wallet.html">My Wallets </a>
                    </li>
                    </li>
                    <li>
                        <a class="page-scroll" href="transaction.html">Transactions</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="report-month.html">Report Month</a>
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
        <h1><?php echo __('Add Transactions'); ?></h1>
        <div class="row" style="margin-right:0px; margin-bottom: 10px">
            <div class="col-lg-8 col-lg-offset-2">
                <div id="transaction-month" class="transaction-wrapper"> 
                    <div class="panel-body" style="position: relative; min-height: 60px;">    
                        <ul>
                           <li>
                                <div class="transaction-detail-wrapper">
                                    <div style="padding-bottom: 15px; padding-top: 5px;">
                                        <div class="transactions form">
                                            <?php echo $this->Form->create('Transaction'); ?>
                                        	<fieldset> 
                                        	  <div class="form-group" style="float: left;    margin-left: 30px;"><?php echo $this->Form->input('categorie_id', array('options' => $categories));  ?>
                                              </div>
                                              <div class="form-group" style="float: left;    margin-left: 30px;"> <?php echo $this->Form->input('wallet_id'); ?>
                                              </div>
                                              <div class="form-group" style="float: left; margin-left: 30px;"> <?php echo $this->Form->input('transaction_money'); ?>
                                              </div>
                                        	</fieldset>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php  
        $sumbit = array(
            'class' => 'btn wallet-save',
            'div' => array(
                'class' => 'submit-wallet',
                'style' => 'margin-top:30px; margin-left: 225px;'
                )
            );
            echo $this->Form->end($sumbit);
        ?>
    </section>
