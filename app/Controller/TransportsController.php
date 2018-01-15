<?php
App::uses('AppController', 'Controller');

class TransportsController extends AppController {
	
	public $uses = array('Car','CarImage','User','CarPayment','CarShipment','Auction','Venue','Country','Brand','Paginate','Paginator','Session','Transport');
	public $components = array('UserAuth','ControllerList','Paginator','Email');
	public $helpers = array('Common');
	var $limit = 10;
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
		//$this->User->userAuth=$this->UserAuth;
	}
	
	
	public function admin_add_transport(){
		
		if($this->request->isPost()){	
			$this->autoRender = false;
		$this->Transport->set($this->data);
		if($this->Transport->transferValidate()){
				$data = array();
				
					
					$addTransportRes = $this->Transport->save($this->data);
					//echo json_encode($addTransportRes);
					echo json_encode(array("status"=>"success","message"=>"your Transport Name is successfully added!","data"=>$addTransportRes));
					
				
				
			}else{
				
				echo json_encode(array("status"=>"error","message"=>$this->Transport->validationErrors));
				
			}
		}
		
		$limit = $this->limit;
		$Transport=$this->Transport->find('all');
		$count = count($Transport);
		$this->set('transportResult',$Transport);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));
				
		$transportResult= $this->Paginator->paginate('Transport'); 
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('transportResult', $transportResult);
		$this->set('limit', $limit);
		$this->set('count', $count);	
	}
	
	  /*  admin edit Transport name   */
	public function admin_edit_transport(){
		
		if($this->request->isPost()){
			$id = $this->data['id'];
			$name = $this->Transport->findById($id);
			$this->set('transport_name',$name['Transport']['transport_name']);
			$this->set('id',$id);
		}
	}
	
	
	
	public function admin_save_transportname(){
		$this->autoRender = false;
		if($this->request->isPost()){
			$this->Transport->set($this->data);
			if($this->Transport->transferValidate()){
				if($this->data['Transport']['id']){
					$transprtRes = $this->Transport->save($this->data);
					echo json_encode(array("status"=>"success","message"=>"Your Transport is successfully edited!","data"=>$transprtRes));
				}
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Transport->validationErrors));
			}

		}
	
	}
	
	
	
	
	
	public function admin_delete_transport ($id = null){
	$this->autoRender = false;
		if($this->request->isPost()){
			//if($this->data['model'] && $this->data['id']){
				$model = "Transport";
				$id = $this->data['id'];
				$this->$model->id = $id;
				
				$ret = $this->$model->beforeDelete();
				$this->$model->create();
				if($ret==1){
					$this->$model->deleteAll(array($model.'.id'=>$id));
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!","data"=>$id));
				
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
		$Transport = $this->Transport->find('all',array('conditions'=>array(					
						'Transport.transport_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('Transport.id','Transport.transport_name'))
       );

    // Format the result for select1
		$result = array();
		foreach($Transport as $key => $mytransport) {
			$result[] = array("id"=>$mytransport['Transport']['id'],"text"=>$mytransport['Transport']['transport_name']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_transport_detail(){
		if($this->request->is('ajax')){

			$Transport = $this->Transport->find('all',array('conditions'=>array(
					'Transport.transport_name LIKE' => '%'.$this->data['name'].'%',
					)));
			$this->set('Transport',$Transport);
			$this->set('pages', $this->data['pageNo']);
		}
	}
	
	public function admin_show_all_user(){
		if($this->request->is('ajax')){
			$Transport = $this->Transport->find('all');
			$this->set('Transport',$Transport);
		}
	}
	
	public function admin_render_page_transport(){
		
		
		$limit = $this->limit;
		$Transport=$this->Transport->find('all');
		$count = count($Transport);
		$this->set('Transport',$Transport);
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		
		$transportResult= $this->Paginator->paginate('Transport');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('transportResult', $transportResult);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
}
