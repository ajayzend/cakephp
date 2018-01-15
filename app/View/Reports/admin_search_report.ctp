<div class="col-md-12 export-excel">
						<?php										
										echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_daily_xls','?' =>array('ids'=>$data) 
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);
										?>
							<!--<button class="btn btn-primary pull-right">Export <i class="fa fa-list-alt"></i></button> -->
						</div>
						<div class="col-md-12">
							<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Auction Name</th>
										<th>Lot No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Port Name</th>
										<th>Yard No.</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody>
										<?php  
										 if($dailyReports)
										 {
											$c= 1 ;
											foreach ($dailyReports as $report)
											{
											?>  
											<tr>
												<td><?php echo $c ;?></td>
												<td><?php echo @$report['CarPayment']['auction_name'] ;?></td>
												<td><?php echo @$report['Car']['lot_number'] ;?></td>
												<td><?php echo @$report['CarName']['car_name'] ;?></td>
												<td><?php echo $report['Car']['cnumber'] ;?></td>
												<td><?php echo @$report['Port']['port_name'] ;?></td>
												<td><?php echo @$report['Logistic']['yard_name'] ;?></td>
												<td><?php echo @$report['Logistic']['remark'] ;?></td>
											</tr>
											<?php $c++; }}
											else{
											?>
											<tr>
												<td colspan ="8" style="text-align:center">Result Not Found</td>	
											</tr>
											<?php } ?>
											</tbody>
							</table>
						</div>
					</div>
