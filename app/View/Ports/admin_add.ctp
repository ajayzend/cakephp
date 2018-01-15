<?php echo $this->Html->script('jquery-form'); ?>
<script type="text/Javascript">
$(function(){
 $("#country").change(function(){ 
  
		var id = $(this).val();
		var datas  =  {'id':id}; 
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/ports/showlist/',true)?>"+$(this).val(),
			type:"POST",
			data:datas,
			success:function(result)
			{
					$('#auction').html(result);
					//$("#auction").trigger("liszt:updated");
					//$('#errmessageDivIdAddAuction').show();
					//$('#errmessageDivIdAddAuction').html(result);
					//$('#errmessageDivIdAddAuction' ).delay(5000).fadeOut( "slow" );
					
					
					//$("#auction").trigger("chosen:updated");
			}					
		});	
     });
 });
</script>

<div id="content2" class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <h4 class="modal-title"><i class="icon-edit"></i> Add Port</h4>
      </div>
	 
<div class="modal-body">
	 
	<div class="row-fluid sortable">
				<div class="">					
					<div class="box-content">
				<form id="addPortForm" >
							<fieldset>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Port Name</label>
								<div class="controls">
								 <?php echo $this->Form->input("Port.port_name" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAdd" class="red_text"></div>
								</div>
							  </div>										
							  <div class="control-group warning">
								<label class="control-label" for="selectError">Country Name</label>
								<div class="controls">
								  <?php 
											$arr=array();
											foreach ($CountriesDetails as $key=>$val)
											{			
													$arr[$key]=$val;
											}
	
									echo $this->Form->input('Port.country_name',array('type'=>'select','empty'=>'Select Country','options'=>$arr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'country')); 	
									?>
									<div style="display:none;" id="errmessageDivIdAddCntName" class="red_text"></div>	
								</div>
							  </div>
							  <div class="control-group warning"> 
								<label class="control-label" for="selectError">Auction</label>
								<div class="controls">
								  <?php							  
									 echo $this->Form->input('Port.auction',array('type'=>'select','empty'=>'Select Auction','options'=>"",'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'auction')); 	
								?>
								<div style="display:none;" id="errmessageDivIdAddAuction" class="red_text"></div>	
								</div>
							  </div>
							  
							 <div class="control-group warning">
								<label class="control-label" for="selectError">Transport Name</label>
								<div class="controls">
								  <?php 
								  $Tarray = array();
								  foreach($transportDetails as $key=>$val)
								  {							  
									$Tarray[$key] = $val;
								  }
								  
										 echo $this->Form->input('Port.transport_name',array('type'=>'select','empty'=>'Select Transport','options'=>$Tarray,'class'=>'form-control','empty'=>'Select Transport','label'=>false,'data-rel'=>'chosen')); 	
									?>
									<div style="display:none;" id="errmessageDivIdAddTrnsName" class="red_text"></div>	
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Rickshaw</label>
								<div class="controls">
								 <?php echo $this->Form->input("Port.rickshaw" ,array('label' => false,'class'=>"form-control" ))?>
								 
								<div style="display:none;" id="errmessageDivIdAddRickshaw" class="red_text"></div>
								</div>
							  </div>	  
							  <div style="text-align:center">
								
							  </div>
						
						  			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			</div>
			<div class="model-footer">
			
						  
						  
						  <div>
								
							</div>
						  
						  
						  </div>
					



<div class="modal-footer">

<a href="javascript:savePort()" class="btn btn-primary" >Save</a>

<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

						  </form>

		<!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>					
						  
			</div>
	</div>
<script>
	function savePort(){
		var rowVal = $("#portBody tr:nth-child(1) td:nth-child(1)").html();
		var pageNo = 1;
			$("#addPortForm").ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/ports/add',true);?>",
			type:"POST",
			dataType:'JSON',
			success:function(data){
				
				if(data.status == 'success'){
					
					//var str = '<tr id="portId_'+data.data.Port.id+'"><td data-sorting ="sort">'+data.data.Port.id+'</td><td class="center">'+data.data.Port.port_name+'</td><td class="center">'+data.data.Country.country_name+'</td><td class="center">'+data.data.Auction.auction_name+'-'+data.data.Auction.auction_place+'</td><td class="center">'+data.data.Transport.transport_name+'</td><td class="center"><button onclick="editPort('+data.data.Port.id+');" class="btn btn-info" >Edit</button>&nbsp;<a href="javascript:checkDelete('+data.data.Port.id+');" class="btn btn-danger" >Delete</a></td></tr>';
				
				
					//$("#portBody").prepend(str);
					//$("#myModal").modal('hide');
					
					/*
					var i =rowVal;
					$('#myTable').prepend(str);
					
					$('[data-sorting ="sort"]').each(function(){
						$(this).html(i);
						i++;
						});
					*/
					
					//$('#messageDivIdAdd').show();
					//$('#messageDivIdAdd').html(data.message);
					//$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					$.ajax({
						url:"<?php echo $this->Html->url('/admin/ports/render_page_port',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							$('#divid127').html(result);
							$('#myModal').modal('hide');
							$('#messageDivIdAdd').show();
							$('#messageDivIdAdd').html(data.message);
							$('#messageDivIdAdd').delay(5000).fadeOut( "slow" );
							
						}
						
					});
					
					
					
				}else{
					//$('#errmessageDivIdAdd').show();
					//$('#errmessageDivIdAdd').html(data.message.port_name[0]);
					//$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
					$.each(data.message, function(key, value){
						if(key=='port_name'){
							$('#errmessageDivIdAdd').show();
							$('#errmessageDivIdAdd').html(value[0]);
							$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
						}else if(key=='country_name'){
							$('#errmessageDivIdAddCntName').show();
							$('#errmessageDivIdAddCntName').html(value[0]);
							$('#errmessageDivIdAddCntName' ).delay(5000).fadeOut( "slow" );
						}else if(key=='auction'){
							$('#errmessageDivIdAddAuction').show();
							$('#errmessageDivIdAddAuction').html(value[0]);
							$('#errmessageDivIdAddAuction' ).delay(5000).fadeOut( "slow" );
						}else if(key=='transport_name'){
							$('#errmessageDivIdAddTrnsName').show();
							$('#errmessageDivIdAddTrnsName').html(value[0]);
							$('#errmessageDivIdAddTrnsName' ).delay(5000).fadeOut( "slow" );
						}
						else if(key=='transport_name'){
							$('#errmessageDivIdAddRickshaw').show();
							$('#errmessageDivIdAddRickshaw').html(value[0]);
							$('#errmessageDivIdAddRickshaw' ).delay(5000).fadeOut( "slow" );
						}
						
					});
				}
			
			}
			
		});	
	
}

</script>
