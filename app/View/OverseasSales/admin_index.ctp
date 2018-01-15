<?php echo $this->Html->css(array('jquery-ui-1.8.4.custom','select2','bootstrap.min'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>

<div id="content1">   
<?php
$success = $this->Session->flash(); 
if($success) {?>
<div id="hideDiv">
	<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?php echo $success ;?></strong>
	</div>
</div>
<?php }?>
<div id="mainDiv">
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class="col-md-12"><h2><i class="fa fa-cogs">&nbsp;</i>Overseas Sales Management</h2></div>
						<div class="clearfix"></div>	
					</div>
					<div class="box-content">
                    	<?php
						if(@$success == 1)
						{
							?>
							<div class="alert alert-success">Port Deleted Successfully</div>
							<?php
						}
						?>
						
						<div style="display:none;" id="messageDivIdAdd" class="alert alert-success"></div>
						<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>					
						<div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger"></div>					
					<div class="row">
						<div class="pull-right">
						<a href="<?php echo $this->Html->url('/',true);?>admin/overseas_sales/add" class='btn btn-primary btn-lg pull-right hint--bottom'> <i class="fa fa-plus-circle">&nbsp;</i>Add</a>
                        <a href="<?php echo $this->Html->url('/',true);?>admin/overseas_sales/export" class='btn btn-primary btn-lg pull-right hint--bottom'> <i class="fa fa-plus-circle">&nbsp;</i>Export</a>
                        </div>
					</div>
					</div>
				
                <form method="post" name="form1" id="form1">
        <input type="hidden" name="modeval">
        
						<div id="divid127">
						
                        <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
									 <th>Sales Country</th>
									  <th>Customer Name</th>
									  <th>Actions</th>                                          
								  </tr>
							  </thead>   
							  <tbody class="colr_body" id="portBody">
							  <?php 
							  $srNo++;
							  foreach($RecordsData as $val){
							  ?>
								<tr id="portId_<?php echo $val['OverseasSales']['id'];?>">
									<td class="center"><?php echo $val['OverseasSales']['sales_country']?></td>
									<td class="center"><?php echo $val['OverseasSales']['customer_name']?></td>
									<td class="center">
                                    	<a href="<?php echo $this->Html->url('/',true);?>admin/overseas_sales/update/<?php echo $val['OverseasSales']['id'];?>"><button type="button" class='btn btn-info hint--bottom' ><i class="fa fa-pencil"></i></button></a>
						 
										<a href="javascript:checkDelete(<?php echo $val['OverseasSales']['id'];?>,<?php echo $pages;?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
										
									</td>
								</tr>
							<?php $srNo++;}?>	                          
							  </tbody>
						 </table> 
						
                        
						
		<?php if($count > $limit) { ?>
		<div id="paginationDiv" class="pull-right">  
		<ul class=" pagination">
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
				echo $this->Paginator->next(__('Next'), array(
				'tag' => 'li',
				'label' => false,
				'class' => null
				));
			?>


						</ul>
		<?php }?> 
					</div>
					</div>
                    
                    </form>
		
		<div class="clearfix"></div>
				</div>
				</div>
				</div>
		</div>
	</div>	
		
<script>
	function delete_port(id,pageNo){
	
		var rowVal = $("#portBody tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = pageNo;
		if(id!= undefined){
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/overseas_sales/delete',true);?>',
			   type:'POST',
			   data:{'id':id},
			   dataType:'JSON',
			   success:function(data){
				if(data.status='success'){
					window.location = "<?php echo $this->Html->url('/admin/overseas_sales');?>";
				}
			 }
   
		});
			
		}else{
				alert('error in id');
			}	
		
	}
	
	function checkDelete(id,pageNo)
	{
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete?</div></div><div class="modal-footer"><button onclick="delete_port('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
		$("#myModal").html(str);
		$("#myModal").modal("show");
	}
</script>