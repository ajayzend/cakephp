				<div class="col-sm-12 export-excel">
				<?php										
										echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_yearly_xls',$fromDate,$toDate 
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);
										?>
							<!--<button class="btn btn-primary pull-right">Export <i class="fa fa-list-alt"></i></button> -->
						</div>
				<table class="table table-striped table-bordered custom_table">
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
								if($yearlyDetais)
								{								
									$c=1;
									foreach($yearlyDetais as $result) 
									{
									?>
								<tr>
										<td><?php echo $c ; ?></td>
										<td><?php 
										$date = date('d-m-Y',strtotime($result['CarPayment']['updated_on']));  
										echo $date ; ?>
										</td>
										<td><?php echo @$result['Car']['Country']['country_name'] ; ?></td>
										<td><?php echo @$result['CarPayment']['auction_name'] ; ?></td>
										<td><?php echo @$result['Car']['lot_number'] ; ?></td>
										<td><?php echo @$result['Car']['CarName']['car_name'] ; ?></td>
										<td><?php echo @$result['Car']['cnumber'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['Port']['port_name'] ; ?></td>
										<td><?php echo @$result['Car']['Logistic']['yard_name']; ?></td>
										<td class="in-cars">
											<table>
												<tr>
													<td  width="48%"><?php echo @$result['Car']['Logistic']['status']; ?></td>
													<td width="100px"><?php echo @$result['Car']['Logistic']['car_in']; ?></td>
												</tr>
											</table>
										</td>
										<td class="in-cars">
											<table>
												<tr> 
													<td  width="48%"><?php echo @$result['Car']['Logistic']['status']; ?></td>
													<td width="100px"><?php echo @$result['Car']['Logistic']['car_out']; ?></td>
												</tr>
											</table>
										</td>
										<td><?php echo @$result['Car']['Logistic']['shipping_id'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['transport_id'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['created'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['ship_port'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['departure_date'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['arrival_date'] ; ?></td>
											<td><?php echo @$result['Car']['Logistic']['remark'] ; ?></td>
									</tr>
									<?php $c++;}} else{ ?>
									<tr>
										<td colspan="11" style="text-align:center"> Result Not Found</td>
									</tr>
									<?php } ?>
						</tbody>
				</table>
