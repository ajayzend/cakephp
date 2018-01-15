<style type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
	}
	#titles{
		font-weight: bolder;
	}
	.trborder{
		border:1pt solid #000000; 
	}
	   
</style>
<table width="100%" border="1px solid black">
	<tr>
		<td colspan='4' align="center" ><b><h2>INVOICE DETAILS</h2><b></td>
	</tr>
	<tr>
		<td colspan='4' align="center"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>		
		<td  colspan='2' align="right" style="width:70% text-transform: capitalize " ><b>UK CORPOTATION CO. Ltd</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		
		<td  colspan='2' align="right" style="text-transform: capitalize ">VICTORIA CENTER MINAMI 403 17-26 CHIGASAKI CHUO</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		
		<td  colspan='2' align="right" >TSUZUKI-KU YOKOHAMA JAPAN</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td  colspan='2' align="right" >T224 0032</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td  colspan='2' align="right" >TEL-0766-50-8450  FAX-0766-50-8451</td>
	</tr>
	<tr>
		<td colspan='2' align="center"></td>
	</tr>
	<tr>
					<td  align="left" colspan='3' style="font-weight:bold"> CLIENT NAME  <?php echo ' - '.$invoiceDetails[0]['InvoiceDetail'][0]['User']['first_name']." ".$invoiceDetails[0]['InvoiceDetail'][0]['User']['last_name'];?><br/> CUSTOMER ID <?php echo '-'.'UD'. $invoiceDetails[0]['InvoiceDetail'][0]['User']['id']; ;?></td>
					
					<td  align="right" style="text-transform: capitalize "><?php echo $invoiceDetails[0]['Invoice']['invoice_no'] ?><br/> <?php echo $invoiceDetails[0]['Invoice']['created']; ?></td>
				</tr>
				<tr>
					<td colspan='2' align="center"></td>
				</tr>


					<tr id="titles" >
						<td colspan='4'>
							<table border=1 cellspacing=3 cellpadding=3>
							<tr >	
							<td class="tableTd " style="text-transform: capitalize " align="left"><b>S.NO.</b></td>
							<td class="tableTd " style="text-transform: capitalize "><b>CAR NAME</b></td>
							<td class="tableTd " style="text-transform: capitalize "><b>CHASSIS NO.</b></td>
							<td class="tableTd " align="right" style="text-transform: capitalize "><b>PRICE</b></td>
							</tr>
							</table>
						</td>
					</tr>
				
							<?php 
							$price = 0;
								$c=1;
								foreach($invoiceDetails[0]['InvoiceDetail'] as $val)
								{
										
									echo '<tr class ="trborder">';
									echo '<td style="text-align:left text-transform: capitalize">'.$c.'</td>';
									echo '<td class="tableTdContent" style="text-transform: capitalize ">'.$val['Car']['CarName']['car_name'].'</td>';
									echo '<td class="tableTdContent" style="text-transform: capitalize ">'.$val['Car']['cnumber'].'</td>';
									echo '<td class="tableTdContent" style="text-transform: capitalize ">'.$val['Car']['CarPayment']['currency'].$val['Car']['CarPayment']['sale_price'].'</td>';
									echo '</tr>';
									$price +=$val['Car']['CarPayment']['sale_price']; 
									$c++;
								}
							?>
					<tr id="titles">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
	
					<tr id="titles" style="border:1pt solid #000000"> 
						<td class="tableTd" colspan='2'></td>					
						<td class="tableTd" style="text-transform: capitalize "><b>TOTAL PRICE</b></td>
						<td class="tableTd"><b><?php echo $price ;?></b></td>
					</tr>

					<tr>
						<td colspan='4' align="center"></td>
					</tr>	
					<tr>
						<td colspan='4' align="center"><img src="http://projects.udaantechnologies.com/ukcars_dashboard/app/webroot/images/stamp.jpg" width="80" height="80"></td>
					</tr>
				
						<tr>
							<td></td>
							<td></td>
							<td class="tableTd" colspan='2' style="text-transform: capitalize ">BANK NAME - <?php echo ' '.$invoiceDetails[0]['Bank']['bank_name'];?></td> 
						<tr>
							<td></td>
							<td></td>
							<td class="tableTd" colspan='2' style="text-transform: capitalize ">BRANCH NAME - <?php echo ' '.$invoiceDetails[0]['Bank']['branch_name'];?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td class="tableTd" colspan='2' style="text-transform: capitalize ">SWIFT CODE - <?php echo ' '.$invoiceDetails[0]['Bank']['swift_name'];?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td class="tableTd" colspan='2' style="text-transform: capitalize ">ACCOUNT NO. - <?php echo ' '.$invoiceDetails[0]['Bank']['account_no'];?></td>
						</tr>
						<tr>
							<td><img src="http://projects.udaantechnologies.com/ukcars_dashboard/app/webroot/images/sign.jpg" width="120" height="80" ></td>
							<td></td>
							<td class="tableTd" colspan='2' style="text-transform: capitalize ">ACCOUNT NAME - <?php echo ' '.$invoiceDetails[0]['Bank']['account_name'];?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td  colspan='2' class="tableTd" style="text-transform: capitalize "> <?php echo ' '.$invoiceDetails[0]['Bank']['discription'];?></td>
						</tr>	
</table>

