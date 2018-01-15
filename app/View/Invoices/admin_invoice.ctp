<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>View Invoice</title>
<body style="font-family:'Myriad Pro'; font-size:14px;">
<div style="width:1000px;background:#FFFFFF; margin:0 auto;">

<div style="float:left; width:50%;"><img src="http://ukcarstokyo.com/images/w-logo_3.png" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'"></div>

<div style="float:left; width:50%; margin-top:20px; text-align:right">
	<b style="font-size:24px;"><?=ucwords($address['InvoiceAddress']['line_1'])?></b><br>
	<?=$address['InvoiceAddress']['line_2']?> <?=$address['InvoiceAddress']['line_3']?><br>
	<?=$address['InvoiceAddress']['line_4']?><br>
	<?=$address['InvoiceAddress']['line_5']?><br>
    <?=$address['InvoiceAddress']['line_6']?>
</div>

<div style="clear:both"></div>

<div style="text-align:center; background:#5bb448; padding:10px 0px; font-size:40px; color:#FFF; margin:20px 0px;">INVOICE</div>


<div style="width:460px; font-weight:bold; height:100px; background:#f5f7ec; float:left; padding:15px 10px">
	<div style="color:#000; font-size:20px;">INVOICE TO:</div>
	<div style="color:#322e2d; font-size:18px; letter-spacing:1px; line-height:30px; margin-top:10px;">
	<span style="text-transform:uppercase">
        Client Name : <?=strtoupper($InvoiceDetail[0]['InvoiceDetail'][0]['User']['first_name'])." ".strtoupper($InvoiceDetail[0]['InvoiceDetail'][0]['User']['last_name'])?><br>
        Customer Code : <?=$InvoiceDetail[0]['InvoiceDetail'][0]['User']['uniqueid']?>
    </div>
</div>

<div style="width:460px; font-weight:bold; height:100px; background:#a0a0a0; float:right; padding:15px 10px; letter-spacing:1px; line-height:30px;">
	<div style="color:#FFF; font-size:18px;">INVOICE NO. :</div>
	<div style="color:#000; font-size:18px;"><?=$InvoiceDetail[0]['Invoice']['invoice_no']?></div>
	<div style="color:#FFF; font-size:18px;">DATE : <?=date('d-m-Y',strtotime($InvoiceDetail[0]['Invoice']['created']))?></div>
	<div style="clear:both"></div>
</div>
<div style="clear:both"></div>

<div style="background:#5bb448; height:5px; margin:15px 0px;"></div>
   
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr height="50px">
	<th style="font-size:20px; color:#2d2d2d">Sr. No.</th>
	<th style="font-size:20px; color:#2d2d2d">Car Name</th>
	<th style="font-size:20px; color:#2d2d2d">Chassis No.</th>
    <th style="font-size:20px; color:#2d2d2d">Year/Month</th>
    <th style="font-size:20px; color:#2d2d2d">Stock Id</th>
	<th style="font-size:20px; color:#2d2d2d">PRICE</th>
</tr>

<?php
$srn = 0;
$GT = 0;
foreach($InvoiceDetail[0]['InvoiceDetail'] as $InvoVal)
{
	$srn++;
	$GT+= $InvoVal['Car']['CarPayment']['sale_price'];
?>
<tr height="50px" <?php if($srn%2 == 0) { ?> style="background:#f5f7ec" <?php } ?>>
	<td align="center" style="font-size:20px; color:#2d2d2d"><?=$srn?></td>
	<td align="center" style="font-size:20px; color:#2d2d2d"><?=strtoupper($InvoVal['Car']['CarName']['car_name'])?></td>
	<td align="center" style="font-size:20px; color:#2d2d2d"><?=strtoupper($InvoVal['Car']['cnumber'])?></td>
    <td align="center" style="font-size:20px; color:#2d2d2d"><?=strtoupper($InvoVal['Car']['manufacture_year'])?></td>
    <td align="center" style="font-size:20px; color:#2d2d2d"><?=strtoupper($InvoVal['Car']['stock'])?></td>
	<td align="center" style="font-size:20px; color:#2d2d2d"><?=$InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price']?></td>
</tr>
<tr><td colspan="6"><hr></td></tr>
<tr>
	<td colspan="6" style="font-size:16px; color:#2d2d2d"><?php if($InvoVal['Car']['engine_number'] != "") { ?> <b>Engine-No :</b> <?=$InvoVal['Car']['engine_number']?> ; <?php } ?>
    <b>Kilo-Meter :</b> <?=$InvoVal['Car']['mileage']?> ;
    <b>CC :</b> <?=$InvoVal['Car']['cc']?> ;
    <b>Handle :</b> <?=$InvoVal['Car']['handle']?> ;
    <b>Brand :</b> <?=$InvoVal['Car']['Brand']['brand_name']?> ;
    <b>Package :</b> <?=$InvoVal['Car']['package']?>
    </td>
</tr>
<?php
}
?>
</table>


<div style="background:#5bb448; height:5px; margin:25px 0px;"></div>

<div style="width:500px; float:left; line-height:25px; letter-spacing:1px; font-size:16px; color:#2d2d2d;">
    BANK NAME - <?=strtoupper($InvoiceDetail[0]['Bank']['bank_name'])?> <br>
    BRANCH NAME - <?=strtoupper($InvoiceDetail[0]['Bank']['branch_name'])?> <br>
    SWIFT NAME - <?=strtoupper($InvoiceDetail[0]['Bank']['swift_name'])?> <br>
    A/C NO - <?=$InvoiceDetail[0]['Bank']['account_no']?> <br>
    A/C NAME - <?=strtoupper($InvoiceDetail[0]['Bank']['account_name'])?>
    <br>
            
	<?php
    $bank_desc =$InvoiceDetail[0]['Bank']['discription'];				
    $words = explode(" ", $bank_desc);
    $firstpart = join(" ", array_slice($words, 0,3));
    $restpart = join(" ", array_slice($words, 3));
    ?>
    DESCRIPTION - <?=$firstpart?> <?=$restpart?>
    
</div>
<div style="float:right">
	<div style="float:left; color:#2d2d2d; margin-right:20px; margin-top:10px; font-weight:bold; font-size:25px;">GRAND TOTAL</div>
    <div style="background:#a0a0a0; float:right; width:180px; padding:10px 10px; text-align:right; font-size:20px; font-weight:bold;"><?=$InvoVal['Car']['CarPayment']['currency']." ".$GT?></div>
</div>

</div>
<div style="clear:both">&nbsp;</div>
</body></html>