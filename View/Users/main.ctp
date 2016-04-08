<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bootstrap Registration Form Template</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse top-navbar-1" id="top-navbar-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <span class="li-text">
                        Put some text or
                    </span> 
                    <a href="#"><strong>links</strong></a> 
                    <span class="li-text">
                        here, or some icons: 
                    </span> 
                    <span class="li-social">
                        <a href="#"><i class="fa fa-facebook"></i></a> 
                        <a href="#"><i class="fa fa-twitter"></i></a> 
                        <a href="#"><i class="fa fa-envelope"></i></a> 
                        <a href="#"><i class="fa fa-skype"></i></a>
                    </span>
                </li> 
            </ul>
        </div>
    </div>
</nav>

<!-- Top content -->
<div class="top-content" id="user-main">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Money Lover</strong></h1>
                    <div class="description">
                        <p>
                           is a great powerful tool to track your personal finance: incomes, expenses, debts, savings, etc
                        </p>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="navbar-collapse collapse top-navbar-1" id="top-navbar-1">
                    <ul class="nav nav-tabs" id="nav-tabs-main">
                        <li class="active"><a data-toggle="tab" href="#sign-up">Sign Up</a></li>
                        <li><a data-toggle="tab" href="#sign-in">Sign In</a></li>
                    </ul>
                </div>
                <!-- </nav> -->

                <div class="tab-content">
                    <div id="sign-up" class="tab-pane fade in active">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3> Sign Up</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                 <form role="form" method="POST" class="registration-form">
                    <fieldset>
                        <div class="form-group">
                                    <?php echo $this->Form->input('username', array('class'=>'form-control','label' => false, 'placeholder' => 'enter username')); ?>
                        </div>
                        <div class="form-group">
                                    <?php echo $this->Form->input('email', array('class'=>'form-control','label' => false, 'placeholder' => 'enter email')); ?>
                        </div> 

                        <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" id="sign-up" class="btn button-sign-up" name="signup" value="Sign-up">Sign Up</button>
                    </fieldset>
                </form>
                            </div>
                        </div>
                    </div>

                    <div id="sign-in" class="tab-pane fade">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Sign In</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom"> 
                                <form role="form" class="form" method="post"  class="registration-form">
                                    <fieldset>
                                        <div class="form-group" > 
                                                <?php echo $this->Form->input('User.username', array('class'=>'form-control','label' => false, 'placeholder' => 'enter username')); ?>
                                        </div>
                                        <div class="form-group" > 
                                                <?php echo $this->Form->input('User.password', array('class'=>'form-control','label' => false, 'placeholder' => 'enter password')); ?>
                                        </div>
<!--                                        <div class="checkbox" >
                                            <label>
                                                <input name="User.remember" type="checkbox" value="Remember Me" >Remember Me
                                            </label>
                                        </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                     <button type="submit" class="btn button-sign-in"  name="signin" id="sign-in" value="Sign-in">Sign in </button>

                        </fieldset>
                                    </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</div>
 
    <?= $this->Html->script('jquery.backstretch.min') ?>
    <?= $this->Html->script('retina-1.1.0.min') ?>
    <?= $this->Html->script('scripts') ?>
    <?= $this->Html->css('style') ?>
    <?= $this->Html->css('form-elements') ?>