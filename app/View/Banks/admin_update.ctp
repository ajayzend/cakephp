<?php echo $this->Html->script('jquery-form'); ?>

<div class="modal-dialog" >
<div class="">
<div class="modal-content">

<div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <h4 id="myModalLabel" class="modal-title"><i class="icon-edit"></i>Edit Bank</h4>
      </div>

<div class="modal-body">
	<div class="row-fluid sortable">
				<div class="box span12">					
					<div class="box-content">
					<form id='updateBankForm'>
							<fieldset>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Bank Name</label>
								<div class="controls">
								<input type="hidden" id="" name="id" value="<?php echo $bankId; ?>" />
								 <?php echo $this->Form->input("bank_name" ,array('label' => false,'class'=>"form-control",'value'=>$bankName ))?>
								 <div style="display:none;" id="errmessageDivIdAdd" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Branch Name</label>
								<div class="controls">
								 <?php echo $this->Form->input("branch_name" ,array('label' => false,'class'=>"form-control",'value'=>$branchName ))?>
								 <div style="display:none;" id="errmessageDivIdAddBranch" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Swift Name</label>
								<div class="controls">
								 <?php echo $this->Form->input("swift_name" ,array('label' => false,'class'=>"form-control",'value'=>$swiftName ))?>
								 <div style="display:none;" id="errmessageDivIdAddSwift" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Account No.</label>
								<div class="controls">
								 <?php echo $this->Form->input("account_no" ,array('label' => false,'class'=>"form-control",'value'=>$accountNo ))?>
								 <div style="display:none;" id="errmessageDivIdAddAcntNo" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Account Name</label>
								<div class="controls">
								 <?php echo $this->Form->input("account_name" ,array('label' => false,'class'=>"form-control",'value'=>$accountName ))?>
								 <div style="display:none;" id="errmessageDivIdAddAcntName" class="red_text"></div>
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Discription</label>
								<div class="controls">
								 <?php echo $this->Form->textarea("discription" ,array('label' => false,'class'=>"form-control",'value'=>$discription ))?>
								 <div style="display:none;" id="errmessageDivIdAddDscrpsn" class="red_text"></div>
								</div>
							  </div>

							  	  
							  <div style="text-align:center">
								
							  </div>
						  </form>
						 			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			</div>
			<div class="modal-footer">
			 <a href="javascript:void(0);" onclick="updateBank(<?php echo $pages;?>);" class="btn btn-primary">Update</a>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
			</div>
			</div>
	</div>
	
	
	<script>
	function updateBank(pageNo){
			var pageNo = pageNo;
			$("#updateBankForm").ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/banks/update',true);?>",
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
							$('#showAllUsrDivBtn').hide();
							$('#s2id_selectbox-o').find('span').html('Enter Bank Name For Search'); 
							$('#showAllUsrDivBtn').hide();
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
