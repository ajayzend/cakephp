                          
<?php 
	$srNo = 1;
	foreach($Brand as $val){?>
	<tr id="brandTrId<?php echo $val['Brand']['id'];?>">
		<td><?php echo $srNo;?></td>
		
		<td id="brandTdNme<?php echo $val['Brand']['id'];?>"><?php echo $val['Brand']['brand_name'];?></td>
		<td>
			<a class="btn btn-info" href="javascript:editName('<?php echo $val['Brand']['id'];?>','<?php echo $val['Brand']['brand_name'];?>')"><i class="fa fa-pencil"></i> Edit</a>
			
			<a class="btn btn-danger" href="javascript:checkDelete(<?php echo $val['Brand']['id'];?>)"><i class="fa fa-trash-o"></i> Delete</a>
		</td>
	</tr>

<?php $srNo++;} ?>
