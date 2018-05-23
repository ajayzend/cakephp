<?php
App::uses('AppController', 'Controller');
include('ChromePHP.php');
require_once ROOT.'/app/webroot/phpmailer2/class.phpmailer.php'; //Not required with Composer
class HomeController extends AppController
{
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User', 'Home', 'UserGroup', 'LoginToken', 'Shipschedule', 'Car', 'Country', 'CarImage', 'HomePageSlide', 'Brand', 'Paginate', 'Paginator', 'ClientPaymentHistory', 'CarPayment', 'CarType', 'Logistic', 'CarName', 'Bid', 'About', 'Cif');

	public $components = array('UserAuth', 'ControllerList', 'Email', 'Paginator', 'Session', 'RequestHandler');
	public $helpers = array('Common', 'Paginator', 'Form', 'Round', 'Js');
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	//public function beforeFilter() {
	//$this->layout='default_a';
	//}

	public function index()
	{
		ChromePhp::log('Hello console!');
		$this->HomePageSlide->bindModel(array('belongsTo' => array('Car' => array('foreignKey' => 'car_id'))));
		$homePages_slides = $this->HomePageSlide->find('all', array('fields' => array('image_source'), 'conditions' => array('HomePageSlide.status' => 1), 'recursive' => 2, 'order' => 'HomePageSlide.order ASC'));
		$this->set('homePages_slides', $homePages_slides);

		/*$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo'=>array('Country'=>array('fields'=>''))));
		$fields = array('Country.id','Country.country_name','Country.country_image','COUNT(Car.id) as Total','Car.id','Car.purchase_country_id','Car.car_type_id');
		$group = array('Car.country_id');
		$carDetail = $this->Car->find('all', array('fields'=>$fields, 'group' => $group,'order'=>array('Country.order' => 'ASC'),'conditions'=>array('AND'=>array('Country.status'=> 0,'Car.publish'=>1))));
		$this->set('carDetail',$carDetail);	*/

		$Brand = $this->Brand->find('list', array('fields' => array('id', 'brand_name'), 'order' => array('priority' => 'ASC')));
		$this->set('Brand', $Brand);

		/*$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo'=>array('Brand'=>array('fields'=>array('')))));
		$fields = array('COUNT(Car.brand_id) as TotalCar','Brand.id','Brand.brand_name','Brand.brand_image','Car.car_type_id' );
		$topNewArrivals = $this->Car->find('all',array('fields'=>$fields,'conditions'=>array('Car.new_arrival'=> 1,'Car.publish'=>1),'order'=>array('Brand.priority' => 'ASC'),'group'=> array('Brand.id')));
		$this->set('topNewArrivals',$topNewArrivals);*/


		$this->Car->unbindModelAll();
		$caryear = $this->Car->find('all', array('fields' => array('SUBSTR(Car.manufacture_year, 3 ) AS Year'), 'conditions' => array('AND' => array('Car.publish' => 1)), 'group' => array('Year'), 'order' => array('Year DESC')));
		foreach ($caryear as $cy) {
			$option[trim($cy['0']['Year'])] = $cy['0']['Year'];
		}
		$this->set('option_year', $option);


		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.groupid' => $this->getGuestPermissionAccess());
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.groupid' => $this->getSellUserPermissionAccess());
		else
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 0);
		$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
		$group = array('Car.brand_id');
		$order = array('Brand.priority');
		$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));
		$this->set('CBrand', $CBrand);

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.isrecent' => 0, 'Car.groupid' => $this->getGuestPermissionAccess());
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.isrecent' => 0, 'Car.groupid' => $this->getSellUserPermissionAccess());
		else
			$condition = array('Car.publish' => 1, 'Car.isrecent' => 0);
		$showAllCar = $this->Car->find('all', array('conditions' => $condition, 'recursive' => 2, 'limit' => 12, 'order' => array('Car.id' => "DESC")));
		$this->set('showAllCar', $showAllCar);


		/* Count Car in Body Types */

		$this->Car->unbindModelAll();
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getGuestPermissionAccess());
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getSellUserPermissionAccess());
		else
			$condition = array('Car.publish' => 1);
		$fields = array('COUNT(Car.vehicle_type_id) as TotalCar', 'vehicle_type_id');
		$group = array('Car.vehicle_type_id');
		$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'conditions' => $condition));

		$BdyType = array();
		foreach ($CBrand as $Bdt) {
			$BdyType[$Bdt['Car']['vehicle_type_id']] = $Bdt['0']['TotalCar'];
		}
		$this->set('BodyTypes', $BdyType);

	}


	public function gatBrandDetail()
	{

		$this->Car->unbindModelAll();

		$this->Car->bindModel(array('belongsTo' => array('Brand' => array('order' => array('Brand.priority ASC')))));
		if($this->getGuestPermission())
			$condition = array('Car.country_id' => $this->data['countryId'], 'Car.car_type_id' => 1, 'Car.publish' => 1, 'Car.new_arrival != ' => 1, 'Car.groupid' => $this->getGuestPermissionAccess());
		else if($this->getGroupID() == 5)
			$condition = array('Car.country_id' => $this->data['countryId'], 'Car.car_type_id' => 1, 'Car.publish' => 1, 'Car.new_arrival != ' => 1, 'Car.groupid' => $this->getSellUserPermissionAccess());
		else
			$condition = array('Car.country_id' => $this->data['countryId'], 'Car.car_type_id' => 1, 'Car.publish' => 1, 'Car.new_arrival != ' => 1);


		$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
		$group = array('Car.brand_id');

		$brandDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'conditions' => $condition, 'recursive' => 2));


		//$brandDetail = $this->Car->find('all' , array('fields'=>array('DISTINCT brand_id'), 'conditions'=>array('Car.country_id'=> $this->data['countryId']),'recursive'=>2));

		echo json_encode(array("country_id" => $this->data['countryId'], "brands" => $brandDetail));
		die;
	}

	public function allBrand()
	{


		## start show total count data

		$brandData = $this->Car->find('all', array('fields' => array('Car.brand_id', 'Car.id'), 'conditions' => array('Car.country_id' => @$this->passedArgs['country']), 'group' => array('Car.brand_id'), 'order' => array('Brand.priority ASC')));
		$this->set('brandCount', count($brandData));

		if($this->getGuestPermission())
			$condition = array('Car.country_id' => @$this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.groupid' => $this->getGuestPermissionAccess());
		else if($this->getGroupID() == 5)
			$condition = array('Car.country_id' => @$this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.groupid' => $this->getSellUserPermissionAccess());
		else
			$condition = array('Car.country_id' => @$this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0);

		$carRelatedtoCountry = $this->Car->find('all', array('conditions' => $condition));
		$this->set('carCount', count($carRelatedtoCountry));


		/* new code with cartype
         *
         * $carRelatedtoCountry = $this->Car->find('all',array('conditions'=>array('Car.country_id'=>@$this->passedArgs['country']),'group' => array('Car.car_name_id')));
        $this->set('carCount',count($carRelatedtoCountry));
         *
         *
         *
         *
        $brandData = $this->Car->find('all',array('fields'=>array('Car.brand_id','Car.id'),'conditions'=>array('Car.country_id'=>@$this->passedArgs['country'],'Car.car_type_id'=>1),'group' => array('Car.brand_id')));
        $this->set('brandCount',count($brandData));
        $carRelatedtoCountry = $this->Car->find('all',array('conditions'=>array('Car.country_id'=>@$this->passedArgs['country'],'Car.car_type_id'=>1),'group' => array('Car.car_name_id')));
        $this->set('carCount',count($carRelatedtoCountry));*/
		## end total count data

		if (!empty($this->passedArgs['vtype'])) {
			$carType = $this->passedArgs['vtype'];
			$type = $this->passedArgs['type'];
			$this->set('carType', $carType);
			$this->Car->unbindModelAll();

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_name,id'))));

			//$brandDetail = $this->Car->find('all' , array('fields'=>array('DISTINCT brand_id'), 'conditions'=>array('Car.vehicle_type_id'=> $carType,'Car.publish'=>1),'order' => array('Brand.brand_name' => 'ASC'),'recursive'=>2));


			$brandDetail = $this->Car->find('all', array('fields' => array('DISTINCT brand_id'), 'conditions' => array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1), 'order' => array('Brand.priority ASC'), 'recursive' => 2));

			$this->set('brandDetail', $brandDetail);

			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));

			$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id', 'Car.car_type_id', 'Car.vehicle_type_id'), 'conditions' => array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1), 'order' => array('CarName.car_name' => 'ASC'), 'recursive' => 2));

			$this->set('carNames', $carNames);

		} else {
			$countryId = @$this->passedArgs['country'];
			$brandId = @$this->passedArgs['brand'];
			$carType = @$this->passedArgs['type'];

			$this->Car->unbindModelAll();
			$brandName = $this->Brand->find('first', array('fields' => 'brand_name,id', 'conditions' => array('Brand.id' => $brandId), 'order' => array('Brand.priority ASC')));
			$countryName = $this->Country->find('first', array('fields' => 'country_name,id', 'conditions' => array('Country.id' => $countryId)));
			$this->set('brandName', $brandName);
			$this->set('countryName', $countryName);

			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_image,brand_name,id'))));

			if($this->getGuestPermission())
				$condition = array('Car.country_id' => $countryId, 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.car_type_id' => $carType, 'Car.groupid' => $this->getGuestPermissionAccess());
			else if($this->getGroupID() == 5)
				$condition = array('Car.country_id' => $countryId, 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.car_type_id' => $carType, 'Car.groupid' => $this->getSellUserPermissionAccess());
			else
				$condition = array('Car.country_id' => $countryId, 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.car_type_id' => $carType);


			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Car.car_type_id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority ASC');

			$brandDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));


			/*$brandDetail = $this->Car->find('all' , array('fields'=>array('DISTINCT brand_id','Car.car_type_id'), 'conditions'=>array('Car.country_id'=> $countryId,'Car.car_type_id'=>$carType,'Car.publish'=>1),'order'=>array('Brand.priority ASC'),'recursive'=>2));

			 =============old code without car type
			$brandDetail = $this->Car->find('all' , array('fields'=>array('DISTINCT brand_id'), 'conditions'=>array('Car.country_id'=> $countryId,'Car.car_type_id'=>1),'order' => array('Brand.brand_name' => 'ASC'),'recursive'=>2));*/

			if (isset($this->passedArgs['brand'])) {
				$this->set('brandDetail', $brandDetail);

			} else {
				throw new NotFoundException('Could not find any Vehicle');
			}
			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));

			$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id'), 'conditions' => array('Car.country_id' => $countryId, 'Car.brand_id' => $brandId, 'Car.car_type_id' => $carType, 'Car.publish' => 1), 'order' => array('CarName.car_name' => 'ASC'), 'recursive' => 2));
			$this->set('carNames', $carNames);
		}

	}


	//--------   function for new  truck stock=============================================================


	public function allTruckStock()
	{

		if (@$this->passedArgs['brand']) {


			$brandId = $this->passedArgs['brand'];
			$type = $this->passedArgs['type'];
			$carType = $this->passedArgs['vtype'];
			$this->set('carType', $carType);
			$this->set('type', $type);

			$brandData = $this->Car->find('all', array('fields' => array('Car.brand_id', 'Car.id'), 'conditions' => array('Car.vehicle_type_id' => $carType, 'Car.car_type_id' => $type), 'group' => array('Car.brand_id'), 'order' => array('Brand.truck_stock_priority DESC')));
			$this->set('brandCount', count($brandData));

			$carRelatedtoCountry = $this->Car->find('all', array('conditions' => array('Car.vehicle_type_id' => $carType, 'Car.car_type_id' => $type, 'Car.publish' => 1, 'Car.new_arrival' => 0)));
			$this->set('carCount', count($carRelatedtoCountry));

			$brandName = $this->Brand->find('first', array('fields' => 'brand_name,id', 'conditions' => array('Brand.id' => $brandId), 'order' => array('Brand.truck_stock_priority DESC')));
			$this->set('brandName', $brandName);


			$this->Car->unbindModelAll();

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_name,id'))));

			$condition = array('Car.vehicle_type_id' => $carType, 'Car.car_type_id' => $type, 'Car.publish' => 1, 'Car.new_arrival' => 0);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Car.vehicle_type_id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.truck_stock_priority DESC');

			$brandDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$this->set('brandDetail', $brandDetail);

			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));

			$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id', 'Car.car_type_id', 'Car.vehicle_type_id'), 'conditions' => array('Car.vehicle_type_id' => $carType, 'Car.car_type_id' => $type, 'Car.brand_id' => $brandId, 'Car.publish' => 1), 'order' => array('CarName.car_name' => 'ASC'), 'recursive' => 2));
			$this->set('carNames', $carNames);
		} else {
			$carType = $this->passedArgs['vtype'];
			$type = $this->passedArgs['type'];
			$this->set('carType', $carType);
			$this->set('type', $type);

			// added 'Car.publish'=>1,'Car.new_arrival'=> 0 for count in below query
			$brandData = $this->Car->find('count', array('fields' => array('Car.brand_id', 'Car.id'), 'conditions' => array('Car.vehicle_type_id' => $carType, 'Car.car_type_id' => $type, 'Car.publish' => 1, 'Car.new_arrival' => 0), 'group' => array('Car.brand_id'), 'order' => array('Brand.truck_stock_priority ASC')));

			$this->set('brandCount', $brandData);

			$carRelatedtoCountry = $this->Car->find('count', array('conditions' => array('Car.vehicle_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1, 'Car.new_arrival' => 0)));

			$this->set('carCount', $carRelatedtoCountry);

			$brandName = $this->Brand->find('all', array('fields' => 'brand_name,id', 'order' => array('Brand.truck_stock_priority DESC')));
			$this->set('brandName', $brandName);


			$this->Car->unbindModelAll();

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_name,id'))));


			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Car.vehicle_type_id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.truck_stock_priority DESC');


			$brcondition = array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1, 'Car.new_arrival' => 0);
			$brfields = array('Brand.id', 'Car.vehicle_type_id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');

			$brandName = $this->Car->find('first', array('fields' => $brfields, 'group' => $group, 'order' => $order, 'conditions' => $brcondition));

			$topBrandId = @$brandName['Brand']['id'];
			$this->set('brandName', $brandName);

			$condition = array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1, 'Car.new_arrival' => 0);


			$brandDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$this->set('brandDetail', $brandDetail);

			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));

			$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id', 'Car.car_type_id', 'Car.vehicle_type_id'), 'conditions' => array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1, 'Car.brand_id' => $topBrandId), 'order' => array('CarName.car_name' => 'ASC'), 'recursive' => 2));
			$this->set('carNames', $carNames);
		}


		/* hide old code
        if(@$this->passedArgs['brand'])
        {
                $brandId =  $this->passedArgs['brand'];
                $type = $this->passedArgs['type'];
                //$this->set('carType',$carType);

                $brandData = $this->Car->find('all',array('fields'=>array('Car.brand_id','Car.id'),'conditions'=>array('Car.car_type_id'=>$type),'group' => array('Car.brand_id'),'order'=>array('Brand.truck_stock_priority DESC')));
                $this->set('brandCount',count($brandData));

                $carRelatedtoCountry = $this->Car->find('all',array('conditions'=>array('Car.car_type_id'=>$type,'Car.publish'=>1,'Car.new_arrival'=> 0)));
                $this->set('carCount',count($carRelatedtoCountry));

                $brandName = $this->Brand->find('first',array('fields'=>'brand_name,id','conditions'=>array('Brand.id'=>$brandId),'order'=>array('Brand.truck_stock_priority DESC')));
                $this->set('brandName',$brandName);


                $this->Car->unbindModelAll();

                $this->Car->bindModel(array('belongsTo'=>array('Brand'=>array('fields'=>'brand_name,id'))));

                $condition = array('Car.car_type_id'=> $type,'Car.publish'=>1,'Car.new_arrival'=> 0);
                $fields = array('COUNT(Car.brand_id) as TotalCar','Brand.id','Car.vehicle_type_id','Brand.brand_name','Brand.brand_image','Car.car_type_id' );
                $group = array('Car.brand_id');
                $order = array('Brand.truck_stock_priority DESC');

                $brandDetail = $this->Car->find('all' , array('fields'=>$fields,'group'=>$group,'order'=>$order, 'conditions'=>$condition,'recursive'=>2));

                $this->set('brandDetail',$brandDetail);

                $this->Car->unbindModelAll();
                $this->Car->bindModel(array('belongsTo'=>array('CarName'=>array('fields'=>'car_name,id'))));

                $carNames = $this->Car->find('all' , array('fields'=>array('DISTINCT car_name_id','Car.car_type_id','Car.vehicle_type_id'), 'conditions'=>array('Car.car_type_id'=> $type,'Car.brand_id'=>$brandId,'Car.publish'=>1),'order' => array('CarName.car_name' => 'ASC'),'recursive'=>2));
                $this->set('carNames',$carNames);
        }
        else
        {
        $carType =  $this->passedArgs['vtype'];
        $type = $this->passedArgs['type'];
        $this->set('carType',$carType);

        $brandData = $this->Car->find('all',array('fields'=>array('Car.brand_id','Car.id'),'conditions'=>array('Car.car_type_id'=>$type),'group' => array('Car.brand_id'),'order'=>array('Brand.truck_stock_priority ASC')));
        $this->set('brandCount',count($brandData));

        $carRelatedtoCountry = $this->Car->find('all',array('conditions'=>array('Car.car_type_id'=>$type,'Car.publish'=>1,'Car.new_arrival'=> 0)));
        $this->set('carCount',count($carRelatedtoCountry));

        $brandName = $this->Brand->find('all',array('fields'=>'brand_name,id','order'=>array('Brand.truck_stock_priority DESC')));
        $this->set('brandName',$brandName);


        $this->Car->unbindModelAll();

        $this->Car->bindModel(array('belongsTo'=>array('Brand'=>array('fields'=>'brand_name,id'))));

        $condition = array('Car.car_type_id'=> $type,'Car.publish'=>1,'Car.new_arrival'=> 0);
        $fields = array('COUNT(Car.brand_id) as TotalCar','Brand.id','Car.vehicle_type_id','Brand.brand_name','Brand.brand_image','Car.car_type_id' );
        $group = array('Car.brand_id');
        $order = array('Brand.truck_stock_priority DESC');

        $brandDetail = $this->Car->find('all' , array('fields'=>$fields,'group'=>$group,'order'=>$order, 'conditions'=>$condition,'recursive'=>2));

        $this->set('brandDetail',$brandDetail);

        $this->Car->unbindModelAll();
        $this->Car->bindModel(array('belongsTo'=>array('CarName'=>array('fields'=>'car_name,id'))));

        $carNames = $this->Car->find('all' , array('fields'=>array('DISTINCT car_name_id','Car.car_type_id','Car.vehicle_type_id'), 'conditions'=>array('Car.car_type_id'=> $type,'Car.vehicle_type_id'=> $carType,'Car.publish'=>1),'order' => array('CarName.car_name' => 'ASC'),'recursive'=>2));
        $this->set('carNames',$carNames);
    }*/


	}


	//--------------------end  function for new truck  stock================================================


	public function getCarName()
	{
		$this->Car->unbindModelAll();

		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));
		$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id'), 'conditions' => array('Car.country_id' => $this->data['countryId'], 'Car.brand_id' => $this->data['brandId']), 'recursive' => 2));

		echo json_encode(array("country_id" => $this->data['countryId'], "brand_id" => $this->data['brandId'], "carNames" => $carNames));

		die;
	}


	public function getCarInfo()
	{

		//$sql ="SELECT cm.id as id, cm.car_name as car_name,count(c.id) as total FROM `car_names` cm left join cars c on cm.id=c.car_name_id where cm.brand_id=".$_REQUEST['id']." AND c.deleted=0 GROUP by c.car_name_id";
		if($this->getGuestPermission())
			$condition = " AND c.groupid IN(1, 4)";
		else if($this->getGroupID() == 5)
			$condition = " AND c.groupid IN(5)";
		else
			$condition = " ";


		$sql = "SELECT c.id,c.uniqueid,COUNT(c.id) as total,c.car_name_id,cm.car_name 
				FROM `cars` c left join car_names cm ON cm.id=c.car_name_id 
				WHERE c.brand_id=" . $_REQUEST['id'] . " AND c.publish=1 AND c.deleted=0 $condition
				GROUP BY c.car_name_id order by cm.car_name ASC ";
		//$carName = $this->CarName->find('list',array('fields'=>array('id','car_name'), 'conditions' => array("brand_id" => $_REQUEST['id'])));

		$carName = $this->Car->query($sql);

		$list = '';
		$arrays = array();

		$i = 0;
		foreach ($carName as $key => $title) {

			$arrays[$title['cm']['car_name']['0']][$i]['id'] = $title['c']['car_name_id'];
			$arrays[$title['cm']['car_name']['0']][$i]['car_name'] = $title['cm']['car_name'];
			$arrays[$title['cm']['car_name']['0']][$i]['total'] = $title[0]['total'];
			$i++;
		}


		foreach ($arrays as $key => $carn) {

			$list .= '<div class="alpha-sort">' . '<h5>' . $key . '</h5>' . '<ul class="sub-listing text-center">';
			//$list .='<h5>'.$key.'</h5>';
			foreach ($carn as $listi) {
				$list .= '<li><a onClick="gofilter(this)" rel="' . $listi['id'] . '"><p class="name">' . $listi['car_name'] . '</p><p class="name">(' . $listi['total'] . ')</p></a></li>';
			}

			$list .= '</ul></div>';
		}
		echo $list;

		die;
	}


	//public function showAllCar($cuntryId=null,$brandId=null,$carNameId=null){
	public function showAllCar()
	{
		$this->Car->unbindModelAll();
		$con = array();
		$this->Car->bindModel(array('belongsTo' => array('Country' => array('fields' => 'id,country_name'), 'CarName' => array('fields' => 'car_name,id'), 'Brand' => array('fields' => 'brand_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
		$showAllCar = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 0)));

		if (isset($this->passedArgs['country']))
			@$countryId = $this->passedArgs['country'];

		if (isset($this->passedArgs['brand']))
			@$brandId = $this->passedArgs['brand'];
		if (isset($this->passedArgs['type']))
			@$typeId = $this->passedArgs['type'];

		if (isset($this->passedArgs['vtype']))
			@$VtypeId = $this->passedArgs['vtype'];

		if (isset($this->passedArgs['car_name'])) {

			$carNameId = $this->passedArgs['car_name'];

			$brandName = $this->Brand->find('first', array('fields' => 'Brand.brand_name,Brand.id', 'conditions' => array('Brand.id' => @$brandId)));
			$this->set('brandName', $brandName);

			$countryName = $this->Country->find('first', array('fields' => 'Country.country_name,Country.id', 'conditions' => array('Country.id' => @$countryId)));
			$this->set('countryName', $countryName);
			$this->Car->unbindModelAll();
			$this->CarPayment->unbindModelAll();
			//$this->Car->bindModel(array('hasMany'=>array('CarImage'=>array('fields'=>'car_id,image_source,image_name'))));
			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
			if (isset($countryId)) {
				$showAllCar = $this->Car->find('all', array('conditions' => array('Car.country_id' => @$countryId, 'Car.brand_id' => @$brandId, 'Car.car_name_id' => $carNameId, 'Car.publish' => 1, 'Car.new_arrival' => 0), 'recursive' => 2));
			} else {
				$showAllCar = $this->Car->find('all', array('conditions' => array('Car.car_type_id' => @$typeId, 'Car.vehicle_type_id' => @$VtypeId, 'Car.car_name_id' => $carNameId, 'Car.publish' => 1, 'Car.new_arrival' => 0), 'recursive' => 2));
			}

		}

		//pr($showAllCar);die;

		if ($this->request->is('post')) {

			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('Country' => array('fields' => 'id,country_name'), 'CarName' => array('fields' => 'car_name,id'), 'Brand' => array('fields' => 'brand_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));


			if ($this->data['Home']['yearFrom']) {
				//echo $this->data['Home']['yearFrom'];
				//echo $this->data['Home']['yearTo'];
				$con[] = array('Car.manufacture_year BETWEEN ? and ?' => array($this->data['Home']['yearFrom'], $this->data['Home']['yearTo']));

			}
			if ($this->data['Home']['cc']) {
				$data = explode(',', $this->data['Home']['cc']);
				//$con[] = array('Car.cc BETWEEN ? and ?' => array(0, $this->data['Home']['cc']));
				$con[] = array('Car.cc BETWEEN ? and ?' => array($data[0], $data[1]));

			}
			if ($this->data['Home']['model']) {
				$con[] = array('CarName.id' => $this->data['Home']['model']);

			}
			if ($this->data['Home']['brand_name']) {
				$con[] = array('Brand.id' => $this->data['Home']['brand_name']);

			}
			if ($this->data['Home']['country_name']) {
				$con[] = array('Country.id' => $this->data['Home']['country_name']);

			}
			if ($this->data['Home']['stock']) {
				$con = array('stock' => $this->data['Home']['stock']);

			}
			if (!empty($this->data)) {
				$showAllCar = $this->Car->find('all', array('conditions' => array('AND' => array($con), 'Car.publish' => 1, 'Car.new_arrival' => 0)));

				//$this->set('quickSearchDetail',$quickSearchDetail);
			}
		}
		//pr($showAllCar);die;
		if (isset($showAllCar))

			$this->set('showAllCar', $showAllCar);
		$this->set('countryId', @$con[0]['Country.id']);
		$this->set('brandId', @$con[0]['Brand.id']);
		$this->set('carNameId', @$con[0]['CarName.id']);
		$this->set('manufactureId', @$con[0]['Car.manufacture_year BETWEEN ? and ?']);
		$this->set('ccId', @$con[0]['Car.cc BETWEEN ? and ?']);


	}


	public function carDetails($carId = null)
	{
		$this->Car->unbindModelAll();
		$carId = base64_decode($carId);
		$carDetails = $this->Car->find('all', array('conditions' => array('Car.id' => $carId)));
		$this->set('carDetails', $carDetails);

	}

	public function arrivalDetails()
	{
		$this->autoRender = false;
		$this->Car->unbindModelAll();
		//$this->Car->bindModel('hasMany',array('CarImage'=>array('fields'=>'id,image_source')));

		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarImage' => array('fields' => 'image_source,id'))));

		$this->Car->bindModel(array('hasMany' => array('CarImage' => array('fields' => 'image_source,id'))));
		$arrivalDetails = $this->Car->find('all', array('conditions' => array('Car.new_arrival' => 1), 'order' => array('Car.id' => 'DESC')));
		//pr($arrivalDetails);
		echo json_encode($arrivalDetails);
	}


	public function getMakeBrand()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			echo $id = $this->data['id'];
			$this->Car->unbindModelAll();

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_name,id'))));
			$brandDetail = $this->Car->find('all', array('fields' => array('DISTINCT brand_id'), 'conditions' => array('Car.country_id' => $this->data['id']), 'recursive' => 2));

			$option = "";

			$array = array();
			if (!empty($brandDetail)) {
				foreach ($brandDetail as $key => $val) {
					if ($key == 0)
						echo "<option value=''>Any</option>";
					echo $option = "<option value=" . $val['Brand']['id'] . ">" . $val['Brand']['brand_name'] . "</option>";
				}
			} else {
				$Brand = $this->Brand->find('all');

				foreach ($Brand as $keyBrand => $valBrand) {
					//$arrBrand[$valBrand['Brand']['id']] = $valBrand['Brand']['brand_name'];
					if ($keyBrand == 0)
						echo "<option value=''>Any</option>";
					echo $option = "<option value=" . $arrBrand[$valBrand['Brand']['id']] . ">" . $valBrand['Brand']['brand_name'] . "</option>";
				}
			}
			die;
		}
	}

	public function getModelCar()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->Car->unbindModelAll();

			$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));
			$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id'), 'conditions' => array('Car.country_id' => $this->data['countryId'], 'Car.brand_id' => $this->data['id']), 'recursive' => 2));

			$option = "";

			$array = array();
			if (!empty($carNames)) {
				foreach ($carNames as $keyCarName => $valCarName) {
					if ($keyCarName == 0)
						echo "<option value=''>Any</option>";
					echo $option = "<option value=" . $valCarName['CarName']['id'] . ">" . $valCarName['CarName']['car_name'] . "</option>";
				}
			} else {
				$CarName = $this->CarName->find('all');

				foreach ($CarName as $keyCarName => $valCarName) {
					//$arrBrand[$valBrand['Brand']['id']] = $valBrand['Brand']['brand_name'];
					if ($keyCarName == 0)
						echo "<option value=''>Any</option>";
					echo $option = "<option value=" . $valCarName[$valCarName['CarName']['id']] . ">" . $valCarName['CarName']['car_name'] . "</option>";
				}
			}
			die;
		}
	}

	public function arrival_show()
	{

		$currdate = date('Y-m-d H:i:s');
		$brandData = $this->Brand->find('all', array('fields' => array('Brand.id', 'Brand.brand_name', 'Brand.brand_image')));

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,user_id'), 'CarImage' => array('fields' => 'image_source,id', 'order' => array('image_name' => 'ASC')))));
		if (isset($this->passedArgs['brand'])) {
			$this->set('brandId', $this->passedArgs['brand']);
			$showAllArrival = $this->Car->find('all', array('conditions' => array('Car.brand_id' => @$this->passedArgs['brand'], 'Car.new_arrival' => 1, 'Car.publish' => 1, 'Car.car_name_id' => $this->passedArgs['car_name'])));
		} else {
			$this->set('brandId', @$this->passedArgs['brand']);
			$showAllArrival = $this->Car->find('all', array('conditions' => array('AND' => array('Car.new_arrival' => 1, 'Car.publish' => 1))));
		}
		@$brandName = $this->Brand->find('first', array('fields' => 'brand_name,id', 'conditions' => array('Brand.id' => @$this->passedArgs['brand'])));
		$this->set('brandName', $brandName);
		$this->set('showAllArrival', $showAllArrival);
		$this->set('brandData', $brandData);

		$QuichSearchData = $this->Car->find('all', array('conditions' => array('Car.new_arrival' => 1, 'Car.publish' => 1)));

		$brandArr = array();
		$carNameArr = array();
		foreach ($QuichSearchData as $value) {
			$brandArr[$value['Brand']['id']] = $value['Brand']['brand_name'];
			$carNameArr[$value['CarName']['id']] = $value['CarName']['car_name'];
		}

		$this->set('brandArr', $brandArr);
		$this->set('carNameArr', $carNameArr);


		$con = array();
		if ($this->request->is('post')) {


			if (@$this->data['yearFrom'] && @$this->data['yearTo'] == '') {
				$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['yearFrom']);
			}
			if (@$this->data['yearFrom'] == '' && @$this->data['yearTo']) {
				$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['yearTo']);
			}

			if (@$this->data['yearFrom'] && @$this->data['yearTo']) {

				$con[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->data['yearFrom'], $this->data['yearTo']));

			}
			if (@$this->data['cc']) {
				$data = explode(',', $this->data['cc']);
				$con[] = array('Car.cc BETWEEN ? and ?' => array($data[0], $data[1]));

			}
			if (@$this->data['model']) {
				$con[] = array('CarName.id' => $this->data['model']);

			}
			if (@$this->data['brand_name']) {
				//$con[] = array('Brand.id' => $this->data['brand_id']);
				$con[] = array('Car.brand_id' => $this->data['brand_name']);

			}
			if (!empty($this->data)) {

				$this->Car->unbindModelAll();
				$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,user_id'), 'CarImage' => array('fields' => 'image_source,id', 'order' => array('image_name' => 'ASC')))));
				$showAllArrival = $this->Car->find('all', array('conditions' => array('AND' => array($con), 'Car.new_arrival' => 1, 'Car.publish' => 1)));
				$this->set('showAllArrival', $showAllArrival);

				//$this->render('all_car');
			}
		}
		$caryear = $this->Car->find('all', array('fields' => array('SUBSTR(Car.manufacture_year, 3 ) AS Year'), 'conditions' => array('AND' => array('Car.publish' => 1)), 'group' => array('Year'), 'order' => array('Year DESC')));
		foreach ($caryear as $cy) {

			//pr($cy['0']['Year']);
			$option[trim($cy['0']['Year'])] = $cy['0']['Year'];
		}
		$this->set('option_year', $option);


		/*if(isset($showAllArrival))

			$this->set('showAllArrival',$showAllArrival);
			$this->set('brandId',@$con[0]['Brand.id']);
			$this->set('carNameId',@$con[0]['CarName.id']);
			$this->set('manufactureId',@$con[0]['Car.manufacture_year BETWEEN ? and ?']);
			$this->set('ccId',@$con[0]['Car.cc BETWEEN ? and ?']);*/

	}

	public function addBid()
	{

		$this->autoRender = false;
		$result = $this->Bid->find('first', array('conditions' => array('Bid.car_id' => @$this->data['car_id'], 'Bid.currency_type' => @$this->data['Bid']['currency_type']), 'fields' => array('MAX(Bid.amount) AS Amount', 'currency_type')));

		$this->Car->unbindModel(array('hasMany' => array('CarImage', 'Bid', 'Logistic', 'Country'), 'belongsTo' => array('Brand', 'CarType'), 'hasOne' => array('Logistic', 'CarPayment')));
		$fields = array('Car.uniqueid', 'Car.cnumber', 'Car.id', 'CarName.car_name');
		$car_data = $this->Car->find('first', array('fields' => $fields, 'conditions' => array('Car.id' => $this->data['car_id'])));

		if ($result['Bid']['currency_type'] == '' && $result[0]['Amount'] == '') {
			$id = $this->Session->read('UserAuth.User.id');
			$allresult = $this->Bid->find('first', array('fields' => array('id'), 'conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.user_id' => $id, 'Bid.currency_type' => $result['Bid']['currency_type'])));

			$currDate = date('Y-m-d');
			if ($allresult) {
				$bidId = $allresult['Bid']['id'];
				$this->Bid->read(null, $bidId);
				//$this->request->data['Bid']['amount'] = $this->data['Bid']['amount'];
				$this->request->data['Bid']['date'] = $currDate;
				$this->Bid->set('active', $this->data);
				$save = $this->Bid->save($this->request->data);
				if ($save) {
					/*$this->Email->smtpOptions = array(
                     'port'=>'465',
                     'timeout'=>'30',
                     'host' => 'smtp.gmail.com',
                     'username'=> 'udaan958@gmail.com',
                     'password'=> 'sayeed@123',
                    );*/
					$this->Email->to = EMAIL_ACCOUNT;
					$this->Email->subject = 'Update old bid';
					$this->Email->from = EMAIL_ACCOUNT;
					$this->Email->sendAs = 'html';
					$mail_data = '<table celpadding="5" border="1">
											<tr> 
												<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['Bid']['amount'] . '</td>
											</tr>
											<tr> 
												<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
											</tr>
											<tr> 
												<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
											</tr>
											<tr> 
												<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
											</tr>
											<tr>
												<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
											</tr>
										</table>	
										';
					$this->Email->send($mail_data);
					return json_encode(array("status" => "success", "message" => "Data is successfully Updated!"));
				}
			} else {
				$this->request->data['Bid']['user_id'] = $id;
				//$this->request->data['Bid']['amount'] = $this->data['Bid']['amount'];
				$this->request->data['Bid']['date'] = $currDate;
				$this->request->data['Bid']['car_id'] = $this->data['car_id'];
				$save_add = $this->Bid->save($this->request->data);
				if ($save_add) {
					$this->Email->to = EMAIL_ACCOUNT;
					$this->Email->subject = 'Add new bid';
					$this->Email->from = EMAIL_ACCOUNT;
					$this->Email->sendAs = 'html';
					$mail_data = '<table celpadding="5" border="1">
											<tr> 
												<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['Bid']['amount'] . '</td>
											</tr>
											<tr> 
												<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
											</tr>
											<tr> 
												<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
											</tr>
											<tr> 
												<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
											</tr>
											<tr>
												<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
											</tr>
										</table>	
										';
					$this->Email->send($mail_data);
				}
				return json_encode(array("status" => "success", "message" => "Data is successfully added!"));
			}
			/*}
            else
            {
                if($this->data['Bid']['currency_type'] == '$')
                {
                    $curr = 'Doller';
                    $m ="";
                }else
                {
                    $curr = 'Yen';
                    $m = ',Please check mid bid of Yen.';
                }
                return json_encode(array("status"=>"success","message"=>"<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong>Bid Amount ".$curr." should be greater than min bid amount ".$m."  </strong></div>"));
            }*/
		} else {

			if (@$this->data['Bid']['currency_type'] == @$result['Bid']['currency_type']) {
				//if($this->data['min_amount'] <= $this->data['Bid']['amount'])
				if ($result['Bid']['currency_type'] == '$') {
					$com_amount = $result[0]['Amount'] + 300;
				} else {
					$com_amount = $result[0]['Amount'] + 30000;
				}
				if ($com_amount <= $this->data['Bid']['amount']) {


					$id = $this->Session->read('UserAuth.User.id');
					$allresult = $this->Bid->find('first', array('fields' => array('id'), 'conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.user_id' => $id, 'Bid.currency_type' => $result['Bid']['currency_type'])));
					$currDate = date('Y-m-d');
					if ($allresult) {
						$bidId = $allresult['Bid']['id'];
						$this->Bid->read(null, $bidId);
						//$this->request->data['Bid']['amount'] = $this->data['Bid']['amount'];
						$this->request->data['Bid']['date'] = $currDate;
						$this->Bid->set('active', $this->data);
						$save = $this->Bid->save($this->request->data);
						if ($save) {
							/*$this->Email->smtpOptions = array(
                             'port'=>'465',
                             'timeout'=>'30',
                             'host' => 'smtp.gmail.com',
                             'username'=> 'udaan958@gmail.com',
                             'password'=> 'sayeed@123',
                            );*/
							$this->Email->to = EMAIL_ACCOUNT;
							$this->Email->subject = 'Update old bid';
							$this->Email->from = EMAIL_ACCOUNT;
							$this->Email->sendAs = 'html';
							$mail_data = '<table celpadding="5" border="1">
											<tr> 
												<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['Bid']['amount'] . '</td>
											</tr>
											<tr> 
												<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
											</tr>
											<tr> 
												<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
											</tr>
											<tr> 
												<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
											</tr>
											<tr>
												<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
											</tr>
										</table>	
										';
							$this->Email->send($mail_data);
							return json_encode(array("status" => "success", "message" => "Data is successfully Updated!"));
						}
					} else {
						$this->request->data['Bid']['user_id'] = $id;
						//$this->request->data['Bid']['amount'] = $this->data['Bid']['amount'];
						$this->request->data['Bid']['date'] = $currDate;
						$this->request->data['Bid']['car_id'] = $this->data['car_id'];
						$this->Email->to = EMAIL_ACCOUNT;
						$this->Email->subject = 'Add new bid';
						$this->Email->from = EMAIL_ACCOUNT;
						$this->Email->sendAs = 'html';
						$mail_data = '<table celpadding="5" border="1">
											<tr> 
												<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['Bid']['amount'] . '</td>
											</tr>
											<tr> 
												<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
											</tr>
											<tr> 
												<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
											</tr>
											<tr> 
												<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
											</tr>
											<tr>
												<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
											</tr>
										</table>	
										';
						$this->Email->send($mail_data);
						$this->Bid->save($this->request->data);
						return json_encode(array("status" => "success", "message" => "Data is successfully added!"));
					}
				} else {
					if (@$this->data['Bid']['currency_type'] == '$') {
						$curr = 'Doller';
						$m = "";
					} else {
						$curr = 'Yen';
						$m = ',Please check mid bid of Yen.';
					}
					return json_encode(array("status" => "success", "message" => "Bid Amount " . $curr . " should be greater than min bid amount " . $m, 'amt' => $this->data['Bid']['amount']));
				}
			} else {
				return json_encode(array("status" => "error", "message" => "Error- Something went wrongx	"));
			}
		}


		die;


	}

	//For guest user details saved.

	public function guestBid()
	{
		$this->autoRender = false;
		if ($this->request->is('post')) {
			echo json_encode(array("status" => "Success", "message" => "Request for bid successfully added."));
		} else {
			echo json_encode(array("status" => "Error", "message" => "Request not added."));
		}
	}

	//   for return all truck details

	public function gatTruckDetail()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			/*$this->Car->bindModel(array('belongsTo'=>array('Brand'=>array('fields'=>array('')))));
            $condition = array('Car.car_type_id'=> 2);
            $fields = array('COUNT(Car.car_type_id) as totalTruck','Car.car_type_id','Car.vehicle_type','Car.country_id', 'Brand.id','Brand.brand_name','Brand.brand_image');
            $group = array('Car.brand_id');
            $truckDetail = $this->Car->find('all' , array('fields'=>$fields,'group'=>$group, 'conditions'=>$condition,'recursive'=>2));
            echo json_encode(array("brands"=>$truckDetail));*/

			echo json_encode(array("status" => "Success", "message" => "Success."));

		} else {
			echo json_encode(array("status" => "Error", "message" => "Request not found."));
		}
	}


	/*    Start function for get Heavy Machinary  */
	public function getHeavyMachinery()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->Car->unbindModelAll();
			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));

			$condition = array('Car.car_type_id' => 3, 'Car.publish' => 1);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id', 'Car.vehicle_type_id');
			$group = array('Car.brand_id');

			$brandDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'conditions' => $condition, 'recursive' => 2));

			//$brandDetail = $this->CarType->find('all',array('fields'=>array('CarType.type'),'conditions'=>array('CarType.p_id'=>3)));

			echo json_encode(array("brands" => $brandDetail));
			die;

		} else {
			echo json_encode(array("status" => "Error", "message" => "Request not found."));
		}
	}


	/*    Start function for get Heavy Machinary  */
	public function addBidAfterLogin()
	{

		$this->autoRender = false;
		$result = $this->Bid->find('first', array('conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.currency_type' => $this->data['Bid']['currency_type']), 'fields' => array('MAX(Bid.amount) AS Amount', 'currency_type')));

		$this->Car->unbindModel(array('hasMany' => array('CarImage', 'Bid', 'Logistic', 'Country'), 'belongsTo' => array('Brand', 'CarType'), 'hasOne' => array('Logistic', 'CarPayment')));
		$fields = array('Car.uniqueid', 'Car.cnumber', 'Car.id', 'CarName.car_name');
		$car_data = $this->Car->find('first', array('fields' => $fields, 'conditions' => array('Car.id' => $this->data['car_id'])));

		if ($result['Bid']['currency_type'] == '' && $result[0]['Amount'] == '') {
			/*if($result['Bid']['currency_type'] =='$')
            {
                $com_amount = $result[0]['Amount']+300;
            }else
            {
                $com_amount = $result[0]['Amount']+30000;
            }*/

			//if($this->data['min_amount'] <= $this->data['bidAmountL'])
			//if($com_amount <= $this->data['bidAmountL'])
			//{

			$id = $this->Session->read('UserAuth.User.id');
			$result = $this->Bid->find('first', array('fields' => array('id'), 'conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.user_id' => $id)));
			$currDate = date('Y-m-d');

			if ($result) {
				$bidId = $result['Bid']['id'];
				$this->Bid->read(null, $bidId);
				$this->request->data['Bid']['amount'] = $this->data['bidAmountL'];
				$this->request->data['Bid']['date'] = $currDate;
				$this->Bid->set('active', $this->data);

				$save = $this->Bid->save($this->request->data);
				if ($save) {
					/*$this->Email->smtpOptions = array(
                     'port'=>'465',
                     'timeout'=>'30',
                     'host' => 'smtp.gmail.com',
                     'username'=> 'udaan958@gmail.com',
                     'password'=> 'sayeed@123',
                    );*/
					$this->Email->to = EMAIL_ACCOUNT;
					$this->Email->subject = 'Update old bid';
					$this->Email->from = EMAIL_ACCOUNT;
					$this->Email->sendAs = 'html';
					$mail_data = '<table celpadding="5" border="1">
										<tr> 
											<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['bidAmountL'] . '</td>
										</tr>
										<tr> 
											<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
										</tr>
										<tr> 
											<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
										</tr>
										<tr> 
											<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
										</tr>
										<tr>
											<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
										</tr>
									</table>	
									';
					$this->Email->send($mail_data);
					return json_encode(array("status" => "success", "message" => "Data is successfully Updated!"));
				}
			} else {
				$this->request->data['Bid']['user_id'] = $id;
				$this->request->data['Bid']['amount'] = $this->data['bidAmountL'];
				$this->request->data['Bid']['date'] = $currDate;
				$this->request->data['Bid']['car_id'] = $this->data['car_id'];
				$save_add = $this->Bid->save($this->request->data);
				if ($save_add) {
					$this->Email->to = EMAIL_ACCOUNT;
					$this->Email->subject = 'Add new bid';
					$this->Email->from = EMAIL_ACCOUNT;
					$this->Email->sendAs = 'html';
					$mail_data = '<table celpadding="5" border="1">
										<tr> 
											<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['bidAmountL'] . '</td>
										</tr>
										<tr> 
											<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
										</tr>
										<tr> 
											<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
										</tr>
										<tr> 
											<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
										</tr>
										<tr>
											<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
										</tr>
									</table>	
									';
					$this->Email->send($mail_data);
				}
				return json_encode(array("status" => "success", "message" => "Data is successfully added!"));
			}
			/*}
            else
            {
                if($this->data['Bid']['currency_type'] == '$')
                {
                    $curr = 'Doller';
                    $m ="";
                }else
                {
                    $curr = 'Yen';
                    $m = ',Please check mid bid of Yen.';
                }
                return json_encode(array("status"=>"success","message"=>"<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong>Bid Amount ".$curr." should be greater than min bid amount ".$m."  </strong></div>"));
            }*/
		} else {
			if ($this->data['Bid']['currency_type'] == $result['Bid']['currency_type']) {
				if ($result['Bid']['currency_type'] == '$') {
					$com_amount = $result[0]['Amount'] + 300;
				} else {
					$com_amount = $result[0]['Amount'] + 30000;
				}

				//if($this->data['min_amount'] <= $this->data['bidAmountL'])
				if ($com_amount <= $this->data['bidAmountL']) {

					$id = $this->Session->read('UserAuth.User.id');
					$result = $this->Bid->find('first', array('fields' => array('id'), 'conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.user_id' => $id)));
					$currDate = date('Y-m-d');

					if ($result) {
						$bidId = $result['Bid']['id'];
						$this->Bid->read(null, $bidId);
						$this->request->data['Bid']['amount'] = $this->data['bidAmountL'];
						$this->request->data['Bid']['date'] = $currDate;
						$this->Bid->set('active', $this->data);

						$save = $this->Bid->save($this->request->data);
						if ($save) {
							/*$this->Email->smtpOptions = array(
                             'port'=>'465',
                             'timeout'=>'30',
                             'host' => 'smtp.gmail.com',
                             'username'=> 'udaan958@gmail.com',
                             'password'=> 'sayeed@123',
                            );*/
							$this->Email->to = EMAIL_ACCOUNT;
							$this->Email->subject = 'Update old bid';
							$this->Email->from = EMAIL_ACCOUNT;
							$this->Email->sendAs = 'html';
							$mail_data = '<table celpadding="5" border="1">
										<tr> 
											<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['bidAmountL'] . '</td>
										</tr>
										<tr> 
											<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
										</tr>
										<tr> 
											<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
										</tr>
										<tr> 
											<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
										</tr>
										<tr>
											<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
										</tr>
									</table>	
									';
							$this->Email->send($mail_data);
							return json_encode(array("status" => "success", "message" => "Data is successfully Updated!"));
						}
					} else {
						$this->request->data['Bid']['user_id'] = $id;
						$this->request->data['Bid']['amount'] = $this->data['bidAmountL'];
						$this->request->data['Bid']['date'] = $currDate;
						$this->request->data['Bid']['car_id'] = $this->data['car_id'];
						$save = $this->Bid->save($this->request->data);
						if ($save) {
							$this->Email->to = EMAIL_ACCOUNT;
							$this->Email->subject = 'Add new bid';
							$this->Email->from = EMAIL_ACCOUNT;
							$this->Email->sendAs = 'html';
							$mail_data = '<table celpadding="5" border="1">
								<tr> 
									<td>Bid Amount:</td><td>' . $this->data['Bid']['currency_type'] . '' . $this->data['bidAmountL'] . '</td>
								</tr>
								<tr> 
									<td>Car Name:</td><td>' . $car_data['CarName']['car_name'] . '</td>
								</tr>
								<tr> 
									<td>Chassis No.:</td><td>' . $car_data['Car']['cnumber'] . '</td>
								</tr>
								<tr> 
									<td>Unique id:</td><td>' . $car_data['Car']['uniqueid'] . '</td>
								</tr>
								<tr>
									<td>Name:</td><td>' . $this->Session->read('UserAuth.User.first_name') . ' ' . $this->Session->read('UserAuth.User.last_name') . '</td>
								</tr>
							</table>	
							';
							$this->Email->send($mail_data);
						}
						return json_encode(array("status" => "success", "message" => "Data is successfully added!"));
					}
				} else {
					if ($this->data['Bid']['currency_type'] == '$') {
						$curr = 'Doller';
						$m = "";
					} else {
						$curr = 'Yen';
						$m = ',Please check mid bid of Yen.';
					}
					return json_encode(array("status" => "success", "message" => "<div style='color:red;margin-bottom: 2%;margin-left: 28%;'><strong>Bid Amount " . $curr . " should be greater than min bid amount " . $m . "  </strong></div>"));
				}
			} else {
				return json_encode(array("status" => "error", "message" => "<div style='color:red;margin-bottom: 2%;text-align:center'><strong>Error-  </strong>Something went wrong</div>"));
			}
		}


	}


	public function car_show($carId = null)
	{


		$GerViewCounter = $this->Car->query("select * from cars where id = '" . $carId . "'");
		//ChromePhp::log(print_r($GerViewCounter));
		$groupid = $GerViewCounter[0]['cars']['groupid'];
		if($groupid == 5 && $this->getGuestPermission())
			die('Permission denied. Please go back.');
		elseif($groupid != 5 && $this->getGroupID() == 5)
			die('Permission denied. Please go back.');
		$Viewed = $GerViewCounter[0]['cars']['most_view'] + 1;
		$this->Car->query("update cars set most_view = '" . $Viewed . "' where id = '" . $carId . "'");

		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarImage' => array('fields' => 'image_source,id'), 'CarPayment' => array('fields' => 'sale_price,id,user_id,asking_price,yen'))));

		$showAllArrival = $this->Car->find('all', array('conditions' => array('Car.id' => $carId)));
		$this->set('showAllArrival', $showAllArrival);

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getGuestPermissionAccess(), 'Car.id !=' => $carId, "CarPaymentAls.yen" => $showAllArrival[0]['CarPayment'][0]['yen']);
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.id !=' => $carId, "CarPaymentAls.yen" => $showAllArrival[0]['CarPayment'][0]['yen']);
		else
			$condition = array('Car.publish' => 1, 'Car.id !=' => $carId, "CarPaymentAls.yen" => $showAllArrival[0]['CarPayment'][0]['yen']);

		$this->paginate = array('limit' => 12, 'conditions' => array($condition), 'order' => 'Car.id DESC', 'joins' => array(
			array(
				'alias' => 'CarPaymentAls',
				'table' => 'car_payments',
				'type' => 'left',
				'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
			)
		));

		$RelatedPrice = $this->Paginator->paginate('Car');

		$this->set('RelatedPrice', $RelatedPrice);


		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getGuestPermissionAccess(), 'Car.id !=' => $carId, "Car.vehicle_type_id" => $showAllArrival[0]['Car']['vehicle_type_id']);
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.id !=' => $carId, "Car.vehicle_type_id" => $showAllArrival[0]['Car']['vehicle_type_id']);
		else
			$condition = array('Car.publish' => 1, 'Car.id !=' => $carId, "Car.vehicle_type_id" => $showAllArrival[0]['Car']['vehicle_type_id']);

		$this->paginate = array('limit' => 12, 'conditions' => array($condition), 'order' => 'Car.id DESC', 'joins' => array(
			array(
				'alias' => 'CarPaymentAls',
				'table' => 'car_payments',
				'type' => 'left',
				'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
			)
		));

		$RelatedType = $this->Paginator->paginate('Car');

		$this->set('RelatedType', $RelatedType);


		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));
		if($this->getGuestPermission())
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getGuestPermissionAccess(), 'Car.id !=' => $carId, "Car.car_type_id" => $showAllArrival[0]['Car']['car_type_id']);
		else if($this->getGroupID() == 5)
			$condition = array('Car.publish' => 1, 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.id !=' => $carId, "Car.car_type_id" => $showAllArrival[0]['Car']['car_type_id']);
		else
			$condition = array('Car.publish' => 1, 'Car.id !=' => $carId, "Car.car_type_id" => $showAllArrival[0]['Car']['car_type_id']);

		$this->paginate = array('limit' => 12, 'conditions' => array($condition), 'order' => 'Car.id DESC', 'joins' => array(
			array(
				'alias' => 'CarPaymentAls',
				'table' => 'car_payments',
				'type' => 'left',
				'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
			)
		));

		$RelatedCarType = $this->Paginator->paginate('Car');

		$this->set('RelatedCarType', $RelatedCarType);
	}

	public function quickSearch()
	{

		$this->Car->unbindModelAll();

		$this->Car->bindModel(array('belongsTo' => array('Country' => array('fields' => 'id,country_name'), 'CarName' => array('fields' => 'car_name,id'), 'Brand' => array('fields' => 'brand_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id'))));
		if (!empty($this->data)) {
			$quickSearchDetail = $this->Car->find('all', array('conditions' => array('OR' => array(
				//'CarPayment.sale_price BETWEEN ? and ?' => array($this->data['priceFrom'], $this->data['priceTo']),
				'Car.manufacture_year BETWEEN ? and ?' => array($this->data['Home']['yearFrom'], $this->data['Home']['yearTo']),
				'Car.cc BETWEEN ? and ?' => array(0, $this->data['Home']['cc']),
				'CarName.id' => $this->data['Home']['model'],
				'Brand.id' => $this->data['Home']['brand_name'],
				'Country.id' => $this->data['Home']['country_name']
			))));
			//pr($quickSearchDetail);
			die;
			$this->set('quickSearchDetail', $quickSearchDetail);
		}

	}

	public function CarsOnBrand()
	{
		//	$this->Car->unbindModel(array('hasMany' => array('CarImage')));
		if ($this->request->is('post')) {
			$i = 0;
			$data = array();
			foreach ($this->data['car'] as $key => $value) {

				if (!empty($value)) {

					/*$data[$i] = $this->Car->find('all',array('conditions'=>array(
                                    'brand_name LIKE' => '%'.$value.'%' ,
                                ),'order' => array('Car.car_name' => 'ASC')));*/


				}
				$i++;
			}

		}
		//pr($data); die;
		$this->set('detail', $data);

	}

	public function getData()
	{
		$CarImage = $this->Car->find('first', array('conditions' => array('id' => $this->data['car_id'])));
		echo json_encode($CarImage);
	}

	/**
	 * This function show car ,payment overview,payment details, sale details
	 *
	 * @access public
	 * @return array
	 */

	public function dashboard()
	{
		$this->layout = 'default';
		$groupid = $this->Session->read('UserAuth.User.user_group_id');
		$id = $this->Session->read('UserAuth.User.id');
		$pTotal = 0;
		$sTotalDoller = 0;
		$pTotalYen = 0;
		$sTotalYen = 0;

		$userDetails = $this->User->find('first', array('order' => 'User.id desc', 'conditions' => array('User.user_group_id !=' => 1, 'User.id' => $id)));


		$this->set('userDetails', $userDetails);

		$this->set('data', 'empty');

		// show all car Buy details .
		$result = $this->getInvoiceDetailsByUser($id);
		$this->set('BuyDetails', $result);

		// show all Sale Buy details .
		$result_sale = $this->getInvoiceDetailsByUser($id, 'sell');
		$this->set('SaleDetails', $result_sale);

		$payPrice = '';
		foreach ($result as $pay) {
			if ($pay['Car']['user_doc_status'] == 1) {
				$payPrice += $pay['CarPayment']['sale_price'];
			}
		}
		$this->set('payPrice', $payPrice);


		// Show sum all of payment details according user
		$paymentTotal = $this->ClientPaymentHistory->find('all', array('fields' => array('SUM(ClientPaymentHistory.amount) as Amount', 'SUM(ClientPaymentHistory.yen_amount) as AmountYen'), 'conditions' => array('ClientPaymentHistory.client_id' => $id), 'group' => array('ClientPaymentHistory.client_id')));

		if ($paymentTotal) {
			foreach ($paymentTotal as $k => $v) {
				$pTotal = $v['0']['Amount'];
				$pTotalYen = $v['0']['AmountYen'];
				//$yenInDoller = $pTotalYen / $this->Session->read('yenRate');
				$allPaymentTotal = $pTotal + $pTotalYen;
				$allPaymentTotal = round($allPaymentTotal, 2);
			}
		} else {
			$pTotal = 0;
			$pTotalYen = 0;
		}

		/*if($paymentTotal)
        {
            foreach($paymentTotal as $k=>$v)
            {
                $pTotal = $v['0']['Amount'];
                $this->set('pTotal',$pTotal);
                $pTotalYen = $v['0']['AmountYen'];
                $this->set('pTotalYen',$pTotalYen);
            }
        }else
        {
            $pTotal = 0;
            $this->set('pTotal',$pTotal);
            $pTotalYen = 0;
            $this->set('pTotalYen',$pTotalYen);
        }*/

		// Show sum of all sale details according user
		if($groupid == 5) {
			$saleTotalDoller = $this->CarPayment->find('all', array('fields' => 'SUM(CarPayment.sale_price + CarPayment.psale_freight) as Sale_Amount', 'conditions' => array('CarPayment.currency' => '$', 'Car.created_by' => $id, 'CarPayment.sale_price !=' => ''), 'group' => array('CarPayment.user_id')
			));

			$saleTotalYen = $this->CarPayment->find('all', array('fields' => 'SUM(CarPayment.sale_price + CarPayment.psale_freight) as Sale_Amount', 'conditions' => array('CarPayment.currency' => '￥', 'Car.created_by' => $id, 'CarPayment.sale_price !=' => ''), 'group' => array('CarPayment.user_id')
			));
		}else{
			$saleTotalDoller = $this->CarPayment->find('all', array('fields' => 'SUM(CarPayment.sale_price + CarPayment.psale_freight) as Sale_Amount', 'conditions' => array('CarPayment.currency' => '$', 'CarPayment.user_id' => $id, 'CarPayment.sale_price !=' => ''), 'group' => array('CarPayment.user_id')
			));

			$saleTotalYen = $this->CarPayment->find('all', array('fields' => 'SUM(CarPayment.sale_price + CarPayment.psale_freight) as Sale_Amount', 'conditions' => array('CarPayment.currency' => '￥', 'CarPayment.user_id' => $id, 'CarPayment.sale_price !=' => ''), 'group' => array('CarPayment.user_id')
			));
		}

		/*For doller sale price*/
		if ($saleTotalDoller) {
			foreach ($saleTotalDoller as $k => $v) {
				$sTotalDoller = $v['0']['Sale_Amount'];
			}
		} else {
			$sTotalDoller = 0;
		}


		/*For yen sale price*/
		if ($saleTotalYen) {
			foreach ($saleTotalYen as $k => $v) {
				$sTotalYen = $v['0']['Sale_Amount'];
			}
		} else {
			$sTotalYen = 0;

		}

		$this->set('pTotalYen', $pTotalYen);
		$this->set('pTotal', $pTotal);
		$this->set('sTotalDoller', $sTotalDoller);
		$this->set('sTotalYen', $sTotalYen);
		$balanceTotalDoller = $pTotal - $sTotalDoller;
		$this->set('balanceTotalDoller', $balanceTotalDoller);

		$balanceTotalYen = $pTotalYen - $sTotalYen;
		$this->set('balanceTotalYen', $balanceTotalYen);

		/*$balanceTotalDoller = $sTotalDoller - $pTotal;
				$this->set('balanceTotalDoller',$balanceTotalDoller);

		$balanceTotalYen = $sTotalYen - $pTotalYen;
				$this->set('balanceTotalYen',$balanceTotalYen);*/


		/*if($saleTotal)
        {
            foreach($saleTotal as $k=>$v)
            {
                $sTotal = $v['0']['Sale_Amount'];
                $this->set('sTotal',$sTotal);
            }
        }
        else
        {
            $sTotal = 0;
            $this->set('sTotal',$sTotal);
        }*/


		/*$saleTotalYen =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.yen) as Sale_Amount_Yen','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.yen !='=>''),'group'=>array('CarPayment.user_id')));
            if($saleTotalYen)
            {

                foreach($saleTotalYen as $key=>$val)
                {
                    $sTotalYen = $val['0']['Sale_Amount_Yen'];
                    $this->set('sTotalYen',$sTotalYen);
                }
            }
            else
            {
                $sTotalYen = 0;
                $this->set('sTotalYen',$sTotalYen);
            }

            $balanceTotalYen = $pTotalYen - $sTotalYen;
            $this->set('balanceTotalYen',$balanceTotalYen); */

		// Show all payment details according user
		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => array('ClientPaymentHistory.client_id' => $id), 'order' => array('ClientPaymentHistory.payment_date' => 'DESC')));
		$this->set('PaymentDetails', $PaymentDetails);
		// Show all sale details according user
		//$SaleDetais = $this->CarPayment->find('all',array('conditions' => array('CarPayment.user_id' => $id),'order'=>array('CarPayment.updated_on'=>'DESC')));
		if($groupid == 5)
			$SaleDetais = $this->User->getAllHistoryBySellUserId($id);
		else
			$SaleDetais = $this->User->getAllHistoryByUserId($id);
		$this->set('SaleDetais', $SaleDetais);
	}

	public function logout()
	{
		$this->UserAuth->logout();
		$this->Session->setFlash(__('You are successfully signed out'));
		$this->redirect(LOGOUT_REDIRECT_URL);
	}

	public function carsearch()
	{

		$this->autoRender = false;
		$id = $this->Session->read('UserAuth.User.id');
		$term = $this->request->query['q'];
		$Cars = $this->getCarDetailsByUser($term, $id);
		$result = array();
		foreach ($Cars as $val) {
			$result[] = array("id" => $val['CarPayment']['car_id'], "text" => $val['CarName']['car_name']);
		}
		echo json_encode($result);
	}

	public function carSellsearch()
	{

		$this->autoRender = false;
		$id = $this->Session->read('UserAuth.User.id');
		$term = $this->request->query['q'];
		$Cars = $this->getCarDetailsByUser($term, $id, 'sell');
		$result = array();
		foreach ($Cars as $val) {
			$result[] = array("id" => $val['CarPayment']['car_id'], "text" => $val['CarName']['car_name']);
		}
		echo json_encode($result);
	}

	public function car_detail_search()
	{
		$carname = $this->data['name'];
		$carId = $this->data['id'];
		$result = $this->getAllCarDetailsByUser($carname, $carId);
		$this->set('SaleDetails', $result);
	}

	public function sell_car_detail_search()
	{
		$carname = $this->data['name'];
		$carId = $this->data['id'];
		$result = $this->getAllCarDetailsByUser($carname, $carId, 'sell');
		$this->set('SaleDetails', $result);
	}

	public function chassisSearch()
	{

		$this->autoRender = false;
		$id = $this->Session->read('UserAuth.User.id');
		$term = $this->request->query['q'];
		$Cars = $this->getDetailsByCnumber($term, $id);
		$result = array();
		foreach ($Cars as $val) {
			$result[] = array("id" => $val['CarPayment']['car_id'], "text" => $val['Car']['cnumber']);
		}
		echo json_encode($result);
	}

	public function chassissellSearch()
	{

		$this->autoRender = false;
		$id = $this->Session->read('UserAuth.User.id');
		$term = $this->request->query['q'];
		$Cars = $this->getDetailsByCnumber($term, $id, 'sell');
		$result = array();
		foreach ($Cars as $val) {
			$result[] = array("id" => $val['CarPayment']['car_id'], "text" => $val['Car']['cnumber']);
		}
		echo json_encode($result);
	}

	public function chassis_search_detail()
	{

		$cnumber = $this->data['name'];
		$id = $this->data['id'];
		$result = $this->getAllDetailsByCnumber($id);
		$this->set('SaleDetails', $result);
		$this->render('car_detail_search');
		$this->layout = null;
	}

	public function cardetail()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$result = $this->getInvoiceDetailsByUser($id);
		$this->set('SaleDetails', $result);
		$this->render('car_detail_search');
		$this->layout = null;
	}

	public function getInvoiceDetailsByUser($userId, $sale_buy_flag = '')
	{
		$sub_query = " CarPayment.user_id = $userId ";
		if($sale_buy_flag == 'sell')
			$sub_query = " Car.created_by = $userId ";

		$query = "SELECT Logistic.remark,Car.id, Car.user_doc_updated,Logistic.ship_port,Logistic.destination_port,Logistic.departure_date,Logistic.arrival_date,Logistic.port_remark,
Port.port_name,CarPayment.updated_on,Car.manufacture_year,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.currency,CarPayment.yen,
CarPayment.currency,CarPayment.sale_price, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, 
Car.brand_id, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name, CarPayment.psale_freight, Logistic.bl_no, Car.consignee
					FROM  cars AS Car					
					LEFT JOIN `car_payments` AS CarPayment ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					LEFT JOIN ports AS Port ON Port.id = Logistic.port_id
					WHERE $sub_query  AND Car.deleted = 0 and  CarPayment.deleted = 0 group by Car.stock ORDER BY CarPayment.updated_on DESC";

		$result = $this->User->query($query);
		return $result;
	}

	public function getCarDetailsByUser($carName, $id, $sellbuy_flag = '')
	{
		$subquery = " AND CarPayment.user_id ='" . $id . "' ";
		if($sellbuy_flag == 'sell')
			$subquery = " AND Car.created_by ='" . $id . "' ";
		$result = $this->User->query("SELECT DISTINCT CarPayment.car_id,CarPayment.id, Logistic.created,CarName.car_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE CarName.car_name LIKE '%" . $carName . "%' $subquery  AND  CarPayment.deleted = 0 group by CarName.car_name");
		return $result;
	}

	public function getAllCarDetailsByUser($carname, $carId, $sellbuy_flag = '')
	{
		/*$result = $this->User->query("SELECT CarPayment.car_id,CarPayment.currency,CarPayment.id, Logistic.created,CarPayment.sale_price,CarPayment.yen, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id, Car.brand_id,Car.price_editable, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE CarName.car_name ='".$carname."' AND CarPayment.sale_price !=''  AND  CarPayment.deleted = 0 ");*/
		$userId = $this->Session->read('UserAuth.User.id');
		$subquery = " CarPayment.user_id = '$userId' ";
		if($sellbuy_flag == 'sell')
			$subquery = " Car.created_by = '$userId'";
		$result = $this->User->query("SELECT Logistic.remark,Car.user_doc_updated,Car.id, Logistic.ship_port,Logistic.destination_port,Logistic.departure_date,Logistic.arrival_date,Logistic.port_remark,Port.port_name,CarPayment.updated_on,Car.manufacture_year,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.currency,CarPayment.yen,CarPayment.currency,CarPayment.sale_price, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					LEFT JOIN ports AS Port ON Port.id = Logistic.port_id
					WHERE $subquery AND CarName.car_name ='" . $carname . "'  AND Car.deleted = 0 and  CarPayment.deleted = 0 
					group by Car.stock ORDER BY CarPayment.updated_on DESC");


		return $result;
	}

	public function getDetailsByCnumber($cnumber, $id, $buysell_flag = '')
	{
		$sub_query = "AND CarPayment.user_id ='" . $id . "'";
		if($buysell_flag == 'sell')
			$sub_query = "AND Car.created_by ='" . $id . "'";
		$result = $this->User->query("SELECT DISTINCT CarPayment.car_id,CarPayment.id,Logistic.created,Car.id, CarPayment.sale_price,CarPayment.yen,CarPayment.currency, CarPayment.updated_on, Invoice.invoice_no, CarName.car_name, Car.cnumber,Car.price_editable, Car.country_id, Car.brand_id, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE  Car.cnumber  LIKE '%" . $cnumber . "%'  $sub_query  AND  CarPayment.deleted = 0 ");
		return $result;
	}


	public function getInvoiceDetailsByUserWithDate($userId, $fromdate, $todate, $buysell_flag = '')
	{
		$sub_query = " CarPayment.user_id = ' $userId '";
		if($buysell_flag == 'sell')
			$sub_query = " Car.created_by = '$userId'";
		$result = $this->User->query("SELECT Car.id, CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.yen,CarPayment.currency, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE $sub_query AND CarPayment.updated_on BETWEEN '$fromdate' AND '$todate'  AND  CarPayment.deleted = 0 order by CarPayment.updated_on DESC");
		return $result;
	}

	public function getAllDetailsByCnumber($id)
	{
		$result = $this->User->query("SELECT DISTINCT CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency,CarPayment.yen, 
CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber,Car.price_editable, Car.country_id, Car.brand_id, Car.stock, Logistic.status, 
Logistic.remark, Shipping.company_name, CarPayment.psale_freight
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE CarPayment.car_id ='" . $id . "'  AND  CarPayment.deleted = 0 ");
		return $result;
	}

	public function getPurchaseCountryData()
	{

		$result = $this->User->query("SELECT Country.id, Country.country_name, Country.country_image, COUNT( Car.purchase_country_id ) AS Total, Car.id, Car.purchase_country_id, Car.car_type_id, Car.brand_id FROM cars AS Car LEFT JOIN countries AS Country ON Country.id = Car.purchase_country_id WHERE Car.publish =1 AND Car.deleted = 0 AND new_arrival != '1'  GROUP BY Car.purchase_country_id");
		return $result;

	}


	public function send_mail()
	{

		$this->autoRender = false;
		if ($this->RequestHandler->isPost()) {

			/*$this->Email->smtpOptions = array(
			 'port'=>'465',
			 'timeout'=>'30',
			 'host' => 'ssl://smtp.gmail.com',
			 'username'=>'ukcarstokyo@gmail.com',
			 'password'=>'uktokyo123',
			 //'password'=>'uktokyo234',
			);*/

			/*$this->Email->smtpOptions = array(
			 'port'=>'465',
			 'timeout'=>'30',
			 'host' => 'smtpout.secureserver.net',
			 'username'=> EMAIL_ACCOUNT,
			 'password'=> EMAIL_PASSWORD,
			);*/


			$this->Email->to = EMAIL_ACCOUNT;
			$this->Email->replyTo = $this->data['Home']['email'];
			$this->Email->subject = 'Contact message from ' . $this->data['Home']['name'];
			$this->Email->from = $this->data['Home']['email'];
			$this->Email->sendAs = 'html';
			$this->Email->send('<table celpadding="5">
								<tr>
									<td>Name :</td><td>' . $this->data['Home']['name'] . '</td>
								</tr>
								<tr>
									<td>Email :</td><td>' . $this->data['Home']['email'] . '</td>
								</tr>
								<tr>
									<td>Phone :</td><td>' . $this->data['Home']['phone'] . '</td>
								</tr>
								<tr>
									<td>Message :</td><td>' . $this->data['Home']['msgInfo'] . '</td>
								</tr>
								</table>	
								');

			$this->Email->to = $this->data['Home']['email'];
			$this->Email->subject = 'Regarding Contact';
			$this->Email->replyTo = EMAIL_ACCOUNT;
			$this->Email->from = EMAIL_ACCOUNT;
			$this->Email->send("Thank you , we will contact you soon!");


			echo json_encode(array("status" => "success", "message" => "Your mail is successfully send!"));

		} else {
			echo json_encode(array("status" => "error", "message" => "Your detail something wrong!"));
		}


	}

	/* function for the Stock List Depending on Country  */
	function stockList()
	{
		//pr($this->Session->read('clientLogin'));

		$countryId = $this->passedArgs['country'];
		$brandId = @$this->passedArgs['brand'];
		$typeId = @$this->passedArgs['type'];

		if ($this->request->is('post')) {    //check if request is post

			$cId = $this->passedArgs['country'];
			$Pwd = $this->data['home']['password'];

			$return = $this->client_login($cId, $Pwd);        //call client_login function to check pwd and country
			if ($return) {    //if authentication is success
				$this->redirect($this->referer());
			} else {    // if authentication is failure

				$this->Session->setFlash('password is not match please try again !');
				$this->redirect($this->referer());
			}
		} else {        //if request is GET
			## start show total count data

			/*$brandData = $this->Car->find('all',array('fields'=>array('Car.brand_id','Car.id','Car.car_type_id'),'conditions'=>array('Car.country_id'=>$this->passedArgs['country'],'Car.car_type_id'=>$typeId,'Car.publish'=>1,'Car.new_arrival'=> 0),'group' => array('Car.brand_id')));
            $this->set('brandCount',count($brandData));

            $carRelatedtoCountry = $this->Car->find('all',array('conditions'=>array('Car.country_id'=>$this->passedArgs['country'],'Car.car_type_id'=>$typeId,'Car.publish'=>1,'Car.new_arrival'=> 0),'group' => array('Car.car_name_id')));
            $this->set('carCount',count($carRelatedtoCountry));*/


			## end total count data
			if ($countryId == 2) {

				$this->Car->unbindModelAll();
				$brandData = $this->Car->find('count', array('conditions' => array('Car.country_id' => $this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0), 'group' => array('Car.brand_id')));
				$this->set('brandCount', $brandData);


				$carRelatedtoCountry = $this->Car->find('count', array('conditions' => array('Car.country_id' => $this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0)));
				$this->set('carCount', $carRelatedtoCountry);

				//here country is Russia so no need of login

				$brandName = $this->Brand->find('first', array('fields' => 'brand_name,id', 'conditions' => array('Brand.id' => $brandId)));

				$countryName = $this->Country->find('first', array('fields' => 'country_name,id', 'conditions' => array('Country.id' => $countryId)));

				$this->set('brandName', $brandName);
				$this->set('countryName', $countryName);

				//$CBrand=$this->Car->find('all',array('fields'=>array('Brand.id', 'Brand.brand_name','Brand.brand_image','Car.car_type_id'),'group' => array('Brand.brand_name'),'conditions'=>array('Car.country_id'=>$this->passedArgs['country'],'Car.publish'=>1)));

				$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
				$condition = array('Car.country_id' => $this->passedArgs['country'], 'Car.publish' => 1, 'Car.new_arrival' => 0);
				$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
				$group = array('Car.brand_id');
				$order = array('Brand.priority');

				$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));


				/*$CBrand=$this->Car->find('all',array('fields'=>array('Brand.id', 'Brand.brand_name','Brand.brand_image','Car.car_type_id'),'group' => array('Brand.brand_name'),'conditions'=>array('Car.country_id'=>$this->passedArgs['country'],'Car.car_type_id'=>$typeId,'Car.publish'=>1)));*/

				if (isset($this->passedArgs['brand'])) {
					/*$CarList=$this->Car->find('all',array('group' => array('Car.car_name_id'),'conditions'=>array('Car.country_id'=>$this->passedArgs['country'],'Car.brand_id'=>$this->passedArgs['brand'],'Car.car_type_id'=>$typeId,'Car.publish'=>1),'order' => array('CarName.car_name' => 'ASC')));*/

					$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.country_id' => $this->passedArgs['country'], 'Car.brand_id' => $this->passedArgs['brand'], 'Car.publish' => 1, 'Car.new_arrival' => 0), 'order' => array('CarName.car_name' => 'ASC')));
				} else {
					throw new NotFoundException('Could not find any Vehicle');
				}
				$this->set('CarList', $CarList);
				$this->set('CBrand', $CBrand);

			} elseif ($countryId != 2) {                // if country other than Russia check login or authenticate user

				if ($this->check_client_login($countryId)) {        //if User is allready has been logged in

					//$this->Car->unbindModelAll();

					$countryName = $this->Country->find('first', array('fields' => 'country_name,id', 'conditions' => array('Country.id' => $countryId)));

					$this->set('countryName', $countryName);

					$CBrand = $this->Car->find('all', array('fields' => array('Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id'),
						'group' => array('Brand.brand_name'), 'conditions' => array('Car.country_id' => $this->passedArgs['country'], 'Car.car_type_id' => $typeId, 'Car.publish' => 1, 'Car.new_arrival' => 0)));
					//pr($CBrand);

					$b = array();
					foreach ($CBrand as $brand) {
						$b[] = $brand['Brand']['id'];
					}

					$brandName = $this->Brand->find('first', array('fields' => 'brand_name,id', 'conditions' => array('Brand.id' => $b)));
					$this->set('brandName', $brandName);
					$CarList = $this->Car->find('all', array('conditions' => array('Car.country_id' => $this->passedArgs['country'], 'Car.brand_id' => $b, 'Car.car_type_id' => $typeId, 'Car.publish' => 1, 'Car.new_arrival' => 0), 'order' => array('CarName.car_name' => 'ASC'), 'group' => array('Car.car_name_id')));

					$this->set('CarList', $CarList);
					$this->set('CBrand', $CBrand);
					//$this->Session->delete('GenPass');


				} else {    //user is not logged in show him login screen
					$this->render('client_login');

				}


			}

		}
	} //end of function

	public function sendBuyCarMail($userId, $carId, $amount, $moneyType)
	{

		/* SMTP Options */
		$UserDetail = $this->User->find('first', array('fields' => array('User.first_name,User.last_name,User.email,User.contact'), 'conditions' => array('User.id' => $userId)));
		$CarDetail = $this->Car->find('first', array('fields' => array('Car.cnumber,CarName.car_name'), 'conditions' => array('Car.id' => $carId)));
		//pr($CarDetail);die;
		$currDate = date('d-m-Y');
		if ($moneyType == 0) {
			$money = '$';
		} else {
			$money = '￥';
		}
		/*$this->Email->smtpOptions = array(
                  'port'=>'465',
                  'timeout'=>'30',
                  'host' => 'smtpout.secureserver.net',
                  'username'=> EMAIL_ACCOUNT,
                  'password'=> EMAIL_PASSWORD,
                 );*/
		//$this->Email->delivery = 'smtp';
		$this->Email->to = EMAIL_ACCOUNT;
		//$this->Email->to = 'nikhil.tiwari@webenturetech.com';
		$this->Email->subject = 'Buy Car Client Mail';
		$this->Email->replyTo = $UserDetail['User']['email'];
		$this->Email->from = $UserDetail['User']['email'];
		$this->Email->sendAs = 'html';
		$this->Email->send('<table celpadding="5">
							<tr> 
								<td>Customer Name:</td><td>' . $UserDetail['User']['first_name'] . ' ' . $UserDetail['User']['last_name'] . '</td>
							</tr>
							<tr> 
								<td>Email:</td><td>' . $UserDetail['User']['email'] . '</td>
							</tr>
							<tr> 
								<td>Contact No.:</td><td>' . $UserDetail['User']['contact'] . '</td>
							</tr>
							<tr> 
								<td>Car Name:</td><td>' . $CarDetail['CarName']['car_name'] . '</td>
							</tr>
							<tr> 
								<td>Car Chechis No:</td><td>' . $CarDetail['Car']['cnumber'] . '</td>
							</tr>
							<tr> 
								<td>Date:</td><td>' . $currDate . '</td>
							</tr>
							<tr> 
								<td>Amount:</td><td>' . $money . $amount . '</td>
							</tr>
							
							</table>	
							');
	}

	public function buyCar()
	{

		$yen = $this->Session->read('yenRate');
		//pr($yen);die;
		$this->autoRender = false;
		$user_id = $this->Session->read('UserAuth.User.id');

		// $userDetails = $this->User->find('first', array('fields'=>array('User.country'),'conditions' => array('User.user_group_id !=' => 1,'User.id'=>$user_id)));


		$carData = $this->CarPayment->find('first', array('fields' => array('CarPayment.currency', 'CarPayment.yen', 'CarPayment.asking_price', 'CarPayment.minimum_price_doller', 'CarPayment.minimum_price_yen'), 'conditions' => array('CarPayment.car_id' => $this->data['car_id'])));


		/*if($userDetails['User']['country'] == 3 || $userDetails['User']['country'] == 16 )
        {
            if($carData['CarPayment']['minimum_price_yen'] <= $this->data['amount'])
            {

                $data = array();
                $this->CarPayment->primaryKey = 'car_id';
                $data['car_id'] = $this->data['car_id'];
                $data['sale_price'] = $this->data['amount'];
                $data['user_id'] = $user_id;
                $data['mony_type'] = $this->data['monyType'];
                pr($data);die;
                //$moveCar = $this->CarPayment->save($data);
                $this->CarPayment->primaryKey = 'id';
                echo json_encode(array("status"=>"success","message"=>"This car is move in your account"));
            }
            else
            {
                echo json_encode(array("status"=>"error","message"=>"Your price is less then bid price"));
            }
        }
        else
        {*/
		if ($this->data['monyType'] == 0) {
			if ($carData['CarPayment']['minimum_price_doller'] == '') {
				if (ceil($carData['CarPayment']['asking_price'] + ADDITIONAL_PRICE) <= $this->data['amount']) {

					$data = array();
					$this->CarPayment->primaryKey = 'car_id';
					$data['car_id'] = $this->data['car_id'];
					$data['sale_price'] = $this->data['amount'];
					$data['currency'] = '$';
					$data['updated_on'] = date('Y-m-d');
					$data['user_id'] = $user_id;
					//$data['mony_type'] = $this->data['monyType'];
					$moveCar = $this->CarPayment->save($data);
					$moveCar = $data;
					$this->CarPayment->primaryKey = 'id';
					if ($moveCar) {
						$publishData = array();
						$publishData['id'] = $data['car_id'];
						$this->Car->updateAll(array('Car.publish' => 0), array('Car.id' => $publishData['id']));
					}
					echo json_encode(array("status" => "success", "message" => "This car is move in your account"));
					$SendMail = $this->sendBuyCarMail($user_id, $this->data['car_id'], $this->data['amount'], $this->data['monyType']);
				} else {
					echo json_encode(array("status" => "error", "message" => "Your price is less then bid price"));
				}
			} else {
				if ($carData['CarPayment']['minimum_price_doller'] <= $this->data['amount']) {

					$data = array();
					$this->CarPayment->primaryKey = 'car_id';
					$data['car_id'] = $this->data['car_id'];
					$data['sale_price'] = $this->data['amount'];
					$data['currency'] = '$';
					$data['updated_on'] = date('Y-m-d');
					$data['user_id'] = $user_id;
					//$data['mony_type'] = $this->data['monyType'];
					$moveCar = $this->CarPayment->save($data);
					$moveCar = $data;
					$this->CarPayment->primaryKey = 'id';
					if ($moveCar) {
						$publishData = array();
						$publishData['id'] = $data['car_id'];
						$this->Car->updateAll(array('Car.publish' => 0), array('Car.id' => $publishData['id']));
					}
					echo json_encode(array("status" => "success", "message" => "This car is move in your account"));
					$SendMail = $this->sendBuyCarMail($user_id, $this->data['car_id'], $this->data['amount'], $this->data['monyType']);
				} else {
					echo json_encode(array("status" => "error", "message" => "Your price is less then bid price"));
				}
			}
		} else {
			if ($carData['CarPayment']['minimum_price_yen'] == '') {
				if (ceil($carData['CarPayment']['yen'] + ADDITIONAL_YEN_PRICE) <= $this->data['amount']) {

					$data = array();
					$this->CarPayment->primaryKey = 'car_id';
					$data['car_id'] = $this->data['car_id'];
					//$data['sale_price'] = $this->data['amount']/$yen;
					$data['sale_price'] = $this->data['amount'];
					$data['currency'] = '￥';
					$data['updated_on'] = date('Y-m-d');
					$data['user_id'] = $user_id;
					//$data['mony_type'] = $this->data['monyType'];
					//pr($data);die;
					$moveCar = $this->CarPayment->save($data);
					$this->CarPayment->primaryKey = 'id';
					if ($moveCar) {
						$publishData = array();
						$publishData['id'] = $data['car_id'];
						$this->Car->updateAll(array('Car.publish' => 0), array('Car.id' => $publishData['id']));
					}
					echo json_encode(array("status" => "success", "message" => "This car is move in your account"));
					$SendMail = $this->sendBuyCarMail($user_id, $this->data['car_id'], $this->data['amount'], $this->data['monyType']);
				} else {
					echo json_encode(array("status" => "error", "message" => "Your price is less then bid price"));
				}
			} else {
				if ($carData['CarPayment']['minimum_price_yen'] <= $this->data['amount']) {

					$data = array();
					$this->CarPayment->primaryKey = 'car_id';
					$data['car_id'] = $this->data['car_id'];
					//$data['sale_price'] = $this->data['amount']/$yen;
					$data['sale_price'] = $this->data['amount'];
					$data['updated_on'] = date('Y-m-d');
					$data['user_id'] = $user_id;
					$data['currency'] = '￥';
					//$data['mony_type'] = $this->data['monyType'];
					$moveCar = $this->CarPayment->save($data);
					$this->CarPayment->primaryKey = 'id';
					if ($moveCar) {
						$publishData = array();
						$publishData['id'] = $data['car_id'];
						$this->Car->updateAll(array('Car.publish' => 0), array('Car.id' => $publishData['id']));
					}
					echo json_encode(array("status" => "success", "message" => "This car is move in your account"));
					$SendMail = $this->sendBuyCarMail($user_id, $this->data['car_id'], $this->data['amount'], $this->data['monyType']);
				} else {
					echo json_encode(array("status" => "error", "message" => "Your price is less then bid price"));
				}
			}
		}
	}

	function allstock()
	{

		$carNameId = $this->passedArgs['car_name'];
		$brandId = $this->passedArgs['brand'];

		$brandName = $this->Brand->find('first', array('fields' => 'Brand.brand_name,Brand.id', 'conditions' => array('Brand.id' => @$brandId)));
		$this->set('brandName', $brandName);

		$countryName = $this->Country->find('first', array('fields' => 'Country.country_name,Country.id', 'conditions' => array('Country.id' => @$countryId)));
		$this->set('countryName', $countryName);
		$this->Car->unbindModelAll();
		$this->CarPayment->unbindModelAll();

		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));

		$showAllCar = $this->Car->find('all', array('conditions' => array('Car.car_name_id' => $carNameId, 'Car.brand_id' => $brandId, 'Car.publish' => 1, 'Car.new_arrival' => 0), 'recursive' => 2));
		$this->set('showAllCar', $showAllCar);
		//pr($this->data); die;

	}


	function allstockList()
	{
		$global_search_flag = 0;
		$globalCondition = array();
		$userflag = 1;
		if ($this->UserAuth->isLogged()) {
			$userflag = 0;
		}

		$Brand = $this->Brand->find('list', array('fields' => array('id', 'brand_name'), 'order' => array('priority' => 'ASC')));

		$this->set('Brand', $Brand);

		if (@$this->passedArgs['brand'] != "") {
			$carName = $this->CarName->find('list', array('fields' => array('id', 'car_name'), 'conditions' => array("brand_id" => $this->passedArgs['brand'])));

			$this->set('carName', $carName);
		} else if (@$_POST['data']['Home']['brand_name'] != "") {
			$carName = $this->CarName->find('list', array('fields' => array('id', 'car_name'), 'conditions' => array("brand_id" => $_POST['data']['Home']['brand_name'])));
			$this->set('carName', $carName);
		} else if (@$_REQUEST['search'] != "") {
			$term = $_REQUEST['search'];
			$temp_condition = array('UPPER(CarName.car_name) LIKE' => '%' . strtoupper($term) . '%');
			$carName = $this->CarName->find('list', array('fields' => array('id', 'car_name'), 'conditions' => array('deleted' => 0, $temp_condition)));
//'conditions'=>array('Car.cnumber LIKE'=>'%'.$term.'%')
			$this->set('carName', $carName);
		} else {
			$this->set('carName', array());

		}

		//$this->CarName->getDataSource());
		$Condition = array();
		//$Condition[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->passedArgs['from'],$this->passedArgs['to']));
		if (isset($_POST['CarType']) && $_POST['CarType'] != "") {
			$Condition[] = array('Car.vehicle_type_id' => $_POST['CarType']);
			$this->set('CarType', $_POST['CarType']);
		}

		if (@$this->passedArgs['from'] && @$this->passedArgs['to']) {
			$Condition[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->passedArgs['from'], $this->passedArgs['to']));
		}

		if (@$_POST['data']['Home']['brand_name']) {
			$Condition[] = array('Car.brand_id' => array($_POST['data']['Home']['brand_name']));
		}


		if (@$_REQUEST['brand']) {
			$Condition[] = array('Car.brand_id' => array($_REQUEST['brand']));
		}

		if (@$this->passedArgs['brand']) {
			$Condition[] = array('Car.brand_id' => array($this->passedArgs['brand']));
		}

		if (@$this->passedArgs['modal']) {
			$Condition[] = array('Car.car_name_id' => array($this->passedArgs['modal']));
		}

		if (@$this->passedArgs['type']) {
			$Condition[] = array('Car.car_type_id' => array($this->passedArgs['type']));
		}

		if (@$this->passedArgs['vechileType']) {
			$Condition[] = array('Car.vehicle_type_id' => array($this->passedArgs['vechileType']));
			$this->set('CarType', $this->passedArgs['vechileType']);
		}

		if (@$_POST['data']['Home']['stock']) {
			$Condition[] = array('Car.stock' => array($_POST['data']['Home']['stock']));
		}


		if (@$_POST['data']['Home']['cc']) {
			$data = explode(',', $_POST['data']['Home']['cc']);
			$Condition[] = array('Car.cc BETWEEN ? and ?' => array($data[0], $data[1]));
		}

		if (@$_POST['data']['Home']['cnumber']) {
			$Condition[] = array('Car.cnumber' => $_POST['data']['Home']['cnumber']);
		}


		if (@$_REQUEST['search']) {
			$global_search_flag = 1;
			$term = $_REQUEST['search'];
			//'CarName.car_name LIKE'=>'%'.$search.'%'
			$globalCondition[] = array('UPPER(CarName.car_name) LIKE' => '%' . strtoupper($term) . '%');
			$globalCondition[] = array('UPPER(brandsAls.brand_name) LIKE' => '%' . strtoupper($term) . '%');
			$globalCondition[] = array('UPPER(car_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');
			$globalCondition[] = array('UPPER(vehicle_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');

			$globalCondition[] = array('UPPER(Car.cnumber) LIKE' => '%' . strtoupper($term) . '%');
			$globalCondition[] = array('Car.stock LIKE' => '%' . $term . '%');

			$this->set('GlobalSearch', $term);

		}
		if (@$_REQUEST['modal']) {
			$Condition[] = array('Car.car_name_id' => array($_REQUEST['modal']));
		}

		$this->Car->unbindModelAll();
		//print_r($this->Car->getDataSource());
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')),
			'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'),
				'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));

		if ($userflag == 0) { // If user logged in\
			$start = date('Y-m-d');
			$end = date('Y-m-d', strtotime('-6 month'));
			$cond = array('Car.publish' => 0, 'CarPaymentAls.created_on <=' => $start, 'CarPaymentAls.created_on >=' => $end);
		} else {
			$cond = array();
		}

