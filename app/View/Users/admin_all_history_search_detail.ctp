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
												@$shipDate = date('d-m-Y',$val['Logistic']['created']);
												//echo  @$shipDate;
												echo  $shipDate=  '';
											}
											else{
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
										<td class="center"><?php echo $val['Logistic']['remark'] ; ?></td>		
									</tr>
								 <?php }}else {?> 
									<tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
							<?php }?>	
