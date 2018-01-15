				<div class="col-sm-12 export-excel">
				<?php										
										/*echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_yearly_xls',$fromDate,$toDate 
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);*/
										?>
							<!--<button class="btn btn-primary pull-right">Export <i class="fa fa-list-alt"></i></button> -->
						</div>
				<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Date of Buying</th>
										<th>Client Name </th>
										<th>Sale Price </th>
										<th>Sold Date </th>
										<th>Manufacture Year</th>
										<th>Document Status</th>
										<th>Country Name</th>
										<th>Auction Name</th>
										<th>Lot No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Port Name</th>
										<th>Port Remark</th>
										<th>Yard No.</th>
										<th class="in-cars">
											<table>
												<tr class="in-cars-tr">
													<td colspan="2" align="center">In-Cars</td>
												</tr>
												<tr>
													<td  width="28%">Status</td>
													<td width="49%">Date-In</td>
												</tr>
											</table>
										</th>
										<th class="in-cars">
											<table>
												<tr>
													<td colspan="2" align="center">Out-Cars</td> 
												</tr>
												<tr>
													<td  width="28%">Status</td>
													<td width="49%">Date-Out</td>
												</tr>
											</table>
										</th>
										<th>Car Status</th>
										<th>Shipping Company</th>
										<th>Transport Company</th>
										<th>DOCUMENT given DATE</th>
										<th>Shipping Port </th>
										<th>Departure Date </th>
										<th>Arrival Date </th>
										<th>Destination Port</th>
										<th>Remark </th>
									</tr>
								</thead>
								<tbody id="showData">
								
								<?php
								if($yearlyDetais)
								{								
									$c=1;
									foreach($yearlyDetais as $result) 
									{
										
									?>
								<tr>
										<td><?php echo $c ; ?></td>
										<td><?php 
											$date = date('d-m-Y',strtotime($result['Car']['pdate']));  
											echo $date ; ?>
											</td>
											<td style='text-align:center;'><?php
											if(@$result['User']['first_name'])
											{
												 echo @$result['User']['first_name'].' '.$result['User']['last_name'] ;
											}else
											{
												echo '-';
											}
											 ?></td>
											<td style='text-align:center;'><?php											
											if(@$result['CarPayment']['sale_price'])
											{
												 echo @$result['CarPayment']['currency'].''. @$result['CarPayment']['sale_price'];
											}else
											{
												echo '-';
											}

											 ?></td>
											<td><?php   if($result['CarPayment']['updated_on'] == '0000-00-00')
											{
												echo "-";
												}else{   echo date('d-m-Y',strtotime($result['CarPayment']['updated_on'])) ; }?></td>
											<td><?php echo @$result['Car']['manufacture_year']; ?></td>
											<td align="center">
											<?php 
											if($result['Car']['user_doc_status'] == 0 && $result['Car']['doc_status']==0)
											{
												echo "<div style='text-align:center'>-</div>";
											}else if($result['Car']['user_doc_status'] == 0 && $result['Car']['doc_status']==1)
											{
												echo "<div style='color:green;text-align:center'>Document In Hand</div>";
											}else if($result['Car']['user_doc_status'] == 1 && $result['Car']['doc_status']==1)
											{
												echo "<div style='color:red;text-align:center'>Document Released</div>";
											}       
											?></td>
										<td><?php echo @$result['Car']['Country']['country_name'] ; ?></td>
										<td><?php echo @$result['CarPayment']['auction_name'] ; ?></td>
										<td><?php echo @$result['Car']['lot_number'] ; ?></td>
										<td><?php echo @$result['Car']['CarName']['car_name'] ; ?></td>
										<td><?php echo @$result['Car']['cnumber'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['Port']['port_name'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['port_remark'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['yard_name']; ?></td>
										<td class="in-cars">
											<table>
												<tr>
													<td  width="48%"><?php if(!empty($result['Car']['Logistic']['car_in'])){echo 'OK';}else{echo '';}
													//echo @$result['Car']['Logistic']['status']; 
													?></td>
													<td width="100px"><?php echo @$result['Car']['Logistic']['car_in']; ?></td>
												</tr>
											</table>
										</td>
										<td class="in-cars">
											<table>
												<tr> 
													<td  width="48%"><?php if(!empty($result['Car']['Logistic']['car_out'])){echo 'OK';}else{echo '';}
													//echo @$result['Car']['Logistic']['status']; 
													?></td>
													<td width="100px"><?php echo @$result['Car']['Logistic']['car_out']; ?></td>
												</tr>
											</table>
										</td>
										<td><?php echo @$result['Car']['Logistic']['status']; ?></td>
										<td><?php echo @$result['Car']['Logistic']['Shipping']['company_name'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['Transport']['transport_name'] ; ?></td>
										<td><?php 
										if(isset($result['Car']['Logistic']['created']) && empty($result['Car']['Logistic']['created']))
											{
												$shipDate=  '';
											}
											elseif(!empty($result['Car']['Logistic']['created']))
											{
												$str = $result['Car']['Logistic']['created'];
												if (substr_count($str, '-') > 0)
												{
													$shipDate = $str;
												}
												else
												{
													if(is_numeric($str))
													{
													//$shipDate=  date('d-m-Y',$str);
													$shipDate = '';
													}
													else{
														$shipDate = '';
													}
												}
											}
											else{
												$shipDate=  '';
											}
											echo @$shipDate; ?></td>
										<td><?php echo @$result['Car']['Logistic']['ship_port'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['departure_date'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['arrival_date'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['destination_port']; ?></td>
										<td><?php echo @$result['Car']['Logistic']['remark'] ; ?></td>
									</tr>
									<?php $c++;}} else{ ?>
									<tr>
										<td colspan="11" style="text-align:center"> Result Not Found</td>
									</tr>
									<?php } ?>
						</tbody>
				</table>
