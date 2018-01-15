                          
<?php 
	$srNo = 1;
	foreach($CarName as $val){?>
	<tr class="colr_body" id="carnameTrId<?php echo $val['CarName']['id'];?>">
		<td id="carnameTdNme<?php echo $val['CarName']['id'];?>"><?php echo $val['CarName']['car_name'];?></td>
        <td id="carBrandTdNme<?php echo $val['CarName']['id'];?>"><?php echo $val['Brand']['brand_name'];?></td>
		<td  class="auction_carname">
			<a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['CarName']['id'];?>','<?php echo $val['CarName']['car_name'];?>')"><i class="fa fa-pencil"></i></a>
			
			<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['CarName']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
		</td>
	</tr>

<?php $srNo++;} ?>
