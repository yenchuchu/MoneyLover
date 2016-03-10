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
                     $avatar = AuthComponent::user('avatar') ; 
                        if($avatar != NULL ){ 
                            echo $this->Html->image('/image_avatar/'.$avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.png', array('alt' => 'CakePHP', 'id' => 'avatar'));
                        }  ?>
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
                <h1> account <?php echo $typeLabel; ?> </h1>
                <a href="#add-admin" id="add-admin-other"> Add Admin</a>
                      	<?php echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index'))); ?>
                <table  style="width: 100%; text-align: center;" class="table table-striped table-hover">
                    <tr class="table-header">
                        <td style="width: 1%;"></td>
                        <td style="width: 10%;"><?php echo $this->Paginator->sort('id'); ?> </td>
                        <td><?php echo $this->Paginator->sort('avatar');?></td>
                        <td><?php echo $this->Paginator->sort('Username'); ?></td>
                        <td><?php echo $this->Paginator->sort('email'); ?></td>
                        <td><?php echo $this->Paginator->sort('created'); ?></td>
                        <td><?php echo $this->Paginator->sort('Destroy');?></td>
                        <td><?php echo $this->Paginator->sort('Role');?></td>
                    </tr>
                        	<?php foreach ($users as $user): ?>
                    <tr>
                        <td><input type="checkbox" name="user_id[]"  style="float: left;position: relative; top: -6px;" value="<?php echo h($user['User']['id']); ?>" id="<?php echo h($user['User']['id']); ?>"></td>
                        <td  style="width: 10%;"><?php echo h($user['User']['id']); ?>&nbsp;</td>
                        <td>
                                    <?php  
                                        if($user['User']['avatar'] == NULL ) {
                                             echo $this->Html->image('../image_avatar/avatar_default.png', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                        } else {
                                            echo $this->Html->image('/image_avatar/'.$user['User']['avatar'], array('alt' => 'CakePHP', 'id' => 'avatar'));
                                        }
                                     ?>
                        </td>
                        <td><?php echo h($user['User']['username']); ?>&nbsp;</td> 
                        <td><?php echo h($user['User']['email']); ?>&nbsp;</td> 
                        <td><?php echo $this->Time->format($user['User']['created'], '%B %e, %Y '); ?> </td>
                        <td class="actions">
									<?php echo $this->Form->postLink('', array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']), 'class' => 'edit-transaction glyphicon glyphicon-trash', 'style'=>'margin-left: 0;','title'=>'Delete')); ?>
                        </td>
                        <td>
                                    <?php  
                                        $role_user =0;
                                        // $role_admin = 1
                                        if($user['User']['role'] == $role_user ) {
                                             echo $this->Html->image('../image_avatar/avatar_user.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                        } else {
                                            echo $this->Html->image('../image_avatar/avatar_admin.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                        }
                                     ?>
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
                <div class="page">
                    <div class="paging">
  <?php   echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP'));
      ?>
                         <!-- <img src="../MoneyLover/webroot/img/select.png"> -->
                        <span class="wrap-select-all">

                            <input type="checkbox" name="checkAll" value="checkAll" id="checkAll">
                            <label class="label-select-all" for="checkAll">Select All</label>
                            <span class="with-selected"> <i> With selected: </i></span>
                            <span  id="deleteAll" class="glyphicon glyphicon-trash" title="Delete">
                            <!-- <i class="fa fa-trash"></i>Delete -->
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
                <div id="add-admin" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Admin</h3>
                        </div> 
                        <div class="panel-body">
                            <?php echo $this->Form->create('User',array('action' => 'add')); ?>
                            <div class="form-group">
                                    <?php echo $this->Form->input('username', array('class'=>'form-control','label' => false, 'placeholder' => 'enter username')); ?>
                            </div>
                            <div class="form-group">
                                    <?php echo $this->Form->input('email', array('class'=>'form-control','label' => false, 'placeholder' => 'enter email')); ?>
                            </div>   
                            <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10 submit-wallet" style = "margin-top: 16px;
                                     width: 100%;
                                     margin-left: -10px">
                                    <a href="#" class="btn wallet-save" style="float: left;
                                       margin-right: -13px;color: white;
                                       "> Cancel </a>
<?php //$this->Form->end(); ?>
                                    <button type="submit" class="btn wallet-save" style="float: right;
                                            margin-right: -13px;
                                            ">Add</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

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
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("users/deleteAll", ids);
        } else {
            return false;
        }

    });
</script>