<?php echo $this->Html->script('jquery-form'); ?>

<div id="content2" class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <h4 class="modal-title"><i class="icon-edit"></i> Add Bank</h4>
      </div>
	 
<div class="modal-body">
	 
	<div class="row-fluid sortable">
				<div class="">					
					<div class="box-content">
				<form id="addBankForm" >
							<fieldset>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Bank Name<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input("Bank.bank_name" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAdd" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Branch Name<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input("Bank.branch_name" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddBranch" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Swift Name<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input("Bank.swift_name" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddSwift" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Account No.<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input("Bank.account_no" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddAcntNo" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Account Name<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->input("Bank.account_name" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddAcntName" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Discription<span style="color:red">*</span></label>
								<div class="controls">
								 <?php echo $this->Form->textarea("Bank.discription" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddDscrpsn" class="red_text"></div>
								</div>
							  </div>							  							  							  							  										
							 
						  			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			</div>
			<div class="model-footer">
			
						  
						  
						  <div>
								
							</div>
						  
						  
						  </div>
					



<div class="modal-footer">

<a href="javascript:void(0);" onclick="saveBank();" class="btn btn-primary" >Save</a>

<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

						  </form>

		<!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>					
						  
			</div>
	</div>
<script>
	function saveBank(){

		var rowVal = $("#bankBody tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
			$("#addBankForm").ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/banks/add',true);?>",
			type:"POST",
			dataType:'JSON',
			success:function(data){
				
				if(data.status == 'success'){
					
					$.ajax({
						url:"<?php echo $this->Html->url('/admin/banks/render_page_bank',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal').modal('hide');
							$('#messageDivIdAdd').show();
							$('#messageDivIdAdd').html(data.message);
							$('#messageDivIdAdd').delay(5000).fadeOut( "slow" );
							
						}	
					});
					
				}else{
					$.each(data.message, function(key, value){
						if(key=='bank_name'){
							$('#errmessageDivIdAdd').show();
							$('#errmessageDivIdAdd').html(value[0]);
							$('#errmessageDivIdAdd').delay(5000).fadeOut( "slow" );
						}else if(key=='branch_name'){
							$('#errmessageDivIdAddBranch').show();
							$('#errmessageDivIdAddBranch').html(value[0]);
							$('#errmessageDivIdAddBranch').delay(5000).fadeOut( "slow" );
						}else if(key=='swift_name'){
							$('#errmessageDivIdAddSwift').show();
							$('#errmessageDivIdAddSwift').html(value[0]);
							$('#errmessageDivIdAddSwift').delay(5000).fadeOut( "slow" );
						}else if(key=='account_no'){
							$('#errmessageDivIdAddAcntNo').show();
							$('#errmessageDivIdAddAcntNo').html(value[0]);
							$('#errmessageDivIdAddAcntNo').delay(5000).fadeOut( "slow" );
						}else if(key=='account_name'){
							$('#errmessageDivIdAddAcntName').show();
							$('#errmessageDivIdAddAcntName').html(value[0]);
							$('#errmessageDivIdAddAcntName').delay(5000).fadeOut( "slow" );
						}else if(key=='discription'){
							$('#errmessageDivIdAddDscrpsn').show();
							$('#errmessageDivIdAddDscrpsn').html(value[0]);
							$('#errmessageDivIdAddDscrpsn').delay(5000).fadeOut( "slow" );
						}
						
					});
				}
			
			}
			
		});	
	
}

</script>
