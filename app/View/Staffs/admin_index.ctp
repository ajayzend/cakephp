<?php 
?>

<div id="ajax-response">
<div id="content1">
			<!-- content starts -->
			
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class=" col-md-12"><h2><i class="fa fa-users">&nbsp;</i> <?php echo __('Staff Management'); ?></h2></div>
								<div class="clearfix"></div>	
					</div>
						<div id="showMessage">
							<?php
							$success = $this->Session->flash();
							if($success) {?>
							<div  class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert"></button>
								<strong><?php echo $success ;?></strong>
							</div>
							<?php }?>
						</div>
					<div class="box-content">
						<div class="row">
						 <div class="col-md-6 pull-right">
						 <div class="row">
						 <div class="col-md-12 pull-right">
						 <!--<input type="text" id="keyword"  placeholder="Search"  class="input-xlarge pull-left col-md-10" />
						 <input type="button" class="btn btn-primary search_btn" id="button" onClick="ClientSearch()" value="Search" /> -->
<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Add' ,
											array(
												'action' => 'addStaff'
											),
											array(
											
												'data-hint'=>'Add Client',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);?>
						 
						 </div>
						 </div>
						 </div>
						 </div>
						 </div>
					
						<table class="table table-striped my-table table-bordered bootstrap-datatable datatable custom_table" id="show_search_client">
						  <thead>
							   <tr  class="colr_body">
								  <th><?php echo __('Name');?></th>
								 <th><?php echo __('Username');?></th>
                                 <th><?php echo __('Permission');?></th>
								  <th class="col-sm-4">Actions</th>
							  </tr>
						  </thead>   
						  
					  <tbody>
					 <?php if (!empty($users))
					  {
					  $srN=1;
					  foreach ($users as $row) 
						{
					  ?>
							<tr class="odd colr_body">
									<td class="center" style='text-transform: capitalize'>
										<?php   //echo h($row['User']['first_name'])." ".h($row['User']['last_name']); 
										
										echo $this->Html->link(@h($row['User']['first_name'])." ".h($row['User']['last_name']),array('controller'=>'users', 'action'=>'user_bid_report',$row['User']['id']),array('escape' => FALSE,'target'=>'_blank'));
										
										
										
										?></td>
									
									<td class="center "><?php echo h($row['User']['username']); ?></td> 
                                    <td class="center ">
									<?php
                                    	$Permission = json_decode($row['User']['permission']);
										foreach(@$Permission as $prms)
										{
											switch(@$prms)
											{
												case "1" : echo "Vehicle Management<br>"; break;
												case "2" : echo "Country Management<br>"; break;
												case "3" : echo "Auction Management<br>"; break;
												case "4" : echo "Client Management<br>"; break;
												case "5" : echo "Brand Management<br>"; break;
												case "6" : echo "Port Management<br>"; break;
												case "7" : echo "Transport Management<br>"; break;
												case "8" : echo "Shipping Management<br>"; break;
												case "9" : echo "Vehicle Name Management<br>"; break;
												case "10" : echo "Invoice Management<br>"; break;
												case "11" : echo "Report Management<br>"; break;
												case "12" : echo "Sale Report<br>"; break;
												case "13" : echo "Ship Schedules Management<br>"; break;
												case "14" : echo "Bank Management<br>"; break;
												case "15" : echo "User Management<br>"; break;
												case "16" : echo "Miscellaneous<br>"; break;
												case "17" : echo "Hidden Vehicle<br>"; break;
												case "18" : echo "Home Page Slider<br>"; break;
												case "19" : echo "About Us<br>"; break;
												case "20" : echo "Page Management<br>"; break;
												
												case "21" : echo "CIF Query<br>"; break;
												case "22" : echo "Purchase Operation Management<br>"; break;
												case "23" : echo "Domeastic On Management<br>"; break;
												case "24" : echo "Overseas Sales Management<br>"; break;
												case "25" : echo "Recovery Management<br>"; break;
												case "26" : echo "Repair Parts Management<br>"; break;
												case "27" : echo "Land Trans | Carry In-Out Management<br>"; break;
												case "28" : echo "Inspection Ship & Depart Management<br>"; break;
												case "29" : echo "Concery Information<br>"; break;
											}
										}
									?>
                                    </td> 
									<td class="center sorting_1">

										<?php										
echo $this->Html->link(
   '<i class="fa fa-pencil"></i>',
    array(
    	'action' => 'editStaff', $row['User']['id']
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
									</td>
								</tr> 
						<?php
								 }
							$srNo++;}
						else
						{
						?>
								<tr><td colspan="10" style="text-align:center">Result not found</td></tr>  
						<?php
						}
						?>
							
							</tbody> 
							
					</table>         
					<?php 
					
					if($count > $limit){?>
						<div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
								<?php
									//echo  $this->Paginator->options(array('url'=>array('controller'=>'users','action'=>'allUsers')));
									echo $this->Paginator->prev(__('Prev'), array(
									'tag' => 'li',
									'label' => false
									));
								?>
								<?php
									echo $this->Paginator->numbers(array(
									'tag' => "li",
									'separator' => null,
									'currentClass' => 'active'
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
				</div><!--/span-->
			
			</div>
			</div>
			</div>
		
	
</div>
</div> <!-- Ajax response  close-->
