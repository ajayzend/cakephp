<?php  
	if($PaymentDetails)
	{
		$count = 1;		
	foreach($PaymentDetails as $val) {?>
		<tr>
			<td class="center"><?php echo $count;  // echo $val['ClientPaymentHistory']['id'] ; ?></td>
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
		</tr>
  <?php $count++;}}else{ ?>
<tr><td colspan="10" style="text-align:center">Payment History not found</td></tr>												  
<?php }?>	                           
								 
