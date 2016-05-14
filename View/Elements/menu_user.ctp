<nav class="navbar  navbar-fixed-top" id="navbar1">
      <div class="container-fluid">
          <div class="navbar-header banner-header" >
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
                             <?php 
                              $username = AuthComponent::user('username');
                             echo $username; ?>
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
            <div class="modal-body">
                <div class="note-upload-ava">
                        <b> Select image. </b> <i style="color: red">Note: Only JPG, JPEG, PNG, GIF files are allowed! </i>
                    </div>
                    <div class="fileUpload btn">
                        <i class="fa fa-camera" aria-hidden="true">
                        <input type="file" class="upload"
                               accept="image/*" name="fileToUpload" id="fileToUpload" onchange="loadFile(event)"/>
                        Upload
                        </i>

                        
                    </div> 

                    <img id="load-avatar-upload" style="width:200px" 
                         src="/MoneyLover/image_avatar/<?php
                        $avatarC = AuthComponent::user('avatar'); 
                        if ($avatarC != NULL) {
                            echo $avatarC;
                        } else {
                            echo "avatar_default.jpg";
                            }?>" />
                    <script>
                        var loadFile = function (event) {
                            var output = document.getElementById('load-avatar-upload');
                            output.src = URL.createObjectURL(event.target.files[0]);
                        };
                        
                    </script> 
                    <span id="confirmMessageUploadAva" class="confirmMessageUploadAva"></span>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer" style="margin-top: 29px;">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md btnUploadAva"   id="button">
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
            <div class="form-group" style=" margin-top: 4%;">
                    <label class="col-sm-4 control-label"  style="margin-bottom: 2%;"
                           for="changeOldPass" >OLD PASSWORD</label> 
                    <div id="iconcheck">
                        <span style=" position: relative;
                              right: 9%;
                              font-size: 20px;
                              color: red;" id="iconRequired"> *  </span>
                        <i class="fa fa-check" 
                           aria-hidden="true" 
                           style=" position: relative;
                           right: 9%; display: none;
                           font-size: 20px;
                           color: #65E563;"></i>
                    </div>
                    <div class="col-sm-12" style="margin-bottom: 3%;">
                        <?php
                        echo $this->Form->input('old_password', array('label' => false,
                            'id' => 'changeOldPass',
                            'class' => 'form-control',
                            'type' => 'password',
                            'placeholder' => '****',
                            'name' => 'data[User][old_password]', 'required',
                            'onkeyup' => 'checkPassOld()'));
                        ?>  
                    </div>
                    <span id="MessageChangOldPass" class="MessageChangOldPass"></span>
                </div> 
                <span id="hashPassTyping" > </span>

                <div class="form-group">
                    <label class="col-sm-3 control-label"  style="margin-bottom: 2%;"
                           for="change-new-pass" >NEW PASSWORD</label>

                    <span style=" position: relative;
                          left: -4px;
                          font-size: 20px;
                          color: red"> *  </span>

                    <div class="col-sm-12" style="margin-bottom: 3%;">
                        <?php
                        echo $this->Form->input('new_password', array('label' => false,
                            'id' => 'change-new-pass',
                            'class' => 'form-control',
                            'type' => 'password',
                            'placeholder' => '****',
                            'name' => 'data[User][new_password]', 'required'));
                        ?>  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"  style="margin-bottom: 2%;"
                           for="change-conf-pass" >CONFIRM PASSWORD</label>
                    <span style="position: relative;
                          left: -18px; 
                          font-size: 20px;
                          color: red"> *  </span>
                    <div class="col-sm-12" style="margin-bottom: 3%;">
                        <?php
                        echo $this->Form->input('confirm_password', array('label' => false,
                            'id' => 'change-conf-pass',
                            'class' => 'form-control',
                            'type' => 'password',
                            'placeholder' => '****',
                            'name' => 'data[User][confirm_password]', 'required',
                            'onkeyup' => 'checkPass()'));
                        ?>   
                    </div>

                </div>


                <span id="confirmMessageChangPass" class="confirmMessageChangPass"></span>
                <!-- Modal Footer -->
                <div class="modal-footer" id="footer-change-pass" style="position: relative; ">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md btnChangePass"   id="button">
                    Save changes
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
  
<script>
 
//          $('.btnUploadAva').click(function () {
//            var message = document.getElementById('confirmMessageUploadAva');
//            if ($('#fileToUpload').val().trim().length == 0) {
//                message.style.color = "red";
//                message.innerHTML = "*You must choose a image!*";
//                return false;
//            } 
//            return true;
//        });
//        
//        $('#fileToUpload').click(function(){
//            var message = document.getElementById('confirmMessageUploadAva');
//            message.innerHTML = "";
//        });

    function checkPass()
    {
        //Store the password field objects into variables ...
        var passNew = document.getElementById('change-new-pass');
        var passConf = document.getElementById('change-conf-pass');
        //Store the Confimation Message Object ...
        var message = document.getElementById('confirmMessageChangPass');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field 
        //and the confirmation field 

        if (passNew.value.trim().length != 0 && passConf.value.trim().length != 0) {

            if (passNew.value == passConf.value) {
                $("#footer-change-pass").attr("style", "position: relative; margin-top: 2%");
                //The passwords match. 
                //Set the color to the good color and inform
                //the user that they have entered the correct password 
                passConf.style.backgroundColor = 'white';
                message.style.color = goodColor;
                message.innerHTML = "*Passwords Match!*";
                return true;
            } else {
                $("#footer-change-pass").attr("style", "position: relative; margin-top: 2%");
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
//                passConf.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "*Passwords Do Not Match!*";
                return false;
            }
        } else {
            $("#footer-change-pass").attr("style", "position: relative;  ");
            passConf.style.backgroundColor = "white";
            message.style.color = "none";
            message.innerHTML = "";
            return false;
        }
    }
    
    function checkPassOld() {
        $('#changeOldPass').focusout(function () {
            var message = document.getElementById('MessageChangOldPass');
            var lengthPass = $(this).val();
            if (lengthPass.length != 0) {
                hashPassword('<?php echo Router::Url(array('controller' => 'users', 'action' => 'checkOldPass')); ?>',
                        $(this).val(), function (pass) {

                    if (pass === '*Password correct*') {
                        message.innerHTML = pass;
                        message.style.color = "#27c24c";
                        return true;
                    } else {
                        message.innerHTML = pass;
                        message.style.color = "red";
                        return false;
                    }
                }
                );
            } else {
                message.innerHTML = "";
            }
        });
    }

    $('.btn-change-pass').click(function () {
        if (checkPass() == true && checkPassOld() == true) {
            return true;
        } else {
            return false;
        }
    });

</script> 

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
