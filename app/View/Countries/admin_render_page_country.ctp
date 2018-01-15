<table border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
	
	<tbody id="searchdata">
	<?//php $srNo++;?>
	<?php foreach($Auction as $val)
	 //pr($val); die;
	{?>
                      
					
						<?php echo '
						<td id=cname_'.$val['Country']['id'].'>'.$val['Country']['country_name'].'</td>
						<td id=rname_'.$val['Country']['id'].'>'.$val['Country']['rickshaw'].'</td>
						<td id=fname_'.$val['Country']['id'].'>'.$val['Country']['freight'].'</td>
						<td id=sname_'.$val['Country']['id'].'>'.$val['Country']['shipping'].'</td>
						<td id=sname_'.$val['Country']['id'].'>'.$val['Country']['others'].'</td>
						<td id=oname_'.$val['Country']['id'].'>'.$val['Country']['order'];?></td>
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
						<td style="width:10%;">
				 <a class="btn btn-info hint--bottom"  data-hint="Edit"  id="<?//php echo $srNo; ?>"  href="javascript:editCountry(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-pencil"></i></a>
						<a <a class="btn btn-danger hint--bottom"  data-hint="Cancel" onclick="return confirm('Are you sure want to delete');" href="javascript:deleteName(<?php echo $val['Country']['id'].",'".key($val);?>')"><i class="fa fa-trash-o"></i></a></td></tr>
							<?php } ?>
				
				</tbody>		
	</table>
	
