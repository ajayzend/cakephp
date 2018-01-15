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
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.ico">
	<?php
		echo $this->Html->meta('icon');
	
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('custom');
		//echo $this->Html->css('bootstrap-cerulean');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('charisma-app');
		echo $this->Html->css('jquery-ui-1.8.21.custom');
		echo $this->Html->css('chosen');
		
		echo $this->Html->css('uniform.default');
		echo $this->Html->css('jquery.iphone.toggle');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));

		
		echo $this->fetch('meta');
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('modernizr.custom');
		echo $this->Html->script('jquery.dlmenu');
		echo $this->Html->script('jquery.bxslider');
		echo $this->Html->script('jquery-ui-1.8.21.custom.min');
		echo $this->Html->script('jquery-form');
		
	?>
	<!--    div for model popup-->
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script>
	
$(document).ready(function(){
	var curClass = $(".goog-te-combo").val();
	if(curClass)
	$("body").attr('class',curClass); 
	
	$(".goog-te-combo").on('change',function()
	{	 
 
		$("body").attr('class',$(this).val()); 
	});

});
</script>
	
	</head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	</div>
<?php //echo $this->element('user_header'); //header ?>

			
	
<header>
<div class="top_header">
	<div class="container">
		<!-- Start google translator -->
		<style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
			<style type="text/css">body {position: static !important; top:0px !important;}</style>
			<div id="artitleTranslate"> </div><!-- Google Translate Div -->

			<!-- Custom Language dropdown -->
			<select id="customTranslate" class='pull-right'>
				<option value="English">English</option>            
				<option value="German">German</option>
				<option value="Japanese">Japanese</option>
				<option value="Russian">Russian</option>
				<option value="Spanish">Spanish</option>
			</select>

		<!-- Styles -->
			<style type="text/css">
			#artitleTranslate, #customTranslate, .goog-te-banner-frame {
			 display: none;
			}
			</style>
		<!-- Styles -->
			<script type="text/javascript">
				function googleTranslateElementInit() {
					new google.translate.TranslateElement(
						{
							pageLanguage: 'en', 
							includedLanguages: 'de,es,ja,ru,en',
							layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
							autoDisplay: false
						},
						'artitleTranslate'
					);

					googObj.translator.init();
				}
		</script>
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<!-- End google translator --> 
		<script>  
		
		var googObj = googObj || {};

			(function($) {
			  googObj.translator = {
				  langCode: {
					  'en': 'English',
					  'de': 'German',
					  'ja': 'Japanese',
					  'ru': 'Russian',
					  'es': 'Spanish'
				  },
				  
				  initDropdown: function() {
					  $('#customTranslate').change(function() {
						  $(this).blur();
						  var lang = $(this).val();
						  $("body").attr('class',$(this).val()); 						 
						  var $frame = $('iframe.goog-te-menu-frame:first');
						  if (!$frame.size()) {
							  return false;
						  }

						  $( $frame.contents().find('.goog-te-menu2-item span.text') ).each(function( index ) {
							  if ($(this).text() == lang) {
								  if (lang == 'English') {
									  googObj.translator.showOriginalText();
									  return false;
								  }
								  
								  $(this).click();

								  return false;
							  }
						  });
						  return false;
						  
					  });
				  },
				  
				  showOriginalText: function() {
					  var googBar = $('iframe.goog-te-banner-frame:first');
					  $( googBar.contents().find('.goog-te-button button') ).each(function( index ) {
						  if ( $(this).text() == 'Show original' ) {
							  $(this).trigger('click');

							  if ($('#customTranslate').val() != 'English') {
								  $('#customTranslate').val('English');
							  }
							  return false;
						  }
					  });
				  },
				  
				  setLangDropdown: function() {
					  var cookieVal = this.getCookieValue();
					  if (cookieVal) {
						  $('#customTranslate').val( this.langCode[cookieVal] );
					  }
				  },
				  
				  getCookieValue: function() {
					  var transCookie = getCookie('googtrans');
					  if ( transCookie ) {
						  transCookie = transCookie.split('/');
						  transCookie = transCookie[2];
						  return transCookie;
					  }
					  
					  return false;
				  },
				  
				  init: function() {
					  if (document.getElementById('customTranslate')) {
						  $('#customTranslate').show();
						  this.initDropdown();
						  this.setLangDropdown();
					  }
				  }
			  }
			})(jQuery);

			function getCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i=0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if ( c.indexOf(nameEQ) == 0 ) {
						return c.substring(nameEQ.length,c.length);
					}
				}
				return null;
			}
		
		</script>
			<!-- End google translator --> 
			<div class="col-lg-3 col-md-3 logoarea">
        <!--<img src="<?php //echo $this->webroot;?>images/logo.png" /> -->
        <?php echo '<a class="brand" href="'. $this->Html->url('/').'">'.$this->Html->image('logo.png',array('alt'=>'UK Corporation Logo')).'</a>';?>
        </div>
			<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 header pull-right"> 
				<!--<a href="<?php //echo $this->Html->url('/',true); ?>users/register">Register</a>|-->
				<h5>Welcome <?php echo  $this->Session->read('defaultUserName'); ?> | 
				<a href="<?php echo $this->Html->url("/");?>admin/logout">Logout</a></h5>				
				<!--<a href="#" class="">Contact</a> -->
			</div>
	</div>       
