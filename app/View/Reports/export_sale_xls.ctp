<table border=1 class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Country</th>
										<th>Car Brand</th>
										<th>Client Name</th>
										<th>Cost Price ($)</th>
										<th>Cost Price(￥)</th>
										<th>Sale Price($)</th>
										<th>Loss/Profit ($)</th>
									</tr>
								</thead>
								<tbody>
									
								<?php 
								
								$c = 1;
								foreach ($saleReports as $result)
								{?>	
									<tr>
										<td><?php echo $c; ?></td>
										<td><?php echo @$result['CarName']['car_name'] ;?></td>
										<td><?php echo @$result['Car']['cnumber'] ;?></td>
										<td><?php echo @$result['Country']['country_name'] ;?></td>
										<td><?php  echo @$result['Brand']['brand_name'] ; ?></td>
										<td><?php echo @$result['CarPayment']['User']['first_name']." ".@$result['CarPayment']['User']['last_name'] ;?></td>
										<td><?php echo @$result['CarPayment']['asking_price'] ;?></td>
										<td><?php echo @$result['CarPayment']['yen'] ;?></td>
										<td>
											<?php 
											
											if($result['CarPayment']['currency']=='$')
											{
												 echo "$".@$result['CarPayment']['sale_price'] ;
											}else
											{
												 echo "￥".@$result['CarPayment']['sale_price'] ;
											}
         
											 ?>  
											</td>
										<td><?php 
										
											if($result['CarPayment']['currency']=='$')
											{	
												if($result['CarPayment']['sale_price'] > $result['CarPayment']['asking_price'])
												{
													$profit =  $result['CarPayment']['sale_price']-$result['CarPayment']['asking_price'];
													$Loss=0;
												}else
												{
													$Loss = $result['CarPayment']['asking_price']- $result['CarPayment']['sale_price'];
													$profit=0;
												}											
												 echo "$ ".$profit.'/'.$Loss;
											}else
											{	
												if($result['CarPayment']['sale_price'] > $result['CarPayment']['yen'])
												{
													$yenProfit =  $result['CarPayment']['sale_price']-$result['CarPayment']['yen'];
													$yenLoss=0;
												}else
												{
													$yenLoss = $result['CarPayment']['yen']- $result['CarPayment']['sale_price'];
													$yenProfit = 0;
												}
												echo "￥ ".$yenProfit.'/'.$yenLoss;
											}
										?></td>
									</tr>
									<?php $c++;} ?>
								</tbody>
							</table>
