<div id="content1"> 
			<!-- content starts --> 

	<div class="row sortable">		
			<div class="box col-md-12">
				<div class="box-header well">
					<div class="col-md-12"><h2><i class="fa fa-asterisk"></i> <?php echo __('Hidden Vehicle List')?></h2></div>
					<div class="clearfix"></div>	
				</div>
			<div class="box-content">	
				<div class="row">
						
                          <input type="text" class="input-xlarge pull-left col-md-6" placeholder="Enter Chassis Number For Search" id="selectbox"> 
                                 
                           <a id='clear_data' style='display:none;' href="<?php echo $this->Html->url('/',true);?>admin/cars/hidden_car" class="btn btn-primary add_btn hint--bottom"  data-hint="Add Car">Clear Search </a>	               
						 <!-- <input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Car Name For Search">-->
						  
						  </div>			
				<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
					<thead >

							
							<tr class="colr_body">
							<th>Unique ID</th>
							<th>Car Name</th>
							<th>Country Name</th>
							<th>Chassis No.</th>
							<th>Price</th>
							<th>Stock Id</th>
							<th>Status</th> 
							<th>Doc Mgt By Bizupon</th>
							<th>Doc for shipping</th>
							<th>Action</th>
						</tr>
					</thead>   
				  <tbody id="searchdata" class="searchData">
					  
					   <?php foreach($carDetail as $Detail){?>
                       
						<tr>
							
						<?php 
						
						
						
						echo '
						<td>'.@$Detail['Car']['uniqueid'].'</td>
						<td>'.@$Detail['Car']['CarName']['car_name'].'</td>
						<td>'.@$Detail['Car']['Country']['country_name'].'</td>
						<td>'.@$Detail['Car']['cnumber'];?></td>
						<td style="text-align:center">
						<?php if(isset($Detail['CarPayment']['sale_price'])){
						echo $Detail['CarPayment']['sale_price'];
					    }else{
					     echo '-';
					     };?>
						</td><td><?php echo $Detail['Car']['stock'];?></td>
						<td>
							<?php
							
							//echo $Detail['Car']['publish']."+_+_".$Detail['CarPayment']['sale_price'];
							
							
							 if($Detail['Car']['publish']==1  && $Detail['CarPayment']['sale_price'] =='')
							{
								$status = "Publish";
								$style ="btn btn-success";
								$publish ='';
							}else if($Detail['Car']['publish']==1 && $Detail['Car']['new_arrival']==1)
							{
								$status = "New Arrival";
								$style ="btn btn-primary"; 
								$publish ='';
							}else if($Detail['Car']['publish']==0 && $Detail['CarPayment']['sale_price'] =='')
							{
								$status = "Hidden Car";
								$style ="btn btn-warning";
								$publish ='';
							}else if($Detail['Car']['publish']==0 && $Detail['CarPayment']['sale_price'] !='')
							{
								$status = "Sold Car";
								$style ="btn btn-danger";
								$publish ='active';
							}
							//echo $publish.'==='.$status.'===='.$style;			   
							?>
						
					
						<?php if($publish == 'active')
						{
							
							
							?>
						<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status ;?>" />
						<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
						<?php }else{ ?>	
							<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>"  value="<?php echo $status ;?>" />
							<?php }?>				
						</td>
						
					<td class="center" id="td<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['doc_status'] ;?>'  <?php  echo ($Detail['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>
					
					<td class="center" id="td_ship<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='ship_checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docShipStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['user_doc_status'] ;?>'  <?php  echo ($Detail['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >
					
					<img id="loading_ship<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
					</td>		
						
                  <td>

                  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'view_hidden_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
						 <a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete ?');" href="javascript:deleteName(<?php echo $Detail['Car']['id'].",'".key($Detail);?>')"><i class="fa fa-trash-o"></i></a>
						 
						 <?php //echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'</td></tr >';
                       //    $serialNumber++;
						 } ?>
						
						</td>
				<!--  <?//php echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?></td><td>-->
				 
				</tbody>	
			</table> 
			<div class="col-md-6 pull-left"><h3> Total Sold Hidden Car:  <?php echo $resultCount; ?> </h3></div>
		<div id='pafination_div'>	
			<?php if($carDetail){?>
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
					echo $this->Paginator->next(__('next'), array(
						'tag' => 'li',
						'label' => false,
						'class' => null
					));
				?>
											</ul>
									</div>	

													</div><!--/span-->
					 <div class="clear"></div>
				<?php }?>
				</div>
		</div>			
	</div>
</div>
</div>
<script>
		
   /* $(document).ready(function(){
 
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/cars/search?status=',true);?>',
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
   
	 
	 
	 
	 
		$(function()
		{
			$("#selectbox-o").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/cars/CarDetail?status=');?>",
					type:"GET",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html()}, 
					dataType:"html",
					success:function(result)
					{
					
						$('#searchdata').html(result);
						$('#paginationDiv').hide();
						$('#divIdShowAllCar').show();
						
						$('#totalCarId').hide();
						}
				});
		});
	   
	});   */  
	
		function CarStatus(id)
		{
			var val =$('#carStatus'+id).val() ;
			if(val == 'Sold Car')
			{	
			  var status = 1;
			}
			else
			{
				var status = 0;
			}
			var datas  =  {'id':id,'status':status}; 
			$.ajax({
				url:"<?php echo $this->Html->url('/admin/cars/CarHideStatus',true)?>",
				type:"POST",
				data:datas,
				beforeSend: function() {
					  $("#loading"+id).show();
				   },
				success:function(result)
				{
					console.log(result);
					 $("#loading"+id).hide();
					$('#carStatus'+id).val(result);
					$('#carStatus'+id).val(result.trim());
					if(result.trim()=='Publish')
					{
						
						$('#carStatus'+id).removeClass('btn btn-warning');
						
						$('#carStatus'+id).addClass('btn btn-success');
					}else
					{
						
						$('#carStatus'+id).removeClass('btn btn-success').addClass('btn btn-warning');
					}
				}
								
			});
		}
	
	
	
	
	 $(document).ready(function(){
    $('#selectbox').select2({
    minimumInputLength: 2,
    ajax: { 
    url: '<?php echo $this->Html->url('/admin/cars/search_hidden_car_chassis',true);?>',
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
    
    
		$(function()
		{
			$("#selectbox").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/cars/hidden_car_chassis_details',true)?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
					
						$('#searchdata').html(result);						
						$('#clear_data').show();
						$('#pafination_div').hide();
											
						}
				});
		});
	   
	});         
</script>
