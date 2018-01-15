<?php 
if($searchReport)
{
	foreach($searchReport as $details)
	{	
		?>	
	<tr>
		<td><?php echo $details['Shipschedule']['ship_name'];  ?></td>
		<td><?php echo $details['Shipschedule']['ship_no'];  ?></td>
		<td><?php echo $details['Shipschedule']['departure_port'];  ?></td>
		<td><?php echo date('d-M-Y',strtotime($details['Shipschedule']['departure_date'])); ?></td>
		<td><?php echo $details['Shipschedule']['arrival_port'];  ?></td>
		<td><?php echo date('d-M-Y',strtotime($details['Shipschedule']['arrival_date'])); ?></td>
		<td><?php echo $details['Shipschedule']['remark'];  ?></td>
		<td><?php echo $details['Shipschedule']['via_location'];  ?></td>
	</tr>
	<?php }}else { ?>
	<tr>
		<td colspan ="7" align="center" >Result not found</td>
	</tr>
	
<?php } ?>
