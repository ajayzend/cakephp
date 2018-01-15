<?php
class Car extends AppModel {
	
	public $hasOne  = array(
		'CarPayment' => array('className' => 'CarPayment'),
		'Logistic' => array('className' => 'Logistic') ,
	);
	public $belongsTo=array('CarName','Country','Brand','CarType');
	
	
	public $hasMany = array(
        'CarImage' => array(
            'className' => 'CarImage',
            'order'=>'CarImage.image_name ASC'),
	    'Bid' => array(
						'className' => 'Bid')
    );
    
  /*   validation for cars input fields    */
  function carValidate() {
		$validate1 = array(
		
		'vehicle_type_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose Vehicle Type')
					),
		'purchase_country_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Purchase Country')
					),				
		'country_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Country')
					),
		/*'engine_number'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter  Engine Number'),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This Engine Number is already exist'
						)
					),*/	
		'brand_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Brand name')
					),
				
		  'car_name_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Vehicle name')
					),
		 'cnumber'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Chassis Number'),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This Chassis Number is already exist'
						)
					),
				'lot_number'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter lot number')
		
		 ),
		 'transmission'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Transmission')
					),
		'handle'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose Handle')
					),
		'fuel'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose 	Fuel')
					),
		'pdate'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Purchase Date')
					),
		'cc' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter CC'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value of CC!'
						)
					),
		'mileage' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Mileage'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value of Mileage!'
						)
					),
		
		/*'manufacture_month'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Manufacturing Month')
					),*/
		'manufacture_year'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Manufacturing Year and month')
					),
		'package'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter package')
					),			
		'push_price'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Push Price')
					),
		'auction_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose 	Auction')
					),
		'asking_price'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Calculate Price')
					),
		
		'yen'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Yen Price')
					),
		'net_push'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Net Push Price')
					),
		'rickshaw'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Rickshaw')
					),
		'freight'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Freight')
					),
		'sale_price'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter sale price')
		
		 ),
		 /*'yard_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter yard name')
		
		 ),*/
		'shiping_fee'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Shiping Fee')
					),
		'auction_fee'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Auction Fee')
					),
		'other'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter Others Value')
					),
		'user_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please choose the client ')
					),
		'sale_price' => array(
					'ruleName' => array(
							'rule' => 'notEmpty',
							'message'=> 'Please Enter Sale Price'
						),
						'ruleName2' => array(
							'rule' => 'numeric',
							'message'=> 'Please Enter numeric Value!'
						)
					),			
		/*'car_in'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Select  Date For Car In')
					),
					
		'yard_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Yard name!')
					),
					
		  'shipping_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose Shipping Company!')
					),
		
		 'car_out'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Select  Date For Car Out!')
					),
        'status'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Select  Status Of Car !')
					),
		'port_id'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Choose 	Port Name!')
					)*/
			);
		$this->validate=$validate1;
		return $this->validates();
	}  
	
	/*   generate unique id     */
	
     public function uniqueid($code)
     {
		 $car=new Car();
		 $UniqueNumber=$car->find('count', array('conditions'=>array('uniqueid'=>$code)));
		 if(!empty($UniqueNumber))
		 {
			  $txt=substr((rand()), 5, 7);
			  $code .='-'.$txt;
			  $this->uniqueid($code);
			  return $code;
		 }
		 else
		 {
			 return $code;
		 }
	 }
	 public function notDeleteUpdateOnlyDeletedStatus()
	 {
			
		/*
			$car_id = 53;
			$data=array();
			$this->CarPayment->primaryKey = 'car_id';
			$this->CarPayment->id = $car_id;
			$data['deleted'] = 0;
			
			$retSaleData = $this->CarPayment->save($data);
			if($retSaleData)
			{
				$CarData=array();
				$CarData['id']=$this->data['Car']['car_id'];
				$CarData['new_arrival']=0;
				$CarData['publish']=0;
				$this->Car->save($CarData);
				echo json_encode(array('status'=>'success','data'=>$retSaleData,"message"=>"Successfully updated"));
			}
		 */
	 }
				
}
?>
