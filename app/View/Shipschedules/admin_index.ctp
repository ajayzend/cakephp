<?php echo $this->Html->css(array('select2'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>

<?php echo $this->Html->script('jquery-form'); ?>
<div id="content1">
	<div class="row sortable">
		<div class="box col-md-12">
			<div class="box-header well">
				<div class="col-md-12"><h2>
					<i class="fa fa-retweet"></i>
						Shipping Schedule Management</h2></div>
				<div class="clearfix"></div>	
			</div>
			
		<div style="display:none;" id="messageDivIdAdd" class="alert alert-success "></div>
		<div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger"></div>
			<div class="box-content">
				<div class="row">
					<div class="col-md-6">	
			<div id="showAllUsrDivBtn" style="display:none;" class="col-md-3">
				<button class="btn btn-primary btn-lg" onClick="showAllShipping();">Clear Search</button>
			</div>
				
				
					</div>
					
				<div class="col-md-6">
				
					<button class="btn btn-primary btn-lg pull-right hint--bottom"  data-hint="Add Shipping Schedule" data-toggle="modal" data-target="#myModal1">
					 <i class="fa fa-plus-circle">&nbsp;</i>Add Shipping Schedule <!-- Shipping -->
					</button>
				</div>
			</div>
		</div>
		<div id="divid127">
		<table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<!-- <td>Sr.No</td> -->
					<td>Shipping Company</td>
					<td>Region</td>
					<td>Ship Name</td>
					<td>Departure Port</td>
					<td>Departure Date</td>				
					<td>Arrival Port</td>
					<td>Arrival Date</td>
					<td>Via Location</td>
					<td>Remark</td>
                    <td>Chasis No</td>
					<td>Status</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody id="searchdata" class="colr_body">
			<?php 
					$srNo++;
					foreach($shippingSchedule as $val){?>
						<tr id="shipTrId<?php echo $val['Shipschedule']['id'];?>">
							<!-- <td data-sorting="sort"><?php echo $srNo;?></td> -->
							
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['ship_name'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['region'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['ship_no'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['departure_port'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php  echo date('d-M-Y',strtotime($val['Shipschedule']['departure_date'])); ?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['arrival_port'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo date('d-M-Y',strtotime($val['Shipschedule']['arrival_date'])); ?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['via_location'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['remark'];?></td>
                            <td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['chasis'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>">
							
							<?php 
											if ($val['Shipschedule']['status']==0) {
													$status = "Publish";
													$style ="btn btn-success"; 
												} else {
													$status = "Unpublish";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="status<?php echo $val['Shipschedule']['id'];?>" onClick="ShipStatus(<?php echo $val['Shipschedule']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $val['Shipschedule']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
							
							</td>
							
							
							
							<td class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName('<?php echo $val['Shipschedule']['id'];?>','<?php echo $val['Shipschedule']['ship_name'];?>','<?php echo $val['Shipschedule']['ship_no'];?>','<?php echo $val['Shipschedule']['region'];?>','<?php echo $val['Shipschedule']['departure_port'];?>','<?php echo $val['Shipschedule']['departure_date'];?>','<?php echo $val['Shipschedule']['arrival_port'];?>','<?php echo $val['Shipschedule']['arrival_date'];?>','<?php echo $val['Shipschedule']['via_location'];?>','<?php echo $val['Shipschedule']['remark'];?>', '<?php echo $val['Shipschedule']['chasis'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Shipschedule']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>

					<?php $srNo++;} ?>
		</table>
		</div>
		<div></div></div>
		<?php if($count > $limit) { ?>
	<div id="paginationDiv" class="col-md-6 pull-right">
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
				'currentClass' => 'active'
				));
			?>
			<?php
				echo $this->Paginator->next(__('Next'), array(
				'tag' => 'li',
				'label' => false,
				'class' => null
				));
			?>


		</ul>
	</div>  
<?php } ?>
</div>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="myloader" id="loading" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
				</div>
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cancel()">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Shipping Schedule</h4>
			  </div>
			  <?php echo $this->Form->create('Shipschedule',array('id'=>'addDataFrm')); ?>
			  <div class="modal-body">			
				<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>
				<div class="form-group col-sm-6">
				<label>Shipping Name</label>
				<div style="display:none;" id="errSN" class="red_text"></div>
				<?php echo $this->Form->input('ship_name',array('type'=>'text','class'=>'form-control','id'=>'ship_name','label'=>false,'required'=>true,"placeholder"=>"Please enter 1 more characters"));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Ship Name.</label>
				<div style="display:none;" id="errShip" class="red_text"></div>
				<?php echo $this->Form->input('ship_no',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Region</label>
				<div style="display:none;" id="errR" class="red_text"></div>
				
				<?php echo $this->Form->input('region',array('type'=>'text','id'=>'region','class'=>'form-control','label'=>false,'required'=>true,"placeholder"=>"Please enter 1 more characters"));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Departure Port</label>
				<div style="display:none;" id="errDP" class="red_text"></div>

				<?php echo  $this->Form->input('departure_port',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'departure_port','required'=>true,"placeholder"=>"Please enter 1 more characters")); ?>
				</div>
				<div class="form-group col-sm-6">
				<label>Departure Date</label>
				<div style="display:none;" id="errDD" class="red_text"></div>
				<?php echo $this->Form->input('departure_date',array('type'=>'text','class'=>'form-control ','id'=>'departure_date','label'=>false,'required'=>true));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Arrival Port</label>
				<div style="display:none;" id="errAP" class="red_text"></div>
		
				<?php echo $this->Form->input('arrival_port',array('type'=>'text','id'=>'arrival_port' ,'class'=>'form-control','label'=>false,'required'=>true,"placeholder"=>"Please enter 1 more characters"));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Arrival Date</label>
				<div style="display:none;" id="errAD" class="red_text"></div>
				<?php echo $this->Form->input('arrival_date',array('type'=>'text','class'=>'form-control','id'=>'arrival_date','label'=>false,'required'=>true));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Via Location</label>
				<div style="display:none;" id="errVL" class="red_text"></div>
				<?php echo $this->Form->input('via_location',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
				</div>
				<div class="form-group col-sm-6">
				<label>Remark</label>
				<div style="display:none;" id="errRemark" class="red_text"></div>
				<?php echo $this->Form->input('remark',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>					
				</div>
                <div class="form-group col-sm-6">
				<label>Car Reference Number</label>
				<div style="display:none;" id="errChasis" class="red_text"></div>
				<?php echo $this->Form->input('chasis',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>					
				</div>
				<div class="clearfix"></div>
			</div><!-- /.modal-content -->
			
			<div class="modal-footer">				
				<?php echo $this->Form->button('Save',array('class'=>'btn btn-primary','type'=>'button','onclick'=>"submitFormShippingSchedule('addDataFrm');"))?>
				 <button type="button" class="btn btn-danger" data-dismiss="modal" onClick="cancel()">Cancel</button>
				
			  </div>  
			  <?php echo $this->Form->end(); ?>
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->



	</div>
</div>
</div>


<script>
	
	
 function ShipStatus(id)
{
	var val =$('#status'+id).val() ;
	if(val == 'Publish')
	{	
	  var status = 1;
	}
	else
	{
		var status = 0;
	}
	var datas  =  {'id':id,'status':status}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/shipschedules/ship_status',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading"+id).show();
           },
		success:function(result)
		{
			 $("#loading"+id).hide();
			$('#status'+id).val(result);
			if(result=='Publish')
			{
				$('#status'+id).removeClass('btn btn-danger').addClass('btn btn-success');
			}else
			{
				$('#status'+id).removeClass('btn btn-success').addClass('btn btn-danger');
			}
		}
						
	});
}
 
	
	
	
	
	
	$( "#region" ).autocomplete({
		autoFocus: true,
		source: '<?php echo $this->Html->url('/admin/shipschedules/show_region',true);?>'
	});
	
	$( "#arrival_port" ).autocomplete({
		autoFocus: true,
		source: '<?php echo $this->Html->url('/admin/shipschedules/show_arrival_port',true);?>'
	});

	$( "#departure_port" ).autocomplete({
		autoFocus: true,
		source: '<?php echo $this->Html->url('/admin/shipschedules/show_departure_port',true);?>'
	});
	
	$( "#ship_name" ).autocomplete({
		autoFocus: true,
		source: '<?php echo $this->Html->url('/admin/shipschedules/show_ship_name',true);?>'
	});
	
	$(function() {
		$("#departure_date").datepicker({ dateFormat: 'yy-mm-dd' ,yearRange: '-40:+0'}); 
		$("#arrival_date").datepicker({yearRange: '-40:+0', dateFormat: 'yy-mm-dd' }); 
		
		});
	
	
	
	// this function is used for adding brand name
	function submitFormShippingSchedule(form_id){
		var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/shipschedules',true);?>",
			type:"POST",
			beforeSend: function() {
              $("#loading").show();
           },
			success:function(result){
				 $("#loading").hide();
					var obj = jQuery.parseJSON(result); 
					
					if(obj.status !='error'){
						$.ajax({
						url:"<?php echo $this->Html->url('/admin/shipschedules/render_page_shipping',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal1').modal('hide');
							$('#messageDivIdAdd').show();
							$('#messageDivIdAdd').html(obj.message);
							$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
							$("#"+form_id)[0].reset();
						}
						
					});
					
				}else{
					
					$.each(obj.message, function(key, value){errShip
						if(key=='ship_name'){
							$('#errSN').show();
							$('#errSN').html(value[0]);
							$('#errSN' ).delay(5000).fadeOut( "slow" );
						}else if(key=='ship_no'){
							$('#errShip').show();
							$('#errShip').html(value[0]);
							$('#errShip' ).delay(5000).fadeOut( "slow" );
						}else if(key=='region'){
							$('#errR').show();
							$('#errR').html(value[0]);
							$('#errR' ).delay(5000).fadeOut( "slow" );
						}else if(key=='departure_port'){
							$('#errDP').show();
							$('#errDP').html(value[0]);
							$('#errDP' ).delay(5000).fadeOut( "slow" );
						}else if(key=='departure_date'){
							$('#errDD').show();
							$('#errDD').html(value[0]);
							$('#errDD' ).delay(5000).fadeOut( "slow" );
						}else if(key=='arrival_port'){
							$('#errAP').show();
							$('#errAP').html(value[0]);
							$('#errAP' ).delay(5000).fadeOut( "slow" );
						}else if(key=='arrival_date'){
							$('#errAD').show();
							$('#errAD').html(value[0]);
							$('#errAD' ).delay(5000).fadeOut( "slow" );
						}else if(key=='via_location'){
							$('#errVL').show();
							$('#errVL').html(value[0]);
							$('#errVL' ).delay(5000).fadeOut( "slow" );
						}else if(key=='remark'){
							$('#errRemark').show();
							$('#errRemark').html(value[0]);
							$('#errRemark' ).delay(5000).fadeOut( "slow" );
						}
						else if(key=='chasis'){
							$('#errChasis').show();
							$('#errChasis').html(value[0]);
							$('#errChasis' ).delay(5000).fadeOut( "slow" );
						}
						
					});
				}
			}
			
		});
	}
	
	//Edit brand name 
	
	
	
	
	function editName(id,shipName,ShipNo,region,DP,DD,AP,AD,VL,R, CHS){
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="myloader" id="loading2" style="display:none;"><img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> </div><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cancel()">&times;</button><h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Shipping Schedule</h4></div><form name="Shipschedule" id="editDataFrm"> <div class="modal-body"><div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div><label>Shipping Name</label><div style="display:none;" id="errSN" class="red_text"></div><input type="hidden" name="id" id="id"  class="form-control" value='+id+' /><input type="text" name ="ship_name" id= "ship_name"  class="form-control" value='+shipName+' /><label>Ship Name</label><div style="display:none;" id="" class="red_text"></div><input type="text" name ="ship_no" id= "ship_no" class="form-control" value='+ShipNo+' /><label>Region</label><div style="display:none;" id="errR" class="red_text"></div><input type="text" name ="region" id= "region" class="form-control" value='+region+' /><label>Departure Port</label><div style="display:none;" id="errDP" class="red_text"></div><input type="text" name ="departure_port" id= "departure_port" class="form-control" value='+DP+' /><label>Departure Date</label><div style="display:none;" id="errDD" class="red_text"></div><input type="text" name ="departure_date" id= "departure_date" class="form-control datepicker" value='+DD+' /><label>Arrival Port</label><div style="display:none;" id="errAP" class="red_text"></div><input type="text" name ="arrival_port" id= "arrival_port" class="form-control" value='+AP+' /><label>Arrival Date</label><div style="display:none;" id="errAD" class="red_text"></div><input type="text" name ="arrival_date" id= "arrival_date" class="form-control" value='+AD+' /><label>Via Location</label><div style="display:none;" id="errVL" class="red_text"></div><input type="text" name ="via_location" id= "via_location" class="form-control" value='+VL+' /><label>Remark</label><div style="display:none;" id="errRemark" class="red_text"></div><input type="text" name ="remark" id= "remark" class="form-control" value='+R+' /><label>Car Reference Number</label><div style="display:none;" id="errChasis" class="red_text"></div><input type="text" name ="chasis" id= "chasis" class="form-control" value='+CHS+' /><div class="modal-footer"><input type="button" value="Save" class="btn btn-primary" onclick="submitEditFormShippingSchedule(\'editDataFrm\');" ><button type="button" class="btn btn-danger" data-dismiss="modal" onClick="cancel()">Cancel</button></div></form></div></div>'
		$("#myModal").html(str);
		$("#myModal").modal("show");

	}
	
	
	function submitEditFormShippingSchedule(form_id){ 
		var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/shipschedules/editSchedule',true);?>",
			type:"POST",
			beforeSend: function() {
              $("#loading2").show();
           },
			success:function(result){
				 $("#loading2").hide();
					var obj = jQuery.parseJSON(result); 
					
					if(obj.status !='error'){
						var pageNo = obj.pageNo;
						$.ajax({
						url:"<?php echo $this->Html->url('/admin/shipschedules/render_page_shipping',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal').modal('hide');
							$('#messageDivIdAdd').show();
							$('#messageDivIdAdd').html(obj.message);
							$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
							$("#"+form_id)[0].reset();
						}
						
					});
					
				}else{
					
					$.each(obj.message, function(key, value){
						if(key=='ship_name'){
							$('#errSN').show();
							$('#errSN').html(value[0]);
							$('#errSN' ).delay(5000).fadeOut( "slow" );
						}else if(key=='region'){
							$('#errR').show();
							$('#errR').html(value[0]);
							$('#errR' ).delay(5000).fadeOut( "slow" );
						}else if(key=='departure_port'){
							$('#errDP').show();
							$('#errDP').html(value[0]);
							$('#errDP' ).delay(5000).fadeOut( "slow" );
						}else if(key=='departure_date'){
							$('#errDD').show();
							$('#errDD').html(value[0]);
							$('#errDD' ).delay(5000).fadeOut( "slow" );
						}else if(key=='arrival_port'){
							$('#errAP').show();
							$('#errAP').html(value[0]);
							$('#errAP' ).delay(5000).fadeOut( "slow" );
						}else if(key=='arrival_date'){
							$('#errAD').show();
							$('#errAD').html(value[0]);
							$('#errAD' ).delay(5000).fadeOut( "slow" );
						}else if(key=='remark'){
							$('#errRemark').show();
							$('#errRemark').html(value[0]);
							$('#errRemark' ).delay(5000).fadeOut( "slow" );
						}
						else if(key=='chasis'){
							$('#errChasis').show();
							$('#errChasis').html(value[0]);
							$('#errChasis' ).delay(5000).fadeOut( "slow" );
						}
						
					});
				}
			}
			
		});
	}
	
	
	function deleteSchedule(id,pageNo){
		var id = id;
		var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/shipschedules/delete',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			beforeSend: function() {
              $("#loading1").show();
           },
			success:function(data){
					 $("#loading1").hide();
				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){

						$.ajax({
						url:"<?php echo $this->Html->url('/admin/shipschedules/render_page_shipping',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal').modal('hide');
							$('#errmessageDivIdDel').show();
							$('#errmessageDivIdDel').html(data.message);
							$('#errmessageDivIdDel').delay(5000).fadeOut( "slow" );
						}
						
					});
				}else{
					$("#myModal").html('');
					$("#myModal").modal('show');

				}

			}
		
		});
	}

	function checkDelete(id,pageNo)
	{
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="myloader" id="loading1" style="display:none;"><img src="<?php echo $this->webroot; ?>ajax-loader.gif"/></div><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete your Shipping Schedule ?</div></div><div class="modal-footer"><button onclick="deleteSchedule('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
		$("#myModal").html(str);
		$("#myModal").modal("show");
	}
	
	function cancel(){
		$("#addDataFrm")[0].reset();
	}
</script>

			
			
	

	

