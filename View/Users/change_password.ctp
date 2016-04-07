<?php
$role = AuthComponent::user('role');
$active = AuthComponent::user('active');
if ($active == 1) {
    if ($role == 1) {
            echo $this->element('menu_admin');
        } else {
            echo $this->element('menu_user');
        } 
 
} else {  ?>
    <span></span>   
 <?php  }?>

<!-- About Section -->
<section id="change-password" class=" content-section text-center">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3" id="change-password-col-6">  
            <h1> Change your password </h1> 

            <?php
            echo $this->Form->create('User');
            echo $this->Form->input('id');
            echo $this->Form->input('old_password', array('type' => 'password',
                'id' => 'old_password',
                'label' => array('id' => 'label-old-password'),
                'placeholder' => '****'));
            echo $this->Form->input('new_password', array('type' => 'password',
                'id' => 'new_password',
                'label' => array('id' => 'label-new-password'),
                'placeholder' => '****'));
            echo $this->Form->input('confirm_password', array('type' => 'password',
                'id' => 'confirm_password',
                'label' => array('id' => 'label_confirm_password'),
                'placeholder' => '****')); ?>
            <input type="" name="backUrl" value="<?php echo $backUrl; ?>"/>
        <?php    $Save = array('id' => 'save-change-password', 'class' => 'btn wallet-save');
            echo $this->Form->end($Save);
            ?> 
        </div> 
        <!-- /.col-lg-6 -->
    </div> 
    <!-- /.row -->
</section>