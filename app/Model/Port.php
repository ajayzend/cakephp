<?php
class Port extends AppModel {	 
	var $belongsTo = array('Country','Auction','Transport');
	
	function portValidation(){
		$validate1 = array(
				'port_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Port Name!'
						)
						/*'ruleName2' => array(
							'rule' => 'isUnique',
							'message'=> 'Already exist!'
						)*/
					),
				
				'country_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Country Name!'
						),
					),
				'auction' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Auction Name!'
						),
					),
				'transport_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Transport Name!'
						),
					),
				'rickshaw' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Rickshaw Value!'
						),
					)
					
				
			);
		$this->validate=$validate1;
		return $this->validates();
	}
}
?>
