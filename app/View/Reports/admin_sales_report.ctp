<div class="col-sm-12 export-excel">
				<?php	if(empty($data))
						$data =array('null' =>'null');
							
										echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_sale_xls','?' =>array('ids'=>$data)
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);
										?>
							<!--<button class="btn btn-primary pull-right">Export <i class="fa fa-list-alt"></i></button> -->
						</div>
						<div class="col-sm-12">
						<?php if(isset($TotalCar))
						{	?>	
						<div class="det" >
							
							<table class='table table-bordered custom_table'>
								<tr>
									<th>Total Car &nbsp;&nbsp; : <?php  echo $TotalCar; ?></th><th>Total Cost</th><th>Total Sale</th><th>Profit/Loss</th>
								</tr>
								<tr>
									<td>In Dollar</td><td> <?php  echo '$'.$TotalCost;?></td><td><?php  echo '$'.$TotalSale;?></td><td><?php  echo '$  '.$profit."/".$loss; ?></td>
								</tr>
								<tr>
									<td>In Yen</td><td><?php  echo '￥'.$TotalYenCost;?></td><td><?php  echo '￥'.$TotalYenSale;?></td><td><?php  echo '￥  '.$yen_profit."/".$yen_loss; ?></td>
								</tr>
							</table>
							
							
							<!--Total Car &nbsp;&nbsp; : <?php  echo $TotalCar; ?>   &nbsp;&nbsp;&nbsp;| Total Cost &nbsp;&nbsp; : <?php  echo '$'.$TotalCost;?> &nbsp;&nbsp;&nbsp;| Total Sale &nbsp;&nbsp; : <?php  echo '$'.$TotalSale;?>  &nbsp;&nbsp;&nbsp;| Profit/Loss &nbsp;&nbsp:<?php  echo '$  '.$profit."/".$loss; ?><br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <?php  echo ''; ?>   &nbsp;&nbsp;&nbsp; Total Cost &nbsp;&nbsp; : <?php  echo '￥'.$TotalYenCost;?> &nbsp;&nbsp;&nbsp;| Total Sale &nbsp;&nbsp; : <?php  echo '￥'.$TotalYenSale;?>  &nbsp;&nbsp;&nbsp;| Profit/Loss &nbsp;&nbsp:<?php  echo '￥  '.$yen_profit."/".$yen_loss; ?>-->
						</div>	<?php  } ?>
							<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Country</th>
										<th>Car Brand</th>
										<th>Client Name</th>
										<th>Cost Price($)</th>
										<th>Cost Price(￥)</th>
										<th>Sale Price</th>
										<th>Profit / Loss</th>
									</tr>
								</thead>
								<tbody>
									
								<?php 
								if($saleReports)
								{
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
											}else if($result['CarPayment']['currency']=='￥')
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
												 echo "$ ".$profit.'<strong> / </strong>'.$Loss;
											}else if($result['CarPayment']['currency']=='￥')
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
												echo "￥ ".$yenProfit.'<strong> / </strong>'.$yenLoss;
											}
										?></td>
									</tr>
									<?php $c++;}}else{ ?>
										
									<tr>
										<td colspan="9" style="text-align:center"> Result Not Found</td>
									</tr>
										
										<?php }?>
								</tbody>
							</table>
						</div>
