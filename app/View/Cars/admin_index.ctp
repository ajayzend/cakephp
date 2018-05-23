<?php // @$status=$this->params->query['sort'];?>
<?php //@$newArrival=$this->params->query['new'];?>
<?php // @$notSold=$this->params->query['sold'];?>
<?php $groupId = $this->Session->read('UserAuth.User.user_group_id');?>
<?php
if(@$this->params->query['sort'])
{
	@$status=$this->params->query['sort'];
	@$searchParam =$this->params->query['sort'];
}
else if(@$this->params->query['new'])
{
	@$status=$this->params->query['new'];
	@$searchParam =$this->params->query['new'];
}
else if(@$this->params->query['sold'])
{
	@$status=$this->params->query['sold'];
	@$searchParam =$this->params->query['sold'];
}
else{
	@$searchParam ='';
	}

?>

<?php //echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));?>
<?php //echo $this->Html->script(array('bootstrap.min','select2.min','cbunny'));?>
<div id="content1">
			<!-- content starts -->

	<div class="row sortable">
		<div class="box col-md-12">
			<div class="box-header well">
				<div class="col-md-12"><h2><i class="fa fa-asterisk"></i> <?php echo __('Vehicle Management')?></h2></div>
			<div class="clearfix"></div>
			</div>
			<div class="box-content">
			<div style="display:none;" id="errmessageDivIdAdd" class="alert alert-danger"></div>
		  <div style="display:none;" id="errmessageDivIdDel" class="alert alert-danger"></div>
				<div class="row">
					<div class="col-md-7">

						<div class="row">

                          <input type="text" class="input-xlarge pull-left col-md-6" placeholder="Enter Chassis Number For Search" id="selectbox">
						  <input class="input-xlarge pull-left col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Car Name For Search">
						  </div>
						</div>


					<div class="col-md-5">


						<div class="dataTables_filter mybtn  pull-right" id="DataTables_Table_0_filter" style="margin-left:-20px;">

							<button class="btn btn-primary" onClick="showAllChassisNo();" id="divIdShowAllCar" style="display:none;">Clear</button>
						 <a href="<?php echo $this->Html->url('/',true);?>admin/cars/addnew_car" class="btn btn-primary pull-right add_btn hint--bottom"  data-hint="Add Car"><i class="fa fa-plus-circle">&nbsp;</i> Add </a>

						 <?php if(@$status == "new arrival"){
							 echo $this->Html->link('Find All ',array('action' => 'index'),array('class' => 'btn btn-success hint--bottom',"data-hint"=>"Find All"));
					       } else{
							  echo $this->Html->link('New Arrival',array('action' => 'index?new=new+arrival'),array('class' => 'btn btn-primary hint--bottom',"data-hint"=>"New Arrival"));
						    }
					         ?>



							<?php if(@$status == "unpublish"){?>

							<?php  echo $this->Html->link('Find All ',array('action' => 'index'),array('class' => 'btn btn-success hint--bottom',"data-hint"=>"Find All"));?>
					         <?php } else{
								 echo $this->Html->link('Sold Cars',array('action' => 'index?sort=unpublish'),array('class' => 'btn btn-danger hint--bottom',"data-hint"=>"Sold Cars"));


						    }

						    if(@$status =="not sold")
						    {
								echo $this->Html->link('Find All ',array('action' => 'index'),array('class' => 'btn btn-successhint--bottom',"data-hint"=>"Find All"));
							}else
							{
								echo $this->Html->link('Hidden Cars',array('action' => 'index?sold=not+sold'),array('class' => 'btn btn-warning hint--bottom',"data-hint"=>"Hidden Cars"));
							}
					         ?>

						  </div>

					</div>
				</div>
				</div>
				<div class="myloader" id="loading5" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/>
					</div>
				<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
					<thead >


							<tr class="colr_body">
                            <th><input type='checkbox'   id='select-checkbox'></th>
							<th>Unique ID</th>
							<th>Car Name</th>
							<th>Country Name</th>
							<th>Chassis No.</th>
							<th>Price</th>
							<!--<th>Handle</th>
							<th>Fuel</th>-->
							<th>Stock Id</th>
							<th>Status</th>
							<th>Doc Mgt By Bizupon</th>
							<th>Doc for shipping</th>
							<th>Created By</th>
							<th>Modified By</th>
							<th>Action</th>
						</tr>
					</thead>
				  <tbody id="searchdata" class="searchData">
						 <?php foreach($carDetail as $Detail){
							 ?>
						<tr  data-toggle="tooltip" data-placement="left" title="<?php //echo "Status :".@$status.", Yard :".$yard_name.",Car In :".$car_in.",Car Out :".$car_out;?>">
                        <td><input type='checkbox' name='checkbox'  class="select_checkbox"  value='<?php echo $Detail['Car']['id'];?>'></td>
						<?php
						echo '
						<td>'.$Detail['Car']['uniqueid'].'</td>
						<td>'.$Detail['CarName']['car_name'].'</td>
						<td>'.$Detail['Country']['country_name'].'</td>
						<td>'.$Detail['Car']['cnumber'];?></td>
						<td style="text-align:center">
						<?php if(isset($Detail['CarPayment']['sale_price'])){
						echo $Detail['CarPayment']['sale_price'];
					    }else{
					     echo '-';
					     };?>
						</td>
                        <td><?php echo $Detail['Car']['stock'];?></td>
                        <td>
							<?php if ($searchParam=='new arrival' ) {
													$status = "New Arrival";
													$style ="btn btn-primary";
												} else if( $Detail['Car']['publish']=='0') {
													$status = "Sold Car";
													$style ="btn btn-danger";
												}else if($searchParam=='not sold') {
													$status = "Hidden Car";
													$style ="btn btn-warning";
												} else{
												   $status = "Publish";
													$style ="btn btn-success";
												};?>

						<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status ;?>" />
						<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
						</td>

					<td class="center" id="td<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['doc_status'] ;?>'  <?php  echo ($Detail['Car']['doc_status']==1 ? 'checked' : ''); ?>    ></td>

					<td class="center" id="td_ship<?php echo $Detail['Car']['id']; ?>" ><input type="checkbox"  id='ship_checkbox_<?php echo $Detail['Car']['id']; ?>' onclick="docShipStatus('<?php echo $Detail['Car']['id']; ?>')" value='<?php echo $Detail['Car']['user_doc_status'] ;?>'  <?php  echo ($Detail['Car']['user_doc_status']==1 ? 'checked' : ''); ?>    >

					<img id="loading_ship<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
					</td>

							<?php echo '							
							<td>'.$Detail['User1']['first_name'].' '.$Detail['User1']['last_name'].'</td>
							<td>'.$Detail['User2']['first_name'].' '.$Detail['User2']['last_name'];?></td>


                  <td>

					  <?php if($groupId == 5) {
						  if($status == 'Publish') {
						  ?>

						  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
						  <!--<a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete ?');" href="javascript:deleteName(<?php /*echo $Detail['Car']['id'].",'".key($Detail);*/?>')"><i class="fa fa-trash-o"></i></a>-->
					  <?php } } else{?>
						  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
						  <a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete ?');" href="javascript:deleteName(<?php echo $Detail['Car']['id'].",'".key($Detail);?>')"><i class="fa fa-trash-o"></i></a>
						  <?php echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'';
					   }?>

					</td></tr >
                       <!--   $serialNumber++;-->
						 <?php } ?>


				<!--  <?//php echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?></td><td>-->

				</tbody>
			</table>
		</div>

        <div style="clear:both">&nbsp;</div>
        <button class="btn btn-danger" id='delete_arrival_car' style="display:none">Delete </button>
        <div style="clear:both">&nbsp;</div>

				<div id="totalCarId" class="total pull-left col-md-6">
	<label>Total Number Of <?php echo $count_type; ?> Cars  : <?php echo $this->Paginator->counter(
    '{:count}'
);?></label>
	</div>


				<!-- content ends -->
					<?php if(!empty($carDetail) ){  ?>
							<div id="paginationDiv" class="pull-right ">
									<ul class=" pagination pull-right page-class">
									 <?php
											echo $this->Paginator->prev( 'Prev', array( 'class' => '', 'tag' => 'li' ), null, array( 'class' => 'disabled insert-anchor', 'tag' => 'a' ) );
											echo $this->Paginator->numbers( array( 'tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a' ) );
											echo $this->Paginator->next( 'Next', array( 'class' => '', 'tag' => 'li' ), null, array( 'class' => 'disabled 	insert-anchor', 'tag' => 'a' ) );
									  ?>
								</ul>
							</div>
						<?php }
						 else {
							echo "<tr><td colspan=10><div class='not-found'>Record Not Found !</div></td></tr>";
						}

						?>





