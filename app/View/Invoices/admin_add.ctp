<?//php pr($this->params->query);?>
<script>
	
	$(function() {
   $(".datepicker").datepicker({changeMonth: true,changeYear: true,dateFormat: "dd-mm-yy",yearRange: '-20:+20'});
});

	
function saveInvoices() 
{
	$('#generate').attr('disabled','disabled');
	var uId = $('#user_id').val();
	var cId = $('#car_id').val();
	var date = $('#date').val();
	var bId = $('#bank_id').val();
	var aId = $('#invoice_address_id').val();
	var msg = '';
	if(uId ==='')
	{
		msg ="Client name can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");		
	}else if(cId === '' || cId == null)  
	{
		msg ="Car name can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
	}
	else if(date === '')
	{
		msg ="Date can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
	}else if(bId === '')
	{
		msg ="Bank name can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
	}
	else
	{ 
		var datas  =  {'uId':uId,'cId':cId,'date':date,'bId':bId,'aId':aId};  

		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/add/',true)?>",
			type:"POST",
			data:datas,
			success:function(result)
			{		
				$("#showDetail").html(result);
				//window.location.href = "<?php echo $this->Html->url('/admin/invoices/list/',true)?>";
				$("#showmsg").html("<div class='alert alert-success'><a class='close' data-dismiss='alert'></a><strong>Success!</strong>You have successfully done it.</div>");
				
				$('#showmsg').delay(4000).fadeOut( "slow" );

				$.ajax({
					url:"<?php echo $this->Html->url('/admin/invoices/carlist/',true)?>"+uId,
					type:"GET",
					dataType:'JSON',
					success:function(result)
					{	
						var select = '';		
						$.each(result, function( index, value ) {
							select +='<option value ="'+ value['car_id']+'">';
							select +=value['car_name']+" "+"["+value['cnumber']+"]";
							select +='</option>'; 
							});
							$('#bank_id').val(result[0]['bank_id']).attr("selected", "selected");
							$("#bank_id").trigger("liszt:updated");
							$("#car_id").html(select);
							$("#car_id").trigger("liszt:updated");
							$('#generate').removeAttr('disabled');
							
											
					}					
				});
				
			}					
		});
	}	
}

function Cancel()
{
	window.location.href = "<?php echo $this->Html->url('/admin/invoices/list/',true)?>";
}

$(function(){
 $("#user_id").change(function(){
 
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/carlist/',true)?>"+$(this).val(),
			type:"GET",
			dataType:'JSON',
			success:function(result)
			{	
				var select = '';		
				$.each(result, function( index, value ) {
					select +='<option value ="'+ value['car_id']+'">';
					select +=value['car_name']+" "+"["+value['cnumber']+"]";
					select +='</option>'; 
					});
					$('#bank_id').val(result[0]['bank_id']).attr("selected", "selected");
					$("#bank_id").trigger("liszt:updated");
					$("#car_id").html(select);
					$("#car_id").trigger("liszt:updated");
					
									
			}					
		});
 
     });
 });


</script>
<?php echo $this->Html->script('jquery-form');?>
<div id="content1">
<div class="row sordiv">
<div class="box col-md-12">
			<div class="box-header well">				
				<h2 class="col-md-12"><i class="fa fa-file-text-o"></i> <?php echo __('Create Invoice')?>				
				<?php echo $this->Html->link('Go Back',array('action' => 'list'),array('class'=>'btn btn-primary pull-right'));?>  </h2> 
<div class="clearfix"></div>				
			</div>
			
			
			
							<div id="showmsg"></div>
							<div style="display:none;" id="messageDivIdSucc" class="alert alert-success "></div>
							<div style="display:none;" id="errmessageDiv" class="alert alert-danger"></div>
							<?php
							if(isset($msg))
							{?>
							
								<div class="alert alert-success">
										<strong><?php echo $msg ;?></strong>
								</div>
							
							<?php }?>
							<?php
							$success = $this->Session->flash(); 
							if($success) {?>
							
								<div class="alert alert-success">
										<strong><?php echo $success ;?></strong>
								</div>
							
							<?php }?>
							<?php echo $this->Form->create('Invoice',array('action'=>'')); ?>
							
								<div class="invo_admin">
									<div class="col-md-6">
										
										<div class="col-md-3">
											<div id="cl"></div>
											<?php echo __('Client Name');?><span style="color:red">*</span>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('client_name',array('type'=>'select','options'=>$userList,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'user_id','selected'=>"",'empty'=>'Select Client','required'=>true,'selected'=>$userId)); ?>
											</div> 
										</div>
										
									</div>
							
									<div class="col-md-6">
										<div class="col-md-3">
											<div id="cn"></div>
											<?php echo __('Car Name');?><span style="color:red">*</span>
										</div>
										<div class="col-md-9">
											<div class="controls"><!-- $carDetails -->
												<?php //if(isset($carList)) ?>
												<?php echo  $this->Form->input('',array('type'=>'select','options'=>$carList,'label'=>false,'data-rel'=>'chosen','id'=>'car_id','multiple' =>'multiple','required'=>true,'selected'=>$carId)); ?>
											</div> 
										</div>
									</div>
									
									
									
									<div class="col-md-6">
										<div class="col-md-3"> 
											<div id="da"></div>
											<?php echo __('Date');?><span style="color:red">*</span>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<input type="text" class="input-xlarge datepicker  form-control" id="date" name="fromdate" value="<?php if($date == '') echo date("d-m-Y"); else echo $date; ?>" placeholder="Select Date" selected =""  >
											</div> 
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Bank Name');?><span style="color:red">*</span>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php 
												$bankId = isset($bankId) ? $bankId : "";
												echo  $this->Form->input('bank_name',array('type'=>'select','options'=>$bankDetails,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'bank_id','selected'=>$bankId ,'empty'=>'Select Bank','required'=>true)); ?>
											</div> 
										</div>
									</div>
									

									<div class="col-md-6">
										<div class="col-md-3">
										
											<?php echo __('Invoice Address');?><span style="color:red">*</span>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php 
												//$addressId = isset($addressId) ? $addressId : "";
												echo  $this->Form->input('invoice_address_id',array('type'=>'select','options'=>$address_list,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'invoice_address_id','selected'=>'','required'=>true)); ?>
											</div> 
										</div>
									</div>
									
									
									<div>

										<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
											<div class="submit  pull-right">
											<input  class="btn btn-danger search_btn pull-right" type="button" value="Cancel" onClick='Cancel();' /> 
											</div> &nbsp;&nbsp;&nbsp;
										<div class="submit  pull-right">
											<?php echo $this->Form->submit('Generate Invoice',array('type'=>'button','onClick'=>'saveInvoices();','id'=>'generate','class'=>'btn btn-primary','label'=>false,'div'=>false)); ?>
										</div>
										</div>
											
											</div> 
										</div>
									</div>
								</div>	
								   <?php echo $this->Form->end(); ?>

				<div class="col-md-12">				
<div class="row">
				<div id="showDetail" class="col-md-12"></div>
			
			</div>

		</div><!--/fluid-row-->
		</div><!--/fluid-row-->
</div>
</div>
