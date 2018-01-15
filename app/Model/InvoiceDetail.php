<?php
class InvoiceDetail extends AppModel {
var $belongsTo = array('Car','User');

//var $belongsTo = array('Invoice'=>array('className'=>'Invoice',
                                     //'foreignKey'=>'invoice_id'
                           //  )
               // );	
	
}
?>
