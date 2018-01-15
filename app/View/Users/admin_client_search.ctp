<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" >
						  <thead>
							   <tr>
								  <th ><?php echo __('SL');?></th>
								  <th><?php echo __('Name');?></th>
								 <th><?php echo __('Email');?></th>
								  <th><?php echo __('Status');?></th>
								   <th><?php echo __('Customer code');?></th>
								  <th >Actions</th>
							  </tr>
						  </thead>   
						  
					  <tbody>
					 <?php if (!empty($users))
					  {
					  $sl=0;
					  foreach ($users as $row) 
						{
								$sl++;
							  if($row['User']['id']!=1)
							  {
					  ?>
							<tr class="odd">
									<td class=""><?php echo $sl; ?></td>
									<td class="center "><?php  echo $this->Html->link(@h($row['User']['first_name'])." ".h($row['User']['last_name']),array('controller'=>'users', 'action'=>'user_bid_report',$row['User']['id']),array('escape' => FALSE,'target'=>'_blank')); //echo h($row['User']['first_name'])." ".h($row['User']['last_name']); ?></td>
									<td class="center "><?php echo h($row['User']['email']); ?></td>
									<td class="center ">
										<?php 
											if ($row['User']['active']==1) {
													$status = "Active";
													$style ="btn btn-success"; 
												} else {
													$status = "Inactive";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="userStatus<?php echo $row['User']['id'];?>" onClick="ClientStatus(<?php echo $row['User']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $row['User']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 

									</td>
									<td class="center ">
											<?php 
											echo $row['User']['uniqueid'];
											?>
									</td>
									<td class="center sorting_1">

																				<?php										
echo $this->Html->link(
   '<i class="fa fa-pencil"></i>',
    array(
    	'action' => 'editUser', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Edit',
        'class'=>'btn btn-info hint--bottom',
        'escape'=>false      
    )
);
?>
						
										<?php //echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',array('action' => 'delete', $row['User']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom' ,'data-hint'=>'Delete')); ?>
<?php										
echo $this->Form->postLink(
   '<i class="fa fa-trash-o"></i>',
    array(
    	'action' => 'delete', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Delete',
        'class'=>'btn btn-danger hint--bottom',
        'escape'=>false,
        'confirm' => 'Are you sure want to delete user ?' 
    )
);
?>
	
										
										<?php //echo $this->Html->link('Payment',array('action' => 'clientHistory', $row['User']['id']),array('class'=>'btn btn-small btn-primary'));?>

										<?php										
echo $this->Html->link(
   '<i class="fa fa-money"></i>',
    array(
    	'action' => 'clientHistory', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Payment',
        'class'=>'btn btn-primary hint--bottom',
        'escape'=>false  
    )
);
?>
<?php
echo $this->Html->link(
   '<i class="fa fa-unlock-alt"></i>',
    array(
    	'action' => 'changePassword', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Change Password',
        'class'=>'btn btn-primary hint--left',
        'escape'=>false  
    )
);
?>
										
									</td>
								</tr>
						<?php
								}
							}
						}
						else
						{
						?>
								<tr><td colspan="10" style="text-align:center">Result not found</td></tr>
						<?php
						}
						?>
							
							</tbody>
							
					</table>         
