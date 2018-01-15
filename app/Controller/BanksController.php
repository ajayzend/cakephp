
<?php
App::uses('AppController', 'Controller');

class BanksController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User','Bank', 'UserGroup', 'LoginToken');
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
	
	public function admin_index() {
			
		//$this->set('bankDetails',$bankDetails);
		
		$limit = $this->limit;
		$bankDetails=$this->Bank->find('all');
		$count = count($bankDetails);
		$this->set('bankDetails',$bankDetails);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));  
		$bankDetails = $this->Paginator->paginate('Bank');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}

		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('bankDetails', $bankDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);
		
	}
	
	
	public function admin_add() { 
		$this->layout = false;
		//pr($this->data);die;
				if ($this->request -> isPost())
				{
					$this->autoRender = false;
					
					//pr($this->data);
					//die;
					$this->Bank->set($this->data);
					if($this->Bank->bankValidation()){
					
						$this->Bank->set($this->data);
						$data = array();
						$data['Bank']['bank_name'] = $this->data['Bank']['bank_name'];
						$data['Bank']['branch_name'] = $this->data['Bank']['branch_name'];
						$data['Bank']['swift_name'] = $this->data['Bank']['swift_name'];
						$data['Bank']['account_no'] = $this->data['Bank']['account_no'];
						$data['Bank']['account_name'] = $this->data['Bank']['account_name'];
						$data['Bank']['discription'] = $this->data['Bank']['discription'];						

						$return = $this->Bank->save($data);
						
						$returnData = $this->Bank->findById($return['Bank']['id']);
						//$this->autoRender = false;
						echo json_encode(array('status'=>'success',"message"=>"Your Bank information is successfully added!",'data'=>$returnData));	
					}else{
						echo json_encode(array("status"=>"error","message"=>$this->Bank->validationErrors));
					}					
				}else{
					
		
		}	
			
	}

	
	public function admin_update($id=null,$pageNo=null) {

	
		if ($this->request -> isPost())
		{	
			echo $pageNo;
			$this->autoRender = false;
			$this->Bank->set($this->data);
			if($this->Bank->bankValidation()){
				$data = array();
				$data['Bank']['id'] = $this->data['id'];
				$data['Bank']['bank_name'] = $this->data['bank_name'];
				$data['Bank']['swift_name'] = $this->data['swift_name'];
				$data['Bank']['account_no']= $this->data['account_no'];
				$data['Bank']['account_name'] = $this->data['account_name'];
				$data['Bank']['discription'] = $this->data['discription'];
				$this->Bank->save($data);
				$returnData = $this->Bank->findById($data['Bank']['id']);
				echo json_encode(array('status'=>'success',"message"=>"Your Bank information is successfully edited!",'data'=>$returnData,"pageNo"=>$pageNo));
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Bank->validationErrors));
				
			}
			
										
		}else{
				$this->layout = false;
				$bankData = $this->Bank->find('all',array('conditions'=>array('Bank.id'=>$id)),array('order'=>'Bank.id desc'));
				foreach($bankData as $key=>$val)
				{
					$bankId = $val['Bank']['id'];
					$bankName = $val['Bank']['bank_name'];
					$branchName = $val['Bank']['branch_name'];
					$swiftName = $val['Bank']['swift_name'];
					$accountNo = $val['Bank']['account_no'];
					$accountName = $val['Bank']['account_name'];
					$discription = $val['Bank']['discription'];
				}
				$this->set('bankId',$bankId);
				$this->set('bankName',$bankName);
				$this->set('branchName',$branchName);
				$this->set('swiftName',$swiftName);
				$this->set('accountNo',$accountNo);
				$this->set('accountName',$accountName);
				$this->set('discription',$discription);
			$this->set('pages',$pageNo);		

			}
	}
	
	public function admin_delete() {
		$this->autoRender = false;
		
			if ($this->request -> isPost()) {
				
				if ($this->Bank->delete($this->data['id'], false)) {
					
					echo json_encode(array("status"=>"success","message"=>"Record Deleted!"));
				}
			
			
		} else {
			echo json_encode(array('status'=>'failure'));
		}
		
	}
	
	public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
   $term = $this->request->query['q'];

 
    $BankResult = $this->Bank->find('all',array('conditions'=>array(					
						'Bank.bank_name LIKE' => '%'.$term.'%' ,
					),
					
					'fields' =>array('Bank.id','Bank.bank_name'))
       );
    
			$result = array();
		foreach($BankResult as $key => $value) {
			$result[] = array("id"=>$value['Bank']['id'],"text"=>$value['Bank']['bank_name']);	
					}
		echo json_encode($result);
		 
	}
	 
	public function admin_bank_detail(){
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}	
			
		if($this->request->is('ajax')){	
	
			$count=$this->Bank->find('count',array('conditions'=>array(
							'Bank.id' =>$this->data['id'],
							)));
			$limit = $this->limit;
			$this->paginate = array(        
			'limit' => $limit,
			'conditions' => array('Bank.id' =>$this->data['id']),
			'order' => array(
				'Bank.id' => 'desc'
				)
			);	
			$Bank = $this->Paginator->paginate('Bank');
				
			//$this->set('pages', $this->data['pageNo']);
			
			
					
			$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
			$this->set('Bank', $Bank);
			$this->set('limit', $limit);
			$this->set('count', $count);
			$this->set('searchName',$this->data['name']);
			
		} else{
			//echo $key;
			echo $this->passedArgs['searchName'];
			//$this->passedArgs['page'];
			
			$count=$this->Bank->find('count',array('conditions'=>array(
							'Bank.bank_name LIKE' => '%'.$this->passedArgs['searchName'].'%',
							)));
			$limit = $this->limit;
			$this->paginate = array(        
			'limit' => $limit,
			'conditions' => array('Bank.bank_name LIKE' => '%'.$this->passedArgs['searchName'].'%'),
			'order' => array(
				'Bank.id' => 'desc'
				)
			);	
			$Bank = $this->Paginator->paginate('Bank');
			
			$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
			$this->set('Bank', $Bank);
			$this->set('limit', $limit);
			$this->set('count', $count);
			$this->set('searchName',$this->passedArgs['searchName']);
		}
		
		
	}
	
	
	public function admin_render_page_bank(){
		
		
		$limit = $this->limit;
		$Bank=$this->Bank->find('all');
		$count = count($Bank);
		$this->set('Bank',$Bank);
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}	
		
		$bankDetails= $this->Paginator->paginate('Bank');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('bankDetails', $bankDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	public function admin_paginate_search(){
		
		//echo $this->passedArgs['searchName'];
			//$this->passedArgs['page'];
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}	
			
		$count=$this->Bank->find('count',array('conditions'=>array(
						'Bank.bank_name LIKE' => '%'.$this->passedArgs['searchName'].'%',
						)));
		$limit = $this->limit;
		$this->paginate = array(        
		'limit' => $limit,
		'conditions' => array('Bank.bank_name LIKE' => '%'.$this->passedArgs['searchName'].'%'),
		'order' => array(
			'Bank.id' => 'desc'
			)
		);	
		$Bank = $this->Paginator->paginate('Bank');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('Bank', $Bank);
		$this->set('limit', $limit);
		$this->set('count', $count);
		$this->set('searchName',$this->passedArgs['searchName']);
	
	}
		
}
