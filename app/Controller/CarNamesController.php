<?php
App::uses('AppController', 'Controller');  

class CarNamesController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User','Shipping', 'UserGroup', 'LoginToken','Country','Auction','Transport','CarName','Brand');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
    var	$limit = 10;
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
	
	
	public function admin_add_carname() 
	{
		if($this->request->isPost())
		{	$this->autoRender = false;
			$this->CarName->set($this->data);
			if($this->CarName->carValidation()){
				
				$data = array();
				$data['car_name'] = $this->data['CarName']['car_name'];
				$data['brand_id'] = $this->data['CarName']['brand_id'];
				
				$CarName = $this->CarName->save($data);
				echo json_encode(array("status"=>"success","message"=>"your Car Name is successfully added!","data"=>$CarName));
				
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->CarName->validationErrors));
			}
		}
		
		$limit = $this->limit;
		
		$CarName=$this->CarName->find('all');
		
		$count = count($CarName);
		$this->set('CarName',$CarName);
		
		$this->paginate = array('limit'=>$limit, 'order'=>array('CarName.id'=>'DESC'));
		$CarName= $this->Paginator->paginate('CarName');
		
		
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}
		
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('CarName', $CarName);
		$this->set('limit', $limit);
		$this->set('count', $count);
		
		$Brand=$this->Brand->find('all');
		$this->set("BrrandNames", $Brand);
	}


	   /*  admin edit Brand   */
	public function admin_edit_carname($id = null){
		if($this->request->isPost()){
			$id = $this->data['id'];
			$name = $this->CarName->findById($id);
			$this->set('car_name',$name['CarName']['car_name']);
			$this->set('carBrand',$name['CarName']['brand_id']);
			$this->set('id',$id);
			
			$Brand=$this->Brand->find('all');
			$this->set("BrrandNames", $Brand);
		}
	
	}
	
	/* this function used when user want edit our brand name  by admin_edit_brand.ctp*/
	public function admin_save_carname(){
		$this->autoRender = false;
		if($this->request->isPost()){
			$this->CarName->set($this->data);
			if($this->CarName->carValidation()){
				if($this->data['CarName']['id']){
					$carRes = $this->CarName->save($this->data);
					//echo json_encode($carRes);
					$CarName=$this->CarName->find('all', array('conditions' => array("CarName.id" => $this->data['CarName']['id'])));
					
					$Arr = array("id" => $CarName[0]['CarName']['id'], "name" => $CarName[0]['CarName']['car_name'], "brand" => $CarName[0]['Brand']['brand_name']);
					echo json_encode(array("status"=>"success","message"=>"Your Car Name is successfully edited!","data"=>$Arr));
				}
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->CarName->validationErrors));
			}
		}
	}
	
	public function admin_delete_carname(){
		$this->autoRender = false;
		if($this->request->isPost()){
			//if($this->data['model'] && $this->data['id']){
				$model = "CarName";
				$id = $this->data['id'];
				//$pageNo = $this->data['pageNo'];
				$this->$model->id = $id;
				
				$ret = $this->$model->beforeDelete();
				$this->$model->create();
				if($ret==1){
					$this->$model->deleteAll(array($model.'.id'=>$id));
					echo json_encode(array("status"=>"success","message"=>"Record Deleted","data"=>$id));
				
				}else{
					echo json_encode(array("status"=>"error","message"=>"You can not delete a Category which has products ","data"=>$id));
				}
				
			//}else{
				
			//}	
				
			
		
		}
	
	}
	
	
	public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
		$term = $this->request->query['q'];
		$CarName = $this->CarName->find('all',array('conditions'=>array(					
						'CarName.car_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('CarName.id','CarName.car_name'))
       );

    // Format the result for select1
		$result = array();
		foreach($CarName as $key => $mycarname) {
			$result[] = array("id"=>$mycarname['CarName']['id'],"text"=>$mycarname['CarName']['car_name']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_carname_detail(){
		if($this->request->is('ajax')){

			$CarName = $this->CarName->find('all',array('conditions'=>array(
					'CarName.car_name LIKE' => '%'.$this->data['name'].'%',
					)));
			$this->set('CarName',$CarName);
			$count = count($CarName);
			$this->set('count', $count);
			$this->set('pages', $this->data['pageNo']);
		}
	}
	
	public function admin_show_all_user(){
		if($this->request->is('ajax')){
			$CarName = $this->CarName->find('all');
			$this->set('CarName',$CarName);
		}
	}
	
	public function admin_render_page_carname(){
		
		//pr($this->data);
		$limit = $this->limit;
		$CarName=$this->CarName->find('all');
		$count = count($CarName);
		$this->set('CarName',$CarName);
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}
		$CarName= $this->Paginator->paginate('CarName');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		//$this->set('pages', $this->params->params['named']['page']);
		$this->set('CarName', $CarName);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	
}
