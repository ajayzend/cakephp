<?php //echo $this->Html->script('jquery-form');?>
<?php //echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));?>
<?php //echo $this->Html->script(array('select2.min','cbunny'));?>
<?php 
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>

<script>
/*function ClientSearch()
{
	var key = $('#keyword').val();
	var datas  =  {'key':key}; 
	$.ajax({
		url:"/ukcars_dashboard/admin/users/clientSearch",
		type:"POST",
		data:datas,
		success:function(result)
		{
			$('#show_search_client').html(result);
			
		}
						
	});
}*/

/*function clearSearch()
{
	window.location = "<?php echo $this->Html->url('/admin/users/allUsers',true)?>";
}*/

function ClientStatus(id)
{
	var val =$('#userStatus'+id).val() ;
	if(val == 'Active')
	{	
	  var status = 0;
	}
	else
	{
		var status = 1;
	}
	var datas  =  {'id':id,'status':status}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/users/clientStatus',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading"+id).show();
           },
		success:function(result)
		{
			 $("#loading"+id).hide();
			$('#userStatus'+id).val(result);
			if(result=='Active')
			{
				$('#userStatus'+id).removeClass('btn btn-danger').addClass('btn btn-success');
			}else
			{
				$('#userStatus'+id).removeClass('btn btn-success').addClass('btn btn-danger');
			}
		}
						
	});
}

$(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/users/InfoClient',true);?>',
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

   /*
   $(document).ready(function(){
    $('#selectbox-o').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/invoices/invoClientSearch',true);?>',
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
    }); */
 $(function()
		{
			
			
			
			$("#selectbox-o").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/users/clientSearch',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html(),id:$("#selectbox-o").val()},
					dataType:"html",
					success:function(result)
					{
					
						$('#show_search_client').html(result);
						$('#showAllUsrDivBtn').show();
						$('#paginationDivId').hide();
						
					}
				});
		});
	   
	});     





function clearSearch(){
		$.ajax({
			url:"<?php echo $this->Html->url('/admin/users/allUsers',true);?>",
			type:"POST",
			data:{},
			dataType:"",
			success:function(result)
			{
				$('#ajax-response').html(result);
			}
		});
	}
$(function(){
get_jpy_price();
$('#showMessage').delay(4000).fadeOut( "slow" );
});


 function get_jpy_price(){
		$.ajax({
				'url':'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20%28%22USDJPY%22%29&format=json&env=store://datatables.org/alltableswithkeys',
				'type':'get',
				"dataType":'json',
				'success':function(obj){
					
							var newRate = Math.floor(obj.query.results.rate.Rate) -1 ;	
							$.ajax({
							url:"<?php echo $this->Html->url('/admin/users/current_doller_to_yen_rate',true);?>",
							type:'POST',
							data:{'newrate':newRate},
							success:function(result)
							{
								
							}					
						});
					
				},
				'error':function(error){
						alert(error);
					
					
					}
			
			
		});
	
	
}
</script>
<div id="ajax-response">
<div id="content1">
			<!-- content starts -->
			
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<div class=" col-md-12"><h2><i class="fa fa-users">&nbsp;</i> <?php echo __('Client Management'); ?></h2></div>
								<div class="clearfix"></div>	
					</div>
						<div id="showMessage">
							<?php
							$success = $this->Session->flash();
							if($success) {?>
							<div  class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert"></button>
								<strong><?php echo $success ;?></strong>
							</div>
							<?php }?>
						</div>
					<div class="box-content">
						<div class="row">
						 <div class="col-md-6">
						 	<input class="input-xlarge col-md-6" id="selectbox-o" name="optionvalue" data-placeholder="Enter Client Name For Search">
						 	<div id="showAllUsrDivBtn" style="display:none;" class="col-md-3">
								<button class="btn btn-primary pull-right" onClick="clearSearch()"> 
								Clear Search
								</button> 
							</div>

						 </div>	
				         <div class="col-md-6">
						 <div class="row">
						 <div class="col-md-12 pull-right">
						 <!--<input type="text" id="keyword"  placeholder="Search"  class="input-xlarge pull-left col-md-10" />
						 <input type="button" class="btn btn-primary search_btn" id="button" onClick="ClientSearch()" value="Search" /> -->
<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Add' ,
											array(
												'action' => 'addUser'
											),
											array(
											
												'data-hint'=>'Add Client',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);?>						 
