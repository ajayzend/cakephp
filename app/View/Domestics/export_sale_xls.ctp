<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>sales day</th>
            <th>sales auction　Name</th>
            <th>Vehicle identification number</th>
            <th>Car model</th>
            <th>Price</th>
            <th>Unit</th>
            <th>Car price</th>
            <th>Exhibition charge</th>
            <th>Conclusion of a contract fee</th>
            <th>Remarks</th>
            <th>Sales payment day</th>
            <th>Sales payment Bank</th>
            <th>Payment amount</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        
    <?php 
    
    $c = 1;
    foreach ($saleReports as $result)
    {
		?>	
        <tr>
            <td><?php echo $c; ?></td>
            <td><?php echo @$result['Domestic']['sales_day'] ;?></td>
            <td><?php echo @$result['Domestic']['auction_name'] ;?></td>
            <td><?php echo @$result['Domestic']['indentification'] ;?></td>
            <td><?php echo @$result['Domestic']['model'] ; ?></td>
            <td><?php echo @$result['Domestic']['price']?></td>
            <td><?php echo @$result['Domestic']['unit'] ;?></td>
            <td><?php echo @$result['Domestic']['car_price'] ;?></td>
            <td><?php echo @$result['Domestic']['exhibition'] ;?></td>
            <td><?php echo @$result['Domestic']['contact_fee'] ;?></td>
            <td><?php echo @$result['Domestic']['remark'] ;?></td>
            <td><?php echo @$result['Domestic']['payment_day'] ;?></td>
            <td><?php echo @$result['Domestic']['payment_bank'] ;?></td>
            <td><?php echo @$result['Domestic']['payment_amount'] ;?></td>
            <td><?php echo @$result['Domestic']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
