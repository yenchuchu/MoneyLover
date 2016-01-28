<!-- Navigation -->
    <nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000; margin-bottom: 0;">
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Update Avatar</a>
                        </li>
                        <li><a href="#change-password"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        <?php echo $this->Html->link(__('Log Out'), array('action' => 'logout')); ?>
                        <a class="page-scroll" href="main.html">Log Out</a>

                        </li>
                    </ul>
                      </li>  
                    <li>
                        <?php echo $this->Html->link(__('Log Out'), array('action'=>'logout'));
?>
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
           <?php  echo $this->Form->input('categorie_id', array('options' => $categories,
                                                                'class' => 'select-style select2-offscreen',
                                                                'style' => 'background-color: rgba(251, 248, 248, 0.95)',
                                                                'label' => false,
                                                                'div' => false ));  ?>
            <select name="money" class="select-style select2-offscreen" tabindex="-1" title="Chonj tien"  >
             <option value="">-- Select Money--</option>
                <option value="">10000</option>
                <option value="10">50000</option>
                <option value="">100000</option>
                <option value="">200000</option>
                <option value="">500000</option>
                <option value="">>500000</option>
            </select>
                <input type="date" >
                <button class="btn btn-default" type="button" style="    color: rgba(255,255,255,.5); background: rgba(0,0,0,.13); border: 1px solid rgba(0,0,0,.13);     border: none;" title="search">
                    <i class="fa fa-search"></i>
                </button>
                   </form>  

    <!-- Contact Section -->
    <section id="transaction" class="content-section text-center">
        <span >
            <h1>Transactions</h1>
<!--            <button type="button" style="position: relative;     top: -130px;
    right: -282px;" data-toggle="modal" data-target="#add-transaction" > Add Transactions </button> -->
        </span> 
<?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?>
        <div class="row" style="margin-right:0px; margin-bottom: 10px">

            <div class="col-lg-8 col-lg-offset-2">
               
                <div id="transaction-month" class="transaction-wrapper">
                   
                    <div class="panel-body" style="position: relative;">
                        <ul style="padding-left: 0;     padding-bottom: 50px;" id="transaction-content"> 
                            <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:15%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Category</b></span>
                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black;"><b>Wallet</b></span>
                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black;"><b>Money</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;"><b>Create</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;"><b>Modified</b> </span>
                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black;"><i class="fa fa-pencil"></i><b>Edit</b></span>
                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black; text-align: right"><i class="fa fa-trash"></i><b>Delete</b></span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <?php foreach ($transactions as $transaction): ?>
                                <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:15%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;">
                                            <?php
                                             if (!isset($transaction['Transaction']['categorie_id'])):
                                                echo '-Deleted-';
                                             else:
                                             echo h($categories[$transaction['Transaction']['categorie_id']]); 
                                            endif;
                                         ?></span>  
                                            

                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black;"><?php echo h($wallets[$transaction['Transaction']['wallet_id']]); ?> </span>

                                            <span style="width:10%; float: left; font-size: 17px; padding-top: 4px; color: black;"><?php echo h($transaction['Transaction']['transaction_money']); ?> VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;"><?php echo h($transaction['Transaction']['created']); ?></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;"><?php echo h($transaction['Transaction']['modified']); ?></span>
                                            <?php
                                             echo $this->Html->link('Edit', array('action' => 'edit', $transaction['Transaction']['id']), array('class' => 'edit-transaction', 'style' => 'width:10%'));
                                            echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transaction['Transaction']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transaction['Transaction']['id']), 'class' => 'delete-transaction',  'style' => 'width:10%', 'id' => 'delete-transaction'
                                        ));
                                     ?>
                                    
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- phan trang -->

<div class="page" style="    position: absolute;
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
     <span style="    float: left;
    margin-left: 30px;
    width: 50%;">
    <input type="checkbox" name="vehicle" value="Bike" style="float: left"><span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">Select All</span>
    <a href="edit-transaction.html" title="edit" class="edit-transaction" style=" color: black;"><i class="fa fa-pencil"></i>Edit</a>
    <a href="#delete-transaction" title="delete" class="delete-transaction"  style=" color: black;"><i class="fa fa-trash"></i>Delete</a>
    </span>
</div>

         
                <div id="delete-transaction" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-body" style="color: black; border-top: 1px solid #841717;">
                            <p>Are you want to delete?</p>
                            <div class="submit-wallet">
                                <a href="#show-a-transaction" class="btn wallet-cancel">Cancel</a>
                                <a href="#" class="btn wallet-save">Delete</a>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /#delete-transaction -->
                <div id="add-transaction" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <div class="modal-content" style="width: 80%; height: 414px;">
                        <div class="modal-header">
                            <h4 class="modal-title" >Add Transaction</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group" style="float: left;">
                                        <select name="cars" style="border: 1px solid #9A3745; border-radius:5px; padding: 3px;">
                                            <option value="volvo">Select Category:</option>
                                            <option value="volvo">Shopping</option>
                                            <option value="saab">Travel</option>
                                            <option value="fiat">Fiat</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Enter Money" name="transaction-money" type="number" value="">
                        </div>
                        <div class="form-group">
                            <!-- <i class="fa fa-delete"></i> -->
                            <textarea class="form-control" placeholder="Note..." name="transaction-money" rows="5" value=""></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <i class="fa fa-calendar"></i>  -->
                            <input class="form-control" placeholder="Date..." name="transaction-money" type="date" value="">
                        </div>
                                    <!-- <a href="#" class="">Forgotten your password? </a> -->
                                    <!-- Change this to a button or input when using this as a form -->
                                    
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer-transaction" style="margin: 0 15px;">
                            <button type="button" class="btn btn-default add-transaction-save" data-dismiss="modal">Add</button>
                            <button type="button" class="btn btn-default add-transaction-cancel" data-dismiss="modal">Cancel</button>
                        </div> 
                    </div>

                  </div>
                </div>
                 <!-- /.add-transaction -->
            </div>
        </div>
    </div>
    
            <!-- /.col-lg-5 -->
        </div>
    </section>
 