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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php  
                    // $id = AuthComponent::user('id');
                    //     $result = $this->User->find('first', array('conditions' => array('User.id' => $id))); 
                     ?>
                        <img src="../startbootstrap-grayscale-edit/img/noel.jpg" id="avatar">  <i class="fa fa-caret-down"></i>
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
                        <li class="divider"></li>
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
    <section id="accounts-detail" class=" content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="col-lg-12 accounts-active">  
                        <h1> account detail </h1>

                      	<?php echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index'))); 
                             $id = AuthComponent::user('id');
                             echo $id;
                             $email = user('email');
                        ?>
                        
                       
	        </div>
        </div>
    </section>
