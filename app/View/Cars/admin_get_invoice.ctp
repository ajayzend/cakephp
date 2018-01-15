<?//php pr($InvoiceName);
$arrData=array();

foreach($InvoiceName as $val){
	$userid=$val['CarPayment']['user_id'];
	$pdate=$val['Car']['pdate'];
	$carid=$val['Car']['id'];
	
	
	}

?>
 
<?php echo $this->Html->link('Create Invoice', array('controller' => 'Invoices', 'action' => 'add','user_id' => $userid,'date'=>$pdate,'car_id' =>$carid),array('class'=>'btn btn-success','id'=>'createInvoiceId'));?>
				        
