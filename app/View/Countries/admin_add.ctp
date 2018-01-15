<?php echo $this->Html->css(array('jquery-ui-1.8.4.custom','select2'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>
<div id="content1">
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
				<div class="col-md-12"><h2><i class="fa fa-flag"></i> Country Management</h2></div>
			<div class="clearfix"></div>	
			</div>
			
			
			
<div class="box-content">	
			
				<div class="row">
					<div id="messageDivIdAdd" style="display:none;" class="alert alert-success "></div>
					<div style="color:green;" ><?php echo $this->Session->flash();?></div>	
						 <?php 
						if(!empty($this->validationErrors['Country'])){
							//pr($this->validationErrors['Country']);
							
							foreach($this->validationErrors['Country'] as $val){
								
								foreach($val as $errdata){
									
										$ErrorMsg[] = $errdata;
									}
								

								}?>
						<div class="alert alert-danger" id="messageDivIdAdd"><?php echo @$ErrorMsg[0]; ?></div>
				<?php	 }?>
					<div class="col-md-6">
						
						<div ><input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Country Name For Search"></div>
						<button class="btn btn-primary" onClick="showAllcountry();" id="divIdShowAllCar" style="display:none;">Clear Search</button>
						  
						
						</div>
						
				
					<div class="col-md-6">
						
						
						
						<button class="btn btn-primary btn-lg pull-right hint--bottom"  data-hint="Add Country" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus-circle">&nbsp;</i>
  Add
</button>
						
						
					</div>
				</div>
				</div>

			       <div id="errmessageDivIdAdd" style="display:none;" class="alert alert-danger">
			       
			       
			       </div>

<table border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
	<thead>

	<tr class="colr_body">

	<td>Country Name</td>
	<!--<td>Rickshaw</td>-->
	<td>Freight</td>
	<td>Shipping</td>
	<td>Others</td>
	<td>Order</td>
	<td>Status</td>
	<td colspan="3">Actions</td>
	   
	</tr>
	</thead>
	<tbody id="searchdata">
	<?php $srNo++;
	$arr=array();
	?>
	
	<?php foreach($Auction as $val)
	// pr($val); die; <td id=rname_'.$val['Country']['id'].'>'.$val['Country']['rickshaw'].'</td>
	{?>
                      
						<tr class="colr_bodys" id="CountryTrId<?php echo $val['Country']['id'];?>">
						<?php echo '
						<td id=cname_'.$val['Country']['id'].'>'.$val['Country']['country_name'].'</td>				
						<td id=fname_'.$val['Country']['id'].'>'.$val['Country']['freight'].'</td>
						<td id=sname_'.$val['Country']['id'].'>'.$val['Country']['shipping'].'</td>
						<td id=oname_'.$val['Country']['id'].'>'.$val['Country']['others'].'</td>
						<td id=order_'.$val['Country']['id'].'>'.$val['Country']['order'];?>
						</td>
						<td>
						<?php 
											if ($val['Country']['status']==0) {
													$status = "Publish";
													$style ="btn btn-success"; 
												} else {
													$status = "Unpublish";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="status<?php echo $val['Country']['id'];?>" onClick="CountryStatus(<?php echo $val['Country']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $val['Country']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
						
						</td><td style="width:10%;">
				 <a class="btn btn-info hint--bottom"  data-hint="Edit"  id="<?//php echo $srNo; ?>"  href="javascript:editCountry(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-pencil"></i></a>
					<a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete');" href="javascript:deleteName(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
							
						<?php $srNo++;} ?>
	</tbody>
	</table>
	<?//php pr($arr);?>
	</div>
<!-- Modal -->

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Country</h4>
      </div>
       <?php echo $this->Session->flash(); ?>
        
		<?php echo $this->Form->create('Country',array('enctype' => 'multipart/form-data','id'=>'submitCdata')); ?>
      <div class="modal-body">
      
		 <label>Country</label>
		
		<?php echo $this->Form->input('country_name',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
		
		<label >Rickshaw</label>
		<?php echo $this->Form->input('rickshaw',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
		 
		 <label>Freight</label>
		<?php echo $this->Form->input('freight',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
		
	 <label>Shipping</label>
		<?php echo $this->Form->input('shipping',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
		
		 <label>Others</label>
		<?php echo $this->Form->input('others',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
		<label>Password</label>
		<?php echo $this->Form->input('password',array('type'=>'text','class'=>'form-control','label'=>false));?>
		
		<?//php echo $this->Form->input('order',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>true));?>
        <div class="clearfix"></div> 
		<?php echo $this->Form->input('file', array('class'=>'form-control country_modl_li', 'label' => 'Upload Image:', 'type' => 'file'));  ?>	
      </div>  
     
      <div class="modal-footer">
		<?php echo $this->Form->submit('Save',array('type'=>'submit','class'=>'btn btn-primary  ','div'=>false,'id'=>'submit'));?>
		 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		
      </div>
      <?php echo $this->Form->end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if($count > $limit) { ?>
<div id="paginationDiv" class="col-md-6 pull-right">
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
    echo $this->Paginator->next(__('Next'), array(
        'tag' => 'li',
        'label' => false,
        'class' => null
    ));
?>

											
										  </ul>
										 
					 				 </div>  
					 				 </div>  
					 				 </div>  
					 				 </div>  
					 				 <?php } ?>


 <script>
 
 function CountryStatus(id)
{
	var val =$('#status'+id).val() ;
	if(val == 'Publish')
	{	
	  var status = 1;
	}
	else
	{
		var status = 0;
	}
	var datas  =  {'id':id,'status':status}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/countries/countryStatus',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading"+id).show();
           },
		success:function(result)
		{
			 $("#loading"+id).hide();
			$('#status'+id).val(result);
			if(result=='Publish')
			{
				$('#status'+id).removeClass('btn btn-danger').addClass('btn btn-success');
			}else
			{
				$('#status'+id).removeClass('btn btn-success').addClass('btn btn-danger');
			}
		}
						
	});
}
 
 
		function editCountry(id){
		$("#myModal").modal('show');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/countries/edit_country/',true);?>'+id,
			   type:'GET',
			   success:function(data){
			  
				$('#myModal').html(data);
				$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform(); 
				 $('[data-rel="choosen"]').chosen();
			   }
   
		});
		 
		
	}
		</script>
               <script>
				  function deleteName(id,pageNo){
		var id = id;

		var pageNo = pageNo;
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/countries/delete_country',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			success:function(data){
					
				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){

					$.ajax({
						url:"<?php echo $this->Html->url('/admin/countries/render_page_country',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#searchdata').html(result);
							$('#myModal').modal('hide');
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
	

         </script>
</div>
</div>
</div>

<script> 
function showLoader(){
$("<?php echo $this->Html->url('/',true)?>img/loading.gif").show();
}
function hideLoader(){
$("<?php echo $this->Html->url('/',true)?>img/loading.gif").hide();
}


</script>


<!--- searching By Car Name-->
<script>
    $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/countries/search',true);?>',
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
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/countries/country_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
						$('#searchdata').html(result);
						$('#divIdShowAllCar').show();
						$('#paginationDiv').hide();
					}
				});
		});
	   
	});             
	
	function showAllcountry(){
			$.ajax({
					url:"/ukcars_dashboard/admin/countries/render_page_country",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
						$('#searchdata').html(result);
						$('#paginationDiv').show();
						$('#s2id_selectbox-o').find('span').html('Enter country Name For Search');
						$('#divIdShowAllCar').hide();
						$('#totalCarId').hide();
						}
				});
		 }	
		
	
</script>
 
<!--reset for value when add new country-->
<script>
 /*
  function changeOrder(id){
	//alert($("#OrderDate").val());
	$.ajax({
                type:'post',
               data: {'order':$("#('OrderDate_<?php echo $val['Country']['id'];?>')").val()},
                url: '<?php  echo $this->Html->url('/admin/countries/changeOrder',true);?>',
                success: function(data) {
				//alert(data);
                  
                }
            });
	  
	  }
*/
</script>
