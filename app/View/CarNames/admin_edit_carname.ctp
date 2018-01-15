<?php echo $this->Html->script('jquery-form'); ?>
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Edit Car Name</h4>
      </div>




	<?php echo $this->Form->create('CarName',array('id'=>'editDataFrm')); ?>
<div class="modal-body">
<div class="row-fluid">
			<div class="control-group">
				
				<div class="controls">
				<?php echo $this->Form->input('id',array('type'=>'hidden','class'=>'input-xlarge','label'=>false,'readonly'=>true,'value'=>$id)); ?>
				
				</div>
			</div>
		</div>
					<div style="display:none;" id="errmessageDivIdAddpopup" class="alert alert-danger"></div>
                    
                    <div class="control-group">
                    <label>Brand</label>
		<select class="form-control" name="data[CarName][brand_id]">
        	<option value="">Select Brand Name</option>
            <?php
			foreach($BrrandNames as $BrnNm)
			{
				?>
                <option <?php if($carBrand == $BrnNm['Brand']['id']) { ?> selected <?php } ?> value="<?=$BrnNm['Brand']['id']?>"><?=$BrnNm['Brand']['brand_name']?></option>
                <?php
			}
			?>
        </select>
        </div>
        
        
		<div class="control-group">
			<label class="control-label" for="inputLocation">Car Name</label>
			<div class="controls">
				<?php echo $this->Form->input('car_name',array('type'=>'text','class'=>'form-control','label'=>false, 'value'=>$car_name)); ?>
				
			</div>
		</div>	
						
</div> 
<div class="modal-footer">
				
					 <?php echo $this->Form->button('Save',array('class'=>'btn btn-primary','type'=>'button','onclick'=>"submitForm('editDataFrm');"))?>
	 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>	
			  </div> 
 
 	<?php echo $this->Form->end(); ?>

 </div><!-- /.modal-content -->
 
</div>

<script>

	function submitForm(form_id){
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/CarNames/save_carname',true);?>",
			type:"POST",
			success:function(result){
				
				
				var obj = jQuery.parseJSON(result);
				if(obj.status!='error'){
					$("#carnameTdNme"+obj.data.id).html(obj.data.name);
					$("#carBrandTdNme"+obj.data.id).html(obj.data.brand);
					$('#myModal').modal('toggle');
					$('#messageDivIdAdd').show();
					$('#messageDivIdAdd').html(obj.message);
					$( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
				}else{
				
					$('#errmessageDivIdAddpopup').show();
					$('#errmessageDivIdAddpopup').html(obj.message.car_name[0]);
					//$('#myModal1').modal('hide');
					$( '#errmessageDivIdAddpopup' ).delay(5000).fadeOut( "slow" );
				}
			}
			
		});
	}



</script>
