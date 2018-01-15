<?php if($this->Session->read('UserAuth.User.id')!=""): ?>
<div class="navbar navbar_admin">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<?php echo '<a class="brand" href="'. $this->Html->url('/').'">'.$this->Html->image('logo.png',array('alt'=>'UK Corporation Logo')).'</a>';?>
				<?//php pr($this->Session->read()); ?>
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user">&nbsp;</i>&nbsp;<span class="hidden-phone"><?php echo $this->Session->read('UserAuth.User.username'); ?></span>
					<i class="fa fa-angle-down">&nbsp;</i>
					</a>
					<ul class="dropdown-menu">
					   <!-- <li><a href="<?php //echo $this->Html->url('/',true)?>users/myprofile">My Profile</a></li>
						<li><a href="<?php //echo $this->Html->url('/',true)?>users/changePassword">Change Password</a></li>
						<li class="divider"></li> -->
						<li> <a href="<?php echo $this->Html->url("/");?>admin/logout">Logout</a></li>
					</ul>
				</div> 
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
			
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
<?php endif; ?>
