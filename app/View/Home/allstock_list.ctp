<form method="post" id="LeftPanelFilter" action="<?php echo $this->base;?>/home/filterStockList/">
<div class="col-lg-3">

    	<input type="hidden" id="CurrentPage" name="CurrentPage" value="1">
    	<input type="hidden" name="GlobalSearch" value="<?=@$GlobalSearch?>">
    	<input type="hidden" name="CarType" value="<?=@$CarType?>">
        <div class="LeftPanelStockPage">
            <div class="StockPageLeftTitle">
                <i class="fa fa-tag" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Price
            </div>

            <?php
			if($this->Session->read('LANGUAGE') == 2)
			{
			?>
            <div class="pull-xs-left PriceRangePrice">$ 0</div>
            <div class="pull-xs-right PriceRangePrice">$ <?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?></div>
            <div class="clearfix"></div>
            <?php
			}
			else
			{
			?>
            <div class="pull-xs-left PriceRangePrice"><i class="fa fa-jpy" aria-hidden="true"></i> 0</div>
            <div class="pull-xs-right PriceRangePrice"><i class="fa fa-jpy" aria-hidden="true"></i> <?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?></div>
            <div class="clearfix"></div>
            <?php
			}
			?>


            <?php
			if($this->Session->read('LANGUAGE') == 2)
			{
			?>
            <div id="PriceNewSlider"></div>
            <div class="PriceRangeSlider">
                <input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?>" data-slider-step="5" data-slider-value="[0,<?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?>]"/>
            </div>

            <div class="col-lg-5 text-xs-center ChoosedPriceBox">$ <span id="PriceFromRange">0</span></div>
            <div class="col-lg-2 PriceRangeToText text-xs-center">To</div>
            <div class="col-lg-5 text-xs-center ChoosedPriceBox">$ <span id="PriceToRange"><?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?></span></div>


            <input type="hidden" name="PriceFromRange" id="RangePriceFrom" value="0">
            <input type="hidden" name="PriceToRange" id="RangePriceTo" value="<?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?>">

            <?php
			}
			else
			{
			?>

            <div id="PriceNewSlider"></div>

            <div class="PriceRangeSlider">
                <input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?>" data-slider-step="5" data-slider-value="[0,<?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?>]"/>
            </div>

            <div class="col-lg-5 text-xs-center ChoosedPriceBox"><i class="fa fa-jpy" aria-hidden="true"></i> <span id="PriceFromRange">0</span></div>
            <div class="col-lg-2 PriceRangeToText text-xs-center">To</div>
            <div class="col-lg-5 text-xs-center ChoosedPriceBox"><i class="fa fa-jpy" aria-hidden="true"></i> <span id="PriceToRange"><?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?></span></div>


            <input type="hidden" name="PriceFromRange" id="RangePriceFrom" value="0">
            <input type="hidden" name="PriceToRange" id="RangePriceTo" value="<?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?>">

            <?php
			}
			?>
            <div class="clearfix">&nbsp;</div>

            <div class="ListingViewButton hvr-pulse-grow" onClick="FilterPriceStock();">Filter</div>

            <div class="LeftFilterSeprater"></div>



            <div class="StockPageLeftTitle">
                <i class="fa fa-calendar-check-o" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Year of Registration
            </div>

            <div class="offset-lg-1 col-lg-3 YearComboBoxTitle">From</div>
            <div class="col-lg-8">
                <select class="form-control FilterSelectBox" name="YearFrom" onChange="save_form()" id="YearsFromFilter">
                    <option value="">From</option>
                    <?php
                    for($i = 2016; $i >= 1989; $i--)
                    {
                    ?>
                        <option <?php if(@$_POST['data']['Home']['yearFrom'] == $i) { ?> selected <?php } ?>><?=$i?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="clearfix">&nbsp;</div>

            <div class="offset-lg-1 col-lg-3 YearComboBoxTitle">To</div>
            <div class="col-lg-8">
                <select class="form-control FilterSelectBox" name="YearTo" onChange="save_form()" id="YearsToFilter">
                    <option value="">To</option>
                    <?php
                    for($i = 2016; $i >= 1989; $i--)
                    {
                    ?>
                        <option <?php if(@$_POST['data']['Home']['yearTo'] == $i) { ?> selected <?php } ?>><?=$i?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>



            <div class="LeftFilterSeprater"></div>



            <div class="StockPageLeftTitle">
                <i class="fa fa-code-fork" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Transmission
            </div>

            <div class="offset-lg-1 col-lg-2"><input name="transmission" id="FilterTransmissionAuto" value="Automatic" onClick="save_form()" type="radio" class="FilterBoxheckBox"></div>
            <div class="col-lg-8 PriceRangePrice">Automatic</div>
            <div class="clearfix">&nbsp;</div>

            <div class="offset-lg-1 col-lg-2"><input name="transmission" id="FilterTransmissionManual" value="Manual" onClick="save_form()" type="radio" class="FilterBoxheckBox"></div>
            <div class="col-lg-8 PriceRangePrice">Manual</div>
            <div class="clearfix"></div>



            <div class="LeftFilterSeprater"></div>



            <div class="StockPageLeftTitle">
                <i class="fa fa-fire" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Fuel
            </div>

            <div class="offset-lg-1 col-lg-2"><input type="radio" name="fuel" value="Gasoline" id="FilterFulelGas" onClick="save_form()" class="FilterBoxheckBox"></div>
            <div class="col-lg-8 PriceRangePrice">Gasoline</div>
            <div class="clearfix">&nbsp;</div>

            <div class="offset-lg-1 col-lg-2"><input type="radio" name="fuel" value="Diesel" id="FilterFulelDiesel" onClick="save_form()" class="FilterBoxheckBox"></div>
            <div class="col-lg-8 PriceRangePrice">Diesel</div>
            <div class="clearfix">&nbsp;</div>

            <div class="LeftFilterSeprater"></div>



            <div class="StockPageLeftTitle">
                <i class="fa fa-road" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Kilometers
            </div>

            <div class="pull-xs-left PriceRangePrice">0 KM</div>
            <div class="pull-xs-right PriceRangePrice"><?=floor($KMRange[0]['max_price'])?> KM</div>
            <div class="clearfix"></div>

            <div id="KMNewSlider"></div>

            <div class="KMRangeSlider">
                <input id="ex3" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=floor($KMRange[0]['max_price'])?>" data-slider-step="5" data-slider-value="[0,<?=floor($KMRange[0]['max_price'])?>]"/>
            </div>

            <div class="col-lg-5 text-xs-center ChoosedPriceBox"><span id="KMFromRange">0</span> KM</div>
            <div class="col-lg-2 PriceRangeToText text-xs-center">To</div>
            <div class="col-lg-5 text-xs-center ChoosedPriceBox"><span id="KMToRange"><?=ceil($KMRange[0]['max_price'])?></span> KM</div>


            <input type="hidden" name="KMFromRange" id="RangeKMFrom" value="0">
            <input type="hidden" name="KMToRange" id="RangeKMTo" value="<?=ceil($KMRange[0]['max_price'])?>">


            <div class="clearfix">&nbsp;</div>

            <div class="ListingViewButton hvr-pulse-grow" onClick="SetKMFilter();">Filter</div>

            <div class="LeftFilterSeprater"></div>

            <div class="StockPageLeftTitle">
                <i class="fa fa-code-fork" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; CC
            </div>

            <select class="form-control FilterSelectBox" name="CC" onChange="save_form()" id="FilterCCBox">
                <option value="">CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "0,1000") { ?> selected <?php } ?> value="0,1000">1000 CC and Less</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "1000,1500") { ?> selected <?php } ?> value="1000,1500">1000 CC - 1500 CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "1500,1800") { ?> selected <?php } ?> value="1500,1800">1500 CC - 1800 CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "1800,200") { ?> selected <?php } ?> value="1800,2000">1800 CC - 2000 CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "2000,2500") { ?> selected <?php } ?> value="2000,2500">2000 CC - 2500 CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "2500,4000") { ?> selected <?php } ?> value="2500,4000">2500 CC - 4000 CC</option>
                <option <?php if(@$_POST['data']['Home']['cc'] == "4000,99999") { ?> selected <?php } ?> value="4000,99999">4000 CC and Over</option>
            </select>

            <div class="clearfix"></div>

            <div class="LeftFilterSeprater"></div>


            <div class="StockPageLeftTitle">
                <i class="fa fa-code-fork" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Stock ID
            </div>

            <input type="text" name="stockId" id="stockIdFiltersBox" class="form-control BidAmountTextBox" placeholder="Stock ID" value="<?=@$_POST['data']['Home']['stock']?>">

            <div class="clearfix">&nbsp;</div>

            <div class="ListingViewButton hvr-pulse-grow" onClick="save_form();">Filter</div>

            <div class="LeftFilterSeprater"></div>

            <div class="StockPageLeftTitle">
                <i class="fa fa-code-fork" aria-hidden="true" style="color:#403f40"></i> &nbsp;&nbsp; Chassis No.
            </div>

            <input type="text" name="chassisNo" class="form-control BidAmountTextBox" id="ChassisNoFilterBox" placeholder="Chassis No." value="<?=@$_POST['data']['Home']['cnumber']?>">

            <div class="clearfix">&nbsp;</div>

            <div class="ListingViewButton hvr-pulse-grow" onClick="save_form();">Filter</div>

            <div class="LeftFilterSeprater"></div>

            <div class="ListingViewButton hvr-pulse-grow" onClick="location.reload();">RESET</div>
        </div>
