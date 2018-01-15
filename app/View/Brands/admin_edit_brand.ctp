<?php echo $this->Html->script('jquery-form'); ?>
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Edit Brand</h4>
      </div>
	  <?php echo $this->Form->create('Brand',array('enctype' => 'multipart/form-data','id'=>'editDataFrm')); ?>
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
		
			<label class="control-label" for="inputLocation">Brand Name</label>
			<div class="controls">
				<?php echo $this->Form->input('brand_name',array('type'=>'text','class'=>'form-control','label'=>false, 'value'=>$brand_name)); ?>
				
			
			</div>
		</div>	
		
		
		<ul class="country_modl_li">
		<li data-image="<?php echo $brand_image;?>"><!--<i  onclick="removeTempImage('<?//php echo $Image;?>');" class="fa fa-times pull-right"></i>--><img src="<?php echo $this->webroot.$brand_image;?>"></img></li>
		</ul>
		
		
		<div class="control-group">
		
			<div style="display:none;" id="errmessageDivIdAddpopupImage" class="alert alert-danger"></div>
			<div class="controls">
			 <?php echo $this->Form->input('brand_image', array('label' => 'Upload Image:', 'type' => 'file'));  ?>
				
			
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

	function submitForm(){
		$("#editDataFrm").ajaxSubmit({
			
			url:"<?php echo $this->Html->url('/admin/brands/save_brandname',true);?>",
			type:"POST",
			success:function(result){
			   $("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform(); 
				var obj = jQuery.parseJSON(result);
				if(obj.status!='error'){
					$("#brandTdNme"+obj.data.Brand.id).html(obj.data.Brand.brand_name);
					$('#myModal').modal('toggle');
					$('#messageDivIdAdd').show();
					$('#messageDivIdAdd').html(obj.message);
					$( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
					//$('#myModal1').modal('hide');
				}else{
					
					$.each(obj.message, function(key, value){
						if(key=='brand_name'){
							$('#errmessageDivIdAddpopup').show();
							$('#errmessageDivIdAddpopup').html(value[0]);
							$('#errmessageDivIdAddpopup' ).delay(5000).fadeOut( "slow" );
						}else if(key=='brand_image'){
							$('#errmessageDivIdAddpopupImage').show();
							$('#errmessageDivIdAddpopupImage').html(value[0]);
							$('#errmessageDivIdAddpopupImage' ).delay(5000).fadeOut( "slow" );
						}else{
							$('#errmessageDivIdAddpopupImage').show();
							$('#errmessageDivIdAddpopupImage').html(obj.message);
							$('#errmessageDivIdAddpopupImage' ).delay(5000).fadeOut( "slow" );
						}
						
					});
				}
			}
			
		});
	}



</script>
