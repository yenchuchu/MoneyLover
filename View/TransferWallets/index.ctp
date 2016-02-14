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
   
                <!-- <form id="search" role="form" action="#" method="GET" class="form-inline form-search-top"> -->
           <?php  //echo $this->Form->input('categorie_id', array('options' => $categories,
                                                                // 'class' => 'select-style select2-offscreen',
                                                                // 'style' => 'background-color: rgba(251, 248, 248, 0.95)',
                                                                // 'label' => false,
                                                                // 'div' => false ));  ?>
<!--             <select name="money" class="select-style select2-offscreen" tabindex="-1" title="Chonj tien"  >
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
                   </form>   -->

    <!-- Contact Section -->
    <section id="transaction" class="content-section text-center">
        <span >
            <h1>Transfer Wallet</h1>

<!--            <button type="button" style="position: relative;     top: -130px;
    right: -282px;" data-toggle="modal" data-target="#add-Transfer Wallet" > Add Transactions </button> -->
        </span> 
<?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?>
 <a href="#add-category" style="position: relative;
    top: -82px;
    right: -250px;
    border: none;
    padding: 7px 24px;
    font-size: 17px;
    border-radius: 5px;
    background-color: rebeccapurple;
    color: white;
    "> Add Category</a>
        <div class="row" style="margin-right:0px; margin-bottom: 10px">

            <div class="col-lg-10 col-lg-offset-1">
               
                <div id="transaction-month" class="transaction-wrapper">
                   
                    <div class="panel-body" style="position: relative;">
                        <table style="    width: 100%;"  class="table table-striped table-hover">
                            <thead>
                                <th></th>
                                <th><?php echo $this->Paginator->sort('id'); ?></th>
                                <th><?php echo $this->Paginator->sort('Sent to'); ?></th>
                                <th><?php echo $this->Paginator->sort('receive to'); ?></th>
                                <th><?php echo $this->Paginator->sort('Transfer Money'); ?></th>
                                <th><?php echo $this->Paginator->sort('Created'); ?></th>
                                <th><?php echo $this->Paginator->sort('Modified'); ?></th>
                                <th class="actions"><?php echo $this->Paginator->sort('Actions'); ?></th> 
                            </thead>
                            <?php foreach ($transferWallets as $transferWallet): ?>
                            <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td style="width: 10%;"><?php echo h($transferWallet['TransferWallet']['id']);  ?>&nbsp;</td>
                                <td><?php echo h($sentWallets[$transferWallet['TransferWallet']['sent_wallet_id']]);  ?>&nbsp;</td>
                                <td><?php echo h($receiveWallets[$transferWallet['TransferWallet']['receive_wallet_id']]);  ?>&nbsp;</td>
                                <td><?php echo h($transferWallet['TransferWallet']['transfer_money']);; ?>&nbsp;</td>
                                <td><?php echo h($transferWallet['TransferWallet']['created']); ?>&nbsp;</td>
                                <td><?php echo h($transferWallet['TransferWallet']['modified']);; ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link('Edit', array('action' => 'edit', $transferWallet['TransferWallet']['id']), array('class' => 'edit-transferWallet', 'style' => 'width:10%')); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transferWallet['TransferWallet']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transferWallet['TransferWallet']['id']), 'class' => 'delete-transferWallet',  'style' => 'width:10%', 'id' => 'delete-transferWallet'
                                                                )); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <!-- phan trang -->

<div class="page" style="    position: absolute;
    bottom: 5px;    width: 100%;">
     <span style="    float: left;
    margin-left: 30px;
    width: 50%;">
    <input type="checkbox" name="vehicle" value="Bike" style="float: left"><span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">Select All</span>
    <a href="edit-transaction.html" title="edit" class="edit-transaction" style=" color: black;"><i class="fa fa-pencil"></i>Edit</a>
    <a href="#delete-transaction" title="delete" class="delete-transaction"  style=" color: black;"><i class="fa fa-trash"></i>Delete</a>
    </span>
       <div class="paging">
        <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
        </div>

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


                                <div id="add-category" class="modalDialog">      
                        <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="    margin-bottom: 15px !important; padding-top: 15px;">Add Transaction</h3>
                            </div> 
                            <div class="panel-body" style="color: black;">
                                <?php echo $this->Form->create('Transaction',array('action' => 'add')); ?>
                                <div class="form-group" style="    width: 100%;
    text-align: left;"> 
                                    <?php echo $this->Form->input('wallet_id'); ?>
                                </div>
                                <div class="form-group" style="text-align: left;  width: 100%;">
                                        <?php echo $this->Form->input('categorie_id', array('options' => $categories));  ?>
                                </div>
                                <div class="form-group" style="text-align: left;  width: 100%;">
                                        <?php echo $this->Form->input('transaction_money', array('placeholder'=>'enter money', 'style'=>'padding-left: 8px')); ?>
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
                    <!-- /#add-category -->
            </div>
        </div>
    </div>
    
            <!-- /.col-lg-5 -->
        </div>
    </section>
 