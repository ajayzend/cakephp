<?php
foreach($showAllCar as $SAC)
{
?>
<a href="<?php echo $this->base;?>/home/car_show/<?=$SAC['Car']['id']?>">
<div class="col-lg-3 DivPadding5PX">
	<div class="HomePagrCarListingDiv">
		<div class="CarListingStockPageImage text-xs-center"><img src="<?php echo $this->webroot.$SAC['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" title="<?php echo $this->webroot.$SAC['CarName']['car_name']?>" style="width:100%"></div>
		
		<div class="HomePageListingCenterPart">
		<div class="HomePageCarNameDiv"><?php echo substr($SAC['CarName']['car_name'],0,20)?>...</div>
		
		
        
        <?php
		if($SAC['Car']['new_arrival'] == 1)
		{
		?>
        <div class="HomePageNewTag col-lg-3 pull-xs-right">New</div>
        <?php
		}
		?>
        
        <div class="HomePageKilometerDiv" style="margin-top:0px;"  >Kilometers : <?=$SAC['Car']['mileage']?> KM</div>
        <div class="HomePageCarTypeDiv"><?=$SAC['Car']['fuel']?> | <?=$SAC['Car']['transmission']?>
			
			
												<span class="HomePageCarPriceDiv" style="padding-left:20px;font-size:15px;">
<?php
			if($this->UserAuth->isLogged()){ ?>
           <?php
			if($this->Session->read('LANGUAGE') == 2 )
			{
				echo "$ ". $this->Round->round_number(ceil($SAC['CarPayment'][0]['asking_price'] + ADDITIONAL_PRICE));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($SAC['CarPayment'][0]['yen'] + ADDITIONAL_YEN_PRICE));
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
<div class="clearfix"></div>