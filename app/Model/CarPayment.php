<?php

	class CarPayment extends AppModel {
	public $belongsTo = array('Car','User','Auction'
        //'Logistic' => array('className' => 'Logistic','primaryKey' => 'car_id'),
        //'User' => array('className' => 'User','foreignKey' => 'user_id'),
    );
	
}
?>
