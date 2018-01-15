
<?php echo $this->Html->script(array('jquery-form.js'));?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Country</h4>
      </div>
       <?php $countryDetail=array();
		  foreach($CountryData as $key=>$val){
			  
			  $countryDetail[$val] = $val;
			  }
			//  pr($countryName);
		  ?>
		
       <?php $this->Session->flash(); ?>
		<?php echo $this->Form->create('country',array('enctype' => 'multipart/form-data','type'=>'file','action'=>'add','class'=> 'form-horizontal','id'=>'submit-form')); ?>
      <div class="modal-body">
		 <?php echo $this->Form->input('country_name',array('type'=>'text','id'=>'cat_name','value'=>$countryName,'class'=>'form-control'));?>
		<?//php echo $this->Form->input('country_name',array('type'=>'select','options'=>$countryDetail,'data-rel'=>'choosen','id'=>'cat_name','selected'=>$countryName,'class'=>'form-control'));?>
		<?php echo $this->Form->input('rickshaw',array('type'=>'text','id'=>'cat_rickshaw','value'=>$rickshaw,'class'=>'form-control'));?>
		<?php echo $this->Form->input('freight',array('type'=>'text','id'=>'cat_freight','value'=>$freight,'class'=>'form-control'));?>
		<?php echo $this->Form->input('shipping',array('type'=>'text','id'=>'cat_shipping','value'=>$shipping,'class'=>'form-control'));?>
		<?php echo $this->Form->input('others',array('type'=>'text','id'=>'cat_others','value'=>$others,'class'=>'form-control'));?>
		<?php echo $this->Form->input('password',array('type'=>'text','value'=>$Pass,'class'=>'form-control'));?>
		
		<?php echo $this->Form->input('order',array('type'=>'text','id'=>'cat_order','value'=>$order,'class'=>'form-control'));?>
		<ul class="country_modl_li">
		<li data-image="<?php echo $Image;?>"><!--<i  onclick="removeTempImage('<?//php echo $Image;?>');" class="fa fa-times pull-right"></i>--><img src="<?php echo $this->webroot.$Image;?>"></img></li>
		</ul>
		<?php echo $this->Form->input('file', array('label' => 'Upload Image:', 'type' => 'file'));  ?>	
   <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$countryId));?>
	

		
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
      <div class="modal-footer">
         <a href="javascript:updateCounry()" onclick="return confirm('Are you sure want to change Order ?');"class="btn btn-primary" id="submitCountry">Save</a>
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
function updateCounry(id){
	
	      $("#submit-form").ajaxSubmit({
			  
		/*	  
	       if(($('#cat_name').val())=='')
		  { 
			
			   $('#cat_name').css('border-color','#FF0000');
			   
			}
			
		else if(isNaN($('#cat_rickshaw').val()))
		  { 
			 
			   $('#cat_rickshaw').css('border-color','#FF0000');
			   
			}
		else if(($('#cat_freight').val())=='')
		  { 
			 
			   $('#cat_freight').css('border-color','#FF0000');
			   
			}
			else if(($('#cat_shipping').val())=='')
		  { 
			 
			   $('#cat_shipping').css('border-color','#FF0000');
			   
			}
			else if(($('#cat_others').val())=='')
		  { 
			 
			   $('#cat_others').css('border-color','#FF0000');
			   
			}
			else{  


*/

		
			url:"<?php echo $this->Html->url('/admin/countries/edit_country',true);?>",
			type:"POST",
			//data:form+'&country.r='+encodeURIComponent(img),
			dataType:'JSON',
			success:function(data){
				$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform(); 
				if(data.status == 'success'){
	           console.log(data.data.Country.id);
	           console.log(data.data.Country.order);
	        
			 //  console.log($('#cat_name').text());
					/*$('#myModal').modal('toggle');
					$('#messageDivIdAdd').html(data.message);
				    $( '#messageDivIdAdd' ).delay(7000).fadeOut( "slow" );
*/
                   $('#messageDivIdAdd').show();
                   $('#messageDivIdAdd').html(data.message);
                    
				    $("#messageDivIdAdd").css("color","green");
				    $("#messageDivIdAdd").show(1000);
				    
					$("#cname_"+$('#countryId').val()).html($('#cat_name').val());
					$("#rname_"+$('#countryId').val()).html($('#cat_rickshaw').val());
					$("#fname_"+$('#countryId').val()).html($('#cat_freight').val());
					$("#sname_"+$('#countryId').val()).html($('#cat_shipping').val());
					$("#oname_"+$('#countryId').val()).html($('#cat_others').val());
					$("#order_"+$('#countryId').val()).html($('#cat_order').val());
					$("#order_"+data.data.id).html(data.data.order);
					$("#order_"+data.data.Country.id).html(data.data.Country.order);
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
			//}
		
		});
		
		}
	

</script>
				<script>
					function removeTempImage(country_image){
			          if(country_image!=undefined){
				      	$.ajax({
							'url':'<?php echo $this->Html->url('/admin/countries/delete_images');?>',
							'data':{'country_image':country_image},
							'type':'post',
							'success':function(result){
								//	var obj = jQuery.parseJSON( result );
									if(result.status == 'success'){
											$('[data-image="'+country_image+'"]').remove();
										}else if(result.status == 'successWithWarning'){
												$('[data-image="'+country_image+'"]').remove();
											}
								   }
						    });
				
				         }
		
		            }
					
				</script>



