<?php echo $this->Html->css(array('jquery-ui-1.8.4.custom','select2'));?>
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
						<div class="col-md-12"><h2><i class="fa fa-cogs">&nbsp;</i>Bank Management</h2></div>
						<div class="clearfix"></div>	
							<div>
								<!--
								<input action="action" class="btn btn-primary search_btn pull-right" type="button" value="Back" onclick="history.go(-1);" />  
								-->
								

							</div>
					</div>
					<div class="box-content">
						<div style="display:none;" id="messageDivIdAdd" class="alert alert-success"></div>
						<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>					
						<div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger"></div>					
					<div class="row">
						<div class="col-md-6">
						
						<div>
						<input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="<?php echo $searchName;?>">
						</div>
						<!-- <div id="showAllUsrDivBtn" style="" class="col-md-3">
							<button class="btn btn-primary btn-lg" onClick="showAllBanks();">
							Clear search
							</button>
						</div> -->
						<div  style="" class="col-md-3">
							<a href="<?php echo $this->Html->url('/admin/banks/index',true);?>" class='btn btn-primary btn-lg'>Clear search</a>
						</div>
						
						</div>
						<div class="col-md-6">
						
						
						
						<a href="javascript:addBank();" class='btn btn-primary btn-lg pull-right hint--bottom'  data-hint="Add Bank"> <i class="fa fa-plus-circle">&nbsp;</i>Add</a></div>
					</div>
					</div>
				
						<div id="divid127">
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
									  <!-- <th>S.No</th> -->
									  <td>Bank Name</td>
									  <td>Branch Name</td>
									  <td>Swift Name</td>
									  <td>Account No</td>
									  <td>Account Name</td>  
									  <td>Discription</td>
									  <td>Action</td>                                          
								  </tr>
							  </thead>   
							  <tbody id="bankBody">
							  <?php 
							  $srNo++;
							  foreach($bankDetails as $data=>$val){
							  ?>
								<tr id="bankId_<?php echo $val['Bank']['id'];?>">
									<!-- <td data-sorting="sort"><?php echo $srNo ;?> </td> -->
									<td class="center"><?php echo $val['Bank']['bank_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['branch_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['swift_name'];?></td>
									<td class="center"><?php echo $val['Bank']['account_no'] ;?></td>
									<td class="center"><?php echo $val['Bank']['account_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['discription'] ;?></td>
									<td class="center">
										
										<button onclick="editBank(<?php echo $val['Bank']['id'];?>,<?php echo $pages;?>);" class='btn btn-info hint--bottom' data-hint="Edit" ><i class="fa fa-pencil " ></i></button>
						 
										<a href="javascript:checkDelete(<?php echo $val['Bank']['id'];?>,<?php echo $pages;?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
										
									</td>
								</tr>
							<?php $srNo++;}?>	                          
							  </tbody>
						 </table> 
						
						
		<?php if($count > $limit) { ?>
		<div id="paginationDiv" class="pull-right">  
		<ul class=" pagination">
			<?php
				echo $this->Paginator->options(array('url'=>array('controller'=>'banks','action'=>'paginate_search','searchName'=>$searchName)));
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
				</div>
				</div>
				</div>
		</div>
	</div>	
		
<script>
	function addBank(){
		
		$("#myModal").html('');
		$("#myModal").modal('show');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/banks/add',true);?>',
			   type:'GET',
			   success:function(data){
					//console.log(data);
					$('#myModal').html(data);
					//$('[data-rel="chosen"]').chosen();
				
			   }
   
		});
		
		
	}

	function editBank(id,pageNo){
		//alert(pageNo);
		$("#myModal").modal('show');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/banks/update/',true);?>'+id+'/'+pageNo,
			   type:'GET',
			   success:function(data){
				$('#myModal').html(data);
				
			   }
   
		});
		
		
	}
		
		
		
	function delete_bank(id,pageNo){
	
		var rowVal = $("#bankBody tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = pageNo;
		if(id!= undefined){
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/banks/delete',true);?>',
			   type:'POST',
			   data:{'id':id},
			   dataType:'JSON',
			   success:function(data){
				if(data.status='success'){
						/*
						$('#bankId_'+id).remove();
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
							url:"<?php echo $this->Html->url('/admin/banks/render_page_bank',true);?>",
							type:"POST",
							data:{'pageNo':pageNo},
							dataType:"html",
							success:function(result)
							{
								$('#divid127').html(result);
								$('#myModal').modal('hide');
								$('#showAllUsrDivBtn').hide();
								$('#s2id_selectbox-o').find('span').html('Enter Bank Name For Search'); 
								$('#showAllUsrDivBtn').hide();
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
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete your Bank Name?</div></div><div class="modal-footer"><button onclick="delete_bank('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
		$("#myModal").html(str);
		$("#myModal").modal("show");
	}
</script>


<!--- searching By Bank Name-->
<script>
    $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/banks/search',true);?>',
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
					url:"<?php echo $this->Html->url('/admin/banks/bank_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
					dataType:"html",
					success:function(result)
					{
					
						$('#divid127').html(result);
						//$('#paginationDivbank').show();
						//$('#paginationDiv').html('');
						$('#showAllUsrDivBtn').show();
						//$('#s2id_selectbox-o').find('span').html('Enter bank Name For Search');
						$('#s2id_selectbox-o').find('span').html(val1);
						//$('#paginationDivId').html('');
						//$('span').empty();
						
						//$('#showAllUsrDivBtn').hide();
					}
				});
		});
	   
	}); 
	
	function showAllBanks(){
		var pageNo = 1;
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/banks/render_page_bank',true);?>",
			type:"POST",
			data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
			dataType:"html",
			success:function(result)
			{
				$('#divid127').html(result);
				
				$('#showAllUsrDivBtn').hide();
				$('#s2id_selectbox-o').find('span').html('Enter Bank Name For Search'); 
				//$('#searchdata').html(result);
				
				$('#showAllUsrDivBtn').hide();
				
				
			}
		});
	}            
</script>

