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
						<div class="col-md-12"><h2><i class="fa fa-cogs">&nbsp;</i>Port Management</h2></div>
						<div class="clearfix"></div>	
							<div>
								<!--
								<input action="action" class="btn btn-primary search_btn pull-right" type="button" value="Back" onclick="history.go(-1);" />  
								-->
								

							</div>
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
						<div class="col-md-6">
						
						<div>
						<input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Port Name For Search">
						</div>
						<div id="showAllUsrDivBtn" style="display:none;" class="col-md-3">
							<button class="btn btn-primary btn-lg" onClick="showAllPorts();">
							Clear search
							</button>
						</div>
						
						</div>
						<div class="col-md-6">
						
						
						
						<a href="javascript:addPort();" class='btn btn-primary btn-lg pull-right hint--bottom'  data-hint="Add Port"> <i class="fa fa-plus-circle">&nbsp;</i>Add</a>
                        
                        <a href="<?php echo $this->Html->url('/',true);?>admin/ports/upload_excel">
                        <button class="btn btn-primary pull-right hint--bottom">
						<i class="fa fa-plus-circle">&nbsp;</i>Upload Excel
						</button>
                        </a>
                        
                        </div>
					</div>
					</div>
				
                <form method="post" name="form1" id="form1">
        <input type="hidden" name="modeval">
        
						<div id="divid127">
						
                        <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
                                  <th></th>
									 <th>Port Name</th>
									  <th>Country Name</th>
									  <th>Auction</td>
									  <th>Transport Name</th>
									  <th>Rickshaw</th>
									  <th>Actions</th>                                          
								  </tr>
							  </thead>   
							  <tbody class="colr_body" id="portBody">
							  <?php 
							  $srNo++;
							  foreach($portDetails as $data=>$val){
							  ?>
								<tr id="portId_<?php echo $val['Port']['id'];?>">
                                	<td data-sorting="sort"><input type="checkbox" value="<?php echo $val['Port']['id'];?>" name="PortIds[]"></td>
									<td class="center"><?php echo $val['Port']['port_name'] ;?></td>
									<td class="center"><?php echo $val['Country']['country_name'] ;?></td>
									<td class="center"><?php echo $val['Auction']['auction_name'].'-'.$val['Auction']['auction_place'] ;?></td>
									<td class="center"><?php echo $val['Transport']['transport_name'] ;?></td>
									<td class="center"><?php echo $val['Port']['rickshaw'] ;?></td>
									<td class="center">
										
										<button onclick="editPort(<?php echo $val['Port']['id'];?>,<?php echo $pages;?>);" class='btn btn-info hint--bottom' data-hint="Edit" ><i class="fa fa-pencil " ></i></button>
						 
										<a href="javascript:checkDelete(<?php echo $val['Port']['id'];?>,<?php echo $pages;?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
										
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
		<!-- Modal -->
        <div class="pull-left"><a class="btn btn-danger hint--bottom"  data-hint="Delete" onClick="return godelete()"><i class="fa fa-trash-o"></i></a></div>
        
				</div>
				</div>
				</div>
		</div>
	</div>	
		
<script>
	function addPort(){
		
		$("#myModal").html('');
		$("#myModal").modal('show');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/ports/add',true);?>',
			   type:'GET',
			   success:function(data){
					//console.log(data);
					$('#myModal').html(data);
					//$('[data-rel="chosen"]').chosen();
				
			   }
   
		});
		
		
	}

	function editPort(id,pageNo){
		//alert(pageNo);
		$("#myModal").modal('show');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/ports/update/',true);?>'+id+'/'+pageNo,
			   type:'GET',
			   success:function(data){
				$('#myModal').html(data);
				
			   }
   
		});
		
		
	}
		
		
		
	function delete_port(id,pageNo){
	
		var rowVal = $("#portBody tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = pageNo;
		if(id!= undefined){
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/ports/delete',true);?>',
			   type:'POST',
			   data:{'id':id},
			   dataType:'JSON',
			   success:function(data){
				if(data.status='success'){
						/*
						$('#portId_'+id).remove();
						$('#myModal').modal('hide');
						$('#errmessageDivIdDel').show();
						$('#errmessageDivIdDel').html(data.message);
						$('#errmessageDivIdDel').delay(5000).fadeOut( "slow" );
						
						var i = rowVal ;
						$('[data-sorting ="sort"]').each(function(){
						$(this).html(i);
						i++;
						});
						*/
						
							$.ajax({
							url:"<?php echo $this->Html->url('/admin/ports/render_page_port',true);?>",
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
					}
				
			   }
   
		});
			
		}else{
				alert('error in id');
			}	
		
	}
	
	function checkDelete(id,pageNo)
	{
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete your Port Name?</div></div><div class="modal-footer"><button onclick="delete_port('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
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
    url: '<?php echo $this->Html->url('/admin/ports/search',true);?>',
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
				var val1 = ($("#s2id_selectbox-o .select2-choice span").html());
				var pageNo = 1;
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/ports/port_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
					dataType:"html",
					success:function(result)
					{
					
						$('#divid127').html(result);
						//$('#paginationDivPort').show();
						//$('#paginationDiv').html('');
						$('#showAllUsrDivBtn').show();
						//$('#s2id_selectbox-o').find('span').html('Enter Port Name For Search');
						$('#s2id_selectbox-o').find('span').html(val1);
						//$('#paginationDivId').html('');
						//$('span').empty();
						
						//$('#showAllUsrDivBtn').hide();
					}
				});
		});
	   
	}); 
	
	function showAllPorts(){
		var pageNo = 1;
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/ports/render_page_port',true);?>",
			type:"POST",
			data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
			dataType:"html",
			success:function(result)
			{
				$('#divid127').html(result);
				
				$('#showAllUsrDivBtn').hide();
				$('#s2id_selectbox-o').find('span').html('Enter Port Name For Search'); 
				//$('#searchdata').html(result);
				
				$('#showAllUsrDivBtn').hide();
				
				
			}
		});
	}    
	
		function godelete()
{	
var flag=0;
	for(i=0;i<document.getElementsByTagName('input').length;i++)
		{
			if(document.getElementsByTagName('input')[i].type=='checkbox')
			{
				if(document.getElementsByTagName('input')[i].checked==true)
				{
				flag=1;
				}
			}
		}	
	
		if(flag==1)
		{
			var ans1=confirm("Are you sure you want to Delete selected records.");
				if (ans1==true)
				{
			var ans=confirm("Are you sure you want to Delete Permanently selected records.");
					if(ans==true)
						{
							document.form1.modeval.value="delete";
							document.form1.submit();							
						}
				}	
		}
		if(flag==0)
		{
		alert("please select at least one record to delete.");
		return false;		
		}
}        
</script>