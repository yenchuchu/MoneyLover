<!-- <div class="categories index">
	<h2><?php echo __('Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['description']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['type']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
	</ul>
</div>
 -->

 <!-- .............................. -->

 <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index-admin.html">
                    <i class="fa fa-play-circle"></i>  <span class="light">Money</span> Lover
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li>
                        <a class=" dropdown-toggle page-scroll" data-toggle="dropdown">Accounts 
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="account-active.html">account active</a></li>
                          <li><a href="account-request.html">account request</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="page-scroll" href="admin-categories.html">Categories</a>
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

    <section id="categories" class="content-section text-center">
        <div class="categories-section">
            <div class="container">
                    <div class="panel-heading" style="background-color: transparent !important;  padding-bottom: 0;">
                        <h1>Categories</h1>
                      <button type="button" style="    position: relative;
    top: -72px;
    right: -250px;
    border: none;
    padding: 7px 24px;
    font-size: 17px;
    border-radius: 5px;
    background-color: rebeccapurple;
    " > <a href="#add-category" style="color: white;">Add Category</a> </button>

                    </div>
                    <div class="panel-body">
                        <div class="col-lg-6 categories-income">

                            <h3> Income </h3> 
                        <table>
                             <tr>
                                <td> </td>
                                <td>icon</td>
                                <td>Category</td>
                                <td>Day Create</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Award</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Interest Money</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Salary</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Gifts</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </table>
                    </div>
                        <div class="col-lg-6 categories-expense">
                            <h3> Expense </h3>
                      <table>
                             <tr>
                                <td> </td>
                                <td>icon</td>
                                <td>Category</td>
                                <td>Day Create</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Award</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Interest Money</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Salary</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                             <tr>
                                <td> <input type="checkbox" name="vehicle" value="Bike" style="float: left"></td>
                                <td><i class="fa fa-trophy fa-2x"></i></td>
                                <td>Gifts</td>
                                <td>15/2/2015</td>
                                <td><a href="edit-category.html" title="edit" class="edit-transaction"><i class="fa fa-pencil" style="color: #3C3131;"></i></a></td>
                                <td><a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </table>  
                        </div>
                        <span style="    float: left;
    margin-left: 30px;
    width: 50%;">
    <input type="checkbox" name="vehicle" value="Bike" style="float: left"><span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">Select All</span>
    <a href="edit-category.html" title="edit" class="edit-transaction" style=" color: black;"><i class="fa fa-pencil"></i>Edit</a>
    <a href="#delete-transaction" title="delete" class="delete-transaction" style=""><i class="fa fa-trash"></i>Delete</a>
                       
                    </div>
                    <div id="category-details" class="modalDialog ">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-body" style="color: black;border-top: 1px solid #841717;">
                                <i class="fa fa-calendar" style="font-size: 22px; float: left; padding-top: 10px; background-color: black; margin-left: 3px; border-radius: 50%; height: 42px; width: 14%; color: #55DE9A;" title="Caterory"></i>
                                <span style=" float: left; text-align: left; padding-left: 12px; font-size: 20px; padding-top: 6px; font-weight: bold; color: black;width:80%;"><b>Shopping</b></span>
                                <p style="text-align: left; padding-left: 60px; padding-top: 39px;">Income</p>
                                <div class="submit-category">
                                    <a href="#edit-category" class="btn category-edit" style="width: 30%;">Edit</a>
                                    <a href="#delete-category" class="btn category-delete">Delete</a>
                                    <a href="#close" class="btn category-cancel" style="width: 30%;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- /#category-detail -->
                    <!-- <div id="edit-category" class="modalDialog">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Edit Category</h3>
                            </div>
                            <div class="panel-body" style="color: black;">
                                <div class="form-group">
                                    <label style="text-align: left; margin-left: -127px; font-size: 15px;">Select Icon:</label>
                                    <select name="cars">
                                        <option value="volvo">a</option>
                                        <option value="saab">b</option>
                                        <option value="fiat">c</option>
                                        <option value="audi">d</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Name Category" name="name-category" type="text" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="admin-income" type="checkbox" value="Income">Income
                                </label>
                                <label>
                                    <input name="admin-expense" type="checkbox" value="Expense">Expense
                                </label>
                            </div>
                                <div class="submit-edit-category">
                                    <a href="#" class="btn edit-category-save">Save</a>
                                    <a href="#category-details" class="btn edit-category-cancel">Cancel</a>
                                </div> 
                            </div>
                        </div>
                    </div> -->
                    <!-- /#edit-category -->

                    <div id="delete-category" class="modalDialog">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-body" style="color: black; border-top: 1px solid #841717;">
                                <p>Are you want to delete?</p>
                                <div class="submit-delete-category">
                                    <a href="#category-details" class="btn delete-category-cancel">Cancel</a>
                                    <a href="#" class="btn delete-category-delete">Delete</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /#delete-category -->
                    <div id="add-category" class="modalDialog">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add Category</h3>
                            </div>
                            <div class="panel-body" style="color: black;">
                                <div class="form-group">
                                    <label style="text-align: left; margin-left: -127px; font-size: 15px;">Select Icon:</label>
                                    <select name="cars">
                                        <option value="volvo">a</option>
                                        <option value="saab">b</option>
                                        <option value="fiat">c</option>
                                        <option value="audi">d</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Name Category" name="name-category" type="text" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="admin-income" type="checkbox" value="Income">Income
                                    </label>
                                    <label>
                                        <input name="admin-expense" type="checkbox" value="Expense">Expense
                                    </label>
                                </div>
                                <div class="submit-edit-category">
                                    <a href="#" class="btn edit-category-save">Save</a>
                                    <a href="#close" class="btn edit-category-cancel">Cancel</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /#add-category -->
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
            </div>
        </div>
    </section>