<div id="ajax-response">
<div id="content1">
			
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class=" col-md-12"><h2><i class="fa fa-users">&nbsp;</i> <?php echo __('Client Management'); ?></h2></div>
								<div class="clearfix"></div>	
					</div>
						<div id="showMessage">
							<?php
							$success = $this->Session->flash();
							if($success) {?>
							<div  class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert"></button>
								<strong><?php echo $success ;?></strong>
							</div>
							<?php }?>
						</div>
					     <div class="box-content">
						 <div class="row">
				         <div class="col-md-12">
						 <div class="row">
						 <div class="col-md-12"></div>
						 <div class="col-md-6 pull-right">
						 
						 
						 
						 <?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Back' ,
											array(
												'action' => 'allUsers'
											),
											array(
											
												'data-hint'=>'All User Detail',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);?>

						 
						 </div>
						 </div>
						 </div>
						 </div>
						 </div>
<div class="row">	
			<div class="box col-md-12">
					<div class="box-header payment_header well" data-original-title>
						<h4>Balance Overview</h4>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table" width="40">
							  <thead>
								  <tr>
								  	  <th  style="text-align:center" >Name </th>
									  <th  style="text-align:center" >Balance ($) </th>
									  <th  style="text-align:center" >Balance (￥) </th>
									                                     
								  </tr>
							  </thead >   
							  <tbody >
							  <?php

								foreach($TotalRecords as $val) { ?>

								<tr>
									<td  style="text-align:center"><?php
									 echo $val['name'][0]['User']['first_name'].' '.$val['name'][0]['User']['last_name'];
									 ?></td>
									<td  style="text-align:center"><?php
									if(!empty($val['saleDoller'][0][0]['SalePriceDoller'])) { $saleDoller = $val['saleDoller'][0][0]['SalePriceDoller'];}
									else{
											 $saleDoller = 0;
										}
										if(!empty($val['payment'][0][0]['Amount'])) { $payment = $val['payment'][0][0]['Amount'];}
									else{
											 $payment = 0;
										}
									 echo @$balanceDoller = ($payment - $saleDoller);?></td>
									
									<td  style="text-align:center"><?php
										if(!empty($val['saleYen'][0][0]['SalePriceYen'])) { $saleYen = $val['saleYen'][0][0]['SalePriceYen'];}
									else{
											 $saleYen = 0;
										}
									
										if(!empty($val['payment'][0][0]['Yen_amount'])) { $paymentYen = $val['payment'][0][0]['Yen_amount'];}
									else{
											 $paymentYen = 0;
										}
									 @$balanceYen =($paymentYen - $saleYen);
									echo $balanceYen;?></td>
									                                      
								</tr>
								<?php  } ?>

								                                  
							  </tbody>
						 </table>  
					</div>
				</div>
			</div>
			</div>
			</div>	
			</div>
			</div>
			
