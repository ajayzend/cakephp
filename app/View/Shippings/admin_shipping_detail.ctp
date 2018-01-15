                          
						  <?php  
					$srNo = 1;
					foreach($Shipping as $val){?>
						<tr class="colr_body" id="shipTrId<?php echo $val['Shipping']['id'];?>">
							<!-- <td><?php echo $srNo;?></td> -->
							
							<td id="shipTdNme<?php echo $val['Shipping']['id'];?>"><?php echo $val['Shipping']['company_name'];?></td>
							<td  class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['Shipping']['id'];?>','<?php echo $val['Shipping']['company_name'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Shipping']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>

					<?php $srNo++;} ?>
