<?//php $i=1;?>
	<?php foreach($Auction as $val)
	// pr($Detail); die;
	{?>

						<tr class="colr_body">
						<?php echo '
						<td>'.$val['Country']['country_name'].'</td>
						<td>'.$val['Country']['rickshaw'].'</td>
						<td>'.$val['Country']['freight'].'</td>
						<td>'.$val['Country']['shipping'].'</td>
						<td>'.$val['Country']['others'].'</td>
						<td>'.$val['Country']['order'];?></td>
						<td>
						<?php 
											if ($val['Country']['status']==0) {
													$status = "Publish";
													$style ="btn btn-success"; 
												} else {
													$status = "Unpublish";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="status<?php echo $val['Country']['id'];?>" onClick="CountryStatus(<?php echo $val['Country']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $val['Country']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
						
						</td>
						<td>
				 <a class="btn btn-info hint--bottom" data-hint="Edit" href="javascript:editCountry(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-pencil" ></i></a>
						<a class="btn btn-danger hint--bottom" data-hint="Delete"  onclick="return confirm('Are you sure want to delete');" href="javascript:deleteName(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
							
						<?php } ?>
