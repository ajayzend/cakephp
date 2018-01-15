<?php
/**
 *
 * PHP 5
 *
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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'UK Corporation'); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription; ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-cerulean');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('charisma-app');
		echo $this->Html->css('jquery-ui-1.8.21.custom');
		echo $this->Html->css('chosen');
		echo $this->Html->css('uniform.default');
		echo $this->Html->css('jquery.iphone.toggle');
		echo $this->Html->css('font-awesome');

		
		echo $this->fetch('meta');
		
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.21.custom.min');
	?>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
</head>
<body>
<?php echo $this->fetch('content'); ?>		
		
<?php
	echo $this->Html->script('bootstrap-transition');
	echo $this->Html->script('bootstrap-modal');
	echo $this->Html->script('bootstrap-dropdown');
	echo $this->Html->script('bootstrap-tab');
	echo $this->Html->script('bootstrap-tooltip');
	echo $this->Html->script('bootstrap-popover');
	echo $this->Html->script('bootstrap-button');
	echo $this->Html->script('bootstrap-collapse');
	echo $this->Html->script('bootstrap-typeahead'); //Auto Complete
	echo $this->Html->script('jquery.dataTables.min'); //data table plugin
	echo $this->Html->script('jquery.chosen.min');
	echo $this->Html->script('jquery.uniform.min');
	echo $this->Html->script('jquery.iphone.toggle');
	echo $this->Html->script('charisma');
?>
</body>
</html>
