 <div class="modal-dialog">
 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div class="clearfix"></div>
      </div>
	  <?php echo $this->Form->create('Car',array('id'=>'form'));?>
 <div class="modal-body">
	 <div id="messageDivIdAdd" class='alert alert-success' style='display:none;'></div>
	 <?php
	 foreach($user as $key=>$val){
		
			 $arr[]=array('value'=>$val['User']['email'].'#'.$val['User']['id'],'name'=>$val['User']['first_name'].' '.$val['User']['last_name'].' - '.$val['User']['id']);

								}
			//echo "<pre>";
		//print_r($arr);					
	 
	 ?>
       <?php echo $this->Form->input('email',array('type'=>'select','options'=>$arr,'data-rel'=>'chosen','label'=>false,'empty'=>'Select Client','id'=>'select_email'));?>
       
	   <div class="clearfix"></div>
	   <div class="clearfix"></div>
       <?php echo $this->Form->input('text_email',array('type'=>'text','id'=>'text_email','placeholder'=>'Please enter email','class'=>'form-control','label'=>false));?>
       <br/>
       <?php echo $this->Form->input('quotation',array('type'=>'textarea','placeholder'=>'Quotation','label'=>false,'id'=>'quotation_id','class'=>'form-control'));?>        
      </div>
      <div class="modal-footer">
		 <?php echo $this->Form->submit('Send',array('type'=>'button','class'=>'btn btn-primary','id'=>'send_user_mail','div'=>false));?>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        
      </div>
	   <?php echo $this->Form->end();?>
    </div>
	</div><!-- /.modal-content -->

<!--send data as email to client -->
				<script>	
					$('#send_user_mail').click(function(event) {
						form = $("#form").serialize();
						if($('#select_email').val() ==''){
							 var sendTextEmail= $('#text_email').val();
							 }else{
								 var sendEmail = $('#select_email').val();
										  
								 }
						  $.ajax({
								  url: "<?php  echo $this->Html->url('/admin/cars/email_image',true);?>",
								  type: 'POST',
								  dataType: 'JSON',
								  data: {'email':sendEmail,'text_mail':sendTextEmail,'quotation':$('#quotation_id').val(),'car_id':$('[data-id="car_id"]').val()},
								  success: function(result) { 
									  
									if(result.status =='success'){
									  //$("#myModal").modal('hide');
									  
									   $('#messageDivIdAdd').html(result.message);
									   $('#messageDivIdAdd').show();
				                        $("#messageDivIdAdd").css("color","green");
				                        $( '#messageDivIdAdd' ).delay(3000).fadeOut( "slow" );
				                        window.setTimeout(function () {$("#myModal").modal("hide");}, 5000);
								      	
								 }else if(result.status =='error'){
									 
									   $('#messageDivIdAdd').html(result.message);
									   $('#messageDivIdAdd').show();
				                       $("#messageDivIdAdd").css("color","red");
									 }
								  }
							   });
							});	

					

				</script>
