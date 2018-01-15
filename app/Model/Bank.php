<?php
class Bank extends AppModel {	 
	
	function bankValidation(){
		$validate1 = array(
				'bank_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Bank Name!'
						)
						/*'ruleName2' => array(
							'rule' => 'isUnique',
							'message'=> 'Already exist!'
						)*/
					),
				
				'branch_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Branch Name!'
						),
					),
				'swift_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Swift Name!'
						),
					),
				'account_no' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Account no.!'
						),
					),
				'account_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Account Name!'
						),
					),
				'discription' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Discription About Bank!'
						),
					)			

				
			);
		$this->validate=$validate1;
		return $this->validates();
	}	 
}
?>
