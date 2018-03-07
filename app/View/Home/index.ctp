<script type="text/Javascript">
$(function(){
	jQuery(document).ready(function(){
		jQuery("#makeId").chosen();
		jQuery("#FilterModalBoxTop").chosen();
		jQuery("#yearFromId").chosen();
		jQuery("#yearToId").chosen();
		jQuery("#quickCCId").chosen();
		jQuery("#locationId").chosen();
	});
});
function showCarName(){
	$(".brands li a").click(function(){
		$(".details").fadeIn();
		$(".brands li img").addClass("active_effects");
		$(this).children().removeClass('active_effects');
		$(this).parent().addClass('active');
	});
	$(".nav-tabs > li > a").click(function(){
		$(".brands li img").removeClass("active_effects");
		$(".nav-tabs > li > a").addClass("active_effects");
		$(this).removeClass('active_effects');
	});
	$(".nav-tabs > li > a").click(function(){
		$(".details").hide();
	});
};
</script>


<div class="col-lg-3">
	<div class="LeftStockPanelHome" onMouseOver="ShowOverLay()" onMouseOut="HideOverLay()">
        <?php
		foreach($mainCarType as $mct)
		{
		?>
            <div class="LeftStockRow dropdown mega-dropdown">
                <div class="col-lg-2"><?=$mct['CarType']['car_icon']?></div>
                <div class="col-lg-8 StockPanelText"><?=$mct['CarType']['type']?> (<?=$this->Common->CarCount($mct['CarType']['id'])?>)</div>
                <div class="col-lg-1"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                <div class="clearfix"></div>

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
<div class="col-lg-9 paddingRight0PX SliderHomeDiv">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
        	<?php
			$i = 0;
			foreach($homePages_slides as $item):
			$i++;
			?>
            <div class="carousel-item <?php if($i == 1) { echo "active"; } ?>">
            	<img src="<?php echo $this->webroot."img/HomePageManagements/".$item['HomePageSlide']['image_source']?>" style="height:375px; width:100%">
            </div>
            <?php
			endforeach;
			?>
        </div>
    </div>

    <div class="col-lg-9 SliderSearchBox">
    	<div class="QuickSearchText col-lg-12">Quick Search</div>
        <?php echo $this->Form->create('Home',array('url'=>array('controller'=>'home','action'=>'allstockList'),'class'=>'form-horizontal','id'=>'searchCountry'));?>
        <div class="col-lg-3 PaddingLeft0PX">
			<?php
            echo $this->Form->input('brand_name',array('type'=>'select','empty'=>'Make','options'=>$Brand,'class'=>'form-control chosen-select FilterSelectBoxRight','label'=>false,'div'=>false,'data-rel'=>'chosen','id'=>'makeId', 'onChange' => 'ChangeModel(this.value)'));
            ?>
        </div>

        <div class="col-lg-3 PaddingLeft0PX" id="ModelData">
			<?php
            echo $this->Form->input('model',array('type'=>'select','empty'=>'Choose Make','class'=>'form-control chosen-select','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'FilterModalBoxTop'));
            ?>
        </div>


        <div class="col-lg-3 PaddingLeft0PX">
			<?php
            echo $this->Form->input('yearFrom',array('type'=>'select','empty'=>'From','options'=>$option_year,'class'=>'form-control chosen-select','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId',));
            ?>
        </div>

        <div class="col-lg-3 PaddingLeft0PX">
			<?php
            echo $this->Form->input('yearTo',array('type'=>'select','empty'=>'To','options'=>$option_year,'class'=>'form-control chosen-select','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearToId'));
            ?>
        </div>

        <div class="clearfix">&nbsp;</div>

        <div class="col-lg-3 PaddingLeft0PX">
	        <?php
			$arrCc = array('0,1000'=>'1000 CC and Less','1000,1500'=>'1000 CC - 1500 CC','1500,1800'=>'1500 CC - 1800 CC','1800,2000'=>'1800 CC - 2000 CC','2000,2500'=>'2000 CC - 2500 CC','2500,4000'=>'2500 CC - 4000 CC','4000,99999'=>'4000 CC and Over');
			echo $this->Form->input('cc',array('type'=>'select','empty'=>'CC','options'=>$arrCc,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'quickCCId'));
			?>
        </div>


        <div class="col-lg-3 PaddingLeft0PX">
			<?php
            echo $this->Form->input('stock',array('type'=>'text','class'=>'form-control','placeholder'=>'Stock ID','label'=>false,'data-rel'=>'','div'=>false,'id'=>'quickCCId'));
            ?>
        </div>

        <div class="col-lg-3 PaddingLeft0PX">
			<?php
            echo $this->Form->input('cnumber',array('type'=>'text','class'=>'form-control','placeholder'=>'Enter Chassis no.','label'=>false,'data-rel'=>'','div'=>false,'id'=>'cnumber'));
            ?>
        </div>

        <div class="col-lg-3 PaddingLeft0PX">
        	<button type="submit" class="btn btn-success hvr-pulse-grow" style="width:100%">Quick Search &nbsp; <i class="fa fa-search" aria-hidden="true"></i></button>
        </div>

        <div class="clearfix">&nbsp;</div>

        <?php echo $this->Form->end();?>
    </div>
</div>

<div class="clearfix"></div>

<div class="SearchByMakersMainDiv">
	<div class="col-lg-2 SearchByTypeTitle">Search By Popular Brands</div>

    <div class="col-lg-10">
    	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">


        	<div class="carousel-inner" role="listbox">
                <div class="carousel-item text-xs-center active col-lg-11 HomePageLogoCoursal">
					<?php
					$BrandSrn = 0;
                    foreach(@$CBrand as $AllBrand) {
						$BrandSrn++;
						if($BrandSrn == 13)
						{
							echo '</div><div class="carousel-item text-xs-center col-lg-11 HomePageLogoCoursal">';
						}
                    ?>
                        <div class="col-lg-1 text-xs-center HomePageLogoDiv">
                            <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'brand' => $AllBrand['Brand']['id']));?>">
                                <div style="height:60px"><img src="<?php echo $this->webroot.$AllBrand['Brand']['brand_image'];?>" alt="<?php echo $AllBrand['Brand']['brand_name'];?>" style="max-width:100%; height:50px;"></div>
                                <?php echo $AllBrand['Brand']['brand_name'];?><br>(<?=$AllBrand[0]['TotalCar']?>)
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="top:38%">
                <img class="d-block img-fluid text-xs-center" src="<?=$this->base?>/images/left_arrow.png" width="30">
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="top:38%">
                <img class="d-block img-fluid text-xs-center" src="<?=$this->base?>/images/right_arrow.png" width="30">
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="NewArrivalMainDiv">
	<div class="col-lg-12 NewArriavalTitle">Recently Added Car</div>
    <div class="clearfix">&nbsp;</div>
    <?php
	foreach($showAllCar as $SAC)
	{
	$groupID_Saved = $SAC['Car']['groupid'];

	if($groupID_Saved == 2){
		$ADDITIONAL_PRICE_Val = 0;
		$ADDITIONAL_YEN_PRICE_Val = 0;
	}else{
		$ADDITIONAL_PRICE_Val = ADDITIONAL_PRICE;
		$ADDITIONAL_YEN_PRICE_Val = ADDITIONAL_YEN_PRICE;
	}
	?>
	    <a href="<?php echo $this->base;?>/home/car_show/<?=$SAC['Car']['id']?>">
        <div class="col-lg-2 HoveTile" style="margin-bottom:15px; height:250px;">
        	<div class="HomePageCarImageDiv" "><img src="<?php echo $this->webroot.$SAC['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" title="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" style="height:150px; width:100%;"></div>
            <div class="HomePageCarNameDiv" style="min-height:40px;font-size:14px; overflow:hidden"><?php echo $SAC['CarName']['car_name'] . ":" . $SAC['Car']['package'];?></div>

			  <div class="HomePageCarNameDiv" style="overflow:hidden"><?php

					@$b = explode(' ',$SAC['Car']['manufacture_year']);
                    echo "<span style=\"color:#55b640;\">YEAR:</span>".@$b['1']."/".@$b['0'];
					?>

					<span class="HomePageCarPriceDiv" style="padding-left:10px;font-size:15px;">
<?php
			if($this->UserAuth->isLogged()){ ?>
           <?php
			if($this->Session->read('LANGUAGE') == 2 )
			{
				echo "$ ". $this->Round->round_number(ceil($SAC['CarPayment'][0]['asking_price'] + $ADDITIONAL_PRICE_Val));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($SAC['CarPayment'][0]['yen'] + $ADDITIONAL_YEN_PRICE_Val));
			}
			?>
			<?php } ?>
					</span>
				</div>


        </div>
        </a>
    <?php
	}
	?>
    <div class="clearfix"></div>
    <div class="col-lg-12"><a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList'));?>" class="ViewMoreText"> <i class="fa fa-plus-circle" aria-hidden="true"></i> View More <b>>></b></a></div>
</div>

<div class="">
	<div class="HomePageTitleBar">Body Types</div>
    <div class="clearfix"></div>

    <div class="HomePageBodyTypeListinMain">
    	<a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 7));?>">
    	<div class="col-lg-2 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/suv-zeep.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center;">
                    SUV / Jeep<br>(<?=@$BodyTypes[7]==0 ? "0" : $BodyTypes[7]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 6));?>">
        <div class="col-lg-4 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/sedan.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center;">
                    Sedan<br>(<?=@$BodyTypes[6]==0 ? "0" : $BodyTypes[6]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 5));?>">
        <div class="col-lg-4 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/coupe.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center;">
                    Hatchback/Coupe<br>(<?=@$BodyTypes[5]==0 ? "0" : $BodyTypes[5]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 11));?>">
        <div class="col-lg-2 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/van.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center;">
                    VAN<br>(<?=@$BodyTypes[11]==0 ? "0" : $BodyTypes[11]?>)
                </div>
            </div>
        </div>
        </a>

        <div class="clearfix"></div>

        <!--<a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 15));?>">
        <div class="col-lg-2 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/muv.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center;">
                    MUV<br>(<?=@$BodyTypes[15]==0 ? "0" : $BodyTypes[15]?>)
                </div>
            </div>
        </div>
        </a>-->

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 4));?>">
        <div class="col-lg-2 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/wagon.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center; margin-bottom:0px;">
                    Wagon<br>(<?=@$BodyTypes[4]==0 ? "0" : $BodyTypes[4]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 13));?>">
        <div class="col-lg-4 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/sports.jpg); background-size:cover; background-repeat:no-repeat; background-position:left;">
                    Convertible /Sports<br>(<?=@$BodyTypes[13]==0 ? "0" : $BodyTypes[13]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 14));?>">
        <div class="col-lg-4 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/pickup.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center; margin-bottom:0px;">
                    PickUp Truck<br>(<?=@$BodyTypes[14]==0 ? "0" : $BodyTypes[14]?>)
                </div>
            </div>
        </div>
        </a>

        <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allstockList', 'vechileType' => 12));?>">
        <div class="col-lg-2 DivPadding5PX">
        	<div class="BodyTypeMainDivHomePage">
                <div class="BodyTypeTiles" style="background:url(<?php echo $this->webroot?>images/bus.jpg); background-size:cover; background-repeat:no-repeat; background-position:center center; margin-bottom:0px;">
                    Bus<br>(<?=@$BodyTypes[12]==0 ? "0" : $BodyTypes[12]?>)
                </div>
            </div>
        </div>
        </a>

        <div class="clearfix"></div>

    </div>
