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
            <?php  echo $this->Form->input('categorie_id', array('options' => $categories, 'class' => 'select-style select2-offscreen', 'style' => 'background-color: rgba(251, 248, 248, 0.95)', 'label' => false, 'div' => false ));  ?>
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
        <h1><?php echo __('Edit Transactions'); ?></h1>
        <div class="row" style="margin-right:0px; margin-bottom: 10px">
            <div class="col-lg-8 col-lg-offset-2">
                <table style="    width: 100%;" class="table table-striped table-hover">
                                            <thead>
                                                <th><?php echo $this->Paginator->sort('Category'); ?></th>
                                                <th><?php echo $this->Paginator->sort('Wallet'); ?></th>
                                                <th><?php echo $this->Paginator->sort('Money'); ?></th>
                                            </thead>
                                            <?php //foreach ($categories as $category): ?>
                                            <?php echo $this->Form->create('Transaction'); ?>
                    <tr>
                        <?php echo $this->Form->input('id'); ?>
                        <td><?php echo $this->Form->input('categorie_id', array('label'=>false,'style'=>'    padding-left: 10px;
                    border: 1px solid gray;
                    border-radius: 5px;    position: relative;
                    top: 5px;color: black;')); ?>&nbsp;</td>
                    <td><?php echo $this->Form->input('wallet_id', array('label'=>false,'style'=>'    padding-left: 10px;
                    border: 1px solid gray;
                    border-radius: 5px;    position: relative;
                    top: 5px;color: black;')); ?>&nbsp;</td>
                    <td><?php echo $this->Form->input('transaction_money', array('label'=>false,'placeholder'=>'enter money', 'style'=>'    padding-left: 10px;
                    border: 1px solid gray;
                    border-radius: 5px;    position: relative;
                    top: 5px;color: black;')); ?>&nbsp;</td>

                    </tr>
                <?php //endforeach; ?>
                </table>
            </div>
        </div>
        <?php  
        $sumbit = array(
            'class' => 'btn wallet-save',
            'div' => array(
                'class' => 'submit-wallet',
                'style' => 'margin-top:30px; margin-left: 225px;'
                )
            );
            echo $this->Form->end($sumbit);
        ?>
    </section>