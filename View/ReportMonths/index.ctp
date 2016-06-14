<?php echo $this->Flash->render('positive') ?>

<?php echo $this->element('menu_user'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main-wallet">

    <h1 class="page-header"> 
        <?php echo $this->Html->link(__('Report Month'), array('controller' => 'ReportMonths', 'action' => 'index')); ?>  </h1>
           <?php
        echo $this->Form->create('ReportMonths', array(
            'type' => 'get', 
            'class' => 'form-inline form-search-top'  ));
        ?>
     <form class="navbar-form navbar-right">
            <input type="text" class="form-control" name="year_start"
                   placeholder="Search..." value ="<?php $this->request->query('year_start'); ?>"
                   style=" 
    position: relative;    border-top-right-radius: 0;
    border-bottom-right-radius: 0;">
          </form> 
    <button class="btn btn-default " id="button-search-report" type="submit" title="search">
            <i class="fa fa-search"></i>
        </button>  
    <?php echo $this->Form->end(); ?> 
    
    <div class="row" > 
        <?php if(empty($months)){
            echo "<p style= 'color: red; text-align: center; margin-top: 5%;'>No report!</p> ";
            }  else {?>
         
<?php foreach ($months as $key => $month) { ?>
        <div class="col-lg-10 col-lg-offset-1 row-10-report" >
                <div class="panel-heading" >
                    <i class="fa fa-bar-chart-o" ></i> 
                    <span class="title-month" >
    <?php echo h($month); ?>
                    </span> 
                </div>
        
                <div class="panel-body body-report-month"  >
                    <div class="col-md-6" style="text-align: center;" >
                        <h3>Incom-Expense</h3>
                        <canvas id="<?php echo h($month); ?>" width="400" height="266.666" 
                                style="margin-left: 14%;    margin-top: 11px;"></canvas> 
                    </div> 
                    <div class="col-md-6" style="text-align: center;">
                        <h3>categories</h3>
                        <canvas id="<?php echo h($month) . "-cate"; ?>" width="400" height="266.666"  
                                style="margin-left:14%;    margin-top: 11px;"></canvas>
                    </div>
                </div>
            </div>
    <?php } }?>
            <!-- /.panel-body -->
        
    </div>
</div>
  
<script type="text/javascript">
    // pie chart data




    var pieDataCategories = <?php echo json_encode($pieDataCategories) ?>;
    var pieData = <?php echo json_encode($pieData); ?>;
    var months = <?php echo json_encode($months); ?>
    // pie chart options
    var pieOptions = {
        segmentShowStroke: false,
        animateScale: true
    }
    var i;
    var countries = new Array();
    var categories = new Array();
    // get pie chart canvas
    for (i = 0; i < months.length; i++) {
        // alert(months[i]+"-cate");
        countries[i] = document.getElementById(months[i]).getContext("2d");

        categories[i] = document.getElementById(months[i] + "-cate").getContext("2d");
    }
    // console.log(categories);
    // var categories = document.getElementById("chart-categories").getContext("2d");
    // var aaaa= document.getElementById("aaaa").getContext("2d");

    // draw pie chart

    for (i = 0; i < months.length; i++) {
        var month = months[i];
        new Chart(countries[i]).Pie(pieData[month], pieOptions);
        new Chart(categories[i]).Pie(pieDataCategories[month], pieOptions);
    }


    // new Chart(categories).Pie(pieDataCategories, pieOptions);
    // new Chart(aaaa).Pie(pieData, pieOptions);
</script>
 
