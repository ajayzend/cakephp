<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all 
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');    

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller { 
		var $helpers = array('Form', 'Html', 'Session', 'Js', 'UserAuth');
		
		public $components = array('Session','RequestHandler', 'UserAuth','Email');
		public $uses = array('User', 'CarType','Page');
		public $cacheAction = true;
		function beforeFilter(){
			$this->set('datasourceTest',$this->User->dbConfig);
			$this->userAuth();
			$this->checkNonAdminAccess();

			if($this->Session->read('LANGUAGE') == "")
			{
				$this->Session->write('LANGUAGE', "1");
			}
			if(@$_GET['lang'] != "")
			{
				if($_GET['lang'] == "jpy")
				{
					$this->Session->write('LANGUAGE', "1");
				}
				else
				{
					$this->Session->write('LANGUAGE', "2");
				}
			}
			
			$CarMainType = $this->CarType->find('all' , array('conditions'=>array('p_id'=>0)));
			$this->set('mainCarType',$CarMainType);
			
			$footer = $this->Page->find('first',array('conditions'=>array('Page.title'=>'Footer')));

			$this->set('footer',$footer);
		}
		private function userAuth(){

			$users=$this->User->find('all', array('conditions' => array('User.id'=> $this->Session->read('UserAuth.User.id'),'User.user_group_id !=' => 1)));
			if(!empty($users))
			{
				$defaultUserName = $users[0]['User']['first_name']." ".$users[0]['User']['last_name'];
				//$this->set('defaultUserName',$defaultUserName);
				$this->Session->write('defaultUserName', $defaultUserName);
			}
			$this->UserAuth->beforeFilter($this);
			
			
		}

	function checkNonAdminAccess()
	{
		$groupId = $this->Session->read('UserAuth.User.user_group_id');
		if($groupId == 2 && $this->params['prefix'] == 'admin'){
			//echo "<pre>";print_r($this->params);die;
			$ctrl = $this->params['controller'];
			$action = $this->params['action'];
			if($ctrl == 'cars' || $action == 'admin_logout'){
				//die('okk');
				/*echo $this->params['url'];
				echo $this->params['action'];
				die;
				var_dump($this);*/
			}else{
				die('You are not permitted to acces this page.');
			}

		}
	}
}
