<?php
App::uses('AppController', 'Controller');

class StaffsController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Users');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
	var $limit =10;
	var $perPage = 1;
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		//$this->UserAuth->loginPage='/admin/login';
		$this->UserAuth->loginPage='/';
		parent::beforeFilter();
		$this->layout='default_admin';
	}
	/**
	 * Used to display all users by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function admin_index() {
		
		$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$count=$this->User->find('count', array('conditions' => array(array('OR' => array(array('User.user_group_id ' => 4), array('User.user_group_id ' => 1))))));
		
		$limit = $this->limit;
		
		$this->paginate = array(        
        'limit' => $limit,
        'conditions' => array('OR' => array(array('user_group_id' => 1), array('user_group_id' => 4))),
        'order' => array(
			'User.id' => 'desc'
			)
		);
		
			
		$users = $this->Paginator->paginate('User');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('users', $users);
		
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	/**
	 * Used to add Staff Member on the site by Admin
	 *
	 * @access public
	 * @return void
	 */
	public function admin_addStaff() {
		
		if ($this->request -> isPost()) {
			//pr($this->data);die;
			
			$UsCh=$this->Users->query("SELECT * FROM users WHERE username = '".$this->request->data['staffs']['username']."'");
			
			if(count($UsCh) > 0)
			{
				$this->Session->setFlash(__(' Username is Alread Exists'));
			}
			else
			{
				$this->Users->create();
				unset($data);
				
				
				
				$data['Users']['first_name'] = $this->request->data['staffs']['first_name'];
				$data['Users']['username'] = $this->request->data['staffs']['username'];
				$data['Users']['user_group_id'] = $this->request->data['staffs']['user_group_id'];
				$data['Users']['permission'] = json_encode($_POST['staff_permission']);
                                $data['Users']['email_verified'] = 1;
                                $data['Users']['email'] = $this->request->data['staffs']['username'].'@bizupon.com';
				$data['Users']['active'] = 1;
	
				$salt=$this->UserAuth->makeSalt();
				$data['Users']['salt'] = $salt;
				$data['Users']['password'] = $this->UserAuth->makePassword($this->request->data['staffs']['password'], $salt);
				$save = $this->Users->save($data,false);
				$this->Session->setFlash(__(' Staff is successfully added'));
				$this->redirect('/admin/staffs/index/');
			}
		}
	}
	
	public function admin_editStaff($userId=null)
	{
		$result =$this->User->find('all', array('conditions' => array('User.id'=>$userId)));
		$this->set("staff", $result);
		
		if ($this->request -> isPost()) {
			//pr($this->data);die;
			
			unset($data);
			$data['Users']['id'] = $_POST['id'];
			$data['Users']['first_name'] = $this->request->data['staffs']['first_name'];
			$data['Users']['username'] = $this->request->data['staffs']['username'];
			$data['Users']['user_group_id'] = $this->request->data['staffs']['user_group_id'];
			$data['Users']['permission'] = json_encode($_POST['staff_permission']);
			
			if($this->request->data['staffs']['password'] != "")
			{
				$salt=$this->UserAuth->makeSalt();
				$data['Users']['salt'] = $salt;
				$data['Users']['password'] = $this->UserAuth->makePassword($this->request->data['staffs']['password'], $salt);
			}
			
			$save = $this->Users->save($data,false);
			$this->Session->setFlash(__(' Staff is successfully added'));
			$this->redirect('/admin/staffs/index/');
		}
	}
	
	public function admin_delete($id) {
		$this->autoRender = false;
		if ($this->request -> isPost()) {
			
			if ($this->Users->delete($id, false)) {
				$this->Session->setFlash(__(' Staff Deleted Successfully'));
				$this->redirect('/admin/staffs/index/');
			}
		}
	}
}
