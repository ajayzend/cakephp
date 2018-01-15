<div id="ajax-responce">
<div id="content1">
<div class="row sortable">
<div class="box col-md-12">
			<div class="box-header well">
				<div><h2><i class="fa fa-file"></i> <?php echo __('Deleted Invoice List')?></h2>
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

				<div class="box-content">
					
			
					<div class="row">
						
						<div class="col-md-7">					
							<input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Invoice No For Search">
							<input class="input-xlarge pull-left col-md-6" id="selectbox" name="optionvalue" data-placeholder="Enter Client Name For Search">
						</div>
						<div id="showAllUsrDivBtn" style="display:none;" class="col-md-2">							
							<?php echo $this->Html->link(__("Clear Search",true),"/admin/invoices/delete_invoice",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>
						</div>
						<div class="col-md-3 pull-right">					
						<?php echo $this->Html->link(__("Back",true),"/admin/invoices/list",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>							
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="myloader" id="loading" style="display:none;">
							<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
							<div class="clearfix"></div>	
						</div>
						<table id="search" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
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
							  	//print_r($val);
								  //$email = $val['DeletedInvoice']['user_id'] ;
								  $user_id = $val['DeletedInvoice']['user_id'] ;
								 
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['DeletedInvoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['DeletedInvoice']['created']));   echo $date ;?></td>
									<td class="center">
									<?php
										if(empty($val['DeletedInvoice']['currency_type']))
										{
											echo $val['DeletedInvoiceDetail'][0]['Car']['CarPayment']['currency'];
										}else
										{
											echo $val['DeletedInvoice']['currency_type'];
										} 
										
									    echo $val['DeletedInvoice']['amount'] ;?></td>
									 <?php
									 $carname = '';
									 $cnumber =array();
									 foreach($val['DeletedInvoiceDetail'] as $v)
										{  
											
											@$carname .= $v['Car']['CarName']['car_name'].'<b>/</b>';
											@$cnumber[] = $v['Car']['cnumber']."<b>/</b>";
											@$userName = $v['User']['first_name']." ".$v['User']['last_name'];
											//$price +=$val['Car']['CarPayment']['sale_price'];
									}
									?>
									
									 <td class="center">
										<?php echo $val['User']['first_name'].' '. $val['User']['last_name'] ; ?>
									</td>
									<td class="center">
										<?php   foreach ($cnumber as $num){ echo strtoupper($num); } ?>
									</td>
									<td class="center">
										<?php echo strtoupper($carname) ; ?>
									</td>
									<td class="center">
										
									<?php
										$st = explode("/",$val['DeletedInvoice']['invoice_no']);
																		
										echo $this->Html->link(
										   '<i class="fa fa-download"></i>',
											array('action' => 'delete_invoice_generate',$st[1] ),array('data-hint'=>'Download','class'=>'btn btn-success hint--bottom','escape'=>false ));
										?>	
										
									<?php							
											echo $this->Html->link(
										   '<i class="fa fa-trash-o"></i>',
												array(
												'controller'=>'invoices',
												'action' => 'delete_server_invoice',$val['DeletedInvoice']['id']
											),
												array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false,
												'confirm' => 'Are you sure want to delete invoice from our server ?'  
												)
											);
										?>
										
										
									</td>
								</tr>
							<?php $srNo++; }}
							else{
							?>
							<tr class="colr_body">
									<td class="center" colspan="7" style="text-align:center">No Data Found</td>							
							</tr>
<?php }?>							
							  </tbody>
						 </table>
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
    url: '<?php echo $this->Html->url('/admin/invoices/delete_invoice_search',true);?>',
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
    url: '<?php echo $this->Html->url('/admin/invoices/delete_invoice_client_Search',true);?>',
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
		$(function()
		{
			$("#selectbox-o").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/invoices/delete_detail_search',true);?>",
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
					url:"<?php echo $this->Html->url('/admin/invoices/delete_invoice_details_client',true);?>",
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
</script>


