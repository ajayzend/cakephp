<div id="content" class="span10 admin_all">
			<!-- content starts --> 
			
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="fa fa-asterisk"></i> <?php echo __('Car Management')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div class="box-content">
				
				<div class="row-fluid">
					<div class="span6">
						<div id="DataTables_Table_0_length" class="dataTables_length">
							<label>
								<select size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0">
								<option value="10" selected="selected">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
								</select> 
							records per page
							</label>
						</div>
						
					</div>
					<div class="span6">
						<div class="dataTables_filter pull-left" id="DataTables_Table_0_filter">
							<label>Search: <input type="text" aria-controls="DataTables_Table_0"></label>
						</div>
						<div class="span3 pull-right add_btn">
							<a href="/ukcars_dashboard/admin/addnew_car" class="btn btn-primary btn-small"><i class="fa fa-plus"></i> Add Car</a>		
						</div>
					</div>
				</div>
			
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						
							<!--<th><label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="option1" id="inlineCheckbox1" style="opacity: 0;"></span></div> 
							</label>
							</th>-->
							<tr>
							<th>Unique ID</th>
							<th>Location</th>
							<th>Chassis No</th>
							<th>Transmission</th>
							<th>Drive</th>
							<th>Handle</th>
							<th>Fuel</th>
							<th>stock</th>
							<th>All Stock</th>
							<th>Action</th>
						</tr>
					</thead>   
				  <tbody>
					<!--<tr>
						<td>
							<label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="option1" id="inlineCheckbox1" style="opacity: 0;"></span></div> 
						  </label>
						 </td>-->
						  <?php foreach($carDetail as $Detail){?>

						<tr>
						<?php echo '<td>'.$Detail['Car']['uniqueid'].'</td>
						<td>'.$Detail['Car']['location'].'</td>
						<td>'.$Detail['Car']['cnumber'].'</td>
						<td>'.$Detail['Car']['transmission'].'</td>
						<td>'.$Detail['Car']['drive'].'</td>
						<td>'.$Detail['Car']['handle'].'</td>
						<td>'.$Detail['Car']['fuel'].'</td>
						<td>'.$Detail['Car']['stock'].'</td>
						<td>'.$Detail['Car']['uniqueid'].'</td>
						<td><a data-toggle="modal" class="btn btn-success">Edit</a></td>
						<td><a data-toggle="modal" class="btn btn-danger">Delete</a></td></tr>';
						 } ?>
						
						 <!-- <td class="center">
							<a class="btn btn-success" href="#">
								<i class="icon-zoom-in icon-white"></i>  
								View                                            
							</a>
							<a class="btn btn-info" href="/ukcars_dashboard/admin/editcardetails">
								<i class="icon-edit icon-white"></i>  
								Edit                                            
							</a>
							<a class="btn btn-danger" href="#">
								<i class="icon-trash icon-white"></i> 
								Delete
							</a>
						</td>
					</tr>
					
					-->
				</tbody>
			</table>            
					</div>
			
			</div>
			
			
			
			
			
							
				<!-- content ends -->
			</div><!--/#content.span10-->
</div><!--/fluid-row-->
