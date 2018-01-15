<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>CLIENT NAME</th>
            <th>Consignee Name</th>
            <th>Postal Address</th>
            <th>CFS</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Contact Parson</th>
            <th>Notify Party</th>
            <th>Notify Party Telephone</th>
            <th>Notify Party Email</th>
            <th>Vehicle Identification Number</th>
            <th>Car Model</th>
            <th>Invoice No.</th>
            <th>Invoice Day</th>
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
            <td><?php echo @$result['Information']['client_name'] ;?></td>
            <td><?php echo @$result['Information']['consignee_name'] ;?></td>
            <td><?php echo @$result['Information']['postal_address'] ;?></td>
            <td><?php echo @$result['Information']['cfs'] ; ?></td>
            <td><?php echo @$result['Information']['telephone']?></td>
            <td><?php echo @$result['Information']['email'] ;?></td>
            <td><?php echo @$result['Information']['contact_parson'] ;?></td>
            <td><?php echo @$result['Information']['notify_party'] ;?></td>
            <td><?php echo @$result['Information']['notify_party_telephone'] ;?></td>
            <td><?php echo @$result['Information']['notify_party_email'] ;?></td>
            <td><?php echo @$result['Information']['vehicle_identification_number'] ;?></td>
            <td><?php echo @$result['Information']['car_model'] ;?></td>
            <td><?php echo @$result['Information']['invoice_no'] ;?></td>
            <td><?php echo @$result['Information']['invoice_day'] ;?></td>
            <td><?php echo @$result['Information']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