</div>

<div class="clearfix">&nbsp;</div>
<script>
function getBrandName(countryId){
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->Html->url('/',true);?>home/gatBrandDetail",
		data: {'countryId':countryId},
		dataType:'json',
		beforeSend:function(){
			$('#fountainG').show('');
		},
		success: function(data){
			console.log(data);
			for(var i in data.brands)
			{
				str+= '<li class="brand-name" style="text-align:center;">\
				<a title="'+data.brands[i].Brand.brand_name+'"  href="<?php  echo $this->Html->url('/',true);?>home/allBrand/country:'+data.country_id+'/brand:'+data.brands[i].Brand.id+'/type:'+data.brands[i].Car.car_type_id+'"><img src="'+data.brands[i].Brand.brand_image+'" alt="'+data.brands[i].Brand.brand_name+'"/></a><span class="total_car">'+data.brands[i].Brand.brand_name+'</br> ('+data.brands[i][0].TotalCar+')</span></li>';
			}
			$("#brandsUlId1").html(str);
			$("#brandsUlId1").show();
			$("#brandsUlId2").hide();
			$("#brandsUlId3").hide();
			$('#fountainG').hide();
		}
	});
}

function getCarName(countryId,brandId){
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->Html->url('/',true);?>home/getCarName",
		data: {'countryId':countryId,'brandId':brandId},
		beforeSend:function(){
			$('#fountainGg').show('');
		},
		dataType:'json',
		success: function(data){
			for(var i in data.carNames)
			{
				str+= '<li><a href= "<?php  echo $this->Html->url('/',true);?>home/showAllCar/'+data.country_id+'/'+data.brand_id+'/'+data.carNames[i].Car.car_name_id+'"> '+data.carNames[i].CarName.car_name+'  </a></li>';
			}
			$("#carNameUlId").html(str);
			$('#fountainGg').hide();
		}
	});
}

