<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-translate-customization" content="2208ec156e4f2452-bac77c56421353f7-g4352fe1138ad94ca-2f"/>
<meta name="viewport" content="width=device-width initial-scale=1"/>
<title>UK Cars</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<?php echo $this->Html->css('style');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/fd559f05b5.js"></script>
<script> 
	function login(myform,e){
		var keycode;
		if (window.event) keycode = window.event.keyCode;
		else if (e) keycode = e.which;
		else return true;

		if (keycode == 13)
		   {
			var pass = $("#exampleInputPassword1").val();
			var email = $("#exampleInputEmail1").val()
			if(email == undefined || pass == undefined){
			$("#loginErrorDiv").html("User Name or Password is incorrect");
				$("#loginErrorDiv").show();
				alert('error');
			}else{
				
				
				$.ajax({
				url:"<?php echo $this->Html->url('/login',true);?>",
				type:"POST",
				data:{data:{User:{'ajaxCall':'true','email':email,'password':pass}}},
				dataType:"JSON",
				success:function(result)
				{
					if(result.status == 'success'){
						window.location = '<?php echo $this->Html->url('/',true);?>'+result.redirect;
						}else{
				
					$("#loginErrorDiv").html(result.message);
					$("#loginErrorDiv").show();
					
					
				}
					
				}
			});
				
			}
		   return false;
		   }
		else
		   return true; 
	}
	
	
	
	
	function loginW(){
		var pass = $("#exampleInputPassword1").val();
		var email = $("#exampleInputEmail1").val() 
		 if(email == undefined || pass == undefined){
			$("#loginErrorDiv").html("User Name or Password is incorrect");
				$("#loginErrorDiv").show();
			//	alert('error');
		}else{
				
				
				$.ajax({
				url:"<?php echo $this->Html->url('/login',true);?>",
				type:"POST",
				data:{data:{User:{'ajaxCall':'true','username':email,'password':pass}}},
				dataType:"JSON",
				success:function(result)
				{
					if(result.status == 'success'){
						window.location = '<?php echo $this->Html->url('/',true);?>'+result.redirect;
						}else{
				
					$("#loginErrorDiv").html(result.message);
					$("#loginErrorDiv").show();
					
					
				}
					
				}
			});
				
			}
		
		}

function changeLanguageText() {
	
/* if ($('.goog-te-menu-value span:first-child').text() == "Select Language") {    
$('.goog-te-menu-value span:first-child').html('Language');

$('#google_translate_element').fadeIn('slow');
} else {
setTimeout(changeLanguageText, 50);
}*/
}


$(document).ready(function()
{
//var curClass = $(".goog-te-combo").val();
//if(curClass)
//$("body").attr('class',curClass); 

$(".goog-te-combo").on('change',function()
{	 

	$("body").attr('class',$(this).val()); 
});

});

</script>
	
</head>

<body>
	
<!--header-->
<header>
<div class="top_header">
	<div class="pull-xs-left headerPhoneNo"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; 8130144978</div>
    
    <div class="pull-xs-right">
    	<div class="pull-xs-left HeaderTopLink"> <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; How to Buy</a></div>
        <div class="pull-xs-left HeaderTopLink"> <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Contact Us</a></div>
        <div class="pull-xs-left HeaderTopLink"> <a href=""><i class="fa fa-heart" aria-hidden="true"></i> &nbsp; Wishlist</a></div>
        <div class="pull-xs-left HeaderTopLink"> <a href=""><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp; Login</a></div>
        <div class="pull-xs-left HeaderTopLink HeatToplastNav"> <a href=""><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Register</a></div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="HeaderDiv">
	<div class="col-lg-3 logoHeaderDiv"><a href="<?php echo $this->Html->url('/',true); ?>"><img class="img-fluid" src="http://ukcarstokyo.com/images/w-logo_3.png"></a></div>
    <div class="col-lg-6">
    	<div class="col-lg-8 HeaderSearchBox paddingRight0PX"><input type="search" class="form-control searchTopbox" placeholder="Search"></div>
        <div class="col-lg-3 HeaderSearchBox">
        	<select class="form-control searchTopbox">
            	<option>All Category</option>
            </select>
        </div>
        <div class="col-lg-1 searchHeaderIcon"><i class="fa fa-search" aria-hidden="true"></i></div>
    </div>
    <div class="pull-right HeaderCurrencyDiv">
    <span style="font-family: 'Conv_MyriadPro-BoldCond';"><i class="fa fa-jpy" aria-hidden="true"></i> JPY</span> | USD
    </div>
    <div class="clearfix"></div>
</div>

<div class="HeaderMenuDiv">
	<div class="col-lg-3">
    	<div class="SearchCatDiv">
            <div class="col-lg-2"><i class="fa fa-bookmark" aria-hidden="true"></i></div>
            <div class="col-lg-8 SearchByCatText">Search By Category</div>
            <div class="col-lg-1"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="col-lg-9 paddingRight0PX">
    	<div class="HeaderTabMainDiv">
        	<div class="pull-left HeaderTabs"><i class="fa fa-gavel" aria-hidden="true" style="color:#13a3ff"></i> &nbsp; Auction</div>
            <div class="pull-left HeaderTabs"><i class="fa fa-list-ul" aria-hidden="true" style="color:#d2a380"></i> &nbsp; Stock List</div>
            <div class="pull-left HeaderTabs"><i class="fa fa-shopping-bag" aria-hidden="true" style="color:#a4d280"></i> &nbsp; Place an Order</div>
            <div class="pull-left HeaderTabs"><i class="fa fa-cog" aria-hidden="true" style="color:#9380d2"></i> &nbsp; Services</div>
            
            <div class="pull-right TopBarProfileDetail">
            	<i class="fa fa-user-circle-o" aria-hidden="true" style="color:#55b640"></i> &nbsp;&nbsp;
                Hi <span style="color:#55b640">Sandeep</span> &nbsp; &nbsp; 
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="container">
	<div class="row">
	
	<style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
			<style type="text/css">body {position: static !important; top:0px !important;}</style>

			<div id="artitleTranslate"></div><!-- Google Translate Div -->

			<!-- Custom Language dropdown -->
			<select id="customTranslate" class='pull-right' >
				<option value="English" class="eng">English</option>            
				<option value="German" class="ger">German</option>
				<option value="Japanese" class="jap">Japanese</option>
				<option value="Russian" class="rus">Russian</option>
				<option value="Spanish" class="spa">Spanish</option>
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
	</div>
	</div>
<div class="inner_header">
	
</header>
 
<!--header stop-->
<div   class="main-content" >
<?php echo $this->fetch('content'); ?>
</div>

<!--  Footer Starts from here   -->
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
</body>
</html>
