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
                <?php $role = AuthComponent::user('role') ; 
                // debug($role);die;
                if($role == 1 ) { ?>
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

                   <?php } else { ?>
                        <li>
                            <?php echo $this->Html->link(__('My Wallets'), array('controller' => 'Wallets', 'action' => 'index')); ?>
                        </li> 
                        <li>
                            <?php echo $this->Html->link(__('Transfer Wallet'), array('controller' => 'TransferWallets', 'action' => 'index')); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('Transactions'), array('controller' => 'Transactions', 'action' => 'index')); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('Report Month'), array('controller' => 'ReportMonths', 'action' => 'index')); ?>
                        </li>
                   <?php } ?> 
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
        <div class="col-lg-6 col-lg-offset-3" style="    border: 1px #973643 solid;padding-top: 25px;">  
                <h1> Change your password </h1> 
				<?php  
				    echo $this->Form->create('User'); 
				    echo $this->Form->input('id');  
				    echo $this->Form->input('old_password', array('type' => 'password','style'=>'    padding-left: 10px;
					    border: 1px solid gray;
					    border-radius: 5px;    position: relative;
					        top: -10px;
						    color: black;
						    margin-left: -50%;margin-bottom: 15px;', 'label' => array('style' => '    width: 40%;
    float: left;margin-bottom: 15px;'),'placeholder'=>'**********'));
				    echo $this->Form->input('new_password', array('type' => 'password','style'=>'    padding-left: 10px;
					    border: 1px solid gray;
					    border-radius: 5px;    position: relative;
					     top: -10px;color: black;margin-left: -50%;margin-bottom: 15px;', 'label' => array('style' => 'width: 40%; float: left;margin-bottom: 15px;'), 
					     'placeholder'=>'**********'));
				    echo $this->Form->input('confirm_password', array('type' => 'password','style'=>'    padding-left: 10px;
					    border: 1px solid gray;
					    border-radius: 5px;    position: relative;
					     top: -10px;color: black;margin-left: -50%;margin-bottom: 15px;' , 'label' => array('style' => '    width: 40%;
    float: left;margin-bottom: 15px;'),'placeholder'=>'**********'));

                $Save = array('style' => '    background-color: #973643;
    margin-bottom: 24px;
    float: left;
    width: 40%;
    margin-left: 11%;
    color: white;',
                'class' => 'btn wallet-save',
                
                ); 
				    echo $this->Form->end($Save);
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
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("users/deleteAll", ids);
        } else {
            return false;
        }

    });
</script>