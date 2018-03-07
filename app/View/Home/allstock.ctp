<?php echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));?>

<?php if($this->UserAuth->isLogged()){
	echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));
}
?>
<!-- Modal -->
<?php $carId ="";?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">UK Car buy Form</h4>
      </div>
      <div class="modal-body">
			<div id ="showmsg"></div>
			 <?php //echo $this->Form->create(array('url'=>array('controller'=>'home'),'id'=>'BuyForm')); ?>
			 <form id='BuyForm' >
					  <div class="row">
						  <div class="modal_title_head"><strong>IF THE CAR GETS SAVED, IT WILL BE IN YOUR ACCOUNT THEN.</br>WARNING - CANCELLATION CHARGES WOULD BE $1000.</strong></div>
							<input type ="hidden" value="" name="car_id" id="car_id">
							<div class="col-md-12">
							    <label class="col-md-3" for="exampleInputPassword1">Amount</label>
							
								<div class="control-group col-md-3">
									<?php 
											$arr=array('$','￥');
											
									echo $this->Form->input('moneyType',array('type'=>'select','options'=>$arr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'monyId')); 	
									?>
								</div>
								<div class="control-group col-md-6">
									<?php echo $this->Form->input('amount',array('type'=>'text','class'=>'form-control','id'=>'buyAmount', 'label'=>false,'required'=>true,'placeholder'=>'Enter amount'));

									?>
								</div>
								
							</div>
						
					  </div>
					  </form>
					   <div class='load' style="display:none;text-align:center;"><img src='<?php echo $this->Html->url('/',true);?>img/ajax-loaders/ajax-loader-5.gif' /></div>
			 <?php //echo $this->Form->end(); ?>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="submitForm('BuyForm')">Save</button>
        <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="container back_user">
<div class="row car-details white-bg">
	<?php  if(isset($brandName['Brand']['brand_name'])) {?>
	<div class="row">
			
			
			
			
			<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'allstockList','brand'=>$this->request->params['named']['brand']));?>">Go Back</a>
		</div>
		<div class="row">
			
		</div>
	<?php } ?>
		  
		
		<?php 
		$this->Home = ClassRegistry::init('Home');
		if(!empty($showAllCar)){
		foreach($showAllCar as $key=>$value) {
			$groupID_Saved = $value['Car']['groupid'];

			if($groupID_Saved == 2){
				$ADDITIONAL_PRICE_Val = 0;
				$ADDITIONAL_YEN_PRICE_Val = 0;
			}else{
				$ADDITIONAL_PRICE_Val = ADDITIONAL_PRICE;
				$ADDITIONAL_YEN_PRICE_Val = ADDITIONAL_YEN_PRICE;
			}
			$soldCar = (isset($value['CarPayment'][0]['user_id']) && $value['CarPayment'][0]['user_id'] == 0) ? "" : "sold";

			$Un_Id = $this->Home->removePushPrice($value['Car']['uniqueid']);
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
							<td>Year/Month</td>
							<!-- <Td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td> -->
							
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
							<Td><?php echo $value['Car']['transmission'];?></td>
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
						
						<?php if($this->UserAuth->isLogged())
						{?>
						<tr>
							<td>Price($)</td>
							<td><?php echo $this->Round->round_number(ceil($value['CarPayment'][0]['asking_price'] + $ADDITIONAL_PRICE_Val));?></td>
						</tr>
						<tr>
							<td>Price(￥)</td>
							<td><?php echo $this->Round->round_number_yen(ceil($value['CarPayment'][0]['yen'] + $ADDITIONAL_YEN_PRICE_Val));?></td>
						</tr>
						<?php if($this->Session->read('UserAuth.User.id') == FIXED_USER) {?>
						<tr>
							<td>Push Price</td>
							<td><?php echo $value['CarPayment'][0]['push_price'];?></td>
						</tr>	
							
						
						<?php } } ?>
						
					</table>	
				<?php if($this->UserAuth->isLogged() && $soldCar=="")
  				 {?>
				<div class="">
						<a data-toggle="modal" data-id="<?php echo @$value['Car']['id']; ?>" class="btn btn-primary hint--bottom open-AddBookDialog" href="#myModal"><i class="fa fa-money">&nbsp;</i>Buy Now</a>	
				</div>
				<?php } ?>
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

$(document).on("click", ".open-AddBookDialog", function () {

   <?php if($this->UserAuth->isLogged())
   {?>
	   $("#myModal").show(); 
     var data=$(this).data('id');
     $(".modal-body #car_id").val(data);
<?php } ?>
});


function submitForm(form_id){

	var monyType= $('#monyId').val();
	var amount = $('#buyAmount').val();
	var car_id = $('#car_id').val();

	if(amount  =='' || amount == null)
	{
		
		msg = "Amount field can not be blank"; 
		$("#showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong></strong>"+  msg+"</div>");
		
	}else if(isNaN(amount))  
	{
		
		msg ="Amount should be numeric";
		$("#showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong></strong>"+  msg+"</div>");
		return false;
	}
	else
	{
			$.ajax({
				type: "POST",
				url: "<?php echo $this->Html->url('/home/buyCar',true);?>",
				data:{'amount':amount,'car_id':car_id,'monyType':monyType},
				beforeSend: function() {
						$('.load').show();
					},
                dataType:'json',
				success:function(result)
				{
					$('.load').hide();
					if(result.status =='success')
					{
						$("#showmsg").html("<div class='alert alert-success' style='color:green;margin-bottom: 2%;text-align:center'><strong>Success-  </strong>"+result.message+"</div>");
						$('#buyAmount').val(" ");
						//$('#showmsg').delay(1000).fadeOut( "slow" );
					}
					else
					{
						$("#showmsg").html("<div class='alert alert-danger' style='color:red;margin-bottom: 2%;text-align:center'><strong>Error-  </strong>"+result.message+"</div>");
						$('#buyAmount').val(" ");
						//$('#showmsg').delay(1000).fadeOut( "slow" );
					}
					location.reload();
					 			
				},
				failure: function(result)
				{
					$("#showmsg").html("<div style='color:red;margin-bottom: 2%;text-align:center'><strong>Error-  </strong>Network Failure</div>");
					location.reload();
					
				}
			});
	}
}


$(function() {
    $('.slider_thumbnails a').lightBox();
});

$(function(){
get_jpy_price();

});


 function get_jpy_price(){
		$.ajax({
				'url':'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20%28%22USDJPY%22%29&format=json&env=store://datatables.org/alltableswithkeys',
				'type':'get',
				"dataType":'json',
				'success':function(obj){
					
							var newRate = Math.floor(obj.query.results.rate.Rate) -1 ;	
							$.ajax({
							url:"<?php echo $this->Html->url('current_doller_to_yen_rate',true);?>",
							type:'POST',
							data:{'newrate':newRate},
							success:function(result)
							{
								
							}					
						});
					
				},
				'error':function(error){
						alert(error);
					
					
					}
			
			
		});
	
	
}

</script>
