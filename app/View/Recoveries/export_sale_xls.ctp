<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Remittance Names</th>
            <th>Amount of Remittance ($)</th>
            <th>Amount of Remittance (&yen;)</th>
            <th>Remittance Bank</th>
            <th>Country</th>
            <th>Customer Name</th>
            <th>Remittance Date</th>
            <th>Remittance No.</th>
            <th>Rate</th>
            <th>Rate (Advances Received)</th>
            <th>Terms of Amount</th>
            <th>Exchange Loss (&yen;)</th>
            <th>Exchange Loss ($)</th>
            <th>Rounding Loss</th>
            <th>Exchange Gain (&yen;)</th>
            <th>Exchange Gain ($)</th>
            <th>Rounding Gains</th>
            <th>Advance</th>
            <th>Chash (Advances Received)</th>
            <th>Customer Unknown</th>
            <th>Distribution of Remittance</th>
            <th>Remarks</th>
            <th>Cancel Remittance Names</th>
            <th>Cancel Amount of Remittance ($)</th>
            <th>Cancel Amount of Remittance (&yen;)</th>
            <th>Remittance Bank</th>
            <th>Country</th>
            <th>Customer Name</th>
            <th>Remittance Date</th>
            <th>Remittance No.</th>
            <th>Hit Back Day</th>
            <th>Rate</th>
            <th>Rate (Advances Received)</th>
            <th>Terms of Amount</th>
            <th>Exchange Loss (&yen;)</th>
            <th>Exchange Loss ($)</th>
            <th>Rounding Loss</th>
            <th>Exchange Gain (&yen;)</th>
            <th>Exchange Gain ($)</th>
            <th>Rounding Gains</th>
            <th>Advance</th>
            <th>Cash (Advances Received)</th>
            <th>Customer Unknown</th>
            <th>Remarks</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        
    <?php 
    
    $c = 1;
    foreach ($saleReports as $result)
    {?>	
        <tr>
            <td><?php echo $c; ?></td>
            <td><?php echo @$result['Recovery']['remittance_names'] ;?></td>
            <td><?php echo @$result['Recovery']['amount_remittance_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['amount_remittance_yen'] ;?></td>
            <td><?php  echo @$result['Recovery']['remittance_bank'] ; ?></td>
            <td><?php echo @$result['Recovery']['country']?></td>
            <td><?php echo @$result['Recovery']['customer_name'] ;?></td>
            <td><?php echo @$result['Recovery']['remittance_date'] ;?></td>
            <td><?php echo @$result['Recovery']['remittance_no'] ;?></td>
            <td><?php echo @$result['Recovery']['rate'] ;?></td>
            <td><?php echo @$result['Recovery']['rate_advances'] ;?></td>
            <td><?php echo @$result['Recovery']['terms_amount'] ;?></td>
            <td><?php echo @$result['Recovery']['exchange_loss_yen'] ;?></td>
            <td><?php echo @$result['Recovery']['exchange_loss_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['eounding_loss'] ;?></td>
            <td><?php echo @$result['Recovery']['exchange_gain_yen'] ;?></td>
            <td><?php echo @$result['Recovery']['exchange_gain_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['rounding_gains'] ;?></td>
            
            
            <td><?php echo @$result['Recovery']['advance'] ;?></td>
            <td><?php echo @$result['Recovery']['cash_advances'] ;?></td>
            <td><?php echo @$result['Recovery']['customer_unknown'] ;?></td>
            <td><?php echo @$result['Recovery']['distribution_remittance'] ;?></td>
            <td><?php echo @$result['Recovery']['remarks'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_remittance_names'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_amount_remittance_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_amount_remittance_yen'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_remittance_bank'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_country'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_customer_name'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_remittance_date'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_remittance_no'] ;?></td>
            <td><?php echo @$result['Recovery']['hit_back_day'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_rate'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_rate_advances'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_terms_amount'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_exchange_loss_yen'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_exchange_loss_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['rounding_loss'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_exchange_gain_yen'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_exchange_gain_dlr'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_rounding_gains'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_advance'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_cash_advances'] ;?></td>
            <td><?php echo @$result['Recovery']['cnacel_customer_unknown'] ;?></td>
            <td><?php echo @$result['Recovery']['cancel_remarks'] ;?></td>
            <td><?php echo @$result['Recovery']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
