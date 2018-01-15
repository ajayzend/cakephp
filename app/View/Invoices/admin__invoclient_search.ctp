				<?php
							  if($invoiceDetails)
							  {
								$price = 0;
								$srNo=1;
								$cnumber="";	
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
									 $price = 0;
									 foreach($val['InvoiceDetail'] as $value)
										{  //pr($value);
											@$cnumber[] = $value['Car']['cnumber'].'<b>/</b>';
											@$carname .= $value['Car']['CarName']['car_name'].'<b>/</b>';
											@$userName = $value['User']['first_name']." ".$value['User']['last_name'];
											@$price += $value['Car']['CarPayment']['sale_price'];
									}
									?>
									<td class="center"><?php
											echo $value['Car']['CarPayment']['currency'];
											 echo $price;//$val['Invoice']['amount'] ;?></td>
									 <td class="center">
										<?php echo strtoupper($userName) ; ?>
									</td>
									<td class="center">
										<?php foreach ($cnumber as $num){ echo strtoupper($num); } 
										//   foreach ($cnumber as $num){ echo $num."/"; } ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
									<?php
										
									 $st = explode("/",$val['Invoice']['invoice_no']);?>
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
												'action' => 'delete', $val['Invoice']['id'],$st[1]
											),
											array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false  
											)
										);
										?>
										
										<?php										
										 echo $this->Form->button('<i class="fa fa-envelope"></i>',  array('type' => 'button', 'data-hint'=>'Send Email','class'=> 'btn btn-success hint--bottom','onclick'=>'sendMail(\''.$user_id.'\',\''.$email.'\' , \''.$st[1].'\')'));?>
									</td>
								</tr>
							<?php $srNo++; }}
							else{
							?>
							<tr class="colr_body">
									<td class="center" colspan="6">No Data Found</td>							
							</tr>
<?php }?>			

					<?php //pr($invoiceDetails);die;
					  if($count > $limit) {?>
						 <div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
									
							<?php
									echo $this->Paginator->prev('Prev', array(
									'tag' => 'li',
									'label' => false
									));
								?>
								
								<?php
									echo $this->Paginator->numbers(array(
									'tag' => "li",
									'separator' => null,
									'currentClass' => 'active',
									'style'=>'cursor:pointer;cursor:hand'
									));
								?>
								
								<?php
									echo $this->Paginator->next(__('next'), array(
									'tag' => 'li',
									'label' => false,
									'class' => null
									));
								?>
							</ul>
						</div> 
						<?php }?>
