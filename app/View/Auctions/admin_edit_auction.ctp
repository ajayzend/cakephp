
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModal"><i class="fa fa-edit"></i> Edit Auction</h4>
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
		<?php echo $this->Form->create('Auction',array('action'=>'add','class'=> 'form-horizontal','id'=>'submit-form')); ?>
      <div class="modal-body">
	  <?//php pr($CountryDetail); Label?>
		  <?/*php $countryDetail=array();
		  foreach($CountryData as $key=>$val){
			  
			  $countryDetail[$val] = $val;
			  }*/
			//  pr($countryName);
		  ?>
		  <?//php echo $countryName;?>
       
		<?php echo $this->Form->input('country_name',array('type'=>'select','options'=>$CountryDetail,'data-rel'=>'chosen','id'=>'cat_name','selected'=>$CountryData1,'class'=>'form-control'));?>
		<?php echo $this->Form->input('auction_name',array('type'=>'text','id'=>'cat_rickshaw','value'=>$auctionName,'class'=>'form-control'));?>
		<?php echo $this->Form->input('auction_place',array('type'=>'text','id'=>'cat_freight','value'=>$auctionplace,'class'=>'form-control'));?>
		<?php echo $this->Form->input('fees',array('type'=>'text','id'=>'cat_shipping','value'=>$auctionfee,'class'=>'form-control'));?>
		
		<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$auctionId));?>

		
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
	  <div class="modal-footer">
        <a href="javascript:updateAuction()" class="btn btn-primary" id="submitAuction">Save</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        
        
		<?//php echo $this->Form->submit('Save',array('class'=>'btn btn-primary pull-right ','href'=>"javascript:saveName()",'div'=>false));//?>
		
      </div>
	  <?php echo $this->Form->end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

<script>/*
	function saveName(){

			var id = <?php echo $id;?>;
			var model = '<?php echo $model;?>';
			var name = $("#cat_name").val();
			var riskshaw = $("#cat_rickshaw").val();
			var freight = $("#cat_freight").val();
			var shipping = $("#cat_shipping").val();
			var others = $("#cat_others").val();
			if(name.length>0){
			$.ajax({
			url: "<?php echo $this->Html->url('/',true);?>admin/countries/saveCatName/", 
			data:$('#submit-form').serialize(),
			type: 'POST',
    		success: function(data)
    		{	
			 
	
    			var data = jQuery.parseJSON( data );
    			if(data.status == 'success'){
				
						$("#name_"+id).html(data.data);
						$('[data-rel="chosen"],[rel="chosen"]').chosen();
						$("#myModal").modal('hide');
						location.reload();
				}else{
						alert(data.status);
					}
    			//$('#success_msg').html(data);
				//$("#success_msg").fadeIn('2000');
    		}
    	});
		}else{
			alert("Category Name can not be null");
		}

	}
*/
</script>
<script>
function updateAuction(){
	      var form = $("#submit-form").serialize(); 
	      if(isNaN($('#cat_shipping').val()))
	      {
			  $('#cat_shipping').css('border-color','#FF0000');
		  }
		  else if(($('#cat_freight').val())=='')
		  { 
			
			   $('#cat_freight').css('border-color','#FF0000');
			   
			}
			
		else if(($('#cat_rickshaw').val())=='')
		  { 
			 
			   $('#cat_rickshaw').css('border-color','#FF0000');
			   
			}
		else if(($('#cat_name').val())=='')
		  { 
			 
			   $('#cat_name').css('border-color','#FF0000');
			   
			}
			else{  
				
				
				
			$.ajax({
	
			url:"<?php echo $this->Html->url('/admin/auctions/edit_auction',true);?>",
			type:"POST",
			data:form,
			dataType:'JSON',
			success:function(data){
				 
				if(data.status == 'success'){
			//console.log($('#cat_name option:selected').text());
					/*$('#myModal').modal('toggle');
					$('#messageDivIdAdd').html(data.message);
				    $( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
*/				//alert(data.data.Auction.auction_name);
var opt =  $("#cat_name option:selected").text();


				 var str= '<td id="cname_'+data.data.Auction.id+'">'+opt+'</td><td id="aname_'+data.data.Auction.id+'">'+data.data.Auction.auction_name+'-'+data.data.Auction.auction_place+'</td><td id="fees_'+data.data.Auction.id+'">'+data.data.Auction.fees+'</td><td style="width:3%;"><a class="btn btn-info hint--bottom"  data-hint="Edit" id="" href="javascript:editAuction(\''+data.data.Auction.id+'\',\'Auction\')"><i class="fa fa-pencil"></i></a><a class="btn btn-danger hint--bottom"  data-hint="Cancel" onclick="return confirm(\'Are you sure want to delete\');" href="javascript:deleteAuction(\''+data.data.Auction.id+'\',\'Auction\')"><i class="fa fa-trash-o"></i></a></td>'	

				$("#AuctionTrId"+data.data.Auction.id).html(str);




                $('#messageDivIdAdd').html(data.message);
				 $("#messageDivIdAdd").css("color","green");
					$("#cname_"+$('#auctionId').val()).html($('#cat_name option:selected').text());
					$("#aname_"+$('#auctionId').val()).html($('#cat_rickshaw').val()+'-'+$('#cat_freight').val());
					$('[data-rel="chosen"],[rel="chosen"]').chosen();
					$("#fees_"+$('#auctionId').val()).html($('#cat_shipping').val());
				    $( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
  
				}else{
					$('#errmessageDivIdAdd').show();
                         for(var i in data.message ){
								 msg = data.message[i];
								
								//alert(msg+"=="+typeof(msg));
								
								
								break;
							 }
						$('#errmessageDivIdAdd').html(String(msg));
				      	$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					
					}
					$("#myModal").modal('hide');
				}
			
			});
			}
			
		}	
	




</script>
