<?php
class Staff extends AppModel {	 
	function RegisterValidate() {
		$validate1 = array(
				'staff_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter name')
					),
				'staff_username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Enter Firstname!'),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This username is already exist'
					),
				'staff_password'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter password',
						'on' => 'create',
						'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 6),
						'message'=> 'Password must be greater than 5 characters',
						'on' => 'create',
						'last'=>true),
					),
					
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}	
	
}
?>
