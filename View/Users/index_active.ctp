<?php echo $this->element('menu_admin'); ?>

<!-- About Section -->
<section id="accounts" class=" content-section text-center">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="col-lg-12 accounts-active">  
                <h1> account <?php echo $typeLabel; ?> </h1>
                <a href="#add-admin" id="add-admin-other"> Add Admin</a>
                <?php // echo $this->Form->create('User', array('url' => array('controller' => 'User', 'action' => 'index'))); ?>
                <table class="table table-striped table-hover">
                    <tr class="table-header">
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
                                <?php
                                echo $this->Form->postLink('', array('controller' => 'Users', 'action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']),
                                    'class' => 'edit-transaction glyphicon glyphicon-trash', 'style' => 'margin-left: 0;', 'title' => 'Delete'));
                                ?>
                            </td>
                            <td>
                                <?php
                                $role_user = 0;
                                if ($user['User']['role'] == $role_user) {
                                    echo $this->Html->image('../image_avatar/avatar_user.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                } else {
                                    echo $this->Html->image('../image_avatar/avatar_admin.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                                }
                                ?>
                            </td>
                        </tr>
<?php endforeach; ?>

                </table>

                <?php if (empty($users)) { ?>
                    <p> Nobody</p>
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
                <div id="add-admin" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Admin</h3>
                        </div> 
                        <div class="panel-body">
<?php echo $this->Form->create('User', array('action' => 'add')); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => false, 'placeholder' => 'enter username')); ?>
                            </div>
                            <div class="form-group">
<?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => false, 'placeholder' => 'enter email')); ?>
                            </div>   
                            <div class="form-group"> 
                                <div class="col-sm-10 submit-wallet submit-accounts" >
                                    <a href="#" class="btn add-admin-cancel" > Cancel </a> 
                                    <button type="submit" class="btn add-admin-save" >Add</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<script type = "text/javascript" src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

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