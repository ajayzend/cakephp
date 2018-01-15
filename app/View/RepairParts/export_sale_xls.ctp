<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Repair</th>
            <th>Date of Repair</th>
            <th>Repair Company</th>
            <th>Vehicle Identification Number</th>
            <th>Car Model</th>
            <th>Price</th>
            <th>Remarks</th>
            <th>Parts</th>
            <th>Purchase Date</th>
            <th>Purchasing Company</th>
            <th>Vehicle Identification Number</th>
            <th>Car Model</th>
            <th>Parts Name</th>
            <th>Price</th>
            <th>Remarks</th>
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
            <td><?php echo @$result['RepairParts']['repair'] ;?></td>
            <td><?php echo @$result['RepairParts']['date_of_repair'] ;?></td>
            <td><?php echo @$result['RepairParts']['repair_company'] ;?></td>
            <td><?php echo @$result['RepairParts']['vehicle_identification_number'] ; ?></td>
            <td><?php echo @$result['RepairParts']['car_model']?></td>
            <td><?php echo @$result['RepairParts']['price'] ;?></td>
            <td><?php echo @$result['RepairParts']['remarks'] ;?></td>
            <td><?php echo @$result['RepairParts']['parts'] ;?></td>
            <td><?php echo @$result['RepairParts']['purchase_date'] ;?></td>
            <td><?php echo @$result['RepairParts']['purchasing_company'] ;?></td>
            <td><?php echo @$result['RepairParts']['part_vehicle_identification_number'] ;?></td>
            <td><?php echo @$result['RepairParts']['part_car_model'] ;?></td>
            <td><?php echo @$result['RepairParts']['parts_name'] ;?></td>
            <td><?php echo @$result['RepairParts']['parts_price'] ;?></td>
            <td><?php echo @$result['RepairParts']['parts_remarks'] ;?></td>
            <td><?php echo @$result['RepairParts']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
