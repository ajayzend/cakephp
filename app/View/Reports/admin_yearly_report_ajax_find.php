<div id='seacrh_pagination'>
	<?php echo $sr_no;die; ?>
<table class="table table-striped table-bordered custom_table reort_tab">
									<thead>
										<tr>
											<th>S.No.</th>
											<th>Date of Buying</th>
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
													<tr>
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
											<th>Shipping Date</th>
											<th>Shipping Port </th>
											<th>Departure Date </th>
											<th>Arrival Date </th>
											<th>Destination Port</th>
											<th>Remark </th>
										</tr>
									</thead>
									<tbody id="showData1">
									
									<?php
									 
									$c = $sr_no;
									foreach($yearlyDetais as $result) 
									{
										?>
									<tr>
											<td><?php echo $c ; ?></td>
											<td><?php 
											$date = date('d-m-Y',strtotime($result['Car']['created']));  
											echo $date ; ?>
											</td>
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
											<td><?php echo @$result['Car']['Logistic']['Shipping']['company_name']; ?></td>
											<td><?php echo @$result['Car']['Logistic']['Transport']['transport_name']; ?></td>
											<td><?php //echo @$result['Car']['Logistic']['created']; 
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
													$shipDate=  date('d-m-Y',$str);
													}
													else{
														$shipDate = '';
													}
												}
											}
											else{
												$shipDate=  '';
											}
											echo @$shipDate; 
											?></td>
											<td><?php echo @$result['Car']['Logistic']['ship_port']; ?></td>
											<td><?php echo @$result['Car']['Logistic']['departure_date']; ?></td>
											<td><?php echo @$result['Car']['Logistic']['arrival_date']; ?></td>
											<td><?php echo @$result['Car']['Logistic']['destination_port']; ?></td>
											<td><?php echo @$result['Car']['Logistic']['remark'] ; ?></td>
										</tr>
										<?php $c++;}?>
									</tbody>
								</table>
								
							</div>
							
						<div id="paginationDivId" class="col-md-6 pull-right">
								  <?php echo $content ; ?>
							</div>	 
							 
							<?php //if($count > $limit) {?>
						 <div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
									
							<?php
									//echo $this->Paginator->prev('Prev', array(
									//'tag' => 'li',
									//'label' => false
									//));
								?>
								
								<?php
									//echo $this->Paginator->numbers(array(
									//'tag' => "li",
									//'separator' => null,
									//'currentClass' => 'active',
									//'style'=>'cursor:pointer;cursor:hand'
									//));
								?>
								
								<?php
									//echo $this->Paginator->next(__('next'), array(
									//'tag' => 'li',
									//'label' => false,
									//'class' => null
									//));
								?>
							</ul>
						</div> 
						<?php //}?>
