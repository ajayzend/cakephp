 <?php
							  
							  if($invoiceDetails)
							  {
								
								$price = 0;
								$srNo=1;
								$cnumber ="";	
							  foreach($invoiceDetails as $data=>$val){
							  	//pr($val);
								  //$email = $val['DeletedInvoice']['user_id'] ;
								  $user_id = $val['DeletedInvoice']['user_id'] ;
								 
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['DeletedInvoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['DeletedInvoice']['created']));   echo $date ;?></td>
									<td class="center">
									<?php
									echo $val['DeletedInvoiceDetail'][0]['Car']['CarPayment']['currency'];
									 echo $val['DeletedInvoice']['amount'] ;?></td>
									 <?php
									 $carname = '';
									 $cnumber =array();
									 foreach($val['DeletedInvoiceDetail'] as $v)
										{  
											
											@$carname .= $v['Car']['CarName']['car_name'].'<b>/</b>';
											@$cnumber[] = $v['Car']['cnumber']."<b>/</b>";
											@$userName = $v['User']['first_name']." ".$v['User']['last_name'];
											//$price +=$val['Car']['CarPayment']['sale_price'];
									}
									?>
									
									 <td class="center">
										<?php echo $val['User']['first_name'].' '. $val['User']['last_name'] ; ?>
									</td>
									<td class="center">
										<?php   foreach ($cnumber as $num){ echo strtoupper($num); } ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
									
									<?php
										$st = explode("/",$val['DeletedInvoice']['invoice_no']);
																		
										echo $this->Html->link(
										   '<i class="fa fa-download"></i>',
											array('action' => 'delete_invoice_generate',$st[1] ),array('data-hint'=>'Download','class'=>'btn btn-success hint--bottom','escape'=>false ));
										?>	
										
									<?php							
											echo $this->Html->link(
										   '<i class="fa fa-trash-o"></i>',
												array(
												'controller'=>'invoices',
												'action' => 'delete_server_invoice',$val['DeletedInvoice']['id']
											),
												array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false,
												'confirm' => 'Are you sure want to delete invoice from our server ?'  
												)
											);
										?>
										
										
									</td>
								</tr>
							<?php $srNo++; }}
							else{
							?>
							<tr class="colr_body">
									<td class="center" colspan="6" style="text-align:center">No Data Found</td>							
							</tr>
<?php }?>			
