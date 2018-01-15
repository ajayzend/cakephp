<?php
App::uses('AppController', 'Controller');

class DashboardUserController extends AppController {
	public $components = array('UserAuth','ControllerList');
	public function beforeFilter() {
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
		$this->User->userAuth=$this->UserAuth;
	}
	
	public function admin_index() {}
}
