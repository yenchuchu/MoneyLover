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
                    <?php echo $this->Html->link(__('Categories'), array('controller' => 'Categories', 'action' => 'index')); ?>
                        <!-- <a class="page-scroll" href="admin-categories.html">Categories</a> -->
                    </li>
                    <li>
                        <a class="page-scroll" href="main.html">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- About Section -->
    <section id="accounts" class=" content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
            <div class="panel-heading" style="background-color: transparent !important; color: white; ">
                <!-- <h2>Account</h2> -->
            </div>
               <div class="col-lg-12 accounts-active">
                        <!-- <h3 > account active </h3>  -->
                      	<h2 style="color: white;"><?php echo __('account active'); ?></h2>
                      	<?php echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index'))); ?>
                        <table style="width: 90%;">
                        	<tr class="table-header">
                        		<td style="width: 1%;"></td>
                        		<td style="width: 10%;"><strong> <?php echo $this->Paginator->sort('id'); ?> </strong></td>
                        		<td><strong> <?php echo $this->Paginator->sort('Username'); ?> </strong></td>
                        		<td><strong> <?php echo $this->Paginator->sort('email'); ?> </strong></td>
                        		<td><?php echo $this->Paginator->sort('avatar');?></td>
                        		<td><strong><?php echo $this->Paginator->sort('created'); ?></strong></td>
                        		<td><strong> <?php echo $this->Paginator->sort('Destroy');?> </strong></td>
                        	</tr>
                        	<?php foreach ($users as $user): ?>
                        	<tr>
	                        	<td><input type="checkbox" name="user_id[]" value="Bike" style="float: left" value="<?php echo h($user['User']['id']); ?>"></td>
								<td  style="width: 10%;"><?php echo h($user['User']['id']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['avatar']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
								<td class="actions">
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
								</td>
							</tr>
						<?php endforeach; ?>
                        	
                        </table>
                        <div class="page" style="position: absolute; bottom: -85px; width: 100%;">
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
							<ul id="pagination-digg" style=" float: left">
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
							    <input type="checkbox" name="vehicle" value="Bike" style="float: left"  id="checkAll"><span style="width:20%; float: left; font-size: 17px; padding-top: 4px; color: black;">Select All</span>
							    <a href="#delete-transaction" title="delete" class="delete-account"  style=" color: black;font-size: 18px; float: left; padding-left: 20px; top: 5px; position: relative;"><i class="fa fa-trash"></i><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?></a>
							    </span>
							</div>
			            </div>
	        </div>
        </div>
    </section>

    <script type="text/javascript">
		$("#checkAll").change(function () {
		    $("input:checkbox").prop('checked', $(this).prop("checked"));
		});
    </script>
