
Your password is: 
<?php
     echo $this->Form->create('User',array('url' => array('controller' => 'User', 'action' => 'index')));
     $password = AuthComponent::user('password'); 
    // $password =  $this->Common->create_random_string(10);
    //AuthComponent::password($check['old_password']);
    echo $password;
?>
. You need to change your password on the first login!