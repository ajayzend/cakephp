<?php
class Brand extends AppModel {
	function brandValidation(){
		$validate1 = array(
				'brand_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Brand Name!'
						),
						'ruleName2' => array(
							'rule' => 'isUnique',
							'message'=> 'Already exist!'
						)
					),
					
			  'brand_image' => array(
				//'rule'    => 'notEmpty',
				//'message' => 'Please Upload the Image!'
				'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Upload the Image!'
						)
			)
				
			);
		$this->validate=$validate1;
		return $this->validates();
	}
}




