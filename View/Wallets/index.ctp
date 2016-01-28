<!-- Navigation -->
    <nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000 !important; margin-bottom: 0px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index-user.html">
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
            <h1 style="margin-bottom: 0; color: white">My Wallets</h1>          
            <!--<button type="button" style="position: relative; top: -39px; right: -250px ;" data-toggle="modal" data-target="#add-wallet" > Add Wallet </button>-->
        </span>
        <?php echo $this->Html->link(__('New Wallet'), array('action' => 'add')); ?>
        <div class="row" style="margin-right:0px">
            <?php foreach ($wallets as $wallet): ?>
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

                <p style=" margin-bottom: 10px; margin-top: 15px;"><a href="#update-info-wallet" style=" color: #CEE9FF;">Update Wallet Info</a></p>
                <p style=" margin-bottom: 20px;color: #AB3035;"><a href="#update-info-wallet"  style=" color: #CEE9FF;">Update Current Money</a></p>
                <button type="button" data-toggle="modal" data-target="#add-transfer" > Add Transfer </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
                        <div id="update-info-wallet" class="modalDialog">      
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <!-- <a href="#close" title="Close" class="close">X</a> -->
                                    <h3 class="panel-title">Update Wallet Info</h3>
                                </div>
                                <div class="panel-body" style="color: black;">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Info Wallet..." name="info-wallet" rows="7" value=""></textarea>
                                </div>
                                    <div class="submit-wallet">
                                        <a href="#" class="btn wallet-save">Save</a>
                                        <a href="#close" class="btn wallet-cancel">Cancel</a>
                                    </div> 
                                </div>
                            </div>
                        </div>
               
                <div id="update-current-money" class="modalDialog ">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <!-- <a href="#close" title="Close" class="close">X</a> -->
                            <h3 class="panel-title">Current Money</h3>
                        </div>
                        <div class="panel-body" style="color: black;">
                            <p> Now, you having <span> $money </span>. </p>
                            <div class="form-group">
                            <label>Update Current Money:</label>
                            <input class="form-control" placeholder="Enter Money" name="current-money" type="number" value="">
                            </div>
                            <div class="submit-wallet">
                                <a href="#" class="btn wallet-save">Save</a>
                                <a href="#close" class="btn wallet-cancel">Cancel</a>
                            </div>

                        </div>
                    </div>
                </div> 
                <!-- /#current-money -->
               
                 <div id="add-transfer" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <div class="modal-content" style="width: 80%; height: 290px;">
                        <div class="modal-header">
                            <h4 class="modal-title" >Add Transfer</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                       <label style=" text-align: left; color: black; font-size: 15px;">Select Wallet:</label>
                                        <select name="cars" style=" border:1px solid rgba(132, 12, 29, 0.82);
    border-radius: 5px;">
                                            <option value="volvo">one wallet</option>
                                            <option value="saab">two wallet</option>
                                            <option value="fiat">three wallet</option>
                                            <option value="audi">four wallet</option>
                                        </select>
                                    </div>
                                     <div class="form-group">
                                        <input class="form-control" placeholder="Enter Money Transfer" name="money-transfer" type="number" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Enter Password" name="password" type="password" value="">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer-transfer" style="margin: 0 15px;">
                            <button type="button" class="btn btn-default transfer-save" data-dismiss="modal">Add</button>
                            <button type="button" class="btn btn-default transfer-cancel" data-dismiss="modal">Cancel</button>
                        </div> 
                    </div>

                  </div>
                </div>
                <!-- /#transfer-money -->
                
                <div id="add-wallet" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <div class="modal-content" style="width: 80%; height: 375px;">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Wallet</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Wallet Name" name="wallet-name" type="text" value="">
                                    </div>
                                     <div class="form-group">
                                        <input class="form-control" placeholder="Current Money" name="current-money" type="number" value="">
                                    </div>
                                      <div class="form-group">
                                        <textarea class="form-control" placeholder="Info Wallet" name="info-wallet" rows="5" value=""></textarea>
                                    </div>
                                    <!-- <a href="#" class="">Forgotten your password? </a> -->
                                    <!-- Change this to a button or input when using this as a form -->
                                    
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer-wallet" style="margin: 0 15px;">
                            <button type="button" class="btn btn-default add-wallet-save" data-dismiss="modal">Add</button>
                            <button type="button" class="btn btn-default add-wallet-cancel" data-dismiss="modal">Cancel</button>
                        </div> 
                    </div>

                  </div>
                </div>
                <!-- /#add-wallet -->