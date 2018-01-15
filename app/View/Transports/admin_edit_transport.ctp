<?php echo $this->Html->script('jquery-form'); ?>
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Edit Transport</h4>
      </div>




<?php echo $this->Form->create('Transport',array('id'=>'editDataFrm','action' => 'save_transportname')); ?>
<div class="modal-body">	
		<div class="row-fluid">
			<div class="control-group">
				
				<div class="controls">
				<?php echo $this->Form->input('id',array('type'=>'hidden','class'=>'input-xlarge','label'=>false,'readonly'=>true,'value'=>$id)); ?>
				
				</div>
			</div>
		</div>
				<div style="display:none;" id="errmessageDivIdAddpopup" class="alert alert-danger">
					
				</div>	
		<div class="control-group">
			<label class="control-label" for="inputLocation">Transport Name</label>
			<div class="controls">
				<?php echo $this->Form->input('transport_name',array('type'=>'text','class'=>'form-control','label'=>false, 'value'=>$transport_name)); ?>
				
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
			url:"<?php echo $this->Html->url('/admin/transports/save_transportname',true);?>",
			type:"POST",
			success:function(result){
				var obj = jQuery.parseJSON(result);
				if(obj.status=='success'){
					
					$("#trnsprtTdNme"+obj.data.Transport.id).html(obj.data.Transport.transport_name);
					$('#myModal').modal('toggle');
					$('#messageDivIdAdd').show();
					$('#messageDivIdAdd').html(obj.message);
					$( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
				}else{
					$('#errmessageDivIdAddpopup').show();
					$('#errmessageDivIdAddpopup').html(obj.message.transport_name[0]);
					$( '#errmessageDivIdAddpopup' ).delay(7000).fadeOut( "slow" );
				}
			}
			
		});
	}



</script>
