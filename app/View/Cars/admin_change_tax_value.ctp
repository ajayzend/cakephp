<?php echo $this->Html->script('jquery-form'); ?>
<div id="content1" >
		<div class="form-group col-md-12">
	<div class="box-header well">
		
									<div class="col-md-12"><h2><i class="fa fa-asterisk 
									sidebar_ico_margin">&nbsp;</i>Miscellaneous</h2><a href="<?php echo $this->Html->url('/admin/cars',true);?>"><button class=" btn btn-success pull-right" >Go Back</button></a></div>
										<div class="clearfix"></div>
																			
								</div>
	
		<?php
				$success = $this->Session->flash(); 
				if($success) {?>
				<div id="hideDiv">
					<div class="alert alert-success">
									
									<strong><?php echo $success ;?></strong>
					</div>
				</div>
			<?php }?>
				
		<?php echo $this->Form->create('Cars', array('action'=>'change_tax_value','id'=>'taxChange')); ?>
			
		<div class="form-group col-md-9">
						
			<?php // echo $this->Session->flash(); ?>
			<div class="form-group col-md-3">
			<label for="inputStock">Enter Tax Value</label>
			</div>
			<div class="controls">
				<div class="form-group col-md-4">
					<?php echo $this->Form->input('tax_value',array('type'=>'text','class'=>'form-control ','value'=>"$tax_value",'label'=>false,'required'=>false));?>
					<input type="hidden" value="<?php echo $id;?>" name="taxId" data-id="tax_id">
				</div>
				<div class="form-group col-md-2">
					<button type="submit" class="btn btn-primary" id="submit">Save</button>
					</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<div class="col-md-6">
							<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>Port Name</th>
										<th>Value</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									
									<?php 
									foreach($portDetail as $key=>$val)
									{
									
									?>  
									<tr id="tr_<?php echo $val['Tax']['id']; ?>">
										<td><?php echo $val['Tax']['port_name']; ?></td>
										<td><?php echo $val['Tax']['amount']; ?></td>
										<td class="port_detail">
											<a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName('<?php echo $val['Tax']['port_name'];?>','<?php echo $val['Tax']['amount'] ; ?>','<?php echo $val['Tax']['id']; ?>')"><i class="fa fa-pencil"></i>
											</a>
										</td>
										
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
</div>
</div>
<div class="modal fade in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cancel()">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Edit Port</h4>
			  </div>
			  <?php echo $this->Form->create('Tax',array('id'=>'editPortFrm')); ?>
			<div class="modal-body">		   
				
				<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>
				<input type="hidden" name="Tax[id]" id="id" />
				<label>Port Name</label>
				<?php echo $this->Form->input('port_name',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'port_name','required'=>true));?> 
				<div class="clearfix"></div>
				<div style="display:none;" id="errmessageDivIdImage" class="alert alert-danger"></div>
				<label>Port Value</label>
		       <?php echo $this->Form->input('amount',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'amount','required'=>true));?>
			
			</div>
			  <div class="modal-footer">
				
					<?php echo $this->Form->button('Save',array('class'=>'btn btn-primary','type'=>'button','onclick'=>"submitFormEditCar('editPortFrm');"))?>
					 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>			
			  </div> 
			  	<?php echo $this->Form->end(); ?>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
<script>
		function editName(p_name,amount,id){

		$(".modal-body #id").val(id);
	    $(".modal-body #port_name").val(p_name);
	    $(".modal-body #amount").val(amount);	
		$("#myModal1").modal('show');
		
		

		/*$.ajax({
		
			url:'<?php echo $this->Html->url('/admin/Cars/change_port_detail',true);?>',
			data:{'id':id},
			type:'post',
			success:function(data){
	 
				$("#myModal").html(data);
				//$("#myModal").modal('show');
				//$('#myModal1').modal('hide');
				
			}
		
		});*/

	}

	function submitFormEditCar(form_id)
	{
		$("#"+form_id).ajaxSubmit({
			url:'<?php echo $this->Html->url('/admin/Cars/change_port_detail',true);?>',
			type:"POST",
			success:function(data){
				
				var obj = JSON.parse(data);
			  
				if(obj.done='success'){


					str= '<td>'+obj.port_name+'</td><td>'+obj.amount+'</td><td class="port_detail"><a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName(\''+obj.port_name+'\',\''+obj.amount+'\',\''+obj.p_id+'\')"><i class="fa fa-pencil"></i></a></td>';

					$("#tr_"+obj.p_id).html(str);
					$('#myModal1').modal('hide');


				}
			}
			
			
		});
	}
</script>