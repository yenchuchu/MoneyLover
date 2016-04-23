<nav class="navbar  navbar-fixed-top" id="navbar1">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'wallets', 'action' => 'index'), array('id' => 'banner')); ?> 
          <!--<a class="navbar-brand" href="#">Project name</a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right"> 
            <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 15px;
    padding-bottom: 5px;">
                        <span id="email-profile">         
                             <?php $email = AuthComponent::user('email');
                             $email = explode("@", $email);
                                echo $email[0]; ?>
                        </span>       
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
                            <a href="#"  type="button" data-toggle="modal" data-target="#changeAvatar">Update Avatar</a>
                        </li> 
                        <li> 
                            <a href="#"  type="button" data-toggle="modal" data-target="#changeModal">Change your password</a>
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
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Thay đổi ảnh 
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
                  
                  Select image. Note: Only JPG, JPEG, PNG, GIF files are allowed!
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
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="changeModal">
                    CHANGE YOUR PASSWORD
                </h4>
            </div>
                <?php
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
          	<ul class="nav nav-sidebar">
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

         	</ul>
        </div>
