<?php
App::uses('AppModel', 'Model');
class CarImage extends AppModel {
////////////////////////////////////////////////
	public $hasmany = array('Car'=> array(
                'className' => 'Car',
                'foreignKey' => 'car_id'));

}
