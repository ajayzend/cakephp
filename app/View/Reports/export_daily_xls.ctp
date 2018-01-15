
							<table class="" border=1> 
								<thead>
									<tr>
										<td colspan="8" align="center" > <b><h4>Daily Report  <?php if(isset($transportName)) echo "(".$transportName.")"  ;?>     Date - <?php echo date('d-m-Y',strtotime($daily_date)); ?>  </h4></b></td>
									</tr>
									<tr >
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
									$c= 1 ;
									foreach ($dailyReports as $report)
									{
									?>
									<tr>
										<td align="center"><?php echo $c ;?></td>
										<td align="center"><?php echo @$report['CarPayment']['auction_name'] ;?></td>
										<td align="center"> <?php echo @$report['Car']['lot_number'] ;?></td>
										<td align="center"><?php echo @$report['CarName']['car_name'] ;?></td>
										<td align="center"><?php echo $report['Car']['cnumber'] ;?></td>
										<td align="center"><?php echo @$report['Port']['port_name'] ;?></td>
										<td align="center"><?php echo @$report['Logistic']['yard_name'] ;?></td>
										<td align="center"><?php echo @$report['Logistic']['remark'] ;?></td>
									</tr>
									<?php $c++; }?>
								</tbody>
							</table>
