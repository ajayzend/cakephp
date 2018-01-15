<?php echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));?>

<?php if($this->UserAuth->isLogged()){
	echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));
}
?>

<?php //echo $this->Html->script(array('jquery-1.7.2.min','jquery-ui-1.8.21.custom.min','jquery.jcarousel.min','jquery.touchwipe.min','hover_transition_slider','jquery.lightbox.min'));?>

<?php
		//echo $this->Html->script('jquery-1.7.2.min');
		//echo $this->Html->script('jquery-ui-1.8.21.custom.min');
		//echo $this->Html->script('jquery.jcarousel.min');
		//echo $this->Html->script('jquery.touchwipe.min.js');
		//echo $this->Html->css('jquery.lightbox');
?>
<div class="container back_user">
<div class="row car-details white-bg">
	
	<?php
	
	
	
	 if(isset($brandName['Brand']['brand_name'])) {?>
		<div class="row">
				
				<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'allstockList','country'=>$countryName['Country']['id'],'brand'=>$brandName['Brand']['id'],'type'=>'location'));?>">Go Back</a>
				
			</div>
			<div class="row">
				
			</div>
		<?php }  ?>   
		<div class="row">
			<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'allstockList','country'=>$this->request->params['named']['country'],'brand'=>$this->request->params['named']['brand'],'type'=>'location'));?>">Go Back</a>
		</div>
		
		<?php 
		
		$this->Home = ClassRegistry::init('Home');
		
		if(!empty($countrytype)){
		foreach($countrytype as $key=>$value) {
			$Un_Id = $this->Home->removePushPrice($value['Car']['uniqueid']);
		
			$soldCar = (isset($value['CarPayment']['user_id']) && $value['CarPayment']['user_id'] ==0 ) ? "" : "sold";
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
							<Td>Year/Month</td>
							<!-- <Td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td> -->
							
							<Td><?php //echo $value['Car']['manufacture_year']."/".$value['Car']['manufacture_month'];
							 @$b = explode(' ',$value['Car']['manufacture_year']);							
							 echo @$b['1']."/".@$b['0'];
							?></td>
						</tr>
						<tr>
							<Td>Chassis-No</td>
							<Td><?php echo $value['Car']['cnumber'];?></td>
						</tr>
						<?php if($value['Car']['engine_number'])
						{
						?>
							<tr>
								<Td>Engine-No</td>
								<Td><?php echo $value['Car']['engine_number'];?></td>
							</tr>
						<?php 
						}
						?>
						<tr>
							<Td>Kilo-Meter</td>
							<Td><?php echo $value['Car']['mileage'];?> KM</td>
						</tr>
						<tr>
							<Td>CC</td>
							<Td><?php echo $value['Car']['cc'];?> CC</td>
						</tr>
						<tr>
							<Td>Transmission</td>
							<Td><?php echo $value['Car']['transmission'];?></td>
						</tr>
						<tr>
							<Td>Fuel</td>
							<Td><?php echo $value['Car']['fuel'];?></td>
						</tr>
						<tr>
							<Td>Handle</td>
							<Td><?php echo $value['Car']['handle'];?></td>
						</tr>
						<tr>
							<Td>Unique-Id</td>
							<Td><?php echo $Un_Id;?></td>
						</tr>
						
						
						<tr>
							<Td>Stock-Id</td>
							<Td><?php echo $value['Car']['stock'];?></td>
						</tr>
						
						 
						
						
						<!-- <tr>
							<Td>Lot-No</td>
							<Td><?php echo $value['Car']['lot_number'];?></td>
						</tr> -->
						
						<?php if($this->UserAuth->isLogged())
						{?>
						<tr>
							<Td>Price($)</td>
							<Td><?php echo $this->Round->round_number(ceil($value['CarPayment']['asking_price'] + ADDITIONAL_PRICE));?></td>
						</tr>
						<tr>
							<Td>Price(￥)</td>
							<Td><?php echo $this->Round->round_number_yen(ceil($value['CarPayment']['yen'] + ADDITIONAL_YEN_PRICE));?></td>
						</tr>	
						<?php if($this->Session->read('UserAuth.User.id') == FIXED_USER) {?>
						<tr>
							<td>Push Price</td>
							<td><?php echo $value['CarPayment']['push_price'];?></td>
						</tr>	
						<?php }} ?>
						
						
						
					</table>	
				
				</div>
			</div>	
		<?php }
		} else{               //here its check $showAllCar is empty or not
		 ?>
			<h2>No Vehicle Found!</h2>
		<?php }?>
	
		
	<div class="clearfix"></div>



	
	
</div>
</div>
<script type="text/javascript">
$(function() {
    $('.slider_thumbnails a').lightBox();
});
</script>
