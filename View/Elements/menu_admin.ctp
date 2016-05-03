<nav class="navbar  navbar-fixed-top" id="navbar1">
      <div class="container-fluid">
        <div class="navbar-header banner-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'users', 'action' => 'index'),
                    array( 'class'=>'navbar-brand', 'style'=>'    font-size: 19px;')); ?> 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 15px;
    padding-bottom: 5px;">
                        
                         <span id="email-profile">         
                             <?php 
                             $username = AuthComponent::user('username');
                             echo $username;
//                             $email = explode("@", $email);
//                                echo $email[0]; ?>
                        </span>      
                        
                        <?php
                        $avatar = AuthComponent::user('avatar');
                        if ($avatar != NULL) {
                            echo $this->Html->image('/image_avatar/' . $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                        }
                        ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li> 
                            <a href="#" data-toggle="modal" data-target="#changeAvatar">Update Avatar</a>
                        </li> 
                     <li>  
                            <a href="#" data-toggle="modal" data-target="#changeModal">Change your password</a>
                        </li> 
                        <li>
<?php echo $this->Html->link(__('Log out'), array('controller' => 'users', 'action' => 'logout')); ?>
                        </li>
                    </ul>
                </li>
          </ul> 
        </div>
      </div>
    </nav>

<!--Upload avatar-->

<div class="modal fade" id="changeAvatar" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header"> 
                <h4 class="modal-title" id="myModalLabel">
                    Change Profile 
                </h4>
            </div>
            
            <!-- Modal Body -->
            <?php $id = AuthComponent::user('id'); ?>
            <form action="/MoneyLover/Users/UploadImage/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div style="display:none;">
            <input type="hidden" name="_method" value="POST">
        </div>
                <input type="hidden" name="data[User][id]" id="UserId">           	 	
        <!--<span id="note-upload-avatar">Only JPG, JPEG, PNG, GIF files are allowed!</span> <br>-->
            <div class="modal-body">
                  
                <b> Select image. </b> <i>Note: Only JPG, JPEG, PNG, GIF files are allowed! </i>
                  <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" onchange="loadFile(event)">
                  <img id="output" style="width:200px"/>
                  <script>
                    var loadFile = function(event) {
                      var output = document.getElementById('output');
                      output.src = URL.createObjectURL(event.target.files[0]);
                    };
                  </script>
                  
              
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md"   id="button">
                    Upload profile picture
                </button>
            </div>
              </form>
        </div>
    </div>
</div>
    
<!--change password--> 

<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" 
     aria-labelledby="changeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header"> 
                <h4 class="modal-title" id="changeModal">
                    Change Your Password
                </h4>
            </div><?php
                            $id = AuthComponent::user('id'); ?>
            <div style="display:none;">
                    <input type="hidden" name="_method" value="POST">
                </div>
            <form action="/MoneyLover/users/change_password/<?php echo $id; ?>" id="UserChangePasswordForm"
                  method="post" accept-charset="utf-8">
                
                <input type="hidden" name="data[User][id]" id="UserId"> 
            <!-- Modal Body -->
            <div class="modal-body">
                  <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="inputPassword3" >OLD PASSWORD</label>
                                    <div class="col-sm-12">
                                        <?php echo $this->Form->input('old_password', array('label' => false, 
                                            'id' => 'WalletMoneyCurrent', 
                                            'class' => 'form-control', 
                                            'type' => 'password',
                                            'placeholder' => '****', 
                                            'name' => 'data[User][old_password]', 'required')); ?>  
                                    </div>
                                </div> 
                <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="inputPassword3" >NEW PASSWORD</label>
                                    <div class="col-sm-12">
                                        <?php echo $this->Form->input('new_password', array('label' => false, 
                                            'id' => 'WalletMoneyCurrent', 
                                            'class' => 'form-control', 
                                            'type' => 'password',
                                            'placeholder' => '****', 
                                            'name' => 'data[User][new_password]', 'required')); ?>  
                                    </div>
                                </div>
                   <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="inputPassword3" >CONFIRM PASSWORD</label>
                                    <div class="col-sm-12">
                                        <?php echo $this->Form->input('confirm_password', array('label' => false, 
                                            'id' => 'WalletMoneyCurrent', 
                                            'class' => 'form-control', 
                                            'type' => 'password',
                                            'placeholder' => '****', 
                                            'name' => 'data[User][confirm_password]', 'required')); ?>  
                                    </div>
                                </div>
                    
                 
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="position: relative; margin-top: 29%;">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md"   id="button">
                    Save changes
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          	<ul class="nav nav-sidebar menu-left-admin" >
                    <li class="active">
                        <a class=" dropdown-toggle page-scroll" data-toggle="dropdown">Accounts 
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php echo $this->Html->link(__('account active'), array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'active')));
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
         	</ul>
        </div>

   
