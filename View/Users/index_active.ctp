<?php echo $this->element('menu_admin'); ?>

 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="user">

    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('Account '.$typeLabel), array('controller' => 'TransferWallets', 'action' => 'index')); ?>
        <a id="add-button" class="btn" title="Add" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
    </h1>
     
    <br><br>
    <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <table class="table table-striped">
            <tr>
                        <th style="width: 1%;"></th>
                        <th style="width: 10%;"><?php echo $this->Paginator->sort('id'); ?> </th>
                        <th style="color:#337ab7;"><?php echo h('Avatar'); ?></th>
                        <th><?php echo $this->Paginator->sort('username'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th style="color:#337ab7;"><?php echo h('Destroy'); ?></th>
                        <th><?php echo $this->Paginator->sort('role'); ?></th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                    <tr>
                            <td><input type="checkbox" name="user_id[]" class="checkbox-account" value="<?php echo h($user['User']['id']); ?>" id="<?php echo h($user['User']['id']); ?>"></td>
                            <td  style="width: 10%;"><?php echo h($user['User']['id']); ?>&nbsp;</td>
                            <td>
                                <?php
                                if ($user['User']['avatar'] == NULL) {
                                    echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                } else {
                                    echo $this->Html->image('/image_avatar/' . $user['User']['avatar'], array('alt' => 'CakePHP', 'id' => 'avatar'));
                                }
                                ?>
                            </td>
                            <td><?php echo h($user['User']['username']); ?>&nbsp;</td> 
                            <td><?php echo h($user['User']['email']); ?>&nbsp;</td> 
                            <td><?php echo $this->Time->format($user['User']['created'], '%B %e, %Y '); ?> </td>
                            <td class="actions">
                                <a href="#" id="delete-link" name="<?php echo h($user['User']['id']); ?> " 
                data-toggle="modal" data-target="#deleteModal" 
                class="delete-transaction glyphicon glyphicon-trash" title="Delete" 
                onclick="deleteSigle(this.name)"></a>     
                                <?php
//                                echo $this->Form->postLink('', array('controller' => 'Users', 'action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']),
//                                    'class' => 'edit-transaction glyphicon glyphicon-trash', 'style' => 'margin-left: 0;', 'title' => 'Delete'));
                                ?>
                            </td>
                            <td>
                                <?php
                                $role_user = 0;
                                if ($user['User']['role'] == $role_user) {
                                    echo $this->Html->image('../image_avatar/avatar_user.jpg', array(
                                        'alt' => 'CakePHP', 
                                        'id' => 'avatar', 
                                        'title'=> 'User'));
                                } else {
                                    echo $this->Html->image('../image_avatar/avatar_admin.jpg', array(
                                        'alt' => 'CakePHP', 
                                        'id' => 'avatar', 
                                        'title'=> 'Admin'));
                                }
                                ?>
                            </td>
                        </tr>
<?php endforeach; ?>
            </table>
            <!-- phan trang -->

            <?php if (empty($users)) { ?>
                    <p style="    text-align: center;"> Nobody</p>
                <?php
                } else {
                    ?>
                    <div class="page">
                        <div class="paging">
                            <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP')); ?>
                            <span class="wrap-select-all">
                                <input type="checkbox" name="checkAll" value="checkAll" id="checkAll">
                                <label class="label-select-all" for="checkAll">Select All</label>
                                <span class="with-selected"> <i> With selected: </i></span>
                                <span  id="deleteAll" class="glyphicon glyphicon-trash" title="Delete"> </span> 
                                <?php
                                if ($this->request->query('type') == 'active' || $this->request->query('type') == null) {
                                    $countUser = $countAccountActive;
                                } else {
                                    $countUser = $countAccountRequest;
                                }
                                if ($countUser < 20) {
                                    ?>
                                    <span></span>
                                <?php
                                } else {
                                    echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
                                    echo $this->Paginator->numbers(array('class' => 'number-page', 'separator' => false));
                                    echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
                                }
                                ?>
                            </span>
                        </div>
                    </div>

<?php } ?>

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
                    Add a Account
                </h4>
            </div>
            
            <!-- Modal Body -->
            <?php echo $this->Form->create('User', array('action' => 'add')); ?>
            <div class="modal-body">
                
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="addUsername">User Name</label>
                    <div class="col-sm-12" style="margin-bottom: 17px;">
                        <?php echo $this->Form->input('username', array('class' => 'form-control', 
                            'label' => false, 'placeholder' => 'enter username', 'id'=>'addUsername')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-4 control-label"
                              for="addEmail">Email</label>
                      <div class="col-sm-12" style="margin-bottom: 17px;">
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 
                            'label' => false, 'placeholder' => 'enter email', 'id'=> 'addEmail')); ?>
                    </div>
                  </div> 
                <div style="width: 41%; margin-left: 14px;">
                    <label class="radio-inline" id="add-admin"  style="padding-left: 28px; top: 0px;">
                        <input type="radio" name="data[User][role]"
                               value="0" style="margin-left: -22px; top: -8px;"> 
                        Administrator 
                    </label>
                    <label class="radio-inline" id="add-user">
                        <input type="radio" name="data[User][role]" 
                               value="1" style="top: -8px;">
                         User  
                    </label>             
                </div>
               
               
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="submit" class="btn btn-md"   id="button">
                    Add a Account
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
             <!--Modal Header--> 
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Delete a User
                </h4>
            </div>
            
             <!--Modal Body--> 
            <div class="modal-body">
                Are you sure to delete this User?
            </div>
             <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
             <form action="" id="UsereleteForm" method="post" accept-charset="utf-8">
              
             <!--Modal Footer--> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                        Close
                </button>
                <button type="submit" id="delete" class="btn btn-md btn-danger"  >
                    Delete
                </button>
            </div>
             </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    
    function deleteSigle($id) {
           $("#UsereleteForm").attr("action","/MoneyLover/Users/delete/"+$id);
    }

    $('#deleteAll').click(function () {
        ids = new Array();
        $("input:checkbox[name='user_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("users/deleteAll", ids);
        } else {
            return false;
        }

    }); 
</script>