</div>
<?php

?>
<div class="col-lg-9" style="position:relative;">

    <div style="background:#595959; padding:10px 0px;">
    <div class="col-lg-4">
    	<div class="FilterBoxTopBarSectoin">
            <div class="col-lg-3 FilerTopBarLable">Make</div>
            <div class="col-lg-9 NoPaddingLeft">
            <select class="form-control chosen-select FilterSelectBoxRight" name="brand" id="BradNamefiltrCob" onChange="ChangeModel(this.value)">
                <option value="">All Brands</option>
                <?php
				foreach($Brand as $id => $brnd)
				{
					?>
                    <option data-name="<?=$brnd?>" <?php if(@$_POST['data']['Home']['brand_name'] == $id || @$this->passedArgs['brand'] == $id) { ?> selected <?php } ?> value="<?=$id?>"><?=$brnd?></option>
                    <?php
				}
				?>
            </select>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="FilterBoxTopBarSectoin">
            <div class="col-lg-3 FilerTopBarLable">Model</div>
            <div class="col-lg-9 NoPaddingLeft" id="ModelData">
            <select class="form-control chosen-select FilterSelectBoxRight" id="FilterModalBoxTop" name="modal" onChange="save_form()">
                <option value="">All Models</option>
                <?php
				foreach($carName as $id => $brnd)
				{
//$_POST['data']['Home']['model']
					?>
                    <option data-name="<?=$brnd?>" <?php if($_REQUEST['modal'] == $id||@$_POST['data']['Home']['model']==$id) { ?> selected <?php } ?> value="<?=$id?>"><?=$brnd?></option>
                    <?php
				}
				?>
            </select>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="FilterBoxTopBarSectoin">
            <div class="col-lg-3 FilerTopBarLable">Show</div>
            <div class="col-lg-9 NoPaddingLeft">
            <select class="form-control chosen-select FilterSelectBoxRight" name="recordOrder" onChange="save_form()">
                <option value="1">Most Recent</option>
                <option value="2">Price Low-High</option>
                <option value="3">Price High-Low</option>

                <option value="4">Most Viewed</option>
                <option value="5">Recommended</option>
                <option value="6">Best Selling</option>
            </select>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>

    <div class="clearfix" style="margin-bottom:10px;">&nbsp;</div>

    <div class="AppliedFilterNewRow" id="ApliendFilterLoad"></div>

    <div class="clearfix"></div>

    <div id="content">
    <?php
    foreach($showAllCar as $SAC)
    {
        $groupID_Saved = $SAC['Car']['groupid'];

        if($groupID_Saved == 5){
            $ADDITIONAL_PRICE_Val = 0;
            $ADDITIONAL_YEN_PRICE_Val = 0;
        }else{
            $ADDITIONAL_PRICE_Val = ADDITIONAL_PRICE;
            $ADDITIONAL_YEN_PRICE_Val = ADDITIONAL_YEN_PRICE;
        }

      if($SAC['Car']['publish']!=1)
         $sales = '<div class="ribbon"><span>Sold</span></div>';
      else if($SAC['Car']['groupid'] == 5)
          $sales = '<div class="ribbon"><span>ONE PRICE</span></div>';
        else
         $sales = '';

    ?>
    <a href="<?php echo $this->base;?>/home/car_show/<?=$SAC['Car']['id']?>" class="box">
    <div class="col-lg-3 NoPaddingLeft">
        <?php print $sales; ?>
        <div class="HomePagrCarListingDiv">
            <div class="CarListingStockPageImage text-xs-center"><img src="<?php echo $this->webroot.$SAC['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" title="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" style="width:100%"></div>

            <div class="HomePageListingCenterPart">
            <div class="HomePageCarNameDiv"><?php echo substr($SAC['CarName']['car_name'],0,20)?>...</div>

            <?php if($this->UserAuth->isLogged()){ ?>


			<div class="HomePageListingCarPrice hide col-lg-7">
            <?php
            if($this->Session->read('LANGUAGE') == 2)
            {
                echo "$ ". $this->Round->round_number(ceil($SAC['CarPayment'][0]['asking_price']+$ADDITIONAL_PRICE_Val));
            }
            else
            {
                echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($SAC['CarPayment'][0]['yen']+$ADDITIONAL_YEN_PRICE_Val));
            }
            ?>
            </div>
			<?php } ?>

            <?php
            if($SAC['Car']['new_arrival'] == 1)
            {
            ?>
            <div class="HomePageNewTag col-lg-3 pull-xs-right">New</div>
            <?php
            }
            ?>
            <div class="clearfix"></div>

            <div class="HomePageKilometerDiv">Kilometers : <?=$SAC['Car']['mileage']?> KM</div>
            <div class="HomePageCarTypeDiv"><?=$SAC['Car']['fuel']?> | <?=$SAC['Car']['transmission']?>

			<span class="HomePageCarPriceDiv" style="padding-left:20px;font-size:15px;">
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
            <div class="HomePageStockIdDiv">Stock Id - <?=$SAC['Car']['stock']?>
			<?php

					@$b = explode(' ',$SAC['Car']['manufacture_year']);
                    echo "<span style=\"color:#55b640; padding-left:19px;\">YEAR:</span>".@$b['1']."/".@$b['0'];
					?>

			</div>
            </div>
            <div class="clearfix">&nbsp;</div>

            <div class="ListingViewButton hvr-pulse-grow">View</div>

        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
    </a>
    <?php
    }
    ?>
    </div>

