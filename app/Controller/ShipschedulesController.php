<?php
App::uses('AppController', 'Controller'); 

class ShipschedulesController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses= array('User','Car','Shipschedule');
    public $components = array('UserAuth','ControllerList','Paginator','PhpExcel','Paginator');
	public $helpers = array('PhpExcel','Paginator','Common');  
	
	public function beforeFilter()
	{
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
		//$this->User->userAuth=$this->UserAuth;
	}
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	
	 
	public function admin_index()
	{	
		if($this->request->isPost())
		{	$this->autoRender = false;
			$this->Shipschedule->set($this->data);
			if($this->Shipschedule->Validation()){
				
				$Shipping = $this->Shipschedule->save();
				//echo json_encode($Shipping);
				echo json_encode(array("status"=>"success","message"=>"your Shipping Schedule is successfully added!","data"=>$Shipping));
				
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Shipschedule->validationErrors));
			}
		}
		
		$limit = 10;
		$shippingSchedule=$this->Shipschedule->find('all');
		$count = count($shippingSchedule);
		$this->set('shippingSchedule',$shippingSchedule);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		$shippingSchedule= $this->Paginator->paginate('Shipschedule');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0')); 		
		$this->set('shippingSchedule', $shippingSchedule);
		$this->set('limit', $limit);
		$this->set('count', $count);
			
	}
	
	public function admin_render_page_shipping(){
		
		
		$limit = 5;
		$shippingSchedule=$this->Shipschedule->find('all');
		$count = count($shippingSchedule);
		$this->set('shippingSchedule',$shippingSchedule);
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}
		
		$shippingSchedule= $this->Paginator->paginate('Shipschedule');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('shippingSchedule', $shippingSchedule);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	public function admin_editSchedule($id = null,$pageNo=null)
	{ 
		if($this->request->isPost())
		{

			$this->autoRender = false;
			$this->Shipschedule->set($this->data);
			if($this->Shipschedule->Validation())
			{
				$data = array();
				$data['Shipschedule']['id'] = $this->data['id'];
				$data['Shipschedule']['ship_name'] = $this->data['ship_name'];
				$data['Shipschedule']['region'] = $this->data['region'];
				$data['Shipschedule']['departure_port']= $this->data['departure_port'];
				$data['Shipschedule']['departure_date'] = $this->data['departure_date'];
				$data['Shipschedule']['arrival_port']= $this->data['arrival_port'];
				$data['Shipschedule']['arrival_date'] = $this->data['arrival_date'];
				$data['Shipschedule']['remark'] = $this->data['remark'];
				$data['Shipschedule']['chasis'] = $this->data['chasis'];
				
				$this->Shipschedule->save($data);
				$returnData = $this->Shipschedule->findById($data['Shipschedule']['id']);
				echo json_encode(array('status'=>'success',"message"=>"Your Port information is successfully edited!",'data'=>$returnData,"pageNo"=>$pageNo));
			}else
			{
				echo json_encode(array("status"=>"error","message"=>$this->Shipschedule->validationErrors));
				
			};
		}
	}
	
	public function admin_delete()
	{
		$this->autoRender = false;
		if($this->request->isPost())
		{
			//if($this->data['model'] && $this->data['id']){
				$model = "Shipschedule";
				$id = $this->data['id'];
				$this->$model->id = $id;
				
				$ret = $this->$model->beforeDelete();
				$this->$model->create();
				if($ret==1)
				{
					$this->$model->deleteAll(array($model.'.id'=>$id));
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!","data"=>$id));
				
				}else
				{
					echo json_encode(array("status"=>"error","message"=>"not deleted! ","data"=>$id));
				}		
		}
	
	}
	
	public function admin_show_departure_port()
	{
		$this->autoRender = false;
		$term = $this->request->query['term'];
  
		$departurePort = $this->Shipschedule->find('all',array('conditions'=>array('Shipschedule.departure_port LIKE' => '%'.$term.'%'),'fields' =>array('Shipschedule.departure_port'),'group'=>'Shipschedule.departure_port'));

		$d=array();
		
		foreach($departurePort as $val)
		{
			$d[] = $val['Shipschedule']['departure_port'];
		}
		echo json_encode($d);
		
	}
	
	public function admin_show_arrival_port()
	{
		$this->autoRender = false;
		$term = $this->request->query['term'];

		$arrivalPort = $this->Shipschedule->find('all',array('conditions'=>array('Shipschedule.arrival_port LIKE' => '%'.$term.'%'),'fields' =>array('Shipschedule.arrival_port'),'group'=>'Shipschedule.arrival_port'));

    // Format the result for select1
		$d=array();
		
		foreach($arrivalPort as $val)
		{
			$d[] = $val['Shipschedule']['arrival_port'];
		}
		echo json_encode($d);		
	}
	
	public function admin_show_region()
	{
		$this->autoRender = false;
		$term = $this->request->query['term'];
  
 
		$region = $this->Shipschedule->find('all',array('conditions'=>array('Shipschedule.region LIKE' => '%'.$term.'%'),'fields' =>array('Shipschedule.region'),'group'=>'Shipschedule.region'));
		$d=array();
		
		foreach($region as $val)
		{
			$d[] = $val['Shipschedule']['region'];
		}
		echo json_encode($d);
		
	} 
	
	public function admin_show_ship_name()
	{
		$this->autoRender = false;
		$term = $this->request->query['term'];
  
 
		$region = $this->Shipschedule->find('all',array('conditions'=>array('Shipschedule.ship_name LIKE' => '%'.$term.'%'),'fields' =>array('Shipschedule.ship_name'),'group'=>'Shipschedule.ship_name'));
		$d=array();
		
		foreach($region as $val)
		{
			$d[] = $val['Shipschedule']['ship_name'];
		}
		echo json_encode($d);
		
	}
	
	public function admin_ship_status()
	{
		$status = $this->data['status'];
		$ship_id= $this->data['id'];
					
		$this->Shipschedule->read(null, $ship_id);
		$this->Shipschedule->set('status', $status);
		
		$update = $this->Shipschedule->save();
		if($update && $status == 1) {
			echo "Unpublish";
		} else {
			echo "Publish";
		}	
		die;  	
		
	}
	
	
   }


	
