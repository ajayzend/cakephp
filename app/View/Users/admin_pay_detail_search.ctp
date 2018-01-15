<?php
$count = 1;  
if($PaymentDetails)
{
	//pr($PaymentDetails);

foreach($PaymentDetails as $val) {?>
	<tr>
		<td class="center"><?php  echo $count; //$val['ClientPaymentHistory']['id'] ; ?></td>
		<!--<td class="center"><?php  //echo $val['ClientPaymentHistory']['client_id'] ; ?></td> -->
		<td class="center">
				<?php 
					$originalDate = $val['ClientPaymentHistory']['payment_date']; 
					$newDate = date("d-m-Y", strtotime($originalDate));
					echo $newDate;
				?>
		</td>
		<td class="center"><?php  echo $val['ClientPaymentHistory']['amount'] ; ?></td>
		<td class="center"><?php  echo $val['ClientPaymentHistory']['yen_amount'] ; ?></td>
		<td class="center"><?php  echo $val['ClientPaymentHistory']['remark'] ; ?></td>
		<td class="center">
										<input type="button" onClick="payDelete('<?php echo $val['ClientPaymentHistory']['id'] ;?>');" 	class="btn btn-danger"  value="Delete" />
										<input type="button" onClick="editPayment('<?php echo $val['ClientPaymentHistory']['id'] ;?>','<?php echo $val['ClientPaymentHistory']['client_id'] ;?>');" 	class="btn btn-success"  value="Edit" />	
											
		</td>                                        
	</tr>
<?php $count++;}}else{ ?>
<tr><td colspan="10" style="text-align:center">Payment History not found</td></tr>												  
<?php }?>		
