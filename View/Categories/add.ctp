<!-- Navigation -->
<nav class="navbar navbar-custom" role="navigation" style="padding:0px 0px; background-color: #000;">
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
                    <a class=" dropdown-toggle page-scroll" data-toggle="dropdown">Accounts 
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="account-active.html">account active</a></li>
                        <li><a href="account-request.html">account request</a></li>
                    </ul>
                </li>
                <li>
                    <?php echo $this->Html->link(__('Categories'), array('controller' => 'Categories', 'action' => 'index')); ?> 
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
                        <a href="#close" class="btn password-cancel">Cancel</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div> 
<!-- /#change-password -->

<!-- Contact Section -->
<section id="edit-category" class="content-section text-center">
    <h1 style="color:white;"><?php echo __('Edit Category'); ?></h1>
    <div class="row" style="margin-right:0px; margin-bottom: 10px">

        <div class="col-lg-6 col-lg-offset-3">
            <div id="transaction-month" class="transaction-wrapper">

                <div class="panel-body" style="position: relative; min-height: 60px;">

                    <ul>
                        <li>
                            <div class="categories-edit-wrapper">
                                <?php echo $this->Form->create('Category'); ?>
                                <fieldset style="    padding-top: 10px; height: 50px;">
                                    <div class="form-group" style="float: left;    margin-left: 30px;">
                                        <?php echo $this->Form->input('name'); ?>
                                    </div>

                                    <div class="form-group" style="float: left;    margin-left: 30px;">
                                        <?php echo $this->Form->input('type'); ?>
                                    </div>
                                </fieldset>

                            </div>
                        </li>
                    </ul>
                </div>
                <?php
                $sumbit = array(
                    'class' => 'btn wallet-save',
                    'div' => array(
                        'class' => 'submit-wallet',
                        'style' => 'margin-top:30px;'
                    )
                );
                echo $this->Form->end($sumbit);
                ?>
            </div>
        </div>
    </div>
</section>
