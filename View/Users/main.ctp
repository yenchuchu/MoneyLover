<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <i class="fa fa-play-circle"></i>  <span class="light">Money</span> Lover
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

                <li>
                    <a class="page-scroll" href="#main-sign-up">Request New A Account</a>
                </li>
                <li>
                    <a class="page-scroll" href="#main-sign-in">Sign In</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Intro Header -->
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="brand-heading">Money Lover</h2>
                    <p class="intro-text">Money Lover is a great powerful tool to track your personal finance: incomes, expenses, debts, savings, etc</p>
                    <a href="#about" class="btn btn-circle page-scroll main-about"  title="about">
                        <i class="fa fa-angle-double-down animated"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="main-sign-up" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign Up</h3>
            </div>
            <div class="panel-body" >
                <form role="form" method="POST">
                    <fieldset>
                        <div class="form-group">
                                    <?php echo $this->Form->input('username', array('class'=>'form-control','label' => false, 'placeholder' => 'enter username')); ?>
                        </div>
                        <div class="form-group">
                                    <?php echo $this->Form->input('email', array('class'=>'form-control','label' => false, 'placeholder' => 'enter email')); ?>
                        </div> 

                        <!-- Change this to a button or input when using this as a form -->
                                <?php 
                                $signup = array(
                                'label' => 'Sign-up',
                                'name' => 'signup',
                                'id' => 'sign-up',
                                'class' => 'btn-lg',
                            );
                            echo $this->Form->end($signup); ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>


<!-- Download Section -->
<section id="main-sign-in" class="content-section text-center">
    <div class="download-section">
        <div class="container">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" class="form" method="post" >
                        <fieldset>
                            <div class="form-group"> 
                                    <?php echo $this->Form->input('User.username', array('class'=>'form-control','label' => false, 'placeholder' => 'enter username')); ?>
                            </div>
                                    <?php echo $this->Form->input('User.password', array('class'=>'form-control','label' => false, 'placeholder' => 'enter password')); ?>
                            </div>
                            <div class="checkbox" >
                                <label>
                                    <input name="User.remember" type="checkbox" value="Remember Me" >Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                                <?php 
                                $signin = array(
                                    'style'=>'    border-top-left-radius: 0px;
                                    border-top-right-radius: 0px;',
                                'label' => 'Sign-in',
                                'name' => 'signin',
                                'id' => 'sign-in',
                                'class' => 'btn-lg',
                            );
                            echo $this->Form->end($signin); ?>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="about" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Contact Start Bootstrap</h2>
            <p>Feel free to email us to provide some feedback on our templates, give us suggestions for new templates and themes, or to just say hello!</p>
            <p><a href="mailto:feedback@startbootstrap.com">feedback@startbootstrap.com</a>
            </p>
            <ul class="list-inline banner-social-buttons">
                <li>
                    <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                </li>
                <li>
                    <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                </li>
                <li>
                    <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                </li>
            </ul>
        </div>
    </div>
</section>