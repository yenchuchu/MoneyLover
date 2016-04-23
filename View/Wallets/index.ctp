<?php echo $this->Flash->render('positive') ?>

<?php echo $this->element('menu_user'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-wallet">
    
    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('My Wallets'), array('controller' => 'Transactions', 'action' => 'index')); ?>
            <a id="add-button" class="btn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
    </h1>
    
            <p id="total-money-current"> Total money current: <?php
echo $this->Number->currency($sumMoneyCurrent, ' VND', $options = array('thousands' => '.',
    'wholePosition' => 'after', 'places' => 0
));
?> </p>
    <div class="row">
        <?php
        if (empty($wallets)) {
            echo "<p>No wallet</p>";
        }
        ?>
<?php foreach ($wallets as $wallet): ?>
            <div class="col-lg-6 ">
                <div class="card">
                    
                    <ul class="list-group list-group-flush wallet-details">
                        <li class="wallet-id-in-for" style="display: none;"><?php echo h($wallet['Wallet']['id']); ?> </li>
                        <li class="list-group-item " id="card-header">
                            <span class="wallet-name-in-for"><?php echo h($wallet['Wallet']['name']); ?> </span>
                             <a href="#" id="delete-link" name="<?php echo h($wallet['Wallet']['id']); ?> " 
                               data-toggle="modal" data-target="#deleteModal" 
                               class="glyphicon glyphicon-trash delete-link-wallet" title="Delete" 
                               onclick="deleteSigle(this.name)"></a> 
                            
                            <a id="update-link "  class="update-link update-link-wallet-edit"  
                               data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-pencil-square-o" style="font-size: 22px;"></i> </a>  
                        </li>
                        <li class="list-group-item wallet-info-in-for"><b>Wallet info: </b>
                            <i class="wallet-info-details" value="<?php echo $wallet['Wallet']['info']; ?>">
                                <?php 
                                if ($wallet['Wallet']['info'] == NULL) {
                                    echo "--No description--";
                                } else
                                    echo h($wallet['Wallet']['info']);
                                ?> <br> 
                            </i>
                        </li>

                        <li class="list-group-item"><b>Money_initialize: </b>
                            <span style="color: black">
                            <?php
                            echo $this->Number->currency($wallet['Wallet']['money_initialize'], 
                                    '', $options = array(
                                        'thousands' => '.',
                                        'wholePosition' => 'after', 
                                        'places' => 0 ));
                            ?></span> <span style="color: black"><b>VND</b></span>
                        </li>

                        <li class="list-group-item"><b>Current money: </b>
                            <span style="color: black">
                             <?php
                            echo $this->Number->currency($wallet['Wallet']['money_current'], 
                                    '', $options = array(
                                        'thousands' => '.',
                                        'wholePosition' => 'after', 
                                        'places' => 0
                            ));
                            ?>    
                            </span> <span style="color: black"><b>VND</b></span> 
                            <?php 
//                            echo $this->Number->formatDelta('-123456.7890', array(
//                                'places' => 2,
//                                'decimals' => '.',
//                                'thousands' => ','
//                            ));
                            ?>
                        </li>
                        <li class="list-group-item"><i> 
                                <span class="time-create-wallet"><b> Create: </b>   &nbsp; 
                                    <span style="color: black">
                                     <?php echo $this->Time->format($wallet['Wallet']['created'], '%B %e, %Y'); ?> 
                                    </span>
                                </span> <br>
                            </i>
                        </li>
                        <li class="list-group-item"><i> 
                                <span class="time-modified-wallet"><b> Modified: </b> &nbsp; 
                                <span style="color: black">
                                    <?php echo $this->Time->format($wallet['Wallet']['modified'], '%B %e, %Y'); ?> 
                                </span>
                                    </span> 
                            </i>
                        </li>
                    </ul>
                </div>
            </div> 
<?php endforeach; ?>

    </div>
            <!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Delete a wallet
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                Are you sure to delete this wallet?    
            </div>

            <!-- Modal Footer -->
            <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
            <form action="" id="WalletDeleteForm" method="post" accept-charset="utf-8">
                
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
            <!-- MODAL -->
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add a wallet
                </h4>
            </div>
            
            <!-- Modal Body -->
            <form action="/MoneyLover/wallets/add" class="form-horizontal"  method="post" accept-charset="utf-8">
            <div class="modal-body">
                    
                
                   <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
                    <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="inputEmail3">Wallet Name</label>
                    <div class="col-sm-12">
                        <input name="data[Wallet][name]" class="form-control" 
                               placeholder="Enter a name  " maxlength="64" type="text" 
                               id="inputEmail3" required="required">
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="inputPassword3" >Money</label>
                    <div class="col-sm-12">
                        <input name="data[Wallet][money_initialize]" step="any" 
                                type="number" class="form-control" 
                                placeholder="Enter amount of money" id="inputPassword3" required="required">
                    </div>
                  </div>
               <div class="form-group">
                    <label class="col-sm-4 control-label"
                          for="inputPassword3" >Description</label>
                    <div class="col-sm-12">
                        <input name="data[Wallet][info]"  class="form-control" 
                                placeholder="Enter an info" maxlength="500" 
                                type="text" id="inputPassword3">
                    </div>
                  </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md"   id="button">
                    Add a wallet
                </button>
            </div>
             </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit a wallet
                </h4>
            </div>

            <!-- Modal Body -->
            
             <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
            <form action="" id="WalletEditForm" method="post" accept-charset="utf-8">
                
            <div class="modal-body"> 
                <input type="hidden" name="data[Wallet][id]" value="" id="WalletIdEdit">
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="edit-name">Wallet Name</label>
                        
                        <div class="col-sm-12" style="margin-bottom: 13px;">
                            <?php echo $this->Form->input('name', array(
                                'label' => false, 
                                'class' => 'form-control',
                                'placeholder' => 'Enter a name',
                                'value'=>"",
                                'name'=> 'data[Wallet][name]',
                                'id'=>'edit-name')); ?> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="edit-info" >Description</label>
                        <div class="col-sm-12" style="margin-bottom: 13px;">
                             <?php echo $this->Form->textarea('info', array(
                                'label' => false, 
                                'class' => 'form-control',  
                                'placeholder' => 'Enter a info',
                                'value'=>"",
                                 'name' => 'data[Wallet][info]',
                                'id'=>'edit-info' )); ?> 
                        </div>
                    </div> 
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer" style="margin-top: 24%;">
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

</div> 


<script type="text/javascript">

    function deleteSigle($id) {
        $("#WalletDeleteForm").attr("action", "/MoneyLover/Wallets/delete/" + $id);
    }
 
    $(".update-link").click(function () {
       var name = $(this).closest("li").find(".wallet-name-in-for").text();
        $("#edit-name").val(name);
        
        var info = $(this).closest("li").siblings(".wallet-info-in-for").find(".wallet-info-details").attr("value").trim();
         $("#edit-info").val(info);
        
        var id = $(this).closest("li").siblings(".wallet-id-in-for").text();
        $("#WalletEditForm").attr("action", "/MoneyLover/Wallets/edit/" + id + "");
          $("#WalletIdEdit").val(id);
    });

</script>
     
                