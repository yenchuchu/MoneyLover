<?php echo $this->element('menu_user'); ?> 

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-transaction">

    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('Transactions'), array('controller' => 'Transactions', 'action' => 'index')); ?>
        <a id="add-button" class="btn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
    </h1>
    <span id="form-search">
        <?php
        echo $this->Form->create(array(
            'type' => 'get',
            'id' => 'search',
            'class' => 'form-inline form-search-top'));
        ?>
        <?php
        echo $this->Form->input('categorie_id', array(
            'options' => $categories,
            'value' => $this->request->query('categorie_id'),
            'empty' => '--choose category--',
            'class' => ' btn-default select-style select2-offscreen',
            'id' => 'search-category-transaction',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('wallet_id', array(
            'options' => $wallets,
            'value' => $this->request->query('wallet_id'),
            'empty' => '--choose wallet--',
            'class' => 'btn-default  select-style select2-offscreen',
            'id' => 'search-wallet-transaction',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('money', array(
            'label' => false,
            'value' => $this->request->query('money'),
            'type' => 'number',
            'placeholder' => 'enter money',
            'class' => 'btn-default',
            'div'=>false,
            'id' => 'search-money-transaction',
            'required' => false
        ));
        ?> 
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
                'div' => false,
                'label' => false,
                'empty' => '-- day--',
                'class' => 'btn-default ',
                'id' => 'search-day-transaction',
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
                'div' => false,
                'label' => false,
                'empty' => '-- month--',
                'class' => 'btn-default ',
                'id' => 'search-month-transaction',
                'required' => false
            ));
            ?>

            <?php
            echo $this->Form->input('year_start', array(
                'label' => false,
                'value' => $this->request->query('year_start'),
                'div' => false,
                'type' => 'number',
                'placeholder' => 'enter year',
                'id' => 'search-year-transaction',
                'required' => false
            ));
            ?>  
        <button class="btn search" id="button"  type="submit" title="search"><span class="glyphicon glyphicon-search"></span></button>

        <?php echo $this->Form->end(); ?> 
    </span>

    <br><br>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <table class="table table-striped">
                <tr>
                    <th></th>
                    <th style="display: none"></th>
                    <th><?php echo $this->Paginator->sort('wallet_id'); ?></th>
                    <th style="width: 16%;"><?php echo $this->Paginator->sort('categorie_id'); ?></th>
                    <th style="width: 20%;"><?php echo $this->Paginator->sort('transaction_money'); ?></th>
                    <th><?php echo $this->Paginator->sort('day_transaction'); ?></th> 
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions" style="color:#337ab7;"><?php echo h('Actions'); ?></th> 

                </tr>
                <?php foreach ($transactions as $transaction): ?>  
                    <tr title="<?php echo h($transaction['Transaction']['transaction_description']); ?>">
                        <td >
                            <input type="checkbox" 
                                   class="transaction-checkbox" 
                                   name="transaction_id[]" 
                                   value="<?php echo h($transaction['Transaction']['id']); ?>" 
                                   id="<?php echo h($transaction['Transaction']['id']); ?>">
                        </td>
                        <td style="display: none" class="tr-transaction-id">
                            <?php echo h($transaction['Transaction']['id']); ?>
                        </td>
                        <td class="tr-transaction-wallet" 
                            name="<?php echo h($transaction['Transaction']['wallet_id']); ?>">
                            <?php echo h($wallets[$transaction['Transaction']['wallet_id']]); ?>&nbsp;
                        </td>
                        <td style="width: 10%;" 
                            class="tr-transaction-category"
                            name="<?php echo h($transaction['Transaction']['categorie_id']); ?>">
                            <?php echo h($categories[$transaction['Transaction']['categorie_id']]); ?>&nbsp;
                        </td>
                        <td class="tr-transaction-money"> 
                            <span class="money-tr">
                            <?php echo $this->Number->currency($transaction['Transaction']['transaction_money'],  
                                    '',
                                    $options = array(
                                        'thousands' => '.',
                                'wholePosition' => 'after', 
                                        'places' => 0));
                            ?> &nbsp;
                            </span>
                            <span>VND</span>
                        </td> 
                        <td class="tr-transaction-day">
                            <?php echo $this->Time->format($transaction['Transaction']['day_transaction'], '%B %e, %Y'); ?>&nbsp;</td>
                         <td><?php echo $this->Time->format($transaction['Transaction']['modified'], '%B %e, %Y '); ?>&nbsp;</td>
                        <td class="actions">
<!--                            <a style="float:none;color:#27c24c" id="update-link" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o"></i> </a>
                            <a style="float:none;"id="delete-link" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o"></i>-->
                            
                                <a style="float:none;color:#27c24c" class="update-link" 
                               id="update-link" data-toggle="modal" data-target="#editModal" title="Edit">
                                <i class="fa fa-pencil-square-o"></i> </a>
 
                            <a href="#" id="delete-link" name="<?php echo h($transaction['Transaction']['id']); ?> " 
                               data-toggle="modal" data-target="#deleteModal" 
                               class="delete-transaction glyphicon glyphicon-trash" title="Delete" 
                               onclick="deleteSigle(this.name)"></a> 
 
                        </td>
                    </tr>

                <?php endforeach; ?></tr>

            </table>
            <?php if (empty($transactions)) { ?>
                <p style=" color:red;margin-top: 8%;text-align: center;"> No Transaction.  First, you must add wallet!</p>
                <?php
            } else {
                ?>
                <div class="page" >
                    <div class="paging">
                        <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP'));
                        ?>
                        <span class="wrap-select-all">
                            <input type="checkbox" name="checkAll" value="checkAll"   id="checkAll">
                            <label class="label-select-all" for="checkAll">Select All</label>
                            <span class="with-selected"> <i> With selected: </i></span>
                            <span  id="deleteAll"  class="glyphicon glyphicon-trash" title="Delete"> </span> 
                            <?php
                            if ($countTransaction < 20) {
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

            <?php } ?>
        </div>

    </div>

    
<!-- Modal --> 
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header"> 
                <h4 class="modal-title" id="myModalLabel">
                    Add a transaction
                </h4>
            </div>

            <!-- Modal Body -->
            <?php echo $this->Form->create('Transaction', array('action' => 'add')); ?>

            <div class="modal-body"> 
                <div class="form-group">
                    <label class="col-sm-4 control-label"
                           for="inputPassword3" >Wallet</label>
                    <div class="col-sm-12" style="margin-bottom: 10px;">
                        <?php
                        echo $this->Form->input('wallet_id', array(
                            'label' => false,
                            'empty' => '--choose wallet--',
                            'id' => 'WalletMoneyCurrent',
                            'class' => 'form-control'));
                        ?>  
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-4 control-label"
                            for="inputEmail3">Category</label>
                    <div class="col-sm-12" style="margin-bottom: 10px;">
                        <?php
                        $options = array(
                            'Income' => array(
                                $categoriesIncome
                            ),
                            'Expense' => array(
                                $categoriesExpense
                            )
                        );
                        echo $this->Form->select('categorie_id', $options, array(
                            'empty' => '--choose category--',
                            'label' => false,
                            'id' => 'WalletName',
                            'class' => 'form-control'));
                        ?> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"
                           for="inputPassword3" >Money Transaction</label>
                    <div class="col-sm-12" style="margin-bottom: 10px;">
                        <?php
                        echo $this->Form->input('transaction_money', array('label' => false,
                            'placeholder' => 'enter money',
                            'style' => 'padding-left: 8px',
                            'id' => 'WalletName',
                            'class' => 'form-control'));
                        ?> 
                    </div>
                </div>
                <div class="form-group" id="add-transaction-date">
                    <label class="col-sm-4 control-label"
                           for="inputPassword3" >Day Transaction</label>
                    <div class="col-sm-12" style="margin-bottom: 10px;">
                        <?php
                        echo $this->Form->input('day_transaction', array('label' => false,
                            'placeholder' => 'Wallet Name receive',
                            'id' => 'WalletName',
                            'class' => 'form-control',
                            'type' => 'date',
                            'separator'=>''));
                        ?> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"
                           for="inputPassword3" >Note</label>
                    <div class="col-sm-12" >
                        <?php
                        echo $this->Form->input('transaction_description', array('label' => false,
                            'id' => 'WalletName',
                            'class' => 'form-control',
                            'placeholder' => 'enter a note',
                            'style' => 'padding-left: 8px;min-height: 70px; height: 70px;'));
                        ?> 
                    </div>
                </div>


                <!-- Modal Footer -->
                <div class="modal-footer" style=" margin-top: 78% !important;">
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
</div>
    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header"> 
                    <h4 class="modal-title" id="myModalLabel">
                        Edit a transaction
                    </h4>
                </div>

                <!-- Modal Body -->
                <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
                <form action="" id="TransactionEditForm" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <input type="hidden" name="data[Transaction][id]" value="" id="TransactionIdEdit">
                        <div class="form-group">
                            <label  class="col-sm-4 control-label"
                                    for="edit-transaction-wallet">Wallet</label>
                            <div class="col-sm-12 edit-transaction-wallet" style=" margin-bottom: 3%;">
                                <?php echo $this->Form->input('wallet_id', array(
                                        'label' => false, 
                                    'div'=>false, 
                                        'id'=> 'edit-transaction-wallet',
                                    'value'=>"")); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"
                                   for="edit-transaction-category" >Category</label>
                            <div class="col-sm-12 edit-transaction-category" style=" margin-bottom: 3%;">
                                <?php echo $this->Form->input('categorie_id', array(
                                    'label' => false,  
                                    'div'=>false, 
                                    'id'=> 'edit-transaction-category',
                                    'value'=>"")); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"
                                   for="edit-transaction-money" >Money</label>
                            <div class="col-sm-12">
                                <?php echo $this->Form->input('transaction_money', array(
                                    'label' => false, 
                                    'div'=>false, 
                                    'placeholder' => 'Enter amount of money',
                                    'id'=> 'edit-transaction-money',
                                    'value'=>"")); ?>
                                <span id="pricetag-vnd"><b>VND</b></span> 
                            </div>
                        </div> 
                    <div class="form-group">
                            <label class="col-sm-4 control-label"
                                   for="edit-transaction-note" style="margin-top: 15px; margin-bottom: 10px;">Note</label>
                            <div class="col-sm-12">
                                <?php echo $this->Form->input('transaction_description', array(
                                    'label' => false, 
                                    'div'=>false, 
                                    'placeholder' => 'Enter a note',
                                    'id'=> 'edit-transaction-note',
                                    'value'=>"",
                                    'style' => 'padding-left: 8px;min-height: 70px; height: 70px;'
                                    . '    width: 100%; border: 1px solid #27C24C; border-radius: 5px;')); ?>  
                            </div>
                        </div> 
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer" style="margin-top: 53%;">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-md"   id="button">
                        Save changes
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
            <form action="" id="TransactionDeleteForm" method="post" accept-charset="utf-8">
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

    
</div>



    <script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });

        $('#deleteAll').click(function () {
            ids = new Array();
            $("input:checkbox[name='transaction_id[]']:checked").each(function () {
                ids.push($(this).val());
            });
            if (ids.length >= 1) {
                console.log(ids);
                deleteAll("transactions/deleteAll", ids);
                document.location.reload();
            } else {
                return false;
            }

        });

         $(".update-link").click(function () { 
             
             var note = $(this).closest('tr').attr("title").trim();
              $("#edit-transaction-note").val(note);
             
            var idWallet = $(this).closest('tr').find('.tr-transaction-wallet').attr("name");
            $(".edit-transaction-wallet select").val(idWallet);

            var idCategory = $(this).closest('tr').find('.tr-transaction-category').attr("name");
            $(".edit-transaction-category select").val(idCategory);

            var money = $(this).closest('tr').find('.tr-transaction-money').children(".money-tr").text().trim();
            var replaceMoney = money.replace(/\./g, '');
            $("#edit-transaction-money").val(replaceMoney);

            var id = $(this).closest('tr').find('.tr-transaction-id').text().trim();
            $("#TransactionEditForm").attr("action", "/MoneyLover/transactions/edit/" + id + "");
            $("#TransactionIdEdit").val(id);

        });
                
        function deleteSigle($id) {
            $("#TransactionDeleteForm").attr("action", "/MoneyLover/transactions/delete/" + $id);
        }
    </script>
