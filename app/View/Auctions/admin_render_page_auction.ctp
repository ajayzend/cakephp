<table border="1" cellspacing="4" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
	
	<tbody id="searchdata">
	<?//php $srNo++ ;?>
	<?php foreach($Auction as $val)
	//pr($val);
	{?>  
                        <?//php   pr($val); ?>
						<tr class="colr_body" id="AuctionTrId<?php echo $val['Auction']['id'];?>">

						<?php echo '
						<td id=cname_'.$val['Auction']['id'].'>'.$val['Country']['country_name'].'</td>
						<td id=aname_'.$val['Auction']['id'].'>'.$val['Auction']['auction_name']."-".$val['Auction']['auction_place'].'</td>
						
						<td id=fees_'.$val['Auction']['id'].'>'.$val['Auction']['fees'];?></td><td style="width:3%;">
						<a class="btn btn-info hint--bottom"  data-hint="Edit" id="<?//php echo $srNo; ?>" href="javascript:editAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-danger hint--bottom"  data-hint="Cancel" onclick="return confirm('Are you sure want to delete');" href="javascript:deleteAuction(<?php echo $val['Auction']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
											
				<!--<a class="btn btn-info" href="javascript:editName(<?//php echo $val['Auction']['id'].",'".key($val);?>');"><i class="fa fa-pencil"></i> Edit</a></td><td>-->
				 <?//php echo $this->Html->link('view',array('action' => 'view', $val['Auction']['id']),array('class' => 'btn btn-success'));?>
                  <?//php echo $this->Html->link('Edit',array('action' => 'addnew_car', $val['Auction']['id']),array('class' => 'btn btn-info'));?>
				  <?//php echo $this->Form->postLink('Delete',array('action' => 'delete', $val['Auction']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger')).'</td></tr>';
                       
						 } ?>
						 </tbody>
	</table>
 
