<?php echo $this->element('menu_user'); ?>
 
<section id="wallet" class="content-section text-center">
    <span style="    position: relative;
          top: -50px;">
        <h1 style="color: black;top: 37px;
            position: relative;">Edit Wallets</h1> 
    </span>  
    <div class="row"> 
        <div class="col-lg-5" style=" margin-left: 30%;">
            <?php echo $this->Form->create('Wallet'); ?>
            <?php echo $this->Form->input('id'); ?>
            <h2  class="name-wallet">
                <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control edit-name-wallet')); ?>
            </h2>

            <span class="wallet-info"><i class="fa fa-smile-o"></i> Wallet Info:</span>
            <?php echo $this->Form->textarea('info', array('label' => false, 'class' => 'form-control edit-wallet-info')); ?>  <br> 
            <span class="wallet-current-money"><i class="fa fa-smile-o"></i> Current money: </span>
            <?php echo $this->Form->input('money_current', array('label' => false, 'class' => 'form-control edit-money-current')); ?>  <span class="type-money">VND</span>     
        </div>
        <?php
        $sumbit = array(
            'class' => 'btn wallet-save',
            'style' => ' margin-left: 30%; width: 20%;',
            'div' => array(
                'class' => 'submit-wallet',
                'style' => 'margin-top:30px;'
            )
        );
        echo $this->Form->end($sumbit);
        ?>
</section> 