<div class="clearfix"></div>

<?php
$page_quot = (int)($this->Paginator->param('count') / 12);
$page_reminder = (int)($this->Paginator->param('count') % 12);
$tot_page = '';
if($page_reminder != 0){
    $tot_page = $page_quot + 1;
}else{
    $tot_page = $page_quot;
}

if($this->Paginator->param('count') > 12)
{
?>
<div style="background:#FFF; padding:10px" id="ListinViwMoreBut" >
    <div class="ListingViewButton hvr-pulse-grow" onClick="LoadMoreList()">Load More</div>
    <div class="clearfix"></div>
</div>
<?php
}
?>
    <input type="hidden" name="tot_page_count" id="tot_page_count" value="<?php echo $tot_page; ?>">
<div style="position:absolute; width:100%; left:0px; height:100%; top:0px; background:rgba(255,255,255,0.8); display:none" id="FilterLoadingDiv">
	<div style="background:#FFF; position:absolute; width:250px; height:250px; padding:25px; top:30%; left:30%"><img src="<?php echo $this->webroot;?>images/loading-green.gif"></div>
</div>
</div>

</form>
<div class="clearfix"></div>



<script type="text/javascript">

PriceMinimum = $("#RangePriceFrom").val();
PriceMaxmum = $("#RangePriceTo").val();

