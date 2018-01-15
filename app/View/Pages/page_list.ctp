<div id="content1">   

	<div id="mainDiv">
		<div class="row sortable">
			<div class="box col-md-12">
				<div class="box-header well">
					<div class="col-md-12"><h2><i class="fa fa-asterisk sidebar_ico_margin">&nbsp;</i> Page Management</h2></div>
							<div class="clearfix"></div>	
				</div>
					
					<div class="box-content">
							<div class="pull-right" style="margin-bottom:20px">
						
						<?php echo $this->Html->link(__("Invoice Address",true),"/pages/invoice_address",array('class'=>'btn btn-primary btn-lg pull-right ')) ?>	
						<div class="clearfix"></div>		
							 

						</div>	
					<?php
						$success = $this->Session->flash(); 
						if($success)
						 {
							 ?>
							<div id="hideDiv">
								<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong><?php echo $success ;?></strong>
								</div>
							</div>
					<?php }?>
					</div>
							<div class="row">
					 
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
						<thead>								
								<tr class="colr_body">
								<th style="width:33%;">Sr No</th>
								<th style="width:33%;">Title</th>
								<th>Action</th>
							</tr>
						</thead>   
					  <tbody class="searchData" id="searchdata">
						  <?php $i=1;
						  
							foreach($content as $result)
							{ 
							?>
						
								<tr  data-placement="left" data-toggle="tooltip">
									<td><?php echo $i;?></td>							
									<td><?php echo $result['Page']['title'];?></td>
								    <td><a data-hint="Edit" class="btn btn-info hint--bottom" 
								   href="<?php echo $this->Html->url('/',true); ?>pages/edit_page/<?php echo $result['Page']['id'];?>"><i class="fa fa-pencil"></i></a>	
									 </td>
								</tr> 
							<?php  $i++;
							} ?>
						</tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>		
<script>
	
</script>

