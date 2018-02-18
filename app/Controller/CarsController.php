<?php
App::uses('AppController', 'Controller');
require_once ROOT.'/app/webroot/phpmailer2/class.phpmailer.php'; //Not required with Composer
//require_once 'e://xampp/htdocs/bizupon/app/webroot/phpmailer2/class.phpmailer.php'; //Not required with Composer
#require_once '/var/www/html/website/app/webroot/phpmailer/PHPMailerAutoload.php'; //Not required with Composer

class CarsController extends AppController {

	public $uses = array('Car','Tax','CarImage','User','Shipping','Bid','Port','VehicleType','CarName','CarPayment','CarType','Sale','Logistic','Auction','Venue','Country','Brand','Paginate','Paginator','Session','Transport', 'Shipschedule');
	public $components = array('UserAuth','ControllerList','Paginator','Email','RequestHandler');
	//public $helpers = array('Common');
	public $helpers = array('Js' => array('Jquery'), 'Paginator');
////////////////////////////////////////////////////////

	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
		$this->User->userAuth=$this->UserAuth;
	}

	public function admin_index(){
		$groupId = $this->Session->read('UserAuth.User.user_group_id');
		$userid = $this->Session->read('UserAuth.User.id');
		/*
        Author: Praveen
        Company: Synthia Software Pvt Ltd
        Issue: Logistics table is joining without any reason. due to this it is using the 100% CPU by mysqld
        Solution: Unbinding the logistic table.
        */
		$this->Car->unbindModel(array('hasMany' => array('CarImage','Bid'),'belongsTo' => array('Brand','CarType'),'hasOne'=>array('Logistic')),false);


		//$this->Car->unbindModel(array('hasMany' => array('CarImage','Bid'),'belongsTo' => array('Brand','CarType')), false);

		$fields = array('Car.uniqueid', 'Car.publish', 'Car.cnumber','Car.id','Car.stock','Car.doc_status','Car.user_doc_status','CarPayment.sale_price','CarName.car_name',
			'Country.country_name', 'User1.first_name', 'User1.last_name', 'User2.first_name', 'User2.last_name');
		$this->paginate="";
		if(isset($this->params->query['sort'])){
			$status = $this->params->query['sort'];
		}
		else{
			$status='published';
		}

		if($status == 'unpublish')
		{
			if($groupId == 2) {
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('CarPayment.updated_on' => 'DESC'), 'conditions' => array('AND' => array('Car.publish' => 0, 'Car.created_by' => $userid, 'OR' => array('CarPayment.sale_price !=' => null)))
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}else{
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('CarPayment.updated_on' => 'DESC'), 'conditions' => array('AND' => array('Car.publish' => 0, 'OR' => array('CarPayment.sale_price !=' => null)))
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}
			$carDetails= $this->Paginator->paginate('Car');
			$this->set('count_type','Sold');
		}
		else
		{
			if($groupId == 2) {
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'desc'), 'conditions' => array('AND' => array('Car.created_by' => $userid))
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}else{
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'desc')
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}
			$carDetails= $this->Paginator->paginate('Car');
			$this->set('count_type','Publish');
		}

		if(isset($this->params->query['new']) )
		{
			$status = $this->params->query['new'];
			$this->set('new',$this->params->query['new']);
			if($groupId == 2) {
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'DESC'), 'conditions' => array('Car.publish' => 1, 'Car.created_by' => $userid, 'CarPayment.sale_price' => null, 'Car.new_arrival' => 1)
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}else{
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'DESC'), 'conditions' => array('Car.publish' => 1, 'CarPayment.sale_price' => null, 'Car.new_arrival' => 1)
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}
			$carDetails= $this->Paginator->paginate('Car');
			$this->set('count_type','New Arrival');
		}

		if(isset($this->params->query['sold']) )
		{
			$status = $this->params->query['sold'];
			$this->set('sold',$this->params->query['sold']);
			if($groupId == 2) {
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'desc'), 'conditions' => array('Car.publish' => 0, 'Car.created_by' => $userid, 'CarPayment.sale_price' => null)
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}else{
				$this->paginate = array('fields' => $fields, 'limit' => 10, 'order' => array('id' => 'desc'), 'conditions' => array('Car.publish' => 0, 'CarPayment.sale_price' => null)
				, 'joins' => array(
						array(
							'alias' => 'User1',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User1`.`id` = `Car`.`created_by`'
						),
						array(
							'alias' => 'User2',
							'table' => 'users',
							'type' => 'inner',
							'conditions' => '`User2`.`id` = `Car`.`modified_by`'
						)
					));
			}
			$carDetails= $this->Paginator->paginate('Car');
			$this->set('count_type','Hidden');
		}

		$this->set('carDetail',$carDetails);
	}

	/* add new car  */

	public function admin_addnew_car($id = null)
	{
		$groupId = $this->Session->read('UserAuth.User.user_group_id');
		$userid = $this->Session->read('UserAuth.User.id');
		if($this->request->is('post'))
		{
			$data=array();
			$this->Car->unbindModelAll();
			$lastStock= $this->Car->find('first',array('order' => array('Car.id DESC')));		//		get last inserted
			$stockName= $lastStock['Car']['id']+1;


			$this->Car->unbindModel(array('hasOne'=>array('Logistic')));
			$this->autoRender = false;
			if($this->data['Car']['new_arrival'] == 1)
			{
				$this->request->data['Car']['stock'] = '';
				$this->Car->id = $this->data['Car']['car_id'];
			}
			else
			{
				if($this->data['Car']['car_id'] == 0)
				{
					$this->request->data['Car']['stock'] = $stockName;
				}else
				{
					$this->Car->id = $this->data['Car']['car_id'];
					$this->request->data['Car']['stock'] = $this->data['Car']['car_id'];
				}
			}
			$this->request->data['Car']['cnumber'] = strtoupper($this->request->data['Car']['cnumber']);
			$this->request->data['Car']['pdate'] = date('Y-m-d',strtotime(@$this->data['Car']['pdate']));
			$this->Car->set($this->data);

			if ($this->Car->carValidate())
			{

				$this->request->data['Car']['new_arrival_date']  = date('Y-m-d H:i:s',strtotime($this->data['Car']['new_arrival_date']));

				if(!$this->request->data['Car']['car_id'])
					$this->request->data['Car']['created_by'] = $userid;
				$this->request->data['Car']['modified_by'] = $userid;
				$retData = $this->Car->save($this->request->data);
				if($retData['Car']['car_id'] == 0)
				{

					$retData['Car']['car_id'] = $retData['Car']['id'];
				}

				$data1  = $this->request->data['Car'];
				$data2  = $this->request->data['Car'];

				$this->CarPayment->primaryKey = 'car_id';
				$data1['car_id'] = $retData['Car']['car_id'];
				$data1['auction_name'] = $this->data['auction_name'];
				$data1['created_on'] = date('Y-m-d');
				$data1['recycle_price'] = $retData['Car']['recycle_price'];
				$data1['minimum_price_doller'] = $retData['Car']['minimum_price_doller'];
				$data1['minimum_price_yen'] = $retData['Car']['minimum_price_yen'];
				$data1['created_by'] = $userid;

				$retData1 = $this->CarPayment->save($data1);
				$this->CarPayment->primaryKey = 'id';

				$this->Logistic->primaryKey = 'car_id';
				$data2['car_id'] = $retData['Car']['car_id'];
				$data2['port_id'] = $retData['Car']['port_id'];
				$data2['transport_id'] = $retData['Car']['transport_id'];
				$data2['created'] = "  ";

				$retData2 = $this->Logistic->save($data2);

				$this->Car->recursion=2;

				$Cardata=$this->Car->find('first', array('conditions'=>array('Car.id' => $retData['Car']['car_id'])));

				$price =  @$Cardata['CarPayment']['push_price']/10000;
				$auc= explode('-',@$Cardata['CarPayment']['auction_name']);
				$date= explode('-',date('d-m-Y',strtotime(@$Cardata['Car']['pdate'])));

				$myUnique=substr(@$Cardata['Country']['country_name'],0,1).'-'.@$price.'-'.@$auc[0].'-'.@$date[0].'-'.@$date[1].'-'.@$auc[1]."-".@$Cardata['Car']['lot_number'];

				$data['id']=$retData['Car']['car_id'];

				//$data['uniqueid']=$this->Car->uniqueid($myUnique); old code commented by sudhir
				$data['uniqueid']=$myUnique;
				$this->Car->save($data);

				if($retData)
				{
					echo json_encode(array('status'=>'success','data'=>$retData,"message"=>"Successfully Saved"));
				}else
				{
					echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
				}

			}else
			{
				echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
			}
		}else
		{

			$this->Session->delete('tempFiles');

			//for edit part 
			if(isset($id))
			{
				$result = $this->Car->findById($id);
				//exit;
				if(!empty($result))
				{
					$created_by =  $result['Car']['created_by'];
					if( $groupId  == 2){
						if($created_by != $userid){
							die('you are not permitted to access it. Please go back.');
						}
					}
					$ShipSchedule=$this->Shipschedule->find('first',array('conditions'=>array('chasis'=>$result['Car']['cnumber'])));
					$this->set('ShipSchedule',$ShipSchedule['Shipschedule']);

					$AuctionData=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.country_id'=>$result['Country']['id']),'group'=>'Port.port_name'));
					$this->set('AuctionData',$AuctionData);

					$this->set('aucttonId',$result['CarPayment']['auction_id']);
					$this->set('carDetails',$result);
					$this->set('car_id',$result['Car']['id']);

				}else{
					die('you are not permitted to access it. Please go back.');
				}

			}
		}


		$tax = $this->Tax->find('first');
		$this->set('tax_value',$tax['Tax']['tax_value']);

		$users = $this->User->find('all',array('fields' => array('first_name','last_name','id')));
		$user_list = Set::combine($users, '{n}.User.id', array('{0} {1}', '{n}.User.first_name', '{n}.User.last_name'));

		$this->set('user',$user_list);

		/* find shipping country name*/
		$ShippedData=$this->Shipping->find('list',array('fields'=>array('Shipping.id','Shipping.company_name')));
		$this->set('shippedData',$ShippedData);




		$AuctionPlaces = $this->Auction->find('list',array('fields' => array('Auction.id', 'Auction.auction_name'),
		));
		$this->set('AuctionPlace',$AuctionPlaces) ;

		/*   find country    */

		$CountryDetails=$this->Country->find('all');
		$this->set('CountryDetail',$CountryDetails);

		$BrandDetails=$this->Brand->find('list',array('fields'=>array('Brand.brand_name')));
		$this->set('BrandDetail',$BrandDetails);

		$AuctionDetail= $this->Auction->find('all',array('fields' =>array('Auction.id','Auction.auction_name','Auction.auction_place','Auction.fees')));

		$arr1=array();

		foreach($AuctionDetail as $key=>$val){
			$arr1[]=array('value'=>$val['Auction']['id'], 'name'=>$val['Auction']['auction_name']."-".$val['Auction']['auction_place'],'data-value'=>$val['Auction']['fees'],'required'=>true);
			$AuctionPlaces = array('id'=>$val['Auction']['id'],'auction_name'=>$val['Auction']['auction_name']);
		}

		$this->set('AuctionPlace',$AuctionPlaces) ;
		$this->set('arr1',$arr1);

		/* find Transport country name*/
		$Transports = $this->Transport->find('list',array('fields'=>array('Transport.id','Transport.transport_name')));
		$this->set('transports',$Transports);
		$this->set('transportID',2);



		$AuctionData=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.country_id'=>$result['Country']['id']),'group'=>'Port.port_name'));
		$this->set('AuctionData',$AuctionData);




		/*  find CarTpye */
		$carType = $this->CarType->find('list',array('fields'=>array('CarType.id','CarType.type'),'conditions'=>array('CarType.p_id'=>0)));
		$this->set('carType',$carType);



		$PortData=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'group'=>'Port.port_name'));


		$this->set('PortData',$PortData);

		/*  find Vehical Tpye */
		$VehicleType = $this->CarType->find('list',array('fields'=>array('id','type'),'conditions'=>array('CarType.p_id'=>1)));
		$this->set('vehicleType',$VehicleType);

		/*   function for set the car name */

		$Car=$this->CarName->find('list',array('fields'=>array('CarName.id','CarName.car_name')));
		$this->set('Car',$Car);

		$BidData=$this->Bid->find('all',array('order'=>array('Bid.amount'=>'desc'),'conditions'=>array('Bid.car_id'=>$id),'recursive'=>2));
		$this->set('BidData',$BidData);


	}

	/*	function for find port	 on logistic */
	public function admin_getPort()
	{
		if(isset($this->data))
		{
			@$GetAuction=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.auction_id'=>@$this->data['auction_id'],'Port.transport_id'=>$this->data['transportId'])));
			$this->set('GetAuction',$GetAuction);

			/*$GetAuction=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.country_id'=>$this->data['countryId']),'group' => 'Port.port_name'));
			$this->set('GetAuction',$GetAuction);
			if($this->data['countryId'] == '2')
			{
				$this->set('portId',3);
			}else
			{
				$this->set('portId','');
			}*/

		}else
		{
			echo json_encode(array('status'=>'error','data'=>$GetAuction,"message"=>"not get auction!"));

		}
	}

	public function admin_getEditPort()
	{
		if(isset($this->data))
		{
			@$GetAuction=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.auction_id'=>@$this->data['auction_id'])));
			$this->set('GetAuction',$GetAuction);
			$this->set('port_id',$this->data['port_id']);
			$this ->render('admin_get_port');
			$this->layout = null;

		}else
		{
			echo json_encode(array('status'=>'error','data'=>$GetAuction,"message"=>"not get auction!"));

		}
	}




	public function admin_getShipCharge()
	{
		$this->autoRender = false;
		if(isset($this->data))
		{
			$shipCharge = '';
			$GetPortDetail=$this->Port->find('first',array('fields'=>array('Port.port_name'),'conditions'=>array('Port.id'=>$this->data['port_id'])));
			$arr = @explode(' ',$GetPortDetail['Port']['port_name']);
			@$neWPort = $arr[0].' '.$arr[1];

			$portDetail = $this->Tax->find('all',array('fields'=>array('port_name','amount'),'conditions'=>array('Tax.id !='=>1)));


			if(@$neWPort == $portDetail[0]['Tax']['port_name'])
			{
				$shipCharge = $portDetail[0]['Tax']['amount'];
			}
			else if($arr[0] ==$portDetail[1]['Tax']['port_name'])
			{
				$shipCharge = $portDetail[1]['Tax']['amount'];
			}else
			{
				$shipCharge = 0; //if(@$GetPortDetail['Port']['port_name'] == 'UK TOYOMA YARD')
			}
			return 	json_encode(array('status'=>'success','shipCharge'=>$shipCharge));
		}else
		{
			return json_encode(array('status'=>'error',"message"=>"Error while fetch data!"));

		}

	}



	public function admin_getCharge()
	{
		$this->autoRender = false;
		if(isset($this->data))
		{

			$GetDetail=$this->Port->find('first',array('fields'=>array('Port.rickshaw'),'conditions'=>array('Port.id'=>$this->data['port_id'],'Port.auction_id'=>$this->data['auction_id'])));
			if(isset($this->data['param']))
			{
				return 	json_encode(array('status'=>'success',"price"=>@$GetDetail['Port']['rickshaw']));
			}
			else
			{
				return 	json_encode(array('status'=>'success',"price"=>@$GetDetail['Port']['rickshaw']));
			}
			//$GetPortDetail=$this->Port->find('first',array('fields'=>array('Port.port_name,Port.rickshaw'),'conditions'=>array('Port.auction_id'=>$this->data['auction_id'])));
			//pr($GetPortDetail);

		}else
		{
			return json_encode(array('status'=>'error',"message"=>"Error while fetch data!"));

		}
	}



	public function admin_add_post_links(){
		//$fileType=$_REQUEST['fileType'];

		//pr($this->params); die;

		if($this->request->isPost()){
			//pr($this->data);die;
			$data=array();

			if(isset($_FILES["myfile"]))
			{
				//pr($_FILES["myfile"]);
				//$fileType=$this->data['fileName'];
				//$fileType=$this->params['pass']['0'];
				//pr($fileType);die;
				$ret = array();
				$image =  array('gif','png' ,'jpg','jpeg','PNG');
				// $video =  array('mp4','avi','flv','mkv','mpeg','mpeg4');
				// $audio =  array('mp3','wma');
				$error=$_FILES["myfile"]["error"];

				$upload_path=WWW_ROOT.'files/post_files/';

				if(!$this->Session->read('tempFiles')){
					$file_sess_arr = array();
				}else{
					$file_sess_arr=$this->Session->read('tempFiles');
				}

				if(!is_array($_FILES["myfile"]['name'])) //single file
				{

					$fileName = $_FILES["myfile"]["name"];
					//	$tempName = time()."_".$fileName;
					$tempName = $fileName;

					@move_uploaded_file($_FILES["myfile"]["tmp_name"],$upload_path.$tempName);
					//echo "<br> Error: ".$_FILES["myfile"]["error"];
					/* imoprting Component image */
					App::import('Component','Image');

					if(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$image)) {
						//$MyImageCom = new ImageComponent();    // creating object for image manipulation
						//$MyImageCom->imageResize($upload_path.$tempName,300); // resize image to height 400px and width auto 
					}
					$file_sess_arr[]=array('type'=> $fileType,'ori_name'=> $fileName,'temp_name'=>$tempName);

					$ret[$fileName]= $upload_path.$fileName;
					// $ret_temp[$tempName] = $upload_path.$tempName;
					if(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$image)) {
						$ret_temp[$tempName] = "image";
					}
					/* elseif(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$video)) {
					 $ret_temp[$tempName] = "video";
					 $fileType = "video";
					 }elseif(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$audio)) {
					 $ret_temp[$tempName] = "audio";
					 $fileType = "audio";
					 }*/else{
						echo "error";die;
					}

				}
				else //multiple files
				{
					$fileCount = count($_FILES["myfile"]['name']);
					for($i=0; $i < $fileCount; $i++)
					{
						$fileName = $_FILES["myfile"]["name"][$i];
						//$tempName = time()."_".$fileName; 
						$tempName = $fileName;

						//$ret_temp[$tempName] = $upload_path.$tempName;
						if(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$image)) {
							$ret_temp[$tempName] = "image";
						}/*elseif(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$video)) {
					 $ret_temp[$tempName] = "video";
					 $fileType = "video";
					 }elseif(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$audio)) {
					 $ret_temp[$tempName] = "audio";
					 $fileType = "audio";
					 }*/else{
							echo "error";die;
						}
						$ret[$fileName]= $upload_path.$fileName;
						move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$upload_path.$tempName);
						if(in_array(pathinfo($tempName, PATHINFO_EXTENSION),$image)) {
							//	App::import('Component','Image');
							//$MyImageCom = new ImageComponent();    // creating object for image manipulation
							//$MyImageCom->imageResize($upload_path.$tempName,300); // resize image to height 400px and width auto

						}
						$file_sess_arr[]=array(/*'type'=> $fileType,*/'ori_name'=> $fileName,'temp_name'=>$tempName);

					}

				}

				$this->Session->write('tempFiles', $file_sess_arr);
				$file_sess_arr='';

				//echo json_encode($ret);			/*json for original file name*/
				echo json_encode($ret_temp);die;		/*json for temporary file name*/
				//$data=array();
				//$data[]=$this->Session->read('tempFiles');
				//pr($this->Session->read('tempFiles'));


			}
			die;
		}//end iF for post of filetype
	}//end add_post_links function

	/*  car_shipment detail  */

	public function admin_add_shipment(){


		if($this->request->is('post')){

			if(!empty($this->data)) {
				$data=array();
				$data['uid']=$this->data['Cars']['country'];
				$data['auction']=$this->data['Cars']['auction'];
				$data['destination']=$this->data['Cars']['destination'];
				$data['land_transport']=$this->data['Cars']['land_transport'];
				$data['toyoma']=$this->data['Cars']['toyoma'];
				$data['transportation_charge']=$this->data['Cars']['transportation_charge'];
				$data['venue']=$this->data['Cars']['venue'];
				//$data['uid']=$this->data['Cars']['uid'];
				$data['ecl']=$this->data['Cars']['ecl'];
				//pr($data); die;
				if($this->CarShipment->save($data)) {
					$this->Session->setFlash('Your Message has been posted');
				}
			}


		}
		if($this->request->is('ajax'))
		{
			$venues=$this->Venue->find('all',array('fields' => array('id','venue_name'),'conditions' => array('auction_place_id'=> $_GET['id'])));
			echo json_encode($venues);
			$this->autoRender = false;

		}

	}

	public function admin_addImage(){
		$this->autoRender = false;
		$CarId= $this->data['Car']['car_id'];

		if($CarId != 0){
			$carimages=$this->Session->read('tempFiles');

			if($carimages){

				foreach($carimages as $key=>$val){

					$dest_dir = WWW_ROOT."img/carimages/"; //WWW_ROOT.'files/post_files/'
					$src_file = WWW_ROOT."files/post_files/";

					if(copy($src_file.$val['temp_name'],$dest_dir.$val['temp_name'])){

						@unlink($src_file.$val['temp_name']);

						$data =  array();
						$data['car_id'] = $CarId;
						$data['image_source'] = "img/carimages/".$val['temp_name'];
						$data['image_name'] = "img/carimages/".$val['ori_name'];
						$imgdata=$this->CarImage->saveAll($data);

					}else{

						echo json_encode(array('status'=>'failure','message'=>'not saved'));die;

					}



				}
				$this->Session->delete('tempFiles');
				echo json_encode(array('status'=>'success','message'=>'images added successfully'));

			}else{
				echo json_encode(array('status'=>'failure','message'=>'no image to upload'));
			}

		}else{
			echo json_encode(array('status'=>'failure','message'=>'invalid ID'));
		}

	}
	/*  admin  car view     */

	public function admin_view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$products = $this->Car->findById($id);
		if (!$products) {
			throw new NotFoundException(__('Invalid post'));
		}
		$CatImages=$this->CarImage->find('all');
		$data=array();
		for($i=0;$i<count($CatImages);$i++)
		{

			$data[$i]=$CatImages[$i]['CarImage'];
		}
		//pr($data); die;
		$this->set('data',$data);
		$this->set('product', $products);
	}

	/*  admin edit car   */

	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Car->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Car->id = $id;
			//	if ($this->Car->save($this->request->data)) {
			//	$this->Session->setFlash(__('Your post has been updated.'));
			return $this->redirect(array('action' => '/admin/cars/addnew_car/'));
			//  }
			//  $this->Session->setFlash(__('Unable to update your post.'));
		}

		//if (!$this->request->data) {
		//	$this->request->data = $post;
		//}
	}


	/*  delete arrival car  */

	public function admin_delete_arrival_car(){

		$this->autoRender = false;
		if($this->request->isPost()){
			$model = "Car";
			$id = $this->data['id'];
			$resultUpdate =  $this->Car->updateAll(array('Car.deleted'=>1), array('Car.id'=>$id));
			if($resultUpdate)
			{
				$this->CarPayment->primaryKey = 'car_id';
				$result= $this->CarPayment->updateAll(array('CarPayment.deleted'=>1), array('CarPayment.car_id'=>$id));
				if($result)
				{
					$this->CarImage->primaryKey = 'car_id';
					$this->CarImage->updateAll(array('CarImage.deleted'=>1), array('CarImage.car_id'=>$id));
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!","data"=>$id));
				}

			}else{
				echo json_encode(array("status"=>"error","message"=>"not deleted! ","data"=>$id));

			}

		}

	}











	/*  admin delete car */

	public function admin_delete_car(){

		$this->autoRender = false;
		if($this->request->isPost()){
			$model = "Car";
			$id = $this->data['id'];
			$this->$model->id = $id;

			if($this->$model->delete($id)){
				$this->CarPayment->primaryKey = 'car_id';
				$result= $this->CarPayment->updateAll(array('CarPayment.deleted'=>1), array('CarPayment.car_id'=>$id));
				if($result)
				{
					$this->CarImage->primaryKey = 'car_id';
					$this->CarImage->updateAll(array('CarImage.deleted'=>1), array('CarImage.car_id'=>$id));
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!","data"=>$id));
				}



			}else{
				echo json_encode(array("status"=>"error","message"=>"not deleted! ","data"=>$id));

			}

		}

	}


	/*   move image   */
	public function admin_delete_images(){
		$this->autoRender = false;
		if($this -> request ->is('post')){
			if(isset($this->data['img_name'])){

				//$returnId= $this->CarImage->find('all', array('conditions'=>array('image_source'=>'img/carimages/1395173196_merc.jpg')));

				//echo WWW_ROOT.$this->data['img_name']; $this->CarImage->delete($returnId[0]['car_images']['id'])


				$returnId  = $this->CarImage->query('SELECT id FROM car_images WHERE image_source = "'.$this->data['img_name'].'" and deleted = 0');
				//print_r($returnId);die;

				//$deleteId = $this->CarImage->query(" DELETE FROM car_images WHERE id='".$returnId[0]['car_images']['id']."' ");

				if($returnId)
				{
					$this->CarImage->query('DELETE FROM car_images WHERE id="'.$returnId[0]['car_images']['id'].'"');
					if(unlink(WWW_ROOT.$this->data['img_name']))
					{
						echo json_encode(array('status'=>'success','message'=>'deleted'));
					}else
					{
						echo json_encode(array('status'=>'successWithError','message'=>'Error while delete images form folder'));
					}

					/*if($this->CarImage->query('DELETE FROM car_images WHERE id="'.$returnId[0]['car_images']['id'].'"'))
                    {
                            if(unlink(WWW_ROOT.$this->data['img_name']))
                            {
                                echo json_encode(array('status'=>'success','message'=>'deleted'));
                            }else
                            {
                                echo json_encode(array('status'=>'successWithError','message'=>'Error while delete images form folder'));
                            }
                    }else
                    {
                        echo json_encode(array('status'=>'successWithError','message'=>'Error while delete images'));
                    }*/

				}else
				{
					unlink($src_file = WWW_ROOT."files/post_files/".$this->data['img_name']);
					echo json_encode(array('status'=>'successWithWarning','message'=>'Images remove and not saved'));
				}

			}else{
				echo json_encode(array('status'=>'failure','message'=>'params error'));
			}

		}else{
			echo json_encode(array('status'=>'success','message'=>'request error'));
		}

	}



	/* used for delete all car images */

	public function admin_deleteAllCarImage()
	{
		$this->autoRender = false;
		if($this -> request ->is('post')){
			if(isset($this->data['car_id'])){

				$imageSource= $this->CarImage->find('all',array('fields'=>array('image_source'),'conditions'=>array('car_id'=>$this->data['car_id'])));

				$this->CarImage->primaryKey = 'car_id';
				$this->CarImage->query('DELETE FROM car_images WHERE car_id="'.$this->data['car_id'].'"');

				$this->removeAllImage($imageSource);
				echo json_encode(array('status'=>'success','message'=>'Successfully deleted'));


				/*if($this->CarImage->query('DELETE FROM car_images WHERE car_id="'.$this->data['car_id'].'"')){
                                $this->removeAllImage($imageSource);
                                echo json_encode(array('status'=>'success','message'=>'Successfully deleted'));
                            }else{
                                echo json_encode(array('status'=>'successWithWarning','message'=>'not saved'));
                            }*/

			}else{
				echo json_encode(array('status'=>'failure','message'=>'params error'));
			}

		}else{
			echo json_encode(array('status'=>'success','message'=>'request error'));
		}

	}


	/* Auction data */
	/*     generate unique number */

	public function UniqueDetail(){
		//	pr($this->params);

		$Unique=$this->params->query['value'].'-'.rand(10001,99999);
		//pr($Unique); die;
		//    $UniqueData=$this->Car->find('count', array('conditions'=>array('uniqueid'=>$Unique)));
		if($UniqueData)
			// 	$this->uniquenumber($Unique);

			return $Unique;

	}
	/*search pagination here*/
	public function admin_search()
	{
		$groupId = $this->Session->read('UserAuth.User.user_group_id');
		$userid = $this->Session->read('UserAuth.User.id');
		$this->autoRender = false;

		// get the search term from URL
		$term = $this->request->query['q'];
		$this->Car->unbindModel(array('hasMany' => array('CarImage')));

		$status = $this->request->query['status'];

		if($groupId == 2){
			if ($status == 'unpublish') {
				$conditions = array('Car.created_by' => $userid, 'CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'Car.new_arrival' => 0, 'CarPayment.user_id !=' => 0);
			} else if ($status == 'not sold') {
				$conditions = array('Car.created_by' => $userid, 'CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'CarPayment.user_id' => 0);

			} else if ($status == 'new arrival') {
				$conditions = array('Car.created_by' => $userid, 'CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 1, 'Car.new_arrival' => 1);
			} else {

				$conditions = array('Car.created_by' => $userid, 'CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 1);
			}
		}else{
			if ($status == 'unpublish') {
				$conditions = array('CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'Car.new_arrival' => 0, 'CarPayment.user_id !=' => 0);
			} else if ($status == 'not sold') {
				$conditions = array('CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'CarPayment.user_id' => 0);

			} else if ($status == 'new arrival') {
				$conditions = array('CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 1, 'Car.new_arrival' => 1);
			} else {

				$conditions = array('CarName.car_name LIKE' => '%' . $term . '%', 'Car.publish' => 1);
			}
		}

		/*
            array('CarName.car_name LIKE' => '%'.$term.'%' ,
            )
        */

		$cars = $this->Car->find('all', array(
			'fields' => array('CarName.car_name', 'id' => 'CarName.id'),
			'conditions' => $conditions,
			'group' => 'CarName.car_name',
			array(
				"joins" => array(
					array(
						"table" => "car_names",
						"type" => "LEFT",
						"conditions" => array(
							"Car.car_name_id = car_names.id"
						)
					)
				)
			)));


		// Format the result for select1
		$result = array();
		foreach ($cars as $key => $mycar) {
			//	pr($mycar); die;
			$result[] = array("id" => $mycar['CarName']['id'], "text" => $mycar['CarName']['car_name']);
		}

		echo json_encode($result);
	}
	public function select2() {
		$this->Car->recursive = 0;
		$this->set('cars', $this->paginate());
	}

	public function admin_CarDetail(){
		$this->Car->unbindModel(array('hasMany' => array('CarImage')));
		if($this->request->is('ajax')){
			$name=$this->params->query['name'];
			/*$mydetail = $this->Car->find('all',array('conditions'=>array(
					'CarName.car_name LIKE' => '%'.$name.'%',
					)));*/
			$status=$this->request->query['status'];
			if($status=='unpublish')
			{
				$conditions = array('CarName.car_name LIKE' => '%'.$name.'%' ,'Car.publish'=>0,'Car.new_arrival'=>0,'CarPayment.user_id !='=>0);
			}else if($status=='not sold')
			{
				$conditions=array('CarName.car_name LIKE' => '%'.$name.'%' ,'Car.publish'=>0,'CarPayment.user_id'=> 0);

			}else if($status=='new arrival')
			{
				$conditions=array('CarName.car_name LIKE' => '%'.$name.'%' ,'Car.publish'=>1,'Car.new_arrival'=>1);
			}
			else
			{

				$conditions=array('CarName.car_name LIKE' => '%'.$name.'%');
			}

			/*array(
                        'CarName.car_name LIKE' => '%'.$name.'%','Car.publish'=>1,'Car.new_arrival'=>0,'CarPayment.sale_price' => '')*/
			$mydetail = $this->paginate = array(
				'conditions'=>$conditions,
				// 'limit' => 2,
				'order' => array(
					'Car.id' => 'desc'
				)
			);

			$mydetail= $this->Paginator->paginate('Car');
			// pr($mydetail); die;
			$this->set('new',$status);
			$this->set('carDetail',$mydetail);
			$this->set('TotalCar',count($mydetail));
		}
	}

	/*     search function for Chassis number*/
	//GRX133_000082
	//GRX133_000077
	public function admin_searchChassis() {
		$groupId = $this->Session->read('UserAuth.User.user_group_id');
		$userid = $this->Session->read('UserAuth.User.id');
		$this->autoRender = false;
		// get the search term from URL
		$term = $this->request->query['q'];
		$this->Car->unbindModel(array('hasMany' => array('CarImage')));

		$status=$this->request->query['status'];

		if($groupId == 2) {
			if ($status == 'unpublish') {
				$conditions = array('Car.created_by' =>  $userid , 'Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'Car.new_arrival' => 0, 'CarPayment.user_id !=' => 0);
			} else if ($status == 'not sold') {
				$conditions = array('Car.created_by' =>  $userid ,'Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'CarPayment.user_id' => 0);

			} else if ($status == 'new arrival') {
				$conditions = array('Car.created_by' =>  $userid ,'Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 1, 'Car.new_arrival' => 1);
			} else {

				$conditions = array('Car.created_by' =>  $userid ,'Car.cnumber LIKE' => '%' . $term . '%');
			}
		}else {
			if ($status == 'unpublish') {
				$conditions = array('Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'Car.new_arrival' => 0, 'CarPayment.user_id !=' => 0);
			} else if ($status == 'not sold') {
				$conditions = array('Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 0, 'CarPayment.user_id' => 0);

			} else if ($status == 'new arrival') {
				$conditions = array('Car.cnumber LIKE' => '%' . $term . '%', 'Car.publish' => 1, 'Car.new_arrival' => 1);
			} else {

				$conditions = array('Car.cnumber LIKE' => '%' . $term . '%');
			}
		}

		$cars = $this->Car->find('all',array('conditions'=>$conditions, 'fields' =>array('Car.id','Car.cnumber')));

		// Format the result for select1
		$result = array();
		foreach($cars as $key => $mycar) {
			$result[] = array("id"=>$mycar['Car']['id'],"text"=>$mycar['Car']['cnumber']);
		}

		echo json_encode($result);
	}
	public function admin_chassis()
	{
		if($this->data['param']== 'new arrival')
		{
			$this->Car->unbindModel(array('hasMany' => array('CarImage')));
			if($this->request->is('ajax')){

				$Cardetail= $this->Car->find('all',array('conditions'=>array(
					'Car.cnumber LIKE' => '%'.$this->data['name'].'%',
				)));
				$this->set('carDetail',$Cardetail);
				$this->set('new',$this->data['param']);
				$this->set('ChassisData',count($Cardetail));
			}
		}else
		{
			$this->Car->unbindModel(array('hasMany' => array('CarImage')));
			if($this->request->is('ajax')){

				$Cardetail= $this->Car->find('all',array('conditions'=>array(
					'Car.cnumber LIKE' => '%'.$this->data['name'].'%',
				)));


				$this->set('carDetail',$Cardetail);
				$this->set('ChassisData',count($Cardetail));

			}
		}
		//echo "<pre>";
		//print_r($Cardetail);
		foreach($Cardetail as $datavalue)
		{
			if($datavalue['Car']['publish'] == 0 && $datavalue['CarPayment']['sale_price'] != '')
			{

				$this->set('status','Sold Car');
				$this->set('style','btn btn-danger');

			}else if($datavalue['Car']['publish'] == 0 && $datavalue['CarPayment']['sale_price'] =='')
			{

				$this->set('status','Hidden Car');
				$this->set('style','btn btn-warning');


			}else if($datavalue['Car']['new_arrival'] ==1)
			{
				$this->set('status','New Arrival');
				$this->set('style','btn btn-primary');
			}else
			{
				$this->set('status','Publish');
				$this->set('style','btn btn-success');
			}
		}

		/*if($Cardetail[0]['Car']['publish'] == 0 && $Cardetail[0]['CarPayment']['sale_price'] !='')
		{
			$this->set('status','Sold Car');
			$this->set('style','btn btn-danger');
			
		}else if($Cardetail[0]['Car']['publish'] == 0 && $Cardetail[0]['CarPayment']['sale_price'] =='')
		{
			$this->set('status','Hidden Car');
			$this->set('style','btn btn-warning');
			
			
		}else if($Cardetail[0]['Car']['new_arrival'] ==1)
		{
				$this->set('status','New Arrival'); 
				$this->set('style','btn btn-primary');
		}else
		{
			$this->set('status','Publish');
			$this->set('style','btn btn-success');
		}*/
	}
	/*    manage statuc of the car        */


	public function admin_CarStatus() {
		$status = $this->data['status'];
		$id= $this->data['id'];
		$this->Car->read(null, $id);
		$this->Car->set('publish', $status);
		$update = $this->Car->save();
		if($update && $status == 1) {
			echo "Publish";
		} else {
			echo "Hidden Car";
		}
		die;
	}

// for hide car status	
	public function admin_CarHideStatus() {
		$status = $this->data['status'];
		$id= $this->data['id'];
		$this->CarPayment->primaryKey = 'car_id';
		$this->CarPayment->read(null, $id);
		$this->CarPayment->set('deleted', $status);
		$update = $this->CarPayment->save();
		if($update && $status == 1)
		{
			echo "Hide Car";
		} else
		{
			echo "Show Car";
		}
		die;
	}



	public function admin_unpublish()
	{
		$this->Car->unbindModel(array('hasMany' => array('CarImage','CarPayment')));
		$Unpublish = $this->Car->find('all',array('conditions'=>array('publish'=>'0')));
		pr($Unpublish);
		$this->set('unpublish',$Unpublish);

	}

	/*  find popup to send email  of car Image   */

	public function admin_send_image(){

		if ($this->request->is('ajax')) {
			$User=$this->User->find('all',array('fields'=>array('User.id','User.first_name','User.last_name','User.email')));
			//$User=$this->User->find('list',array('fields' => array('User.email','User.username')));	

			$this->set('user',$User);
		}
	}
	/* send email to client for image*/
	public function admin_email_image(){

		$this->autoRender = false;
		//echo 'no access'; die;

		$Path = WWW_ROOT."img/carimages/";
		// $fileName = '1388725518_test.jpeg';
		if($this->request->is('POST')){

			if($this->data['car_id']){
				$images = $this->CarImage->find('all',array('conditions'=>array('CarImage.car_id'=>$this->data['car_id'])));
				$imagesToSend = array();
				$img = array();
				$i = 0;
				foreach($images as $val){
					$imagesToSend[] = $val['CarImage']['image_source'];
					$img[$i]['file'] = $val['CarImage']['image_source'];
					$img[$i]['name'] = basename($val['CarImage']['image_source']);
					$i++;
				}

				$car_name = $this->Car->find('first',array('conditions'=>array('Car.id'=>$this->data['car_id'])));
				$c_name = $car_name['CarName']['car_name'];
				//pr($this->request->data);
				//$testingAtt = array('/var/www/vhosts/udaantechnologies.com/projects/ukcars_dashboard/app/webroot/img/carimages/1389852377_VANGUARD5249837A50450.jpg','/var/www/vhosts/udaantechnologies.com/projects/ukcars_dashboard/app/webroot/img/carimages/1389852386_VANGUARD5249837B50450.jpg','/var/www/vhosts/udaantechnologies.com/projects/ukcars_dashboard/app/webroot/img/carimages/1389852402_VANGUARD5249837D50450.jpg','/var/www/vhosts/udaantechnologies.com/projects/ukcars_dashboard/app/webroot/img/carimages/1389852415_VANGUARD5249837D50450(1).jpg');
				//   pr($testingAtt);


				if(@$this->data['text_mail'] !='')
				{
					$emailArr =$this->data['text_mail'];
				}
				else
				{
					$emailArray =  explode('#',$this->data['email']);
					$user_id =  $emailArray['1'];

					$userDetails = $this->User->find('first', array('fields'=>array('User.email','User.alternate_email'),'conditions' => array('User.user_group_id !=' => 1,'User.id'=>$user_id)));
					if($userDetails['User']['alternate_email'] !='')
					{
						$emailArr = $userDetails['User']['email'];
						$emailArr2 = $userDetails['User']['alternate_email'];
					}
					else
					{
						$emailArr = $userDetails['User']['email'];
					}
				}

				if($emailArr[0]=='')
				{
					echo json_encode(array("status"=>"error","message"=>"Error - Please add atleast one mail."));
				}else
				{


					/* $this->Email->smtpOptions = array(
             'port'=>'465',
             'timeout'=>'30',
             'host' => 'smtp.gmail.com',
             'username'=> EMAIL_ACCOUNT,
             'password'=> EMAIL_PASSWORD,
             'transport' => 'Smtp',
            );

            $this->Email->to = $emailArr;
            $this->Email->subject = $c_name.'  pics' ;
            $this->Email->from = EMAIL_ACCOUNT;
            $this->Email->bcc = EMAIL_ACCOUNT;
            //$this->Email->cc = EMAIL_ACCOUNT;
            $this->Email->attachments =  $imagesToSend;
            $returnStatus = $this->Email->send($this->request->data['quotation']);

            */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = "ssl";
					$mail->SMTPDebug = false;
					$mail->Host       = EMAIL_HOST;
					$mail->Username   = EMAIL_ACCOUNT;
					$mail->Password   = EMAIL_PASSWORD;
					$mail->SetFrom(EMAIL_FROM, FromName); //from (verified email address)
					$mail->Subject = $c_name.'  pics';
					$mail->Port = 465;
					$mail->IsHTML(true);                                  // Set email format to HTML

					$data = "<strong>Hello</strong>,<br>
					<strong>We appreciate your trust in our company and promise to serve you better in future.<br>
					For any further purchase please visit </strong> <a href='www.bizupon.com'> <strong>Bizupon</strong></a> ";

					$mail->Body    = $data;
					foreach($img as $im){
						$mail->Addattachment($im['file'],$im['name']);
					}

					$mail->AddAddress($emailArr);

//if($emailArr2) // uncomment after testing
//$mail->AddAddress($emailArr2);
					$mail->AddCC(EMAIL_FROM, FromName);







#$sendMail = $mail->Send(); // send message

					/*

                    $mail = new PHPMailer();

                    $mail->IsSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
                    $mail->Port = 587;                                    // Set the SMTP port
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'uktoyama@ukcarstokyo.com';                // SMTP username
                    $mail->Password = 'T2xJaZdU5JVIAVrgagLgJg';                  // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

                    $mail->From = EMAIL_ACCOUNT;
                    $mail->FromName = '';
                    #$emailArr  ="jainmca4444@gmail.com";
                    #$mail->AddAddress('josh@example.net', 'Josh Adams');  // Add a recipient
                    $mail->AddAddress($emailArr,'');
                    $mail->AddCC(EMAIL_ACCOUNT);



                    if($emailArr2)
                    $mail->AddAddress($emailArr2,'');

                    foreach($img as $im){
                        $mail->Addattachment($im['file'],$im['name']);
                    }
                    $mail->IsHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $c_name.'  pics';
                    $mail->Body    = 'PFA';
                    */


////////////////////////////////////////////////////////////////////////////////////////////////////////////////





					//pr($imagesToSend);
					if($mail->Send())
					{

						echo json_encode(array('status'=>'success','message'=>"Send email successfully with attached images!"));
					}else
					{
						echo json_encode(array("status"=>"error","message"=>"Error - while  email not send!"));


					}
				}
			}else
			{
				echo json_encode(array("status"=>"error","message"=>"Error - while  email not send!"));

			}

		}
	}

	/*  function for sent sales form value */

	public function admin_sale(){

		$this->autoRender = false;
		if($this->request->is('ajax')){
			//pr($this->data);die;

			if(empty($this->data['Car']['user_id']))
			{
				$data=array();
				$this->CarPayment->primaryKey = 'car_id';
				$this->CarPayment->id = $this->data['Car']['car_id'];
				$data['currency']='';
				$data['user_id'] = 0;
				$data['sale_price']='';
				$data['updated_on']=date("Y-m-d");

				$retSaleData = $this->CarPayment->save($data);
				if($retSaleData)
				{
					$CarData=array();
					$CarData['id']=$this->data['Car']['car_id'];
					$CarData['publish']=1;
					$this->Car->save($CarData);
					echo json_encode(array('status'=>'success','data'=>$retSaleData,"message"=>"Successfully cancel"));
				}



			}else
			{
				$this->Car->set($this->data);
				if ($this->Car->carValidate())
				{
					$data=array();
					$this->CarPayment->primaryKey = 'car_id';
					$this->CarPayment->id = $this->data['Car']['car_id'];
					//$data['car_id'] = $this->data['Car']['car_id'];
					/*if($this->data['Car']['moneyType']==0)
                    {
                        $data['currency']='$';
                    }
                    else
                    {
                        $data['currency']='￥';
                    }*/
					$data['currency'] = $this->data['Car']['moneyType'];
					$data['user_id'] = $this->data['Car']['user_id'];
					$data['sale_price']=$this->data['Car']['sale_price'];

					$exiest_data_record = $this->CarPayment->find('all',array('fields'=>array('user_id','updated_on'),'conditions'=>array('car_id'=>$this->data['Car']['car_id'])));

					if($exiest_data_record[0]['CarPayment']['user_id'] == $this->data['Car']['user_id'])
					{
						$data['updated_on'] = $exiest_data_record[0]['CarPayment']['updated_on'];
					}else
					{
						$data['updated_on']=date("Y-m-d");
					}

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

				}else
				{
					echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
				}
			}


		}
		//pr($retSaleData);


	}
	/*   function for logistic*/

	public function admin_logistic(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			//	 pr($this->data);die;
			$updatedlogistic = $this->Logistic->find('first',array('fields'=>'id','conditions'=>array('Logistic.car_id'=>$this->data['Car']['car_id'])));
			//	pr($updatedlogistic); die;
			if(count($updatedlogistic)>0){
				$this->Logistic->id = $updatedlogistic['Logistic']['id'];
			}

			$this->Car->set($this->data);
			//pr($this->request->data); die;
			if ($this->Car->carValidate()) {


				$data=array();
				if(empty($this->data['Car']['created']))
				{
					$created = "  ";

				}else
				{
					$created = $this->data['Car']['created'];

				}

				$data['car_id'] = $this->data['Car']['car_id'];
				$data['yard_name'] = $this->data['Car']['yard_name'];
				//$data['port_id'] = $this->data['port_id'];
				//$data['port_id'] = $this->data['Car']['port_id'];
				$data['destination_port'] = $this->data['Car']['destination_port'];
				$data['car_in'] = $this->data['Car']['car_in'];
				$data['car_out']= $this->data['Car']['car_out'];
				$data['created']=  $created;
				$data['shipping_id']=$this->data['Car']['shipping_id'];
				//$data['transport_id']=$this->data['Car']['transport_id'];
				$data['status']=$this->data['Car']['status'];
				$data['remark']=$this->data['Car']['remark'];
				$data['ship_port']=$this->data['Car']['ship_port'];
				$data['arrival_date']=$this->data['Car']['arrival_date'];
				$data['departure_date']=$this->data['Car']['departure_date'];
				$data['port_remark']=$this->data['Car']['port_remark'];
				//pr($data); die;
				$returnData = $this->Logistic->save($data);

				if($returnData){
					echo json_encode(array('status'=>'success','data'=>$returnData,"message"=>"Successfully Saved"));

				}
			}
			else{
				echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
			}
		}


	}


	public function admin_additional(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			//	 pr($this->data);die;
			//$updatedlogistic = $this->Logistic->find('first',array('fields'=>'id','conditions'=>array('Logistic.car_id'=>$this->data['Car']['car_id'])));
			//	pr($updatedlogistic); die;
			/*if(count($updatedlogistic)>0){
                $this->Logistic->id = $updatedlogistic['Logistic']['id'];
            }*/

			$this->Car->set($this->data);
			//pr($this->request->data); die;
			if ($this->Car->carValidate()) {


				$data=array();
				if(empty($this->data['Car']['created']))
				{
					$created = "  ";

				}else
				{
					$created = $this->data['Car']['created'];

				}
//echo '<pre>'; print_r($this->data);
				$data['id']=$this->data['Car']['car_id'];
				//$data['transmission'] = $this->data['Car']['transmission'];
				//$data['drive'] = $this->data['Car']['drive'];
				//$data['fuel'] = $this->data['Car']['fuel'];
				$data['exterior_color'] = $this->data['Car']['exterior_color'];
				$data['power_steering'] = $this->data['Car']['power_steering'];
				$data['air_condition'] = $this->data['Car']['air_condition'];
				$data['alloy_wheel']= $this->data['Car']['alloy_wheel'];
				//$data['created']=  $created;
				$data['interior_color']=$this->data['Car']['interior_color'];
				$data['tv']=$this->data['Car']['tv'];
				$data['keyless_entry']=$this->data['Car']['keyless_entry'];
				$data['rear_parking_camera']=$this->data['Car']['rear_parking_camera'];
				$data['power_door']=$this->data['Car']['power_door'];
				$data['seat_heater']=$this->data['Car']['seat_heater'];
				$data['spare_key']=$this->data['Car']['spare_key'];
				$data['roof_rails']=$this->data['Car']['roof_rails'];
				$data['parking_sensor'] = $this->data['Car']['parking_sensor'];
				$data['power_window'] = $this->data['Car']['power_window'];
				$data['power_seats'] = $this->data['power_seats'];
				$data['maintenance_record'] = $this->data['Car']['maintenance_record'];
				$data['anti_break_system'] = $this->data['Car']['anti_break_system'];
				$data['airbags'] = $this->data['Car']['airbags'];
				$data['navigation'] = $this->data['Car']['navigation'];
				$data['cd_player'] = $this->data['Car']['cd_player'];
				$data['sliding_door'] = $this->data['Car']['sliding_door'];
				$data['smart_key_system'] = $this->data['Car']['smart_key_system'];
				$data['automatic_door'] = $this->data['Car']['automatic_door'];
				$data['low_down'] = $this->data['Car']['low_down'];
				$data['body_kit'] = $this->data['Car']['body_kit'];
				$data['rear_spoiler'] = $this->data['Car']['rear_spoiler'];
				$data['wind_breaker'] = $this->data['Car']['wind_breaker'];
				$data['seating_capacity'] = $this->data['Car']['seating_capacity'];
				$data['no_smoking'] = $this->data['Car']['no_smoking'];
				$data['one_owner'] = $this->data['Car']['one_owner'];
				$data['anti_theft_system'] = $this->data['Car']['anti_theft_system'];
				$data['leather_seats'] = $this->data['Car']['leather_seats'];
				$data['light'] = $this->data['Car']['light'];
				$data['md_changer'] = $this->data['Car']['md_changer'];
				$data['bench_seats'] = $this->data['Car']['bench_seats'];
				$data['double_air_condition'] = $this->data['Car']['double_air_condition'];
				$data['sunroof'] = $this->data['Car']['sunroof'];
				$data['electronic_stability_control'] = $this->data['Car']['electronic_stability_control'];
				$data['spare_tyre'] = $this->data['Car']['spare_tyre'];
				$data['fog_lamp'] = $this->data['Car']['fog_lamp'];
				$data['mud_flap'] = $this->data['Car']['mud_flap'];
				$data['remarks'] = $this->data['Car']['remarks'];

				//pr($data); die;
				$returnData = $this->Car->save($data);

				//echo '<pre>'; print_r($returnData); die;
				//$returnData = $this->data['Car']['mud_flap'];
				//$returnData = '1';
				//echo json_encode(array('status'=>'success','data'=>$returnData,"message"=>"Successfully Saved"));
				if($returnData){
					echo json_encode(array('status'=>'success','data'=>$returnData,"message"=>"Successfully Saved"));

				}
			}
			else{
				echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
			}
		}


	}


	/*  function for the clear search for Chassis number  */
	public function admin_show_all_car_detail(){
		$this->paginate = array('limit'=>10, 'order'=>array('id'=>'desc'));
		$carDetails= $this->Paginator->paginate('Car');
		//	$mydetail = $this->Car->find('all');

		$this->set('carDetail',$carDetails);
	}
	/*  function for the clear search for car name  */
	public function admin_show_all_car_number(){

		$mydetail = $this->Car->find('all');
		$this->set('mydetail',$mydetail);
	}
	/* generate  unique id */

	public function UniqueData(){

		$res=substr($carDetails['Country']['country_name'],0,1).'-'
			.$carDetails['CarPayment']['push_price'].'-'.$carDetails['CarPayment']['auction_name'].'-'.$carDetails['Car']['pdate'].'-'.
			$carDetails['CarPayment']['auction_place'];


	}
	public function uniqueid(){

		$code=substr((rand()), 5, 10);
		$UniqueNumber=$this->Car->find('count', array('conditions'=>array('stock'=>$code)));
		if($UniqueNumber)
			$this->uniqueid($code);

		return $code;

	}

	/*  clear search function here  fior chassis  */
	/*
	public function admin_render_page_chassis(){
		
		
		$limit = 5;
		$CarChassis=$this->Car->find('all');
		$count = count($CarChassis);
		$this->set('CarChassis',$CarChassis);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		
		$CarChassis= $this->Paginator->paginate('Car');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('CarChassis', $CarChassis);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}*/
	public function admin_render_page_car(){

		/*if($this->data['param']== 'new arrival')
        {

                    $this->set('new',$this->data['param']);
                    $this->paginate=array('limit'=>10,'recursive' => 3 ,'order'=>array('id'=>'desc'),'conditions'=>array('Car.publish'=>0,'CarPayment.sale_price'=>null));
                    $carDetails= $this->Paginator->paginate('Car');
                    $CarCount=$this->Car->find('count',array('conditions'=>array('Car.publish'=>0,'CarPayment.sale_price'=>null)));
                    $this->set('CarChassis',$carDetails);
                    $this->set('count',count($carDetails));

        }
        else
        {pr($this->data);
        die;
        if(!empty($this->data['param']))
            $this->set('new',$this->data['param']);
        else
            $this->set('new','');
            *
    */

		$limit = 10;
		//$CarChassis=$this->Car->find('all');
		//$CarCount=$this->Car->find('count',array('conditions'=>array('Car.publish'=>0,'CarPayment.sale_price'=>null)));
		$count = $CarCount=$this->Car->find('count',array('recursive' => 3,'conditions'=>array('AND'=>array('Car.publish'=>0,'OR'=>array('CarPayment.sale_price !='=>null,'CarPayment.sale_price'=>null)))));
		//$this->set('CarChassis',$CarChassis);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));

		$CarChassis1= $this->Paginator->paginate('Car');

		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));

		$this->set('CarChassis', $CarChassis1);
		$this->set('limit', $limit);
		$this->set('count', $count);
		//$this->set('new','');
		//}
	}

	/*    function for new arrival    */


	public function admin_new_arrival(){
		$this->autoRender = false;
		if($this->request->is('ajax')){
			//pr($this->data); die;
			$car_id=$this->data['id'];
			if(isset($car_id)){
				$this->Car->id=$car_id;
				$retData=$this->Car->saveField('new_arrival',$this->data['checked']);
				if($retData){
					echo json_encode(array('status'=>'success','message'=>'added successfully','data'=>$retData));
				}else{

					echo json_encode(array('status'=>'error','message'=>$this->Car->validationErrors));
				}
			}else{
				echo 'please check again!';

			}
		}

	}
	/* query  for find the Invoice details  */

	public function admin_getInvoice(){

		$InvoiceName=$this->CarPayment->find('all',array('conditions'=>array('CarPayment.user_id'=>$this->data['userId'])));

		$this->set('InvoiceName',$InvoiceName);

	}

	public function removeAllImage($imageSource)
	{
		foreach($imageSource as $val)
		{
			$imgPath = $val['CarImage']['image_source'];
			@unlink(WWW_ROOT.$imgPath);
		}

	}

	public function admin_car_type()
	{
		$this->autoRender = false;
		$VehicalTypr =$this->CarType->find('list',array('fields'=>array('id','type'),'conditions'=>array('CarType.p_id'=>$this->data['type'])));
		echo json_encode($VehicalTypr);

	}

	/* change tax value */
	public function admin_change_tax_value()
	{
		$tax = $this->Tax->find('first');

		$this->set('id',$tax['Tax']['id']);
		$this->set('tax_value',$tax['Tax']['tax_value']);
		$portDetail = $this->Tax->find('all',array('conditions'=>array('Tax.id !='=>1)));
		$this->set('portDetail',$portDetail);
		if($this->request->is('post'))
		{
			$data=array();
			$data['id']=$this->data['taxId'];
			$data['tax_value']= $this->data['Cars']['tax_value'];
			$this->Tax->save($data);
			$this->Session->setFlash('Tax update successfully');
			return $this->redirect(array('action' => 'change_tax_value'));

		}
	}
	public function admin_change_port_detail()
	{
		$this->autoRender = false;
		//pr($this->data);die;
		if($this->request->is('post'))
		{
			$result = $this->Tax->save($this->data);
			echo json_encode(array('done'=>'success',"message"=>"Port detail is successfully edited!",'port_name'=>$result['Tax']['port_name'],'amount'=>$result['Tax']['amount'],'p_id'=>$result['Tax']['id']));
		}

	}

	public function admin_hidden_car()
	{
		$resultCount = $this->CarPayment->find('count',array('conditions'=>array('CarPayment.currency'=>'','CarPayment.sale_price !='=>'')));

		$this->paginate=array('recursive'=>2,'order'=>'Car.id desc', 'limit'=>10,'conditions'=>array('CarPayment.currency'=>'','CarPayment.sale_price !='=>''));
		$result= $this->paginate('CarPayment');
		$this->set('carDetail',$result);
		$this->set('resultCount',$resultCount);
	}

	public function admin_view_hidden_car($id=null)
	{
		//$this->CurrencyConverter->get_rate();
		//pr($this->data);die;
		$data=array();
		$lastStock= $this->Car->find('first',array('order' => array('Car.id DESC')));		//		get last inserted data from the cars table
		$stockName= $lastStock['Car']['id']+1;										//		make here stock number from get last inserted stock number

		$tax = $this->Tax->find('first');
		$this->set('tax_value',$tax['Tax']['tax_value']);


		if($this->request->is('post')){

			$this->Car->unbindModel(array('hasOne'=>array('Logistic')));
			$this->autoRender = false;
			//	$dataSource = $this->Car->getDataSource(); //starting Transaction
			//	$dataSource->begin();

			if($this->data['Car']['new_arrival'] == 1)
			{
				$this->request->data['Car']['stock'] = '';
				$this->Car->id = $this->data['Car']['car_id'];
			}
			else
			{
				if($this->data['Car']['car_id'] == 0){

					$this->request->data['Car']['stock'] = $stockName;
					//$this->request->data['Car']['stock'] = $this->uniqueid();
				}else{

					$this->Car->id = $this->data['Car']['car_id'];
					$this->request->data['Car']['stock'] = $this->data['Car']['car_id'];
					//	$this->Car->saveField('cnumber','');

				}
			}

			$this->Car->set($this->data);

			if ($this->Car->carValidate()) {

				/* @$b = explode(' ',$this->data['manufacture_year']);
				$this->request->data['Car']['manufacture_month']=@$b['0'];
				$this->request->data['Car']['manufacture_year']=@$b['1'];*/

				$this->request->data['Car']['new_arrival_date']  = date('Y-m-d H:i:s',strtotime($this->data['Car']['new_arrival_date']));



				$retData = $this->Car->save($this->request->data);
				if($retData['Car']['car_id'] == 0){
					$retData['Car']['car_id'] = $retData['Car']['id'];
				}


				$data1  = $this->request->data['Car'];
				$data2  = $this->request->data['Car'];
				$this->CarPayment->primaryKey = 'car_id';
				//	echo "dd==".$retData['Car']['car_id']."==";
				$data1['car_id'] = $retData['Car']['car_id'];
				$data1['auction_name'] = $this->data['auction_name'];
				$data1['created_on'] = date('Y-m-d');
				$data1['recycle_price'] = $retData['Car']['recycle_price'];
				$data1['minimum_price_doller'] = $retData['Car']['minimum_price_doller'];
				$data1['minimum_price_yen'] = $retData['Car']['minimum_price_yen'];

				$retData1 = $this->CarPayment->save($data1);
				$this->CarPayment->primaryKey = 'id';

				$this->Logistic->primaryKey = 'car_id';
				$data2['car_id'] = $retData['Car']['car_id'];
				$data2['port_id'] = $retData['Car']['port_id'];
				$data2['transport_id'] = $retData['Car']['transport_id'];
				$data2['created'] = "  ";

				$retData2 = $this->Logistic->save($data2);

				//$testId = $retData1['CarPayment']['car_id'];
				$this->Car->recursion=2;

				$Cardata=$this->Car->find('first', array('conditions'=>array('Car.id' => $retData['Car']['car_id'])));

				$price =  @$Cardata['CarPayment']['push_price']/10000;
				$auc= explode('-',@$Cardata['CarPayment']['auction_name']);
				$date= explode('-',@$Cardata['Car']['pdate']);

				$myUnique=substr(@$Cardata['Country']['country_name'],0,1).'-'.@$price.'-'.@$auc[0].'-'.@$date[0].'-'.@$date[1].'-'.@$auc[1]."-".@$Cardata['Car']['lot_number'];

				//$myUnique=substr(@$Cardata['Country']['country_name'],0,1).'-'.@$auc[0].'-'.@$date[0].'-'.@$date[1].'-'.@$auc[1]."-".@$Cardata['Car']['lot_number'];

				$data['id']=$retData['Car']['car_id'];

				//$data['uniqueid']=$this->Car->uniqueid($myUnique); old code commented by sudhir
				$data['uniqueid']=$myUnique;
				$this->Car->save($data);

				//  pr($data); die;
				if($retData){
					//	$dataSource->commit();
					echo json_encode(array('status'=>'success','data'=>$retData,"message"=>"Successfully Saved"));


				}else{
					//$dataSource->rollback();
					echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));
				}

			}else{
				//$dataSource->rollback();
				echo json_encode(array("status"=>"error","message"=>$this->Car->validationErrors));


			}



		}else{

			$this->Session->delete('tempFiles');

			//for edit part
			if(isset($id)){

				$result = $this->Car->findById($id);

				if(!empty($result))
				{

					/*if($result['Country']['id'] ==2)
                    {
                        $portList=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.country_id'=>$result['Country']['id'])));
                        $this->set('AuctionData',$portList);
                        $this->set('auctionId',17);

                    }else
                    {*/

					$AuctionData=$this->Port->find('list',array('fields'=>array('Port.id','Port.port_name'),'conditions'=>array('Port.country_id'=>$result['Country']['id']),'group'=>'Port.port_name'));
					$this->set('AuctionData',$AuctionData);

					//}

					$this->set('aucttonId',$result['CarPayment']['auction_id']);

					//pr($result);die;
					$this->set('carDetails',$result);
					$this->set('car_id',$result['Car']['id']);

				}

			}
		}


		$AuctionPlaces = $this->Auction->find('list',array(
			'fields' => array('Auction.id', 'Auction.auction_name'),
		));
		$this->set('AuctionPlace',$AuctionPlaces) ;
		/*   find country    */
		$CountryDetails=$this->Country->find('all');
		// json_encode($CountryDetails);
		//$this->autoRender = false;
		$BrandDetails=$this->Brand->find('list',array('fields'=>array('Brand.brand_name')));
		$this->set('CountryDetail',$CountryDetails);
		$this->set('BrandDetail',$BrandDetails);

		/*if($result['Country']['id'] ==2)
		{
			$AuctionDetail = $this->Auction->find('all',array('fields' =>array('Auction.id','Auction.auction_name','Auction.auction_place','Auction.fees'),'conditions'=>array('Auction.country_id'=>$result['Country']['id'])));
		}else
		{
			$AuctionDetail= $this->Auction->find('all',array('fields' =>array('Auction.id','Auction.auction_name','Auction.auction_place','Auction.fees')));
		}*/

		$AuctionDetail= $this->Auction->find('all',array('fields' =>array('Auction.id','Auction.auction_name','Auction.auction_place','Auction.fees')));


		$this->set('AuctionDetail',$AuctionDetail);
		/*   user detail for   sales  tab*/
		// $User=$this->User->find('all',array('fields'=>array('User.id','User.first_name','User.email')));

		$users = $this->User->find('all',array('fields' => array('first_name','last_name','id')));
		$user_list = Set::combine($users, '{n}.User.id', array('{0} {1}', '{n}.User.first_name', '{n}.User.last_name'));

		//pr($user_list);


		//$User=$this->User->find('list',array('fields'=>array('User.id','User.first_name')));
		$this->set('user',$user_list);


		/*     find shipping country name*/
		$ShippedData=$this->Shipping->find('list',array('fields'=>array('Shipping.id','Shipping.company_name')));
		$this->set('shippedData',$ShippedData);

		/*     find Transport country name*/
		$Transports = $this->Transport->find('list',array('fields'=>array('Transport.id','Transport.transport_name')));
		$this->set('transports',$Transports);
		$this->set('transportID',2);

		/*  find CarTpye */
		$carType = $this->CarType->find('list',array('fields'=>array('CarType.id','CarType.type'),'conditions'=>array('CarType.p_id'=>0)));
		$this->set('carType',$carType);


		/*  find Vehical Tpye */
		$VehicleType = $this->CarType->find('list',array('fields'=>array('id','type'),'conditions'=>array('CarType.p_id'=>1)));
		$this->set('vehicleType',$VehicleType);

		/*   function for set the car name */

		$Car=$this->CarName->find('list',array('fields'=>array('CarName.id','CarName.car_name')));
		$this->set('Car',$Car);
		$BidData=$this->Bid->find('all',array('order'=>array('Bid.amount'=>'desc'),'conditions'=>array('Bid.car_id'=>$id),'recursive'=>2));
		//pr($BidData);die;
		$this->set('BidData',$BidData);


	}


	public function admin_search_hidden_car_chassis()
	{
		$this->autoRender = false;
		$term = $this->request->query['q'];
		$this->Car->unbindModel(array('hasMany' => array('CarImage')));
		$conditions=array('Car.cnumber LIKE' => '%'.$term.'%','CarPayment.currency ='=>'');

		$cars = $this->Car->find('all',array('conditions'=>$conditions, 'fields' =>array('Car.id','Car.cnumber'))
		);

		$result = array();
		foreach($cars as $key => $mycar)
		{
			$result[] = array("id"=>$mycar['Car']['id'],"text"=>$mycar['Car']['cnumber']);
		}

		echo json_encode($result);
	}

	public function admin_hidden_car_chassis_details()
	{
		$this->Car->unbindModel(array('hasMany' => array('CarImage')));
		if($this->request->is('ajax'))
		{

			$Cardetail= $this->Car->find('all',array('recursive'=>2,'conditions'=>array(
				'Car.cnumber LIKE' => '%'.$this->data['name'].'%','CarPayment.currency'=>''
			)));

			$this->set('carDetail',$Cardetail);
		}
	}

}