KMMinimum = $("#RangeKMFrom").val();
KMMaxmum = $("#RangeKMTo").val();

var slider = new Slider('#ex2', {});
slider.on("slide", function(slideEvt) {
	 val = $('#ex2').val();
	 var res = val.split(",");
	 $("#PriceFromRange").html(res[0]);
	 $("#PriceToRange").html(res[1]);
	 $("#RangePriceFrom").val(res[0]);
	 $("#RangePriceTo").val(res[1]);
});

var slider = new Slider('#ex3', {});
slider.on("slide", function(slideEvt) {
	 val = $('#ex3').val();
	 var res = val.split(",");
	 $("#KMFromRange").html(res[0]);
	 $("#KMToRange").html(res[1]);
	 $("#RangeKMFrom").val(res[0]);
	 $("#RangeKMTo").val(res[1]);
});

</script>

<script type="text/javascript">
page = 1;

PriceFilter = 0;
KMFilter = 0;

function FilterPriceStock()
{
	PriceFilter = 1;
	save_form();
}

function SetKMFilter()
{
	KMFilter = 1;
	save_form();
}

function RemovePriceFilter()
{
	PriceFilter = 0;
	$("#RangePriceFrom").val(PriceMinimum);
	$("#RangePriceTo").val(PriceMaxmum);

	$("#PriceFromRange").html(PriceMinimum);
	$("#PriceToRange").html(PriceMaxmum);

	$(".PriceRangeSlider").remove();

	<?php
	if($this->Session->read('LANGUAGE') == 2)
	{
	?>
		$("#PriceNewSlider").html('<div class="PriceRangeSlider"><input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?>" data-slider-step="5" data-slider-value="[0,<?=$this->Round->round_number(ceil($PriceRange[0]['max_price']+ADDITIONAL_PRICE))?>]"/></div>');
	<?php
	}
	else
	{
		?>
		$("#PriceNewSlider").html('<div class="PriceRangeSlider"><input id="ex2" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?>" data-slider-step="5" data-slider-value="[0,<?=$this->Round->round_number_yen(ceil($PriceRange[0]['max_price']+ADDITIONAL_YEN_PRICE))?>]"/></div>');
		<?php
	}
	?>

	var slider = new Slider('#ex2', {});
	slider.on("slide", function(slideEvt) {
		 val = $('#ex2').val();
		 var res = val.split(",");
		 $("#PriceFromRange").html(res[0]);
		 $("#PriceToRange").html(res[1]);
		 $("#RangePriceFrom").val(res[0]);
		 $("#RangePriceTo").val(res[1]);
	});

	save_form();
}

