<!-- show All cars after seaching here-->
<?php //echo $this->Html->script(array('jquery-1.7.2.min','jquery-ui-1.8.21.custom.min','jquery.jcarousel.min','jquery.touchwipe.min','hover_transition_slider','jquery.lightbox.min'));?>

<?php
		$this->Home = ClassRegistry::init('Home');

	?>
<script>
	
$(function(){
	 

	jQuery("#makeId").chosen();
	jQuery("#modelId").chosen();  
	jQuery("#yearFromId").chosen();
	jQuery("#yearToId").chosen();
	jQuery("#quickCCId").chosen();
	jQuery("#locationId").chosen();
});	
</script>	
<div class="container back_user">
	
	<!-- Quick Search Form-->
			<div class="typesearch" id="new-arrival">			
			<h2>Quick Search</h2> 
		
		<?php echo $this->Form->create('Home',array('url'=>array('controller'=>'home','action'=>'/all_car'),'id'=>'searchCountry'));?>
		<div class="form-group col-sm-3">
			<label for="locationId">Location</label>
			  <?php 
			  echo $this->requestAction('home/showAllCar');
			 // pr($carDetail);
						$arr=array();
						foreach ($carDetail as $keyCarDet=>$valCarDet)
						{		
							
							$arr[@$valCarDet['Country']['id']] = @$valCarDet['Country']['country_name'];
				
						}
				echo $this->Form->input('country_name',array('type'=>'select','empty'=>'Any','options'=>$arr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'locationId')); 	
				?>
		</div>

		<div class="form-group col-sm-3">
			<label for="makeId">Make</label>

			  <?php 
					$arrBrand = array();
					foreach($Brand as $keyBrand=>$valBrand){
						$arrBrand[$valBrand['Brand']['id']] = $valBrand['Brand']['brand_name'];
						//pr($valBrand['Brand']['brand_name']);
					}	

				echo $this->Form->input('brand_name',array('type'=>'select','empty'=>'Any','options'=>$arrBrand,'class'=>'form-control','label'=>false,'div'=>false,'data-rel'=>'chosen','id'=>'makeId')); 	
				?>
		</div>

		
		<div class="form-group col-sm-3">
			<label for="modelId">Model</label>
			  <?php 
						
				$arrCarModel = array();
				foreach($carName as $keycarName=>$valcarName){
					$arrCarModel[$valcarName['CarName']['id']] = $valcarName['CarName']['car_name'];
					
				}
				echo $this->Form->input('model',array('type'=>'select','empty'=>'Any','options'=>$arrCarModel,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'modelId')); 	
				?>
		</div>

	 
		<div class="form-group col-sm-3"> 
			<label for="yearFromId" class="col-sm-12">Year</label>
			<div class="col-sm-6 mobfull">
			  <?php 
						//foreach($carManufaturer as $value){
						
							//@$b = explode(' ',$value['Car']['manufacture_year']);														
							
					//$arrYearFrom = array('2014'=>'2014','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006','2005'=>'2005','2004'=>'2004','2003'=>'2003','2002'=>'2002','2001'=>'2001','2000'=>'2000','1999'=>'1999','1998'=>'1998','1997'=>'1997');
				echo $this->Form->input('yearFrom',array('type'=>'select','empty'=>'From','options'=>$option_year,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId',)); 	
				?>
			</div>
			<div class="col-sm-6 mobfull">
				<?php 
	
				echo $this->Form->input('yearTo',array('type'=>'select','empty'=>'To','options'=>$option_year,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearToId')); 	
				?>	
				</div>
		</div>
				
	<!--<div class="form-group">
		<label for="" class="col-sm-12">Price Range</label>
		<div class="col-sm-5">
		  <?php 
				$arrPriceTo = array('0'=>'US$ 0','1000'=>'US$ 1,000','2000'=>'US$ 2,000','3000'=>'US$ 3,000','5000'=>'US$ 5,000','10000'=>'US$ 10,000','20000'=>'US$ 20,000');	

			echo $this->Form->input('priceFrom',array('type'=>'select','empty'=>'Any','options'=>$arrPriceTo,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId')); 	
			?>
		</div>
		<label class="col-sm-2 control-label">To</label>
			<div class="col-sm-5">
			<?php 
					
				$arrPriceFrom = array('1000'=>'US$ 1,000','2000'=>'US$ 2,000','3000'=>'US$ 3,000','5000'=>'US$ 5,000','10000'=>'US$ 10,000','20000'=>'US$ 20,000');
			echo $this->Form->input('priceTo',array('type'=>'select','empty'=>'Any','options'=>$arrPriceFrom,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'priceToId')); 	
			?>	
			</div>
			<div class="clearfix"></div>
		</div>-->	
		<div class="form-group col-sm-3">
			<label for="quickCCId">CC</label>
			  <?php 
					$arrCc = array('0,1000'=>'1000 CC and Less','1000,1500'=>'1000 CC - 1500 CC','1500,1800'=>'1500 CC - 1800 CC','1800,2000'=>'1800 CC - 2000 CC','2000,2500'=>'2000 CC - 2500 CC','2500,4000'=>'2500 CC - 4000 CC','4000,99999'=>'4000 CC and Over');

					echo $this->Form->input('cc',array('type'=>'select','empty'=>'Any','options'=>$arrCc,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'quickCCId')); 	
				?>
		</div>


		<div class="form-group col-sm-3">
			<label for="quickCCId" >Stock Id</label>
			  <?php
					echo $this->Form->input('stock',array('type'=>'text','class'=>'form-control','placeholder'=>'Stock ID','label'=>false,'data-rel'=>'','div'=>false,'id'=>'quickCCId')); 	
				?>
		</div>
		
		<div class="form-group col-sm-3">
			<label for="quickCCId" class="">Chassis No.</label>
			<div class="col-sm-9">
			  <?php
					echo $this->Form->input('cnumber',array('type'=>'text','class'=>'form-control','placeholder'=>'Enter Chassis no.','label'=>false,'data-rel'=>'','div'=>false,'id'=>'cnumber')); 	
				?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="col-sm-3">
			<?php  echo $this->Form->submit('Quick Search', array('class'=>'btn btn-danger','style'=>'margin-top:20px','div'=>false));?>
		</div>  
		<?php echo $this->Form->end();?>  
	</div>
	<!-- Quick Search Form-->
	<div class="clearfix"></div>
<div class="row car-details white-bg">
	<?php if(isset($brandName['Brand']['brand_name'])) {?>
	<div class="row">
			<!--<ol class="breadcrumb pull-left">
				<li><a href="<?//php echo $this->Html->url('/',true)?>"><?//php echo $countryName['Country']['country_name'];?></a></li>
				<li><a href="<?//php echo $this->Html->url(array('controller'=>'home','action'=>'allBrand','country'=>$countryName['Country']['id'],'brand'=>$brandName['Brand']['id']));?>"><?//php echo $brandName['Brand']['brand_name'];?></a></li>
				<li><?//php echo (isset($showAllCar[0]['CarName']['car_name']) && $showAllCar[0]['CarName']['car_name']) ?$showAllCar[0]['CarName']['car_name'] : "" ;?></li>
				
			</ol>-->
			<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'allBrand','country'=>$countryName['Country']['id'],'brand'=>$brandName['Brand']['id']));?>">Go Back</a>
		</div>
		<div class="row">
			
		</div>
	<?php } ?>
		
		
		<?php 
		//pr($showAllCar);
		if(!empty($showAllCar)){
		foreach($showAllCar as $key=>$value) {
			//$soldCar = (isset($value['CarPayment'][0]['user_id']) && $value['CarPayment'][0]['user_id'] == 0) ? "" : "sold";
			
		if($value['Car']['publish'] == '0' && $value['CarPayment'][0]['sale_price'] == null)
		{
			$soldCar ="hidden_car_img";
		}
		else
		{		
			if(isset($value['CarPayment'][0]['user_id']) && $value['CarPayment'][0]['user_id'] == 0)
			{
				$soldCar ="";
			}else
			{
				$soldCar ="sold";
			}
		}
		
			?>
		<!-- <h2>Select Cars</h2> -->
		<div class="col-md-12 car-showcase car-showcase-in">
			<div class="col-md-12"><h2><?php echo $value['CarName']['car_name']?></h2></div> 
			<div class="col-md-6">
				<div class="pikachoose">
					<div class="<?php echo $soldCar;?>"></div>
					
				<div class="slider" id="slider<?php echo $key;?>">
					
				</div>
					<ul class="slider_thumbnails" id="slider_thumbnails<?php echo $key;?>" >
						<?php if(!empty($value['CarImage'])){
							$str = array();
							 foreach($value['CarImage'] as $key1=>$value1){
								$imageSrc = $value1['image_source']; 
								$str[] = "'".$this->webroot.$value1['image_source']."'";?>
							
								<li>
									<a href="<?php echo $this->webroot.$imageSrc;?>" rel="lightbox[<?php echo $key;?>]" title=""><img src="<?php echo $this->webroot.$imageSrc;?>" class="img-thumbnail"/></a>
								</li>
							<?php } ?> 
							<?php 
							
							$str = implode(',',$str);
						} else {
							//$str = array();
							unset($str);
							$str = "'".$this->webroot."images/new_arrival01.png"."'";
							?>
							<li><a href="<?php echo $this->webroot;?>images/new_arrival01.png" rel="lightbox[<?php echo $key;?>]" title=""><img class="img-thumbnail" src="<?php echo $this->webroot;?>images/new_arrival01.png"/></a></li>
						<?php }?>
					</ul>
					
					<script type="text/javascript">
                        $(document).ready(function(){
                            var imgs = [<?php echo $str;?>];                            
                            $('#slider<?php echo $key;?>').append('<img src="<?php echo $this->webroot;?>img/loader.gif" id="slider_loader<?php echo $key;?>"/>');
                            
                            try{
                            $.preloadImages(imgs, function(){
                                $('#slider_loader<?php echo $key;?>').remove();
                                $('#slider<?php echo $key;?>').find('img:first').show();
                                $('#slider_thumbnails<?php echo $key;?>').imgSlider('#slider<?php echo $key;?>', imgs, 'right');                                
                            });
                            }catch(e){alert(e.message);}
                        });
                    </script>
				</div>
			</div>
			
				<div class="col-md-6">
				
					<h3><?php echo ++$key;?>. <?php echo $value['CarName']['car_name'].": ".$value['Car']['package']." Package ";?></h3>
					
					
					<table class="table table-bordered caps">
						
						<tr>
							<Td>Unique-Id</td>
							<Td><?php echo  $this->Home->removePushPrice( $value['Car']['uniqueid']);?></td>
						</tr>
						
						<tr>
							<Td>Chassis-No</td>
							<Td><?php echo $value['Car']['cnumber'];?></td>
						</tr>
						<tr>
							<Td>Stock-Id</td>
							<Td><?php echo $value['Car']['stock'];?></td>
						</tr>
						<tr>
							<Td>Year/Month</td>
							<!-- <Td><?php //echo date("Y/W", strtotime($value['Car']['pdate']));?></td> -->
							
							<Td><?php
		
							 @$b = explode(' ',$value['Car']['manufacture_year']);							
							 echo @$b['1']."/".@$b['0'];
							 
							  //echo $value['Car']['manufacture_year']."/".$value['Car']['manufacture_month'];
							 
							 ?></td>
						</tr>
						<tr>
							<Td>CC</td>
							<Td><?php echo $value['Car']['cc'];?> CC</td>
						</tr>
						<tr>
							<Td>Kilo-Meter</td>
							<Td><?php echo $value['Car']['mileage'];?> KM</td>
						</tr>
						<tr>
							<Td>Transmission</td>
							<Td><?php echo $value['Car']['transmission'];?></td>
						</tr>
						<!-- <tr>
							<Td>Lot-No</td>
							<Td><?php echo $value['Car']['lot_number'];?></td>
						</tr> -->
						<tr>
							<Td>Fuel</td>
							<Td><?php echo $value['Car']['fuel'];?></td>
						</tr>
						<tr>
							<Td>Handle</td>
							<Td><?php echo $value['Car']['handle'];?></td>
							
						</tr>
						<?php 
						
						if($value['CarPayment'][0]['sale_price'] != '')
						{ ?>
						<tr>
							<Td>Sold Date</td>
							<Td><?php echo date("d-m-Y",strtotime($value['CarPayment'][0]['updated_on']));?></td>
							
						</tr>	
							
						<?php } ?>
						
						<?php if($this->UserAuth->isLogged())
						{?>
						<tr>
							<td>Price($)</td>
							<td><?php echo $this->Round->round_number(ceil($value['CarPayment'][0]['asking_price'] + ADDITIONAL_PRICE));?></td>
						</tr>
						<tr>
							<td>Price(￥)</td>
							<td><?php echo $this->Round->round_number_yen(ceil($value['CarPayment'][0]['yen'] + ADDITIONAL_YEN_PRICE));?></td>
						</tr>	
						<?php if($this->Session->read('UserAuth.User.id') == FIXED_USER) {?>
						<tr>
							<td>Push Price</td>
							<td><?php echo $value['CarPayment'][0]['push_price'];?></td>
						</tr>	
							
						
							
						
						<?php } }?>
						
						
					</table>	
				
				</div>
			</div>	
		<?php }
		} else{               //here its check $showAllCar is empty or not
		 ?>
			<h2>No car found!</h2>
		<?php }?>
	
		
	<div class="clearfix"></div>



	
	
</div>
</div>
<script type="text/javascript">
	
$(function() {
    $('.slider_thumbnails a').lightBox();
});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	
$(function() {
$("#cnumber").autocomplete({
source: "<?php  echo $this->Html->url('/',true);?>home/chassis_list"
});
});
</script>

