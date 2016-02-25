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
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('grayscale');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css ('/font-awesome/css/font-awesome');
		// echo $this->Html->css('grayscale');
		

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery.easing.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('common');
		echo $this->Html->script('grayscale');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<footer>
	    <div class="container text-center">
	        <p>Copyright &copy; Your Website 2014</p>
	    </div>
    </footer>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