function RemoveKMFilter()
{
	KMFilter = 0;
	$("#RangeKMFrom").val(KMMinimum);
	$("#RangeKMTo").val(KMMaxmum);

	$("#KMFromRange").html(KMMinimum);
	$("#KMToRange").html(KMMaxmum);

	$(".KMRangeSlider").remove();

	$("#KMNewSlider").html('<div class="KMRangeSlider"><input id="ex3" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=floor($KMRange[0]['max_price'])?>" data-slider-step="5" data-slider-value="[0,<?=floor($KMRange[0]['max_price'])?>]"/></div>');

	var slider = new Slider('#ex3', {});
	slider.on("slide", function(slideEvt) {
		 val = $('#ex3').val();
		 var res = val.split(",");
		 $("#KMFromRange").html(res[0]);
		 $("#KMToRange").html(res[1]);
		 $("#RangeKMFrom").val(res[0]);
		 $("#RangeKMTo").val(res[1]);
	});

	save_form();
}

function save_form() {
	page = 1;
	$("#CurrentPage").val(page);
    jQuery(document).ready(function ($) {
		$("#FilterLoadingDiv").fadeIn('fast');
        $("#LeftPanelFilter").unbind('submit').bind('submit',function(e) {

			$("#ApliendFilterLoad").html('');

			content = '<div class="pull-left">Applied Filters : &nbsp; </div>';

			if(PriceFilter == 1)
			{
				content += '<div class="ApplienfilterColumn">Price : $ '+$("#RangePriceFrom").val()+' - $ '+$("#RangePriceTo").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemovePriceFilter()"></i></div>';
			}

			if(KMFilter == 1)
			{
				content += '<div class="ApplienfilterColumn">Kilometers : $ '+$("#RangeKMFrom").val()+' - $ '+$("#RangeKMTo").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveKMFilter()"></i></div>';
			}

			if($("#YearsFromFilter").val() != "")
			{
				content += '<div class="ApplienfilterColumn">Year From : '+$("#YearsFromFilter").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveYearFrom()"></i></div>';
			}

			if($("#YearsToFilter").val() != "")
			{
				content += '<div class="ApplienfilterColumn">Year To : '+$("#YearsToFilter").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveYearTo()"></i></div>';
			}

			if(document.getElementById("FilterTransmissionAuto").checked == true)
			{
				content += '<div class="ApplienfilterColumn">Transmission : Automatic &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveAuto()"></i></div>';
			}

			if(document.getElementById("FilterTransmissionManual").checked == true)
			{
				content += '<div class="ApplienfilterColumn">Transmission : Manual &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveManual()"></i></div>';
			}



			if(document.getElementById("FilterFulelGas").checked == true)
			{
				content += '<div class="ApplienfilterColumn">Fuel : Gasoline &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveGas()"></i></div>';
			}

			if(document.getElementById("FilterFulelDiesel").checked == true)
			{
				content += '<div class="ApplienfilterColumn">Fuel : Diesel &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveDiesel()"></i></div>';
			}

			if($("#FilterCCBox").val() != "")
			{
				content += '<div class="ApplienfilterColumn">CC : '+$("#FilterCCBox").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveCC()"></i></div>';
			}


			if($("#stockIdFiltersBox").val() != "")
			{
				content += '<div class="ApplienfilterColumn">Stock ID : '+$("#stockIdFiltersBox").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveStockId()"></i></div>';
			}


			if($("#ChassisNoFilterBox").val() != "")
			{
				content += '<div class="ApplienfilterColumn">Chassis No. : '+$("#ChassisNoFilterBox").val()+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveChassisNo()"></i></div>';
			}


			if($("#BradNamefiltrCob").val() != "")
			{
				obj = document.getElementById('BradNamefiltrCob');
				var myoption = obj.options[obj.selectedIndex];
				var uid = myoption.getAttribute('data-name');

				content += '<div class="ApplienfilterColumn">Brands : '+uid+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveBramd()"></i></div>';
			}


			if($("#FilterModalBoxTop").val() != "")
			{
				obj = document.getElementById('FilterModalBoxTop');
				var myoption = obj.options[obj.selectedIndex];
				var uid = myoption.getAttribute('data-name');

				content += '<div class="ApplienfilterColumn">Models : '+uid+' &nbsp; <i class="fa fa-times-circle" aria-hidden="true" onClick="RemoveModel()"></i></div>';
			}

			$("#ApliendFilterLoad").html(content);


            var formObj = $(this);
            var formURL = formObj.attr("action");
            if( window.FormData !== undefined ) {
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data:  formData,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function( data, textStatus, jqXHR ) {
                        $("#FilterLoadingDiv").fadeOut('fast');
						$("#content").html(data);
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {

                    }
                });
                e.preventDefault();
            }
        });
    });
	$("#LeftPanelFilter").submit();
}

