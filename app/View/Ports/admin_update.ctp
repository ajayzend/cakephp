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
					$("#auction").trigger("liszt:updated");
			}					
		});	
     });
 });
</script>

<div class="modal-dialog" >
<div class="">
<div class="modal-content">

<div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <h4 id="myModalLabel" class="modal-title"><i class="icon-edit"></i>Edit Port</h4>
      </div>

<div class="modal-body">
	<div class="row-fluid sortable">
				<div class="box span12">					
					<div class="box-content">
					<form id='updatePortForm'>
							<fieldset>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Port Name</label>
								<div class="controls">
								<input type="hidden" id="" name="id" value="<?php echo $portId; ?>" />
								 <?php echo $this->Form->input("port_name" ,array('label' => false,'class'=>"form-control",'value'=>$portName ))?>
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
	
									echo $this->Form->input('country_name',array('type'=>'select','empty'=>'Select Country','options'=>$arr,'class'=>'input-xlarge form-control','label'=>false,'data-rel'=>'chosen','id'=>'country','selected'=>$CountriesId)); 	
									?>
									<div style="display:none;" id="errmessageDivIdAddCntName" class="red_text"></div>	
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="selectError">Auction</label>
								<div class="controls">
								  <?php								  
									 echo $this->Form->input('auction',array('type'=>'select','options'=>$AuctionDetails,'class'=>'input-xlarge form-control','label'=>false,'data-rel'=>'chosen','id'=>'auction')); 	
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
								  
										 echo $this->Form->input('transport_name',array('type'=>'select','options'=>$Tarray,'class'=>'input-xlarge form-control','empty'=>'Select Transport','label'=>false,'data-rel'=>'chosen','selected'=>$transportId)); 	
									?>
									<div style="display:none;" id="errmessageDivIdAddTrnsName" class="red_text"></div>	
								</div>
							  </div>
							  <div class="control-group warning">
								<label class="control-label" for="inputWarning">Rickshaw</label>
								<div class="controls">
								 <?php echo $this->Form->input("rickshaw" ,array('label' => false,'class'=>"form-control",'value'=>$rickshaw ))?>
								 <div style="display:none;" id="errmessageDivIdAddRickshaw" class="red_text"></div>
								</div>
							  </div>	  
							  <div style="text-align:center">
								
							  </div>
						  </form>
						 			
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			</div>
			<div class="modal-footer">
			 <a href="javascript:updatePort(<?php echo $pages;?>)" class="btn btn-primary">Save</a>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
			</div>
			</div>
	</div>
	
	
	<script>
	function updatePort(pageNo){
			var pageNo = pageNo;
			$("#updatePortForm").ajaxSubmit({
			url:"<?php echo $this->Html->url('/admin/ports/update',true);?>",
			type:"POST",
			dataType:'JSON',
			success:function(data){
				
				if(data.status == 'success'){
					
					var str = '<td class="center">'+data.data.Port.port_name+'</td><td class="center">'+data.data.Country.country_name+'</td><td class="center">'+data.data.Auction.auction_name+'-'+data.data.Auction.auction_place+'</td><td class="center">'+data.data.Transport.transport_name+'</td><td class="center">'+data.data.Port.rickshaw+'</td><td class="center"><button onclick="editPort('+data.data.Port.id+','+pageNo+');" class="btn btn-info hint--bottom"  data-hint="Edit" ><i class="fa fa-pencil">&nbsp;</i></button>&nbsp;<a href="javascript:checkDelete('+data.data.Port.id+','+pageNo+');" class="btn btn-danger hint--bottom"  data-hint="Delete" ><i class="fa fa-trash-o">&nbsp;</i></a></td></td>';
				
				
					$("#portId_"+data.data.Port.id).html(str);
					
					
					var i =1;
					
					
					$('[data-sorting ="sort"]').each(function(){
						$(this).html(i);
						i++;
						});
					
					$("#myModal").modal('hide');
					$('#messageDivIdAdd').show();
					$('#messageDivIdAdd').html(data.message);
					$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
					
				}else if (data.status == 'error'){
						
					//$('#errmessageDivIdAdd').show();
					//$('#errmessageDivIdAdd').html(data.message.port_name[0]);
					//$( '#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
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
						else if(key=='rickshaw'){
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
