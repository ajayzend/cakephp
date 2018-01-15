<?php echo $this->Html->script('jquery-form');?> 
<?php echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>
<div id="ajax-responce">
<div id="content1">
<div class="row sortable">
<div class="box col-md-12">
			<div class="box-header well">
				<div><h2><i class="fa fa-file-text-o"></i> <?php echo __('Invoice Management')?></h2>
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
					<div class="col-md-5 pull-right">
						<div id="showAllUsrDivBtn" style="display:none;" class="col-md-2">
							
							<button class="btn btn-primary pull-left" onClick="showAllInvoice()">
							Clear Search
							</button>

						</div>
						<?php echo $this->Html->link(__("Create Invoice",true),"/admin/invoices/add",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>	
					</div>
			</div>		
			</div>		
					<div class="row">
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
							  <tbody id="searchdata">
							  <?php
							  if($invoiceDetails)
							  {
								 
								$price = 0;
								$srNo=1;	
							  foreach($invoiceDetails as $data=>$val){
								  
							  ?>
								<tr>
									<!--<td><?php //echo $C; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									<td class="center"><?php echo $val['Invoice']['amount'] ;?></td>
									 <?php
									 $carname = '';
									 foreach($val['InvoiceDetail'] as $v)
										{  
											@$carname .= $v['Car']['CarName']['car_name'].'/';
											@$userName = $v['User']['first_name']." ".$v['User']['last_name'];
											//$price +=$val['Car']['CarPayment']['sale_price'];
									}
									?>
									
									 <td class="center">
										<?php echo $userName ; ?>
									</td>
									<td class="center">
										<?php echo $carname ; ?>
									</td>
									<td class="center">
									<?php $st = explode("/",$val['Invoice']['invoice_no']);
									?>
										<?php //echo $this->Html->link('',array('action' => 'generate',$st[2]),array('class'=>'fa fa-download'));?>
									<?php										
										echo $this->Html->link(
										   '<i class="fa fa-download"></i>',
											array(
												'action' => 'export_xls',$st[1] 
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
												'action' => 'delete', $val['Invoice']['id']
											),
											array(
											
												'data-hint'=>'Delete',
												'class'=>'btn btn-danger hint--bottom',
												'escape'=>false  
											)
										);
										?>
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
									'currentClass' => 'active'
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


</script>


