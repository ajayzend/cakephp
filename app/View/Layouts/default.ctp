<?php
$userid = $this->Session->read('UserAuth.User.id');
$groupid = $this->Session->read('UserAuth.User.user_group_id');

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-translate-customization" content="2208ec156e4f2452-bac77c56421353f7-g4352fe1138ad94ca-2f"/>
<meta name="viewport" content="width=device-width initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bizupon</title>
<link rel="shortcut icon" href="<?=$this->webroot?>img/favicon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<?php echo $this->Html->css('style');?>
<?php echo $this->Html->css('hover-min');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/089012ca36.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.4/bootstrap-slider.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.4/css/bootstrap-slider.min.css" crossorigin="anonymous">

<script src="<?php echo $this->webroot;?>js/bootstrap-notify.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

<script type="text/javascript">
FlagCatPanel = 0;
function ShwPanelCates(id)
{
	if(FlagCatPanel == 0)
	{
		FlagCatPanel = 1;
		$("#"+id).slideDown('fast');
	}
	else
	{
		FlagCatPanel = 0;
		$("#"+id).slideUp('fast');
	}
}
</script>
<style type="text/css">
	iframe.goog-te-banner-frame{ display: none !important;}
	#artitleTranslate, #customTranslate, .goog-te-banner-frame {display: none;}
</style>



<?php echo $this->Html->css('bootstrap-chosen');?>
<?php echo $this->Html->css('yamm');?>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</head>

<body>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58b1de5d6b2ec15bd9f07476/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!--header-->
<header>
<div class="top_header">

    <div class="pull-xs-right">
    	<div class="pull-xs-left HeaderTopLink btn-group">
        	<a data-toggle="dropdown-item" aria-haspopup="true" aria-expanded="false" href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; How to Buy</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">How To Buy</a>
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/request_car">Order a Car</a>
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/request_part">Order a Part</a>
          	</div>
        </div>
        <div class="pull-xs-left HeaderTopLink"> <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'Contactus'));?>"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Contact Us</a></div>
        <div class="pull-xs-left HeaderTopLink btn-group">
        	<a data-toggle="dropdown-item" aria-haspopup="true" aria-expanded="false" href="<?php echo $this->Html->url('/',true); ?>pages/aboutus"><i class="fa fa-book" aria-hidden="true"></i> &nbsp; About Us</a>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">Company Info</a>
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>pages/terms_condition">Terms &amp; Condition</a>
                <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>pages/policy">Payment Policies</a>
          </div>
        </div>

        <?php
		if(!$this->UserAuth->isLogged())
		{
		?>
            <div class="pull-xs-left HeaderTopLink btn-group"><a href="<?php echo $this->Html->url('/',true); ?>/login"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp; Login</a></div>
            <div class="pull-xs-left HeaderTopLink HeatToplastNav"> <a href="<?php echo $this->Html->url('/',true); ?>register"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Register</a></div>
        <?php
		}
		else
		{
		?>
            <div class="pull-xs-left HeaderTopLink HeatToplastNav"> <a href="<?php echo $this->Html->url("/");?>admin/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; Logout</a></div>
        <?php
		}
		?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="HeaderDiv">
<form action="<?php echo $this->Html->url('/',true); ?>home/allstockList">
	<div class="col-lg-3 logoHeaderDiv"><a href="<?php echo $this->Html->url('/',true); ?>"><img class="img-fluid" src="<?=$this->webroot?>images/w-logo_3.png"></a></div>
    <div class="col-lg-6">
    	<div class="col-lg-10 HeaderSearchBox">
            <input type="search" id="GlobalSearch" class="form-control searchTopbox" placeholder="Search" name="search">
        </div>
        <div class="col-lg-1 searchHeaderIcon">
            <button type="submit" style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0; border: 0 solid #ccc;"><i  class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>

