<?php

	class Sale extends AppModel {
		
		var $belongsTo = array(
        'Car' => array('className' => 'Car','foreignKey' => 'car_id')
 
    );
	
}
?>
