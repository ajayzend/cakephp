<?php
class DeletedInvoice extends AppModel {
	public $hasMany=array('DeletedInvoiceDetail');
	
	/*public $hasMany=array('InvoiceDetail'=>array('className'=>'InvoiceDetail',
                                 'foreignKey'=>'invoice_id',
                                 'dependent'=>true, // true without single quote
                                 'exclusive'=>true
                                )
                );*/
	public $belongsTo = array('Bank','User');

}
?>
