<script> 
	
function saveAddValidation() 
{
	
	var uId = $('#client_id').val();
	var date = $('#date01').val();
	var amount = $('#amount').val();
	//var amountYen = $('#amountYen').val();
	var msg = '';
	if(uId ==='')
	{
		msg ="Client name can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;		
	}
	else if(date === '')
	{
		msg ="Date can not empty ";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;
	}
	/*else if(amount === '' || amount == null)  
	{
		msg ="Amount in Doller can not empty";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;
	}*/else if(isNaN(amount))  
	{
		msg ="Amount in Doller should be numeric";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;
	}
	/*else if(amountYen === '' || amountYen == null)  
	{
		msg ="Amount in Yen can not empty";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;
	}
	else if(isNaN(amountYen))  
	{
		msg ="Amount in Yen should be numeric";
		$("#showmsg").html("<div class='alert alert-error'><a class='close' data-dismiss='alert'></a><strong>Error-  </strong>"+  msg+"</div>");
		return false;
	}*/
	else
	{ 
		 document.getElementById('paymentForm').submit();
	}	
}
	
$(function(){
 $("#client_id").change(function(){
  
  window.location.href="<?php echo $this->Html->url('/admin/users/addPayment/',true)?>"+$(this).val();
     });
 });
 
 $(function() {
    $(".datepicker").datepicker({maxDate: '+0d', changeMonth: true,changeYear: true,dateFormat: "dd-mm-yy",yearRange: '-20:+0'});
});
 </script>
<div id="content1">
			<!-- content starts -->
			
			<?php
			$success = $this->Session->flash(); 
			if($success) {?>
			<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert"></button>
							<strong><?php echo $success ;?></strong>
			</div>
			<?php }?>
			<div class="row sortable">
				<div class="box col-md-12">
					<div class="box-header well" data-original-title>
						<h2 class="col-md-12"><i class="fa fa-plus-circle"></i> Add Payment
											
							<!--<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>-->
							<?php //echo $this->Html->link('Go Back',array('action' => 'allUsers'),array('class'=>'btn btn-primary pull-right'));?> 

							<?php echo $this->Html->link(__("Go Back",true),"/admin/users/clientHistory/".$selectedListId,array('class'=>'btn btn-primary pull-right')) ?>
						</h2>
						
						<div class="clearfix"></div>
					</div>
					<div id="showmsg"></div>
					<div class="box-content col-md-12"><!-- clientHistory -->
						<div class="row">
							
							<?php echo $this->Form->create('Users', array('action' => "addPayment",'class'=>'form-horizontal col-sm-8','id'=>'paymentForm')); ?>
							<div class="form-group">
								<label for="inputbodystyle" class="control-label col-sm-2">Client Name <span style="color:red">*</span></label> 
								<div class="col-sm-8">
								<?php 

							foreach ($ClientDetails as $key=>$val)
							{
								$id = $key;
								foreach($val as $k=>$v)
								{
									$arr[$key]=$k." ".$v;
									
								}
							
							}  

							

							?>  
							<!--<input type="hidden" name="id" value="<?php //echo $id ;?>" -->
								<?php echo $this->Form->input('client_id',array('type'=>'select','options'=>$arr,'class'=>'input-xlarge margin-top_c form-control','label'=>false,'empty'=>'Client Name','data-rel'=>'chosen','id'=>'client_id','required'=>true,'div'=>false,'selected'=>$selectedListId)); ?>	
							</div>
							</div>
							<div class="form-group">
							<label for="inputbodystyle" class="control-label col-sm-2">Date  <span style="color:red">*</span></label> 
							<div class="col-sm-8">
							<?php date_default_timezone_set("Asia/Kolkata");  $curdate =  date("j-m-Y");?>
							<?php echo $this->Form->input('date',array('type'=>'text','class'=>'input-xlarge datepicker form-control','id'=>'date01','name'=>'fromdate','div'=>false,'required'=>true,'value'=>$curdate,'label'=>false)); ?>
							</div>
							</div>
							<div class="form-group">
							<!--<label for="inputbodystyle" class="control-label col-sm-2">Amount($)  <span style="color:red">*</span></label>
							<div class="col-sm-8">
								 <?php //echo $this->Form->input('Amount',array('type'=>'text','class'=>'form-control','label'=>"Amount",'id'=>'amount','required'=>true,'div'=>false,'label'=>false)); ?>
							</div>
							</div>
							<div class="form-group">
							<label for="inputbodystyle" class="control-label col-sm-2">Amount(￥)  <span style="color:red">*</span></label>
							<div class="col-sm-8">
								 <?php 
								 //echo $this->Form->input('AmountYen',array('type'=>'text','class'=>'form-control','label'=>"AmountYen",'id'=>'amountYen','required'=>true,'div'=>false,'label'=>false)); ?>
							</div>
							</div>-->
							<div class="col-md-10">
							<label class="col-md-3" for="exampleInputPassword1">Amount</label>
								
								<div class="control-group col-md-3">
									<?php 
											$arr=array('$','￥');
											
									echo $this->Form->input('moneyType',array('type'=>'select','options'=>$arr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'monyType')); 	
									?>
								</div>
								<div class="control-group col-md-6">
									<?php echo $this->Form->input('Amount',array('type'=>'text','class'=>'form-control','id'=>'amount', 'label'=>false,'required'=>true,'placeholder'=>'Enter amount'));

									?>

								</div>
								
							</div>
							
							<div class="form-group">
							<label for="inputbodystyle" class="control-label col-sm-2">Remark</label>
							<div class="col-sm-8">
						   <!--<textarea rows="6" cols="30" class="form-control" required="required" id="remarkArea_id" name="remarkArea_id"></textarea>-->
						   <?php echo $this->Form->textarea('remarkArea_id',array('type'=>'text','class'=>'form-control','label'=>"remarkArea_id",'id'=>'remarkArea_id','required'=>true,'div'=>false,'label'=>false)); ?>			
							</div>
							</div>
							<div class="col-sm-8" style="margin-left:125px;">
							<?php echo $this->Form->Submit('Payment Now',array('type'=>'button','onClick'=>'saveAddValidation();', 'class'=>'btn btn-primary payment'));?>
						</div>	
					</div>
					</div>
				</div>
			</div>
</div>
</div>
