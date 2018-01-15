<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
					  
				  <tbody id="searchdata" class="searchData">
					  
					   <?php foreach($carDetail as $Detail){?>
                       
						<tr>
							
						<?php 
						
						
						
						echo '
						<td>'.@$Detail['Car']['uniqueid'].'</td>
						<td>'.@$Detail['CarName']['car_name'].'</td>
						<td>'.@$Detail['Country']['country_name'].'</td>
						<td>'.@$Detail['Car']['cnumber'];?></td>
						<td style="text-align:center">
						<?php if(isset($Detail['CarPayment']['sale_price'])){
						echo $Detail['CarPayment']['sale_price'];
					    }else{
					     echo '-';
					     };?>
						</td><td><?php echo $Detail['Car']['stock'];?></td>
						<td>
							<?php
							
							//echo $Detail['Car']['publish']."+_+_".$Detail['CarPayment']['sale_price'];
							
							
							 if($Detail['Car']['publish']==1  && $Detail['CarPayment']['sale_price'] =='')
							{
								$status = "Publish";
								$style ="btn btn-success";
								$publish ='';
							}else if($Detail['Car']['publish']==1 && $Detail['Car']['new_arrival']==1)
							{
								$status = "New Arrival";
								$style ="btn btn-primary"; 
								$publish ='';
							}else if($Detail['Car']['publish']==0 && $Detail['CarPayment']['sale_price'] =='')
							{
								$status = "Hidden Car";
								$style ="btn btn-warning";
								$publish ='';
							}else if($Detail['Car']['publish']==0 && $Detail['CarPayment']['sale_price'] !='')
							{
								$status = "Sold Car";
								$style ="btn btn-danger";
								$publish ='active';
							}
							//echo $publish.'==='.$status.'===='.$style;			   
							?>
						
					
						<?php if($publish == 'active')
						{
							
							
							?>
						<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status ;?>" />
						<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
						<?php }else{ ?>	
							<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>"  value="<?php echo $status ;?>" />
							<?php }?>					
						</td>
						
					<td class="center" id="td<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['doc_status'] ;?>'  <?php  echo ($Detail['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>
					
					<td class="center" id="td_ship<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='ship_checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docShipStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['user_doc_status'] ;?>'  <?php  echo ($Detail['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >
					
					<img id="loading_ship<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
					</td>		
						
                  <td>

                  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'view_hidden_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
						 <a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete ?');" href="javascript:deleteName(<?php echo $Detail['Car']['id'].",'".key($Detail);?>')"><i class="fa fa-trash-o"></i></a>
						 
						 <?php //echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'</td></tr >';
                       //    $serialNumber++;
						 } ?>
						
						</td>
				<!--  <?//php echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?></td><td>-->
				 
				</tbody>	
			</table> 
