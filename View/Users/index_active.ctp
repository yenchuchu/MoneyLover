<nav class="navbar navbar-custom navbar-fixed-top menu-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <i class="fa fa-play-circle" id="icon-banner"></i>
                <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'users', 'action' => 'index'),array('id'=> 'banner')); ?>  
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li>
                        <a class=" dropdown-toggle page-scroll" data-toggle="dropdown">Accounts 
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li>
                                <?php echo $this->Html->link(__('account active'), array('controller' => 'users', 'action' => 'index','?' => array('type' => 'active'))); 
                                ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link(__('account request'), array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'request'))); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <?php echo $this->Html->link(__('Categories'), array('controller' => 'Categories', 'action' => 'index')); ?>
                    </li>
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 0px">
                    <?php
                     echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index')));
                     $avatar = AuthComponent::user('avatar'); 
                        if($avatar != NULL ){ 
                            echo $this->Html->image('../image_avatar/'. $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                            ?>
                            <!-- <img src="/image_avatar/<?php echo $avatar; ?>" id="avatar"> -->
                        <?php } else{
echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                            ?>
                         <!-- <img src="/image_avatar/avatar_default.jpg" id="avatar"> -->
                         
                    <?php }  ?>
                    <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li>
                            <?php 
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Update Avatar', array('controller'=>'users', 'action' => 'UploadImage',$id)); ?>
                        </li> 
                        <li>
                            <?php 
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Change Password', array('controller'=>'users', 'action' => 'change_password',$id)); ?>
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
                <div class="col-lg-12 accounts-active">  
                        <h1> account active </h1>
                      	<?php echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index'))); ?>
                        <table  style="width: 100%; text-align: center;" class="table table-striped table-hover">
                        	<tr class="table-header">
                        		<td style="width: 1%;"></td>
                        		<td style="width: 10%;"><?php echo $this->Paginator->sort('id'); ?> </td>
                        		<td><?php echo $this->Paginator->sort('Username'); ?></td>
                        		<td><?php echo $this->Paginator->sort('email'); ?></td>
                        		<td><?php echo $this->Paginator->sort('avatar');?></td>
                        		<td><?php echo $this->Paginator->sort('created'); ?></td>
                        		<td><?php echo $this->Paginator->sort('Destroy');?></td>
                        	</tr>
                        	<?php foreach ($users as $user): ?>
                        	<tr>
	                        	<td><input type="checkbox" name="user_id[]"  style="float: left;position: relative;
    top: -6px;" value="<?php echo h($user['User']['id']); ?>" id="<?php echo h($user['User']['id']); ?>"></td>
								<td  style="width: 10%;"><?php echo h($user['User']['id']); ?>&nbsp;</td>
								<td><?php echo h($user['User']['username']); ?>&nbsp;</td> 
								<td><?php echo h($user['User']['email']); ?>&nbsp;</td>

								<td>
                                <?php 
                                    if($user['User']['avatar'] == NULL ) {
                                        echo "Null";
                                    }
                                    else { ?>
                                        <a href="<?php echo h($user['User']['avatar']); ?>">link avatar</a>
                                    <?php }
                                 ?>
                                </td>
                                
								<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
								<td class="actions">
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
								</td>
							</tr>
						<?php endforeach; ?>
                        	
                        </table>

<?php 
if(empty($users)){ ?>
    <p> Nobody</p>
<?php }
else {
    ?>
 <div class="page" style=" position: relative;
    bottom: -5px; width: 100%;">
    <div class="paging">
  <?php   echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP'));
      ?>
         <!-- <img src="../MoneyLover/webroot/img/select.png"> -->
     <span style="    float: left;
        margin-left: 9px;
        width: 50%;">

        <input type="checkbox" name="checkAll" value="checkAll" style="float: left"  id="checkAll">
        <label style="width:20%; float: left; font-size: 17px; padding-top: 4px;font-weight: normal;" for="checkAll">Select All</label>
        <span style="float: left;
    width: 20%;
    text-align: center;
    position: relative;
    top: 3px;
    font-size: 17px;"> <i> With selected: </i></span>
      <span style="    float: left;
    width: 20%;
    font-size: 17px;
    position: relative;
    top: 3px;" id="deleteAll">  <i class="fa fa-trash"></i>Delete
        </span> 
<?php  
    $counts = 0;
    foreach ($users as $user):  
        $counts++;
    endforeach;

    if($counts <= 7) { ?>
        <span></span>
    <?php
    } 
    else { 
        echo $this->Paginator->prev(
          '« Previous',
          null,
          null,
          array('class' => 'disabled')
        ); 
        echo $this->Paginator->numbers(array('class'=>'number-page','separator'=>false));
        echo $this->Paginator->next(
          'Next »',
          null,
          null,
          array('class' => 'disabled')
        ); 
    } 
?>
                            </div>
                        </div>

    <?php
}

 ?>

                       
	        </div>
        </div>
    </section>
<script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">
		 $("#checkAll").change(function () {
		     $("input:checkbox").prop('checked', $(this).prop("checked"));
		 });

        $('#deleteAll').click(function () {
            ids = new Array();
            $("input:checkbox[name='user_id[]']:checked").each(function () { 
                ids.push($(this).val());
            });
            console.log(ids);
            deleteAll("users/deleteAll", ids);
        });
    </script>