<?php /*echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Bid Report' ,
											array(
												'action' => 'bid_report'
											),
											array(
											
												'data-hint'=>'Bid Report',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);*/?>
						<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>User Balance List' ,
											array(
												'action' => 'balance_detail'
											),
											array(
											
												'data-hint'=>'Balance Detail',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);?>
						 
						 <!--<div class="add_btn col-md-2 pull-right hint--bottom"  data-hint="Add Clients" style="padding-right:0px;"><?php //echo $this->Html->link(__("Add",true),"/admin/users/addUser",array('type'=>'submit','class'=>"btn btn-primary pull-right")) ?>
						
						 </div>-->
						 
						 </div>
						 </div>
						 </div>
						 </div>
						 </div>
					
						<table class="table table-striped my-table table-bordered bootstrap-datatable datatable custom_table" id="show_search_client">
						  <thead>
							   <tr  class="colr_body">
								  <!--<th ><?php echo __('S.No.');?></th>-->
								  <th><?php echo __('Name');?></th>
								 <th><?php echo __('Email');?></th>
								  <th><?php echo __('Status');?></th>
								  <th><?php echo __('Customer code');?></th>
								  <th class="col-sm-4">Actions</th>
							  </tr>
						  </thead>   
						  
					  <tbody>
					 <?php if (!empty($users))
					  {
					  $srN=1;
					  foreach ($users as $row) 
						{
								
							  if($row['User']['id']!=1)
							  {
					  ?>
							<tr class="odd colr_body">
									<!--<td class=""><?php //echo $srNo; ?></td> -->
									<td class="center" style='text-transform: capitalize'>
										<?php   //echo h($row['User']['first_name'])." ".h($row['User']['last_name']); 
										
										echo $this->Html->link(@h($row['User']['first_name'])." ".h($row['User']['last_name']),array('controller'=>'users', 'action'=>'user_bid_report',$row['User']['id']),array('escape' => FALSE,'target'=>'_blank'));
										
										
										
										?></td>
									
									<td class="center "><?php echo h($row['User']['email']); ?></td>
									<td class="center ">
										
											<?php 
											if ($row['User']['active']==1) {
													$status = "Active";
													$style ="btn btn-success"; 
												} else {
													$status = "Inactive";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="userStatus<?php echo $row['User']['id'];?>" onClick="ClientStatus(<?php echo $row['User']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $row['User']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 

										
									</td>
									<td class="center ">
											<?php 
											echo $row['User']['uniqueid'];
											?>
									</td> 
									<td class="center sorting_1">

										<?php //echo $this->Html->link('View',array('action' => 'viewUser', $row['User']['id']),array('class'=>'btn btn-success'));?>

<?php										
//echo $this->Html->link('<i class="fa fa-eye"></i>',array('action' => 'viewUser', $row['User']['id']),array('data-hint'=>'View',
       // 'class'=>'btn btn-success hint--bottom',
        //'escape'=>false  
    //)
//);
?>

										
										<?php //echo $this->Html->link('Edit',array('action' => 'editUser', $row['User']['id']),array('class'=>'btn btn-info hint--bottom','data-hint'=>'Edit'));?>

										<?php										
echo $this->Html->link(
   '<i class="fa fa-pencil"></i>',
    array(
    	'action' => 'editUser', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Edit',
        'class'=>'btn btn-info hint--bottom',
        'escape'=>false  
    )
);
?>
						
										<?php //echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',array('action' => 'delete', $row['User']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom' ,'data-hint'=>'Delete')); ?>
<?php										
echo $this->Form->postLink(
   '<i class="fa fa-trash-o"></i>',
    array(
    	'action' => 'delete', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Delete',
        'class'=>'btn btn-danger hint--bottom',
        'escape'=>false,
        'confirm' => 'Are you sure want to delete user ?'  
		
    )
);
?>
	
										
										<?php //echo $this->Html->link('Payment',array('action' => 'clientHistory', $row['User']['id']),array('class'=>'btn btn-small btn-primary'));?>

										<?php										
echo $this->Html->link(
   '<i class="fa fa-money"></i>',
    array(
    	'action' => 'clientHistory', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Payment',
        'class'=>'btn btn-primary hint--bottom',
        'escape'=>false  
    )
);
?>
<?php
echo $this->Html->link(
   '<i class="fa fa-unlock-alt"></i>',
    array(
    	'action' => 'changePassword', $row['User']['id']
    ),
    array(
    
        'data-hint'=>'Change Password',
        'class'=>'btn btn-primary hint--left',
        'escape'=>false  
    )
);
?>
										
									</td>
								</tr> 
						<?php
								 }
							$srNo++;}
						}
						else
						{
						?>
								<tr><td colspan="10" style="text-align:center">Result not found</td></tr>  
						<?php
						}
						?>
							
							</tbody> 
							
					</table>         
					<?php 
					
					if($count > $limit){?>
						<div id="paginationDivId" class="col-md-6 pull-right">
							<ul class=" pagination pull-right">
								<?php
									//echo  $this->Paginator->options(array('url'=>array('controller'=>'users','action'=>'allUsers')));
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
					<?php }?>
				</div><!--/span-->
			
			</div>
			</div>
			</div>
		
	
</div>
</div> <!-- Ajax response  close-->
