<?php
class Shipschedule extends AppModel {
	
	function Validation(){
		$validate1 = array(  
				'ship_name' => array( 
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Shipping Name!'
						)
					),
				/*'ship_no' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Shipping Number!'
						),
					'mustUnique'=>array(
							'rule' =>'isUnique',
							'message' =>'This Shipping Number is already exist'
						),
					'number' => array(
							'rule'    =>'numeric',
							'message' => 'Please enter a number'
						)
					),*/
				'region' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Region!'
						)
					),
					'departure_port' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Departure Port!'
						)
					),
					'departure_date' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Departure Date!'
						)
					),
					'arrival_port' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Arrival Port!'
						)
					),
					'arrival_date' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Arrival Date!'
						)
					),
					/*'via_location' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Via Location!'
						)
					),*/
					'remark' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Remark!'
						)
					)	,
					'chasis' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Chasis Number!'
						)
					)		
			);
		$this->validate=$validate1;
		return $this->validates();
	} 
	
}
?>