function quickSearch(){
	$("#quickSearchForm").ajaxSubmit({
		url:"<?php echo $this->Html->url('/home/quickSearch',true);?>",
		type:"POST",
		dataType:'JSON',
		success:function(data){
			alert(data);
		}
	});
}

function getTruckData() {
	var str='';
	var type = '';
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->Html->url('/',true);?>home/gatTruckDetail",
		dataType:'json',
		beforeSend:function(){
			$('#fountainG').show('');
		},
		success: function(data)
		{
			str = '<li style="text-align:center;" class="col-sm-4"  ><a title=""  href="<?php  echo $this->Html->url('/',true);?>home/allTruckStock/type:'+2+'/vtype:'+8+'"><img src="images/bus-tab.jpg"/><span class="total_car">Bus Stock</span></a></li><li style="text-align:center;" class="col-sm-4"><a title=""  href="<?php  echo $this->Html->url('/',true);?>home/allTruckStock/type:'+2+'/vtype:'+9+'"><img src="images/Dump_stock_tab.jpg"/><span class="total_car">Dump Stock</span></a></li><li style="text-align:center;" class="col-sm-4"><a title=""  href="<?php  echo $this->Html->url('/',true);?>home/allTruckStock/type:'+2+'/vtype:'+10+'"><img src="images/mix_tab.jpg"/><span class="total_car">Mixture Stock</span></a></li>';
			$("#brandsUlId1").hide();
			$("#brandsUlId3").hide();
			$("#brandsUlId2").html(str);
			$("#brandsUlId2").show();
			$('#fountainG').hide();
		}
	});
}

