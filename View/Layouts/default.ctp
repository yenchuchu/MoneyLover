<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		MoneyLover
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('grayscale');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css ('/font-awesome/css/font-awesome');
                echo $this->Html->css('dashboard');
                echo $this->Html->css('mystyle'); 
                echo $this->Html->css('jAlert-v3'); 
		// echo $this->Html->css('grayscale');
		
		echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery.easing.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('common');
		echo $this->Html->script('grayscale');
		echo $this->Html->script('Chart.min'); 
              echo $this->Html->script('md5.min'); 
              echo $this->Html->script('md5'); 

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
     
		
            
		<?php echo $this->fetch('content'); ?>
        <div class="ja_wrap ja_wrap_black" style="position: fixed; background-color: transparent;border: none;" id="wrap-message">
            <div class="jAlert animated  ja_md fadeInUp"   style="/*margin-top: 10%;*/ display: block;" id="ja_146220171853648143">
                    <div>  
                            <div class="ja_body" id="content-message"><?php echo $this->Session->flash();  ?> </div>
                    </div>
            </div>
        </div>  
	<footer>
	    <div class="container text-center">
	        <p>Copyright &copy; Your Website 2014</p>
	    </div>
    </footer>
    
    <script>
 
        $(document).ready( function(){
          var contentMessage =  $("#content-message").text().trim();
          $("#wrap-message").hide();
          if(contentMessage.length == 0 ) {
              return false;
          } else {
              $("#wrap-message").fadeIn(1000).delay(1700).fadeOut(500) ;
          } 
        });
        
        
        </script>
        
</body>
</html>
