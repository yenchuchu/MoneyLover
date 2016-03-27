<?php echo $this->element('menu_user'); ?> 
<!-- Contact Section --> 
<section id="transaction" class="content-section text-center">
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
            'empty' => '--choose category--',
            'class' => 'select-style select2-offscreen',
            'id' => 'search-category-transaction',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('wallet_id', array(
            'options' => $wallets,
            'empty' => '--choose wallet--',
            'class' => 'select-style select2-offscreen',
            'id' => 'search-wallet-transaction',
            'label' => false,
            'div' => false,
            'required' => false));
        ?>
        <?php
        echo $this->Form->input('money', array(
            'label' => false,
            'type' => 'number',
            'placeholder' => 'enter money',
            'id' => 'search-money-transaction',
            'required' => false
        ));
        ?>
        <span id="search-time">

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
                'div' => false,
                'label' => false,
                'empty' => '-- day--',
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
                'div' => false,
                'label' => false,
                'empty' => '-- month--',
                'id' => 'search-month-transaction',
                'required' => false
            ));
            ?>

            <?php
            echo $this->Form->input('year_start', array(
                'label' => false,
                'div' => false,
                'type' => 'number',
                'placeholder' => 'enter year',
                'id' => 'search-year-transaction',
                'required' => false
            ));
            ?> 
        </span>
        <button class="btn btn-default " id="button-search" type="submit" title="search">
            <i class="fa fa-search"></i>
        </button>  
        <?php echo $this->Form->end(); ?> 
    </span>

    <span >
        <h1>Transactions</h1> 
    </span>  
    <a href="#add-transaction" id="a-add-transaction"> Add Transaction</a> 
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div id="transaction-month" class="transaction-wrapper">
                <div class="panel-body" style="position: relative;">
                    <table class="table table-striped table-hover">
                        <thead>
                        <th></th>
                        <th><?php echo $this->Paginator->sort('wallet_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('categorie_id'); ?></th>
                        <th style="width: 20%;"><?php echo $this->Paginator->sort('transaction_money'); ?></th>
                        <th><?php echo $this->Paginator->sort('day_transaction'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th><?php echo $this->Paginator->sort('modified'); ?></th>
                        <th class="actions" style="color:#337ab7;"><?php echo h('Actions'); ?></th> 
                        </thead>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr> 
                                <td><input type="checkbox" class="transaction-checkbox" name="transaction_id[]" value="<?php echo h($transaction['Transaction']['id']); ?>" id="<?php echo h($transaction['Transaction']['id']); ?>"></td>
                                <td><?php echo h($wallets[$transaction['Transaction']['wallet_id']]); ?>&nbsp;</td>
                                <td style="width: 10%;"><?php echo h($categories[$transaction['Transaction']['categorie_id']]); ?>&nbsp;</td>
                                <td> <?php
                            echo $this->Number->currency($transaction['Transaction']['transaction_money'], ' VND', $options = array('thousands' => '.',
                                'wholePosition' => 'after', 'places' => 0));
                            ?> &nbsp;</td> 
                                <td><?php echo $this->Time->format($transaction['Transaction']['day_transaction'], '%B %e, %Y'); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format($transaction['Transaction']['created'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format($transaction['Transaction']['modified'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php
                                    echo $this->Html->link('', array('action' => 'edit', $transaction['Transaction']['id']), array('class' => 'edit-transaction glyphicon glyphicon-pencil',
                                        'style' => 'width:10%', 'title' => 'Edit'));
                                    ?>
                                    <?php
                                    echo $this->Form->postLink('', array('action' => 'delete', $transaction['Transaction']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transaction['Transaction']['id']), 'class' => 'edit-transaction glyphicon glyphicon-trash', 'style' => 'width:10%', 'id' => 'delete-transaction', 'title' => 'Delete'
                                    ));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <!-- phan trang -->

                    <?php if (empty($transactions)) { ?>
                        <p> No Transaction</p>
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
                                    $counts = 0;
                                    foreach ($transactions as $transaction):
                                        $counts++;
                                    endforeach;

                                    if ($counts < 20) {
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

                    <div id="add-transaction" class="modalDialog">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add Transaction</h3>
                            </div> 
                            <div class="panel-body">
                                <?php echo $this->Form->create('Transaction', array('action' => 'add')); ?>
                                <div class="form-group wallet-id">  
                                    <?php echo $this->Form->input('wallet_id'); ?>
                                </div>
                                <div class="form-group categorie-id" >
                                    <?php echo $this->Form->input('categorie_id', array('options' => $categories)); ?>
                                </div>
                                <div class="form-group transaction-money">
                                    <?php echo $this->Form->input('transaction_money', array('placeholder' => 'enter money', 'style' => 'padding-left: 8px')); ?>
                                </div>  
                                <div class="form-group categorie-id" >
                                    <?php
                                    echo $this->Form->input('day_transaction', array(
                                        'type' => 'date'));
                                    ?>
                                </div>
                                <div class="form-group"> 
                                    <div class=" col-sm-10 submit-wallet submit-transaction"> 
                                        <a href="#close" class="btn transaction-cancel ">Cancel</a> 
                                        <button type="submit" class="btn transaction-save" >Add</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /#add-category -->
                </div>
            </div>
        </div>

        <!-- /.col-lg-5 -->
    </div>
</section>

<script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    $('#deleteAll').click(function () {
        ids = new Array();
//        idWallets = new Array();
        $("input:checkbox[name='transaction_id[]']:checked").each(function () {
            ids.push($(this).val());
            idWallets.push($(this).next());
        });
//        alert(idWallets);
//        $("input:checkbox").next().alert("fsdfsdf");
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("transactions/deleteAll", ids);
            document.location.reload();
        } else {
            // alert("select input, please!");
            return false;
        }

    });

    $('#EditAll').click(function () {
        ids = new Array();
        $("input:checkbox[name='transaction_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
        console.log(ids);
        editAll("transactions/editAll", ids);
    });
</script>