<script>


	function docShipStatus(CarId)
	{

		var checkStatus= $("#ship_checkbox_"+CarId).is(":checked");
		if(checkStatus==true)
		{
			var status = '1';
			msg = 'Are you sure  want to release car document?';
		}else
		{
			var status = '0';
			msg = 'Are you sure want to cancel car document?';
			$("#td_ship"+CarId).children().children().removeClass('checker');
		}

		if(confirm(msg) == true)
		{
			var dataString = {'cId':CarId,'status':status};

			$.ajax({
			type: "POST",
			beforeSend: function() {
					  $("#loading_ship"+CarId).show();
				   },
			url:"<?php echo $this->Html->url('/admin/users/docShipStatus',true);?>",
			data: dataString,
			success: function(data)
			{
				$("#loading_ship"+CarId).hide();
				var obj = jQuery.parseJSON( data );
				if(obj.status = 'checked')
				{
					/*var str = '<input type="checkbox"  id="checkbox_'+CarId+'"  onclick="docStatus('+CarId+')"  value="0" checked="unchecked" >';

					var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span class="checked"><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
					$("#td"+CarId).html(str1);*/
				}
				else
				{
					var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span><input id="ship_checkbox_'+CarId+'" type="checkbox" value="1" onclick="docShipStatus('+CarId+')" style="opacity: 0;"></span></div>';
					//var str = '<input type="checkbox"  id="checkbox_'+CarId+'"   onclick="docStatus('+CarId+')" value="1" checked="checked" >';
					$("#td_ship"+CarId).html(str1);
				}

			},
			failure: function(data)
			{
				alert('Error occur');
			}
			});

		}
	}


	//   for doc status===

	function docStatus(CarId)
	{

		var checkStatus= $("#checkbox_"+CarId).is(":checked");
		if(checkStatus==true)
		{
			var status = '1';
		}else
		{
			var status = '0';
		}


		var dataString = {'cId':CarId,'status':status};
		$.ajax({
		type: "POST",
		url:"<?php echo $this->Html->url('/admin/users/docStatus',true);?>",
		data: dataString,
		success: function(data)
		{

			var obj = jQuery.parseJSON( data );
			if(obj.status = 'checked')
			{
				/*var str = '<input type="checkbox"  id="checkbox_'+CarId+'"  onclick="docStatus('+CarId+')"  value="0" checked="unchecked" >';

				var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span class="checked"><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
				$("#td"+CarId).html(str1);*/
			}
			else
			{
				var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
				//var str = '<input type="checkbox"  id="checkbox_'+CarId+'"   onclick="docStatus('+CarId+')" value="1" checked="checked" >';
				$("#td"+CarId).html(str1);
			}

		},
		failure: function(data)
		{
			alert('Error occur');
		}
		});

	}


	///=========


    $(document).ready(function(){
    	 var searchParam='<?php echo $searchParam ?>';
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
    </script>
 <script>




		$(function()
		{
			$('.select_checkbox').each(function() {
						this.checked = false;
					});



			$("#selectbox-o").change(function()
			{
				 var searchParam='<?php echo $searchParam ?>';

				$.ajax({
					url:"<?php echo $this->Html->url('/admin/cars/CarDetail?status=');?>"+searchParam,
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

	});
</script>
    </div><!--/fluid-row-->



</div><!--/#content.span10-->
</div><!--/#content.span10-->

<!--      Search for Chassis number ---->

<script>

    $(document).ready(function(){
    var searchParam='<?php echo $searchParam ?>';
    $('#selectbox').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/cars/searchChassis?status=',true);?>'+searchParam,
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




			$("#delete_arrival_car").click(function () {




					var val = [];

					if($('#select-checkbox').prop( "checked" ))
					{
						$(".select_checkbox").each(function(i){
							val[i] = $(this).val();
						});
					}
					else
					{
						$("input.select_checkbox:checkbox:checked").each(function(i){
							val[i] = $(this).val();
						});

					}

					if(val.length>0)
					{
						if(confirm("Are you sure want to delete car") == true)
						{
							$.ajax({
								url:'<?php echo $this->Html->url('/admin/cars/delete_arrival_car',true);?>',
								data:{'id':val},
								type:'post',
								beforeSend: function() {
									  $("#loading5").show();
								   },
								success:function(data){

									var data = jQuery.parseJSON(data);

									if(data.status == 'success'){

											location.href="<?php echo $this->Html->url('/admin/cars/index?new=new+arrival',true);?>";
										/*$.ajax({
											url:"<?php echo $this->Html->url('/admin/cars/index',true);?>",
											type:"POST",
											data:{'new':'new arrival'},
											dataType:"html",
											success:function(result)
											{
												$("#loading5").hide();
												$('#errmessageDivIdDel').show();
												$('#errmessageDivIdDel').html(data.message);
												$('#errmessageDivIdDel').delay(7000).fadeOut( "slow" );
												  location.reload();
											}

										});*/
									}else
									{
									   alert('you are not delete successfully!');
									}

								}

							});
						}else
						{
							 $('.select_checkbox').parent().removeClass('checked');
							 $('#delete_arrival_car').hide();
							  $('.select_checkbox').each(function()
							  {
									this.checked = false;
							});

						}




					}
					else
					{
						alert('Please select atleast one checkbox !!!');
					}

				});
	 });


	 $(function()
		{
			$(".select_checkbox").click(function ()
			{

				if($('.select_checkbox').is(':checked')){
					$(this).parent().addClass('checked');
					 $('#delete_arrival_car').show();
				}
				else
				{
					 $(this).parent().removeClass('checked')
					 $('#delete_arrival_car').hide();
				}




			})
		});

		$(function()
		{
				$("#select-checkbox").click(function () {

				 if($('#select-checkbox').is(':checked')){
					 $('.select_checkbox').parent().addClass('checked');
					 $('#delete_arrival_car').show();
				 }
				 else
				 {
					  $('.select_checkbox').parent().removeClass('checked');
					  $('#delete_arrival_car').hide();
				 }



				});
	 });





		$(function()
		{
			$("#selectbox").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/cars/Chassis',true)?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html(),param:'<?php echo $searchParam;?>'},
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

	});
</script>
<!---------------status of the the car ----------->
		<script>
		function CarStatus(id)
		{
			var val =$('#carStatus'+id).val() ;
			if(val == 'Publish')
			{
			  var status = 0;
			}
			else
			{
				var status = 1;
			}
			var datas  =  {'id':id,'status':status};
			$.ajax({
				url:"<?php echo $this->Html->url('/admin/cars/carStatus',true)?>",
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

						$('#carStatus'+id).removeClass('btn btn-danger');

						$('#carStatus'+id).addClass('btn btn-success');
					}else
					{

						$('#carStatus'+id).removeClass('btn btn-success').addClass('btn btn-danger');
					}
				}

			});
		}

		function showAllChassisNo(){
			$.ajax({
					url:"<?php echo $this->Html->url('/admin/cars/render_page_car',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html(),param:'<?php echo $searchParam;?>'},
					dataType:"html",
					success:function(result)
					{

						$('#searchdata').html(result);
						$('#paginationDiv').show();
						$('#s2id_selectbox').find('span').html('Enter Chassis Number For Search');
						$('#s2id_selectbox-o').find('span').html('Enter Car Name For Search');
						$('#divIdShowAllCar').hide();
						$('#totalCarId').show();

						}
				});
		}
	/*
	   function showAllCar(){
			$.ajax({
					url:"/ukcars_dashboard/admin/cars/render_page_car",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html()},
					dataType:"html",
					success:function(result)
					{
						$('#searchdata').html(result);
						$('#paginationDiv').hide();
						$('#s2id_selectbox-o').find('span').html('Enter Car Name For Search');
						$('#divIdShowAllChassis').hide();
						$('#totalCarId').hide();
						}
				});
		 }
		*/
		</script>
<!--  ajax function for delete the cars -->
       <script>

		 function deleteName(id,pageNo){
		var id = id;

		var pageNo = pageNo;
		$.ajax({
			url:'<?php echo $this->Html->url('/admin/cars/delete_car',true);?>',
			//data:{'id':id,'model':model},
			data:{'id':id},
			type:'post',
			success:function(data){

				var data = jQuery.parseJSON( data );
				if(data.status == 'success'){

					$.ajax({
						url:"<?php echo $this->Html->url('/admin/cars/index',true);?>",
						type:"POST",
						data:{'pageNo':pageNo},
						dataType:"html",
						success:function(result)
						{
							//console.log(result);
						//	$('#searchdata').html(result);
						//	$('#myModal').modal('hide');
							$('#errmessageDivIdDel').show();
							$('#errmessageDivIdDel').html(data.message);
							$('#errmessageDivIdDel').delay(7000).fadeOut( "slow" );
							  location.reload();
						}

					});
				}else{
				//	$("#myModal").html('');
				//	$("#myModal").modal('show');
                   alert('you are not delete successfully!');
				}

			}

		});
	}


         </script>