//array('Car.publish'=>1, $Condition)

//              $Condition[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->passedArgs['from'],$this->passedArgs['to']));


		/*

        array(
                    array('OR' => array(
                            'Holding.holding_date' => '2013-09-15',
                            'AND' => array(
                                'Holding.holding_date = LAST_DAY(Holding.holding_date)',
                                'MONTH(Holding.holding_date)' => array(3,6,9,12)
                                )
                            )
                        )
        'OR'=>array('AND'=>array('Car.publish'=>1, $Condition),$cond)
        //array(1,$userflag)

        */
//unset($Condition);

		if (@$_POST['data']['Home']['stock'] || @$_POST['data']['Home']['cnumber']) {
			if ($userflag == 1) { // Not loggedin
				$this->paginate = array('limit' => 12, 'conditions' => array('OR' => array(array('Car.publish' => 1 , 'Car.groupid' => $this->getGuestPermissionAccess() , 'Car.deleted' => 0, $Condition))),
					'order' => 'Car.id DESC', 'joins' => array(
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'left',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						)
					));
			}else{
				if($this->getGroupID() == 5)
					$condition2 = array('OR' => array(array('Car.publish' => array(1, 0), 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.deleted' => 0, $Condition)));
				else
					$condition2 = array('OR' => array(array('Car.publish' => array(1, 0), 'Car.deleted' => 0, $Condition)));

				$this->paginate = array('limit' => 12, 'conditions' => $condition2,
					'order' => 'Car.id DESC', 'joins' => array(
						array(
							'alias' => 'Carmis',
							'table' => 'car_publish_new_sold',
							'type' => 'INNER',
							'conditions' => '`Carmis`.`id` = `Car`.`id`'
						),
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'left',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						)
					));
			}

		} else {
			if ($userflag == 1) {// Not logged in
				$this->paginate = array('limit' => 12, 'conditions' => array('Car.publish' => array(1), 'Car.groupid' => $this->getGuestPermissionAccess(), 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $globalCondition)),
					'order' => 'Car.id DESC', 'joins' => array(
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'left',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						),
						array(
							'alias' => 'brandsAls',
							'table' => 'brands',
							'type' => 'INNER',
							'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0 '
						)
					,
						array(
							'alias' => 'car_typesAls',
							'table' => 'car_types',
							'type' => 'INNER',
							'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
						),
						array(
							'alias' => 'vehicle_typesAls',
							'table' => 'vehicle_types',
							'type' => 'LEFT',
							'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
						)
					));
			}else{ // loggedin
				if($global_search_flag == 0){
					if($this->getGroupID() == 5)
						$condition2 = array('Car.publish' => array(1), 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $globalCondition));
					else
						$condition2 = array('Car.publish' => array(1), 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $globalCondition));

					$this->paginate = array('limit' => 12, 'conditions' => $condition2,
						'order' => 'Car.id DESC', 'joins' => array(
							array(
								'alias' => 'CarPaymentAls',
								'table' => 'car_payments',
								'type' => 'left',
								'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
							),
							array(
								'alias' => 'brandsAls',
								'table' => 'brands',
								'type' => 'INNER',
								'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0 '
							)
						,
							array(
								'alias' => 'car_typesAls',
								'table' => 'car_types',
								'type' => 'INNER',
								'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
							),
							array(
								'alias' => 'vehicle_typesAls',
								'table' => 'vehicle_types',
								'type' => 'LEFT',
								'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
							)
						));
				}else {
					if($this->getGroupID() == 5)
						$condition2 = array('Car.publish' => array(1, 0), 'Car.groupid' => $this->getSellUserPermissionAccess(), 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $globalCondition));
					else
						$condition2 = array('Car.publish' => array(1, 0), 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $globalCondition));

					$this->paginate = array('limit' => 12, 'conditions' => $condition2,
						'order' => 'Car.id DESC', 'joins' => array(
							array(
								'alias' => 'Carmis',
								'table' => 'car_publish_new_sold',
								'type' => 'inner',
								'conditions' => 'Carmis.id = Car.id'
							),
							array(
								'alias' => 'CarPaymentAls',
								'table' => 'car_payments',
								'type' => 'left',
								'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
							),
							array(
								'alias' => 'brandsAls',
								'table' => 'brands',
								'type' => 'INNER',
								'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0 '
							)
						,
							array(
								'alias' => 'car_typesAls',
								'table' => 'car_types',
								'type' => 'INNER',
								'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
							),
							array(
								'alias' => 'vehicle_typesAls',
								'table' => 'vehicle_types',
								'type' => 'LEFT',
								'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
							)
						));
				}
			}
		}
		//echo "<pre>";print_r($this->Paginator);die;
		$carDetails = $this->Paginator->paginate('Car');
