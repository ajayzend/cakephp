
				
						 <?php foreach($CarChassis as $Detail){
					 /*if(@$new=='new arrival'){?>		
								<td><input type='checkbox' name='checkbox'  class="select_checkbox"  value='<?php echo $Detail['Car']['id'];?>'></td>
							<?php }*/
					 echo '<tr class="right_bordr">';
					 ?>
                     <td><input type='checkbox' name='checkbox'  class="select_checkbox"  value='<?php echo $Detail['Car']['id'];?>'></td>
						
                        <?php
                        echo '<td>'.$Detail['Car']['uniqueid'].'</td>
						<td>'.$Detail['CarName']['car_name'].'</td>
						<td>'.$Detail['Country']['country_name'].'</td>
						<td>'.$Detail['Car']['cnumber'].'</td><td>';
						
						if(isset($Detail['CarPayment']['sale_price'])){
						echo $Detail['CarPayment']['sale_price'];
					    }else{
					     echo 'Not Sold';
					     };?>
						</td>
						<td><?php echo $Detail['Car']['stock'];?></td>
						<td>
						<?php if (@$searchParam=='new arrival' ) {
													$status = "New Arrival";
													$style ="btn btn-primary"; 
												} else if( @$searchParam=='unpublish') {
													$status = "Sold Car";
													$style ="btn btn-danger";
												}else if(@$searchParam=='not sold') {
													$status = "Hidden Car";
													$style ="btn btn-warning";
												} else{
												   $status = "Publish";
													$style ="btn btn-success";
												};?>
						
						<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status ;?>" />
						<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
						</td>
					<td class="center" id="td<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['doc_status'] ;?>'  <?php  echo ($Detail['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>	
					<td class="center" id="td_ship<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='ship_checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docShipStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['user_doc_status'] ;?>'  <?php  echo ($Detail['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >
					
					<img id="loading_ship<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
					</td>		
				<td class="right_bordr1">				 
                  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
				  <?php echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?>
				  
				  <?php echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',
				  array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),
				  array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'';
				  
                         //  $serialNumber++;
						 } ?>
						</td>
				  </tr>
				 
				
