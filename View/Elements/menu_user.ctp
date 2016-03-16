<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <i class="fa fa-play-circle" id="icon-banner"></i>
            <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'wallets', 'action' => 'index'), array('id' => 'banner')); ?> 
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 15px;
    padding-bottom: 5px;">
                        <?php
                        $avatar = AuthComponent::user('avatar');
                        if ($avatar != NULL) {
                            echo $this->Html->image('../image_avatar/' . $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                        }
                        ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Update Avatar', array('controller' => 'users', 'action' => 'UploadImage', $id));
                            ?>
                        </li> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password', $id));
                            ?>
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