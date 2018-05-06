<?php
$groupid = $this->Session->read('UserAuth.User.user_group_id');
if($SaleDetails){ 
									  foreach($SaleDetails as $val)
									  {
										  $chasis_no = $val['Car']['cnumber'];
										  $consignee = $val['Car']['consignee'];
										 if($val['Car']['user_doc_status'] ==1)
										{
											$color = '#ffffd0';#5f8295 d9534f  #1fbba6
											
										}else
										{
											 $color = '';
										}
									  ?>
									  
										
										<tr bgcolor='<?php echo $color;?>'> 
											<td class="center"><?php echo $val['Car']['stock'] ; ?>
											</td>
											<td class="center">
												<?php
																		 
													$carId = $val['CarPayment']['car_id'];   

													if($val['Car']['user_doc_status'] ==1)
													{
														$style = 'color:black';
														
													}else
													{
														 $style = '';
													}					
												?>  
												
												<?php  echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank','style'=>$style));
												?>
														
												 
											
											</td>

										  <?php if($groupid == 5) {?>
											  <td class="center"><?php echo $chasis_no ; ?>
											  <td><?php $mYear = explode(" ",$val['Car']['manufacture_year']); echo $mYear[0]."/".@$mYear[1]; ?></td>
										  <?php }?>

											<?php if($groupid == 2) {?>
											<td class="center"><a title="Click to update Consignee." href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';
													document.getElementById('fade').style.display='block'; document.getElementById('his_carid').value = <?php echo $carId?>;
													document.getElementById('chasis_vale_id').innerHTML =  <?php echo "'$chasis_no'"?>;
													document.getElementById('consignee').value =  <?php echo "'$consignee'" ; ?>;">
													<?php echo $chasis_no ; ?></a></td>

											<td><?php $mYear = explode(" ",$val['Car']['manufacture_year']); echo $mYear[0]."/".@$mYear[1]; ?></td>
											<td class="center"><?php echo $val['Logistic']['bl_no'] ; ?>
											<td class="center"><?php echo $val['Car']['consignee'] ; ?>
											<td class="center"><?php echo $val['CarPayment']['psale_freight'] ; ?>
										  <?php } ?>
											<td class="center"><span class="text">
											<?php if($val['CarPayment']['currency']=='$')
															{		
																echo "$".$val['CarPayment']['sale_price'];
															}else if($val['CarPayment']['currency']=='￥')
															{
																echo "￥".$val['CarPayment']['sale_price'];
															}else
															{
																echo "-";
															}
														 ?>
												</span>
											</td>
											<td><?php echo date("d-m-Y", strtotime($val['CarPayment']['updated_on']) );  ?>
											</td>
											<td>
												<?php if($val['Car']['user_doc_status'] ==1)
												{
													if($val['CarPayment']['currency']=='$')
															{		
																echo "$".$val['CarPayment']['sale_price'];
															}else if($val['CarPayment']['currency']=='￥')
															{
																echo "￥".$val['CarPayment']['sale_price'];
															}else
															{
																'-';
															}
												}else
												{
													echo " ";
												}		
												
												?>
											</td>
											
											<td><?php echo $val['Car']['user_doc_updated']; ?>
											</td>
											<td></td>
											<td></td>
											<td></td>
											<td class="center">
													<?php  
												
												  if(strlen(trim($val['Logistic']['created']))>0)
												  {	
														 $readOnly = 'disabled="true"';
													 }
												  else {
													  
														$readOnly = 'disabled="true"';
													}
														
												?>
												<input type="checkbox" id='mail_<?php echo $val['CarPayment']['car_id']; ?>' class="chkNumber" data-id="client_check"  name="check[]" value='<?php echo $val['CarPayment']['car_id']; ?><?php // echo "/".$val['CarPayment']['sale_price']; ?> <?php // echo "/".$val['Car']['user_doc_status']; ?>'  <?php  echo ($val['Car']['user_doc_status']==1 ? 'checked' : ''); ?> <?php  echo $readOnly; ?> >
												
											</td>
											
												 <?php  
												
												  if($val['Car']['doc_status']==1)
														 $selected = "value='0'";
												  else 
														$selected =  "value='1'"; 
														
												
												?>
											 
											<td class="center" id="td<?php echo $val['CarPayment']['car_id']; ?>" >
											
												<!--<input type="checkbox"  id='checkbox_<?php // echo $val['CarPayment']['car_id']; ?>' onclick="docStatus('<?php // echo $val['CarPayment']['car_id']; ?>')"  <?php // echo $selected;?> <?php // echo ($val['Car']['doc_status']==1 ? 'checked' : ''); ?> > onclick="docStatus('<?php // echo $val['CarPayment']['car_id']; ?>')"-->
												
												
												<input type="checkbox"  id='checkbox_<?php echo $val['CarPayment']['car_id']; ?>'  value='<?php echo $val['Car']['doc_status'] ;?>' disabled="disabled"  <?php  echo ($val['Car']['doc_status']==1 ? 'checked' : ''); ?>    >
											</td>	
										
											
											
											<td class="center"><?php echo $val['Shipping']['company_name'] ; ?>
											</td>
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
											if(is_numeric($val['Logistic']['created'])){
												//@$shipDate = date('d-m-Y',$val['Logistic']['created']);
												$shipDate=  '';
											}
											else{
											echo  $shipDate=  '';
											}
										}
									}
									else{
										echo $shipDate=  '';
									}?>
											</td>	
											<td class="center"><?php echo $val['Logistic']['ship_port'] ; ?>
											</td>
											<td class="center"><?php echo $val['Logistic']['port_remark'] ; ?>
											</td>
											<td class="center"><?php echo $val['Logistic']['destination_port'] ; ?>
											</td>
											<td class="center">
											</td>
											<td class="center"><?php echo $val['Logistic']['departure_date'] ; ?>
											</td>
											<td class="center"><?php echo $val['Logistic']['arrival_date'] ; ?>
											</td>
											<td class="center"><?php echo $val['Logistic']['remark'] ; ?>
											</td>	
										</tr>
									 <?php }}else {?> 
										<tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
								<?php }?>	
