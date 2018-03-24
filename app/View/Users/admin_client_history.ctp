<?php echo $this->Html->css(array('select2'));?>
<?php echo $this->Html->script(array('select2.min'));?>
<script type="text/javascript">


function showHistory()
{
	var Uid = $('#client_id').val();
	var fromdate = $('#date01').val();
	var todate = $('#date02').val();  
	var datas  =  {'id':Uid,'from':fromdate,'todate':todate}; 

	$.ajax({
		url:"<?php echo $this->Html->url('/admin/users/paymentHistory',true);?>",
		type:"POST",
		data:datas,
		success:function(result)
		{
			$('#show_pay_sale_his').html(result);
		}					
	});	
}

function editPayment(id,client_id)
{
	window.location.href= "<?php echo $this->Html->url('/admin/users/editPayment/',true)?>"+id+'/'+client_id;
}


 

 
 
 $(function(){
$('#hideDiv').delay(4000).fadeOut( "slow" );
});
 //$('#hideDiv').delay(5000).fadeOut(400);
 //$(document).ready(function(){
//	$('#hideDiv').fadeIn('fast').delay(10000).hide(0);
 //});
 
$(function() {
    $(".datepicker").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+40'});
    /* $("#date03").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date04").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date05").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date06").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});*/
});

	
	 $(function(){	 
    $('#selectbox-a').select2({

    minimumInputLength: 2,
    ajax: { 
    url: '<?php echo $this->Html->url('chassisSearch',true);?>/'+$("#client_id option:selected").val(),
    dataType: 'json',
    
    data: function (term, page) {
    return {
    q: term
    };
    },
    results: function (data, page) {
	
    return { results: data };
    }
    }
    });
    });

$(function()
		{ 
			$("#selectbox-a").change(function()
			{
				//alert($("#s2id_selectbox-a .select2-choice span").html()+'---'+$("#selectbox-a").val()+'--'+$("#client_id option:selected").val());
				$.ajax({
					url:"<?php echo $this->Html->url('all_history_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-a .select2-choice span").html(),id:$("#selectbox-a").val(),client_id:$("#client_id option:selected").val()},
					dataType:"html",
					beforeSend: function() {
					  $("#loading1").show();
				   },
					success:function(result)
					{
						$("#loading1").hide();
						$('#all_history_data').html(result);
						$('#showAllUsrDivBtn').show();
					}
				});
		});
	   
	}); 

$(function()
		{
			$("#clearSearchHistory").click(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('clear_all_history_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-a").html(),id:$("#selectbox-a").val(),client_id:$("#client_id option:selected").val()},
					dataType:"html",
					beforeSend: function() {
					  $("#loading1").show();
				   },
					success:function(result)
					{
						$("#loading1").hide();	
						$('#all_history_data').html(result);
						$(".select2-choice span").html("Enter chechis no for search");
						//$("#selectbox-a").val("");
						$('#showAllUsrDivBtn').hide();

					}
				});
		});
	   
	}); 


</script>





<div id="content1"> 
	

	
	
			<!-- content starts -->

			
			<div class="row sortable">
