<script>
function deleteAllBid(b_Id)
	{
			
			var msg = 'Are you sure you want to delete  bid of this car?';
			
			var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm?</h3></div><div class="modal-body"><div class="bootbox-body">'+msg+'</div></div><div class="modal-footer"><button onclick="deleteBidCar('+b_Id+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
			$("#mypop").html(str);
			$("#mypop").modal("show");

		
	}

	function deleteBidCar(b_Id)
	{

			$.ajax({
			type: "POST",
			url:"<?php echo $this->Html->url('/admin/reports/AllBidDelete',true);?>",
			data: {'cId':b_Id},
			success: function(data)
			{								
				$obj = jQuery.parseJSON( data );
				$("#mypop").modal("hide");				
				if($obj.status =='success')
				{
					$("#car_"+b_Id).hide();
					$("#successDiv").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Bid Records is successfully deleted</strong></div>');
					$("#successDiv").show();
				}else
				{
					$("#successDiv").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error : Something went wrong !!!</strong></div>');
					$("#successDiv").show();
				}
				
				
				
				
			},
			failure: function(data)
			{
				alert('Error occur');
			}
			});
		
	}	
	
	
	
</script>
	



<div id="ajax-response">
<div id="content1">
			<!-- content starts -->
			
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class=" col-md-12"><h2><i class="fa fa-users">&nbsp;</i> <?php echo __('Bid Report List'); ?></h2></div>
								<div class="clearfix"></div>	
					</div>
						<div id="successDiv"></div>
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
												'action' => 'index?tab=bid'
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
						
						<h2> Bid in Dollar </h2>
						<table class="table table-striped table-bordered custom_table" id="myTable">
								<thead>
									<tr>
										<!--<th>S.No.</th>-->
										<th>Name</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Amount($)</th>
										<th>Chechis No.</th>
										<th>Car Name</th>
										<th>Date</th>
										<th>User Type</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									
								<?php 
								
								
								 foreach($bidresult as  $val){										
									?>
								<tr  id ='car_<?php echo $val['Bid']['id']; ?>'>
								
									<td>
										<?php
											if($val['Bid']['name']=='')
											{
												echo $val['User']['first_name'].' '.$val['User']['last_name'];
											}else
											{
												echo $val['Bid']['name'];
											}
										 ?>
									</td>
									<td>
										
										<?php 
											if($val['Bid']['email']=='')
											{
												echo $val['User']['email'];
											}
											else
											{
												echo $val['Bid']['email'];
											}
										?>
									
									</td>
									<td>
										<?php 
											if($val['Bid']['cnumber']=='')
											{
												echo $val['User']['contact'];
											}
											else
											{
												echo $val['Bid']['cnumber'];
											}
										?>
									</td>
									<td>
										<?php echo $val['Bid']['amount'];?>
									</td>
									<td>
										<?php echo $val['Car']['cnumber'];?>
									</td>
									<td>
										<?php echo @$val['Car']['CarName']['car_name'];?>
									</td>
									<td>
										<?php $bidDate = date('d-m-Y',strtotime($val['Bid']['date']));echo $bidDate;?>
									</td>
									<td>
										<?php 
											if($val['Bid']['name']=='')
											{
												echo 'Registered';
											}
											else
											{
												echo 'Guest';
											}
										?>
									</td>
									<td>
										<?php /*
												 	echo $this->Form->postLink(
														'<i class="fa fa-trash-o"></i>',
														array('action' => 'AllBidDelete', $val['Car']['id']),
														array('confirm' => 'Are you sure you want to delete all bid of this car ID?','data-hint'=>'Delete All','class'=>'btn btn-danger hint--bottom','escape'=>false)
													);*/
												?>
										
						
										<button onclick="deleteAllBid('<?php echo $val['Bid']['id']; ?>');" title="Delete All" type="button" data-bb-handler="confirm"  class="fa fa-trash-o btn btn-danger hint--bottom" />
									</td></tr>
								<?php } ;?>	
								</tbody>
							</table>
							
							
							
						<h2> Bid in Yen </h2>
						<table class="table table-striped table-bordered custom_table" id="myTable">
								<thead>
									<tr>
										<!--<th>S.No.</th>-->
										<th>Name</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Amount(￥)</th>
										<th>Chechis No.</th>
										<th>Car Name</th>
										<th>Date</th>
										<th>User Type</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									
								<?php 
								
								
								 foreach($bidresultInYen as  $val){										
									?>
								<tr  id ='car_<?php echo $val['Bid']['id']; ?>' >
								
									<td>
										<?php
											if($val['Bid']['name']=='')
											{
												echo $val['User']['first_name'].' '.$val['User']['last_name'];
											}else
											{
												echo $val['Bid']['name'];
											}
										 ?>
									</td>
									<td>
										
										<?php 
											if($val['Bid']['email']=='')
											{
												echo $val['User']['email'];
											}
											else
											{
												echo $val['Bid']['email'];
											}
										?>
									
									</td>
									<td>
										<?php 
											if($val['Bid']['cnumber']=='')
											{
												echo $val['User']['contact'];
											}
											else
											{
												echo $val['Bid']['cnumber'];
											}
										?>
									</td>
									<td>
										<?php echo $val['Bid']['amount'];?>
									</td>
									<td>
										<?php echo $val['Car']['cnumber'];?>
									</td>
									<td>
										<?php echo @$val['Car']['CarName']['car_name'];?>
									</td>
									<td>
										<?php $bidDate = date('d-m-Y',strtotime($val['Bid']['date']));echo $bidDate;?>
									</td>
									<td>
										<?php 
											if($val['Bid']['name']=='')
											{
												echo 'Registered';
											}
											else
											{
												echo 'Guest';
											}
										?>
									</td>
									<td>
										<?php /*
												 	echo $this->Form->postLink(
														'<i class="fa fa-trash-o"></i>',
														array('action' => 'AllBidDelete', $val['Car']['id']),
														array('confirm' => 'Are you sure you want to delete all bid of this car ID?','data-hint'=>'Delete All','class'=>'btn btn-danger hint--bottom','escape'=>false)
													);*/
												?>
										
						
										<button onclick="deleteAllBid('<?php echo $val['Bid']['id']; ?>');" title="Delete All" type="button" data-bb-handler="confirm"  class="fa fa-trash-o btn btn-danger hint--bottom" />
									</td></tr>
								<?php } ;?>	
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
<div class="modal fade" id="mypop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm? </h4>
      </div>
      <div class="modal-body" id='mypop_body'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='save_button'>Save</button>
      </div>
    </div>
  </div>  
</div>
