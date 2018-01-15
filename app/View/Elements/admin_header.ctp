<?php if($this->Session->read('UserAuth.User.id')!=""): ?>  
<div class="navbar navbar_admin">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<?php echo '<a class="brand" href="'. $this->Html->url('/').'">'.$this->Html->image('w-logo_3.png',array('alt'=>'Bizupon')).'</a>';?>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user">&nbsp;</i>&nbsp;<span class="hidden-phone"><?php echo $this->Session->read('UserAuth.User.username'); ?></span>
					<i class="fa fa-angle-down">&nbsp;</i>
					</a>
					<ul class="dropdown-menu">
						
					    <li><a href="<?php echo $this->Html->url('/',true)?>users/myprofile">My Profile</a></li>
						<li>
							<?php echo $this->Html->link('Change Password', array('controller' => 'users','action' => 'changePassword',$this->Session->read('UserAuth.User.id'))); ?>
							
							
							
							</li>
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
