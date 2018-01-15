<table class="table" border='1' style="border-top:1px solid black;border-bottom:1px solid black">
 <thead>
		  <tr>
			  <th><?php echo __('S.No.');?></th>
			  <!--<th><?php //echo __('Client Id');?></th> -->
			  <th> <?php echo __('Date');?></th>
			  <th> <?php echo __('Payment($)');?></th>
			  <th> <?php echo __('Payment(￥)');?></th>
			  <th width="100"> <?php echo __('Remark');?></th>                                          
		  </tr>
	  </thead>   
	  <tbody id="PaymentDetails"> 
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
				<td class="center" style="word-wrap: break-word;"><?php  echo $val['ClientPaymentHistory']['remark'] ; ?></td>                                       
			</tr>
	  <?php $count++;}}else{ ?>
	<tr><td colspan="10" style="text-align:center">Payment History not found</td></tr>												  
	<?php }?>	                           
	  </tbody>
</table>      