</form>

    <div class="pull-right HeaderCurrencyDiv">
    	<?php
		if($this->Session->read('LANGUAGE') == "1")
		{
		?>
    		<i class="fa fa-jpy" aria-hidden="true"></i> <a href="<?php echo $this->Html->url('',true); ?>?lang=jpy"><span style="color:#55b640">JPY</span></a> | <a href="<?php echo $this->Html->url('',true); ?>?lang=usd">USD</a>
        <?php
        }
		else
		{
		?>
		$ <a href="<?php echo $this->Html->url('',true); ?>?lang=usd"><span style="color:#55b640">USD</span></a> | <a href="<?php echo $this->Html->url('',true); ?>?lang=jpy">JPY</a>
		<?php
		}
		?>
    </div>

    <div class="pull-right HeaderLanguageChanger">
    	<div id="artitleTranslate"></div>
        <select id="customTranslate" class="form-control chosen-select" style="font-size:12px;">
            <option value="English" class="eng">English</option>
            <option value="German" class="ger">German</option>
            <option value="Japanese" class="jap">Japanese</option>
            <option value="Russian" class="rus">Russian</option>
            <option value="Spanish" class="spa">Spanish</option>
        </select>
    </div>

    <div class="clearfix"></div>
</div>

<div class="HeaderMenuDiv">
	<div class="col-lg-3">
    	<div class="SearchCatDiv" id="HeaderCategoryGreenDiv" onClick="ShwPanelCates('LeftPanelCategoryPanel')">
            <div class="col-lg-2"><i class="fa fa-bookmark" aria-hidden="true"></i></div>
            <div class="col-lg-8 SearchByCatText">Search By Category</div>
            <div class="col-lg-1"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
        </div>

        <div class="LeftStockPanelHome" onMouseOver="ShowOverLay()" onMouseOut="HideOverLay()" id="LeftPanelCategoryPanel" style="position:absolute; width:89%;">
        <?php
		foreach($mainCarType as $mct)
		{
		?>
            <div class="LeftStockRow dropdown mega-dropdown hi">
                <a href="<?php //echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','type'=>$mct['CarType']['id']));?>" class="dropdown-toggle">
                <div class="col-lg-2"><?=$mct['CarType']['car_icon']?></div>
                <div class="col-lg-8 StockPanelText"><?=$mct['CarType']['type']?> (<?=$this->Common->CarCount($mct['CarType']['id'], $userid, $groupid)?>)</div>
                <div class="col-lg-1"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                <div class="clearfix"></div>
                </a>

                <div class="dropdown-menu">
                  <div class="yamm-content">
                    <div class="col-lg-6 RightMenuBorder">
                      <div class="MenuTitle">Search By Body Type</div>
                      <ul class="MenuUlItems">
                      	<?php
						$SubCats = $this->Common->getSubCat($mct['CarType']['id']);
						foreach($SubCats as $sct)
						{
						?>
                        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','vechileType'=>$sct['CarType']['id']));?>"><li><?=$sct['CarType']['type']?></li></a>
                        <?php
						}
						?>
                      </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="MenuTitle">Search By Popular Brands</div>
                          <ul class="MenuUlItems">
                          	<?php
							$getPopBrnd = $this->Common->getPopularBrand($mct['CarType']['id']);
							foreach($getPopBrnd as $gpb)
							{
							?>
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','brand'=>$gpb['Brand']['id'], "type" => $mct['CarType']['id']));?>"><li><?=$gpb['Brand']['brand_name']?></li></a>
                            <?php
							}
							?>
                          </ul>

                          <div class="MenuTitle">Search By Year</div>
                          <ul class="MenuUlItems">
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','from'=>date("Y")-3, 'to' => date("Y"), 'vehicle_type'=>$mct['CarType']['id']));?>"><li>0-3 YEARS OLD</li></a>
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','from'=>date("Y")-5, 'to' => date("Y"), 'vehicle_type'=>$mct['CarType']['id']));?>"><li>0-5 YEARS OLD</li></a>
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','from'=>date("Y")-10, 'to' => date("Y"), 'vehicle_type'=>$mct['CarType']['id']));?>"><li>0-10 YEARS OLD</li></a>
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList','from'=>1989, 'to' => date("Y")-10, 'vehicle_type'=>$mct['CarType']['id']));?>"><li>MORE THAN 10 YEARS OLD</li></a>
                          </ul>
                    </div>
                  </div>
                <div class="clearfix"></div>
                </div>
            </div>
        <?php
		}
		?>
    </div>
    </div>
    <div class="col-lg-9 paddingRight0PX">
    	<div class="HeaderTabMainDiv">
        	<a href="http://auc.ukcarstokyo.com/" target="_blank"><div class="pull-xs-left HeaderTabs"><i class="fa fa-gavel" aria-hidden="true" style="color:#13a3ff"></i> &nbsp; Auction</div></a>

            <a ><div id="openPopup"  class="pull-xs-left HeaderTabs <?php if($this->params['controller'] == "home" && $this->params['action'] == "allstockList") { echo "HeaderTabsActive"; }?>"><i class="fa fa-list-ul" aria-hidden="true" style="color:#d2a380"></i> &nbsp; Stock List</div></a>
			<!--
			<a href="<?php echo $this->Html->url('/',true); ?>home/allstockList"><div class="pull-xs-left HeaderTabs <?php if($this->params['controller'] == "home" && $this->params['action'] == "allstockList") { echo "HeaderTabsActive"; }?>"><i class="fa fa-list-ul" aria-hidden="true" style="color:#d2a380"></i> &nbsp; Stock List</div></a>
			-->
            <div id="carmodelpopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

            <div class="pull-xs-left btn-group">
            	<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="HeaderTabs"><i class="fa fa-shopping-bag" aria-hidden="true"
                                                                                                                style="color:#a4d280"></i> &nbsp; Place an Order</div></a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">How To Buy</a>
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/request_car">Order a Car</a>
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/request_part">Order a Part</a>
                </div>
            </div>


            <div class="pull-xs-left btn-group">
            	<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="HeaderTabs"><i class="fa fa-cog" aria-hidden="true" style="color:#9380d2"></i> &nbsp; Services</div></a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/chasis_check">Chassis Check</a>
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/shipping_schedule">Shipping Schedule</a>
              </div>
            </div>

            <?php
			/*if($this->UserAuth->isLogged() && !$this->UserAuth->isAdmin())
			{
			*/?><!--
                <div class="pull-xs-right TopBarProfileDetail btn-group">
                    <a class="dropdown-item" href="<?php /*echo $this->Html->url('/',true); */?>home/dashboard">
                        <i class="fa fa-user-circle-o" aria-hidden="true" style="color:#55b640"></i> &nbsp;&nbsp;
                        Hi <span style="color:#55b640"><?php /*echo  $this->Session->read('defaultUserName'); */?></span> &nbsp; &nbsp;
                    </a>
                  </div>
            --><?php
