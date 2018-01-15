<?php
$Permission = json_decode($this->Session->read('PerMissioUser'));
if($this->Session->read('UserAuth.User.id')!=""): ?>
<div class="sidebar-menu"> 
	<!-- <div class="nav_welcome">
		<h1><?php echo __('Main'); ?></h1>
		<div class="clearfix"></div>
	</div> -->
	<?php 
	if($this->params['controller']=="cars" && $this->params['action'] == "admin_index"){
		$active= "active";
		
		}
		 else {
			$active= "";
		}?>
	<div class="nav-collapse sidebar-nav"> 
		<nav>
			<ul class="nav nav-tabs nav-stacked main-menu">
            	<?php
				if(in_array(1, $Permission))
				{
				?>
				<li class="<?php echo $active;?>"><a class="ajax-link " href="<?php echo $this->Html->url('/',true);?>admin/cars"><i class="fa fa-automobile sidebar_ico_margin"></i><span class="hidden-tablet">Vehicle Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(2, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true);?>admin/countries/add"><i class="fa fa-flag  sidebar_ico_margin"></i><span class="hidden-tablet">Country Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(3, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true);?>admin/auctions/add"><i class="fa fa-gavel  sidebar_ico_margin"></i><span class="hidden-tablet">Auction Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(4, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true)?>admin/users/allUsers"><i class="fa fa-users  sidebar_ico_margin"></i><span class="hidden-tablet">Client Management</span></a></li>
				<?php
				}
				?>
                
                <?php
				if(in_array(5, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true)?>admin/brands/add_brand"><i class="fa fa-money  sidebar_ico_margin"></i><span class="hidden-tablet">Brand Management</span></a></li>
				<?php
				}
				?>
                
                <?php
				if(in_array(6, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/ports/',true); ?>"><i class="fa fa-cogs  sidebar_ico_margin"></i><span class="hidden-tablet">Port Management</span></a></li>  
				<?php
				}
				?>
                
                <?php
				if(in_array(7, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/transports/add_transport',true); ?>"><i class="fa fa-truck  sidebar_ico_margin"></i><span class="hidden-tablet">Transport Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(8, $Permission))
				{
				?>
				<li class="shiping-icon"><a class="ajax-link" href="<?php echo $this->Html->url('/admin/shippings/add_shipping',true); ?>"><span class="hidden-tablet">Shipping Management</span></a></li>  
				<?php
				}
				?>
                
                <?php
				if(in_array(9, $Permission))
				{
				?>
				<li class="car-icon"><a class="ajax-link" href="<?php echo $this->Html->url('/admin/CarNames/add_carname',true); ?>"><span class="hidden-tablet">Vehicle Name Management</span></a></li>  
				<?php
				}
				?>
                
                <?php
				if(in_array(10, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/invoices/list"><i class="fa fa-file  sidebar_ico_margin"></i><span class="hidden-tablet">Invoice Management</span></a></li>
				<?php
				}
				?>
                
                <?php
				if(in_array(11, $Permission))
				{
				?>
				<li>
				<a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/reports"><i class="fa fa-list-alt  sidebar_ico_margin"></i><span class="hidden-tablet">Report Management</span></a>
				</li> 
				<?php
				}
				?>
                
                <?php
				if(in_array(12, $Permission))
				{
				?>
                <li>
                <a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/reports/report_login"><i class="fa fa-money  sidebar_ico_margin"></i><span class="hidden-tablet">Sale Report</span></a>
				</li>
                <?php
				}
				?>
                
                <?php
				if(in_array(13, $Permission))
				{
				?>
				<li>
				<a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/Shipschedules"><i class="fa fa-clock-o sidebar_ico_margin"></i><span class="hidden-tablet">Ship Schedules Management</span></a>
				</li> 
                <?php
				}
				?>
                
                <?php
				if(in_array(14, $Permission))
				{
				?>    
				<li>
				<a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/Banks"><i class="fa fa-bank sidebar_ico_margin"></i><span class="hidden-tablet">Bank Management</span></a>
				</li>
                <?php
				}
				?>
                
                <?php
				if(in_array(15, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/staffs',true); ?>"><i class="fa fa-user  sidebar_ico_margin"></i><span class="hidden-tablet">User Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(16, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/Cars/change_tax_value"><i class="fa fa-list-alt  sidebar_ico_margin"></i><span class="hidden-tablet">Miscellaneous</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(17, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/cars/hidden_car"><i class="fa fa-picture-o  sidebar_ico_margin"></i><span class="hidden-tablet">Hidden Vehicle </span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(18, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>admin/HomePageManagements"><i class="fa fa-picture-o  sidebar_ico_margin"></i><span class="hidden-tablet">Home PageSlider</span></a></li>
				<?php
				}
				?>
                
                <?php
				if(in_array(19, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>pages/aboutus_list"><i class="fa fa-picture-o  sidebar_ico_margin"></i><span class="hidden-tablet">About us </span></a></li>
				<?php
				}
				?>
                
                <?php
				if(in_array(20, $Permission))
				{
				?>
				<li><a class="ajax-link" href="<?php echo $this->Html->url('/',true); ?>pages/page_list"><i class="fa fa-picture-o  sidebar_ico_margin"></i><span class="hidden-tablet">Page Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(21, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/cif',true); ?>"><i class="fa fa-picture-o  sidebar_ico_margin"></i><span class="hidden-tablet">Cif Price Query</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(22, $Permission))
				{
				?><li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/purchases',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Purchase Management</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(23, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/domestics',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Domestic On</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(24, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/overseas_sales',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Overseas Sale</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(25, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/recoveries',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Recovery</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(26, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/repair_parts',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Repair Parts</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(27, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/land_transports',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Land Trans | Carry In-Out</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(28, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/ship_departures',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Inspection Ship & Depart</span></a></li>
                <?php
				}
				?>
                
                <?php
				if(in_array(29, $Permission))
				{
				?>
                <li><a class="ajax-link" href="<?php echo $this->Html->url('/admin/information',true); ?>"><i class="fa fa-list sidebar_ico_margin"></i><span class="hidden-tablet">Op. Concery Information</span></a></li>
                <?php
				}
				?>
			</ul>
		</nav>
	</div><!--/.well -->
</div><!--/span-->
<?php endif; ?>