function RemoveYearFrom()
{
	$("#YearsFromFilter").val('');
	save_form();
}
function RemoveYearTo()
{
	$("#YearsToFilter").val('');
	save_form();
}
function RemoveAuto()
{
	document.getElementById("FilterTransmissionAuto").checked = false;
	save_form();
}

function RemoveManual()
{
	document.getElementById("FilterTransmissionManual").checked = false;
	save_form();
}
function RemoveGas()
{
	document.getElementById("FilterFulelGas").checked = false;
	save_form();
}

function RemoveDiesel()
{
	document.getElementById("FilterFulelDiesel").checked = false;
	save_form();
}

function RemoveChassisNo()
{
	$("#ChassisNoFilterBox").val('');
	save_form();
}

function RemoveStockId()
{
	$("#stockIdFiltersBox").val('');
	save_form();
}
function RemoveCC()
{
	$("#FilterCCBox").val('');
	save_form();
}
function RemoveModel()
{
	$("#FilterModalBoxTop").val("");
	$('#FilterModalBoxTop').val('').trigger('chosen:updated');
	save_form();
}
function RemoveBramd()
{
	$("#BradNamefiltrCob").val("");
	$('#BradNamefiltrCob').val('').trigger('chosen:updated');
	$('#FilterModalBoxTop').val('').trigger('chosen:updated');
	save_form();
}

