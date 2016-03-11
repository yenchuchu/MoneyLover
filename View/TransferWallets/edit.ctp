<?php echo $this->element('menu_user'); ?>

<!-- Contact Section -->
<section id="transaction" class="content-section text-center edit-detail-transfer-wallet">
    <div class="categories-section">
        <div class="container">
            <div class="panel-heading">
                <h1><?php echo __('Edit Transfer Wallet'); ?></h1>
                <div class="panel-body"> 
                    <div class="col-lg-8 col-lg-offset-2 categories-income"> 
                        <table class="table table-striped table-hover">
                            <thead>
                            <th><?php echo $this->Paginator->sort('Sent to'); ?></th>
                            <th><?php echo $this->Paginator->sort('Receive '); ?></th> 
                            <th><?php echo $this->Paginator->sort('TransferMoney'); ?></th>            
                            </thead>
                            <?php //foreach ($categories as $category): ?>
                            <?php echo $this->Form->create('TransferWallet'); ?>
                            <tr> 
                                <?php echo $this->Form->input('id'); ?>
                                <td><?php echo $this->Form->input('sent_wallet_id', array('label' => false, 'class'=>'edit-sent-wallet' )); ?>&nbsp;</td> 
                                <td><?php echo $this->Form->input('receive_wallet_id', array('label' => false, 'class'=> 'edit-receive-wallet')); ?>&nbsp;</td>
                                <td><?php echo $this->Form->input('transfer_money', array('label' => false, 'placeholder' => 'enter money', 'class' => 'edit-transfer-money')); ?>&nbsp;</td>
                            <span class="type-money">VND</span> 
                            </tr>
                            <?php //endforeach; ?>
                        </table> 
                        <?php
                        $sumbit = array(
                            'class' => 'btn wallet-save',
                            'div' => array(
                                'class' => 'submit-wallet',
                                'style' => 'margin-top:30px;'
                            )
                        );
                        echo $this->Form->end($sumbit);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>