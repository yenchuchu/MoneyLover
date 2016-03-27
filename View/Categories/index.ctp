<?php echo $this->element('menu_admin'); ?>

<section id="categories" class="content-section text-center">
    <div class="categories-section">
        <div class="container"> 
                <h1 class="title"><?php echo __('Categories'); ?></h1> 
                <a href="#add-category" id="a-add-category"> Add Category</a>
             
                <!--<span id="form-search-transfer">-->
        <?php
//        echo $this->Form->create(array(
//            'type' => 'get',
//            'id' => 'search',
//            'class' => 'form-inline form-search-top'));
        ?>
        <?php
//        echo $this->Form->input('name', array(
//            'options' => $name,
//            'empty' => '--choose name --',
//            'class' => 'select-style select2-offscreen',
//            'id' => 'search-category-transaction',
//            'label' => false,
//            'div' => false,
//            'required' => false));
        ?>
        <?php
//        echo $this->Form->input('type', array(
//            'options' => array(0=>'income' , 1=>'expense'), 
//            'empty' => '--choose type --',
//            'class' => 'select-style select2-offscreen',
//            'id' => 'search-wallet-transaction',
//            'label' => false,
//            'div' => false,
//            'required' => false));
        ?>
        
<!--        <span id="search-time-transfer " style="position: relative !important;
    left: 20% !important;">
            <?php
//            echo $this->Form->dateTime('Contact.date', 'DMY', array(
//                'empty' => array(
//                    'day' => 'Day', 
//                    'month' => 'MONTH', 
//                    'year' => 'YEAR' ),
//                'required' => false ));
            ?>
        
                </span>
        <button class="btn btn-default " id="button-search" type="submit" title="search">
            <i class="fa fa-search"></i>
        </button> -->
    <?php // echo $this->Form->end(); ?> 
    <!--</span>-->
    
            <div class="panel-body">
                <div class="col-lg-12 categories-income"> 
                    <table class="table table-striped table-hover">
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
                                <td> <input type="checkbox" name="category_id[]" class="category-checkbox"  value="<?php echo h($category['Category']['id']); ?>" id="<?php echo h($category['Category']['id']); ?>"></td>
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
                    <div class="page" >
                        <div class="paging">
    <?php echo $this->Html->image('../img/select.png', array('alt' => 'CakePHP', 'style' => 'margin-left: 22px;'));
    ?> 
                            <span id="span-check-all"> 
                                <input type="checkbox" name="checkAll" value="checkAll" id="checkAll">
                                <label for="checkAll">Select All</label>
                                <span> <i> With selected: </i></span> 
                            </span> 

                            <span id="deleteAll"  class="glyphicon glyphicon-trash" title="Delete">  
                            </span> 
                            <?php
                            $counts = 0;
                            foreach ($categories as $category):
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
                <div id="add-category" class="modalDialog">      
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" >Add Category</h3>
                        </div>
                        <div class="panel-body" style="color: black;">
<?php echo $this->Form->create('Category', array('action' => 'add')); ?>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="CategoryName" id="lable-name-category">Category Name:</label>
                                <div class="col-sm-8">
                                    <input name="data[Category][name]" maxlength="100" type="text" id="CategoryName" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="control-label col-sm-4" id="lable-type-category">Type:</label>
                                <div class="col-sm-8" style="text-align: left;">
                                    <label class="radio-inline">
                                        <input type="radio" name="data[Category][type]" value="1" id="CategoryType" >Income</label>
                                    <label class="radio-inline"><input type="radio"  name="data[Category][type]" value="0" id="CategoryType" >Expense</label>

                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="col-sm-10 submit-wallet submit-add-category">
                                    <a href="#close" type="submit" class="btn add-category-cancel " >Cancel</a>
                                    <button type="submit" class="btn add-category-save" >Add</button>
                                </div>
                            </div>
<?php $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <!-- /#add-category -->
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