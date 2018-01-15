<?php
class Shipping extends AppModel {
	
	function shippingValidation(){
		$validate1 = array(
				'company_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Company Name!'
						),
						'ruleName2' => array(
							'rule' => 'isUnique',
							'message'=> 'Already exist!'
						)
					)
				
			);
		$this->validate=$validate1;
		return $this->validates();
	} 
	
}
?>
