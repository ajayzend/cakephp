<?php echo $this->Html->css(array('select2'));?>
<?php echo $this->Html->script(array('select2.min'));?>

<script type="text/javascript">

 
 $(function(){
$('#hideDiv').delay(4000).fadeOut( "slow" );
});
 //$('#hideDiv').delay(5000).fadeOut(400);
 //$(document).ready(function(){
//	$('#hideDiv').fadeIn('fast').delay(10000).hide(0);
 //});
 
$(function() {
    $(".datepicker").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+0'});
    /* $("#date03").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date04").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date05").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
      $("#date06").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+0'});*/
});

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
					success:function(result)
					{
						$('#payDetail').html(result);	
					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
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
					success:function(result)
					{
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
					success:function(result)
					{
						$('#all_history_data').html(result);
						$(".select2-choice span").html("Enter chechis no for search");
						//$("#selectbox-a").val("");
						$('#showAllUsrDivBtn').hide();

					}
				});
		});
	   
	}); 



</script>

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
					<!--  ----------------------this div show Payment history --------------------   -->
									
											<div class="tab-pane fade" id="pay-his">
												<h4>Payment History</h4>
												<div class="box-icon">
													<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>	-->												
												</div>
												<div class="box-header payment_header well">
							<div class="col-md-5">
							
							<?php // echo __('From Date');?><input type="text" class="input-xlarge datepicker  form-control" id="date03" name="fromdate"   placeholder="From Date" value="" >
							</div>
								
							<div class="col-md-5">
								<?php // echo __('To Date');?> <input type="text" class="input-xlarge datepicker  form-control" id="date04" name="todate" placeholder="To Date" value="<?php date_default_timezone_set("Asia/Kolkata");  // echo date("j-m-Y");?>" >
							</div>
							
							<div class="col-md-2">												
								
							<input type="button" id="payButton" value="Search" class="btn btn-primary payment" >	
							</div>
							<div class="clearfix"></div>
							<div id="showMessage"></div>
							<div>
								
								<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>	-->												
							</div>
						</div>
											
											<div class="box-content">
												<table class="table table-bordered">
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
													$count =1; 
													if($PaymentDetails){
													foreach($PaymentDetails as $val) { ?>
														<tr>
															<td class="center"><?php  echo $count;//$val['ClientPaymentHistory']['id'] ; ?></td>
															<!--<td class="center"><?php  //echo $val['ClientPaymentHistory']['client_id'] ; ?></td>-->
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
													<?php } ?>												  
													  </tbody>
												 </table>  
											</div>
											</div>
				<!--  ----------------------end div show Payment history --------------------   -->
				<!--  ----------------------Start div show Sale history --------------------   -->
								
							<div class="tab-pane fade" id="sale-his">
									<h4>Sale History</h4>
									<div class="box-header payment_header well">
							
							
							<div class="col-md-5">
							<?php // echo __('From Date');?><input type="text"  placeholder="From Date" class="input-xlarge datepicker  form-control" id="date05" name="fromdate" value="" >
							</div>
							
							<div class="col-md-5">
											
											<?php // echo __('To Date');?> <input type="text" class="input-xlarge datepicker  form-control" id="date06" name="todate"  placeholder="To Date" value=""  <?php //echo date("j-m-Y");?> >
							</div>
							
							<div class="col-md-2">
											
											
										<input type="button" id="saleButton" value="Search" class="btn btn-primary payment" >
										</div>
										<div class="clearfix"></div>
									<div class="box-icon">
										<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>-->
									</div>
								</div>
								<div class="box-content">
									<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
										  <thead>
											  <tr>
												  <th><?php echo __('S.No.');?></th>
												  <th><?php echo __('Date');?></th>
												  <th><?php echo __('Car Name');?></th>
												  <th><?php echo __('Chassis');?></th>
												  <th><?php echo __('Sale price')."($)";?></th>
												  <th><?php echo __('Sale price')."(￥)";?></th>
												  <th><?php echo __('Invoice No.');?></th>
												  <th><?php echo __('Action');?></th> 	 												  
											  </tr>
										  </thead>   
										  <tbody>
										  
									<?php
									$count = 1;  	
									if($SaleDetais)
									{									
									foreach($SaleDetais as $val)
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
												if($val['CarPayment']['currency'] =='$')
												{
													 echo @$val['CarPayment']['sale_price'] ;
												}else
												{
													echo '-';
												}
												?>
										</td>
										<td class="center">
											
												<?php 
												
													if($val['CarPayment']['currency'] =='￥')
													{
														 echo @$val['CarPayment']['sale_price'] ;
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
																	'class'=>'btn btn-success hint--bottom',
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
							</div><!--/span-->
						</div>
				
				<!--  ----------------------End div show Sale history --------------------   -->
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
								<th>Documents for shipping date</th>
								<th>Port Name</th>
								<th>Change port</th>
								<th>Destination Port</th>
								<th>Cancel</th>
								<th>Departure Date</th>
								<th>Arrival Date</th>				
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
											if($val['CarPayment']['currency']=='$')
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
												}else
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
										
										<td><?php $mYear = explode(" ",$val['Car']['manufacture_year']); echo $mYear[0]."/".$mYear[1]; ?></td>
										<td><?php echo date("d-m-Y", strtotime($val['CarPayment']['updated_on']) );  ?></td>
										<td class="center"><?php echo $val['Shipping']['company_name'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['created'] ; ?></td>	
										<td class="center"><?php echo $val['Logistic']['ship_port'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['port_remark'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['destination_port'] ; ?>
										</td>
										<td class="center"></td>
										<td class="center"><?php echo $val['Logistic']['departure_date'] ; ?></td>
										<td class="center"><?php echo $val['Logistic']['arrival_date'] ; ?></td>	
									</tr>
								 <?php }}else {?> 
									<tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
							<?php }?>	
						</tbody>
						</table>
						</div>
				  </div><!--All History-->
