<?php echo $this->element('menu_admin'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="category">

    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('Category'), array('controller' => 'Categories', 'action' => 'index')); ?>
        <a id="add-button" class="btn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
    </h1>
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
            <div class="input-group" id="input-group-search-type">
                <!--<div class="input-group-btn search-panel">-->
                <?php
                echo $this->Form->create(array(
                    'type' => 'get',
                    'id' => 'search',
                    'class' => 'form-inline form-search-top',
                    'style'=>'    top: 138px;' 
                    ));
                ?> 
                <?php
                echo $this->Form->input('type', array(
                    'options' => array('income' => 'income', 'expense' => 'expense'),
                    'value' => $this->request->query('type'),
                    'empty' => '--type --',
                    'class' => 'select-style select2-offscreen',
                    'id' => 'search-type-category',
                    'label' => false, 
                    'div' => false,
                    'required' => false  
                    ));
                ?> 
                <input type="text" class="form-control" id="query-category-name" name="name" 
                       placeholder="Enter Category"  value = <?php echo $this->request->query('name'); ?> >



                <span class="input-group-btn" style="float: right; left: 86%;bottom: 68px;">
                    <button class="btn button-search-category" id="button" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                <?php echo $this->Form->end(); ?>
                <!--</div>-->


            </div>
        </div>
    </div>
     
    <br><br>
    <div class="row" style="position: relative; top: -53px;">
        <div class="col-xs-10 col-xs-offset-1 offset-table-right">
            <table class="table table-striped">
                <tr> 
                    <th></th>
                    <th><?php echo $this->Paginator->sort('Id'); ?></th>
                    <th><?php echo $this->Paginator->sort('Name'); ?></th>
                    <th><?php echo $this->Paginator->sort('Type'); ?></th>
                    <th><?php echo $this->Paginator->sort('Created'); ?></th>
                    <th><?php echo $this->Paginator->sort('Modified'); ?></th>
                    <th class="actions"><?php echo $this->Paginator->sort('Actions'); ?></th> 
                <span class="mesage">
                </tr>
                    <?php foreach ($categories as $category): ?> 
                        <tr class="tr-category">
                            <td> <input type="checkbox" name="category_id[]" class="category-checkbox"  value="<?php echo h($category['Category']['id']); ?>" id="<?php echo h($category['Category']['id']); ?>"></td>
                            <td class="tr-category-id"><?php echo h($category['Category']['id']); ?>&nbsp;</td>
                            <td class="tr-category-name"><?php echo h($category['Category']['name']); ?>&nbsp;</td> 
                            <td class="tr-category-type"><?php
                                if ($category['Category']['type'] == 1):
                                    echo "Expense";
                                else :
                                    echo "Income";
                                endif;
                                ?></td>
                            <td><?php echo $this->Time->format($category['Category']['created'], '%B %e, %Y '); ?> </td>
                            <td><?php echo $this->Time->format($category['Category']['modified'], '%B %e, %Y '); ?> </td>             
                            <td class="actions">
                                <a style="float:none;color:#27c24c" class="update-link" 
                                   id="update-link" data-toggle="modal" data-target="#editModal" title="Edit">
                                    <i class="fa fa-pencil-square-o"></i> </a>

                                <a href="#" id="delete-link" name="<?php echo h($category['Category']['id']); ?> " 
                                   data-toggle="modal" data-target="#deleteModal" 
                                   class="delete-transaction glyphicon glyphicon-trash" title="Delete" 
                                   onclick="deleteSigle(this.name)"></a>                
                            </td>   
                        </tr>
                    <?php endforeach; ?>
               
            </table>
            <!-- phan trang -->

            <?php if (empty($categories)) { ?>
                <p style="    text-align: center;"> No Category</p>
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
                            <span style="    margin-right: 29px;"> <i> With selected: </i></span> 
                        </span> 

                        <span id="deleteAll"  class="glyphicon glyphicon-trash" title="Delete">  
                        </span> 
                        <?php
                        if ($countCategories < 20) {
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
            <!-- Add Modal -->

            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!--Modal Header--> 
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="myModalLabel">
                                Add a category
                            </h4>
                        </div>

                        <!--Modal Body--> 
                        <?php echo $this->Form->create('Category', array('action' => 'add')); ?> 
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="col-sm-4 control-label"
                                        for="inputEmail3">Category Name</label>
                                <div class="col-sm-12" style="margin-bottom: 17px;">
                                    <?php
                                    echo $this->Form->input('name', array('class' => 'form-control',
                                        'label' => false, 'placeholder' => 'Enter a name', 'id' => 'add-name-category'));
                                    ?>

                                </div>
                            </div>
                            <label class="radio-inline" style="padding-left: 46px; top: 0px;">
                                <input type="radio" name="data[Category][type]" 
                                       value="1" id="CategoryTypeExpense" checked="1" 
                                       style="margin-left: -22px; top: -8px;">Expense</label>
                            <label class="radio-inline">
                                <input type="radio"  name="data[Category][type]" 
                                       value="0" id="CategoryTypeIncome"  
                                       style="margin-left: -22px; top: -8px;">Income</label>
                        </div>

                        <!--Modal Footer--> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-md"   id="button">
                                Add a category
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
                            <h4 class="modal-title" id="myModalLabel">
                                Delete a transfer
                            </h4>
                        </div>

                        <!--Modal Body--> 
                        <div class="modal-body">
                            Are you sure to delete this category?
                        </div>
                        <div style="display:none;"><input type="hidden" name="_method" value="PUT"></div>
                        <form action="" id="CategoryDeleteForm" method="post" accept-charset="utf-8">

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

            <!-- Edit Modal --> 

            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo $category['Category']['id']; ?>
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
                        <form action="" id="CategoryEditForm" method="post" accept-charset="utf-8">
                            <div class="modal-body" id="before-form-edit">

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label"
                                            for="edit-name">Category Name</label>
                                    <div class="col-sm-12" style="margin-bottom: 14px;">
                                        <input type="text" class="form-control" maxlength="100" type="text"
                                               id="edit-name" placeholder="Enter a name" name="data[Category][name]" value="" required="required"/>
                                    </div>
                                </div>
                                <label class="radio-inline" style="padding-left: 46px; top: 0px;">  
                                    <input type="radio" name="data[Category][type]" 
                                           value="1" id="edit-type-income" checked
                                           style="margin-left: -22px; top: -8px;"> Expense </label>
                                <label class="radio-inline" >
                                    <input type="radio" name="data[Category][type]" 
                                           value="0" id="edit-type-expense edit-input-expense"
                                           style="margin-left: -22px; top: -8px;" > Income </label>

                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
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
<!--dungf jquery lấy dữ liệu từ table. chuyển vào modal-->
<script type="text/javascript">

   
    function deleteSigle($id) {
        $("#CategoryDeleteForm").attr("action", "/MoneyLover/Categories/delete/" + $id);
    }


    $(".update-link").click(function () {
        var name = $(this).closest('tr').find('.tr-category-name').text();
        $("#edit-name").val(name);
        var type = $(this).closest('tr').find('.tr-category-type').text();
        
        var id = $(this).closest('tr').find('.tr-category-id').text();
        $("#CategoryEditForm").attr("action", "/MoneyLover/Categories/edit/" + id + "");
    });

    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    $('#deleteAll').click(function () {
        ids = new Array();
        $("input:checkbox[name='category_id[]']:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length >= 1) {
//            console.log(ids);
            deleteAll("categories/deleteAll", ids);
        } else {
            return false;
        }
    });
    
//     $("#query-category-name").keyup(function(event) {
//         $nameForm = $(this).val();
//         $typeForm = $('#search-type-category').val();
//        searchCategory('<?php // echo Router::Url(array('controller' => 'categories', 'action' => 'search')); ?>',
//                        $nameForm, $typeForm);
//    });
//     
//    $('#search-type-category').change(function() {
//        $nameForm = $('#query-category-name').val();
//        $typeForm = $('#search-type-category').val();
//        searchCategory('<?php // echo Router::Url(array('controller' => 'categories', 'action' => 'search')); ?>',
//                $nameForm, $typeForm);
//    });

</script>


