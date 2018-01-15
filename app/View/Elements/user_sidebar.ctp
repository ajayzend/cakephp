<?php //if($this->Session->read('UserAuth.User.id')!=""): ?>
<div class="sidebar-menu"> 
	<div class="nav_welcome">
		<h1><?php echo __('Main'); ?></h1>
		<div class="clearfix"></div>
	</div>
	<div class="nav-collapse sidebar-nav"> 
		<nav>
			<ul class="nav nav-tabs nav-stacked main-menu">
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true);?>home/dashboard"><i class="fa fa-truck"></i><span class="hidden-tablet"> User Management</span></a></li>
			</ul>
		</nav>
	</div><!--/.well -->
</div><!--/span-->
<?php //endif; ?>
