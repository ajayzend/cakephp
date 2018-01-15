<script>
/*function saveInvoices(uid,cid)
{
	var Bname = $('#bname').val();
	//alert(uid+"=="+cid+"=="+Bname);
	var datas  =  {'uId':uid,'cId':cid,'bname':Bname}; 

	$.ajax({
		url:"<?php echo $this->Html->url('/admin/invoices/add/',true)?>",
		type:"POST",
		data:datas,
		success:function(result)
		{
			console.log(result);
			var obj = jQuery.parseJSON(result);
			console.log( obj.status );
			
			//var result = $.parseJSON(result);
			//console.log(result.status);
			/*if(result.status == 'success'){	
				$("#successmsg").html('<h5>'+result.message+'</h5>');	
			}else{
				$("#successmsg").html("Invoice not saved");
			}
		}					
	});
}*/
</script>
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr>
									 <!-- <th>S.No.</th> -->
									  <th>Invoice No</th>
									  <th>Created Date</th>
									  <th>Amount($)</th>
									  <th>Client Name</th>
									  <th>Car Name</th>
									  <th>Action</th>									  
								  </tr>
							  </thead>   
							  <tbody>
							  <?php
							  
								$C=1;
								
							  foreach($invoiceDetails as $data=>$val){
								 $InvoiceId =  $val["Invoice"]["id"];
								 $email = $val['InvoiceDetail'][0]['User']['email'] ;  
								 $user_id = $val['InvoiceDetail'][0]['User']['id'] ;
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									<td class="center"><?php echo $val['Invoice']['amount'];?></td>
									 <?php
									 $carname = '';
									 foreach($val['InvoiceDetail'] as $val)
										{  
											$carname .= $val['Car']['CarName']['car_name'].'/';
											$userName = $val['User']['first_name']." ".$val['User']['last_name'];
									}
									?>
									 <td class="center">
										<?php echo strtoupper($userName) ; ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
									<?php $st = explode("/",$invoiceDetails[0]['Invoice']['invoice_no']);?>
										<?php //echo $this->Html->link('',array('action' => 'generate',$st[2]),array('class'=>'fa fa-download'));?>
										<?php										
echo $this->Html->link(
   '<i class="fa fa-download"></i>',
    array(
    	'action' => 'generate',$st[1] 
    ),
    array(
    
        'data-hint'=>'Download',
        'class'=>'btn btn-success hint--bottom',
        'escape'=>false  
    )
);
?>
<?php
										
										echo $this->Html->link(
										   '<i class="fa fa-trash-o"></i>',
											array(
												'controller'=>'invoices',
												'action' => 'delete', $InvoiceId
											),
											array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false  
											)
										);
										?>
										
										<?php										
										 echo $this->Form->button('<i class="fa fa-envelope"></i>',  array('type' => 'button', 'data-hint'=>'Send Email','class' => 'btn btn-success hint--bottom','onclick'=>'sendMail(\''.$user_id.'\',\''.$email.'\' , \''.$st[1].'\')'));?>
									</td>
								</tr>
							<?php $C++; }?>	                          
							  </tbody>
						 </table> 
<script>
	function sendMail(user_id,email,ID){
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/send_mail',true);?>",
			type:"POST",
			data:{'userId':user_id,'email':email,'invoiceId':ID},
			beforeSend: function() {
              $("#loading").show();
           },
			success:function(result)
			{
				$("#loading").hide();
				var obj = jQuery.parseJSON(result);
				if(obj.status=='success'){
					$('#messageDivIdSucc').show();
					$('#messageDivIdSucc').html(obj.message);
					$('#messageDivIdSucc' ).delay(5000).fadeOut( "slow" );
				}else{
					$('#errmessageDiv').show();
					$('#errmessageDiv').html(obj.message);
					$('#errmessageDiv' ).delay(5000).fadeOut( "slow" );
				}		
			}
		});
	}
</script>