</div>   
<div class="inner_header">
	<div class="container">
    	
        <!-- mini-start -->
		
		<div class="container demo-1">						
				<div class="column">
					<div id="dl-menu" class="dl-menuwrapper navbar-header">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin()){
				
							?>
							<li><a href="<?php echo $this->Html->url('/',true); ?>admin/cars">Dashboard</a></li>
								<?php } else if($this->UserAuth->isLogged()){ ?>
							<li><a href="<?php echo $this->Html->url('/',true); ?>home/dashboard">Balance Details</a></li>					
							<?php }else{ ?>					
							<?php  } ?>	
							<li><a href="<?php echo $this->Html->url('/',true); ?>">Home</a></li>	
							<li>
								<a href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">About</a>
								<ul class="dl-submenu">
									<li><a href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">Company Info</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>pages/terms_condition"> Terms &amp; Condition</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>pages/policy">Payment Policies</a></li>   				
								</ul>
							</li>
							<li>
								<a href="<?php echo $this->Html->url('/',true); ?>pages/services">Services</a>
								<ul class="dl-submenu">
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/chasis_check">Chassis Check</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/shipping_schedule">Shipping Schedule</a></li>						
								</ul>
							</li>
							<li>
								<a href="#">Stock List</a>
								<ul class="dl-submenu">
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:2/brand:9/type:1">Russia</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/allstockList">All Stock List</a></li> 					
								</ul>
							</li>
							<li>
								<a href="#">Place an Order</a>
								<ul class="dl-submenu">
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">How To Buy</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/request_car">Order a Car</a></li>
									<li><a href="<?php echo $this->Html->url('/',true); ?>home/request_part">Order a Part</a></li> 				
								</ul>
							</li>
							<li>
								<a href="<?php  echo $this->Html->url('/',true); ?>home/arrival_car_list"> Bid/Auction</a>
							</li>
							<li>
								<a href="<?php echo $this->Html->url('/',true); ?>pages/Contactus">Contact US</a>
							</li>
							
						</ul>
						
					</div><!-- /dl-menuwrapper -->
				</div>
			</div>

       <script>
			$(function() {
				$( '#dl-menu' ).dlmenu({
					animationClasses : { classin : 'dl-animate-in-4', classout : 'dl-animate-out-4' }
				});
			});
		</script>
        <!-- mini-stop -->
		<div class="row">
		<?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin())
			{
				$class = 'col-lg-10 col-md-10';
				$class1 = 'col-md-2 col-lg-2'; 
			}
			else if($this->UserAuth->isLogged())
			{
				$class = 'col-lg-10 col-md-10';
				$class1 = 'col-md-2 col-lg-2'; 
			}
			else
			{
				$class =  'col-lg-8 col-md-8';
				$class1 = 'col-md-4 col-lg-4';
			}
			 
			?>	
        <div class="navbar <?php echo $class; ?> nav_bar">
          <div class="del_menu" role="navigation">
            <ul class="nav navbar-nav  cl-effect-21"><!--  class="active" -->
			
			<?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin()){
				
				?>
				<li><a href="<?php echo $this->Html->url('/',true); ?>admin/cars">Dashboard</a></li>
				<?php } else if($this->UserAuth->isLogged()){ ?>
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/dashboard">Balance Details</a></li>
					
					<?php }else{ ?>
					
					<?php  } ?>	
				<li><a href="<?php echo $this->Html->url('/',true); ?>">Home</a></li>	
              <li class="dropdown dropdown-hover"><a  class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">About</a>
				  <ul class="dropdown-menu" role="menu"> 					
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">Company Info</a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/terms_condition"> Terms &amp; Condition</a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/policy">Payment Policies</a></li>   
				  </ul>
			  </li>
             <li class="dropdown dropdown-hover"><a href="<?php echo $this->Html->url('/',true); ?>pages/services"   class="dropdown-toggle" data-toggle="dropdown">Services</a>
				<ul class="dropdown-menu" role="menu">					
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/chasis_check">Chassis Check</a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/shipping_schedule">Shipping Schedule</a></li>
				  </ul>
			 </li>
			    <!--li><a href="<?php echo $this->Html->url('/',true); ?>pages/payment">Payment</a></li>-->   

				
                 <li class="dropdown dropdown-hover"><a class="dropdown-toggle" data-toggle="dropdown">Stock List</a>
					<ul class="dropdown-menu animated bounceInUp " role="menu">					
						<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:2/brand:9/type:1">Russia</a></li>
						<li><a href="<?php echo $this->Html->url('/',true); ?>home/allstockList">All Stock List</a></li> 
						<!--<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:3/type:1">Chille</a></li>
						<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:16/type:1">U.A.E</a></li>   
						<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:1/type:1">Japan</a></li>   
						<li><a href="<?php echo $this->Html->url('/',true); ?>home/stocklist/country:17/type:1">Germany</a></li>-->   
					</ul>
				 </li>
				  <li class="dropdown dropdown-hover"><a  class="dropdown-toggle" data-toggle="dropdown" href="#">Place an Order</a>
				  <ul class="dropdown-menu" role="menu">					
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">How To Buy</a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/request_car">Order a Car</a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>home/request_part">Order a Part</a></li> 
				  </ul>
			  </li>
			  <li><a href="<?php  echo $this->Html->url('/',true); ?>home/arrival_car_list"> Bid/Auction</a></li>
			 <!-- <li><a href="<?php // echo $this->Html->url('/',true); ?>home/arrival_car_brand"> Bid/Auction</a></li> 
              <li><a href="<?php // echo $this->Html->url('/',true); ?>home/arrival_show"> Bid/Auction</a></li> -->  
				<li><a href="<?php echo $this->Html->url('/',true); ?>pages/Contactus">Contact US</a></li>	
            </ul>
		  </div><!--/.nav-collapse -->
	
        </div>
		<div class="<?php echo $class1; ?> login_menu">
		<?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin()){
				?>

				<!--<a href="<?php //echo $this->Html->url('/',true); ?>users/register">Register</a>|-->
				<a class="logout"  href="<?php echo $this->Html->url("/");?>admin/logout">Logout</a>
			<?php
				
			}else if($this->UserAuth->isLogged())
			{?>					 
				<a class="logout" href="<?php echo $this->Html->url("/");?>admin/logout">Logout</a>				

			<?php }else{
				echo $this->element('login_header_front');
				
				}
				?>
     </div>
     </div>
