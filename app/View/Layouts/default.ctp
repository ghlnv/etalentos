<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?> :
		<?php echo 'eTalentos' ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		// CSS
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('jquery-ui.structure.min');
		echo $this->Html->css('jquery-ui.theme.min');
		
		// Bootstrap
		echo $this->Html->css('/vendor/bootstrap-3.3.5/css/bootstrap.min');
		echo $this->Html->css('/vendor/bootstrap-3.3.5/css/bootstrap-theme.min');
		echo $this->Html->css('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
		echo $this->Html->script('/vendor/bootstrap-3.3.5/js/bootstrap.min.js');
		
		// Custom CSS
		echo $this->Html->css('layout');
		echo $this->Html->css('system');
		echo $this->Html->css('menu');
		echo $this->Html->css('print');
		echo $this->Html->css('responsive');
		
		// Javascript
		echo $this->Html->script('jquery-2.1.4.min');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('jquery.mask');
		echo $this->Html->script('custom-default');
		echo $this->Html->script('custom-ajax');
		echo $this->Html->script('custom-dialogs');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<header class="container">
	<!-- Static navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>">eTalentos</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<?php
					echo $this->element('menu');
					echo $this->element('sessionUser');
				?>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	</header>
	<div id="content">
		<?php
			echo $this->Session->flash();
			echo $this->fetch('content');
		?>
	</div>
	<footer>
	<div class="centralizarComTamanhoMaximo">
	<span>© <?php echo date("Y"); ?> <strong>etalentos.com.br</strong>. Todos os direitos reservados.</span>
	</div>
	</footer>
	<?php
		echo $this->element('sql_dump');
		echo $this->Js->writeBuffer();
	?>	
</body>
</html>
