<div class="modal fade in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="cancel()">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Brand</h4>
			  </div>
			  <?php echo $this->Form->create('Brand',array('enctype' => 'multipart/form-data','id'=>'addDataFrm')); ?>
			<div class="modal-body">		   
				
				<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>
				
				<label>Brand Name</label>
				<?php echo $this->Form->input('brand_name',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?> 
				<div class="clearfix"></div>
				<div style="display:none;" id="errmessageDivIdImage" class="alert alert-danger"></div>
				
		       <?php echo $this->Form->input('brand_image', array('label' => 'Upload Image:', 'type' => 'file'));  ?>
			
			</div>
			  <div class="modal-footer">
				
					<?php echo $this->Form->button('Save',array('class'=>'btn btn-primary','type'=>'button','onclick'=>"submitFormAddBrand('addDataFrm');"))?>
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
				<div class="col-md-12"><h2><i class="fa fa-money"></i> Brand Management</h2></div>
				<div class="clearfix"></div>	
			</div>
			<?php
			if(@$success == 1)
			{
				?>
                <div class="alert alert-success">Brands Deleted Successfully</div>
                <?php
			}
			?>
            <?php
			if(@$error == 1)
			{
				?>
                <div class="alert alert-success">Some of Brand Have Category, So that can't deleted</div>
                <?php
			}
			?>
			<div id="messageDivIdAdd" style="display:none;" class="alert alert-success "></div>
			<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>
			<div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger"></div>					
			<div class="box-content">
				<div class="row">
					<div class="col-md-6">					
						<input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Brand Name For Search">
						<div id="showAllUsrDivBtn" style="display:none;" class="col-md-3">
							<button class="btn btn-primary pull-right" onClick="showAllBrands()">
							Clear Search
							</button>
					</div>
				</div>
					
				<div class="col-md-6">
					<div class="row">
												
						<button class="btn btn-primary pull-right hint--bottom"  data-hint="Add Brand" data-toggle="modal" data-target="#myModal1">
						<i class="fa fa-plus-circle">&nbsp;</i>Add
						</button>
                        
                        <a href="<?php echo $this->Html->url('/',true);?>admin/brands/upload_excel">
                        <button class="btn btn-primary pull-right hint--bottom">
						<i class="fa fa-plus-circle">&nbsp;</i>Upload Excel
						</button>
                        </a>
					</div>
					
				</div>
			</div>
		</div>


	<div id="divid127">
		
        <form method="post" name="form1" id="form1">
        <input type="hidden" name="modeval">
        <table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<td></td>
					<td>Brand Name</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody id="searchdata" class="colr_body">
			<?php 
					  $srNo++;
					foreach($Brand as $val){?>
						<tr id="brandTrId<?php echo $val['Brand']['id'];?>">
							<td data-sorting="sort"><input type="checkbox" value="<?php echo $val['Brand']['id'];?>" name="BrandIds[]"></td>
							
							<td id="brandTdNme<?php echo $val['Brand']['id'];?>"><?php echo $val['Brand']['brand_name'];?></td>
							<td class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName('<?php echo $val['Brand']['id'];?>','<?php echo $val['Brand']['brand_name'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete"  href="javascript:checkDelete(<?php echo $val['Brand']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>


					<?php $srNo++;} ?>
                    </tbody>
		</table>
        </form>
		
		
		<!-- Modal -->
        <div class="pull-left"><a class="btn btn-danger hint--bottom"  data-hint="Delete" onClick="return godelete()"><i class="fa fa-trash-o"></i></a></div>
        
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
			
            <div class="clearfix"></div>

	</div>
	</div>
</div>
</div>


</div>
<script>
	// this function is used for adding brand name
	function submitFormAddBrand(form_id){
		//var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
		$("#"+form_id).ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/brands/add_brand',true);?>",
			type:"POST",
			success:function(result){
				console.log(result);
				//$("#addDataFrm")[0].reset();
				//$("#BrandFile").reset();
				//window.fileInputForm.reset();
				//filename
				//$(".filename").html("");
				var obj = jQuery.parseJSON(result);
				console.log(obj);
				if(obj.status !='error'){
					$.ajax({
						url:"<?php echo $this->Html->url('/admin/brands/render_page_brand',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal1').modal('hide');
							//$('#myModal1').html('');
							$('#messageDivIdAdd').show();
							$('#messageDivIdAdd').html(obj.message);
							$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
							$("#"+form_id)[0].reset();
						}
						
					});
					
						
					
			}else{
					//console.log(obj.message);
					$.each(obj.message, function(key, value){
						//alert(key+'===='+value);
						///*
						if(key=='brand_name'){
							$('#errmessageDivIdAdd').show();
							$('#errmessageDivIdAdd').html(value[0]);
							$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
						}else if(key=='brand_image'){
							$('#errmessageDivIdImage').show();
							$('#errmessageDivIdImage').html(value[0]);
							$('#errmessageDivIdImage' ).delay(5000).fadeOut( "slow" );
						}else{
							$('#errmessageDivIdImage').show();
							$('#errmessageDivIdImage').html(obj.message);
							$('#errmessageDivIdImage' ).delay(5000).fadeOut( "slow" );
						}
						//*/
					});
				
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
		
			url:'<?php echo $this->Html->url('/admin/brands/edit_brand',true);?>',
			data:{'id':id,'transPrtName':transPrtName},
			type:'post',
			success:function(data){
	 
				$("#myModal").html(data);
				//$("#myModal").modal('show');
				//$('#myModal1').modal('hide');
					$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
				
			}
		
		});

	}
	
	
	
	function deleteName(id,pageNo){
		var id = id;
		
		//var rowVal = $("#searchdata tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = pageNo;
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/brands/delete_brand',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			success:function(data){
					
				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){
					/*
					$("#brandTrId"+data.data).remove();
					$('#myModal').modal('hide');
					//$('#messageDivIdAdd').show();
					//$('#messageDivIdAdd').html(data.message);
					//$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
					$('#errmessageDivIdDel').show();
					$('#errmessageDivIdDel').html(data.message);
					$( '#errmessageDivIdDel' ).delay(5000).fadeOut( "slow" );
					*/
					//var i =1;
					/*
					var i = rowVal ;
					$('[data-sorting ="sort"]').each(function(){
						$(this).html(i);
						i++;
						});
					*/
					
					$.ajax({
						url:"<?php echo $this->Html->url('/admin/brands/render_page_brand',true);?>",
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
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete your Brand Name?</div></div><div class="modal-footer"><button onclick="deleteName('+id+','+pageNo+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
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
    url: '<?php echo $this->Html->url('/admin/brands/search',true);?>',
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
					url:"<?php echo $this->Html->url('/admin/brands/brand_detail',true);?>",
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
		
	function showAllBrands(){
		var pageNo = 1;
		$.ajax({
			//url:"<?php echo $this->Html->url('/admin/brands/show_all_user',true);?>",
			url:"<?php echo $this->Html->url('/admin/brands/render_page_brand',true);?>",
			type:"POST",
			data:{name:$("#s2id_selectbox-o .select2-choice span").html(),'pageNo':pageNo},
			dataType:"html",
			success:function(result)
			{
				$('#divid127').html(result);
				$('#s2id_selectbox-o').find('span').html('Searching...'); 
				$('#showAllUsrDivBtn').hide();
				
				
			}
		});
	}
	
	function cancel(){
		$("#addDataFrm")[0].reset();
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
