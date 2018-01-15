<div id="ajax-responce">
<div id="content1">
<div class="row sortable">
<div class="box col-md-12">
			<div class="box-header well">
				<div><h2><i class="fa fa-file"></i> <?php echo __('Invoice Management')?></h2>
</diV>				
			
					
					
				<div class="clearfix"></div>
				</div >
				<div id="hideDiv">
						<?php
						$success = $this->Session->flash(); 
						if($success) {?>
						
							<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert"></button>
											<strong><?php echo $success ;?></strong>
							</div>
						
						<?php }?>
					</div>
					<div style="display:none;" id="messageDivIdSucc" class="alert alert-success ">
				</div>
				<div style="display:none;" id="errmessageDiv" class="alert alert-danger">
				</div>
				<div class="box-content">
				<div class="row">
					<div class="col-md-7">					
						<input class="input-xlarge pull-left col-md-4" id="selectbox-o" name="optionvalue" data-placeholder="Enter Invoice No For Search">
						
						
						<input class="input-xlarge pull-left col-md-4" id="selectbox" name="optionvalue" data-placeholder="Enter Client Name For Search">
		
        				<div class="col-md-4"><input class="form-control pull-left" name="chasisno" onBlur="SearchChasis(this.value)" placeholder="Enter Chasis Number"></div>
		
						
						
						 
					</div>
					<div class="col-md-5 pull-right">
						<div id="showAllUsrDivBtn" style="display:none;" class="col-md-2">
							
							<button class="btn btn-primary pull-left" onClick="showAllInvoice()">
							Clear Search
							</button>

						</div>
						<?php echo $this->Html->link(__("Create Invoice",true),"/admin/invoices/add",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>	
						
						<?php echo $this->Html->link(__("Deleted Invoice list",true),"/admin/invoices/delete_invoice",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>
					</div>
			</div>		
			</div>		
					<div class="row">
						<div class="myloader" id="loading" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
                    	<div>
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr>
									 <!-- <th>S.No.</th> -->
									  <th>Invoice No</th>
									  <th>Created Date</th>
									  <th>Amount</th>
									  <th>Client Name</th>
									  <th>Chassis No.</th>
									  <th>Car Name</th>
									  <th>Action</th>									  
								  </tr>
							  </thead>   
							  <tbody id="searchdata">
							  <?php
							  
							  if($invoiceDetails)
							  {
								
								$price = 0;
								$srNo=1;
								$cnumber ="";	
							  foreach($invoiceDetails as $data=>$val){
							  	//pr($val);
								  $email = $val['InvoiceDetail'][0]['User']['email'] ;
								  $user_id = $val['InvoiceDetail'][0]['User']['id'] ;
								 
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									<td class="center">
									 <?php
									 $carname = '';
									 $cnumber =array();
									 $price = 0;
									foreach($val['InvoiceDetail'] as $v)
									{  
											
											@$carname .= $v['Car']['CarName']['car_name'].'<b>/</b>';
											@$cnumber[] = $v['Car']['cnumber']."<b>/</b>";
											@$userName = $v['User']['first_name']." ".$v['User']['last_name'];
											@$price += $v['Car']['CarPayment']['sale_price'];
											//echo $v['Car']['CarPayment']['sale_price'];
									}
									?>
									<?php
									echo $val['InvoiceDetail'][0]['Car']['CarPayment']['currency'];
									 echo  $price; //$val['Invoice']['amount'] ;?></td>
									
									
									 <td class="center">
										<?php echo strtoupper($userName) ; ?>
									</td>
									<td class="center">
										<?php   foreach ($cnumber as $num){ echo strtoupper($num); } ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
									<?php $st = explode("/",$val['Invoice']['invoice_no']);
									?>
										<?php //echo $this->Html->link('',array('action' => 'generate',$st[2]),array('class'=>'fa fa-download'));?>
									<?php										
										echo $this->Html->link(
										   '<i class="fa fa-download"></i>',
											array('action' => 'generate',$st[1] ),array('data-hint'=>'Download','class'=>'btn btn-success hint--bottom','escape'=>false ));
										?>
										<!-- <input type = 'button' value = 'Delete' data-hint ='Delete' Class="btn btn-danger hint--bottom" onClick = "onDelete('<?php //echo $val['Invoice']['id']?>');">  -->
										<?php
										
										echo $this->Html->link(
										   '<i class="fa fa-trash-o"></i>',
											array(
												'controller'=>'invoices',
												'action' => 'delete', $val['Invoice']['id'],$st[1]
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
							<?php $srNo++; }}
							else{
							?>
							<tr class="colr_body">
									<td class="center" colspan="6" style="text-align:center">No Data Found</td>							
							</tr>
<?php }?>							
							  </tbody>
						 </table>
                         </div>
						 </div>
						 <?php if($count > $limit) {?>
						 <div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
									
							<?php
									echo $this->Paginator->prev('Prev', array(
									'tag' => 'li',
									'label' => false
									));
								?>
								
								<?php
									echo $this->Paginator->numbers(array(
									'tag' => "li",
									'separator' => null,
									'currentClass' => 'active',
									'style'=>'cursor:pointer;cursor:hand'
									));
								?>
								
								<?php
									echo $this->Paginator->next(__('next'), array(
									'tag' => 'li',
									'label' => false,
									'class' => null
									));
								?>
							</ul>
						</div> 
						<?php }?>
					
		</div><!--/fluid-row-->
	</div>
</div>
</div>
</div> <!-- close ajax responce div -->
<script>
 $(function(){
$('#hideDiv').delay(4000).fadeOut( "slow" );
});
    $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/invoices/invosearch',true);?>',
    dataType: 'json',
    data: function (term, page) {
    return {
    q: term
    };
    },
    results: function (data, page) {
	 
    return { results: data };
    }
    }
    });
    });
    
    $(document).ready(function(){
    $('#selectbox').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/invoices/invoClientSearch',true);?>',
    dataType: 'json',
    data: function (term, page) {
    return {
    q: term
    };
    },
    results: function (data, page) {
		//$('#userId').val(data.id);
	 
    return { results: data };
    }
    }
    });
    });
    </script>
 <script>
	 // for invoice
		$(function()
		{
			$("#selectbox-o").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/invoices/detail_search',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
					
						$('#searchdata').html(result);
						$('#showAllUsrDivBtn').show();
						$('#paginationDivId').hide();
						
					}
				});
		});
	   
	});  
	
	// for client 
	
	$(function()
		{
			$("#selectbox").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/invoices/Invoclient_search',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html(),id:$("#selectbox").val()},
					dataType:"html",
					success:function(result)
					{
					
						$('#searchdata').html(result);
						$('#showAllUsrDivBtn').show();
							$('#paginationDivId').hide();
						
					}
				});
		});
	   
	});
	
	function SearchChasis(val)
	{
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/InvoChasis_search',true);?>",
			type:"POST",
			data:{name:val},
			dataType:"html",
			success:function(result)
			{
			
				$('#searchdata').html(result);
				$('#showAllUsrDivBtn').show();
				$('#paginationDivId').hide();
				
			}
		});
	}
</script>
<script>
		
	function showAllInvoice(){
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/list',true);?>",
			type:"POST",
			data:{},
			dataType:"",
			success:function(result)
			{
				$('#ajax-responce').html(result);
				
				
				
			}
		});
	}
	
	function onDelete(id){
		datas={'id':id},
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/invoices/delete',true);?>",
			type:"POST",
			data:datas,
			success:function(result)
			{
				//console.log(result);
				$('#searchdata').html(result);				
			}
		});
	}
	
	function sendMail(user_id, email, ID){
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