//echo '<pre>'; print_r($this->Car->getDataSource()); die;
		#$log = $this->Car->getDataSource()->getLog(false, false);
		#echo '<pre style="display:none">';
		#print_r ($log);
		#echo '</pre>';
		#die;
		//echo "<pre>";print_r($Condition);
		//echo "<pre>";print_r($carDetails);die;
		$this->set('showAllCar', $carDetails);


		//$this->Car->unbindModelAll();

		if ($this->Session->read('LANGUAGE') == 2) {

			$this->CarPayment->unbindModelAll();
			$MaxRange = $this->CarPayment->find('first', array('fields' => array('MAX(CarPayment.asking_price) as max_price', 'MIN(CarPayment.asking_price) as min_price'),
				'conditions' => array('Car.publish' => 1, 'Car.deleted' => 0, $Condition), 'joins' => array(
					array(
						'alias' => 'Car',
						'table' => 'cars',
						'type' => 'left',
						'conditions' => '`CarPayment`.`car_id` = `Car`.`id`'
					)
				)));

			$this->set('PriceRange', $MaxRange);
		} else {
			$this->CarPayment->unbindModelAll();
				$MaxRange = $this->CarPayment->find('first', array('fields' => array('MAX(CarPayment.yen) as max_price', 'MIN(CarPayment.yen) as min_price'),
					'conditions' => array('Car.publish' => 1 /*array(1, $userflag)*/, 'Car.deleted' => 0, 'AND' => array('OR' => $Condition)), 'joins' => array(
						array(
							'alias' => 'Car',
							'table' => 'cars',
							'type' => 'left',
							'conditions' => '`CarPayment`.`car_id` = `Car`.`id`'
						),
						array(
							'alias' => 'CarName',
							'table' => 'car_names',
							'type' => 'left',
							'conditions' => '`Car`.`car_name_id` = `CarName`.`id`'
						),
						array(
							'alias' => 'brandsAls',
							'table' => 'brands',
							'type' => 'INNER',
							'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND brandsAls.deleted = 0'
						)
					,
						array(
							'alias' => 'car_typesAls',
							'table' => 'car_types',
							'type' => 'INNER',
							'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND car_typesAls.deleted = 0'
						),
						array(
							'alias' => 'vehicle_typesAls',
							'table' => 'vehicle_types',
							'type' => 'LEFT',
							'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
						)
					)));
			$this->set('PriceRange', $MaxRange);
		}

		$this->Car->unbindModelAll();
			$KMRange = $this->Car->find('first', array('fields' => array('MAX(Car.mileage) as max_price', 'MIN(Car.mileage) as min_price'),
				'conditions' => array('Car.publish' => 1, 'Car.deleted' => 0, 'AND' => array('OR' => $Condition)), 'joins' => array(
					array(
						'alias' => 'CarName',
						'table' => 'car_names',
						'type' => 'left',
						'conditions' => '`Car`.`car_name_id` = `CarName`.`id`'
					),
					array(
						'alias' => 'CarPaymentAls',
						'table' => 'car_payments',
						'type' => 'left',
						'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
					),
					array(
						'alias' => 'brandsAls',
						'table' => 'brands',
						'type' => 'INNER',
						'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0 '
					)
				,
					array(
						'alias' => 'car_typesAls',
						'table' => 'car_types',
						'type' => 'INNER',
						'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
					),
					array(
						'alias' => 'vehicle_typesAls',
						'table' => 'vehicle_types',
						'type' => 'LEFT',
						'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
					)
				)
			));

		//echo '<pre>'; print_r($this->Car->getDataSource()); die;
		$this->set('KMRange', $KMRange);
	}


	function filterStockList()
	{
		$userflag = 1;
		if ($this->UserAuth->isLogged()) {
			$userflag = 0;
		}
		$Condition = array();
		$GlobalCondition = array();

		if (@$_REQUEST['GlobalSearch']) {
			$term = $_REQUEST['GlobalSearch'];
			//'CarName.car_name LIKE'=>'%'.$search.'%'
			$GlobalCondition[] = array('UPPER(CarName.car_name) LIKE' => '%' . strtoupper($term) . '%');
			$GlobalCondition[] = array('UPPER(Car.cnumber) LIKE' => '%' . strtoupper($term) . '%');
			$GlobalCondition[] = array('Car.stock LIKE' => '%' . $term . '%');
			$GlobalCondition[] = array('UPPER(brandsAls.brand_name) LIKE' => '%' . strtoupper($term) . '%');
			$GlobalCondition[] = array('UPPER(car_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');
			$GlobalCondition[] = array('UPPER(vehicle_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');
		}

		if (isset($_POST['CarType']) && $_POST['CarType'] != "") {
			$Condition[] = array('Car.vehicle_type_id' => $_POST['CarType']);
		}

		if (isset($_POST['fuel']) && count($_POST['fuel']) > 0) {
			$Condition[] = array('Car.fuel' => $_POST['fuel']);
		}

		if (isset($_POST['transmission']) && count($_POST['transmission']) > 0) {
			$Condition[] = array('Car.transmission' => $_POST['transmission']);
		}

		if (@$_POST['brand'] != "") {
			$Condition[] = array('Car.brand_id' => array($_POST['brand']));
		}

		if (@$_POST['modal']) {
			$Condition[] = array('Car.car_name_id' => array($_POST['modal']));
		}

		if (@$_POST['YearFrom'] && @$_POST['YearTo'] == '') {

			$Condition[] = array('SUBSTRING(Car.manufacture_year, 4, 4) >=' => $_POST['YearFrom']);
		}

		if (@$_POST['YearFrom'] == '' && @$_POST['YearTo']) {
			$Condition[] = array('SUBSTRING(Car.manufacture_year, 4, 4) <=' => $_POST['YearTo']);
		}

		if (@$_POST['YearFrom'] && @$_POST['YearTo']) {
			$Condition[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($_POST['YearFrom'], $_POST['YearTo']));
		}


		//if(@$_POST['PriceFromRange'] && @$_POST['PriceToRange'])
		{
			if ($this->Session->read('LANGUAGE') == 2) {
				$Condition[] = array('CarPaymentAls.asking_price BETWEEN ? and ?' => array($_POST['PriceFromRange'], $_POST['PriceToRange']));
			} else {
				$Condition[] = array('CarPaymentAls.yen BETWEEN ? and ?' => array($_POST['PriceFromRange'], $_POST['PriceToRange']));
			}
		}

		if (@$_POST['CC']) {
			$data = explode(',', $_POST['CC']);
			$Condition[] = array('Car.cc BETWEEN ? and ?' => array($data[0], $data[1]));
		}

		//if(@$_POST['KMFromRange'] && @$_POST['KMToRange'])
		{
			$Condition[] = array('Car.mileage BETWEEN ? and ?' => array($_POST['KMFromRange'], $_POST['KMToRange']));
		}

		if (isset($_POST['stockId']) && $_POST['stockId'] != "") {
			$Condition[] = array('Car.stock' => $_POST['stockId']);
		}

		if (isset($_POST['chassisNo']) && $_POST['chassisNo'] != "") {
			$Condition[] = array('Car.cnumber' => $_POST['chassisNo']);
		}

		$this->Car->unbindModelAll();

		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'sale_price,id,yen,user_id,asking_price,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));

		if ($_POST['recordOrder'] == 1) {
			$order = 'Car.id DESC';
		}

		if ($_POST['recordOrder'] == 2) {
			if ($this->Session->read('LANGUAGE') == 2) {
				$order = 'CarPaymentAls.asking_price ASC';
			} else {
				$order = 'CarPaymentAls.yen ASC';
			}
		}

		if ($_POST['recordOrder'] == 3) {
			if ($this->Session->read('LANGUAGE') == 2) {
				$order = 'CarPaymentAls.asking_price DESC';
			} else {
				$order = 'CarPaymentAls.yen DESC';
			}
		}

		if ($_POST['recordOrder'] == 4) {
			$order = 'Car.most_view DESC';
		}

		if ($_POST['recordOrder'] == 5) {
			$order = 'Car.recommended DESC';
		}

		if ($userflag == 0) { // If user logged in\
			$start = date('Y-m-d');
			$end = date('Y-m-d', strtotime('-6 month'));
			if($this->getGroupID() == 5)
				$cond = array('Car.publish' => array(1, $userflag), 'Car.deleted' => 0, 'Car.groupid' => $this->getSellUserPermissionAccess(), 'CarPaymentAls.created_on <=' => $start, 'CarPaymentAls.created_on >=' => $end);
			else
				$cond = array('Car.publish' => array(1, $userflag), 'Car.deleted' => 0, 'CarPaymentAls.created_on <=' => $start, 'CarPaymentAls.created_on >=' => $end);

		} else {
			$cond = array('Car.groupid' => $this->getGuestPermissionAccess());
		}

		if (@$_POST['data']['Home']['stock'] || @$_POST['data']['Home']['cnumber']) {


			$this->paginate = array('limit' => 12, 'fields' => array("CarPaymentAls.*", "CarName.*", 'Car.*'),
				'conditions' => array('OR' => array(array('Car.publish' => array(1, $userflag), 'Car.deleted' => 0, $Condition), array($Condition, $cond))), 'page' => $_POST['CurrentPage'], 'order' => $order, 'joins' => array(
					array(
						'alias' => 'CarPaymentAls',
						'table' => 'car_payments',
						'type' => 'left',
						'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
					)
				));

		} else {

			if($this->getGuestPermission())
				$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0 , 'Car.groupid' => $this->getGuestPermissionAccess() , $Condition, 'AND' => array('OR' => $GlobalCondition));
			else if($this->getGroupID() == 5)
				$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0 , 'Car.groupid' => $this->getSellUserPermissionAccess() , $Condition, 'AND' => array('OR' => $GlobalCondition));
			else
				$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0, $Condition, 'AND' => array('OR' => $GlobalCondition));

				$this->paginate = array('limit' => 12, 'fields' => array("CarPaymentAls.*", "CarName.*", 'Car.*'),
					'conditions' => $condition2,
					'page' => $_POST['CurrentPage'], 'order' => $order, 'joins' => array(
						array(
							'alias' => 'CarPaymentAls',

										'table' => 'car_payments',
							'type' => 'LEFT',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						),
						array(
							'alias' => 'brandsAls',
							'table' => 'brands',
							'type' => 'INNER',
							'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0 '
						)
					,
						array(
							'alias' => 'car_typesAls',
							'table' => 'car_types',
							'type' => 'INNER',
							'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
						),
						array(
							'alias' => 'vehicle_typesAls',
							'table' => 'vehicle_types',
							'type' => 'LEFT',
							'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
						)
					));
		}
		$carDetails = $this->Paginator->paginate('Car');
		$this->set('showAllCar', $carDetails);
	}

	/*  function for country login  */

	function client_login($cId = null, $Pwd = null)
	{
		$Cdata = $this->Country->find('first', array('conditions' => array('Country.id' => $cId, 'Country.password' => $Pwd)));
		//pr($Cdata);
		//	$Readsession=array($Pwd,$cId);
		if ($Cdata) {
			$countryData = array();
			$countryData = $this->Session->read('clientLogin');
			$countryData[] = $cId;
			if ($this->Session->write('clientLogin', $countryData)) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function check_client_login($country)
	{
		$cl = $this->Session->read('clientLogin');    //get client_login details from session
		//pr($cl);
		if (is_array($cl)) { //check if user has a session for any of country
			if (in_array($country, $cl)) {
				return true;
			} else {
				return false;

			}
		} else {
			return false;
		}

	}


	/*  code for sending mail from parts  */
	function request_car()
	{

		set_time_limit(600);
		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'OrderACar')));
		$this->set('order_a_car', $result['Page']['content']);

		/* SMTP Options */
		if ($this->request->isPost()) {
			$this->Home->set($this->data);
			if ($this->Home->homeValidate()) {
				/*$this->Email->smtpOptions = array(
					 'port'=>'465',
					 'timeout'=>'30',
					 'host' => 'smtpout.secureserver.net',
					 'username'=> EMAIL_ACCOUNT,
					 'password'=> EMAIL_PASSWORD,
					);*/
				$this->Email->to = EMAIL_ACCOUNT;
				$this->Email->subject = 'UK Car Tokyo Client Mail';
				$this->Email->from = EMAIL_ACCOUNT;
				$this->Email->sendAs = 'html';


				$clientMailSend = $this->Email->send('<table celpadding="5">
								<tr> 
									<td>Stock No:</td><td>' . @$this->data['Home']['stock'] . '</td>
								</tr>
								<tr>
									<td>Name :</td><td>' . $this->data['Home']['name'] . '</td>
								</tr>
								<tr>
									<td>Email :</td><td>' . $this->data['Home']['email'] . '</td>
								</tr>
								<tr>
									<td>Contact :</td><td>' . $this->data['Home']['contact'] . '</td>
								</tr>
								<tr>
									<td>Make :</td><td>' . $this->data['Home']['make'] . '</td>
								</tr>
								<tr>
									<td>Model :</td><td>' . $this->data['Home']['model'] . '</td>
								</tr>
								<tr>
									<td>Year :</td><td>' . $this->data['year'] . '</td>
								</tr>
								<tr>
									<td>Country :</td><td>' . $this->data['country'] . '</td>
								</tr>
								<tr>
									<td>Comment :</td><td>' . $this->data['Home']['comment'] . '</td>
								</tr>
								</table>	
								');

				if ($clientMailSend) {
					$this->Session->setFlash('Your Request has been successfully received !');
					//Second email
					$this->Email->to = $this->data['Home']['email'];
					$this->Email->subject = 'Regarding Info';
					$this->Email->from = EMAIL_ACCOUNT;
					if ($this->Email->send("Thank you , We will contact you soon! ")) {

						$this->Session->setFlash('Your Request has been successfully received !');
						$this->redirect(array('action' => 'request_car'));
					} else {
						echo $this->Email->smtpError;
					}
				} else {
					$this->Session->setFlash('Error on sending email !');
				}
			}

		} else {
			$errors = $this->Home->invalidFields();

		}
	}

	/*  function for the submit form for new bid user  */

	public function Guest()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$this->Bid->set($this->data);
			if ($this->Bid->bidValidate()) {
				if (!empty($this->data)) {
					$currDate = date('Y-m-d');
					$this->request->data['Bid']['date'] = $currDate;
					$retData = $this->Bid->save($this->data);
					if ($retData) {
						echo json_encode(array('status' => 'success', 'data' => $retData, 'message' => "Your Bid Save Successfully!"));

					}
				}
			} else {

				echo json_encode(array("status" => "error", "message" => $this->Bid->validationErrors));
			}
		}
	}


	/*  function for the submit form for how to buy  */
	function how_to_buy()
	{

		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'HowToBuy')));
		// return $result['Page']['content'];
		$this->set('content', $result['Page']['content']);


	}

	function request_part()
	{

		set_time_limit(600);
		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'OrderAPart')));
		$this->set('order_a_part', $result['Page']['content']);

		/* SMTP Options */
		if (!empty($this->data)) {

			$this->Home->set($this->data);
			if ($this->Home->homeValidate()) {


				/*$this->Email->smtpOptions = array(
                          'port'=>'465',
                          'timeout'=>'30',
                          'host' => 'smtp.gmail.com',
                          'username'=> 'uktoyama@ukcarstokyo.com',
                          'password'=> 'test@123',
                         );*/

				$this->Email->to = EMAIL_ACCOUNT;
				$this->Email->subject = 'UK cars tokyo client mail';

				$this->Email->from = EMAIL_ACCOUNT;
				$this->Email->sendAs = 'html';
				$this->Email->send('<table celpadding="5">
								<tr>
									<td>Name :</td><td>' . $this->data['Home']['name'] . '</td>
								</tr>
								<tr>
									<td>Email :</td><td>' . $this->data['Home']['email'] . '</td>
								</tr>
								<tr>
									<td>Contact :</td><td>' . $this->data['Home']['contact'] . '</td>
								</tr>
								<tr>
									<td>Make :</td><td>' . $this->data['Home']['make'] . '</td>
								</tr>
								<tr>
									<td>Model :</td><td>' . $this->data['Home']['model'] . '</td>
								</tr>
								<tr>
									<td>Year :</td><td>' . $this->data['year'] . '</td>
								</tr>
								<tr>
									<td>Country :</td><td>' . $this->data['country'] . '</td>
								</tr>
								<tr>
									<td>Comment :</td><td>' . $this->data['Home']['comment'] . '</td>
								</tr>
								<tr>
									<td>Part :</td><td>' . @$this->data['Home']['part'] . '</td>
								</tr>
								</table>	
								');
				//Second email
				$this->Email->to = $this->data['Home']['email'];
				$this->Email->subject = 'Regarding Info';
				$this->Email->from = EMAIL_ACCOUNT;

				if ($this->Email->send("Thank you , We will contact you soon!")) {

					$this->Session->setFlash('Your Request has been successfully received !');
					$this->redirect(array('action' => 'request_part'));
				}
			}
		} else {
			$errors = $this->Home->invalidFields();

		}

	}

	//search data according to car type

	function cartype_search()
	{

		$brandId = $this->passedArgs['brand'];
		$carNameId = $this->passedArgs['car_name'];
		$vehicleTypeId = $this->passedArgs['vehicleType'];


		$showAllArrival = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.brand_id' => $brandId, 'Car.vehicle_type_id' => $vehicleTypeId, 'Car.car_name_id' => $carNameId)));
		$this->set('showAllArrival', $showAllArrival);
		$this->set('brandId', $brandId);
		$this->set('vehicleTypeId', $vehicleTypeId);
		$this->set('carNameId', $carNameId);

		//$brandArr = array();
		//$carNameArr = array();


		/*foreach($showAllArrival as $value)
		{
			$brandArr[$value['Brand']['id']] = $value['Brand']['brand_name'];
			$carNameArr[$value['CarName']['id']] = $value['CarName']['car_name'];
		}

		$this->set('brandArr',$brandArr);
		$this->set('carNameArr',$carNameArr);*/

		$caryear = $this->Car->find('all', array('fields' => array('SUBSTR(Car.manufacture_year, 3 ) AS Year'), 'conditions' => array('AND' => array('Car.publish' => 1)), 'group' => array('Year'), 'order' => array('Year DESC')));
		foreach ($caryear as $cy) {

			//pr($cy['0']['Year']);
			$option[trim($cy['0']['Year'])] = $cy['0']['Year'];
		}
		$this->set('option_year', $option);


		$Brand = $this->Brand->find('list', array('fields' => array('id', 'brand_name')));
		$this->set('brandArr', $Brand);

		$carName = $this->CarName->find('list', array('fields' => array('id', 'car_name')));
		$this->set('carNameArr', $carName);


		$con = array();
		if ($this->request->is('post')) {

			if (@$this->data['yearFrom'] && @$this->data['yearTo'] == '') {
				$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['yearFrom']);
			}
			if (@$this->data['yearFrom'] == '' && @$this->data['yearTo']) {
				$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['yearTo']);
			}

			if (@$this->data['yearFrom'] && @$this->data['yearTo']) {

				$con[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->data['yearFrom'], $this->data['yearTo']));

			}
			if (@$this->data['cc']) {
				$data = explode(',', $this->data['cc']);
				//$con[] = array('Car.cc BETWEEN ? and ?' => array($data[0],$data[1]));
				$con[] = array('Car.cc BETWEEN ' . $data[0] . ' AND ' . $data[1]);

			}
			if (@$this->data['model']) {
				$con[] = array('CarName.id' => $this->data['model']);

			}
			if (@$this->data['brand_name']) {
				$con[] = array('Brand.id' => $this->data['brand_name']);

			}

			if (!empty($this->data)) {
				//$showAllArrival=$this->Car->find('all',array('conditions'=>array('Car.publish'=>1,'Car.brand_id'=>$brandId,'Car.vehicle_type_id'=>$vehicleTypeId)));


				$showAllArrival = $this->Car->find('all', array('conditions' => array('AND' => array($con), 'Car.publish' => 1, 'Car.vehicle_type_id' => $vehicleTypeId)));//'Car.brand_id'=>$brandId

				$this->set('showAllArrival', $showAllArrival);
				//$this->render('all_car');
			}
		}


		$this->render('car_show');
		$this->layout = null;

	}


	public function update_saleprice()
	{
		$this->autoRender = false;
		$price = $this->data['price'];
		$id = $this->data['id'];
		$this->CarPayment->read(null, $id);
		$this->CarPayment->set('sale_price', $price);
		$update = $this->CarPayment->save();
		if ($update) {
			echo json_encode(array("status" => "success", "message" => "Sale Price is successfully Update!"));
		} else {
			echo json_encode(array("status" => "error", "message" => "Sale Price is not Update!"));
		}

	}

	// close function cartype_search

	function chasis_check()
	{
	}


	function shipping_schedule()
	{
		$region = $this->Shipschedule->find('all', array('conditions' => array('Shipschedule.status' => 0), 'group' => 'Shipschedule.region'));
		$regionWithAfrica = $this->Shipschedule->find('all', array('conditions' => array('Shipschedule.region' => 'AFRICA', 'Shipschedule.status' => 0)));

		$data1 = $this->Shipschedule->find('all', array('fields' => array('DISTINCT Shipschedule.ship_name'), 'conditions' => array('Shipschedule.status' => 0)));
		$data2 = $this->Shipschedule->find('all', array('fields' => array('DISTINCT Shipschedule.departure_port'), 'conditions' => array('Shipschedule.status' => 0)));

		$data3 = $this->Shipschedule->find('all', array('fields' => array('DISTINCT Shipschedule.arrival_port'), 'conditions' => array('Shipschedule.status' => 0)));

		//pr($data);
		$dataRegion = array();
		$dataShipName = array();
		$dataDepPort = array();
		$dataArrPort = array();
		foreach ($data1 as $value) {
			$dataShipName[$value['Shipschedule']['ship_name']] = $value['Shipschedule']['ship_name'];
		}
		foreach ($data2 as $value) {
			$dataDepPort[$value['Shipschedule']['departure_port']] = $value['Shipschedule']['departure_port'];
		}
		foreach ($data3 as $value) {
			$dataArrPort[$value['Shipschedule']['arrival_port']] = $value['Shipschedule']['arrival_port'];
		}
		foreach ($region as $value) {
			$dataRegion[$value['Shipschedule']['region']] = $value['Shipschedule']['region'];
		}
		$this->set('region', $dataRegion);
		$this->set('dataShipName', $dataShipName);
		$this->set('dataDepPort', $dataDepPort);
		$this->set('dataArrPort', $dataArrPort);
		$this->set('regionWithAfrica', $regionWithAfrica);

	}

	public function ship_schedule_search()
	{
		$con = array();
		if ($this->data['region']) {
			$con[] = array('Shipschedule.region' => $this->data['region']);
		}
		if ($this->data['shipName']) {
			$con[] = array('Shipschedule.ship_name' => $this->data['shipName']);
		}
		if ($this->data['departureDate']) {
			$dDate = date('Y-m-d', strtotime($this->data['departureDate']));
			$con[] = array('Shipschedule.departure_date' => $dDate);;
		}
		if ($this->data['departure_port']) {
			$con[] = array('Shipschedule.departure_port' => $this->data['departure_port']);
		}
		if ($this->data['arrivalPort']) {
			$con[] = array('Shipschedule.arrival_port' => $this->data['arrivalPort']);
		}
		if ($this->data['arrivalDate']) {
			$aDate = date('Y-m-d', strtotime($this->data['arrivalDate']));
			$con[] = array('Shipschedule.arrival_date' => $aDate);
		}
		$searchReport = $this->Shipschedule->find('all', array('conditions' => array('AND' => $con, 'Shipschedule.status' => 0)));
		$this->set('searchReport', $searchReport);

	}


	function search_location()
	{            //function for searching based on location
		//$countrytype=$this->Car->find('all' , array('conditions'=>array('Car.purchase_country_id'=> @$this->passedArgs['country'],'Car.publish'=>1,'CarPayment.user_id'=>0,'Car.car_type_id'=>1)));

		$carNameId = $this->passedArgs['car_name'];
		$brandId = $this->passedArgs['brand'];


		$countrytype = $this->Car->find('all', array('conditions' => array('Car.car_name_id' => $carNameId, 'Car.purchase_country_id' => @$this->passedArgs['country'], 'Car.publish' => 1, 'CarPayment.user_id' => 0), 'recursive' => 2));
		$this->set('countrytype', $countrytype);


	}

	function all_car()
	{

		### Start Get  All data form here related to quick Search###

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('Country' => array('fields' => ''))));
		$fields = array('Country.id', 'Country.country_name', 'Country.country_image', 'COUNT(Car.id) as Total', 'Car.id');
		$group = array('Car.country_id');


		if (@$this->data['Home']['cnumber']) {
			$carDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => array('Country.order' => 'ASC'), 'conditions' => array('AND' => array('Country.status' => 0))));
		} else {
			$carDetail = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => array('Country.order' => 'ASC'), 'conditions' => array('AND' => array('Country.status' => 0, 'Car.publish' => 1))));
		}


		$this->Car->unbindModelAll();
		$carManufaturer = $this->Car->find('all', array('fields' => array('Car.manufacture_year'), 'conditions' => array('Car.car_type_id' => 1), 'order' => array('Car.manufacture_year' => 'ASC')));

		$this->set('carManufaturer', $carManufaturer);
		$this->set('carDetail', $carDetail);

		$Brand = $this->Brand->find('all');
		$this->set('Brand', $Brand);

		$carName = $this->CarName->find('all');
		$this->set('carName', $carName);

		$caryear = $this->Car->find('all', array('fields' => array('SUBSTR(Car.manufacture_year, 3 ) AS Year'), 'conditions' => array('AND' => array('Car.publish' => 1)), 'group' => array('Year'), 'order' => array('Year DESC')));
		foreach ($caryear as $cy) {

			//pr($cy['0']['Year']);
			$option[trim($cy['0']['Year'])] = $cy['0']['Year'];
		}
		$this->set('option_year', $option);

		## End For Get Data		##
		##Start Show All Car form here	##

		$con = array();

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('Country' => array('fields' => 'id,country_name'), 'CarName' => array('fields' => 'car_name,id'), 'Brand' => array('fields' => 'brand_name,id')), 'hasMany' => array('CarPayment' => array('fields' => 'yen,asking_price,sale_price,id,user_id,currency,updated_on,push_price'), 'CarImage' => array('fields' => 'car_id,image_source,image_name', 'order' => array('image_name' => 'ASC')))));


		if (@$this->data['Home']['yearFrom'] && @$this->data['Home']['yearTo'] == '') {

			$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['Home']['yearFrom'], 'Car.publish' => 1);
		}

		if (@$this->data['Home']['yearFrom'] == '' && @$this->data['Home']['yearTo']) {
			$con[] = array('SUBSTRING(Car.manufacture_year, 4, 4)' => $this->data['Home']['yearTo'], 'Car.publish' => 1);
		}

		if (@$this->data['Home']['yearFrom'] && @$this->data['Home']['yearTo']) {
			$con[] = array('SUBSTRING(manufacture_year,4,4) BETWEEN ? and ?' => array($this->data['Home']['yearFrom'], $this->data['Home']['yearTo']), 'Car.publish' => 1);
			//print_r($con);
		}

		if (@$this->data['Home']['cc']) {
			$data = explode(',', $this->data['Home']['cc']);

			$con[] = array('Car.cc BETWEEN ' . $data[0] . ' AND ' . $data[1], 'Car.publish' => 1);
		}
		if (@$this->data['Home']['model']) {
			$con[] = array('CarName.id' => $this->data['Home']['model'], 'Car.publish' => 1);
		}
		if (@$this->data['Home']['brand_name']) {
			$con[] = array('Brand.id' => $this->data['Home']['brand_name'], 'Car.publish' => 1);
		}
		if (@$this->data['Home']['country_name']) {
			$con[] = array('Country.id' => $this->data['Home']['country_name'], 'Car.publish' => 1);
		}
		if (@$this->data['Home']['stock']) {
			$con[] = array('stock' => $this->data['Home']['stock'], 'Car.publish' => 1);
		}
		if (@$this->data['Home']['cnumber']) {
			$con[] = array('cnumber' => $this->data['Home']['cnumber']);
		}
		//print_r($con);
		//print_r($con);die;'Car.car_type_id'=>1
		if (!empty($this->data)) {
			$showAllCar = $this->Car->find('all', array('conditions' => array('OR' => array($con), 'Car.new_arrival' => 0)));
			$this->set('showAllCar', $showAllCar);
			$this->render('all_car');

		}
		//echo "<pre>";
		//print_r($showAllCar);die;

	}

	## end Showing All Car##


	function cartype_car_list()
	{
		$brandData = $this->Car->find('all', array('conditions' => array('Car.new_arrival' => 1), 'group' => array('Car.brand_id')));
		$this->set('brandCount', count($brandData));

		$carRelatedtoCountry = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 1)));
		$this->set('carCount', count($carRelatedtoCountry));
		$this->Car->unbindModelAll();


		if (isset($this->passedArgs['brand'])) {
			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'conditions' => array('Brand.id' => $this->passedArgs['brand']), 'order' => array('Brand.priority ASC')));
			$countryName = $this->Country->find('first', array('fields' => 'country_name,id'));

			$this->set('brandName', $brandName);
			$this->set('countryName', $countryName);

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 1);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $this->passedArgs['brand'], 'Car.publish' => 1, 'Car.new_arrival' => 1), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			$this->set('CBrand', $CBrand);
		} else {
			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'order' => array('Brand.priority ASC')));
			$countryName = $this->Country->find('first', array('fields' => 'country_name,id'));

			$this->set('brandName', $brandName);
			$this->set('countryName', $countryName);
			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 1);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $brandName['Brand']['id'], 'Car.publish' => 1, 'Car.new_arrival' => 1, 'Car.vehicle_type_id' => $this->passedArgs['cartype']), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			$this->set('CBrand', $CBrand);
		}

	}

	function arrival_car_brand()
	{
		if (isset($this->passedArgs['brand'])) {

			$brandData = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $this->passedArgs['type']), 'group' => array('Car.brand_id')));
			$this->set('brandCount', count($brandData));

			$carRelatedtoCountry = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $this->passedArgs['type'])));
			$this->set('carCount', count($carRelatedtoCountry));
			$this->Car->unbindModelAll();

			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'conditions' => array('Brand.id' => $this->passedArgs['brand']), 'order' => array('Brand.priority ASC')));
			//$countryName = $this->Country->find('first',array('fields'=>'country_name,id'));

			$this->set('brandName', $brandName);
			//$this->set('countryName',$countryName);

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $this->passedArgs['type']);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id', 'Car.vehicle_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $this->passedArgs['brand'], 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $this->passedArgs['type']), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			$this->set('CBrand', $CBrand);
		} else {
			//echo $conArr = explode(',',$this->passedArgs['cartype']);
			//print_r($conArr);
			$conArr = $this->passedArgs['cartype'];

			$brandData = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.vehicle_type_id' => $conArr, 'Car.new_arrival' => 0), 'group' => array('Car.brand_id')));
			$this->set('brandCount', count($brandData));

			$carRelatedtoCountry = $this->Car->find('count', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $conArr)));
			$this->set('carCount', $carRelatedtoCountry);
			$this->Car->unbindModelAll();

			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'order' => array('Brand.priority ASC')));

			//$countryName = $this->Country->find('first',array('fields'=>'country_name,id'));

			$this->set('brandName', $brandName);
			//$this->set('countryName',$countryName);
			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $conArr);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id', 'Car.vehicle_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $brandName['Brand']['id'], 'Car.publish' => 1, 'Car.new_arrival' => 0, 'Car.vehicle_type_id' => $conArr), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			$this->set('CBrand', $CBrand);
		}


	}

	function pay_detail_search()
	{

		$id = $this->Session->read('UserAuth.User.id');
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));

		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));

		$payConditions = array('ClientPaymentHistory.payment_date BETWEEN ? and ?' => array($fromDate, $toDate), array('ClientPaymentHistory.client_id' => $id));

		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => $payConditions, 'order' => array('ClientPaymentHistory.payment_date DESC')));
		$data_array = array('from_date' => $fromDate, 'toDate' => $toDate);
		$this->set('PaymentDetails', $PaymentDetails);

	}

	function buy_detail_search()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));

		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));

		$SaleDetails = $this->getInvoiceDetailsByUserWithDate($id, $fromDate, $toDate);
		$this->set('SaleDetails', $SaleDetails);

	}

	function sale_detail_search()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));

		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));

		$SaleDetails = $this->getInvoiceDetailsByUserWithDate($id, $fromDate, $toDate, 'sell');
		$this->set('SaleDetails', $SaleDetails);

	}

	/*  this function used for check doc status   */

	public function docStatus()
	{


		$carId = $this->data['cId'];
		$type = $this->data['status'];
		$this->Car->read(null, $carId);
		$this->Car->set('doc_status', $type);

		$update = $this->Car->save();
		if ($update) {
			if ($type == 1) {
				echo json_encode(array("status" => "checked", "message" => ""));
			} else {
				echo json_encode(array("status" => "unchecked", "message" => ""));
			}
		}
		die;
	}

	public function doc_status_mail()
	{

		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$currDate = date('d-m-Y');
			$idTArr = array();
			$idFArr = array();
			$statusArr = array();
			$payData = $this->ClientPaymentHistory->find('first', array('fields' => array('sum(ClientPaymentHistory.amount) as Price'), 'conditions' => array('ClientPaymentHistory.client_id' => $this->Session->read('UserAuth.User.id'))));
			foreach ($this->data as $values) {
				foreach ($values as $key => $val) {
					if ($val == "true") {
						$idTArr[] = $key;
						$priceTotal = $this->CarPayment->find('first', array('fields' => array('sum(CarPayment.sale_price) as TotalPrice'), 'conditions' => array('CarPayment.user_id' => $this->Session->read('UserAuth.User.id'), 'CarPayment.car_id' => $idTArr)));
						if ($priceTotal[0]['TotalPrice'] < $payData[0]['Price']) {
							$Result = $this->Car->find('all', array('fields' => array('Car.doc_status', 'Car.user_doc_status'), 'conditions' => array('Car.id' => $idTArr)));
							foreach ($Result as $rval) {

								if ($rval['Car']['doc_status'] == 1 && $rval['Car']['user_doc_status'] == 1) {
									//echo json_encode(array("status"=>"successAlready","message"=>"You are already recived document!"));
								} else {

									foreach ($idTArr as $valId) {

										$type = 1;
										$this->Car->read(null, $valId);
										$this->Car->set('user_doc_status', $type);
										$this->Car->set('user_doc_updated', $currDate);
										$update = $this->Car->save();
									}
									if ($update) {
										$UserData = $this->CarPayment->find('all', array('conditions' => array('CarPayment.user_id' => $this->Session->read('UserAuth.User.id'), 'CarPayment.car_id' => $idTArr, 'Car.user_doc_status' => 1)));
										$userUniqueId = $UserData[0]['User']['uniqueid'];
										$firstName = $UserData[0]['User']['first_name'];
										$lastName = $UserData[0]['User']['last_name'];
										$email = $UserData[0]['User']['email'];

										$mailSendId = $this->Home->getMailDetailsByUser($this->Session->read('UserAuth.User.id'), $idTArr);
										$chassisNumber = '';
										$uniqueId = '';
										$data = '';
										foreach ($mailSendId as $mail) {
											if (strlen(trim($mail['Logistic']['created'])) > 0) {

												$chassisNumber .= $mail['Car']['cnumber'] . ",";
												$uniqueId .= $mail['Car']['uniqueid'] . ",";
												$data = "Hello........ This  mail for shipping document,Car chassis number is:" . $chassisNumber . " Unique Id is:" . $uniqueId . " Coustomer id is:" . $userUniqueId . ",Client name :" . $firstName . '  ' . $lastName . " ";
											}
										}
										$this->Email->to = EMAIL_ACCOUNT;
										$this->Email->subject = 'UK car tokyo Doc Mail';
										$this->Email->from = $email;

										$this->Email->delivery = 'smtp';
										$sendMail = $this->Email->send($data);
										if ($sendMail) {
											echo json_encode(array("status" => "successSave", "message" => "Your mail is successfully send!"));
										} else {
											echo $this->Email->smtpError;
										}
									} else {
										echo json_encode(array("status" => "successSaveErr", "message" => "Your data not updated!"));
									}

								}
							}
						} else {
							echo json_encode(array("status" => "successSave", "message" => "You have not a sufficient payment!"));
						}
					} else {
						$idFArr[] = $key;
						foreach ($idFArr as $valId) {
							$type = 0;
							$this->Car->read(null, $valId);
							$this->Car->set('user_doc_status', $type);
							$this->Car->set('user_doc_updated', $currDate);
							$update = $this->Car->save();
						}
						if ($update) {
							$UserData = $this->CarPayment->find('all', array('conditions' => array('CarPayment.user_id' => $this->Session->read('UserAuth.User.id'), 'CarPayment.car_id' => $idFArr)));

							$userUniqueId = $UserData[0]['User']['uniqueid'];
							$firstName = $UserData[0]['User']['first_name'];
							$lastName = $UserData[0]['User']['last_name'];
							$email = $UserData[0]['User']['email'];

							$mailSendId = $this->Home->getMailDetailsByUser($this->Session->read('UserAuth.User.id'), $idFArr);
							$chassisNumber = '';
							$uniqueId = '';
							$data = '';
							foreach ($mailSendId as $mail) {
								if (strlen(trim($mail['Logistic']['created'])) > 0) {

									$chassisNumber .= $mail['Car']['cnumber'] . ",";
									$uniqueId .= $mail['Car']['uniqueid'] . ",";
									$data = "Hello........ This  mail for cancel shipping document,Car chassis number is:" . $chassisNumber . " Unique Id is:" . $uniqueId . " Coustomer id is:" . $userUniqueId . ",Client name :" . $firstName . '  ' . $lastName . " ";
								}
							}
							$this->Email->to = EMAIL_ACCOUNT;//
							$this->Email->subject = 'UK car tokyo Doc Mail';
							$this->Email->from = $email;

							$this->Email->delivery = 'smtp';
							$sendMail = $this->Email->send($data);
							if ($sendMail) {
								echo json_encode(array("status" => "successCancel", "message" => "Your mail is successfully send!"));
							} else {
								echo $this->Email->smtpError;
							}
						} else {
							echo json_encode(array("status" => "successCancelErr", "message" => "Your data not updated!"));
						}
					}
				}
			}

		}


	}

	public function search_shipping_company()
	{
		$this->autoRender = false;

		$shipName = $this->Shipschedule->find('all', array('fields' => array('DISTINCT Shipschedule.ship_name'), 'conditions' => array('Shipschedule.status' => 0, 'Shipschedule.region' => $this->data['region'])));

		$shipNameList = array();
		foreach ($shipName as $name) {
			$shipNameList[] = array('shipName' => $name['Shipschedule']['ship_name']);
		}
		echo json_encode($shipNameList);
	}

	public function clear_pay_detail_search()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => array('ClientPaymentHistory.client_id' => $id), 'order' => array('ClientPaymentHistory.payment_date' => 'DESC')));
		$this->set('PaymentDetails', $PaymentDetails);

	}

	public function allHeavyBrand()
	{
		$carType = $this->passedArgs['vtype'];
		$type = $this->passedArgs['type'];
		$brandId = $this->passedArgs['brand'];
		$this->set('carType', $carType);
		$this->Car->unbindModelAll();


		$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'conditions' => array('Brand.id' => $brandId), 'order' => array('Brand.priority ASC')));
		$this->set('brandName', $brandName);


		$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => 'brand_image,brand_name,id'))));
		$brandDetail = $this->Car->find('all', array('fields' => array('DISTINCT Car.brand_id', 'Car.car_type_id', 'Car.vehicle_type_id'), 'conditions' => array('Car.car_type_id' => $type, 'Car.publish' => 1), 'order' => array('Brand.brand_name' => 'ASC'), 'recursive' => 2));

		$this->set('brandDetail', $brandDetail);

		$this->Car->unbindModelAll();
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));

		$carNames = $this->Car->find('all', array('fields' => array('DISTINCT car_name_id', 'Car.car_type_id', 'Car.vehicle_type_id'), 'conditions' => array('Car.car_type_id' => $type, 'Car.vehicle_type_id' => $carType, 'Car.publish' => 1), 'order' => array('CarName.car_name' => 'ASC'), 'recursive' => 2));

		$this->set('carNames', $carNames);


	}


	function arrival_car_list()
	{
		$currdate = date('Y-m-d H:i:s');
		$brandData = $this->Car->find('all', array('conditions' => array('Car.new_arrival' => 1), 'group' => array('Car.brand_id')));
		$this->set('brandCount', count($brandData));

		$carRelatedtoCountry = $this->Car->find('all', array('conditions' => array('Car.publish' => 1, 'Car.new_arrival' => 1)));
		$this->set('carCount', count($carRelatedtoCountry));
		$this->Car->unbindModelAll();


		if (isset($this->passedArgs['brand'])) {
			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'conditions' => array('Brand.id' => $this->passedArgs['brand']), 'order' => array('Brand.priority ASC')));
			$countryName = $this->Country->find('first', array('fields' => 'country_name,id'));

			$this->set('brandName', $brandName);
			$this->set('countryName', $countryName);

			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 1);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $this->passedArgs['brand'], 'Car.publish' => 1, 'Car.new_arrival' => 1), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			//pr($CBrand);die;
			$this->set('CBrand', $CBrand);
		} else {
			$brandName = $this->Brand->find('first', array('fields' => array('Brand.brand_name,Brand.id'), 'order' => array('Brand.priority ASC')));
			$countryName = $this->Country->find('first', array('fields' => 'country_name,id'));

			$this->set('brandName', $brandName);
			$this->set('countryName', $countryName);
			$this->Car->bindModel(array('belongsTo' => array('Brand' => array('fields' => array('')))));
			$condition = array('Car.publish' => 1, 'Car.new_arrival' => 1);
			$fields = array('COUNT(Car.brand_id) as TotalCar', 'Brand.id', 'Brand.brand_name', 'Brand.brand_image', 'Car.car_type_id');
			$group = array('Car.brand_id');
			$order = array('Brand.priority');

			$CBrand = $this->Car->find('all', array('fields' => $fields, 'group' => $group, 'order' => $order, 'conditions' => $condition, 'recursive' => 2));

			$CarList = $this->Car->find('all', array('group' => array('Car.car_name_id'), 'conditions' => array('Car.brand_id' => $brandName['Brand']['id'], 'Car.publish' => 1, 'Car.new_arrival' => 1), 'order' => array('CarName.car_name' => 'ASC')));

			$this->set('CarList', $CarList);
			$this->set('CBrand', $CBrand);
		}

	}

	//   for get current doller to yen convert rate

	public function current_doller_to_yen_rate()
	{
		$this->autoRender = false;
		$this->Session->write('yenRate', $this->data['newrate']);
		echo $this->Session->read('yenRate');

	}


	public function all_history_search_detail()
	{
		$car_id = $this->data['id'];
		$result = $this->getInvoiceDetailsByCarId($car_id);

		$this->set('SaleDetails', $result);

	}

	public function clear_all_history_search_detail()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$car_id = $this->data['id'];
		$result = $this->getInvoiceDetailsByUser($id);

		$this->set('SaleDetails', $result);

		$this->layout = null;
		$this->render('all_history_search_detail');

	}

	public function clear_all_buy_history_search_detail()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$car_id = $this->data['id'];
		//pr($this->data);die;
		$result = $this->getInvoiceDetailsByUser($id);
		$this->set('SaleDetails', $result);

		$this->layout = null;
		$this->render('car_detail_search');

	}

	public function clear_all_sell_history_search_detail()
	{
		$id = $this->Session->read('UserAuth.User.id');
		$car_id = $this->data['id'];
		//pr($this->data);die;
		$result = $this->getInvoiceDetailsByUser($id, 'sell');
		$this->set('SaleDetails', $result);

		$this->layout = null;
		$this->render('sell_car_detail_search');

	}


	public function getInvoiceDetailsByCarId($car_id)
	{
		$result = $this->User->query('SELECT Logistic.remark,Car.user_doc_updated,Logistic.ship_port,Logistic.departure_date,Logistic.destination_port,Logistic.arrival_date,
Logistic.port_remark,Port.port_name,CarPayment.updated_on,Car.manufacture_year,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,CarPayment.currency,
Logistic.created,CarPayment.yen,CarPayment.sale_price, CarPayment.updated_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable,
 Car.brand_id, Car.stock, Logistic.status, Logistic.remark, Shipping.company_name, CarPayment.psale_freight, Logistic.bl_no, Car.consignee
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					LEFT JOIN ports AS Port ON Port.id = Logistic.port_id
					WHERE CarPayment.car_id =' . $car_id . '  AND  CarPayment.deleted = 0');
		return $result;
	}

	public function max_bid_with_currency()
	{
		$result = $this->Bid->find('first', array('conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.currency_type' => $this->data['curr_type']), 'fields' => array('MAX(Bid.amount) AS Amount', 'currency_type')));

		if ($result) {
			if ($result[0]['Amount']) {
				$amount = $result[0]['Amount'];
			} else {
				$amount = $result[0]['Amount'];
			}
			echo json_encode(array("status" => "success", 'amount' => $amount));
		} else {
			echo json_encode(array("status" => "fail", 'amount' => 0));
		}
		$this->autoRender = false;

	}

	public function max_bid_with_currency_by_user()
	{
		$userId = $this->UserAuth->getUserId();
		$result = $this->Bid->find('first', array('conditions' => array('Bid.car_id' => $this->data['car_id'], 'Bid.currency_type' => $this->data['curr_type'], 'Bid.user_id' => $userId), 'fields' => array('amount', 'currency_type')));
		if ($result) {
			$amount = $result['Bid']['amount'];
			echo json_encode(array("status" => "success", 'amount' => $amount));
		} else {
			echo json_encode(array("status" => "fail", 'amount' => 0));
		}
		$this->autoRender = false;

	}

	public function steps_to_buy()
	{
		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'step_to_buy')));
		$this->set('content', $result['Page']['content']);
	}

	public function steps_to_bid()
	{
		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'step_to_bid')));
		$this->set('content', $result['Page']['content']);
	}

	public function step_to_register()
	{
		$this->loadModel('Page');
		$result = $this->Page->find('first', array('conditions' => array('Page.title' => 'how_to_register')));
		$this->set('content', $result['Page']['content']);
	}


	public function export_payment_xls($data_id)
	{

		$id = $this->UserAuth->getUserId();
		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => array('ClientPaymentHistory.client_id' => $id), 'order' => array('ClientPaymentHistory.payment_date' => 'DESC')));
		$this->set('PaymentDetails', $PaymentDetails);
		$this->render('export_payment_xls', 'export_payment_xls');
	}

	public function export_payment_search_xls()
	{
		$from_date = $this->request->query('from_date');
		$to_date = $this->request->query('to_date');

		$id = $this->Session->read('UserAuth.User.id');
		$fromDate = date("Y-m-d", strtotime($from_date));
		$toDate = date("Y-m-d", strtotime($to_date));

		$payConditions = array('ClientPaymentHistory.payment_date BETWEEN ? and ?' => array($fromDate, $toDate), array('ClientPaymentHistory.client_id' => $id));

		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => $payConditions, 'order' => array('ClientPaymentHistory.payment_date' => 'DESC')));

		$this->set('PaymentDetails', $PaymentDetails);
		$this->render('export_payment_search_xls', 'export_payment_search_xls');
	}


	public function export_buy_history_xls()
	{

		$id = $this->UserAuth->getUserId();
		$SaleDetails = $this->getInvoiceDetailsByUser($id);
		//pr($SaleDetails);die;
		$this->set('SaleDetails', $SaleDetails);

		$this->render('export_sale_history_xls', 'export_sale_history_xls');
	}

	public function export_sale_history_xls()
	{

		$id = $this->UserAuth->getUserId();
		$SaleDetails = $this->getInvoiceDetailsByUser($id, 'sell');
		//pr($SaleDetails);die;
		$this->set('SaleDetails', $SaleDetails);

		$this->render('export_sale_history_xls', 'export_sale_history_xls');
	}

	public function export_sale_history_search_xls()
	{
		$from_date = $this->request->query('from_date');
		$to_date = $this->request->query('to_date');

		$id = $this->Session->read('UserAuth.User.id');
		$fromDate = date("Y-m-d", strtotime($from_date));
		$toDate = date("Y-m-d", strtotime($to_date));

		$SaleDetails = $this->getInvoiceDetailsByUserWithDate($id, $fromDate, $toDate);
		$this->set('SaleDetails', $SaleDetails);

		$this->render('export_sale_history_search_xls', 'export_sale_history_search_xls');
	}

	public function chassis_list()
	{
		$userflag = 1;
		if ($this->UserAuth->isLogged()) {
			$userflag = 0;
		}

		$this->autoRender = false;
		$id = $this->Session->read('UserAuth.User.id');
		$term = $this->request->query['term'];
		$this->Car->unbindModelAll();
		if ($userflag == 1) { // Not Loggedin
			$Cars = $this->Car->find('all', array('fields' => array('id', 'cnumber'),
					'conditions' => array('Car.publish' => 1, 'Car.deleted' => 0, 'Car.cnumber LIKE' => '%' . $term . '%')
				, 'joins' => array(
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'left',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						)
					)
				)

			);
		} else {
			$Cars = $this->Car->find('all', array('fields' => array('id', 'cnumber'),
					'conditions' => array('Car.publish' => array(1, $userflag), 'Car.deleted' => 0, 'Car.cnumber LIKE' => '%' . $term . '%')
				, 'joins' => array(
						array(
							'alias' => 'Carmis',
							'table' => 'car_publish_new_sold',
							'type' => 'INNER',
							'conditions' => '`Carmis`.`id` = `Car`.`id`'
						),
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'left',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						)
					)
				)

			);
		}

		$str = '';
		$result = array();
		foreach ($Cars as $val) {
			$str .= '"' . $val['Car']['cnumber'] . '",';
		}
		$str = rtrim($str, ',');

		$str = '[' . $str . ']';
		echo $str;
	}

	public function globalSearch()
	{
		$this->autoRender = false;
		$this->layout = '';

		$userflag = 1;
		if ($this->UserAuth->isLogged()) {
			$userflag = 0;
		}

		$this->Car->unbindModelAll();
		$term = $_GET['term'];
		$conditions[] = array('UPPER(CarName.car_name) like' => '%' . strtoupper($term) . '%');
		$conditions[] = array('UPPER(Car.cnumber) LIKE' => '%' . strtoupper($term) . '%');
		$conditions[] = array('Car.stock LIKE' => '%' . $term . '%');
		$conditions[] = array('UPPER(brandsAls.brand_name) LIKE' => '%' . strtoupper($term) . '%');
		$conditions[] = array('UPPER(car_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');
		$conditions[] = array('UPPER(vehicle_typesAls.type) LIKE' => '%' . strtoupper($term) . '%');

		if($this->getGuestPermission())
			$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0, 'Car.groupid' => $this->getGuestPermissionAccess(), 'AND' => array('OR' => $conditions));
		else if($this->getGroupID() == 5)
			$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0, 'Car.groupid' => $this->getSellUserPermissionAccess(), 'AND' => array('OR' => $conditions));
		else
			$condition2 = array('Car.publish' => 1, 'Car.deleted' => 0, 'AND' => array('OR' => $conditions));
		$this->Car->bindModel(array('belongsTo' => array('CarName' => array('fields' => 'car_name,id'))));
			$carNames = $this->Car->find('all', array('conditions' => $condition2, 'recursive' => 2, 'limit' => 10,
					'joins' => array(
						array(
							'alias' => 'brandsAls',
							'table' => 'brands',
							'type' => 'INNER',
							'conditions' => '`brandsAls`.`id` = `Car`.`brand_id` AND `brandsAls`.deleted = 0'
						), array(
							'alias' => 'car_typesAls',
							'table' => 'car_types',
							'type' => 'INNER',
							'conditions' => '`car_typesAls`.`id` = `Car`.`car_type_id` AND `car_typesAls`.deleted = 0'
						),
						array(
							'alias' => 'vehicle_typesAls',
							'table' => 'vehicle_types',
							'type' => 'LEFT',
							'conditions' => '`vehicle_typesAls`.`id` = `Car`.`vehicle_type_id`'
						),
						array(
							'alias' => 'CarPaymentAls',
							'table' => 'car_payments',
							'type' => 'LEFT',
							'conditions' => '`CarPaymentAls`.`car_id` = `Car`.`id`'
						)
					))
			);

		$CarSearch = array();
		foreach ($carNames as $crnm) {
			$CarSearch[] = array(
				"label" => $crnm['CarName']['car_name'] . " " . $crnm['Car']['package'],
				"vallue" => $crnm['CarName']['car_name'] . " " . $crnm['Car']['package'],
				"tag" => $crnm['Car']['id']
			);
		}
		echo json_encode($CarSearch);
	}

	public function gatModel()
	{

		$carName = $this->CarName->find('list', array('fields' => array('id', 'car_name'), 'conditions' => array("brand_id" => $_POST['id'])));
		$this->set('carName', $carName);
	}


	public function carQuery()
	{
		$this->autoRender = false;
		$this->Email->to = EMAIL_ACCOUNT;
		$this->Email->subject = 'Submit Query For Stock ID : ' . $this->data['Query']['stock'];
		$this->Email->from = $this->data['Query']['email'];
		$this->Email->sendAs = 'html';
		$mail_data = '<table celpadding="5" border="1">
			<tr> 
				<td>Stock Id:</td><td>' . $this->data['Query']['stock'] . '</td>
			</tr>
			<tr> 
				<td>Name:</td><td>' . $this->data['Query']['name'] . '</td>
			</tr>
			<tr> 
				<td>Email:</td><td>' . $this->data['Query']['email'] . '</td>
			</tr>
			<tr> 
				<td>Contact No. :</td><td>' . $this->data['Query']['contact'] . '</td>
			</tr>
			<tr> 
				<td>Message :</td><td>' . $this->data['Query']['comment'] . '</td>
			</tr>
		</table>';

		$this->Email->send($mail_data);
		return json_encode(array("status" => "success", "message" => "Query Send successfully!"));
		die;
	}

	public function CifQuery()
	{
		$this->autoRender = false;

		$this->Cif->set($this->data);
		$return = $this->Cif->save($this->data);
		return json_encode(array("status" => "success", "message" => "Query Send successfully!"));
	}


	/* send email to client for image*/
	public function getSendMail()
	{


		$Path = WWW_ROOT . "img/carimages/";
		// $fileName = '1388725518_test.jpeg';
		if ($this->request->is('POST')) {

			if ($this->data['car_id']) {
				$images = $this->CarImage->find('all', array('conditions' => array('CarImage.car_id' => $this->data['car_id'])));
				$imagesToSend = array();
				$img = array();
				$i = 0;
				foreach ($images as $val) {
					$imagesToSend[] = $val['CarImage']['image_source'];
					$img[$i]['file'] = $val['CarImage']['image_source'];
					$img[$i]['name'] = basename($val['CarImage']['image_source']);
					$i++;
				}

				$car_name = $this->Car->find('first', array('conditions' => array('Car.id' => $this->data['car_id'])));
				$c_name = $car_name['CarName']['car_name'];


				if (@$this->data['text_mail'] != '') {
					$emailArr = $this->data['text_mail'];
				} else {
					$emailArray = explode('#', $this->data['email']);
					$user_id = $emailArray['1'];

					$userDetails = $this->User->find('first', array('fields' => array('User.email', 'User.alternate_email'), 'conditions' => array('User.user_group_id !=' => 1, 'User.id' => $user_id)));
					if ($userDetails['User']['alternate_email'] != '') {
						$emailArr = $userDetails['User']['email'];
						$emailArr2 = $userDetails['User']['alternate_email'];
					} else {
						$emailArr = $userDetails['User']['email'];
					}
				}

				$bodytext = $this->data['quotation'];
				if ($emailArr[0] == '') {
					echo json_encode(array("status" => "error", "message" => "Error - Please add atleast one mail."));
				} else {


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

					$mail = new phpmailer;

// Set mailer to use AmazonSES.
					$mail->IsAmazonSES();

// Set AWSAccessKeyId and AWSSecretKey provided by amazon.
					$mail->AddAmazonSESKey(AWSAccessKeyId, AWSSecretKey);
					$mail->SMTPDebug = 0;
					$mail->debug =0;
// "From" must be a verified address.
					$mail->From = EMAIL_FROM;
					$mail->FromName = FromName;
//$mail->AddAddress($toEmail);

					$mail->AddAddress($emailArr);

					if ($emailArr2)
						$mail->AddAddress($emailArr2);
//$mail->AddCC('uktoyama@ukcarstokyo.com','uktoyama');
					foreach ($img as $im) {
						$mail->Addattachment($im['file'], $im['name']);
					}
					$mail->IsHTML(true);                                  // Set email format to HTML

					$mail->Subject = $c_name . '  pics';
					$mail->Body = $bodytext . '<br/><br/><br/><br/><br/>PFA';


#$sendMail = $mail->Send(); // send message


////////////////////////////////////////////////////////////////////////////////////////////////////////////////


					if ($mail->Send()) {

						echo json_encode(array('status' => 'success', 'message' => "Send email successfully with attached images!"));
					} else {
						echo json_encode(array("status" => "error", "message" => "Error - while  email not send!"));


					}
				}
			} else {
				echo json_encode(array("status" => "error", "message" => "Error - while  email not send!"));

			}

		}
	}
	public function setCarConsignee()
	{
		//pr($this->data);die;
		$status = false;
		if($this->request->is('post'))
		{
			$date = date('Y-m-d H:i:s');
			$userid = $this->Session->read('UserAuth.User.id');
			$carid =  $this->data['carid'];
			$consignee =  $this->data['consignee'];
			$data['id'] = $carid;
			$data['consignee'] = $consignee;
			$data['modified_by'] = $userid;
			$data['modified'] = $date;
			$resultUpdate = $this->Car->save($data);
			//$resultUpdate =  $this->Car->update(array('Car.consignee'=>$consignee, 'modified_by' => $userid, 'modified' => $date), array('Car.id'=>$carid));
			if($resultUpdate){
				$status = true;
			}
			//$InvoiceName=$this->CarPayment->find('all',array('conditions'=>array('CarPayment.user_id'=>$this->data['userId'])));
			//$result = $this->Tax->save($this->data);
			//echo json_encode(array('done'=>'success',"message"=>"Port detail is successfully edited!",'port_name'=>$result['Tax']['port_name'],'amount'=>$result['Tax']['amount'],'p_id'=>$result['Tax']['id']));
		}
		echo $status;die;
	}

}