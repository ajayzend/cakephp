<?php if($this->UserAuth->isLogged()){
	echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));
}else
{
	echo $this->Html->script(array('jquery-1.7.2.min','jquery-form'));
}
?>
<!-- Modal   	<div class="modal fade uk_kar" id="myModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<?php $carId ="";?>
<div class="modal fade uk_kar" id="myModal" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center" >UK Car Auction Bid Form</h4>
      </div>
      
		<div class="modal-body">
			
			<div id ="showmsg" class='showmsg alert alert-success' style="display:none;"></div>
			 <div class="modal_title_head"><strong>ENTER BID PRICE CAREFULLY. CANCELLATION CHARGES WOULD BE $1000.</strong></div>
			 <?php echo $this->Form->create('Bid',array('id'=>'BidForm')); ?>
					  <div class="form-group">
							<input type ="hidden" value="" name="car_id" id="car_id">
							<label class="col-md-3" for="exampleInputPassword1">Bid Amount</label>
							
							<div class="control-group col-md-3">
									<?php 
											$arr=array('$'=>'$','￥'=>'￥');
											
									echo $this->Form->input('currency_type',array('type'=>'select','options'=>$arr,'class'=>'form-control',"onchange"=>"myFunctionEdit()",'label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'monyId')); 	
									?>
							</div>
							
							<div class="col-md-5">
								<?php echo $this->Form->input('amount',array('type'=>'text','class'=>'form-control ','id'=>'bidAmount', 'label'=>false,'required'=>true,'placeholder'=>'Enter amount'));?>
							</div>
							<div class="clearfix"></div>
					  </div>
					  <div class="form-group">
							<label class="col-md-3" for="exampleInputPassword1">Min Bid</label>
							<div class="control-group col-md-3">
									<?php 
										$arr=array('$'=>'$','￥'=>'￥');
											
									echo $this->Form->input('moneyType',array('type'=>'select','options'=>$arr,'class'=>'form-control',"onchange"=>"myFunction('re_bid')",'label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'max_min_mony_id')); 	
									?>
							</div>
							<div class="col-md-5">	<input type="text" class="form-control " id="MaxBid" placeholder="" value="" readonly ='readonly'></div>
							<div class="clearfix"></div>
					  </div>
			 <?php echo $this->Form->end(); ?>
			 <div class='load' style="display:none;text-align:center;"><img src='<?php echo $this->Html->url('/',true);?>img/ajax-loaders/ajax-loader-5.gif' /></div>
			 
      </div>
      <div class="modal-footer">
		  
        <button type="button" class="btn btn-default" onClick="submitForm('BidForm')">Save</button>
        <button type="button" class="btn btn-danger" id="cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div class="container back_user">
	<div class="go-back-row"> 
	<a class=" btn btn-success pull-right go-back" href="<?php echo $this->Html->url(array('controller'=>'home','action'=>'arrival_car_list','brand'=>$this->request->params['named']['brand']));?>">Go Back</a>
	</div>
	
	
	<div class="typesearch" id="new-arrival">			
			<h2>Quick Search</h2> 

		<?php //echo $this->Form->create('Home',array( 'url'=>Router::url( $this->here, true )));?>
		<form accept-charset="utf-8" method="post" id="HomeArrivalShowForm" action="<?php echo $this->here;?>">
		<div class="form-group col-sm-3">
			<label for="makeId">Make</label>

			  <?php 
				
				echo $this->Form->input('brand_id',array('type'=>'hidden','value'=>$brandId,'class'=>'form-control')); 
				echo $this->Form->input('brand_name',array('type'=>'select','empty'=>'Any','options'=>$brandArr,'class'=>'form-control','label'=>false,'div'=>false,'data-rel'=>'chosen','id'=>'makeId')); 	
				?>
		</div>

		
		<div class="form-group col-sm-3">
			<label for="modelId">Model</label>
			  <?php 
						
				
				echo $this->Form->input('model',array('type'=>'select','empty'=>'Any','options'=>$carNameArr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'modelId')); 	
				?>
		</div>

	 
		<div class="form-group col-sm-3"> 
			<label for="yearFromId" class="col-sm-12">Year</label>
			<div class="col-sm-6">
			  <?php 
						
							
					$arrYearFrom = array('2014'=>'2014','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006','2005'=>'2005','2004'=>'2004','2003'=>'2003','2002'=>'2002','2001'=>'2001','2000'=>'2000','1999'=>'1999','1998'=>'1998','1997'=>'1997');
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
	
<div class="row car-details white-bg">
	
    <!--show all car here-->
		<?php 
		
		$this->Home = ClassRegistry::init('Home');

		if(!empty($showAllArrival)){
		foreach($showAllArrival as $key=>$value) {
			  
			$timer =  $value['Car']['new_arrival_date'];
			//$soldCar = (isset(($value['CarPayment'][0]['user_id']==0))) ? "" : "sold";
			$soldCar = (isset($value['CarPayment'][0]['user_id']) && $value['CarPayment'][0]['user_id'] == 0) ? "" : "sold";
			$Un_Id = $this->Home->removePushPrice($value['Car']['uniqueid']);

			?>
		<!-- <h2>Select Cars</h2> -->
		<div id="<?php echo $value['Car']['id']?>" class="col-md-12 car-showcase">
			<div class="col-sm-12"><h2 class="pull-left"><?php echo $value['CarName']['car_name']?></h2> <h4 class='pull-right' style="margin-top:60px; font-size:20px;"> 
				 <?php  if($timer !='')  
							echo "Bid Time : ".date('d-m-Y H:i:s',strtotime($timer)); 
						else
							echo "Bid Time : ".'0';	
				?>
				 
				 </h4></div> 
			<div class="col-md-6">
				<div class="pikachoose">
					<div class="<?php echo $soldCar;?>"></div>
					<div class="clearfix"></div>	
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
			
				<div class="col-md-6 car-showcase-in">
				
					<h3><?php echo ++$key;?>. <?php echo $value['CarName']['car_name']."-".$value['Car']['package']."- Package" ;?></h3>
					
					<table class="table table-bordered caps">
						<tr>
							<Td>Unique-Id</td>
							<Td><?php echo $Un_Id;?></td>
						</tr>
						<tr>
							<Td>Chassis-No</td>
							<Td><?php echo $value['Car']['cnumber'];?></td>
						</tr>
						<!--<tr>
							<Td>Stock Id</td>
							<Td><?php // echo $value['Car']['stock'];?></td>
						</tr>-->
						<tr>
							<Td>Year/Month</td>
							<!-- <Td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td> -->
							
							<Td><?php  @$b = explode(' ',$value['Car']['manufacture_year']);							
							 echo @$b['1']."/".@$b['0'];?></Td>
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
						
					</table>	
				
				</div>  
				<?php 
					
					$this->CarPayment = ClassRegistry::init('CarPayment');
					//$this->Car = ClassRegistry::init('Car');
					$this->Bid = ClassRegistry::init('Bid');
					$this->CarPayment->unbindModelAll();
					$this->Bid->unbindModelAll();
					
					$maxAmount = $this->CarPayment->find('all', array('conditions' => array('CarPayment.car_id' =>$value['Car']['id']), 'fields' => array('asking_price')));
					
					$currdate  = date('Y-m-d H:i:s');
					
					$userId =$this->UserAuth->getUserId();
					$userBidAmount = $this->Bid->find('first', array('conditions' => array('Bid.car_id' =>$value['Car']['id'],'Bid.currency_type'=>'$','Bid.user_id' =>$userId), 'fields' => array('amount','currency_type')));
					
					if($userBidAmount)
					{
						$user_bid = $userBidAmount['Bid']['amount'];
					}else
					{
						$user_bid = 0;
					}
					
					
					$maxBidAmount = $this->Bid->find('all', array('conditions' => array('Bid.car_id' =>$value['Car']['id'],'Bid.currency_type'=>'$'), 'fields' => array('MAX(Bid.amount) AS Amount','currency_type')));
					if(@$maxBidAmount[0][0]['Amount'] !='')
					{
						if(@$maxBidAmount[0][0]['Amount'] > @$maxAmount[0]['CarPayment']['asking_price'])
						{
							$amount1 = @$maxBidAmount[0][0]['Amount'];
							$amount = $amount1 + 300;
						}else
						{
							$amount = @$maxAmount[0]['CarPayment']['asking_price'] + 300;
						}
					}else
					{
						$amount = 0;
					}
					
					
					
					?>
					<?php 
						
					$currDate = date('Y-m-d H:i:s'); 
					
					 
					$duration_time = strtotime($timer) - strtotime($currDate);
					
					$minutes = intval(($duration_time / 60*60)); 
					if($minutes < '3600')
					{
						$class = 'readOnly';
					}else
					{
						$class = '';
					}

					
					//if(strtotime($currDate) >= strtotime($timer))
					if($minutes < '3600')
					{ ?>
						<div class="col-md-6">
						<button class="btn btn-primary expire_date"   id='expireDatePopupForBid' ><i class="fa fa-legal">&nbsp;</i>Bid Now</button>	
					</div>
					<?php }else
					{?>
					<div class="col-md-6">
						<a data-toggle="modal" data-id="<?php echo @$value['Car']['id'].'-'.@$amount.'-'.$user_bid.'-'.$class; ?>" class="btn btn-primary hint--bottom open-AddBookDialog" href="#myModal"  ><i class="fa fa-legal">&nbsp;</i>Bid Now</a>
						
					</div>
					<?php }
					
					 ?>
					
					
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
jQuery(document).ready(function(){
	jQuery("#makeId").chosen();
	jQuery("#modelId").chosen();  
	jQuery("#yearFromId").chosen();
	jQuery("#yearToId").chosen();
	jQuery("#quickCCId").chosen();
	jQuery("#locationId").chosen();
});	


	
	$('.expire_date').on('click', function(e){
	var msg = 'Bid time expire';
	var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" 	data-dismiss="modal">&times;</button><h3 class="text-error">Bid Form</h3></div><div class="modal-body"><div class="bootbox-body">'+msg+'</div></div><div class="modal-footer"><button class="btn btn-danger" type="button" onclick="bid_time_expire()"  data-dismiss="modal">OK</button></div></div></div>';
	$("#myModal").html(str);
	$("#myModal").modal("show");
	
   
});
	
function bid_time_expire()
{
	location.reload();
}	
			
	
$(document).on("click", ".open-AddBookDialog", function () {

   <?php if($this->UserAuth->isLogged())
   {?>
	   $("#myModal").modal('show'); 
     var spliData = $(this).data('id');
     var data=spliData.split("-");
     $(".modal-body #car_id").val(data[0]);
     $(".modal-body #bidAmount").val(data[2]);
     $(".modal-body #MaxBid").val(data[1]);
     if(data[3] == 'readOnly')
     {
		$('.modal-body #bidAmount').attr('readonly', true); 
	 }
     <?php } else {?>
		 var spliData = $(this).data('id');
		 var data=spliData.split("-");
		 var car_id = data[0];
		 var minAmount = data[1]; 
		 var str = '<div class="modal-dialog bid-auction-popup" >\
						<div class="modal-content">\
								<button type="button" class="close" data-dismiss="modal">&times;</button>\
						<div class="modal-body" onkeypress="userlogin(this,event,'+car_id+','+minAmount+',\' \')" >\
							<form class="col-sm-6">\
							<h4>Login</h4>\
									<div class=" errorMessage alert alert-danger" id="ErrorDiv"></div>\
								<div class="form-group row">\
									<label for="username">Username</label>\
									<input type="email" name="data[User][username]" class="form-control" id="email" placeholder=" Enter Username">\
								</div>\
								<div class="form-group">\
									<label for="password"> Password</label>\
									<input type="password" class="form-control" id="pass"  placeholder="Enter Password">\
								</div>\
							<button onclick="userlogin(this,event,'+car_id+','+minAmount+',\'txt\')" type="button"  class="btn btn-default">Login</button>\
							<button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>\
							</form>\
								 <form class="col-sm-6 bid-login " id="newbidform">\
								 <h4>New User</h4>\
									<div class="form-group">\
									<div id="messageDivIdAdd" style="display:none;" class="alert alert-success "></div>\
									<div id="errmessageDivIdAdd" style="display:none;" class="alert alert-danger"></div>\
										<label for="name">Name</label>\
										<input type="text" name="data[Bid][name]" class="form-control" placeholder="Name" id="name">\
									</div>\
									<div class="form-group">\
										<label for="contact">Contact No.</label>\
										<input type="text" name="data[Bid][cnumber]" class="form-control " id="contact" placeholder="Contact No">\
									</div>\
									<div class="form-group">\
										<label for="bid-amt">Email</label>\
										<input type="text" name="data[Bid][email]" class="form-control" id="bid-amt" placeholder="">\
									</div>\
									<div class="form-group class="col-md-6"">\
										<label for="bid-amt">Bid Amount</label>\
										<div class="row" >\
											<div class="col-md-6" style="padding:0px 15px 0px 0px !important;">\
												<select name="data[Bid][currency_type]" class="form-control">\
														<option value="$">$</option>\
														<option value="￥">￥</option>\
												</select>\
											</div>\
											<div class="col-md-6" style="padding:0px !important;">\
												<input type="text" name="data[Bid][amount]" class="form-control " id="bid-amt" placeholder="">\
												<input type="hidden" name="data[Bid][car_id]" value="'+car_id+'" class="form-control " placeholder="">\
											</div>\
										</div>\
									</div>\
									<button type="button" id="clientLogin" onClick="newUserSubmit(this,event,'+car_id+',\'txt\');" class="btn btn-default">Save</button>\
							<button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>\
							</form>\
							<div class="clearfix"></div> \
						</div>\
						</div>\
					</div>';
								
		$("#myModal").html(str);
		$("#myModal").modal("show");
		//$('#myModal').css('display', 'block');
		 <?php } ?> 
});
	



function userlogin(myform,e,car_id,minAmount,a){
	
			var keycode;
			if (window.event) keycode = window.event.keyCode;
			else if (e) keycode = e.which;
			else return true;

			if (keycode == 13 || a =='txt')
			   {
				var pass = $("#pass").val();
				var email = $("#email").val()
				
				if(email == undefined || pass == undefined){
				$("#ErrorDiv").html("Email or Password is incorrect");
					$("#ErrorDiv").show();
					alert('error');
				}else{
					
					
					$.ajax({
					url:"<?php echo $this->Html->url('/login',true);?>",
					type:"POST",
					data:{data:{User:{'ajaxCall':'true','username':email,'password':pass}}},
					dataType:"JSON",
					success:function(result)
					{
						if(result.status == 'success'){
							var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="" style="text-align:center">Bid Form</h3></div><div class="modal-body"><div id ="showmsg" class="showmsg alert alert-success" style="display:none"></div> <div class="modal_title_head"><strong>ENTER BID PRICE CAREFULLY. CANCELLATION CHARGES WOULD BE $1000.</strong></div><form id="BidFormLogin" ><div class="form-group row"><input type ="hidden" value='+ car_id+' name="car_id" id="car_id"><label class="col-md-3" for="exampleInputPassword1">Bid Amount</label><div class="col-md-8"><div class="control-group col-md-5"><select name="data[Bid][currency_type]" onchange= "myFunctionEdit(\'re_ed_bid\')" id="bid_form_money_type" class="form-control col-md-8"><option value="$">$</option><option value="￥">￥</option></select></div><div class="control-group col-md-7"><input type="text"  class="form-control col-md-8" id="bidAmountL" name="bidAmountL" placeholder=" Enter Amount"></div></div></div><div class="form-group"><label class="col-md-3" for="exampleInputPassword1">Min Bid</label><div class="col-md-8"><div class="control-group col-md-5"><select id="currencyType" onchange="myFunction(this)" name="data[Bid][moneyType]" class="form-control"><option value="$">$</option><option value="￥">￥</option></select></div><div class="control-group col-md-7"><input type="text" class="form-control " id="MaxBidL" placeholder="" value='+minAmount+' readonly ="readonly"></div></div></div></form><div style="display:none;text-align:center;" class="load"><img src="http://www.ukcarstokyo.com/img/ajax-loaders/ajax-loader-5.gif"></div></div><div class="modal-footer"><button type="button" class="btn btn-default" onClick="submitFormAfterLogin(\'BidFormLogin\')">Save</button><button type="button" class="btn btn-danger" id="cancelL" data-dismiss="modal">Cancel</button></div></div></div>';
							onloadbidamount(car_id,'$');
							$("#myModal").html(str);
							$("#myModal").modal("show");
							
							}else{
					
						$("#ErrorDiv").html(result.message);
						$("#ErrorDiv").show();
						
						
					}
						
					}
				});
					
				}
			   return false;
			   }
			else
			   return true; 
		}
	
	
	
$(function() {
	document.forms['BidForm'].reset();
    $('#BidFormLogin').trigger("reset");
       //document.forms['BidFormLogin'].reset();
    $('.slider_thumbnails a').lightBox();
}); 

$('#cancel').on('click', function(e){
    e.preventDefault();
    document.forms['BidForm'].reset();
    $('#BidFormLogin').trigger("reset");
    //document.forms['BidFormLogin'].reset();
    $("#showmsg").html('');
    location.reload();
   
});

$('#cancelL').on('click', function(e){
    e.preventDefault();
     document.forms['BidForm'].reset();
   // document.forms['BidFormLogin'].reset();
      $('#BidFormLogin').trigger("reset");
    $("#showmsg").html('');
    location.reload();

});



function myFunction(value)
{
	if(value == 're_bid')
	{
		var curr_type = $('#max_min_mony_id').val();
	}else
	{
		var curr_type = $('#currencyType').val();
	}
	var car_id = $('#car_id').val();
	 $.ajax({
				  url: "<?php  echo $this->Html->url('/',true);?>home/max_bid_with_currency",
				  type: "POST", 
				  data:{'curr_type':curr_type,'car_id':car_id},
				  beforeSend: function() {
						$('.load').show();
					},
				  success: function(response) 
				  {
					   $('.load').hide();
					    var obj = jQuery.parseJSON(response); 
						if(obj.status =='success')
						{ 												
							if(value == 're_bid')
							{
								if(curr_type == '$')
								{
									var amot = parseInt(obj.amount) + parseInt(300);
								}else
								{
									var amot = parseInt(obj.amount) + parseInt(30000);
								}
								
								if(obj.amount == null)
								{
									$('#MaxBid').val('0');
								}else
								{									
									$('#MaxBid').val(amot);
								}
								
							}else
							{
								if(obj.amount == null)
								{
									$('#MaxBidL').val('0');
								}else
								{									
									$('#MaxBidL').val(obj.amount);
								}
								
							}
						}
				  }
			});
	
}

function myFunctionEdit(value)
{
	if(value == 're_ed_bid')
	{
		var curr_type = $('#bid_form_money_type').val();
		var re_price = 'set_price';
	}else
	{
		var curr_type = $('#monyId').val();
		var re_price = '';
	}
	
	var car_id = $('#car_id').val();
	 $.ajax({
				  url: "<?php  echo $this->Html->url('/',true);?>home/max_bid_with_currency_by_user",
				  type: "POST", 
				  data:{'curr_type':curr_type,'car_id':car_id},
				   beforeSend: function() {
						$('.load').show();
					},
				  success: function(response) 
				  {
					   // $('.load').hide();
					    					   
					    var obj = jQuery.parseJSON(response);
					    if(re_price !='')
					    {
							if(obj.status =='success')
							{ 						
								$('#bidAmountL').val(obj.amount);
							}else
							{
								$('#bidAmountL').val(obj.amount);
							}
						}else
						{
							if(obj.status =='success')
							{ 						
								$('#bidAmount').val(obj.amount);
							}else
							{
								$('#bidAmount').val(obj.amount);
							}
						} 
						
						 setminbodprice(curr_type,car_id,re_price);
				  }
			});
	
}

function onloadbidamount(car_id,curr_type)
{
	
	
	 $.ajax({
				  url: "<?php  echo $this->Html->url('/',true);?>home/max_bid_with_currency_by_user",
				  type: "POST", 
				  data:{'curr_type':curr_type,'car_id':car_id},
				   beforeSend: function() {
						$('.load').show();
					},
				  success: function(response) 
				  {
					    $('.load').hide();
					    					   
						var obj = jQuery.parseJSON(response);
					
						if(obj.status =='success')
						{ 						
							$('#bidAmountL').val(obj.amount);
						}else
						{
							$('#bidAmountL').val(obj.amount);
						}
				  }
			});
	
}




function setminbodprice(curr_type,car_id,c)
{
	var car_id = $('#car_id').val();
	 $.ajax({
				  url: "<?php  echo $this->Html->url('/',true);?>home/max_bid_with_currency",
				  type: "POST", 
				  data:{'curr_type':curr_type,'car_id':car_id},
				  beforeSend: function() {
						$('.load').show();
					},
				  success: function(response) 
				  {
					   $('.load').hide();
					    var obj = jQuery.parseJSON(response); 
						if(obj.status =='success')
						{ 												
							
								if(curr_type == '$')
								{
									var amot = parseInt(obj.amount) + parseInt(300);
									$('#max_min_mony_id').val(curr_type);
								}else if(curr_type == '￥')
								{
									var amot = parseInt(obj.amount) + parseInt(30000);
									
									
									
								}
								//alert(c);
								if(c != '')
								{	//alert('tr1'+amot);
									$('#currencyType').val(curr_type);														
									if(obj.amount == null)
									{
										$('#MaxBidL').val('0');
									}else
									{									
										$('#MaxBidL').val(amot);
									}
								}else
								{
									$('#max_min_mony_id').val(curr_type);
									//alert('tr2'+amot);
									if(obj.amount == null)
									{
										$('#MaxBid').val('0');
									}else
									{									
										$('#MaxBid').val(amot);
									}
								}
								
									
							
						}
				  }
			});
	
}





function submitForm(form_id){
	
	var amount = $('#bidAmount').val();
	var maxAmount = $('#MaxBid').val();
	var mony_type = $('#monyId').val();
	if(amount  =='' || amount == null)
	{
		
		msg = "Bid Amount field can not be blank"; 
		$(".showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 8%;'><strong></strong>"+  msg+"</div>");
		
	}else if(isNaN(amount))  
	{
		
		msg ="Bid Amount should be numeric";
		$(".showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 8%;'><strong></strong>"+  msg+"</div>");
		return false;
	}
	else
	{
			$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/home/addbid',true);?>",
			type:"POST",
			data:{'min_amount':maxAmount},
			beforeSend: function() {
						$('.load').show();
					},
			success:function(result){
				$('.load').hide();
				var obj = jQuery.parseJSON(result);
			
				$(".showmsg").html(obj.message);
				$(".showmsg").show();
				$('#bidAmount').val("");
				$('.showmsg').delay(4000).fadeOut( "slow" );				
				location.reload();
					 			
			},
			failure: function(result)
			{
				$(".showmsg").html(obj.message);
				
			}
		});
	}
	

	}
	
	function submitFormAfterLogin(form_id){
		
	var amount = $('#bidAmountL').val();
	var maxAmount = $('#MaxBidL').val();
	var mony_type = $('#monyId').val();
	if(amount  =='' || amount == null)
	{
		
		msg = "Bid Amount field can not be blank"; 
		$(".showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong></strong>"+  msg+"</div>");
		
	}else if(isNaN(amount))  
	{
		
		msg ="Bid Amount should be numeric";
		$(".showmsg").html("<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong></strong>"+  msg+"</div>");
		return false;
	}
	else
	{
		
			$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/home/addBidAfterLogin',true);?>",
			type:"POST",
			data:{'min_amount':maxAmount},
			dataType:"JSON",
			beforeSend: function() {
						$('.load').show();
					},
			success:function(result){
				$('.load').hide();
				if(result.status == 'success')
				{
					$(".showmsg").html(result.message);
					$(".showmsg").show();
					$('#bidAmountL').val("");
					$('.showmsg').delay(4000).fadeOut("slow");
					location.reload();
				}
				else
				{
					alert("Data not added");
				}
					 			
			},
			failure: function(result)
			{
				$(".showmsg").html(result.status);
				
			}
		});
	}
	

	}
</script>
  <script>
  
	
<!--ajax call for submit bid form for new user-->
               function newUserSubmit(myform,event,id){
				  var formData = $("#newbidform").serialize();

				 $.ajax({
				   type: "POST",
				   url: "<?php echo $this->Html->url('/home/Guest',true);?>",
				   data: formData,
				   dataType:"JSON",
				   success: function(data){
					   if(data.status =='success'){
							$('.modal-backdrop').removeClass('in');
							$('#messageDivIdAdd').html(data.message);
							$('#messageDivIdAdd').show();
							$( '#messageDivIdAdd' ).delay(2000).fadeOut( "slow" );
							$('#myModal').hide();
							location.reload();
						}else{
							
							    $('#errmessageDivIdAdd').show();
                              for( var i in data.message ){
								 msg = data.message[i];
								$('[name = "data[Bid]['+String(i)+']"]').focus();
								 $("html, body").animate({ scrollTop: 150 }, "fast");
								break;
							 }
								$('#errmessageDivIdAdd').html(String(msg));
								$('#errmessageDivIdAdd' ).delay(2000).fadeOut( "slow" );
						
						}
				   }
				 });
				// event.preventDefault();
				// return false;  //stop the actual form post !important!


			  };
				
 
  </script>
  <!-- function for find all cars-->
  <script>
	  
	  function findAllCar(){
		  
		  $.ajax({
			  url: "<?php  echo $this->Html->url('/',true);?>admin/cars/add_shipment",
			  method: 'get', 
			  data:{id:$(this).val()},
			  dataType: 'json',
			  success: function(response) {  
				
				}
			});
	 }
	  </script>

					
