<?php echo $this->element('menu_admin'); ?>

<!-- Contact Section -->
<section id="edit-category" class="content-section text-center" >
    <h1><?php echo __('Edit Category'); ?></h1>
    <div class="row" >

        <div class="col-lg-6 col-lg-offset-3">
            <div id="transaction-month" class="transaction-wrapper">

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th><?php echo $this->Paginator->sort('Category Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('Type'); ?></th>  
                        </thead>
                        <?php //foreach ($categories as $category): ?>
                        <?php echo $this->Form->create('Category'); ?>
                        <tr> 
                            <?php echo $this->Form->input('id'); ?>
                            <td><?php echo $this->Form->input('name', array('label' => false,'class'=>'edit-name-category' )); ?>&nbsp;</td> 
                            <td> 
                                <label class="radio-inline">
                                    <input type="radio" name="data[Category][type]" value="1" id="CategoryType" checked="checked">Income</label>
                                <label class="radio-inline">
                                    <input type="radio"  name="data[Category][type]" value="0" id="CategoryType edit-input-expense" checked="checked">Expense</label>
                            </td> 
                        </tr>
                        <?php //endforeach; ?>
                    </table>       

                </div>
                <?php
                $sumbit = array(
                    'class' => 'btn wallet-save',
                    'div' => array(
                        'class' => 'submit-wallet',
                        'style' => ' margin-top: 12px;
                                    margin-left: 16px;' ));
                echo $this->Form->end($sumbit);
                ?>
            </div>
        </div>
    </div>
</section>
