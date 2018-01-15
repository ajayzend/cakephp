<?php
App::uses('AppController', 'Controller');  

class ShippingsController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User','Shipping', 'UserGroup', 'LoginToken','Country','Auction','Transport');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
	var $limit = 10;
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
	
	
	public function admin_add_shipping() 
	{
		

		if($this->request->isPost())
		{	$this->autoRender = false;
			$this->Shipping->set($this->data);
			if($this->Shipping->shippingValidation()){
				
				$data = array();
				$data['company_name'] = $this->data['Shipping']['company_name'];
				$Shipping = $this->Shipping->save($data);
				//echo json_encode($Shipping);
				echo json_encode(array("status"=>"success","message"=>"your Shipping Name is successfully added!","data"=>$Shipping));
				
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Shipping->validationErrors));
			}
		}
		
		$limit = $this->limit;
		$Shipping=$this->Shipping->find('all');
		$count = count($Shipping);
		$this->set('Shipping',$Shipping);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		$Shipping= $this->Paginator->paginate('Shipping');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}
				
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0')); 		
		$this->set('Shipping', $Shipping);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}


	   /*  admin edit Brand   */
	public function admin_edit_shipping($id = null){
		if($this->request->isPost()){
			$id = $this->data['id'];
			$name = $this->Shipping->findById($id);
			$this->set('company_name',$name['Shipping']['company_name']);
			$this->set('id',$id);
		}
	
	}
	
	/* this function used when user want edit our brand name  by admin_edit_brand.ctp*/
	public function admin_save_shipping(){
		$this->autoRender = false;
		if($this->request->isPost()){
			$this->Shipping->set($this->data);
			if($this->Shipping->shippingValidation()){
				if($this->data['Shipping']['id']){
					$shipRes = $this->Shipping->save($this->data);
					echo json_encode(array("status"=>"success","message"=>"Your Shipping is successfully edited!","data"=>$shipRes));
				}
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Shipping->validationErrors));
			}
		}
	}
	
	public function admin_delete_shipping(){
		$this->autoRender = false;
		if($this->request->isPost()){
			//if($this->data['model'] && $this->data['id']){
				$model = "Shipping";
				$id = $this->data['id'];
				$this->$model->id = $id;
				
				//$ret = $this->$model->beforeDelete();
				//$this->$model->create();
				
					if($this->$model->delete($id)){
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!","data"=>$id));
					
				
				}else{
					echo json_encode(array("status"=>"error","message"=>"not deleted! ","data"=>$id));
					
				}
				
			//}else{
				
			//}	
				
			
		
		}
	
	}
	
	
	public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
		$term = $this->request->query['q'];
		$Shipping = $this->Shipping->find('all',array('conditions'=>array(					
						'Shipping.company_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('Shipping.id','Shipping.company_name'))
       );

    // Format the result for select1 
		$result = array();
		foreach($Shipping as $key => $myshipping) {
			$result[] = array("id"=>$myshipping['Shipping']['id'],"text"=>$myshipping['Shipping']['company_name']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_shipping_detail(){
		if($this->request->is('ajax')){

			$Shipping = $this->Shipping->find('all',array('conditions'=>array(
					'Shipping.company_name LIKE' => '%'.$this->data['name'].'%',
					)));
				echo $this->data['pageNo'];
			$this->set('Shipping',$Shipping);
			$this->set('pages', $this->data['pageNo']);
		}
	}
	
	public function admin_show_all_user(){
		if($this->request->is('ajax')){
			$Shipping = $this->Shipping->find('all',array('order'=>array('id'=>'DESC')));
			$this->set('Shipping',$Shipping);
		}
	}
	
	public function admin_render_page_shipping(){
		
		
		$limit = $this->limit;
		$Shipping=$this->Shipping->find('all');
		$count = count($Shipping);
		$this->set('Shipping',$Shipping);
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}
		
		$Shipping= $this->Paginator->paginate('Shipping');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('Shipping', $Shipping);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
		
}
