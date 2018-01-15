                          
<?php 
	$srNo = 1;
	foreach($Shipping as $val){?>
	<tr id="shipTrId<?php echo $val['Shipping']['id'];?>">
		<td data-sorting="sort"><?php echo $srNo;?></td>
		
		<td id="shipTdNme<?php echo $val['Shipping']['id'];?>"><?php echo $val['Shipping']['company_name'];?></td>
		<td>
			<a class="btn btn-info" href="javascript:editName('<?php echo $val['Shipping']['id'];?>','<?php echo $val['Shipping']['company_name'];?>')"><i class="fa fa-pencil"></i> Edit</a>
			
			<a class="btn btn-danger" href="javascript:checkDelete(<?php echo $val['Shipping']['id'];?>)"><i class="fa fa-trash-o"></i> Delete</a>
		</td>
	</tr>

<?php $srNo++;} ?>
