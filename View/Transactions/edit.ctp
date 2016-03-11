<?php echo $this->element('menu_user'); ?>

<!-- Contact Section -->
<section id="transaction" class="content-section text-center edit-transaction-sigle">
    <div class="categories-section">
        <div class="container">
            <div class="panel-heading">
                <h1><?php echo __('Edit Transactions'); ?></h1>
                <div class="panel-body"> 
                    <div class="col-lg-8 col-lg-offset-2 categories-income"> 
                        <table class="table table-striped table-hover">
                            <thead>
                            <th><?php echo $this->Paginator->sort('Category'); ?></th>
                            <th><?php echo $this->Paginator->sort('Wallet'); ?></th> 
                            <th><?php echo $this->Paginator->sort('Money'); ?></th>            
                            </thead>
                            <?php //foreach ($categories as $category): ?>
                            <?php echo $this->Form->create('Transaction'); ?>
                            <tr> 
                                <?php echo $this->Form->input('id'); ?>
                                <td><?php echo $this->Form->input('categorie_id', array('label' => false, 'id'=> 'edit-transaction-category')); ?>&nbsp;</td> 
                                <td><?php echo $this->Form->input('wallet_id', array('label' => false, 'id'=> 'edit-transaction-wallet')); ?>&nbsp;</td>
                                <td><?php echo $this->Form->input('transaction_money', array('label' => false, 'placeholder' => 'enter money','id'=> 'edit-transaction-money')); ?>&nbsp;</td>
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
