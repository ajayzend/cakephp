                          
						  <?php
						   
						  if($invoiceDetails)
							  {
								$srNo = 1;	
							  foreach($Invoice as $val){
								  
							  ?>
								<tr>
									<!--<td data-sorting="sort"><?php //echo $srNo; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									<td class="center"><?php echo strtoupper($val['User']['first_name']) .' '.strtoupper($val['User']['last_name']) ;?></td>
									<td class="center"><?php echo $val['Car']['car_name_id']  ;?></td>
									<td class="center"><?php echo "" ;?></td>
									
									<td class="center">
									<?php $st = explode("/",$val['Invoice']['invoice_no']);?>
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
												'action' => 'delete', $Invoice[0]['Invoice']['id']
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
									<td class="center" colspan="6" style="text-align:center">No Data Found</td>							
							</tr>
<?php }?>
					<?php  if($count > $limit) {?>
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
					
