<?php
class Transport extends AppModel {
	
	function transferValidate() {
		$validate1 = array(
				'transport_name'=> array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please enter Transport name!'
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
 
