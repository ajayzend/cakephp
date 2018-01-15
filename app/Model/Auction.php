<?php
class Auction extends AppModel {
	//public $hasMany  = array('Venue');
	 public $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'Country_id'
        )
        
    );
	

	
	
	 /*   validation for cars input fields    */
  function auctValidate(){
		$validate1 = array(
				'country_id' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Country Name!'
						)
						),
				'auction_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter auction name'
						)
						),
					'auction_place' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter auction place'
						)
						),
					'fees' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter  fee'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value for fee !'
						)
					)
			);
		$this->validate=$validate1;

		return $this->validates();
	}
}
?>

