                          <?php
							  if($invoiceDetails) 
							  {
								$price = 0;
								$srNo=1;	
							  foreach($invoiceDetails as $data=>$val){
								  $email = $val['InvoiceDetail'][0]['User']['email'] ;
								  $user_id = $val['InvoiceDetail'][0]['User']['id'] ;
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									
									 <?php
									 $carname = '';
									 $cnumber =array();
									 foreach($val['InvoiceDetail'] as $val)
										{  
											@$cnumber[] = $val['Car']['cnumber'].'<b>/</b>';
											@$carname .= $val['Car']['CarName']['car_name'].'<b>/</b>';
											$userName = $val['User']['first_name']." ".$val['User']['last_name'];
											@$price += $val['Car']['CarPayment']['sale_price'];
									}
									?>
										<td class="center"><?php  echo $val['Car']['CarPayment']['currency'].$price; //$invoiceDetails[0]['Invoice']['amount'] ;?></td>
									 <td class="center">
										<?php echo strtoupper($userName) ; ?>
									</td>
									<td class="center">
										<?php   foreach ($cnumber as $num){ echo strtoupper($num); } ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
									<?php $st = explode("/",$invoiceDetails[0]['Invoice']['invoice_no']);?>
										<?php //echo $this->Html->link('',array('action' => 'generate',$st[2]),array('class'=>'fa fa-download'));?>
									<?php										
										echo $this->Html->link(
										   '<i class="fa fa-download"></i>',
											array(
												'action' => 'generate',$st[1] 
											),
											array(
											
												'data-hint'=>'Download',
												'class'=>'btn btn-success hint--bottom',
												'escape'=>false  
											)
										);
										?>
										<?php
										
										echo $this->Html->link(
										   '<i class="fa fa-trash-o"></i>',
											array(
												'controller'=>'invoices',
												'action' => 'delete', $invoiceDetails[0]['Invoice']['id'],$st[1]
											),
											array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false  
											)
										);
										?>
										
										<?php										
										 echo $this->Form->button('<i class="fa fa-envelope"></i>',  array('type' => 'button', 'data-hint'=>'Send Email','class' => 'btn btn-success hint--bottom','onclick'=>'sendMail(\''.$user_id.'\',\''.$email.'\' , \''.$st[1].'\')'));?>
									</td>
								</tr>
							<?php $srNo++; }}
							else{
							?>
							<tr class="colr_body">
									<td class="center" colspan="6">No Data Found</td>							
							</tr>
<?php }?>							
