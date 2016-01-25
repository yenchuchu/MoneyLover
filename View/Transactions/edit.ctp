<!-- <div class="transactions form">
<?php echo $this->Form->create('Transaction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Transaction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('categorie_id');
		echo $this->Form->input('wallet_id');
		echo $this->Form->input('transaction_date');
		echo $this->Form->input('transaction_money');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Transaction.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Transaction.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categorie'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Wallets'), array('controller' => 'wallets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wallet'), array('controller' => 'wallets', 'action' => 'add')); ?> </li>
	</ul>
</div>
 -->

 <!-- ............................... -->

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
            <select name="money" class="select-style select2-offscreen" tabindex="-1">
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
         <h1> Change Transactions</h1>
      
        <div class="row" style="margin-right:0px; margin-bottom: 10px">

            <div class="col-lg-8 col-lg-offset-2">
            <div id="transaction-month" class="transaction-wrapper">
                   
                    <div class="panel-body" style="position: relative; min-height: 60px;">
                        
               <ul>
                   <li>
                   <div class="transaction-detail-wrapper">
                   <div style="padding-bottom: 15px; padding-top: 5px;">
                        <select name="cars" style="float: left; margin-right: 30px; margin-left: 10px; margin-top: 7px;"> 
                            <option value="income" disabled style="color: red;">Income</option>
                            <option value="">Award</option>
                            <option value="10">Bán hàng</option>
                            <option value="">Interest Money</option>
                            <option value="">Salary</option>
                            <option value="">Gifts</option>
                            <option value="">Selling</option>
                            <option value="expense" disabled  style="color: red;">Expense</option>
                            <option value="">Award</option>
                            <option value="10">Bán hàng</option>
                            <option value="">Interest Money</option>
                            <option value="">Salary</option>
                            <option value="">Gifts</option>
                            <option value="">Selling</option>
                        </select>
                        <input class="form-control" placeholder="Enter Money" name="transaction-money" type="number" value="" style=" width: 40%; top: 5px; position: relative;">
                    </div>
                </div>
            </li>
       </ul>
                   </div></div>     
        <div class="submit-wallet" style="margin-top:30px;">
            <a href="#" class="btn wallet-save">Save</a>
        </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
