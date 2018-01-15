<?php echo $this->Html->css(array('jquery-ui-1.8.4.custom','select2'));?>
<?php echo $this->Html->script(array('select2.min','cbunny'));?>
<div id="content1">
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
				<div class="col-md-12"><h2><i class="fa fa-gavel"></i> Auction Management</h2></div>
			<div class="clearfix"></div>	
			</div>
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
			<?php 
			/*if($this->Session->flash()== true)
			{
				echo "========".$this->Session->flash();
			}*/
			 ?>
			
			
				<div id="messageDivIdAdd"> </div>
		
			<?php 
						if(!empty($this->validationErrors['Auction'])){
							//pr($this->validationErrors['Country']);
							
							foreach($this->validationErrors['Auction'] as $val){
								
								foreach($val as $errdata){
									
										$ErrorMsg[] = $errdata;
									}
								

								}?>
						<div class="alert alert-danger" id="errmessageDivIdAdd"><?php echo @$ErrorMsg[0]; ?></div>
				<?php	 }?>
<div class="box-content">				
				<div class="row">
					<div class="col-md-6">
							<div><input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Auction Name For Search"></div>
						<button class="btn btn-primary" onClick="showAllAuction();" id="divIdShowAllCar" style="display:none;">Clear Search</button>
						
						</div>
						
				
					<div class="col-md-6">
			
				<button class="btn btn-primary btn-lg pull-right hint--bottom"  data-hint="Add Auction" data-toggle="modal" data-target="#myModal2" onClick="resetfields();"><i class="fa fa-plus-circle">&nbsp;</i>
  Add
</button>
			
								
						

</div>
</div>
</div>
<table border="1" cellspacing="4" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
	<thead>

	<tr class="colr_body">

	<th>Country Name</th>
	<th>Auction </th>

	<th>Fees</th>
	<th colspan =3>Actions</th> 
	</tr>
	</thead>
	<tbody id="searchdata">
	<?php $srNo++ ;?>
	<?php foreach($auction as $val)
	//pr($val);
	{?>  
                        <?//php   pr($val); ?>
						<tr class="colr_body" id="AuctionTrId<?php echo $val['Auction']['id'];?>"> 

						<?php echo '
						<td id=cname_'.$val['Auction']['id'].'>'.$val['Country']['country_name'].'</td>
						<td id=aname_'.$val['Auction']['id'].'>'.$val['Auction']['auction_name']."-".$val['Auction']['auction_place'].'</td>
						
						<td id=fees_'.$val['Auction']['id'].'>'.$val['Auction']['fees'];?></td><td style="width:3%;">
						<a class="btn btn-info hint--bottom"  data-hint="Edit" id="<?//php echo $srNo; ?>" href="javascript:editAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-danger hint--bottom"  data-hint="Cancel" onclick="return confirm('Are you sure want to delete');" href="javascript:deleteAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
											
				<!--<a class="btn btn-info" href="javascript:editName(<?//php echo $val['Auction']['id'].",'".key($val);?>');"><i class="fa fa-pencil"></i> Edit</a></td><td>-->
				 <?//php echo $this->Html->link('view',array('action' => 'view', $val['Auction']['id']),array('class' => 'btn btn-success'));?>
                  <?//php echo $this->Html->link('Edit',array('action' => 'addnew_car', $val['Auction']['id']),array('class' => 'btn btn-info'));?>
				  <?//php echo $this->Form->postLink('Delete',array('action' => 'delete', $val['Auction']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger')).'</td></tr>';
                       
						 } ?>
	</table>
 </div>
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Auction</h4>
      </div>
      <?php $this->Session->flash();?> 
	   <?php echo $this->Form->create('auction',array('action'=>'add','class'=>'form-horizontal')); ?>	
      <div class="modal-body">
      	<div class="select-country-name">
		<?php echo $this->Form->input('country_id',array('type'=>'select','options'=>$CountryDetail,'data-rel'=>'chosen','class'=>'form-control','required'=>true));?>
		</div>			
		<?php echo $this->Form->input('auction_name',array('type'=>'text','class'=>'form-control','required'=>true));?>
		<?php echo $this->Form->input('auction_place',array('type'=>'text','class'=>'form-control','required'=>true));?>
		<?php echo $this->Form->input('fees',array('type'=>'text','class'=>'form-control','required'=>true));?>
		
      </div>
      <div class="modal-footer">
	  <?php echo $this->Form->submit('Save',array('type'=>'submit','class'=>'btn btn-primary ','div'=>false));?>
       <a href="<?php echo $this->Html->url('/admin/add',true);?>" ><button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button></a>
		
		
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
	  <?php echo $this->Form->end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
<!-- <li><?//php  echo $this->Paginator->numbers();?></li>     -->
											
										  </ul>
										
					 				 </div>     
					 				 </div>     
					 				 </div>     
					 				 </div>     
					 				    
					 				  
					 				
  <?php } ?>									 
		<script>
			
			function editAuction(id){
		$("#myModal").modal('show');
		$("#myModal").html('');
			$.ajax({
			   url:'<?php echo $this->Html->url('/admin/auctions/edit_auction/',true);?>'+id,
			   type:'GET',
			   success:function(data){
				$('#myModal').html(data);
				$('[data-rel="chosen"]').chosen();
				

			   }
   
		});
		
		
	}
		
		
	function deleteAuction(id,pageNo){
		var id = id;

		var pageNo = pageNo;
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/auctions/delete_auction',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			success:function(data){
					
				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){

					$.ajax({
						url:"<?php echo $this->Html->url('/admin/auctions/render_page_auction',true);?>",
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
		


<!--- searching By Car Name-->
<script>
    $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/auctions/search',true);?>',
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
					url:"<?php echo $this->Html->url('/admin/auctions/auction_detail',true);?>",
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
	
	function showAllAuction(){
			$.ajax({
					url:"<?php echo $this->Html->url('/admin/auctions/render_page_auction',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
						$('#searchdata').html(result);
						$('#paginationDiv').show();
						$('#s2id_selectbox-o').find('span').html('Enter Auction Name For Search');
						$('#divIdShowAllCar').hide();
						$('#totalCarId').hide();
						}
				});
		 }	
		  
		function resetfields()
		{
			$("#auctionAddForm input[type=text]").val("");
			}
</script>

</div>     
