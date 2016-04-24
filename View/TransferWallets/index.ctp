<?php echo $this->element('menu_user'); ?>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-transaction">

    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('Transfer'), array('controller' => 'TransferWallets', 'action' => 'index')); ?>
        <a id="add-button" class="btn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
    </h1>
    <span id="form-search-transfer">
        <?php
        echo $this->Form->create(array(
            'type' => 'get',
            'id' => 'search',
            'class' => 'form-inline form-search-top'));
        ?>
        <?php
        echo $this->Form->input('sent_wallet_id', array(
            'options' => $sentWallets,
            'value' => $this->request->query('sent_wallet_id'),
            'empty' => '--choose sent wallet --',
            'class' => 'btn-default select-style select2-offscreen',
            'id' => 'search-wallet-sent',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('receive_wallet_id', array(
            'options' => $receiveWallets,
            'value' => $this->request->query('receive_wallet_id'),
            'empty' => '--choose recieve wallet --',
            'class' => 'btn-default select-style select2-offscreen',
            'id' => 'search-wallet-receive',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('transfer_money', array(
            'label' => false,
            'value' => $this->request->query('transfer_money'),
            'type' => 'number',
            'placeholder' => 'enter money',
            'class' => 'btn-default',
            'div'=>false,
            'id' => 'search-money-transfer',
            'required' => false
        ));
        ?>
<!--        <span id="search-time-transfer " style="position: relative !important;
              left: 37% !important;">-->

            <?php
            echo $this->Form->input('day_start', array(
                'options' => array(
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                    11 => '11',
                    12 => '12',
                    13 => '13',
                    14 => '14',
                    15 => '15',
                    16 => '16',
                    17 => '17',
                    18 => '18',
                    19 => '19',
                    20 => '10',
                    21 => '21',
                    22 => '22',
                    23 => '23',
                    24 => '24',
                    25 => '25',
                    26 => '26',
                    27 => '27',
                    28 => '28',
                    29 => '29',
                    30 => '30',
                    31 => '31'
                ),
                'value' => $this->request->query('day_start'),
                'label' => false,
                'empty' => '-- day--',
                'div' => false,
                'class' => ' btn-default',
                'id' => 'search-day-transfer',
                'required' => false
            ));
            ?>    
            <?php
            echo $this->Form->input('month_start', array(
                'options' => array(
                    01 => 'January',
                    02 => 'February',
                    03 => 'March',
                    04 => 'April',
                    05 => 'May',
                    06 => 'June',
                    07 => 'July',
                    08 => 'August',
                    09 => 'September',
                    10 => 'October',
                    11 => 'November',
                    12 => 'December'
                ),
                'value' => $this->request->query('month_start'),
                'label' => false,
                'empty' => '-- month--',
                'class' => ' btn-default',
                'div'=>false,
                'id' => 'search-month-transfer',
                'required' => false
            ));
            ?>    
            <?php
            echo $this->Form->input('year_start', array(
                'label' => false,
                'value' => $this->request->query('year_start'),
                'type' => 'number',
                'placeholder' => 'enter year',
                'class' => ' btn-default',
                'div'=>false,
                'id' => 'search-year-transfer',
                'required' => false
            ));
            ?>
        <!--</span>--> 
            <button class="btn"id="button" type="submit"><span class="glyphicon glyphicon-search"></span></button>
       
        <?php echo $this->Form->end(); ?> 
    </span>


    <br><br>
    <div class="row" style="position: relative;margin-top: 4%;">
        <div class="col-xs-10 col-xs-offset-1">
            <table class="table table-striped">
                <th></th>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('sent_wallet_id'); ?></th>
                <th><?php echo $this->Paginator->sort('receive_wallet_id'); ?></th>
                <th><?php echo $this->Paginator->sort('transfer_money'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions" style="color:#337ab7;"><?php echo h('Actions'); ?></th> 
                  
                <?php foreach ($transferWallets as $transferWallet): ?>
                    <tr> 
                        <td> 
                            <input type="checkbox" name="transfer_id[]" 
                                   value="<?php echo h($transferWallet['TransferWallet']['id']); ?>" 
                                   id="<?php echo h($transferWallet['TransferWallet']['id']); ?>" 
                                   class="checkbox-transfer">
                        </td>
                        <td style="width: 10%;" class="tr-transfer-id">
                            <?php echo h($transferWallet['TransferWallet']['id']); ?>&nbsp;
                        </td>
                        <td class="tr-transfer-wallet-sent" 
                            name="<?php echo h($transferWallet['TransferWallet']['sent_wallet_id']); ?>">
                            <?php echo h($sentWallets[$transferWallet['TransferWallet']['sent_wallet_id']]); ?>&nbsp;
                        </td>
                        <td class="tr-transfer-wallet-receive" 
                            name="<?php echo h($transferWallet['TransferWallet']['receive_wallet_id']); ?>">
                            <?php echo h($receiveWallets[$transferWallet['TransferWallet']['receive_wallet_id']]); ?>&nbsp;
                        </td>
                        <td class="tr-transfer-money">  
                            <span class="money-tr">
                                <?php echo $this->Number->currency($transferWallet['TransferWallet']['transfer_money'], 
                                    ' ', $options = array(
                                        'thousands' => '.',
                                        'wholePosition' => 'after', 
                                        'places' => 0 )); ?> &nbsp;
                            </span>            
                            <span>VND</span>
                        </td>
                        <td><?php echo $this->Time->format($transferWallet['TransferWallet']['created'], '%B %e, %Y '); ?>&nbsp;</td>
                        <td><?php echo $this->Time->format($transferWallet['TransferWallet']['modified'], '%B %e, %Y '); ?>&nbsp;</td>
                        <td class="actions">
                            <a style="float:none;color:#27c24c" class="update-link" 
                               id="update-link" data-toggle="modal" data-target="#editModal" title="Edit">
                                <i class="fa fa-pencil-square-o"></i> </a>
 
                            <a href="#" id="delete-link" name="<?php echo h($transferWallet['TransferWallet']['id']); ?> " 
                               data-toggle="modal" data-target="#deleteModal" 
                               class="delete-transaction glyphicon glyphicon-trash" title="Delete" 
                               onclick="deleteSigle(this.name)"></a> 
                            
                        </td> 
                    </tr>
<?php endforeach; ?>
            </table>
            <!-- phan trang -->

            <?php if (empty($transferWallets)) { ?>
                <p style=" color: red;margin-top: 8%; text-align: center;"> No transfer Wallets. First, you must add wallet!</p>
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
                            if ($countTransfer < 20) {
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
 
<!-- Add Modal -->
            <div class="modal fade " id="addModal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="myModalLabel">
                                Add a transfer
                            </h4>
                        </div>

                        <!-- Modal Body -->
                        <form action="/MoneyLover/transferWallets/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
<?php $this->Form->input('id'); ?>
                        <div class="modal-body add-transer-body">

                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"
                                            for="inputEmail3">Wallet Sent</label>
                                    <div class="col-sm-12" style="margin-bottom: 12px;">
                                        <?php echo $this->Form->input('sent_wallet_id', array('label' => false, 
                                            'placeholder' => 'Wallet Name sent', 
                                            'id' => 'WalletName', 
                                            'empty' => '--choose wallet--',
                                            'class' => 'form-control', 
                                            'name' => 'data[TransferWallet][sent_wallet_id]')); ?>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="inputPassword3" >Wallet Receive</label>
                                    <div class="col-sm-12" style="margin-bottom: 12px;">
                                        <?php echo $this->Form->input('receive_wallet_id', array('label' => false, 
                                            'placeholder' => 'Wallet Name receive', 
                                            'id' => 'WalletName', 
                                            'empty' => '--choose wallet--',
                                            'class' => 'form-control', 
                                            'name' => 'data[TransferWallet][receive_wallet_id]')); ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="inputPassword3" >Money</label>
                                    <div class="col-sm-12" style="margin-bottom: 12px;">
                                        <?php echo $this->Form->input('transfer_money', array('label' => false, 
                                            'id' => 'WalletMoneyCurrent', 
                                            'class' => 'form-control', 
                                            'type' => 'number',
                                            'div'=>false,
                                            'placeholder' => 'Transfer Money', 
                                            'name' => 'data[TransferWallet][transfer_money]', 'required',
                                            'style'=>'width: 90%; float: left')); ?>  
                                        <span id="pricetag-vnd"><b>VND</b></span>
                                    </div>
                                </div>
                          
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer " style=" margin-top: 37% !important;">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-md"   id="button">
                                Add a transfer
                            </button>
                        </div>
                          </form>
                    </div>
                </div>
            </div>
            
            <!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <!-- Modal Header --> 
            <div class="modal-header"> 
                <h4 class="modal-title" id="myModalLabel">
                    Delete a transfer
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                Are you sure to delete this transfer?
            </div>
            
            <!-- Modal Footer -->
            <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
            <form action="" id="TransferDeleteForm" method="post" accept-charset="utf-8">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                            Close
                    </button>
                    <button type="submit" class="btn btn-md btn-danger"  >
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 
            
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="myModalLabel">
                                Edit a category
                            </h4>
                        </div>
                        <!-- Modal Body -->
                        <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
                        <form action="" id="TransferEditForm" method="post" accept-charset="utf-8">
                            <div class="modal-body" id="before-form-edit">
                                <input type="hidden" name="data[TransferWallet][id]" value="" id="TransferWalletIdEdit">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"
                                            for="edit-wallet-sent">Wallet Sent</label>
                                    <div class="col-sm-12 edit-sent-wallet" style="margin-bottom: 14px;">
                                       <?php echo $this->Form->input('sent_wallet_id', array(
                                            'label' => false,  
                                            'id'=>'edit-wallet-sent',
                                           'name' => 'data[TransferWallet][sent_wallet_id]',
                                            'div'=> false,
                                            'value'=>"" )); ?> 
                                     </div>
                                </div>
                              
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"
                                            for="edit-wallet-receive">Wallet Recieve</label>
                                    <div class="col-sm-12 edit-receive-wallet" style="margin-bottom: 14px;">
                                       <?php echo $this->Form->input('receive_wallet_id', array(
                                            'label' => false,  
                                            'id'=>'edit-wallet-receive',
                                           'name' => 'data[TransferWallet][receive_wallet_id]',
                                            'div'=> false,
                                            'value'=>"")); ?> 
                                     </div>
                                </div>
                                
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"
                                            for="edit-money">Transfer Money</label>
                                    <div class="col-sm-12" style="margin-bottom: 14px;">
                                        <?php echo $this->Form->input('transfer_money', array(
                                    'label' => false, 
                                    'placeholder' => 'enter money', 
                                    'class' => 'edit-transfer-money',
                                            'type'=>'number',
                                            'div'=>false,
                                            'id'=>'edit-money',
                                           'name' => 'data[TransferWallet][transfer_money]',
                                            'value'=>"")); ?>
                                        <span id="pricetag-vnd"><b>VND</b></span>
                                       </div>
                                </div>

                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer" style="margin-top: 33%">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-md"   id="button">
                                    Save changes
                                </button>
                            </div>
                            <form>
                                </div>
                                </div>
                                </div>
            
        </div>
    </div>
</div>
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
                    
                 $(".update-link").click(function () { 

                    var idWalletSent = $(this).closest('tr').find('.tr-transfer-wallet-sent').attr("name");
                    $(".edit-sent-wallet select").val(idWalletSent);
                    
                    var idWalletReceive = $(this).closest('tr').find('.tr-transfer-wallet-receive').attr("name");
                    $(".edit-receive-wallet select").val(idWalletReceive);

                    var money = $(this).closest('tr').find('.tr-transfer-money').children(".money-tr").text().trim();
                    var replaceMoney = money.replace(/\./g, '');
                    $("#edit-money").val(replaceMoney);
                    
                    var id = $(this).closest('tr').find('.tr-transfer-id').text().trim();
                    $("#TransferEditForm").attr("action", "/MoneyLover/transferWallets/edit/" + id + "");
                    $("#TransferWalletIdEdit").val(id);
                    
                });
                
                function deleteSigle($id) {
                    $("#TransferDeleteForm").attr("action", "/MoneyLover/transferWallets/delete/" + $id);
                }

            </script>