/*			}*/

			if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin())
			{
			?>
                <div class="pull-xs-right TopBarProfileDetail btn-group">
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>admin/DashboardUser/">
                        <i class="fa fa-user-circle-o" aria-hidden="true" style="color:#55b640"></i> &nbsp;&nbsp;
                        Hi <span style="color:#55b640">Admin</span> &nbsp; &nbsp;
                    </a>
                  </div>
            <?php
			}
            // added by Ajay Date:22012018
            else if($this->UserAuth->isLogged() && $this->UserAuth->isClientAdmin())
            {
                ?>


                <div class="pull-xs-left btn-group">
                    <a aria-haspopup="true" aria-expanded="false" href="<?php echo $this->Html->url('/',true); ?>admin/cars/addnew_car/">
                        <div class="HeaderTabs">
                            <i class="fa fa-automobile" aria-hidden="true" style="color:#55b640"></i>  &nbsp;&nbsp; Add Cars&nbsp; &nbsp;
                        </div>
                    </a>
                </div>

                <div class="pull-xs-right TopBarProfileDetail btn-group">
                    <a class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/dashboard" title="<?php echo $this->Session->read('defaultUserName');?>">
                        <i class="fa fa-user-circle-o" aria-hidden="true" style="color:#55b640"></i> &nbsp;&nbsp;
                        Hi <span style="color:#55b640">
                            <?php
                            $fullname = $this->Session->read('defaultUserName');
                            $length = 10;
                            if(strlen($fullname)<= $length)
                                echo $fullname;
                            else{
                                $fullname = substr($fullname,0,$length) . '...';
                                echo $fullname;
                            }
                            ?>
                        </span> &nbsp; &nbsp;

                    </a>
                </div>
                <?php
            } else if($this->UserAuth->isLogged() && $this->UserAuth->isBuyUserAdmin())
            {
                ?>


                <div class="pull-xs-left btn-group">
                    <a title="You don't have permission to add cars." aria-haspopup="true" aria-expanded="false" href="#">
                        <div class="HeaderTabs">
                            <i class="fa fa-automobile" aria-hidden="true" style="color:#55b640"></i>  &nbsp;&nbsp; Add Cars&nbsp; &nbsp;
                        </div>
                    </a>
                </div>

                <div class="pull-xs-right TopBarProfileDetail btn-group">
                    <a  class="dropdown-item" href="<?php echo $this->Html->url('/',true); ?>home/dashboard" title="<?php echo $this->Session->read('defaultUserName');?>">
                        <i class="fa fa-user-circle-o" aria-hidden="true" style="color:#55b640"></i> &nbsp;&nbsp;
                        Hi <span style="color:#55b640">
                            <?php
                            $fullname = $this->Session->read('defaultUserName');
                            $length = 10;
                            if(strlen($fullname)<= $length)
                                echo $fullname;
                            else{
                                $fullname = substr($fullname,0,$length) . '...';
                                echo $fullname;
                            }
                            ?>
                        </span> &nbsp; &nbsp;

                    </a>
                </div>
                <?php
            }else{ ?>
                <div class="pull-xs-left btn-group">
                    <a title="Only sell users have permission to add cars." aria-haspopup="true" aria-expanded="false" href="<?php echo $this->Html->url('/',true); ?>login/">
                        <div class="HeaderTabs">
                            <i class="fa fa-automobile" aria-hidden="true"  style="color:#55b640"></i>  &nbsp;&nbsp; Add Cars&nbsp; &nbsp;
                        </div>
                    </a>
                </div>
            <?php }
			?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</header>

