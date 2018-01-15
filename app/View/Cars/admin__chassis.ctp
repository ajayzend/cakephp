
					
						 <?php foreach($carDetail as $Detail){
							
							 ?>
                       
						<tr>	
                        <td><input type='checkbox' name='checkbox'  class="select_checkbox"  value='<?php echo $Detail['Car']['id'];?>'></td>
						<?php echo '
						<td>'.$Detail['Car']['uniqueid'].'</td>
						<td>'.$Detail['CarName']['car_name'].'</td>
						<td>'.$Detail['Country']['country_name'].'</td>
						<td>'.$Detail['Car']['cnumber'];?></td><td>
						<?php if(isset($Detail['CarPayment']['sale_price'])){
						echo $Detail['CarPayment']['sale_price'];
					    }else{
					     echo '-';
					     };?>
						</td><td><?php echo $Detail['Car']['stock'];?></td><td>
						<?php /*if (@$status=='new arrival' ) {
													$status1 = "New Arrival";
													$style1 ="btn btn-primary"; 
												} else if( @$status=='unpublish') {
													$status1 = "Sold Car";
													$style1 ="btn btn-danger";
												}else if(@$status=='Hidden Car') {
													$status1 = "Hidden Car";
													$style1 ="btn btn-warning";
												} else{
												   $status1 = "Publish";
													$style1 ="btn btn-success";
												};*/
												
									if($Detail['Car']['publish'] == 0 && $Detail['CarPayment']['sale_price'] != '')
									{
										
										$status1 = "Sold Car";
													$style1 ="btn btn-danger";
										
									}else if($Detail['Car']['publish'] == 0 && $Detail['CarPayment']['sale_price'] =='')
									{
										
											$status1 = "Hidden Car";
													$style1 ="btn btn-warning";
										
										
									}else if($Detail['Car']['new_arrival'] ==1)
									{
											$status1 = "New Arrival";
													$style1 ="btn btn-primary"; 
									}else
									{
										 $status1 = "Publish";
													$style1 ="btn btn-success";
									}					
												
												
												
												?>
						
						<input type="button" class="<?php echo $style1 ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status1 ;?>" />
						<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
						</td>
					
					<td class="center" id="td<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['doc_status'] ;?>'  <?php  echo ($Detail['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>	
					<td class="center" id="td_ship<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='ship_checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docShipStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['user_doc_status'] ;?>'  <?php  echo ($Detail['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >
					
					<img id="loading_ship<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
					</td>	
						
						<td class="right_bordr1">
				 
                  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>					  
				  <?php //echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?>
				  
				   <a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete ?');" href="javascript:deleteName(<?php echo $Detail['Car']['id'].",'".key($Detail);?>')"><i class="fa fa-trash-o"></i></a>
				  
				  <?php echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'';
                        
						 } ?>
						</td></tr>
			
<script>
	
$(function()
		{
			$(".select_checkbox").click(function ()
			{
				
				if($('.select_checkbox').is(':checked')){
					$(this).parent().addClass('checked');
					 $('#delete_arrival_car').show(); 
				}	
				else
				{
					 $(this).parent().removeClass('checked')
					 $('#delete_arrival_car').hide(); 
				}	
	
				 	
					
					
			})
		});
	 
		$(function()
		{
				$("#select-checkbox").click(function () {
		
				 if($('#select-checkbox').is(':checked')){					
					// $('.select_checkbox').parent().addClass('checked');		
					$('.select_checkbox').each(function() { 
						this.checked = true;                
					});		
					 $('#delete_arrival_car').show(); 
				 }
				 else
				 {
					  //$('.select_checkbox').parent().removeClass('checked');
					  $('.select_checkbox').each(function() { 
						this.checked = false;             
					});
					  $('#delete_arrival_car').hide(); 
				 }
				 
				 
  
				});
	 });
	 

</script>
