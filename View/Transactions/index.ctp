<!-- <div class="transactions index">
	<h2><?php echo __('Transactions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('categorie_id'); ?></th>
			<th><?php echo $this->Paginator->sort('wallet_id'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_date'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_money'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($transactions as $transaction): ?>
	<tr>
		<td><?php echo h($transaction['Transaction']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($transaction['Categorie']['name'], array('controller' => 'categories', 'action' => 'view', $transaction['Categorie']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($transaction['Wallet']['name'], array('controller' => 'wallets', 'action' => 'view', $transaction['Wallet']['id'])); ?>
		</td>
		<td><?php echo h($transaction['Transaction']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['transaction_money']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['created']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transaction['Transaction']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transaction['Transaction']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categorie'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Wallets'), array('controller' => 'wallets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wallet'), array('controller' => 'wallets', 'action' => 'add')); ?> </li>
	</ul>
</div>
 -->

 <!-- ..........................  -->

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
                        <a class=" page-scroll"  href="wallet.html">My Wallets </a>
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
            <select name="category" class="select-style select2-offscreen" tabindex="-1" style="background-color: rgba(251, 248, 248, 0.95)">
                <option value="income" style="color: red;">Income</option>
                <option value="">Award</option>
                <option value="10">Bán hàng</option>
                <option value="">Interest Money</option>
                <option value="">Salary</option>
                <option value="">Gifts</option>
                <option value="">Selling</option>
                <option value="expense" style="color: red;">Expense</option>
                <option value="">Award</option>
                <option value="10">Bán hàng</option>
                <option value="">Interest Money</option>
                <option value="">Salary</option>
                <option value="">Gifts</option>
                <option value="">Selling</option>
            </select>
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
            <button type="button" style="position: relative;     top: -130px;
    right: -282px;" data-toggle="modal" data-target="#add-transaction" > Add Transactions </button>
        </span> 
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
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                             <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li> 
                             <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                             <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="transaction-detail-wrapper">
                                    <a href="#" class="transaction-detail">  
                                        <div style="padding-bottom: 15px; padding-top: 5px;">
                                            <input type="checkbox" name="vehicle" value="Bike" style="float: left">
                                            <span style="width:20%; float: left; text-align: left; padding-left: 12px; font-size: 17px; padding-top: 4px; color: black;"><b>Shopping</b></span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">5000000 VND</span>
                                            <span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">15/1/2016</span>
                                            <a  href="edit-transaction.html" title="edit" class="edit-transaction"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                                        </div>
                                    </a>
                                </div>
                            </li>
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
 