<!--header stop-->
<div class="main-content" >
<?php echo $this->fetch('content'); ?>
</div>


<footer class="SiteFooter">
	<div class="col-lg-3" style="margin-top:30px;">
    	<a href="<?php echo $this->Html->url('/',true); ?>"><img class="img-fluid" src="<?=$this->webroot?>images/w-logo_3.png" style="width:200px; margin:0px auto;"></a>
    </div>
    <div class="col-lg-3" style="margin-left:40px;">
    	<div class="FooterMenuTitle">USEFUL LINKS</div>
        <ul class="FooterMenuItems">
            <li><a href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy">How To Buy</a></li>
            <li><a href="<?php echo $this->Html->url('/',true); ?>home/request_car">Order a Car</a></li>
            <li><a href="<?php echo $this->Html->url('/',true); ?>pages/policy">Payment Policy</a></li>
        </ul>
    </div>
    <div class="col-lg-3" style="margin-top:73px;">
        <ul class="FooterMenuItems">
            <li><a href="<?php echo $this->Html->url('/',true); ?>home/request_part">Order a Part</a></li>
            <li><a href="<?php echo $this->Html->url('/',true); ?>home/chasis_check">Chassis Check</a></li>
            <li><a href="<?php echo $this->Html->url('/',true); ?>pages/terms_condition">Terms & Conditions</a></li>
        </ul>
    </div>
    <div class="col-lg-2 NoPaddingLeft" style="margin-top:73px;">
        <ul class="FooterMenuItems">
            <li><a href="<?php echo $this->Html->url('/',true); ?>pages/aboutus">Company Info</a></li>
            <li><a href="<?php echo $this->Html->url('/',true); ?>home/shipping_schedule">Shipping Schedule</a></li>
        </ul>
    </div>

    <div class="clearfix"></div>

<?php print $footer['Page']['content']; ?>

    <div class="clearfix"></div>
</footer>

<div class="col-lg-3" style="margin-left:40px;"></div>
<div class="col-lg-3 ConnectwithUs">Connect With Us : </div>
<div class="footerSocialLInks col-lg-3">
    <div class="FooterSocialIcons pull-xs-left"><a href="" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></div>
    <div class="FooterSocialIcons pull-xs-left"><a href="" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a></div>
    <div class="FooterSocialIcons pull-xs-left"><a href="" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></div>
</div>

<div class="clearfix"></div>

<div class="footer_bottom text-xs-center">
    &copy; Bizupon - <?=date("Y")?> All right Reserved <!--| Powered by Pixpal-->
    <div class="clearfix"></div>
</div>

<div id="OverLay" class="overlay"></div>
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
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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

function ShowOverLay()
{
	$("#OverLay").css('display', 'block');
}
function HideOverLay()
{
	$("#OverLay").css('display', 'none');
}

$(function() {
	$('.chosen-select').chosen();
});
</script>

