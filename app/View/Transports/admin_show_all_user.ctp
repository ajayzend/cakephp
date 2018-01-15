                          
<?php 
	$srNo = 1;
	foreach($Transport as $val){?>
	<tr id="trnsprtTrId<?php echo $val['Transport']['id'];?>">
		<td><?php echo $srNo;?></td>
		
		<td id="trnsprtTdNme<?php echo $val['Transport']['id'];?>"><?php echo $val['Transport']['transport_name'];?></td>
		<td>
			<a class="btn btn-info" href="javascript:editName('<?php echo $val['Transport']['id'];?>','<?php echo $val['Transport']['transport_name'];?>')"><i class="fa fa-pencil"></i> Edit</a>
			
			<a class="btn btn-danger" href="javascript:checkDelete(<?php echo $val['Transport']['id'];?>)"><i class="fa fa-trash-o"></i> Delete</a>
		</td>
	</tr>

<?php $srNo++;} ?>
