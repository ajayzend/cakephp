<?php
class Home extends AppModel {
	
    var $useTable = false;
  /*   validation for cars input fields    */
  function homeValidate() {
		$validate1 = array(
		
		/*'stock'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Stock Number')
					),
				
		  'name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter name')
					),*/
		 'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Email')
					),

		 'contact'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Contact Number')
					),
		/*'make'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Make')
					),
		'model'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Model')
					),
		'part'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter part')
					),
		'year'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose year')
					),
		'country' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose country')
					),
		'comment' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter comment')
					),*/
		
			);
		$this->validate=$validate1;
		return $this->validates();
	}  
	
	function getMailDetailsByUser($userId,$carId)
	{
		$user= ClassRegistry::init('User');
		$id = '';
		foreach ($carId as $dId)
		{	
			$id .=$dId.","; 
		}
		 $car_id= rtrim($id,',');
		
		$result = $user->query('SELECT Car.user_doc_status,Car.uniqueid,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price, CarPayment.updated_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock, Logistic.status,Logistic.remark, Shipping.company_name FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id 
		WHERE CarPayment.user_id ='.$userId.' AND  CarPayment.car_id  IN ('.$car_id.') AND  CarPayment.deleted = 0');
		return $result;
	}
	
	function getMailData()
	{
		
	}

	function removePushPrice($uniqueId)
    {
    	
      $r = explode('-',$uniqueId);
      unset($r[1]);
     return $re = implode("-",$r);
    }
}
?>
