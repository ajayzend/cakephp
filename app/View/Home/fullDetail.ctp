<?php
?>
<script>
$(function(){
	jQuery("#makeId").chosen();
	jQuery("#modelId").chosen();  
	jQuery("#yearFromId").chosen();
	jQuery("#yearToId").chosen();
	jQuery("#quickCCId").chosen();
});	
</script>	


<?php $carId ="";?>

<div class="modal fade uk_kar" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center" >UK Car Auction Bid Form</h4>
      </div>
      
		<div class="modal-body">
			 <?php echo $this->Form->create('Bid',array('id'=>'BidForm')); ?>
					
					  <div class="form-group row">
							<input type ="text" value="" name="car_id" id="car_id">
							<label class="col-md-3" for="exampleInputPassword1">Bid Amount</label>
							<div class="col-md-8">
								<?php echo $this->Form->input('amount',array('type'=>'text','class'=>'form-control col-md-8"','label'=>false,'required'=>true,'placeholder'=>'Enter amount'));?>
								</div>
					  </div>
					  <div class="form-group">
							<label class="col-md-3" for="exampleInputPassword1">Max Bit</label>
						<div class="col-md-8">	<input type="text" class="form-control " id="exampleMaxBit" placeholder="" value="13000$" readonly ='readonly'></div>
					  </div>
			 <?php echo $this->Form->end(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="submitForm('BidForm')" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container back_user">
	<?php if(isset($vehicleTypeId)) {?>
		<div class="row">
		<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'arrival_car_brand','brand'=>$this->request->params['named']['brand'],'type'=>$vehicleTypeId));?>">Go Back</a>
	</div>
	<div class="typesearch" id="new-arrival">			
			<h2>Quick Search</h2> 

		<?php //echo $this->Form->create('Home',array( 'url'=>Router::url( $this->here, true )));?>
		<form accept-charset="utf-8" method="post" id="SearchCarTypeForm" action="<?php echo $this->here;?>">
		<div class="form-group col-sm-3">
			<label for="makeId">Make</label>

			  <?php 
				
				echo $this->Form->input('brand_id',array('type'=>'hidden','value'=>$brandId,'class'=>'form-control'));
				echo $this->Form->input('vehicleType',array('type'=>'hidden','value'=>$vehicleTypeId,'class'=>'form-control')); 
				
				//,'selected'=>$brandId
				echo $this->Form->input('brand_name',array('type'=>'select','empty'=>'Any','options'=>$brandArr,'class'=>'form-control','label'=>false,'div'=>false,'data-rel'=>'chosen','id'=>'makeId')); 	
				?>
		</div>

		
		<div class="form-group col-sm-3">
			<label for="modelId">Model</label>
			  <?php 
						
				//,'selected'=>$carNameId
				echo $this->Form->input('model',array('type'=>'select','empty'=>'Any','options'=>$carNameArr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'modelId')); 	
				?>
		</div>

	 
		<div class="form-group col-sm-3"> 
			<label for="yearFromId" class="col-sm-12">Year</label>
			<div class="col-sm-6">
			  <?php 
						
							
					//$arrYearFrom = array('2014'=>'2014','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006','2005'=>'2005','2004'=>'2004','2003'=>'2003','2002'=>'2002','2001'=>'2001','2000'=>'2000','1999'=>'1999','1998'=>'1998','1997'=>'1997');
				echo $this->Form->input('yearFrom',array('type'=>'select','empty'=>'From','options'=>$option_year,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId',)); 	
				?>
			</div>
			<div class="col-sm-6">
				<?php 
						
				echo $this->Form->input('yearTo',array('type'=>'select','empty'=>'To','options'=>$option_year,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearToId')); 	
				?>	
				</div>
		</div>
			
		<div class="form-group col-sm-3">
			<label for="quickCCId">CC</label>
			  <?php 
					$arrCc = array('0,1000'=>'1000 CC and Less','1000,1500'=>'1000 CC - 1500 CC','1500,1800'=>'1500 CC - 1800 CC','1800,2000'=>'1800 CC - 2000 CC','2000,2500'=>'2000 CC - 2500 CC','2500,4000'=>'2500 CC - 4000 CC','4000,99999'=>'4000 CC and Over');

					echo $this->Form->input('cc',array('type'=>'select','empty'=>'Any','options'=>$arrCc,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'quickCCId')); 	
				?>
		</div>


		<div class="col-sm-12">
			<?php  echo $this->Form->submit('Quick Search', array('class'=>'btn btn-danger pull-right','style'=>'margin-top:20px','div'=>false));?>
		</div>  
		<?php echo $this->Form->end();?>  
	</div>
	
	<?php }?>
<div class="row car-details white-bg">
		
		<?php 
		$this->Home = ClassRegistry::init('Home');

		if(!empty($showAllArrival)){
		foreach($showAllArrival as $key=>$value) { 
			$Un_Id = $this->Home->removePushPrice($value['Car']['uniqueid']);

			?>
		<!-- <h2>Select Cars</h2> -->
		<div id="<?php echo $value['Car']['id']?>" class="col-md-12 car-showcase">
			<h2><?php echo $value['CarName']['car_name']?></h2> 
			<div class="col-md-6">
				<div class="pikachoose">
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
							<?php $str = implode(',',$str);
						} else {
							$str = "'".$this->webroot."images/new_arrival01.png"."'";
							?>
							<li><a href="<?php echo $this->webroot;?>images/new_arrival01.png" title=""><img class="img-thumbnail" src="<?php echo $this->webroot;?>images/new_arrival01.png"/></a></li>
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
				
					<h3><?php echo ++$key;?>. <?php echo $value['CarName']['car_name']." ".$value['Car']['package']."- Package ";?></h3>
					
					
					<table class="table table-bordered caps">
						<tr>
							<td>Year/Month</td>
							<!-- <td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td> -->
							
							<td><?php //echo $value['Car']['manufacture_year']."/".$value['Car']['manufacture_month'];
							 @$b = explode(' ',$value['Car']['manufacture_year']);							
							 echo @$b['1']."/".@$b['0'];
							?></td>
						</tr>
						<tr>
							<td>Chassis-No</td>
							<td><?php echo $value['Car']['cnumber'];?></td>
						</tr>
						<?php if($value['Car']['engine_number'])
						{
						?>
							<tr>
								<td>Engine-No</td>
								<td><?php echo $value['Car']['engine_number'];?></td>
							</tr>
						<?php 
						}
						?>
						<tr>
							<td>Kilo-Meter</td>
							<td><?php echo $value['Car']['mileage'];?> KM</td>
						</tr>
						<tr>
							<td>CC</td>
							<td><?php echo $value['Car']['cc'];?> CC</td>
						</tr>
						<tr>
							<td>Transmission</td>
							<td><?php echo $value['Car']['transmission'];?></td>
						</tr>
						<tr>
							<td>Fuel</td>
							<td><?php echo $value['Car']['fuel'];?></td>
						</tr>
						<tr>
							<td>Handle</td>
							<td><?php echo $value['Car']['handle'];?></td>
						</tr>
						<tr>
							<td>Unique-Id</td>
							<td><?php echo $Un_Id;?></td>
						</tr>
						
						
						<tr>
							<td>Stock-Id</td>
							<td><?php echo $value['Car']['stock'];?></td>
						</tr>
						
						 
						
						
						<!-- <tr>
							<td>Lot-No</td>
							<td><?php echo $value['Car']['lot_number'];?></td>
						</tr> -->
						
						
						<?php if($this->UserAuth->isLogged() && $value['Car']['publish'] !=0 )
						{?>
						<tr>
							<td>Price($)</td>
							<td><?php echo $this->Round->round_number(ceil($value['CarPayment']['asking_price'] + ADDITIONAL_PRICE));?></td>
						</tr>
						<tr>
							<td>Price(￥)</td>
							<td><?php echo $this->Round->round_number_yen(ceil($value['CarPayment']['yen'] + ADDITIONAL_YEN_PRICE));?></td>
						</tr>	
						<?php if($this->Session->read('UserAuth.User.id') == FIXED_USER) {?>
						<tr>
							<td>Push Price</td>
							<td><?php echo $value['CarPayment']['push_price'];?></td>
						</tr>	
							
						
							
						
						<?php }}?>
						
						
					</table>	
				
				</div>
			</div>	
		<?php }
		} else{               //here its check $showAllCar is empty or not
		 ?>
			<h2>No Vehicle Found!</h2>
		<?php }?>
	
		
	<div class="clearfix"></div><hr/>



	
	
</div>
</div>
<script type="text/javascript">
	
$(document).on("click", ".open-AddBookDialog", function () {
     var carId = $(this).data('id');
     $(".modal-body #car_id").val(carId);
});
	
	
	
	
$(function() {
    $('.slider_thumbnails a').lightBox();
});

function submitForm(form_id){
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/home/addbid',true);?>",
			type:"POST",
			success:function(result){
				console.log(result);
			},
			failure: function(result)
			{
				console.log(result);
			}
				
			
		});
	}
</script>
			
