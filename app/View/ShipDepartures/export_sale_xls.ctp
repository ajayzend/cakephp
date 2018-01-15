<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Office Name</th>
            <th>Inspection</th>
            <th>Re-examination</th>
            <th>Inspection Commission</th>
            <th>Management Fee</th>
            <th>Inspection Fee Payment Date</th>
            <th>Payment</th>
            <th>Remarks</th>
            <th>Success or Failure</th>
            <th>Documents Date of Shipment to QISJ</th>
            <th>Documents Return Date from QISJ</th>
            <th>Documents Date of Shipment to SPX</th>
            <th>Documents Return Date from QISJ to Toyama</th>
            <th>Ship Company Payment Date</th>
            <th>BILL No.</th>
            <th>Original BILL Toyama Date of Arrival</th>
            <th>Original BILL DHL Request Date</th>
            <th>Shipping Request Date</th>
            <th>ODOMETER Documents Toyama Date of Arrival</th>
            <th>Shipping Charge</th>
            <th>In Out Charge </th>
            <th>Other Charge</th>
            <th>Banning Charge</th>
            <th>Radioactivity Inspection Fee</th>
            <th>Storage Fee</th>
            <th>Land Transportation Fee</th>
            <th>Cost of Repairs</th>
            <th>Freight</th>
            <th>Work Fee</th>
            <th>Consignee Change Fee</th>
            <th>Ship's Name</th>
            <th>Payment</th>
            <th>Land For</th>
            <th>Departure Location</th>
            <th>Ship Company</th>
            
            <th>Departure Date</th>
            <th>Date of Arrival</th>
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
            <td><?php echo @$result['ShipDepartures']['office_name'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['inspection'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['re_examination'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['inspection_commission'] ; ?></td>
            <td><?php echo @$result['ShipDepartures']['Management_fee']?></td>
            <td><?php echo @$result['ShipDepartures']['inspection_fee_payment-date'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['payment'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['remarks'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['success_failure'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['documents_date_shipment_QISJ'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['documents_return_date_QISJ'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['documents_date_shipment_SPX'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['documents_return_date_QISJ_to_toyama'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['ship_company_payment_date'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['bill_no'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['original_bill_toyama_date_arrival'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['original_bill_dhl_request_date'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['shipping_request_date'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['odometer_documents_toyama_date_arrival'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['shipping_charge'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['in_out_charge'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['other_charge'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['banning_charge'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['radioactivity_inspection_fee'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['storage_fee'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['land_transportation_fee'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['cost_repairs'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['freight'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['work_fee'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['consignee_change_fee'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['ship_name'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['ship_payment'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['land_for'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['departure_location'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['ship_company'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['departure_date'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['date_arrival'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['last_remarks'] ;?></td>
            <td><?php echo @$result['ShipDepartures']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>
