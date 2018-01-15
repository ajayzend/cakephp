<table class="" border=1>
									  <thead>
										  <tr> 
											  <th>S No.</th>
											  <th>Sold date</th>
											  <th>Car Name</th>
											  <th>Chassis No</th>
											  <th>Sale Price($)</th>
											  <th>Sale Price(￥)</th>
											 <th>Invoice No.</th>
											  									  
										  </tr>
									  </thead>   
									  <tbody id="cardetail">
									  <?php if($SaleDetails){
										  $sno=1; 
									  foreach($SaleDetails as $val)
									  {
										  
									  ?>
										<tr> 
											<td> <?php echo $sno; ?></td>
											<td> <?php 
												$originalDate = $val['CarPayment']['updated_on'] ; 
												$newDate = date("d-m-Y", strtotime($originalDate));
												echo $newDate ; 
										  ?></td>
											<td class="center"><?php 
											$carId = $val['CarPayment']['car_id'];         	
											echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank')); 
											
											//echo @$val['Car']['CarName']['car_name'] ; ?></td>
											<td class="center"><?php echo $val['Car']['cnumber'] ; ?></td>
											
											<td class="center">
												<span id="first_<?php echo $val['CarPayment']['id']; ?>" class="text">
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
														
														
												?></span>
												</td>
												
												
												<td class="center">
												<span id="first_<?php echo $val['CarPayment']['id']; ?>" class="text">
												<?php
												 
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
															 
												 ?></span>
												</td>
											
												<td class="center"><?php echo $val['Invoice']['invoice_no'] ; ?></td>											
											</tr>
											<?php $sno++; }}else {?> 
											<tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
											<?php }?>							 
										</tbody>
								</table>
