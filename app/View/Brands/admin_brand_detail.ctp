<?php 
$srNo = 1;
foreach($Brand as $val){?>
<tr class="colr_body" id="brandTrId<?php echo $val['Brand']['id'];?>">
<!-- <td><?php echo $srNo;?></td> -->

<td  id="brandTdNme<?php echo $val['Brand']['id'];?>"><?php echo $val['Brand']['brand_name'];?></td>
<td class="auction_carname">
<a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['Brand']['id'];?>','<?php echo $val['Brand']['brand_name'];?>')"><i class="fa fa-pencil"></i></a>

<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Brand']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
</td>
</tr>
<?php $srNo++;} ?>