Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <i class="fa fa-play-circle" id="icon-banner"></i>
            <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'wallets', 'action' => 'index'), array('id' => 'banner')); ?> 
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li>
                    <?php echo $this->Html->link(__('My Wallets'), array('controller' => 'Wallets', 'action' => 'index')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link(__('Transfer Wallet'), array('controller' => 'TransferWallets', 'action' => 'index')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link(__('Transactions'), array('controller' => 'Transactions', 'action' => 'index')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link(__('Report Month'), array('controller' => 'ReportMonths', 'action' => 'index')); ?>
                </li>  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 0px">
                        <?php
                        echo $this->Form->create('User', array('url' => array('controller' => 'User', 'action' => 'index')));
                        $avatar = AuthComponent::user('avatar');
                        if ($avatar != NULL) {
                            echo $this->Html->image('../image_avatar/' . $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                        }
                        ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Update Avatar', array('controller' => 'users', 'action' => 'UploadImage', $id));
                            ?>
                        </li> 
                        <li>
                            <?php
                            $id = AuthComponent::user('id');
                            echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'change_password', $id));
                            ?>
                        </li> 
                        <li>
<?php echo $this->Html->link(__('Log out'), array('controller' => 'users', 'action' => 'logout')); ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div id="change-password" class="modalDialog ">      
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body" style="color:black;">
            <form role="form">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Current Password" name="current-password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="New Password" name="new-password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Retype New Password" name="retype-password" type="password" value="">
                    </div>
                    <a href="#" class="" style="color: black;">Forgotten your password? </a>
                    <!-- Change this to a button or input when using this as a form -->
                    <div class="submit-passsword">
                        <a href="#" class="btn password-save">Save</a>
                        <a href="#close" class="btn password-cancel">Cancel</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div> 
<!-- /#change-password -->

             <!-- <form id="search" role="form" action="<?php //$this->Html->link(__('Transactions'), array('controller' => 'Transactions', 'action' => 'index')); ?>" method="GET" class="form-inline form-search-top">
<?php
//echo $this->Form->input('categorie_id', array('options' => $categories,
// 'class' => 'select-style select2-offscreen',
// 'style' => 'background-color: rgba(251, 248, 248, 0.95)',
// 'label' => false,
// 'div' => false ));  
?>
         <select name="money" class="select-style select2-offscreen" tabindex="-1" title="Chonj tien"  >
          <option value="">-- Select Money--</option>
             <option value="">10000</option>
             <option value="10">50000</option>
             <option value="">100000</option>
             <option value="">200000</option>
             <option value="">500000</option>
             <option value="">>500000</option>
         </select>
             <input type="date" >
             <button class="btn btn-default" type="sumbit" style="    color: rgba(255,255,255,.5); background: rgba(0,0,0,.13); border: 1px solid rgba(0,0,0,.13);     border: none;" title="search">
                 <i class="fa fa-search"></i>
             </button>
                </form>   --> 
<!-- Contact Section --> 
<section id="transaction" class="content-section text-center">
    <span >
        <h1>Transactions</h1> 
    </span>  
    <a href="#add-transaction" id="a-add-transaction"> Add Transaction</a> 
    <div class="row" style="margin-right:0px; margin-bottom: 10px">

        <div class="col-lg-10 col-lg-offset-1">

            <div id="transaction-month" class="transaction-wrapper">

                <div class="panel-body" style="position: relative;">
                    <table style="width: 100%;"  class="table table-striped table-hover">
                        <thead>
                        <th></th>
                        <th><?php echo $this->Paginator->sort('Category'); ?></th>
                        <th><?php echo $this->Paginator->sort('Wallet'); ?></th>
                        <th style="width: 20%;"><?php echo $this->Paginator->sort('Money'); ?></th>
                        <th><?php echo $this->Paginator->sort('Day Transaction'); ?></th>
                        <th><?php echo $this->Paginator->sort('Created'); ?></th>
                        <th><?php echo $this->Paginator->sort('Modified'); ?></th>
                        <th class="actions"><?php echo $this->Paginator->sort('Actions'); ?></th> 
                        </thead>
<?php foreach ($transactions as $transaction): ?>
                            <tr> 
                                <td><input type="checkbox" name="transaction_id[]"  style="float: left;position: relative;
                                           top: -6px;" value="<?php echo h($transaction['Transaction']['id']); ?>" id="<?php echo h($transaction['Transaction']['id']); ?>"></td>
                                <td style="width: 10%;"><?php echo h($categories[$transaction['Transaction']['categorie_id']]); ?>&nbsp;</td>
                                <td><?php echo h($wallets[$transaction['Transaction']['wallet_id']]); ?>&nbsp;</td>
                                <td> <?php echo $this->Number->currency($transaction['Transaction']['transaction_money'], ' VND', $options = array('thousands' => '.',
        'wholePosition' => 'after', 'places' => 0));
    ?> &nbsp;</td> 
                                <td><?php echo $this->Time->format($transaction['Transaction']['day_transaction'], '%B %e, %Y'); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format($transaction['Transaction']['created'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format($transaction['Transaction']['modified'], '%B %e, %Y '); ?>&nbsp;</td>
                                <td class="actions">
                            <?php echo $this->Html->link('', array('action' => 'edit', $transaction['Transaction']['id']), array('class' => 'edit-transaction glyphicon glyphicon-pencil',
                                'style' => 'width:10%', 'title' => 'Edit'));
                            ?>
                        <?php echo $this->Form->postLink('', array('action' => 'delete', $transaction['Transaction']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transaction['Transaction']['id']), 'class' => 'edit-transaction glyphicon glyphicon-trash', 'style' => 'width:10%', 'id' => 'delete-transaction', 'title' => 'Delete'
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
                        <div class="page" style=" position: relative;
                             bottom: -5px; width: 100%;">
                            <div class="paging">
    <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP'));
    ?>
                                <span class="wrap-select-all">

                                    <input type="checkbox" name="checkAll" value="checkAll"   id="checkAll">
                                    <label class="label-select-all" for="checkAll">Select All</label>
                                    <span class="with-selected"> <i> With selected: </i></span>

            <!-- <span  id="EditAll"  class="glyphicon glyphicon-pencil" title="Edit">  </span>  -->
                                    <span  id="deleteAll"  class="glyphicon glyphicon-trash" title="Delete"> </span> 
                                    <?php
                                    $counts = 0;
                                    foreach ($transactions as $transaction):
                                        $counts++;
                                    endforeach;

                                    if ($counts <= 7) {
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

                    <div id="delete-transaction" class="modalDialog">      
                        <div class="login-panel panel panel-default">
                            <div class="panel-body" style="color: black; border-top: 1px solid #841717;">
                                <p>Are you want to delete?</p>
                                <div class="submit-wallet">
                                    <a href="#show-a-transaction" class="btn wallet-cancel">Cancel</a>
                                    <a href="#" class="btn wallet-save">Delete</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /#delete-transaction -->


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
                                    <?php echo $this->Form->input('day_transaction', array(
                                        'type' => 'date'));
                                    ?>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10 submit-wallet" style = "margin-top: 16px;
                                         width: 100%;
                                         margin-left: -10px"> 
                                        <a href="#close" style="color: white;
                                           text-decoration: none;float: left;
                                           margin-right: -13px;"  class="btn wallet-save ">Cancel</a> 
                                        <button type="submit" class="btn wallet-save" style="float: right;
                                                margin-right: -13px;
                                                ">Add</button>
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
        $("input:checkbox[name='transaction_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
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


<!-- http://stackoverflow.com/questions/5984061/is-there-a-way-to-set-the-default-date-in-a-cakephp-date-form-input