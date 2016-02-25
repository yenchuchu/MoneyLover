<h2>Change your password</h2>
<?php  
    echo $this->Form->create('User');
    echo $this->Form->input('id');
    echo $this->Form->input('old_password', array('type' => 'password'));
    echo $this->Form->input('new_password', array('type' => 'password'));
    echo $this->Form->input('confirm_password', array('type' => 'password'));
    echo $this->Form->end(__('Save'));
?>