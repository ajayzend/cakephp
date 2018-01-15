<?php

	class Logistic extends AppModel {
		/*var $belongsTo = array(
        'Car' => array('className' => 'Car','foreignKey' => 'car_id'),
    );*/
	public $belongsTo = array('Car','Port','Transport','Shipping');
	/*   validation for cars input fields    */
  function carValidate() {
		$validate1 = array(
		
		/*'car_in'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Select  Date For Cai In')
					),
					
		'yard_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Yard name!')
					),
					
		  'shipping_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Shipping Company!')
					),
			 'transport_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Transport Company!')
					),		
		
		/* 'car_out'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Select  Date For Cai Out!')
					),
		'status'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose Handle!')
					),
		'port_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose 	Port Name!')
					)*/
		
			);
		$this->validate=$validate1;
		return $this->validates();
	}
}
?>
