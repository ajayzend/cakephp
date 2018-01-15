<?php
class ClientPaymentHistory extends AppModel {

/**
	 * model validation array
	 *
	 * @var array
	 */
	function PaymentValidate() {
		$validate = array(
		
					'client_name'=> array(
						'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please select client name')
					),
					/*'date' => array(
						'date' => array(
							//Add 'ymd' to the rule.
							'rule' => array('date', 'ymd'),
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Please select a date.'
						)
					),
					'Amount'=> array(
						'Numeric' => array(
							'rule' => 'numeric',
							'message' => 'Please enter your Amount.'
						),
						'Not empty' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter your Amount.'
						),
					)*/
					
				
			);
		$this->validate=$validate;
		return $this->validates();
	}	
}
?>
 
