<table border=1> 
								<thead>
									<tr>
										<td colspan="11" align="center"> <b><h4>Yarly Report (Car-in and Car-out details) </h4></b></td>
									</tr>
									<tr>
										<th>S.No.</th>
										<th>Date of Buying</th>
										<th>Country Name</th>
										<th>Auction Name</th>
										<th>Lot No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Freight</th>
										<th>B/L No</th>
										<th>Consignee</th>
										<th>Port Name</th>
										<th>Port Remark</th>
										<th>Yard No.</th>
										<th class="in-cars">
											<table>
												<tr>
													<td colspan="2" align="center">In-Cars</td>
												</tr>
												<tr>
													<td  width="60px">Status</td>
													<td width="100px">Date-In</td>
												</tr>
											</table>
										</th>
										<th class="in-cars">
											<table>
												<tr>
													<td colspan="2" align="center">Out-Cars</td>
												</tr>
												<tr>
													<td  width="60px">Status</td>
													<td width="100px">Date-Out</td>
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
										<th>Remark </th>
									</tr>
								</thead>
								<tbody id="showData">
								
				<?php 
				$c=1;
				foreach($yearlyDetais as $result) 
				{
					?>
				<tr>
										<td><?php echo $c ; ?></td>
										<td><?php $date = date('d-m-Y',strtotime($result['Car']['created']));  
										echo $date ; ?></td>
										<td><?php echo @$result['Car']['Country']['country_name'] ; ?></td>
										<td><?php echo @$result['CarPayment']['auction_name'] ; ?></td>
										<td><?php echo @$result['Car']['lot_number'] ; ?></td>
										<td><?php echo @$result['Car']['CarName']['car_name'] ; ?></td>
										<td><?php echo @$result['Car']['cnumber'] ; ?></td>
										<td><?php echo @$result['CarPayment']['psale_freight'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['bl_no'] ; ?></td>
										<td><?php echo @$result['Car']['consignee'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['Port']['port_name']; ?></td>
										<td><?php echo @$result['Car']['Logistic']['port_remark'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['yard_name']; ?></td>
										<td class="in-cars">
											<table>
												<tr>
													<td  width="100px"><?php if(!empty($result['Car']['Logistic']['car_in'])){echo 'OK';}else{echo '';}
													//echo @$result['Car']['Logistic']['status']; 
													?></td>
													<td width="100px"><?php echo @$result['Car']['Logistic']['car_in']; ?></td>
												</tr>
											</table>
										</td>
										<td class="in-cars">
											<table>
												<tr> 
													<td  width="100px"><?php if(!empty($result['Car']['Logistic']['car_out'])){echo 'OK';}else{echo '';}
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
											echo @$shipDate;
										 ?></td>
										<td><?php echo @$result['Car']['Logistic']['ship_port'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['departure_date'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['arrival_date'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['remark'] ; ?></td>
									</tr>
									<?php $c++;}?>
						</tbody>
				</table>
