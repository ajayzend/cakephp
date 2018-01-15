<?php
class CarName extends AppModel {

	public $belongsTo=array('Brand');
	
	function carValidation(){
		$validate1 = array(
				'car_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Car Name!'
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


