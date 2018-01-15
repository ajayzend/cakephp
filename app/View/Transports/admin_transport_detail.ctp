                          
<?php 
	$srNo = 1;
	foreach($Transport as $val){?>
	<tr class="colr_body" id="trnsprtTrId<?php echo $val['Transport']['id'];?>">
		<!-- <td><?php echo $srNo;?></td> -->
		
		<td id="trnsprtTdNme<?php echo $val['Transport']['id'];?>"><?php echo $val['Transport']['transport_name'];?></td>
		<td class="auction_carname">
			<a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['Transport']['id'];?>','<?php echo $val['Transport']['transport_name'];?>')"><i class="fa fa-pencil"></i></a>
			
			<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Transport']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
		</td>
	</tr>

<?php $srNo++;} ?>
