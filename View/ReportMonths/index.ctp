<?php echo $this->element('menu_user'); ?> 
<!-- tim kiem theo nam, thang... -->
<!-- Contact Section -->

<section id="report-month" class="content-section text-center">
    <span>
        <h1 id="title-report">Report Month</h1>  
    </span>
    <!--<span id="form-search">-->
        <?php
        echo $this->Form->create(array(
            'type' => 'get',
            'id' => 'search',
            'class' => 'form-inline form-search-top'));
        ?>
        <form action="/MoneyLover/ReportMonths"  class="form-inline form-search-top" method="get" accept-charset="utf-8">
     <?php
        echo $this->Form->input('year_start', array(
            'label' => false,
            'type' => 'number',
            'placeholder' => 'enter year',
            'id' => 'search-year-reportmonth',
            'required' => false
        ));
        ?>
        <button class="btn btn-default " id="button-search" type="submit" title="search">
            <i class="fa fa-search"></i>
        </button>  
    <?php // echo $this->Form->end(); ?> 
        </form>
    <!--</span>-->
    
    <div class="row" >
        <div class="col-lg-10 col-lg-offset-1 row-10-report">
        <?php if(empty($months)){
            echo "<p>You need create wallet and add transaction!</p>";
            } else {?>
<?php foreach ($months as $key => $month) { ?>
                <div class="panel-heading" >
                    <i class="fa fa-bar-chart-o fa-fw" ></i> 
                    <span class="title-month" >
    <?php echo h($month); ?>
                    </span> 
                </div>
                <div class="panel-body"  >
                    <div class="type" >
                        <h3>Incom-Expense</h3>
                        <canvas id="<?php echo h($month); ?>" width="600" height="400" ></canvas> 
                    </div>
                    <div class="type-category">
                        <h3>categories</h3>
                        <canvas id="<?php echo h($month) . "-cate"; ?>" width="600" height="400" ></canvas>
                    </div>
                </div>
    <?php } }?>
            <!-- /.panel-body -->
        </div>
    </div>
</section>

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
 
