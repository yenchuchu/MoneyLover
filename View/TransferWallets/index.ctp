<?php echo $this->element('menu_user'); ?>
<!-- tk theo vi,.... -->

<!-- Contact Section -->
<section id="transfer-wallet" class="content-section text-center">
    <span >
        <h1>Transfer Wallet</h1> 
    </span>  
    <a href="#add-transfer" id="a-add-transfer"> Add Transfer</a>
    <div class="row" id="row-transfer">
        <div class="col-lg-10 col-lg-offset-1">
            <div id="transaction-month" class="transaction-wrapper">
                <div class="panel-body" style="position: relative;">
                    <table class="table table-striped table-hover">
                        <thead>
                        <th></th>
                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th><?php echo $this->Paginator->sort('sent_wallet_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('receive_wallet_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('transfer_money'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th><?php echo $this->Paginator->sort('modified'); ?></th>
                        <th class="actions" style="color:#337ab7;"><?php echo h('Actions'); ?></th> 
                        </thead>
<?php foreach ($transferWallets as $transferWallet): ?>
                            <tr>
                                <td> <input type="checkbox" name="transfer_id[]" value="<?php echo h($transferWallet['TransferWallet']['id']); ?>" id="<?php echo h($transferWallet['TransferWallet']['id']); ?>" class="checkbox-transfer"></td>
                                <td style="width: 10%;"><?php echo h($transferWallet['TransferWallet']['id']); ?>&nbsp;</td>
                                <td><?php echo h($sentWallets[$transferWallet['TransferWallet']['sent_wallet_id']]); ?>&nbsp;</td>
                                <td><?php echo h($receiveWallets[$transferWallet['TransferWallet']['receive_wallet_id']]); ?>&nbsp;</td>
                                <td>  <?php
                                    echo $this->Number->currency($transferWallet['TransferWallet']['transfer_money'], ' VND', $options = array('thousands' => '.',
                                        'wholePosition' => 'after', 'places' => 0
                                    ));
                                    ?> &nbsp;</td>
                                <td><?php echo $this->Time->format($transferWallet['TransferWallet']['created'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format($transferWallet['TransferWallet']['modified'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td class="actions">
    <?php echo $this->Html->link('', array('action' => 'edit', $transferWallet['TransferWallet']['id']), array('class' => 'edit-transaction glyphicon glyphicon-pencil',
        'title' => 'Edit'));
    ?>
                        <?php echo $this->Form->postLink('', array('action' => 'delete', $transferWallet['TransferWallet']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transferWallet['TransferWallet']['id']), 'class' => 'edit-transaction glyphicon glyphicon-trash', 'id' => 'delete-transferWallet',
                            'title' => 'Delete'));
                        ?>
                                </td> 
                            </tr>
                    <?php endforeach; ?>
                    </table>
                    <!-- phan trang -->

                            <?php if (empty($transferWallets)) { ?>
                        <p> No transfer Wallets</p>
<?php
} else {
    ?>
                        <div class="page">
                            <div class="paging">
                                    <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP'));
                                    ?>
                                <span class="wrap-select-all">

                                    <input type="checkbox" name="checkAll" value="checkAll"   id="checkAll">
                                    <label for="checkAll" class="label-select-all">Select All</label> 
                                    <span class="with-selected"> <i> With selected: </i></span>
                                    <span id="deleteAll" class="glyphicon glyphicon-trash" title="Delete"> </span> 
                                    <?php
                                    $counts = 0;
                                    foreach ($transferWallets as $transferWallet):
                                        $counts++;
                                    endforeach;

                                    if ($counts <20) {
                                        ?>
                                        <span></span>
                                        <?php
                                    } else {
                                        echo $this->Paginator->prev(
                                                '« Previous', null, null, array('class' => 'disabled')
                                        );
                                        echo $this->Paginator->numbers(array('class' => 'number-page', 'separator' => false));
                                        echo $this->Paginator->next(
                                                'Next »', null, null, array('class' => 'disabled')
                                        );
                                    }
                                    ?>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <div id="add-transfer" class="modalDialog">      
                        <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
                            <div class="panel-heading">
                                <h3 class="panel-title" >Add Transfer Wallet</h3>
                            </div> 
                            <div class="panel-body" style="color: black;">
                                <form action="/MoneyLover/transferWallets/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
<?php $this->Form->input('id'); ?>
                                    <div class="form-group">
                                        <label class="control-label" for="CategoryName" >Wallet sent:</label>
<?php echo $this->Form->input('sent_wallet_id', array('label' => false, 'placeholder' => 'Wallet Name sent', 'id' => 'WalletName', 'class' => 'form-control', 'name' => 'data[TransferWallet][sent_wallet_id]')); ?> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="CategoryName"  >Wallet receive:</label>
<?php echo $this->Form->input('receive_wallet_id', array('label' => false, 'placeholder' => 'Wallet Name receive', 'id' => 'WalletName', 'class' => 'form-control', 'name' => 'data[TransferWallet][receive_wallet_id]')); ?> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="CategoryName" >Money:</label>
<?php echo $this->Form->input('transfer_money', array('label' => false, 'id' => 'WalletMoneyCurrent', 'class' => 'form-control', 'type' => 'number','placeholder' => 'Transfer Money', 'name' => 'data[TransferWallet][transfer_money]', 'required')); ?> 
                                    </div> 
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10 submit-wallet"  id="submit-add-transfer"> 
                                            <a href="#close"  class="btn wallet-save " >Cancel</a> 
                                            <button type="submit" class="btn wallet-save" >Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /#add-transfer-Wallet --> 
                </div>
            </div>
        </div>

        <!-- /.col-lg-5 -->
    </div>
</section>

<!-- <script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script> -->
<script type="text/javascript">
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });


    $('#deleteAll').click(function () {
        ids = new Array();
        $("input:checkbox[name='transfer_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("transferWallets/deleteAll", ids);
            document.location.reload();
        } else {
            // alert("select input, please!");
            return false;
        }

    });
</script>