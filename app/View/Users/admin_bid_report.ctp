<div id="ajax-response">
<div id="content1">
			<!-- content starts -->
			
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class=" col-md-12"><h2><i class="fa fa-users">&nbsp;</i> <?php echo __('Bid Report List'); ?></h2></div>
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
				         <div class="col-md-12">
						 <div class="row">
						 <div class="col-md-12"></div>
						 <div class="col-md-6 pull-right">
						 <!--<input type="text" id="keyword"  placeholder="Search"  class="input-xlarge pull-left col-md-10" />
						 <input type="button" class="btn btn-primary search_btn" id="button" onClick="ClientSearch()" value="Search" /> -->
						 
						 <?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Back' ,
											array(
												'action' => 'allUsers'
											),
											array(
											
												'data-hint'=>'All Users Detail',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);?>

						 <!--<div class="add_btn col-md-2 pull-right hint--bottom"  data-hint="Add Clients" style="padding-right:0px;"><?php //echo $this->Html->link(__("Add",true),"/admin/users/addUser",array('type'=>'submit','class'=>"btn btn-primary pull-right")) ?>
						
						 </div>-->
						 
						 </div>
						 </div>
						 </div>
						 </div>
						 </div>
					
				 <!--  Bit Report -->
				<div class="tab-pane" id="bid-report"><!--Sales Report-->
					<div class="row">
						<div class="col-md-12">
						<?php
								$success = $this->Session->flash(); 
								if($success) {?>
								<div id="hideDiv">
									<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong><?php echo $success ;?></strong>
									</div>
								</div>
								<?php }?>
						</div>
					</div>
					
					<div class="row" id="report">
						<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<!--<th>S.No.</th>-->
										<th>Name</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Bit Amount</th>
										<th>Chechis No.</th>
										<th>Car Name</th>
										<th>Date</th>
										<!--<th>User Type</th>-->
										<th stylt="width:40%;">Action</th>
										
									</tr>
								</thead>
								<tbody>
									
								<?php 
								
								if($bidresult)
								{
								 foreach($bidresult as $key => $val){
		//pr($v)
									?>
								<tr>
								
									<td><?php if($val['Bid']['name']==''){echo $val['User']['first_name'];}
									else{echo $val['Bid']['name'];}?></td>
									<td><?php if($val['Bid']['email']==''){echo $val['User']['email'];}
									else{echo $val['Bid']['email'];}?></td>
									<td><?php if($val['Bid']['cnumber']==''){echo $val['User']['contact'];}
									else{echo $val['Bid']['cnumber'];}?></td>
									<td><?php echo $val['Bid']['amount'];?></td>
									<td><?php echo $val['Car']['cnumber'];?></td>
									<td><?php echo @$val['Car']['CarName']['car_name'];?></td>
									<td><?php $bidDate = date('d-m-Y',strtotime($val['Bid']['date']));echo $bidDate;?></td>
									<!--<td><?php //if($v['Bid']['name']==''){//echo 'Registered';}else{echo 'Guest';}?></td>-->
									<td>
									<?php
												echo $this->Form->postLink(
													'<i class="fa fa-trash-o"></i>',
													array('action' => 'delete', $val['Bid']['id']),
													array('confirm' => 'Are you sure?','data-hint'=>'Delete','class'=>'btn btn-danger hint--bottom','escape'=>false)
												);
											?>
									<?php
												/*echo $this->Form->postLink(
													'<i class="fa fa-trash-o"></i>',
													array('action' => 'AllBidDelete', $val['Bid']['car_id']),
													array('confirm' => 'Are you sure?','data-hint'=>'Delete All Bid','class'=>'btn btn-danger hint--bottom','escape'=>false)
												);*/
												
											?>
									</td></tr>
								<?php }}else{?>
									<tr><td colspan=9  align='center' >  No Bid Found</td></tr>
									<?php }?>	
								</tbody>
							</table>
					</div>
				</div>
				
				<!--  Bid Report -->  
					
				</div><!--/span-->
			
			</div>
			</div>
			</div>
		
	
</div>
<div> <!-- Ajax response  close-->
