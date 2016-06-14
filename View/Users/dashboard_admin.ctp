<?php echo $this->element('menu_admin'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          	
          		<h1 class="page-header"><?php echo $this->Html->link(__('Dashboard '), array(
                                                                            'controller' => 'Users', 
                                                                            'action' => 'dashboard_admin')); ?></h1>
              <div class="row placeholders" style="margin: auto 8%;">
                <div class="col-xs-6 col-sm-3 placeholder polaroid" >
                  <?php echo $this->Html->image('/img/admin.png', array(
                            'alt' => 'Generic placeholder thumbnail', 
                            'class' => 'img-responsive',
                            'width' => '100', 
                            'height' => '100')); ?>
                    <h4><?php echo $admin;?></h4>
                  <span class="text-muted">Admin</span>
                  
                </div>
                <div class="col-xs-6 col-sm-3 placeholder polaroid">
                    <?php echo $this->Html->image('/img/user.png', array(
                            'alt' => 'Generic placeholder thumbnail', 
                            'class' => 'img-responsive',
                            'width' => '100', 
                            'height' => '100')); ?>
                    <h4><?php echo $userActive;?><span style="font-size: 12px"> Actived</span> | <?php echo $userRequest;?><span style="font-size: 12px"> Request</span></h4>
                  <span class="text-muted">Users</span>
                </div>
                <div class="col-xs-6 col-sm-3 placeholder polaroid">
                  <?php echo $this->Html->image('/img/Category.png', array(
                            'alt' => 'Generic placeholder thumbnail', 
                            'class' => 'img-responsive',
                            'width' => '100', 
                            'height' => '100')); ?>
                    <h4><?php echo $categories; ?></h4>
                  <span class="text-muted">Categories</span>
                </div>
               
              </div>
                
        
		 
        </div>

    </div>
    <script >
      $(".polaroid").hover(function(){
        $("polaroid").show();
      },function(){
        $("polaroid").hide();
      });

    </script>