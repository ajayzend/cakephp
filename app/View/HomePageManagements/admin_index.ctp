<div>
	 <div id="content1">
				<div class="row sortable">
					<div class="box col-md-12">
					<div class="box-header well">
					<div class="col-sm-12">
						<h2><i class="icon-code-fork"></i>Home Slider</h2>
						<div class="err_msg"><?php echo $this->Session->flash(); ?></div>
					</div>
					<div class="clearfix"></div>
					</div>
					<?php $pages=array('2' => '2', '10' => '10', '25' => '25', '50' =>'50'); ?>
					
					<div class="box-content">
						<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
							  
							
							<table class="table table-striped table-bordered">
								<thead> 
									<tr role="row">						
										<th>S.no</th>
										<th>Id</th>
										<th>Name</th>
										<th>Status</th>
										<th>Order</th>
										<th width="30%" >Actions</th>
									</tr>
								</thead>   
								<tbody aria-relevant="all" aria-live="polite" role="alert">
								<?php
									$i=1;
									foreach($slides as $val)
									
									{
										$status = $val['HomePageSlide']['status']==1?'publish':'unpublish';
							            
										echo '<tr data-order="slideorder" id="order_'.$val['HomePageSlide']['id'].'">';
										
										echo "<td data-sorting='sorting' class='sorting'>".$i."</td>";
										?>

											<td class="center "><?php echo $val['HomePageSlide']['id']; ?></td>
											<td class="center "><b><?php 
											$a = explode('=>',@$val['HomePageSlide']['slide_name']);
											echo $a[0];?></b>&nbsp;<?php echo @$a[1];?> 
											
											
											</td>
											<td class="center" id="active<?php echo $val['HomePageSlide']['id']; ?>">
							
											<?php
												if( $val['HomePageSlide']['status'] == 1)
												{
													echo  '<span style="cursor:pointer;" class="btn btn-success" onclick="slider_status('.$val['HomePageSlide']['id'].',0)">Active</span>';
												}
												else
												{ 
													echo  '<span style="cursor:pointer;" class="btn btn-danger" onclick="slider_status('.$val['HomePageSlide']['id'].',1)">Inactive</span>';
												}
											?>
							
											<div class="span2 pull-right" style="position:relative; z-index:0"><img src="<?php echo $this->webroot;?>img/loader.gif" style="position: absolute;
											z-index: 2; display:none;" id="load_img_status_<?php echo $val['HomePageSlide']['id']; ?>" alt=""><img src="<?php echo $this->webroot;?>img/ok_icon.png" style="display:none; color:green;" id="check_img_status_<?php echo $val['HomePageSlide']['id']; ?>" alt="">		
	
											</div>
											
											</td>
											<td class="center "><?php echo $val['HomePageSlide']['order']; ?></td>
											<td class="center ">
												
												
												<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil')),array('action' => 'edit', $val['HomePageSlide']['id']),array('class' => 'btn btn-info', 'escape' => false)); ?>

				
												<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')),array('action' => 'delete', $val['HomePageSlide']['id']),array('class' => 'btn btn-danger', 'confirm' => 'Are you sure?', 'escape' => false)); ?>

												

											</td>
										</tr>
									<?php $i++;
									}
									?>
								</tbody>
							</table>
						<!--   start pagination  -->
					<?php if($slides){?>	
						<div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
								<?php									
									echo $this->Paginator->prev(__('Prev'), array(
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
						<!--   end pagination  -->
							
						 <div class="marginbtm">
						 <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus')) . ' Add new', array('action' => 'add'), array('class' => 'btn btn-info pull-left my_btn', 'escape' => false)); ?>	
						
						<!--<a title="click here to add" class="btn btn-info pull-left" href="javascript:saveSlideOrder();"><i class="fa fa-plus"></i> Save Order</a>-->
						<div style="position:relative; z-index:0" class="span2 pull-left"><img alt="" id="load_img" style="position: absolute;z-index: 2; display:none;width:25px;" src="<?php echo $this->webroot;?>img/loader.gif"><img alt="" id="check_img" style="display:none; color:green;" src="<?php echo $this->webroot;?>img/ok_icon.png">		
	
						</div>
					</div>
					
					
										<!--div class="pagination pagination-centered pull-right">
											<ul>
												<?php echo $this->Paginator->prev('Prev', array('tag' => 'li','label'=>false)); ?>
												<?php echo $this->Paginator->numbers(array('tag'=>"li",'separator'=>null,'currentClass'=>'active'));?>
												<?php echo $this->Paginator->next(__('next'), array('tag' => 'li','label'=>false,'class'=>null)); ?>
											</ul>
										</div-->
								</div>
							
						<div class="clearfix"></div>
						</div>
					</div>	
					
						<div class="container-fluid">
						
				<!--
						<div class="span6 hgt">
						<div for="desc_id" class="box box-content"><h4><i class="icon-code-fork"></i> Featured products</h4></div>
						<div class="featureboxdiv">
						<form id="featureProducts" action="javascript:void(0)" method="post">
						<select name="featureProducts[]" multiple id="featuredProducts" style="width:90%;">
							<?/*php foreach($allProducts as $item): 
								$selected = 0;
									foreach($featureProducts as $item2):
								
										if($item2['Product']['id'] == $item['Product']['id']):
										$selected = 1;
										endif;
									endforeach; ?>
									<option <?php echo (($selected == 1)? 'selected':'');?> value="<?php echo $item['Product']['id'];?>"><?php echo $item['Product']['name'];?></option>
								<?php endforeach;?>
						</select>
						</div>
						<div class="span4 marginbtn">
						<a class="btn btn-info  my_btn" href="javascript:featureProducts();"><i class="icon-plus-sign-alt"></i> Save </a>
						<div style="position: relative;right: 38%; top: 5%;z-index: 0;" class="span2 pull-right"><img alt="" id="load_img_pro" style="position: absolute;
						z-index: 2; display:none;" src="<?php echo $this->webroot;*/?>img/loader.gif"><img alt="" id="check_img_pro" style="color: green; display: none;" src="<?php echo $this->webroot;?>img/ok_icon.png">		
						</div>
						<div>
						</div>-->
						<div class="clearfix"></div>
						</div>
					</div>
					</div>
					
					</div>            
				</div>

				
				
			</div>
		</div>
				
		
				
			</div>
		</div><!--/row-->
		
<script>

function featureProducts(){
		 $("#load_img_pro").show();
		$("#featureProducts").ajaxSubmit({
			url: "<?php echo $this->webroot;?>admin/homePageManagements/updateFeatureProducts", 
			type: 'POST',
			success: function(data)
			{
			 $("#load_img_pro").hide();
			 $("#check_img_pro").show().fadeOut(2000);
			}
		});
	
	}

function saveData(){
			$("#load_img_text").show();
			$("#HomeText").ajaxSubmit({
			url: "<?php echo $this->webroot;?>admin/homePageManagements/saveText", 
			type: 'POST',
			success: function(data)
			{
			var obj = jQuery.parseJSON(data);
			if(obj.status == 'success'){
			$("#load_img_text").hide();
			 $("#check_img_text").show().fadeOut(2000);
			 }else{
				alert('server error try later');
			 }
			}
		});
	

	
	
	}

function features_popup(id)
{
	//alert(id);
	$.ajax({
	type: "POST",
	url : "/zktechnology/admin/homePageManagements/keyfeature_edit/"+id,
	success: function(data)
	{
	//console.log(data);
	$("#myModal").html(data);
	$("#myModal").modal('show');
	},
	dataType:'html'
	});
} 

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
		url: "<?php echo $this->webroot;?>admin/homePageManagements/saveSlideOrder", 
		type: 'POST',
		data:{ 'order[]': order },
		success: function(responce)
		{
			console.log(responce);
			$("#load_img").fadeOut();
			if(data.trim() == 'success'){
				//$("#load_img").hide();
				//$("#check_img").fadeIn().fadeOut(2000);
				
			}else
				alert(data);
		}
	});

	
	
}


