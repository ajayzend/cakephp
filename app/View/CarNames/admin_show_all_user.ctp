                          
<?php 
	$srNo = 1;
	foreach($Transport as $val){?>
	<tr id="carnameTrId<?php echo $val['CarName']['id'];?>">
		<td data-sorting="sort"><?php echo $srNo;?></td>
		<td id="carnameTdNme<?php echo $val['CarName']['id'];?>"><?php echo $val['CarName']['car_name'];?></td>
		<td>
			<a class="btn btn-info" href="javascript:editName('<?php echo $val['CarName']['id'];?>','<?php echo $val['CarName']['car_name'];?>')"><i class="fa fa-pencil"></i> Edit</a>
			
			<a class="btn btn-danger" href="javascript:checkDelete(<?php echo $val['CarName']['id'];?>)"><i class="fa fa-trash-o"></i> Delete</a>
		</td>
	</tr>

<?php $srNo++;} ?>
