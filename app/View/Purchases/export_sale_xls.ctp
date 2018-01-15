
<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Auction day</th>
            <th>Auction Name</th>
            <th>Vehicle identification number</th>
            <th>Car model</th>
            <th>Price</th>
            <th>Unit</th>
            <th>Car price</th>
            <th>Recycling charge</th>
            <th>Car Tax</th>
            <th>Successful bid charge</th>
            <th>Penalty</th>
            <th>Agency fee</th>
            <th>Auction payment date</th>
            <th>Paying bank</th>
            <th>Payment</th>
            <th>Cancellation date</th>
            <th>The first year date</th>
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
            <td><?php echo @$result['Purchase']['purchase_auction_day'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_auction_name'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_vechinle_no'] ;?></td>
            <td><?php  echo @$result['Purchase']['purchase_modal'] ; ?></td>
            <td><?php echo @$result['Purchase']['purchase_price']?></td>
            <td><?php echo @$result['Purchase']['purchase_unit'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_car_price'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_recycling'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_tax'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_bid_charge'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_panelty'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_agecy_fee'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_payment_date'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_bank'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_payment'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_cancel_date'] ;?></td>
            <td><?php echo @$result['Purchase']['purchase_first_year'] ;?></td>
            <td><?php echo @$result['Purchase']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