function allcheck(obj)
{
	$(".mycheckbox").each(function()
		{
			if (obj.checked)
			{
				$(".mycheckbox").parents().addClass('checked');
				$(".mycheckbox").prop('checked', true);
			}
			else
			{
				$(".mycheckbox").parents().removeClass('checked');
				$(".mycheckbox").prop('checked', false);
			}	
			
		});

}

/*
 function submitDelForm(var id =  null) {
	var k=$('input:checkbox:checked').map(function () { return this.value;}).get();
	
		if(id == null){
			if(k.length == 0){
					$("#myModal").html("");
					var str = '<div class="alert alert-block"><button data-dismiss="modal" class="close" type="button">×</button><h4>Warning!</h4><p>Please check a checkbox first</p></div>';
					$("#myModal").html(str);
					$("#myModal").modal();
					setTimeout(function(){
						
						//$('#myModal').modal('hide');
					 },3000);
				
					
				}else{
					$("#myModal").html("");
					var str = '<div class="modal-header alert"><button data-dismiss="modal" class="close" type="button">×</button><h3 class="text-error">Confirm!</h3></div>\
					<div class="modal-body alert"><p>Are you sure you want to delete ?</p></div>\
					<div class="modal-footer"><a data-dismiss="modal" class="btn" href="#">Cancel</a><a class="btn btn-primary" href="javascript:submitDelForm(1)">Delete</a></div>';
					$("#myModal").html(str);
					$("#myModal").modal();		
				
					}
		}else if( id == 1 ){
				
				$("#Product").submit();
			
			}
		
		
		
} 

*/
$(document).ready(function(){
	$("#serbttn").bind('click', function (){
		$data=$("#search").val();
		var data=$data;
		if(data){
			$.ajax({
				type:"GET",
				url:'<?php echo $this->webroot;?>admin/products/search',
				data:{
				'value' : data,
				},
				success:function(data)
				{
					
					$('[customId="limitDiv"]').html('<a class="btn btn-info" href="<?php echo $this->webroot;?>admin/products"><i class="icon-reply"></i> Back</a>');
					$("#DataTables_Table_0").html(data);
				}
			});
		}
	});
}) 	


function slider_status(id,status){
	$("#load_img_status_"+id).fadeIn();
	
				
	$.ajax({
		type: "POST",
		url: "<?php echo $this->webroot;?>admin/homePageManagements/slider_status",
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
				
				$("#active"+id).html('<span style="cursor:pointer;" class="btn btn-success" onclick="slider_status('+id+',0)">Active</span>'
				);
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

function formSubmit(){
	alert('submiting');
	
	}

</script>	
		
		
		
