<?php
class Country extends AppModel {
	public $belongsTo = array(
        'Car' => array(
            'className' => 'Car',
            'foreignKey' => 'car_id'
        )
    );
 // public $hasMany  = array('Auction');
  function countryValidation(){
		$validate1 = array(
				'country_name' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Country Name!'
						),
						'ruleName2' => array(
							'rule' => 'isUnique',
							'message'=> 'Country Name Already exist!'
						)
					),
				'rickshaw' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter rickshaw fee'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value!'
						)
					),
					'freight' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter freight fee'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value!'
						)
					),
					'shipping' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter shipping fee'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value!'
						)
					),
					'others' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Others fee!'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value!'
						)
					),
				'order' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Order!'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value For Order!'
						)
					),
				'country_image' => array(
                   'rule'    => 'notEmpty',
                    'message' => 'Please upload the Image!'
                  )
			); 
		$this->validate=$validate1;
		//pr($this->validate); die;
		return $this->validates();
	}

}

