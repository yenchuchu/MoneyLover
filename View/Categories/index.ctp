<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding:0px 0px; background-color: #000;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <i class="fa fa-play-circle" id="icon-banner"></i>
                <?php echo $this->Html->link(__('Money Lover'), array('controller' => 'users', 'action' => 'index'),array('id'=> 'banner')); ?>  
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li>
                    <a class=" dropdown-toggle page-scroll" data-toggle="dropdown">Accounts 
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link(__('account active'), array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'active')));
                            ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('account request'), array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'request'))); ?>
                        </li>
                    </ul>
                </li>
                <li>
                    <?php echo $this->Html->link(__('Categories'), array('controller' => 'Categories', 'action' => 'index')); ?>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 0px">
                        <?php
                        echo $this->Form->create('User', array('url' => array('controller' => 'User', 'action' => 'index')));
                        $avatar = AuthComponent::user('avatar');
                        if ($avatar != NULL) {
                            echo $this->Html->image('../image_avatar/' . $avatar, array('alt' => 'CakePHP', 'id' => 'avatar'));
                            ?>
                                <!-- <img src="/image_avatar/<?php echo $avatar; ?>" id="avatar"> -->
                        <?php
                        } else {
                            echo $this->Html->image('../image_avatar/avatar_default.jpg', array('alt' => 'CakePHP', 'id' => 'avatar'));
                            ?>
                             <!-- <img src="/image_avatar/avatar_default.jpg" id="avatar"> -->

<?php } ?>
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

<section id="categories" class="content-section text-center">
    <div class="categories-section">
        <div class="container">
            <div class="panel-heading" style="background-color: transparent !important;  padding-bottom: 0;">
                <h1 class="title"><?php echo __('Categories'); ?></h1> 
                <a href="#add-category" id="a-add-category"> Add Category</a>  
            </div>
            <div class="panel-body">
                <div class="col-lg-12 categories-income"> 
                    <table style="    width: 100%;"  class="table table-striped table-hover">
                        <thead>
                        <th></th>
                        <th><?php echo $this->Paginator->sort('Id'); ?></th>
                        <th><?php echo $this->Paginator->sort('Name'); ?></th>
                        <th><?php echo $this->Paginator->sort('Type'); ?></th>
                        <th><?php echo $this->Paginator->sort('Created'); ?></th>
                        <th><?php echo $this->Paginator->sort('Modified'); ?></th>
                        <th class="actions"><?php echo $this->Paginator->sort('Actions'); ?></th> 
                        </thead>
<?php foreach ($categories as $category): ?>
                            <tr>
                                <td> <input type="checkbox" name="category_id[]"  style="float: left;position: relative;
                                            top: -6px;" value="<?php echo h($category['Category']['id']); ?>" id="<?php echo h($category['Category']['id']); ?>"></td>
                                <td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
                                <td><?php echo h($category['Category']['name']); ?>&nbsp;</td> 
                                <td><?php
                                    if ($category['Category']['type'] == 1):
                                        echo "Income";
                                    else :
                                        echo "Expense";
                                    endif;
                                    ?></td>
                                <td><?php echo $this->Time->format($category['Category']['created'], '%B %e, %Y '); ?> </td>
                                <td><?php echo $this->Time->format($category['Category']['modified'], '%B %e, %Y '); ?> </td>

     <!-- <td class="actions"> -->
                                <td>


    <?php echo $this->Html->link(__(''), array('action' => 'edit', $category['Category']['id']), array('class' => 'delete-transaction glyphicon glyphicon-pencil', 'title' => 'Edit')); ?><?php echo $this->Form->postLink('', array('action' => 'delete', $category['Category']['id']), array('class' => 'delete-transaction glyphicon glyphicon-trash', 'title' => 'Delete'), array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']))); ?>  
                                </td>
                            </tr>
                <?php endforeach; ?>
                    </table>
                </div>
                <?php if (empty($categories)) { ?>
                    <p> No Category</p>
<?php
} else {
    ?>
                    <div class="page" style=" position: relative;
                         bottom: -5px; width: 100%;">
                        <div class="paging">
    <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP', 'style' => 'margin-left: 22px;'));
    ?>
                             <!-- <img src="../MoneyLover/webroot/img/select.png"> -->
                            <span style="    float: left;
                                  margin-left: 9px;
                                  width: 50%;">

                                <input type="checkbox" name="checkAll" value="checkAll" style="float: left"  id="checkAll">
                                <label style="width:20%; float: left; font-size: 17px; padding-top: 4px;font-weight: normal;" for="checkAll">Select All</label>
                                <span style="float: left;
                                      width: 20%;
                                      text-align: center;
                                      position: relative;
                                      top: 3px;
                                      font-size: 17px;"> <i> With selected: </i></span>

      <!-- <span  id="EditAll"  class="glyphicon glyphicon-pencil" title="Edit">   --> 
                            </span> 

                            <span style="    right: 31%;
                                  top: 7px;" id="deleteAll"  class="glyphicon glyphicon-trash" title="Delete">  
                            </span> 
                            <?php
                            $counts = 0;
                            foreach ($categories as $category):
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



                <div id="add-category" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="    margin-bottom: 15px !important; padding-top: 15px;">Add Category</h3>
                        </div>
                        <div class="panel-body" style="color: black;">
<?php echo $this->Form->create('Category', array('action' => 'add')); ?>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="CategoryName" style="    padding-right: 0;">Category Name:</label>
                                <div class="col-sm-8">
                                    <input name="data[Category][name]" maxlength="100" type="text" id="CategoryName" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="control-label col-sm-4" style="    margin-top: 17px;text-align: right;    padding-right: 0;">Type:</label>
                                <div class="col-sm-8" style="text-align: left;">
                                    <label class="radio-inline"><input type="radio" name="data[Category][type]" value="1" id="CategoryType" style="    position: relative;
                                                                       top: 11px;
                                                                       margin-right: 8px;
                                                                       ">Income</label>
                                    <label class="radio-inline"><input type="radio"  name="data[Category][type]" value="0" id="CategoryType" style="    position: relative;
                                                                       top: 11px;
                                                                       margin-right: 8px;
                                                                       ">Expense</label>

                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10 submit-wallet" style = "margin-top: 16px;
                                     width: 100%;
                                     margin-left: -10px">
                                    <a href="#close" type="submit" class="btn wallet-save " style="float: left;
                                       margin-right: -13px;color: white; ">Cancel</a>
                                    <button type="submit" class="btn wallet-save" style="float: right;
                                            margin-right: -13px;
                                            ">Add</button>
                                </div>
                            </div>
<?php $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <!-- /#add-category -->

                <div id="delete-transaction" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-body" style="color: black; border-top: 1px solid #841717;">

                            <p>Are you want to delete?</p>
                            <div class="submit-wallet">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array('class' => 'btn wallet-save')); ?>

                                <a href="#show-a-transaction" class="btn wallet-cancel">Cancel</a>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /#delete-transaction -->

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
        $("input:checkbox[name='category_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length >= 1) {
            console.log(ids);
            deleteAll("categories/deleteAll", ids);
        } else {
            return false;
        }


    });
</script>