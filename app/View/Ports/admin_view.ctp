<div id="content1" >
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title> 
								<h2><i class="icon-edit"></i> View Port</h2>
							<div>
								<input action="action" class="btn btn-primary search_btn pull-right" type="button" value="Back" onclick="history.go(-1);" />  
							</div>
					</div>
			<div class="um_box_mid_content_mid" id="index">
				<table cellspacing="0" cellpadding="0" width="100%" border="0" class="table table-bordered table-striped" >
					<tbody>
							<tr>
								<td><strong>ID</strong></td>
								<td><?php echo $portDetails['Port']['id'] ; ?></td> 
							</tr>
							<tr>
								<td><strong>Port Name</strong></td>
								<td><?php echo $portDetails['Port']['port_name'] ; ?></td>
							</tr>

							<tr>
								<td><strong>Country Name</strong></td>
								<td><?php echo $portDetails['Country']['country_name'] ; ?></td>
							</tr>							
							<tr>
								<td><strong>Auction</strong></td>
								<td><?php echo h($portDetails['Auction']['auction_name'])?> <?php echo h($portDetails['Auction']['auction_place'])?></td>
							</tr>
							<tr>
								<td><strong>Transport Name</strong></td>
								<td><?php echo h($portDetails['Transport']['transport_name']) ; ?></td>
							</tr>
									</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	