/* function for get haevy machinery  */
function getHeavyData() {
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->Html->url('/',true);?>home/getHeavyMachinery",
		dataType:'json',
		beforeSend:function(){
			$('#fountainG').show('');
		},
		success: function(data)
		{
			if(data.brands.length > 0 ){
				for(var i in data.brands){
					str+= '<li class="brand-name" style="text-align:center;">\
					<a title="'+data.brands[i].Brand.brand_name+'"  href="<?php  echo $this->Html->url('/',true);?>home/allHeavyBrand/brand:'+data.brands[i].Brand.id+'/type:'+data.brands[i].Car.car_type_id+'/vtype:'+data.brands[i].Car.vehicle_type_id+'"><img src="'+data.brands[i].Brand.brand_image+'" alt="'+data.brands[i].Brand.brand_name+'"/></a><span class="total_car">'+data.brands[i].Brand.brand_name+'</br> ('+data.brands[i][0].TotalCar+')</span></li>';
				}
				$("#brandsUlId1").hide();
				$("#brandsUlId2").hide();
				$("#brandsUlId3").html(str);
				$("#brandsUlId3").show();
				$("#brandsUlId3").trigger("liszt:updated");
				$('#fountainG').hide();
			}
			else{
				$("#brandsUlId1").hide();
				$("#brandsUlId2").hide();
				$("#brandsUlId3").html('<div style="text-align:center;"><h4><font color="#b00e10">No heavy machineary found !!!</h4></font></div>');
				$("#brandsUlId3").trigger("liszt:updated");
				$("#brandsUlId3").show();
				$('#fountainG').hide();
			}
		}
	});
}

function getData(){
	var firm_id = document.getElementById("frameno_form").firm.value;
	var frame_no = document.getElementById("frameno_form").no.value;
	window.open("http://www.drom.ru/frameno/common.php?firm="+firm_id+"&no="+frame_no+"&lang=eng&httpreferer=<?php echo $this->Html->url('/home/chasis_check',true);?>","", "toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars="+1+", resizable=yes,width="+350+",height="+250+",top=100,left=100");
	return false;
}

$(function(){
	$('#tab_hide').show();
	$('.show_hide').hide();
});

function get_jpy_price(){
	$.ajax({
		'url':'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20%28%22USDJPY%22%29&format=json&env=store://datatables.org/alltableswithkeys',
		'type':'get',
		"dataType":'json',
		'success':function(obj){
			var newRate = Math.floor(obj.query.results.rate.Rate) -1 ;
			$.ajax({
				url:"<?php echo $this->Html->url('/admin/users/current_doller_to_yen_rate',true);?>",
				type:'POST',
				data:{'newrate':newRate},
				success:function(result){}
			});
		},
		'error':function(error){}
	});
}

$(function() {
	$("#cnumber").autocomplete({
		source: "<?php  echo $this->Html->url('/',true);?>home/chassis_list"
	});
});

function ChangeModel(value)
{
	var str='';
	$.ajax({
		type: "POST",
		url: "<?php  echo $this->Html->url('/',true);?>home/gatModel",
		data: {'id':value},
		beforeSend:function(){
			$('#fountainG').show('');
		},
		success: function(data){
			$("#ModelData").html(data);
			jQuery("#FilterModalBoxTop").chosen();
		}
	});
}
</script>
