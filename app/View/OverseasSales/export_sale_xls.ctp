
<?php
?>
<table border=1 class="table table-striped table-bordered custom_table">
    <thead>
        <tr>
        	<th>Sr. No.</th>
            <th>Sales Country</th>
            <th>Customer Name</th>
            <th>Sales Day</th>
            <th>Sales Price ($)</th>
            <th>Sales Price (&yen;)</th>
            <th>Unit</th>
            <th>Invoice No.</th>
            <th>Invoice Day</th>
            <th>BILL No.</th>
            <th>BILL No. (UK)</th>
            <th>Rate (Accounts Receivable)</th>
            <th>Rate (Advances Received)</th>
            <th>Slip Issuance Date</th>
            <th>Remarks</th>
            <th>Cancel Sales Country</th>
            <th>Cancel Customer Name</th>
            <th>Sales Day</th>
            <th>Cancel Day</th>
            <th>Cancel Price ($)</th>
            <th>Cancel Price (&yen;)</th>
            <th>Invoice No.</th>
            <th>Invoice Day</th>
            <th>BILL No.</th>
            <th>BILL No. (UK)</th>
            <th>Rate (Accounts Receivable)</th>
            <th>Rate (Advances Received)</th>
            <th>Slip Issuance Date</th>
            <th>Remarks</th>
            <th>Amount Change Sales Country</th>
            <th>Amount Change Customer Name</th>
            <th>Sales Day</th>
            <th>Change Day</th>
            <th>Changed Contents</th>
            <th>Change Price ($)</th>
            <th>Change Price (&yen;)</th>
            <th>Invoice No.</th>
            <th>Invoice Day</th>
            <th>BILL No.</th>
            <th>BILL No. (UK)</th>
            <th>Rate (Accounts Receivable)</th>
            <th>Rate (Advances Received)</th>
            <th>Slip Issuance Date</th>
            <th>Remarks</th>
            <th>Customer Change Sales Country</th>
            <th>Customer Change Customer Name</th>
            <th>Sales Day</th>
            <th>Change Day</th>
            <th>Changed Contents</th>
            <th>Invoice No.</th>
            <th>Invoice Day</th>
            <th>BILL No.</th>
            <th>BILL No. (UK)</th>
            <th>Rate (Accounts Receivable)</th>
            <th>Rate (Advances Received)</th>
            <th>Slip Issuance Date</th>
            <th>Remarks</th>
            <th>Remittance Names</th>
            <th>Amount of Remittance</th>
            <th>Remittance Bank</th>
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
            <td><?php echo @$result['OverseasSales']['sales_country'] ;?></td>
            <td><?php echo @$result['OverseasSales']['customer_name'] ;?></td>
            <td><?php echo @$result['OverseasSales']['sales_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['sales_price_dlr'] ; ?></td>
            <td><?php echo @$result['OverseasSales']['sales_price_yen']?></td>
            <td><?php echo @$result['OverseasSales']['unit'] ;?></td>
            <td><?php echo @$result['OverseasSales']['invoice_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['invoice_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['bill_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['bill_no_uk'] ;?></td>
            <td><?php echo @$result['OverseasSales']['rate_acc_receivable'] ;?></td>
            <td><?php echo @$result['OverseasSales']['rate_advance'] ;?></td>
            <td><?php echo @$result['OverseasSales']['slip_issue_date'] ;?></td>
            <td><?php echo @$result['OverseasSales']['remark'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_sale_country'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_cust_name'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_sales_date'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_price_dlr'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_price_yen'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_invoice_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_invoice_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_bill_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_bill_no_uk'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_rate_receivable'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_rate_advance'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_slip_date'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cancel_remark'] ;?></td>
            <td><?php echo @$result['OverseasSales']['acc_change_sales_country'] ;?></td>
            <td><?php echo @$result['OverseasSales']['acc_change_cust_name'] ;?></td>
            <td><?php echo @$result['OverseasSales']['acc_change_sales_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['acc_change_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['acc_change_content'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_price_dlr'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_price_yen'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_invoice_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_invoice_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_bill_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_bill_uk'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_rate_receivable'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_rate_advance'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_slip_date'] ;?></td>
            <td><?php echo @$result['OverseasSales']['change_remark'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_saales_cntry'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_customer_name'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_sales_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_content'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_invoice_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_invoice_day'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_bill_no'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_bill_uk'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_receivable'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_advance'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_slip'] ;?></td>
            <td><?php echo @$result['OverseasSales']['cust_change_remark'] ;?></td>
            <td><?php echo @$result['OverseasSales']['remittance_names'] ;?></td>
            <td><?php echo @$result['OverseasSales']['amount_remittance'] ;?></td>
            <td><?php echo @$result['OverseasSales']['remittance_bank'] ;?></td>
            <td><?php echo @$result['OverseasSales']['final_last_remark'] ;?></td>
        </tr>
        <?php $c++;} ?>
    </tbody>
</table>