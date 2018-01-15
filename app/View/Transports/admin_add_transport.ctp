<div class="modal fade in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cancel()">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Transport</h4>
			  </div>
			  <?php echo $this->Form->create('Transport',array('id'=>'addDataFrm')); ?>
			  <div class="modal-body">
			   
				
				<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger">
				
				</div>
				<label>Transport Name</label>
				<?php echo $this->Form->input('transport_name',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
				 
				
				<div class="clearfix"></div>
				 
			  </div>
			  <div class="modal-footer">
				
				
					<?php echo $this->Form->button('Save',array('class'=>'btn btn-primary','type'=>'button','onclick'=>"submitFormAddTransport('addDataFrm');"))?>
					 <button type="button" class="btn btn-danger" data-dismiss="modal" onClick="cancel()">Cancel</button>
				
			  </div> 
			  <?php echo $this->Form->end(); ?>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<?php echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>

<?php echo $this->Html->script('jquery-form'); ?>
<div id="content1">
	<div class="row sortable">
		<div class="box col-md-12">
			<div class="box-header well">
				<div class="col-md-12"><h2><i class="fa fa-truck  "></i> Transport Management</h2></div>
				<div class="clearfix"></div>	
			</div>
			<div style="display:none;" id="messageDivIdAdd" class="alert alert-success">
				
			</div>	
			
			<div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger">
				
			</div>
				
			
			<div class="box-content">
				<div class="row">
					<div class="col-md-6">
					<div>
						<input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Transport Name For Search">
					</div>
					<div id="showAllUsrDivBtn" style="display:none;" class="col-md-3">
						<button class="btn btn-primary btn-lg" onClick="showAllTransport()">
						Clear Search
						</button>
					</div>
					</div>
					
				<div class="col-md-6">
				
					<button class="btn btn-primary pull-right hint--bottom"  data-hint="Add Transport" data-toggle="modal" data-target="#myModal1">
					 <i class="fa fa-plus-circle">&nbsp;</i>Add 
					</button>
				</div>
			</div>
		</div>


		<div id="divid127">
		<table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<!-- <td>S.No</td> -->
					<td>Transport Name</td>
					<td colspan="3">Actions</td>
				</tr>
			</thead>
			<tbody id="searchdata" class="colr_body">
			<?php 
					  $srNo++;
					foreach($transportResult as $val){?>
						<tr id="trnsprtTrId<?php echo $val['Transport']['id'];?>">
							<!-- <td data-sorting="sort"><?php echo $srNo;?></td> -->
							
							<td id="trnsprtTdNme<?php echo $val['Transport']['id'];?>"><?php echo $val['Transport']['transport_name'];?></td>
							<td class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['Transport']['id'];?>','<?php echo $val['Transport']['transport_name'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Transport']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>


					<?php $srNo++;} ?>
		</table>
		
		
		<!-- Modal -->
		<!-- pagination div start -->
							
								<?php if($count > $limit) { ?>
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
					<?php } ?>
		
		
		<!-- pagination div end -->
		


	</div>
	</div>
</div><!-- end 127-->
</div>


</div>
<script>
	// this function is used for adding brand name
	function submitFormAddTransport(form_id){
		var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/transports/add_transport',true);?>",
			type:"POST",
			success:function(result){
				//console.log(result);
				//if(result!='failure'){
					var obj = jQuery.parseJSON(result);
					console.log(obj);
					if(obj.status !='error'){
						$.ajax({
							url:"<?php echo $this->Html->url('/admin/transports/render_page_transport',true);?>",
							type:"POST",
							data:{'pageNo':pageNo},
							dataType:"html",
							success:function(result)
							{
								$('#divid127').html(result);
								$('#myModal1').modal('hide');
								$('#messageDivIdAdd').show();
								$('#messageDivIdAdd').html(obj.message);
								$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
								$("#"+form_id)[0].reset();
							}
							
						});
					
					
				}else{
					$('#errmessageDivIdAdd').show();
					$('#errmessageDivIdAdd').html(obj.message.transport_name[0]);
					//$('#myModal1').modal('hide');
					$( '#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
				}
			}
			
		});
	}
	
	//Edit brand name
	
	function editName(id,name){
		$("#myModal").html('');
		$("#myModal").modal('show');
		var id = id;
		var transPrtName = name;
	
		$.ajax({
		
			url:'<?php echo $this->Html->url('/admin/transports/edit_transport',true);?>',
			data:{'id':id,'transPrtName':transPrtName},
			type:'post',
			success:function(data){
				$("#myModal").html(data);
				//$("#myModal").modal('show');
				
			}
		
		});

	}
	
	
	
	function deleteName(id,pageNo){
		var id = id;
		var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/transports/delete_transport',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			success:function(data){
					
				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){
					/*
					$("#trnsprtTrId"+data.data).remove();
					$('#myModal').modal('hide');
					//$('#messageDivIdAdd').show();
					//$('#messageDivIdAdd').html(data.message);
					//$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
					$('#errmessageDivIdDel').show();
					$('#errmessageDivIdDel').html(data.message);
					$( '#errmessageDivIdDel' ).delay(5000).fadeOut( "slow" );
					*/
					/*
					var i =rowVal;
					
					$('[data-sorting ="sort"]').each(function(){
						$(this).html(i);
						i++;
						});
					*/
					$.ajax({
						url:"<?php echo $this->Html->url('/admin/transports/render_page_transport',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal').modal('hide');
							//$('#messageDivIdAdd').show();
							//$('#messageDivIdAdd').html(obj.message);
							//$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
							$('#errmessageDivIdDel').show();
							$('#errmessageDivIdDel').html(data.message);
							$('#errmessageDivIdDel').delay(5000).fadeOut( "slow" );
						}
						
					});
				}else{
					$("#myModal").html('');
					$("#myModal").modal('show');

				}

			}
		
		});
	}
	
	function checkDelete(id,pageNo)
	{
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete your Transport Name?</div></div><div class="modal-footer"><button onclick="deleteName('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
		$("#myModal").html(str);
		$("#myModal").modal("show");
	}
</script>




<!--- searching By Car Name-->
<script>
    $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/transports/search',true);?>',
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
    </script>
 <script>
		$(function()
		{
			$("#selectbox-o").change(function()
			{
				var pageNo = 1;
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/transports/transport_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
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
		
	function showAllTransport(){
		var pageNo = 1;
		$.ajax({
			
			url:"<?php echo $this->Html->url('/admin/transports/render_page_transport',true);?>",
			type:"POST",
			data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
			dataType:"html",
			success:function(result)
			{
				$('#divid127').html(result);
				$('#s2id_selectbox-o').find('span').html('Enter Transport Name For Search'); 
				$('#showAllUsrDivBtn').hide();
				
				
			}
		});
	}
	function cancel(){
		$("#addDataFrm")[0].reset();
	}
</script>
