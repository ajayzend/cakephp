<?php
class Bid extends AppModel {	  
	public $belongsTo = array('Car','User');
	
	
	/*   validation for cars input fields    */
  function bidValidate() {
		$validate1 = array(
		
		'name' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter name')
					),
		'cnumber' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Contact number')
					),
		'email' => array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email',
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true)	
					),
		'amount' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter amount'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value of amount !'
						)
					),
			);
		$this->validate=$validate1;
		return $this->validates();
	} 
}
