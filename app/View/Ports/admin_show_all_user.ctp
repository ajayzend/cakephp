                          
<?php 
	$srNo = 1;
	foreach($portDetails as $data=>$val){?>
	<tr id="portId_<?php echo $val['Port']['id'];?>">
		<td data-sorting="sort"><?php echo $srNo ;?> </td>
		<td class="center"><?php echo $val['Port']['port_name'] ;?></td>
		<td class="center"><?php echo $val['Country']['country_name'] ;?></td>
		<td class="center"><?php echo $val['Auction']['auction_name'].'-'.$val['Auction']['auction_place'] ;?></td>
		<td class="center"><?php echo $val['Transport']['transport_name'] ;?></td>
		<td class="center">
			
			<button onclick="editPort(<?php echo $val['Port']['id'];?>);" class='btn btn-info hint--bottom' data-hint="Edit" ><i class="fa fa-pencil " ></i></button>

			<a href="javascript:checkDelete(<?php echo $val['Port']['id'];?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
			
		</td>
	</tr>

<?php $srNo++;} ?>