</div>
<!--<div class="black">
	<div class="container">
    	
        <?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin())
			{
				$class = 'col-lg-10 col-md-10';
				$class1 = 'col-md-2 col-lg-2'; 
			}
			else
			{
				$class =  'col-lg-8 col-md-8';
				$class1 = 'col-md-4 col-lg-4';
			}
			     
			?>	         
        
       <div class="navbar <?php echo $class; ?> nav_bar">
            
			
			<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="collapse navbar-collapse">
            <div class="row">			
		
		 
		  
		  </div> </div><!--/.nav-collapse 
        </div>
            
     </div>
</div>-->
</header>

  
<div  style="height:auto;min-height:100%;" ><!--  class="page-container" -->
		<?php //echo $this->element('user_sidebar'); //left menu ?>
		<?php echo $this->fetch('content'); ?>		
		<?php //echo $this->element('admin_footer'); ?>
</div><!--/.row-fluid-->
<footer>
<footer>
	<div class="container">
		<div class="col-md-9">
			<?php $this->Page = ClassRegistry::init('Page'); 
				$result = $this->Page->find('first',array('conditions'=>array('Page.title'=>'Footer')));
			  echo $result['Page']['content'];
			?>
		</div>
		<div class="col-lg-3 col-md-3">
			<div class="row">
			<h2>Find Us On</h2>
			<ul class="social">
				<li><a href="https://www.facebook.com/pages/UK-Corporation/247158068818396" class="facebook"><img src="<?php echo $this->webroot;?>images/facebook.png" alt="facebook"/></a></li>
				<li >
					<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
					<a href="javascript:void(0);" class="skype"><img src="<?php echo $this->webroot;?>images/skype.png" alt="skype"/></a>
						<div id="SkypeButton_Call_uk.corporation14_1">
						  <script type="text/javascript">
							Skype.ui({
							  "name": "dropdown",
							  "element": "SkypeButton_Call_uk.corporation14_1",
							  "participants": ["uk.corporation14"],  
							  "imageSize": 0.
							});
						  </script>
						</div>
					<!--<a href="callto:uk.corporation14" class="skype"><i class="fa fa-skype"></i></a>--></li>
				<li><a href="mailto:ukcarsjapan@gmail.com" class="vimeo"><img src="<?php echo $this->webroot;?>images/mail.png" alt="mail"/></a></li>
			</ul>
		</div>
		</div>
	</div>
	<div class="bottomfoot">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<p class="col-sm-6 pul-right">&copy; UK Cars - 2013 All right Reserved</p>
					<p class="col-sm-6 pul-left powered">Powered by <a href="http://www.webenturetech.com" target="blank" title="Webenture">Webenture</a></p>
				</div>
			</div>
		</div>
	</div>
</footer>	
<?php //echo $this->element('sql_dump'); ?>
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
	echo $this->Html->script('jquery-form');
	echo $this->Html->script(array('select2.min','cbunny'));
	echo $this->Html->script('jquery.scrollTo-min');
?>
</body>
</html>
