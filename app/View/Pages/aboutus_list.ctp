<div id="content1">   

	<div id="mainDiv">
		<div class="row sortable">
			<div class="box col-md-12">
				<div class="box-header well">
					<div class="col-md-12"><h2><i class="fa fa-asterisk sidebar_ico_margin">&nbsp;</i>About Us List</h2></div>
							<div class="clearfix"></div>	
					</div>
					
					<div class="box-content">
						<div class="row">
						
									<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Add about us' ,
											array(
												'action' => 'edit_aboutus'
											),
											array(
											
												'data-hint'=>'Add About us content',
												'class'=>'btn btn-primary btn-lg pull-right hint--bottom',
												'escape'=>false  
											)
										);?>	
						</div>
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
						
					 
						<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table cont-4">
						<thead>								
								<tr class="colr_body">
								<td>Sr No</td>
								<td style="width: 60%;">Description</td>
								<td>Image</td>
								<td style="width:150px;">Action</td>
							</tr>
						</thead>   
					  <tbody class="searchData" id="searchdata">
						  <?php $i=1;
						   $upload_path=WWW_ROOT.'uploads/about_img';
							foreach($data as $result)
							{ 
							$media=$this->webroot."uploads/about_img/".$result['About']['img_source'];?>
						
								<tr  data-placement="left" data-toggle="tooltip">
									<td><?php echo $i;?></td>							
									<td><?php echo $result['About']['discription'];?></td>
									<td><img src="<?php echo $media; ?>" alt="" width="100" height="50" /></td>
									
								   <td><a data-hint="Edit" class="btn btn-info hint--bottom" 
								   href="<?php echo $this->Html->url('/',true); ?>pages/edit_aboutus/<?php echo $result['About']['id'];?>"><i class="fa fa-pencil"></i></a>	
								   <a data-hint="Delete" class="btn btn-danger hint--bottom" 
								   href="<?php echo $this->Html->url('/',true); ?>pages/delete_aboutus/<?php echo $result['About']['id'];?>"><i class="fa fa-trash-o"></i></a>
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


