<?php echo $this->element('menu_user'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          	
    <h1 class="page-header"><?php echo $this->Html->link(__('Dashboard '), array(
                                                                            'controller' => 'Wallets', 
                                                                            'action' => 'dashboard_user')); ?> </h1>
    
    <div class="row placeholders-board" style="margin: auto 8%;">
        <div class="col-xs-6 col-sm-3 placeholder polaroid" >
          <?php echo $this->Html->image('/img/wallet-1.png', array(
              'alt' => 'Generic placeholder thumbnail', 
              'class' => 'img-responsive',
              'width' => '100', 
              'height' => '100')); ?>
            <h4><?php echo $wallets; ?></h4>
          <span class="text-muted">Wallets</span>

        </div>
        <div class="col-xs-6 col-sm-3 placeholder polaroid">
          <?php echo $this->Html->image('/img/transfer.png', array(
              'alt' => 'Generic placeholder thumbnail', 
              'class' => 'img-responsive',
              'width' => '100', 
              'height' => '100')); ?>
            <h4><?php echo $transfers; ?></h4>
          <span class="text-muted">Transfer</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder polaroid">
          <?php echo $this->Html->image('/img/transaction.png', array(
              'alt' => 'Generic placeholder thumbnail', 
              'class' => 'img-responsive',
              'width' => '100', 
              'height' => '100')); ?>
            <h4><?php echo $transactions; ?></h4>
          <span class="text-muted">Transaction</span>
        </div>

      </div>
</div> 
    <script >
      $(".polaroid").hover(function(){
        $("polaroid").show();
      },function(){
        $("polaroid").hide();
      });

    </script>