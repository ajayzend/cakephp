
<?php 
echo $this->Html->script('jquery-1.9');
echo $this->Html->script('jquery-ui-1.10.3');
	
echo $this->Session->flash();?>
<script>
$(function(){
	$( "tbody" ).sortable({
        
        stop:  function () {
			/* Sorting slides again to rearrange ordering    */
			var i = 1;
            $('[data-sorting="sorting"]').each(function(){		
				$(this).html(i);
				i++;
			}); 
        }
});
	
	
	});
</script>
<div>
	<?php 
      echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
									 $this->webroot.'admin/SliderManagements'=>'Slider Management',
									 'null'=>'Slides',
									));
      
      ?> 

<div class="row-fluid">	

	<div class="box span12">

				<div class="box-header well">
					<h2><i class="icon-cog	"></i>Slider Management</h2>
					<div class="err_msg session_msg"></div>
				</div>



<div class="box-content">
		
			<table class="table table-striped table-bordered" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						  <thead>
							  <tr role="row">
							  	
								
							  	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 204px;" aria-sort="ascending" aria-label="Username: activate to sort column ascending">S.No.</th>
							  	
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 196px;" aria-label="Date registered: activate to sort column ascending">Slides</th>
							  	<!--
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 96px;" aria-label="Role: activate to sort column ascending">No. of Slides</th>
							  	-->
							  	<th aria-label="Status: activate to sort column ascending" style="width: 15%;" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" role="columnheader" class="sorting">Status</th>
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 379px;" aria-label="Actions: activate to sort column ascending">Actions</th>
							  </tr>
						  </thead>   
						  
					  <tbody id="sortable" role="alert" aria-live="polite" aria-relevant="all">
					  	
						<?php
							$i=1;
							
							foreach($slide_edits as $slide_edit){
								
								
								echo '<tr data-order="slideorder" id="order_'.$slide_edit['SliderManagement']['id'].'">';
						?>		
								
						<?php
								echo "<td data-sorting='sorting' class='sorting'>".$i."</td>";
								$i++;
								echo "<td>".$slide_edit['SliderManagement']['slide_title']."</td>";
								//pr(count($slide_product['SliderManagement']));die;
								
						?>	
						
								<td class="center" id="active<?php echo $slide_edit['SliderManagement']['id']; ?>">
							
											<?php
												if( $slide_edit['SliderManagement']['status'] == 1)
												{
													echo  '<span style="cursor:pointer;" class="btn btn-success" onclick="slider_status('.$slide_edit['SliderManagement']['id'].',0)">Active</span>';
												}
												else
												{ 
													echo  '<span style="cursor:pointer;" class="btn btn-danger" onclick="slider_status('.$slide_edit['SliderManagement']['id'].',1)">Inactive</span>';
												}
											?>
							
											<div class="span2 pull-right" style="position:relative; z-index:0"><img src=		"/zktechnology/img/loader.gif" style="position: absolute;
											z-index: 2; display:none;" id="load_img_status_<?php echo $slide_edit['SliderManagement']['id']; ?>" alt=""><img src="/zktechnology/img/ok_icon.png" style="display:none; color:green;" id="check_img_status_<?php $slide_edit['SliderManagement']['id']; ?>" alt="">		

											</div>
											</td>
								<td class="center ">
									
									
								
								<?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-pencil')) . ' Edit',array('action' => 'modifySlide/'.$slide_edit['SliderManagement']['id'].'/'.$this->params['pass'][0]), array('escape' => false,'class'=>array('btn btn-info'),'label'=>false,'title'=>'click here to edit')); ?> 
								
								<?php echo $this->Html->link('Click to add keyfeatures...', 'javascript:features_popup('.$slide_edit["SliderManagement"]["id"].')'); ?>
								
									<?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-trash')) . ' Delete',array('action' => 'deleteSlide/'.$slide_edit['SliderManagement']['id']), array('escape' => false,'confirm'=>'Are You Sure you want to delete',
'class'=>array('btn','btn-danger'),'label'=>false,'title'=>'click here to delete')); ?> 

								
							<?php	
							echo "</tr>";
								
								
							}	
							?>	
							
							
							
							</tbody>
							
							</table>
						    <div class="span4">
						    <?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-plus-sign-alt')) . ' Add Slide',array('action' => 'addSlide/'.$this->params['pass'][0]),
							array('escape' => false,'class'=>array('btn btn-info pull-left my_btn'),'label'=>false,'title'=>'click here to add')); 
							?>
							
						    <a title="click here to add" class="btn btn-info pull-left" href="javascript:saveSlideOrder();"><i class="icon-plus-sign-alt"></i> Save Order</a>
						    <div style="position:relative; z-index:0" class="span2 pull-left"><img alt="" id="load_img" style="position: absolute;
							z-index: 2; display:none;" src="<?php echo $this->webroot;?>img/loader.gif"><img alt="" id="check_img" style="display:none; color:green;" src="<?php echo $this->webroot;?>img/ok_icon.png">		
		
							</div>
						</div>
							
							
	
</div>	
<script>
/*
	Function saveSlideOrder -- Save slides order in database 
	@no parameter required
	@return true on success, false on failure
*/

	function saveSlideOrder(){
			
			var order = new Array();
			var i = 0;
		 $('[data-order="slideorder"]').each(function(){
				var ab=String($(this).attr('id')).split('_');
				
				order[i]=ab[1];
				i++;
			}); 
		$("#load_img").fadeIn();
		$.ajax({
			url: "<?php echo $this->webroot;?>admin/sliderManagements/saveSlideOrder", 
			type: 'POST',
			data:{ 'order[]': order },
    		success: function(data)
    		{
    			if(data.trim() == 'success'){
					$("#load_img").hide();
					$("#check_img").fadeIn().fadeOut(2000);
					
    			}else
					alert(data);
    		}
    	});
		
		
		
	}
	
function features_popup(id)
	{
		//alert(id);
		$.ajax({
				type: "POST",
				url : "<?php echo $this->webroot; ?>admin/sliderManagements/editSlide/"+id,
				success: function(data)
				{
					//console.log(data);
					
					$("#myModal").html(data);
					$("#myModal").modal('show');
					
				},
				dataType:'html'
				});
	}
	
/*function to change the status of slide as active or inactive
 

*/
	
function slider_status(id,status){
		$("#load_img_status_"+id).fadeIn();
		
					
		$.ajax({
			type: "POST",
			url: "<?php echo $this->webroot;?>admin/SliderManagements/slider_status",
			data:{
			'id' : id,
			'status' : status
			},
			success:function(response)
			{
			
			if(response.trim()=='1' || response.trim() == '0')
			{
				var k=response.trim();
				$("#load_img_status_"+id).hide();
				$("#check_img_status_"+id).fadeIn().fadeOut(2000);
					
				if(k=='1'){
					
					$("#active"+id).html('<span style="cursor:pointer;" class="btn btn-success" onclick="slider_status('+id+',0)">Active</span>');
				}
				else if(k=='0') {
				
					$("#active"+id).html('<span style="cursor:pointer;" class="btn btn-danger" onclick="slider_status('+id+',1)">Inactive</span>');
				}
			}else{
				alert('error');
				}
			}
			});
	
	}	
	
</script>