<div class="box col-md-12">
					<div class="box-header  well" >
						<h2 class="col-md-12"><i class="fa fa-list"></i> Client Payment History <?php echo $this->Session->read('dtoy') ;?>
						
						<div class="pull-right">

						<?php echo $this->Html->link(__("Add Payment",true),"/admin/users/addPayment/".$selectedListId,array('class'=>'btn btn-primary fa fa-plus-circle')) ?>
						<?php echo $this->Html->link('Go Back',array('action' => 'allUsers'),array('class'=>'btn btn-primary'));?>  
							
							

						</div>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="box-content"><!-- clientHistory -->
						<div id="hideDiv">
										<?php
										$success = $this->Session->flash(); 
										if($success) {?>
										
											<div class="alert alert-success">
											<strong><?php echo $success ;?></strong>
											</div>
										
										<?php }?>
									</div>
							<?php echo $this->Form->create('Users', array('action' => "",'class'=>'form-horizontal','style'=>'margin-bottom:20px;')); ?>
									<div class="col-sm-4">
											<?php 
											$arr=array();
											/*foreach ($ClientDetails as $key=>$val)
											{
												$id = $key;
												foreach ($val as $v=>$k)
												{
													$name = strtoupper($v." ".$k."[".$id."]");
													$arr[$id]=$name;
												}
											}*/
											 	
												 echo $this->Form->input('client_name',array('type'=>'select','options'=>$ClientDetails,'class'=>'input-xlarge form-control','label'=>false,'data-rel'=>'chosen','id'=>'client_id','selected'=>$selectedListId)); 	
											?>												
											<!--<input type="hidden" value="<?php //echo $id ; ?>" id="hidId" />-->
												
										</div>
										<div class="col-sm-3">
										<?php echo __('From Date');?>&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" class="input-xlarge datepicker  form-control" id="date01" placeholder="From Date" name="fromdate" value="" style="width:60%;">
										</div>
										<div class="col-sm-3">
											<?php echo __('To Date');?> &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" class="input-xlarge datepicker  form-control" placeholder="To Date" id="date02" name="todate" value="" style="width:60%;">
										</div>
										<div class="col-sm-2">
											<?php echo $this->Form->Submit('Search',array('type'=>'button','class'=>'btn btn-primary payment','id'=>'pay_sub','onClick'=>'showHistory();'));?>
										</div>
							</form>			
						</div>
					</div>
				</div>
			<div class="row">	
			<div class="myloader" id="loading2" style="display:none;">
						<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
				</div>
			<div class="myloader" id="myloader" style="display:none;">
						<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
				</div>	
			<div class="box col-md-12">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#bal-overview" role="tab" data-toggle="tab">Balance Overview</a></li>
					<li><a href="#pay-his" role="tab" data-toggle="tab">Payment History</a></li>
					<li><a href="#buy-his" role="tab" data-toggle="tab">Buy History</a></li>
					<li><a href="#sale-his" role="tab" data-toggle="tab">Sale History</a></li>
					<li><a href="#all-his" role="tab" data-toggle="tab">All History</a></li>
				</ul>
				<div class="tab-content" id="show_pay_sale_his">
					<div class="tab-pane fade in active" id="bal-overview"><!--balance-overview-->
						<h3>In dollar ($)</h3>
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr>
									  <th>Sale Price($) </th>
									  <th>Payment($)</th>
									  <th>Balance($)</th>
									 <!-- <th>Balance(￥)</th>-->
																			
								  </tr>
							  </thead >   
							  <tbody >
								<tr>
									<td><?php echo $sTotal;?></td>
									<td class="center"><?php echo $pTotal;?></td>
									<td class="center"><?php echo $balanceTotal;?></td>
							 		<!-- <td class="center"><?php // echo $balanceTotalYen;?></td>-->
						    				    								  
								</tr>
																  
							  </tbody>
						 </table>  
						 <div class='clearfix'></div>
						 
						 <h3>In yen (￥)</h3>
						 <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr>
									  <th>Sale Price(￥) </th>
									  <th>Payment(￥)</th>
									  <th>Balance(￥)</th>
									 
																			
								  </tr>
							  </thead >   
							  <tbody >
								<tr>
									<td><?php echo $sYenTotal ;?></td>
									<td class="center"><?php echo $pTotalYen ;?></td>
									<td class="center"><?php echo $balanceYenTotal ;?></td>
								</tr>
																  
							  </tbody>
						 </table>   
					</div><!--balance-overview-->
					
					
				  <div class="tab-pane fade" id="pay-his"><!--Payment History-->
						<div class="box-header payment_header well">
							<div class="col-md-4">
							
							<?php // echo __('From Date');?><input type="text" class="input-xlarge datepicker  form-control" id="date03" name="fromdate"   placeholder="From Date" value="" >
							</div>
								
							<div class="col-md-4">
								<?php // echo __('To Date');?> <input type="text" class="input-xlarge datepicker  form-control" id="date04" name="todate" placeholder="To Date" value="" >
							</div>
							
							<div class="col-md-4">												
								
							<input type="button" id="payButton" value="Search" class="btn btn-primary payment" >
							<input type="button" id="payCancelButton" style="display:none;" value="Clear Search" class="btn btn-primary payment" >	
							</div>
							
							
							<div class="clearfix"></div>
							<div id="showMessage"></div>
							<div>
								
								<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>	-->												
							</div>
						</div>
						<div class="box-content" style="max-height:600px; overflow:auto;"><!--  style="max-height:600px; overflow:auto;" -->
							<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
								  <thead>
									  <tr>
										  <th><?php echo __('S.No.');?></th>
										 <!-- <th><?php //echo __('Client Id');?></th> -->
										  <th> <?php echo __('Date');?></th>
										  <th> <?php echo __('Payment')."($)";?></th>
										   <th> <?php echo __('Payment')."(￥)";?></th>
										  <th> <?php echo __('Remark');?></th>
										  <th> <?php echo __('Action');?></th>                                          
									  </tr>
								  </thead>   
								  <tbody id="payDetail"> 
								<?php
								$count = 1;  
								if($PaymentDetails)
								{
								
								foreach($PaymentDetails as $val) {?>
									<tr id='<?php echo "tr".$val['ClientPaymentHistory']['id'] ;?>' >
										<td class="center"><?php  echo $count; //$val['ClientPaymentHistory']['id'] ; ?></td>
										<!--<td class="center"><?php  //echo $val['ClientPaymentHistory']['client_id'] ; ?></td> -->
										<td class="center">
												<?php 
													$originalDate = $val['ClientPaymentHistory']['payment_date']; 
													$newDate = date("d-m-Y", strtotime($originalDate));
													echo $newDate;
												?>
										</td>
										<td class="center"><?php  echo $val['ClientPaymentHistory']['amount'] ; ?></td>
										<td class="center"><?php  echo $val['ClientPaymentHistory']['yen_amount'] ; ?></td>
										<td class="center"><?php  echo $val['ClientPaymentHistory']['remark'] ; ?></td>
										<td class="center">
										<input type="button" onClick="payDelete('<?php echo $val['ClientPaymentHistory']['id'] ;?>');" 	class="btn btn-danger"  value="Delete" />
										<input type="button" onClick="editPayment('<?php echo $val['ClientPaymentHistory']['id'] ;?>','<?php echo $val['ClientPaymentHistory']['client_id'] ;?>');" 	class="btn btn-success"  value="Edit" />	
											
										</td>                                       
									</tr>
							  <?php $count++;}}else{ ?>
							<tr><td colspan="10" style="text-align:center">Payment History not found</td></tr>												  
							<?php }?>												  
								  </tbody>
							 </table>  
						</div>
				  </div><!--Payment History-->
				  
				  
					<div class="tab-pane fade" id="buy-his"><!--Buy History-->
						<div class="box-header payment_header well">
							<h4 style="margin-bottom:10px;">Buy History</h4>
							
							<div class="col-md-4">
							<?php // echo __('From Date');?><input type="text"  placeholder="From Date" class="input-xlarge datepicker  form-control" id="date05" name="fromdate" value="" >
							</div>
							
							<div class="col-md-4">
											
											<?php // echo __('To Date');?> <input type="text" class="input-xlarge datepicker  form-control" id="date06" name="todate"  placeholder="To Date" value=""  <?php //echo date("j-m-Y");?> >
							</div>
							
							<div class="col-md-4">
											
											
										<input type="button" id="saleButton" value="Search" class="btn btn-primary payment" >
										
										<input type="button" style="display:none" class="btn btn-primary payment" value="Clear Search" style="" id="clearButton">
										</div>
									
										<div class="clearfix"></div>
							<div class="box-icon">
								<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>-->
							</div>
						</div>
						<div class="box-content" style="max-height:450px; overflow:auto;">
							<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
								  <thead>
									  <tr>
										  <th><?php echo __('S.No.');?></th>
										  <th><?php echo __('Sold Date');?></th>
										  <th><?php echo __('Car Name');?></th>
										  <th><?php echo __('Chassis');?></th>
										  <th><?php echo __('Sale price')."($)";?></th>
										  <th><?php echo __('Sale price')."(￥)";?></th>
										  <th><?php echo __('Invoice No.');?></th>
										  <th><?php echo __('Action');?></th> 	 												  
									  </tr>
								  </thead>   
								  <tbody id="buyDetails">
								  
							<?php
							$count = 1;  	
							if($BuyInvDetails)
							{									
							foreach($BuyInvDetails as $val)
							{
								
							?>
									<tr>
										<td class="center"><?php  echo $count; //$rows['CarPayment']['id'] ; ?></td> 
										<td class="center"><?php 
												$originalDate = $val['CarPayment']['updated_on'] ;  
												$newDate = date("d-m-Y", strtotime($originalDate));
												echo $newDate ; 
										  ?></td>
										<td class="center"><?php  echo @$val['CarName']['car_name']; ?></td>
										<td class="center"><?php  echo @$val['Car']['cnumber'] ; ?></td>
										<td class="center">
												<?php
												if($val['CarPayment']['currency']=='$')
												{		
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo $val['CarPayment']['sale_price'];
												}else
												{
													echo '-';
												}	
												
												
												
												 											
												/*if($val['CarPayment']['currency'] =='$')
												{
													 echo @$val['CarPayment']['sale_price'] ;
												}else
												{
													echo '-';
												}*/
												?>
										</td>
										<td class="center">
											
												<?php 
												
													/*if($val['CarPayment']['currency'] =='￥')
													{
														 echo @$val['CarPayment']['sale_price'] ;
													}else
													{
														echo '-';
													}*/
													
													
													
												if($val['CarPayment']['currency']=='￥')
												{		
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo '-';
												}else
												{
													echo '-';
												} 
												
												?>
												 
										</td>
										<td class="center"><?php  echo @$val['Invoice']['invoice_no'] ; ?></td>
										<td class="center">
											<?php 
												if(!empty($val['Invoice']['invoice_no']))
												{
													$st = explode("/",$val['Invoice']['invoice_no']);
																		
													echo $this->Html->link(
													   '<i class="fa fa-download"></i>',
														array(
															'controller'=>'invoices',
															'action' => 'export_xls',$st[1] 
														),
														array(
														
															'data-hint'=>'Download',
															'class'=>'btn btn-success hint--right',
															'escape'=>false  
														)
												);
												}else
												{
													echo "";
												}
											?>
										</td>
									</tr>
							<?php $count++;   }}else {?>	                         
								  </tbody>
								  <tr><td colspan="10" style="text-align:center">Buy History not found</td></tr>
								<?php }?>										  
							 </table>  
						</div>
				  </div><!--Buy History-->
					<div class="tab-pane fade" id="sale-his"><!--Sale History-->
						<div class="box-header payment_header well">
							<h4 style="margin-bottom:10px;">Sale History</h4>

							<div class="col-md-4">
								<?php // echo __('From Date');?><input type="text"  placeholder="From Date" class="input-xlarge datepicker  form-control" id="saledate05" name="fromdate" value="" >
							</div>

							<div class="col-md-4">

								<?php // echo __('To Date');?> <input type="text" class="input-xlarge datepicker  form-control" id="saledate06" name="todate"  placeholder="To Date" value=""  <?php //echo date("j-m-Y");?> >
							</div>

							<div class="col-md-4">


								<input type="button" id="sale2Button" value="Search" class="btn btn-primary payment" >

								<input type="button" style="display:none" class="btn btn-primary payment" value="Clear Search" style="" id="saleclearButton">
							</div>

							<div class="clearfix"></div>
							<div class="box-icon">
								<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>-->
							</div>
						</div>
						<div class="box-content" style="max-height:450px; overflow:auto;">
							<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
								<thead>
								<tr>
									<th><?php echo __('S.No.');?></th>
									<th><?php echo __('Sold Date');?></th>
									<th><?php echo __('Car Name');?></th>
									<th><?php echo __('Chassis');?></th>
									<th><?php echo __('Sale price')."($)";?></th>
									<th><?php echo __('Sale price')."(￥)";?></th>
									<th><?php echo __('Invoice No.');?></th>
									<th><?php echo __('Action');?></th>
								</tr>
								</thead>
								<tbody id="saleDetails">

								<?php
								$count = 1;
								if($SaleInvDetails)
								{
									foreach($SaleInvDetails as $val)
									{

										?>
										<tr>
											<td class="center"><?php  echo $count; //$rows['CarPayment']['id'] ; ?></td>
											<td class="center"><?php
												$originalDate = $val['CarPayment']['updated_on'] ;
												$newDate = date("d-m-Y", strtotime($originalDate));
												echo $newDate ;
												?></td>
											<td class="center"><?php  echo @$val['CarName']['car_name']; ?></td>
											<td class="center"><?php  echo @$val['Car']['cnumber'] ; ?></td>
											<td class="center">
												<?php
												if($val['CarPayment']['currency']=='$')
												{
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo $val['CarPayment']['sale_price'];
												}else
												{
													echo '-';
												}




												/*if($val['CarPayment']['currency'] =='$')
												{
													 echo @$val['CarPayment']['sale_price'] ;
												}else
												{
													echo '-';
												}*/
												?>
											</td>
											<td class="center">

												<?php

												/*if($val['CarPayment']['currency'] =='￥')
                                                {
                                                     echo @$val['CarPayment']['sale_price'] ;
                                                }else
                                                {
                                                    echo '-';
                                                }*/



												if($val['CarPayment']['currency']=='￥')
												{
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo '-';
												}else
												{
													echo '-';
												}

												?>

											</td>
											<td class="center"><?php  echo @$val['Invoice']['invoice_no'] ; ?></td>
											<td class="center">
												<?php
												if(!empty($val['Invoice']['invoice_no']))
												{
													$st = explode("/",$val['Invoice']['invoice_no']);

													echo $this->Html->link(
														'<i class="fa fa-download"></i>',
														array(
															'controller'=>'invoices',
															'action' => 'export_xls',$st[1]
														),
														array(

															'data-hint'=>'Download',
															'class'=>'btn btn-success hint--right',
															'escape'=>false
														)
													);
												}else
												{
													echo "";
												}
												?>
											</td>
										</tr>
										<?php $count++;   }}else {?>
								</tbody>
								<tr><td colspan="10" style="text-align:center">Sales History not found</td></tr>
								<?php }?>
							</table>
						</div>
					</div><!--Sale History-->
					<div class="tab-pane fade" id="all-his"><!--All History-->
				  <div style="margin-bottom:10px;">
					  <div class="col-md-5">	
						<strong>Search Engine </strong> &nbsp;&nbsp;&nbsp;<input class="input-xlarge" id="selectbox-a" name="optionvalue" data-placeholder="Enter chechis no for search">
					</div>
					<div> 
						<div id="showAllUsrDivBtn" style="display:none;">
							<button class="btn btn-primary" id="clearSearchHistory" >Clear Search</button>	
						</div>
					</div>
			
				<div class="clearfix"></div>
				<div class="myloader" id="loading1" style="display:none;">
						<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
				</div>
				<br>				
				</div>
					<div class="col-md-12" style="overflow-x: auto;height:400px">
						<table class="table table-bordered table-striped stocked-table" style="width:auto">
						<thead>
							<tr>
								<th>STOCK No.</th>
								<th>Car Name</th>
								<th>CHASSIS No</th>
								<th>Price</th>
								<th>Receipt of money </th>
								<th>Payment receive date</th>
								<th>Discount</th>
								<th>Balance</th>
								<th>Advance</th>
								<th>Documents for shipping</th>
								<th>Documents management UK</th>
								<th>Month/Year of manufacture</th>
								<th>Sold date</th>
								<th>Shipping Company</th>
								<th>DOCUMENT given DATE</th>
								<th>Port Name</th>
								<th>Port Remark</th>
								<th>Destination Port</th>
								<th>Cancel</th>
								<th>Departure Date</th>
								<th>Arrival Date</th>
								<th>Remarks</th>				
							</tr>
						</thead>
						
						<tbody id='all_history_data'>
							<?php if($SaleDetails){ 
								  foreach($SaleDetails as $val)
								  { 
								  ?>
									<tr> 
										<td class="center"><?php echo $val['Car']['stock'] ; ?></td>
										<td class="center">
											<?php 
											if($val['Car']['user_doc_status'] ==1)
											{
												$style = 'color:red';
												
											}else
											{
												 $style = '';
											}	
											?>
											<span style='<?php echo $style; ?>' ><?php         	
											echo $val['CarName']['car_name'] ;?></span>
										</td>
										<td class="center"><?php echo $val['Car']['cnumber'] ; ?></td>
										<td class="center sale"><span class="text">	
										<?php
										//echo $val['CarPayment']['currency']."===\n";  	
											if($val['CarPayment']['currency']=='$')
											{		
												echo "$".$val['CarPayment']['sale_price'];
											}else if($val['CarPayment']['currency'] == '')
											{
												echo "$".$val['CarPayment']['sale_price'];
											}else
											{
												echo "￥".$val['CarPayment']['sale_price'];
											}											 
										?>

											</span></td>
										<td> <?php if($val['Car']['user_doc_status'] ==1)
											{
												if($val['CarPayment']['currency']=='$')
												{		
													echo "$".$val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo "$".$val['CarPayment']['sale_price'];
												}
												else
												{
													echo "￥".$val['CarPayment']['sale_price'];
												}
												
											}else
											{
												echo " ";
											}?></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="center" id="tdShip_<?php echo $val['CarPayment']['car_id']; ?>">
											
											<!--<input type="checkbox" id='mail_<?php //echo $val['CarPayment']['car_id']; ?>' value='<?php //echo $val['Car']['user_doc_status'] ;?>'   <?php  //echo ($val['Car']['user_doc_status']==1 ? 'checked' : ''); ?> >-->
											
											
											<input type="checkbox"  id='mail_<?php echo $val['CarPayment']['car_id']; ?>' data-value='<?php echo $val['CarPayment']['sale_price']; ?>'   data-id = "client_check" onclick="docShipStatus(this,'<?php echo $val['CarPayment']['car_id']; ?>')" value='<?php echo $val['Car']['user_doc_status'] ;?>'  <?php  echo ($val['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >

										</td>
										
										 <?php  

										?>
										 
										<td class="center" id="td<?php echo $val['CarPayment']['car_id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $val['CarPayment']['car_id']; ?>' onclick="docStatus('<?php echo $val['CarPayment']['car_id']; ?>')" value='<?php echo $val['Car']['doc_status'] ;?>'  <?php  echo ($val['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>	
										

									



										<td><?php $mYear = explode(" ",$val['Car']['manufacture_year']); echo $mYear[0]."/".@$mYear[1]; ?></td>
										<td><?php echo date("d-m-Y", strtotime($val['CarPayment']['updated_on']) );  ?></td>
										<td class="center"><?php echo $val['Shipping']['company_name'] ; ?></td>
										<td class="center"><?php if(isset($val['Logistic']['created']) && empty($val['Logistic']['created']))
									{
										echo $shipDate=  '';
									}
									elseif(!empty($val['Logistic']['created']))
									{
										$str = $val['Logistic']['created'];
										if (substr_count($str, '-') > 0)
										{
											echo $shipDate = $val['Logistic']['created'];
										}
										else
										{
											if(is_numeric($val['Logistic']['created']))
											{
												@$shipDate = date('d-m-Y',$val['Logistic']['created']);
												//echo  @$shipDate;
												echo  $shipDate=  '';
											}
											else
											{
												echo  $shipDate=  '';
											}
										}
									}
									else{
										echo $shipDate=  '';
									} ?></td>	
										<td class="center"><?php echo $val['Logistic']['ship_port'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['port_remark'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['destination_port'] ; ?>
										</td>
										<td class="center"></td>
										<td class="center"><?php echo $val['Logistic']['departure_date'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['arrival_date'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['remark']; ?></td>	
									</tr>
								 <?php }}else {?> 
									<tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
							<?php }?>	
						</tbody>
						</table>
						</div>
				  </div><!--All History-->
				</div>
			</div>
		</div>					
</div>
<!-- Modal -->
<div class="modal fade" id="mypop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm? </h4>
      </div>
      <div class="modal-body" id='mypop_body'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='save_button'>Save</button>
      </div>
    </div>
  </div>  
</div>
	
<script>
	
	function docShipStatus(e,CarId)
	{
		var sale_price = 0;
		var pr =0;
        $('[data-id = "client_check"]').each(function() {

			if ($(this).is(':checked')) {
				pr = $(this).data("value");
				sale_price += parseInt($(this).data("value"));
			}
		
        });
		var checkStatus= $("#mail_"+CarId).is(":checked");
		
			if(checkStatus==true)
			{
				var msg = 'Are you sure release car document?';
			}else
			{
				var msg = 'Are you sure   cancel release car document?';
			}
		//var sale_price =  $(e).parent().parent().parent().siblings(".sale").find('span').html();
		if(<?php  echo $pTotal; ?> >= sale_price)
		{
			
			var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm?</h3></div><div class="modal-body"><div class="bootbox-body">'+msg+'</div></div><div class="modal-footer"><button onclick="releaseDoc('+CarId+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal" onclick="CancelDoc('+CarId+');" > Cancel </button> </div> </div> </div>';
			$("#mypop").html(str);
			$("#mypop").modal("show");

		}else
		{
			var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm?</h3></div><div class="modal-body"><div class="bootbox-body">'+msg+'</div></div><div class="modal-footer"><button onclick="releaseDoc('+CarId+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal" onclick="CancelDoc('+CarId+');" > Cancel </button> </div> </div> </div>';
			$("#mypop").html(str);
			$("#mypop").modal("show");
			$("#tdShip_"+CarId).children().children().removeClass('checked');
		}
	}
	
	function CancelDoc(CarId,pr)
	{
		$("#tdShip_"+CarId).children().children().removeClass('checked');
	}
	
	
	function releaseDoc(CarId)
	{
		var checkStatus= $("#mail_"+CarId).is(":checked");
			if(checkStatus==true)
			{
				var status = '1';
			}else
			{
				var status = '0';
			}
			var dataString = {'cId':CarId,'status':status};
			$.ajax({
			type: "POST",
			url:"<?php echo $this->Html->url('/admin/users/docShipStatus',true);?>",
			data: dataString,
			success: function(data)
			{
				
				var obj = jQuery.parseJSON( data );
				if(obj.status = 'checked')
				{}
				else
				{	
					$("#tdShip_"+CarId).children().children().removeClass('checked');
				}
				$("#mypop").modal("hide");	
			},
			failure: function(data)
			{
				alert('Error occur');
			}
			});
		
	}
	
	
	function docStatus(CarId)
	{
		
		var checkStatus= $("#checkbox_"+CarId).is(":checked");
		if(checkStatus==true)
		{
			var status = '1';
		}else
		{
			var status = '0';
		}
		
		
		var dataString = {'cId':CarId,'status':status};
		$.ajax({
		type: "POST",
		url:"<?php echo $this->Html->url('/admin/users/docStatus',true);?>",
		data: dataString,
		success: function(data)
		{
			
			var obj = jQuery.parseJSON( data );
			if(obj.status = 'checked')
			{}
			else
			{
				var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
				$("#td"+CarId).html(str1);
			}
			
		},
		failure: function(data)
		{
			alert('Error occur');
		}
		});
		
	}
	
	
	
	
	function payDelete(payId)
	{
		var txt;
		var r = confirm("Are you sure want to delete payment details ?");
		if (r == true) {
			var dataString = {'id':payId};			
			$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/paymentdelete',true);?>",
			type:"POST",
			data:dataString,
			dataType:"json",
			beforeSend: function() {
			 $("#myloader").show();
				   },
			success:function(result)
			{
				$("#myloader").hide();
				if(result.status == 'success')
				{
					$('#tr'+payId).remove();
					$('#showMessage').html('<div class="alert alert-success">'+result.message+'</div>');	
					$('#showMessage').delay(3000).fadeOut( "slow" );
				}else
				{
					$('#showMessage').html(result.message);	 
				}
			},
			faliure:function(result)
			{
				
			}
			});
		}
		
		
		
		
		
	}
	
	
	$("#payButton").click(function()
			{	
				var Uid = $('#client_id').val();
				var toDate  =$("#date04").val();
				var fromDate  =$("#date03").val();
				var dataString = {'id':Uid,'from':fromDate,'to':toDate};			
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/users/pay_detail_search',true);?>",
					type:"POST",
					data:dataString,
					dataType:"html",
					beforeSend: function() {
					$("#myloader").show();
					},
					success:function(result)
					{
						
						$("#payCancelButton").show();	
						$("#myloader").hide();				   
						$('#payDetail').html(result);	
					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
		});

	/*For Buy Action*/
	$("#saleButton").click(function()
			{	
				var Uid = $('#client_id').val();
				var toDate  =$("#date05").val();
				var fromDate  =$("#date06").val();
				var dataString = {'id':Uid,'from':fromDate,'to':toDate};			
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/users/buy_detail_search',true);?>",
					type:"POST",
					data:dataString,
					dataType:"html",
					beforeSend: function() {
					$("#myloader").show();
					},
					success:function(result)
					{
						$("#myloader").hide();
						$('#buyDetails').html(result);
						$('#clearButton').show();	
					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
		});
		
		
		$("#clearButton").click(function()
			{	
				var Uid = $('#client_id').val();
				var toDate  =$("#date05").val();
				var fromDate  =$("#date06").val();
				var dataString = {'id':Uid,'from':fromDate,'to':toDate};			
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/users/clear_buy_detail_search',true);?>",
					type:"POST",
					data:dataString,
					dataType:"html",
					beforeSend: function() {
					  $("#myloader").show();
				   },
					success:function(result)
					{
						$("#myloader").hide();
						$('#buyDetails').html(result);
						$('#clearButton').hide();	
					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
		});

	/*For Sale Action*/

	$("#sale2Button").click(function()
	{
		var Uid = $('#client_id').val();
		var toDate  =$("#saledate05").val();
		var fromDate  =$("#saledate06").val();
		var dataString = {'id':Uid,'from':fromDate,'to':toDate};
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/sale_detail_search',true);?>",
			type:"POST",
			data:dataString,
			dataType:"html",
			beforeSend: function() {
				$("#myloader").show();
			},
			success:function(result)
			{
				$("#myloader").hide();
				$('#saleDetails').html(result);
				$('#saleclearButton').show();
			},
			faliure:function(result)
			{
				alert("Network Error");
			}
		});
	});


	$("#saleclearButton").click(function()
	{
		var Uid = $('#client_id').val();
		var toDate  =$("#saledate05").val();
		var fromDate  =$("#saledate06").val();
		var dataString = {'id':Uid,'from':fromDate,'to':toDate};
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/clear_sale_detail_search',true);?>",
			type:"POST",
			data:dataString,
			dataType:"html",
			beforeSend: function() {
				$("#myloader").show();
			},
			success:function(result)
			{
				$("#myloader").hide();
				$('#saleDetails').html(result);
				$('#saleclearButton').hide();
			},
			faliure:function(result)
			{
				alert("Network Error");
			}
		});
	});
		
$(function(){




$('#payCancelButton').click(function()
{
	var Uid = $('#client_id').val();
	var dataString = {'id':Uid};
	$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/pay_clear_search',true);?>",
			type:"POST",
			data:dataString,
			dataType:"html",
			beforeSend: function() {
              $("#myloader").show();
           },
			success:function(result)
			{
				 $("#payCancelButton").hide();
				 $("#date03").val('');
				 $("#date04").val('');	
				 $("#myloader").hide();				   
				 $('#payDetail').html(result);			
			}					
		});
	
})


$('#saleCancelButton').click(function()
{
	var Uid = $('#client_id').val();
	var dataString = {'id':Uid};
	$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/sale_clear_search',true);?>",
			type:"POST",
			data:dataString,
			dataType:"html",
			beforeSend: function() {
              $("#myloader").show();
           },
			success:function(result)
			{
				 $("#payCancelButton").hide();
				 $("#date03").val('');
				 $("#date04").val('');	
				 $("#myloader").hide();				   
				 $('#payDetail').html(result);			
			}					
		});
	
})




 $("#client_id").change(function(){
  var id = $(this).val();
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/search_ajax',true);?>",
			beforeSend: function() {
              $("#loading2").show();
           },
			success:function(result)
			{
				 $("#loading2").hide();	
				 window.location.href="<?php echo $this->Html->url('/admin/users/clientHistory/',true)?>"+id;
			}					
		});
     }); 
 });
	
	
	
	
</script>  
