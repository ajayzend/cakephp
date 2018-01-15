<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Auction Carry Out</th>
            <th>Yard => Auction</th>
            <th>Yard => Yard</th>
            <th>Requester</th>
            <th>Auction Day</th>
            <th>Land Transportation Company</th>
            <th>Presence or Absence of A Reply</th>
            <th>Point of Departure</th>
            <th>Place of Arrival</th>
            <th>Land Transportation Day</th>
            <th>Land Transportation Price</th>
            <th>The Reason for Additional Charge</th>
            <th>Additional Fee</th>
            <th>Billing Date</th>
            <th>Remarks</th>
            <th>Inspection</th>
            <th>The Presence or Absence of Inspection</th>
            
            <th>Requester</th>
            <th>Auction Day</th>
            <th>Land Transportation Company</th>
            <th>Presence or Absence of A Reply</th>
            <th>Point of Departure</th>
            <th>Place of Arrival</th>
            <th>Inspection Land Transportation Date</th>
            <th>Land Transportation Price</th>
            <th>The Reason for Additional Charge</th>
            <th>Additional Fee</th>
            <th>Billing Date</th>
            <th>Remarks</th>
            <th>Loading and Unloading</th>
            <th>Auction => Yard</th>
            <th>Yard => Auction</th>
            <th>Yard => Yard</th>
            <th>Loading and Unloading Day</th>
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
            <td><?php echo @$result['LandTransports']['auction_carry_out'] ;?></td>
            <td><?php echo @$result['LandTransports']['yard_auction'] ;?></td>
            <td><?php echo @$result['LandTransports']['yard_yard'] ;?></td>
            <td><?php echo @$result['LandTransports']['requester'] ; ?></td>
            <td><?php echo @$result['LandTransports']['auction_day']?></td>
            <td><?php echo @$result['LandTransports']['land_transportation_company'] ;?></td>
            <td><?php echo @$result['LandTransports']['presence_absence_reply'] ;?></td>
            <td><?php echo @$result['LandTransports']['point_departure'] ;?></td>
            <td><?php echo @$result['LandTransports']['place_arrival'] ;?></td>
            <td><?php echo @$result['LandTransports']['land_transportation_day'] ;?></td>
            <td><?php echo @$result['LandTransports']['land_transportation_price'] ;?></td>
            <td><?php echo @$result['LandTransports']['reason_additional_charge'] ;?></td>
            <td><?php echo @$result['LandTransports']['additional_fee'] ;?></td>
            <td><?php echo @$result['LandTransports']['billing_date'] ;?></td>
            <td><?php echo @$result['LandTransports']['remarks'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection'] ;?></td>
            <td><?php echo @$result['LandTransports']['presence_absence_inspection'] ;?></td>
            
            
            <td><?php echo @$result['LandTransports']['inspection_requester'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_auction_day'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_land_transportation_company'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_presence_absence_reply'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_point_departure'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_place_arrival'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_land_transportation_date'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_land_transportation_price'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_reason_additional_charge'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_additional_fee'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_billing_date'] ;?></td>
            <td><?php echo @$result['LandTransports']['inspection_remarks'] ;?></td>
            <td><?php echo @$result['LandTransports']['loading_unloading'] ;?></td>
            <td><?php echo @$result['LandTransports']['load_auction_yard'] ;?></td>
            <td><?php echo @$result['LandTransports']['load_yard_auction'] ;?></td>
            <td><?php echo @$result['LandTransports']['load_yard_yard'] ;?></td>
            <td><?php echo @$result['LandTransports']['loading_unloading_day'] ;?></td>
            <td><?php echo @$result['LandTransports']['load_remarks'] ;?></td>
            <td><?php echo @$result['LandTransports']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