function LoadMoreList(){
    page++;
    $("#CurrentPage").val(page);
    var tot_page = document.getElementById("tot_page_count").value;
    $("#ListinViwMoreBut").css('display', 'none');
    jQuery(document).ready(function ($) {
        $("#LeftPanelFilter").unbind('submit').bind('submit',function(e) {
            $("#FilterLoadingDiv").fadeIn('fast');
            var formObj = $(this);
            var formURL = formObj.attr("action");

            if( window.FormData !== undefined ) {
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data:  formData,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function( data, textStatus, jqXHR ) {
                        $("#content").append(data);
                        if(page < tot_page){
                            $("#ListinViwMoreBut").css('display', 'block');
                        }
                        //$("ListinViwMoreBut").hide();
                        $("#FilterLoadingDiv").fadeOut('fast');
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                        //alert("Error__"+textStatus+"__"+errorThrown);
                        $("#ListinViwMoreBut").css('display', 'none');
                        $("#FilterLoadingDiv").fadeOut('fast');

                    }
                });
                e.preventDefault();
            }
        });
    });
    $("#LeftPanelFilter").submit();
}

function LoadMoreList_old()
{
	page++;
	$("#CurrentPage").val(page);
	$("#ListinViwMoreBut").css('display', 'none');
	jQuery(document).ready(function ($) {

        $("#LeftPanelFilter").unbind('submit').bind('submit',function(e) {
			$("#FilterLoadingDiv").fadeIn('fast');
            var formObj = $(this);
            var formURL = formObj.attr("action");

            if( window.FormData !== undefined ) {
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data:  formData,
                    mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function( data, textStatus, jqXHR ) {
						$("#content").append(data);
						$("#ListinViwMoreBut").css('display', 'block');
						$("#FilterLoadingDiv").fadeOut('fast');
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                        /*alert('No more data found.');
                        $("#ListinViwMoreBut").css('display', 'block');
                        $("#FilterLoadingDiv").fadeOut('fast');*/
                    }
                });
                e.preventDefault();
            }
        });
    });
	$("#LeftPanelFilter").submit();
}

function ChangeModel(value)
{
	save_form();
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


function ChangeModel2(value)
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
			jQuery("#ModelData").html(data);
			jQuery("#FilterModalBoxTop").chosen();
	                jQuery('#FilterModalBoxTop').val('<?php print $_REQUEST["model"] ?>').trigger("chosen:updated");
			save_form();
		}
	});
}




</script>

<?php

if($_REQUEST["make"] &&  $_REQUEST["model"])
{
?>
<script>
jQuery(window).load(function(){
   console.log ('hello111');
jQuery('#BradNamefiltrCob').val('<?php print $_REQUEST["make"] ?>').trigger("chosen:updated");
ChangeModel2('<?php print $_REQUEST["make"] ?>');


});
</script>
<?php
}
?>