<script type="text/javascript">
$(function() {

    //autocomplete
    $("#GlobalSearch").autocomplete({
        source: "<?php echo $this->Html->url('/',true); ?>home/globalSearch",
        minLength: 1,
		/*response: function( event, ui ) {$(".searchHeaderIcon").html('<i class="fa fa-search" aria-hidden="true"></i>')},
        search: function( event, ui ) {$(".searchHeaderIcon").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')},*/

		response: function( event, ui ) {$(".searchHeaderIcon").html('<button type="submit" style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0; border: 0 solid #ccc;"><i class="fa fa-search" aria-hidden="true"></i></button>')},
        search: function( event, ui ) {$(".searchHeaderIcon").html('<button type="submit" style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0; border: 0 solid #ccc;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></button>')},
		select: function(event, ui) {
			if(ui.item){
				//$("#GoobalSearrch").val(ui.item.label);
				window.location = '<?php echo $this->base;?>/home/car_show/'+ui.item.tag;
			}
			//$('#search').submit();
		},
		change: function( event, ui ) {
			$( "#GoobalSearrch" ).val( ui.item? ui.item.label : 0 );
		}
    });

});
</script>

<style>
 body{height:1000px;}
  a{cursor:pointer;text-decoration:none;}
  a:hover{text-decoration:none;}

  </style>




  	<div class="blur"></div>
	<div class="carPopup">
		<h2 class="heading text-center"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$this->base.'/images/w-logo_3.png'; ?>">Search By Maker</h2>
		<span id="close">X</span>
			<div class="row">
				<div class="col-sm-12 col-xs-12 text-center main-div">
					  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
						  <div class="item active">
							<ul class="listing">
							<?php

							$getbrandinfo = $this->Common->getBrandinfo($userid, $groupid);


								$BrandSrn = 0;
								foreach($getbrandinfo as $AllBrand) {

								$BrandSrn++;
								if($BrandSrn==1)
								$active = 'active';
								else
								$active = '';

								if($BrandSrn==12){
						 		echo  '</ul></div><div class="item"><ul class="listing">';
                                                                }



							?>
							<li class="<?php print $active ?>">
								<a href="javascript:void(0)" id="brands_<?php echo $AllBrand['b']['id'];?>" OnClick="GetModel('<?php echo $AllBrand['b']['id'];?>')">
									<img src="<?php echo $this->webroot.$AllBrand['b']['brand_image'];?>" alt="<?php echo $AllBrand['b']['brand_name'];?>" style="max-width:100%;">

									<p class="name"><?php echo $AllBrand['b']['brand_name'];?>&nbsp;</p>
									<p class="quantity">(<?=$AllBrand[0]['total']?>)</p>
								</a>
							</li>

							<?php } ?>
							</ul>
						  </div>
						</div>

						<a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
						  <span class="fa fa-chevron-left" aria-hidden="true"></span>
						  <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
						  <span class="fa fa-chevron-right" aria-hidden="true"></span>
						  <span class="sr-only">Next</span>
						</a>


					  </div>

					<h3>Models</h3>

				    <input type="hidden" name="makedata" id="makedata" value="" />
					<div class="alpha-sort" id="makedataresult" >


					</div>
				</div>
			</div>
	</div>
	<script>
		jQuery(document).ready(function(){

			jQuery('#openPopup').click(function(){
				jQuery('.carPopup').show();
				jQuery('body').css('overflow','hidden');
				jQuery('.blur').show();
                                jQuery('.carousel-inner #brands_9').click()
			});
			/*$('.carPopup .listing li a').click(function(){
				$('.carPopup .sub-listing').show();
			});*/

			jQuery('.carPopup #close').click(function(){
				jQuery('.carPopup').hide();
				jQuery('body').css('overflow','auto');
				jQuery('.blur').hide();

			});
			jQuery('.carPopup .listing li').click(function(){
				jQuery('.carPopup .listing li').removeClass('active');
				jQuery(this).addClass('active');
			});
		});



function GetModel(value)
{
        jQuery('#makedata').val(value);
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->html->url('/', true); ?>/home/getcarinfo",
		data: {'id':value},
		success: function(data){
			$("#makedataresult").html(data);
			//jQuery("#FilterModalBoxTop").chosen();
		}
	});
}

function gofilter(dd)
{
   window.location.href = "<?php  echo $this->html->url('/', true); ?>home/allstockList?make="+jQuery('#makedata').val()+'&model='+dd.rel;
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


jQuery(document).ready(function($) {

  if (window.history && window.history.pushState && getUrlParameter('make') && getUrlParameter('model') ) {
    window.history.pushState(null, "", window.location.href);
    jQuery(window).on('popstate', function() {
     jQuery('#openPopup').click();return false;
    });

  }
});


	</script>
</body>
</html>
