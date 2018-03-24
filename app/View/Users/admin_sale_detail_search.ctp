<?php
$count = 1;  	
if($SaleInvDetails)
{									
foreach($SaleInvDetails as $val)
{
?>
		<tr>
			<td class="center"><?php  echo $count; //$rows['CarPayment']['id'] ; ?></td> 
			<td class="center"><?php 
					$originalDate = $val['CarPayment']['updated_on'] ; 
					$newDate = date("d-m-Y", strtotime($originalDate));
					echo $newDate ; 
			  ?></td>
			<td class="center"><?php  echo @$val['CarName']['car_name']; ?></td>
			<td class="center"><?php  echo @$val['Car']['cnumber'] ; ?></td>
			<td class="center"><?php  if($val['CarPayment']['currency']=='$')
												{		
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo '-';
												}else
												{
													echo '-';
												} ?></td>	
				<td class="center"><?php  if($val['CarPayment']['currency']=='￥')
												{		
													echo $val['CarPayment']['sale_price'];
												}
												else if($val['CarPayment']['currency'] == '')
												{
													echo '-';
												}else
												{
													echo '-';
												}  ?>
												</td>
			<td class="center"><?php  echo @$val['Invoice']['invoice_no'] ; ?></td>
			<td class="center">
				<?php 
					if(!empty($val['Invoice']['invoice_no']))
					{
						$st = explode("/",$val['Invoice']['invoice_no']);
											
						echo $this->Html->link(
						   '<i class="fa fa-download"></i>',
							array(
								'controller'=>'invoices',
								'action' => 'export_xls',$st[1] 
							),
							array(
							
								'data-hint'=>'Download',
								'class'=>'btn btn-success hint--bottom',
								'escape'=>false  
							)
					);
					}else
					{
						echo "";
					}
				?>
			</td>
		</tr>
<?php $count++;   }}else {?>	                         
	  </tbody>
	  <tr><td colspan="10" style="text-align:center">Sales History not found</td></tr>
	<?php }?>
