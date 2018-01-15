<?//php $i=1;?>
	<?php foreach($auction as $val)
	 //pr($val); die;
	{?>

						<tr class="colr_body" id="AuctionTrId<?php echo $val['Auction']['id'];?>">
						<?php echo '
						<td>'.$val['Country']['country_name'].'</td>
						<td>'.$val['Auction']['auction_name'].'-'.$val['Auction']['auction_place'].'</td>
						<td>'.$val['Auction']['fees'];?></td><td>
						
				 <a class="btn btn-info hint--bottom" data-hint="Edit" href="javascript:editAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-danger hint--bottom"  data-hint="Delete" onclick="return confirm('Are you sure want to delete');" href="javascript:deleteAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
							
						<?php  } ?>

