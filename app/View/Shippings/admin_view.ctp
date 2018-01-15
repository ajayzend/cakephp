<div id="content" class="col-md-10" >
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title> 
								<h2><i class="icon-edit"></i> View Shipping</h2>
							<div>
								<input action="action" class="btn btn-primary search_btn pull-right" type="button" value="Back" onclick="history.go(-1);" />  
							</div>
					</div>
			<div class="um_box_mid_content_mid" id="index">
				<table cellspacing="0" cellpadding="0" width="100%" border="0" class="table table-bordered table-striped" >
					<tbody>
							<tr>
								<td><strong>ID</strong></td>
								<td><?php echo $shipDetails['Shipping']['id'] ; ?></td> 
							</tr>
							<tr>
								<td><strong>Shipping Name</strong></td>
								<td><?php echo $shipDetails['Shipping']['company_name'] ; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

	