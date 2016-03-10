Check mail to active account!
"Your password is: 
<?php $this->request->data['password']; ?> 
You need to change your password on the first login!
<?php echo $this->Html->link('change_password', array('controller'=>'users', 'action' => 'change_password',AuthComponent::user('id'))); ?>