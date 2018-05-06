<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User', 'UserGroup', 'LoginToken','Car','Bid','Bank','CarImage','Paginate','Paginator','ClientPaymentHistory','CarPayment','Country','Invoice','InvoiceDetail');
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
		$this->User->userAuth=$this->UserAuth;
	}
	/**
	 * Used to display all users by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function admin_index() {
		$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$users=$this->User->find('all', array('order'=>'User.id desc'));
		$this->set('users', $users);
	}
	
	/**
	 * Used to display all users by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function admin_allUsers() {
		$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$count=$this->User->find('count', array('conditions' => array('User.user_group_id !=' => 1)));
		
		$limit = $this->limit;
		
		$this->paginate = array(        
        'limit' => $limit,
        'conditions' => array('User.user_group_id !=' => 1),
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
	 * Used to add user on the site by Admin
	 *
	 * @access public
	 * @return void
	 */
	public function admin_addUser() {
		$userGroups=$this->UserGroup->getGroups();
		$this->set('userGroups', $userGroups);
		
		$bankDetails = $this->Bank->find('list', array('fields'=>array('Bank.id','Bank.bank_name'),'order' => array('Bank.id' => 'ASC')));
		$this->set('bankDetails',$bankDetails);
		
		
		if ($this->request -> isPost()) {
			//pr($this->data);die;
			$this->User->set($this->data);
			if ($this->User->RegisterValidate()) {

				$uniqueData = $this->getUniqueCountoryId($this->data['User']['uniqueid']);
					
				$this->request->data['User']['country'] = $this->data['User']['uniqueid'];
				$this->request->data['User']['bank_id'] = $this->data['User']['bank_id'];
				$this->request->data['User']['email_verified']=1;
				$this->request->data['User']['uniqueid']=$uniqueData;
				$this->request->data['User']['active']=1; 
				$salt=$this->UserAuth->makeSalt();
				$this->request->data['User']['salt'] = $salt;
				$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$save = $this->User->save($this->request->data,false);
				$this->Session->setFlash(__(' User is successfully added'));
				$this->redirect('/admin/users/allUsers/');
			}
		}
		$CounrtyDetails = $this->Country->find('list', array('fields'=>array('Country.id','Country.country_name')));		
		$this->set('CounrtyDetails',$CounrtyDetails);
	}
	
	/**
	 * This function show payment view page 
	 *
	 * @access public
	 * @return array
	 */
	
	public function admin_clientHistory($id=null) 
	{
				if($id){
					$userId = $id;
				}else{
					$userId="";
				}
				$this->set('selectedListId',$userId);
				
				$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name,'[',User.uniqueid,']')");
				
				$ClientDetails = $this->User->find('list', array('fields'=>array('User.id','User.full_name'),'conditions' => array('User.user_group_id !=' => 1)));		
				$this->set('ClientDetails',$ClientDetails);
				
				
				$userDetails = $this->User->find('first', array('order'=>'User.id desc','conditions' => array('User.user_group_id !=' => 1,'User.id'=>$id)));
				$this->set('userDetails',$userDetails);
				
				$paymentTotal =  $this->ClientPaymentHistory->find('all', array('fields' =>
				array('SUM(ClientPaymentHistory.amount) as Amount','SUM(ClientPaymentHistory.yen_amount) as AmountYen'),'conditions'=>array('ClientPaymentHistory.client_id'=>$id),'group'=>array('ClientPaymentHistory.client_id')));
				
				if($paymentTotal)
				{	
					foreach($paymentTotal as $k=>$v)
					{
						$pTotal = $v['0']['Amount'];	
						$pTotalYen = $v['0']['AmountYen'];					
						/*$yenInDoller = $pTotalYen / $this->Session->read('yenRate');
						$this->set('pTotalYen',$yenInDoller);
						$allPaymentTotal = $pTotal + $yenInDoller;
						$allPaymentTotal = round($allPaymentTotal,2);*/
						$this->set('pTotal',$pTotal );
						$this->set('pTotalYen',$pTotalYen );
					}
				}else
				{
					$pTotal = 0;
					$this->set('pTotal',$pTotal);
					$pTotalYen = 0;
					$this->set('pTotalYen',$pTotalYen);
				}


				// change query for get doller sum  data
				
				//$saleTotal =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.sale_price) as Sale_Amount','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.sale_price !='=>''),'group'=>array('CarPayment.user_id')));	
				
				$saleTotal =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.sale_price) as Sale_Amount','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.sale_price !='=>'','CarPayment.currency '=>'$'),'group'=>array('CarPayment.user_id')
				));
				
				
				if($saleTotal)
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
				}
				
				// change query for get Yen sum  data
				$saleYenTotal =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.sale_price) as Sale_Amount','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.sale_price !='=>'','CarPayment.currency '=>'￥'),'group'=>array('CarPayment.user_id')
				));	
				
				if($saleYenTotal)
				{
					foreach($saleYenTotal as $k=>$v)
					{
						$sYenTotal = $v['0']['Sale_Amount'];
						$this->set('sYenTotal',$sYenTotal);
					}
				}
				else
				{
					$sYenTotal = 0;
					$this->set('sYenTotal',$sYenTotal);
				}
				

				$balanceDollerTotal = @$pTotal - $sTotal;
				$this->set('balanceTotal',$balanceDollerTotal);
				
				$balanceYenTotal = @$pTotalYen - $sYenTotal;
				$this->set('balanceYenTotal',$balanceYenTotal);

				$balanceTotalYen = @$allPaymentTotal * $this->Session->read('yenRate');
				$this->set('balanceTotalYen',$balanceTotalYen);
					
				$PaymentDetails = $this->ClientPaymentHistory->find('all',array('conditions' => array('ClientPaymentHistory.client_id' => $id),'order' => array('ClientPaymentHistory.payment_date DESC')));						
				$this->set('PaymentDetails',$PaymentDetails);
				
				$pastDate = "2013-01-01";
				$curDate = date("Y-m-d");

				//Buy history
				$BuyDetails = $this->getInvoiceDetailsByUser($id,$pastDate,$curDate);
				$this->set('BuyInvDetails',$BuyDetails);

				//sale history
				$SaleDetails = $this->getSaleInvoiceDetailsByUser($id,$pastDate,$curDate);
				$this->set('SaleInvDetails',$SaleDetails);


				
				//all history
				$SaleDetails = $this->User->getAllHistoryByUserId($id);
				$this->set('SaleDetails',$SaleDetails); 
		
	}
		/** For Balance Overview **/
		
	public function admin_balance_detail($id=null) 
	{

			$cTotal =  $this->ClientPaymentHistory->query('SELECT User.first_name, User.last_name, sum( ClientPaymentHistory.amount ) AS Amount, sum( ClientPaymentHistory.yen_amount ) AS Yen_amount, ClientPaymentHistory.client_id
				FROM client_payment_histories AS ClientPaymentHistory
				LEFT JOIN users AS User ON User.id = ClientPaymentHistory.client_id
				WHERE User.deleted =0
				AND ClientPaymentHistory.deleted =0
				AND ClientPaymentHistory.client_id !=0
				AND User.user_group_id !=1
				GROUP BY ClientPaymentHistory.client_id');

		$saleTotal = array();
		foreach ($cTotal as $value)
		{	
			$salePrice = array();
			$user_id = $value['ClientPaymentHistory']['client_id'];
			$salePrice['saleDoller'] = $this->CarPayment->find('all',array('fields'=>array('sum(CarPayment.sale_price) as SalePriceDoller,CarPayment.user_id as id'),'conditions'=>array('CarPayment.currency'=>'$','CarPayment.deleted ='=>0,'CarPayment.user_id !='=>0,'CarPayment.user_id'=>$user_id)));
			$salePrice['name'] = $this->User->find('all',array('fields'=>array('User.first_name ,User.last_name'),'conditions'=>array('User.id'=>$user_id)));
			$salePrice['saleYen'] = $this->CarPayment->find('all',array('fields'=>array('sum(CarPayment.sale_price) as SalePriceYen'),'conditions'=>array('CarPayment.currency'=>'￥','CarPayment.deleted ='=>0,'CarPayment.user_id !='=>0,'CarPayment.user_id'=>$user_id)));
			$salePrice['payment'] =  $this->ClientPaymentHistory->query('select sum(ClientPaymentHistory.amount) as Amount ,sum(ClientPaymentHistory.yen_amount) as Yen_amount,ClientPaymentHistory.client_id from client_payment_histories as ClientPaymentHistory  left join  users as User on User.id = ClientPaymentHistory.client_id  where ClientPaymentHistory.deleted=0 AND ClientPaymentHistory.client_id !=0 and ClientPaymentHistory.client_id='.$user_id.'');
			$TotalRecords[$user_id] = $salePrice;
		}
		$this->set('TotalRecords',$TotalRecords);
		 
	}

	
		
	
	/**
	 * This function update user status
	 *
	 */
	
	public function admin_clientStatus() {
		
		$status = $this->data['status'];
		$user_id= $this->data['id'];			
		$this->User->read(null, $user_id);
		$this->User->set('active', $status);
		
		$update = $this->User->save();
		if($update && $status == 1) {
			echo "Active";
		} else {
			echo "Inactive";
		}	
		die;  	
	}
	
	
	
	
	
	
	
	public function admin_InfoClient()
	{
		$this->autoRender = false;
		$key = $this->request->query['q'];
		
		
		$cond=array('User.user_group_id !='=>1,'OR'=>array('User.first_name LIKE'=>'%'.$key.'%','User.last_name LIKE'=>'%'.$key.'%'));
		
		$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$users=$this->User->find('all', array('conditions'=>$cond,'order'=>'User.id desc'));
		
	
		 $result = array();
		 foreach($users as $val) { 
			 $result[] = array("id"=>$val['User']['id'],"text"=>$val['User']['first_name'].' '.$val['User']['last_name']);	
		 }
		 echo json_encode($result); 

	}
	
	
	
	/**
	 * This function show all details of user for search 
	 *
	 * @access public
	 * @return array
	 */
	
	public function admin_clientSearch() {
		
		/*$key = $this->data['name'];
		$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name)");
		$cond=array('OR'=>array("User.full_name LIKE '%$key%'", "User.email LIKE '%$key%'"));
		$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$users=$this->User->find('all', array('conditions'=>$cond,'order'=>'User.id desc'));
		$this->set('users', $users);*/
		
		if($this->request->is('ajax'))
		{	
			//$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name)");	
			$users = $this->User->find('all',array('conditions'=>array('User.id ' => $this->data['id'])));
			$this->set('users', $users);
		}
	}
	
	
	
	/**
	 * This function show Payment History according user by user
	 *
	 * @access public
	 * @return array
	 */
	
	public function admin_paymentHistory()
	{
		//pr($this->data);
		$id = $this->data['id'];
		
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));
		
		$toDate = $this->data['todate'];
		$toDate = date("Y-m-d", strtotime($toDate));
		
		$payConditions = array('ClientPaymentHistory.payment_date BETWEEN ? and ?' => array($fromDate, $toDate),array('ClientPaymentHistory.client_id' => $id));
		
		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => $payConditions,'order' => array('ClientPaymentHistory.payment_date DESC'))); 							
		$this->set('PaymentDetails',$PaymentDetails);
		
		$SaleDetais = $this->getInvoiceDetailsByUser($id,$fromDate,$toDate);
		$this->set('SaleDetais',$SaleDetais);
		/*$saleConditions = array('CarPayment.created_on BETWEEN ? and ?' => array($fromDate, $toDate),array('CarPayment.user_id' => $id));
		$SaleDetais = $this->CarPayment->find('all', array('recursive'=>2,'conditions' => $saleConditions));
		$this->set('SaleDetais',$SaleDetais);*/

		$this->set('SaleDetais',$SaleDetais);
		
			$paymentTotal =  $this->ClientPaymentHistory->find('all', array('fields' =>array('SUM(ClientPaymentHistory.amount) as Amount','SUM(ClientPaymentHistory.yen_amount) as AmountYen'),'conditions'=>array('ClientPaymentHistory.client_id'=>$id),'group'=>array('ClientPaymentHistory.client_id')));
				if($paymentTotal)
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
				}
				
				
				
				

				$saleTotal =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.sale_price) as Sale_Amount','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.sale_price !='=>'','CarPayment.currency '=>'$'),'group'=>array('CarPayment.user_id')
				));
				
				
				if($saleTotal)
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
				}
				
				// change query for get Yen sum  data
				$saleYenTotal =  $this->CarPayment->find('all', array('fields' =>'SUM(CarPayment.sale_price) as Sale_Amount','conditions'=>array('CarPayment.user_id'=>$id,'CarPayment.sale_price !='=>'','CarPayment.currency '=>'￥'),'group'=>array('CarPayment.user_id')
				));	
				
				if($saleYenTotal)
				{
					foreach($saleYenTotal as $k=>$v)
					{
						$sYenTotal = $v['0']['Sale_Amount'];
						$this->set('sYenTotal',$sYenTotal);
					}
				}
				else
				{
					$sYenTotal = 0;
					$this->set('sYenTotal',$sYenTotal);
				}
				

				$balanceDollerTotal = @$pTotal - $sTotal;
				$this->set('balanceTotal',$balanceDollerTotal);
				
				$balanceYenTotal = @$pTotalYen - $sYenTotal;
				$this->set('balanceYenTotal',$balanceYenTotal);
		
		
		
		
		$SaleDetails = $this->User->getAllHistoryByUserIdAndDate($id,$fromDate,$toDate);
		$this->set('SaleDetails',$SaleDetails);	
 
	}
	
	
	/**
	 * This function use for add payment 
	 * @function name  AddPayment
	 * @access public
	 * @return array
	 */
	
	public function admin_addPayment($id=null)
	{
		if ($this->request -> isPost()) {
			//pr($this->data);die;
			$this->ClientPaymentHistory->set($this->data);
			if ($this->ClientPaymentHistory->PaymentValidate()) {

				$paymentDate = $this->data['fromdate'];
				$paymentDate = date('Y-m-d',strtotime($paymentDate));
				$clientId =  $this->data['Users']['client_id'];
				if($this->data['Users']['moneyType']==0)
				{
					$amount =  $this->data['Users']['Amount'];
					$amountYen=0;
				}
				else{
					$amountYen =  $this->data['Users']['Amount'];
					$amount=0;
				}
				$remark =  $this->data['Users']['remarkArea_id'];
				$data = array();
				$data['ClientPaymentHistory']['client_id'] = $clientId;
				$data['ClientPaymentHistory']['payment_date'] = $paymentDate;
				$data['ClientPaymentHistory']['amount']= $amount;
				$data['ClientPaymentHistory']['yen_amount']= $amountYen;
				$data['ClientPaymentHistory']['remark']= $remark;
				$res = $this->ClientPaymentHistory->save($data);
				$this->Session->setFlash(__('successfully save your payment'));
				 $this->redirect(array('action' => 'clientHistory', $clientId));
				//$this->redirect('/admin/users/clientHistory/$clientId);				
			}

		}
		$this->set('selectedListId',$id);
		$ClientDetails = $this->User->find('list', array('fields'=>array('User.first_name','User.last_name','User.id'),'conditions' => array('User.user_group_id !=' => 1)
		));		
		$this->set('ClientDetails',$ClientDetails);
	}
	
	
	
	/*    edit payment  --by nikhil  */
	
	public function admin_getDollerYenValue()
	{
		$this->autoRender = false;
		//pr($this->data);die;
		//[id] => 16, [moneyType] => 1
    	if($this->data['moneyType']==1)
    	{
    		$value = $this->ClientPaymentHistory->find('all',array('fields'=>array('ClientPaymentHistory.yen_amount'),'conditions'=>array('ClientPaymentHistory.id'=>$this->data['id'])));	
    		echo $value[0]['ClientPaymentHistory']['yen_amount'];
    	}
    	else
    	{
    		$value = $this->ClientPaymentHistory->find('all',array('fields'=>array('ClientPaymentHistory.amount'),'conditions'=>array('ClientPaymentHistory.id'=>$this->data['id'])));
    		echo $value[0]['ClientPaymentHistory']['amount'];
    	}
    	die;

	}

	public function admin_editPayment($id=null,$client_id=null)
	{
		$client_history_id=$id;

		$this->set('clientId',$client_history_id);
		$this->set('selectedListId',$client_id);
		$ClientPaymentDetails = $this->ClientPaymentHistory->find('all',array('conditions'=>array('id'=>$client_history_id)));
		$ClientDetails = $this->User->find('list', array('fields'=>array('User.first_name','User.last_name','User.id'),'conditions' => array('User.user_group_id !=' => 1)));		
		$this->set('ClientDetails',$ClientDetails);
		$this->set('ClientPaymentDetails',$ClientPaymentDetails);
		if ($this->request -> isPost())
		{			
			$this->ClientPaymentHistory->set($this->data);
			if ($this->ClientPaymentHistory->PaymentValidate())
			{
				$value = $this->ClientPaymentHistory->find('all',array('fields'=>array('ClientPaymentHistory.yen_amount','ClientPaymentHistory.amount'),'conditions'=>array('ClientPaymentHistory.id'=>$this->data['id'])));
				$paymentDate = $this->data['fromdate'];
				$data = array();
				$data['ClientPaymentHistory']['id']=$this->data['id'];
				$data['ClientPaymentHistory']['client_id'] = $this->data['Users']['clientId'];
				$data['ClientPaymentHistory']['payment_date'] = date('Y-m-d',strtotime($paymentDate));
				if($this->data['Users']['moneyType']==0)
				{
					$amount =  $this->data['Users']['Amount'];
					$amountYen=$value[0]['ClientPaymentHistory']['yen_amount'];
				}
				else{
					$amountYen =  $this->data['Users']['Amount'];
					$amount=$value[0]['ClientPaymentHistory']['amount'];
				}
				$data['ClientPaymentHistory']['amount']=$amount;
				$data['ClientPaymentHistory']['yen_amount']=$amountYen;
				$data['ClientPaymentHistory']['remark']= $this->data['Users']['Remark'];
				$res = $this->ClientPaymentHistory->save($data);
				$this->Session->setFlash(__('successfully Update your payment'));
				 $this->redirect(array('action' => 'clientHistory', $this->data['Users']['clientId']));			
			}
		}
				
	}

	
	
	
	
		/**
	 * Used to edit user on the site by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function admin_editUser($userId=null) {
		
		$result =$this->User->find('all', array('conditions' => array('User.user_group_id !=' => 1,'User.id'=>$userId)));
		$this->set('selected',$result[0]['User']['country']);
		$this->set('bankName',$result[0]['User']['bank_id']);
		
		$CounrtyDetails = $this->Country->find('list', array('fields'=>array('Country.id','Country.country_name')));		
		$this->set('CounrtyDetails',$CounrtyDetails);
		
		$bankDetails = $this->Bank->find('list', array('fields'=>array('Bank.id','Bank.bank_name'),'order' => array('Bank.id' => 'ASC')));
		$this->set('bankDetails',$bankDetails);
		
		if (!empty($userId)) {
			$userGroups=$this->UserGroup->getGroups();
			$this->set('userGroups', $userGroups);
			if ($this->request -> isPut()) {

				$this->User->set($this->data);

				if ($this->User->RegisterValidate()) 
				{
				
					//$uniqueData = $this->getUniqueCountoryId($this->data['User']['uniqueid']);
					$UniqueIdData = $this->User->find('first',array('conditions'=>array('User.id' =>$this->data['User']['id'] )));
					
					$this->request->data['User']['country'] = $UniqueIdData['User']['country'];//$this->data['User']['uniqueid']
					
					$this->request->data['User']['uniqueid'] = $UniqueIdData['User']['uniqueid'];//$uniqueData;no unique id update
					
					//echo "<pre>";
					//print_r($this->request->data);					
					//die;
					
					$this->User->save($this->request->data,false);
					$this->Session->setFlash(__('The user is successfully updated'));
					$this->redirect('/admin/users/allUsers');
				}
			} else {
				$user = $this->User->read(null, $userId);
				$this->request->data=null;
				if (!empty($user)) {
					$user['User']['password']='';
					$this->request->data = $user;
				}
			}
		} else {
			$this->redirect('/admin/users/allUsers/');
		}
	}
	
	
	
	
	
	
	public function admin_changePassword($user_id=null) {
		
		$this->set('id',$user_id);
		//$this->User->read(null, $user_id);
		if ($this->request -> isPost()) {
			//pr($this->data);
			//die;
			
			$this->User->set($this->data);

			//$this->User->set('id',$user_id);
			if ($this->User->RegisterValidate()) {
				$user=array();
				$user['User']['id']=$this->data['User']['id'];
				$salt=$this->UserAuth->makeSalt();
				$user['User']['salt'] = $salt;
				$user['User']['password'] = $this->UserAuth->makePassword($this->data['User']['password'], $salt);
				$this->User->save($user,false);
				$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$user_id), false);
				$this->Session->setFlash(__('Password changed successfully'));
				$this->redirect('/admin/users/allUsers/');
			}
		}
		$this->render('change_password');
		$this->layout= false;
		
	}
	/**
	 * Used to display detail of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return array
	 */
	public function admin_viewUser($userId=null) {
		if (!empty($userId)) {
			$user = $this->User->read(null, $userId);
			$this->set('user', $user);
		} else {
			$this->redirect('/admin/allUsers/');
		}
	}
	/**
	 * Used to display detail of user by user
	 *
	 * @access public
	 * @return array
	 */
	public function myprofile() {
		$userId = $this->UserAuth->getUserId();
		$user = $this->User->read(null, $userId);
		$this->set('user', $user);
	}
	/**
	 * Used to logged in the site
	 *
	 * @access public
	 * @return void
	 */
	public function admin_login($status = '') { 
//ini_set('default_charset', 'utf-8');
		$this->layout='default';
		$this->set('status', $status);
		if($this->UserAuth->isAdmin())
		{
			$this->redirect('/admin/DashboardUser/');
		}

		// added by Ajay Date:22012018
		if ($this->UserAuth->isClientAdmin()) {
			$this->redirect('/admin/DashboardUser/');
		}

	if ($this->request -> isPost()) {


			$this->autoRender = false;
			$this->User->set($this->data);
			if($this->User->LoginValidate()) {
				$email  = trim($this->data['User']['username']);
                                $password = trim($this->data['User']['password']);






				$user = $this->User->findByUsername($email);

				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						return $this->redirect(array('action' => 'login', 1));
					}
				}
				else
				{

					// check for inactive account
					if ($user['User']['id'] != 1 and $user['User']['active']==0) {
						return $this->redirect(array('action' => 'login', 2));
					}
					// check for verified account
					if ($user['User']['id'] != 1 and $user['User']['email_verified']==0) {
						return $this->redirect(array('action' => 'login', 3));
					}
					if(empty($user['User']['salt'])) {
						$hashed = md5($password);
					} else {
						$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);
					}


					if ($user['User']['password'] === $hashed) {
						if(empty($user['User']['salt'])) {
							$salt=$this->UserAuth->makeSalt();
							$user['User']['salt']=$salt;
							$user['User']['password']=$this->UserAuth->makePassword($password, $salt);
							$this->User->save($user,false);
						}
						$this->UserAuth->login($user);
						$remember = (!empty($this->data['User']['remember']));
						if ($remember) {
							$this->UserAuth->persist('10 weeks');
						}
						$OriginAfterLogin=$this->Session->read('OriginAfterLogin');
						$this->Session->delete('OriginAfterLogin');

						$this->Session->write('PerMissioUser', $user['User']['permission']);

						$this->Session->delete('User_Group_ID');
						$this->Session->write('User_Group_ID', $user['User']['user_group_id']);
						if($user['User']['user_group_id'] == 2)
						{
							$this->redirect('/home/dashboard/');
						}else if($user['User']['user_group_id'] == 5)
						{
							//$this->redirect('/home/dashboard/');
							//added by Ajay Date:22012018
							$client_permission = json_encode($this->UserAuth->getClientAdminPagePermission());
							$this->Session->write('PerMissioUser', $client_permission);
							$this->redirect('/home/dashboard/');
						}else
						{
							$this->redirect('/admin/DashboardUser/');
						}
					}
					else
					{
						return $this->redirect(array('action' => 'login', 1));
					}
				}
			}else{
				return $this->redirect(array('action' => 'login', 1));
			}
		}
	}
	/**
	 * Used to logged out from the site
	 *
	 * @access public
	 * @return void
	 */
	public function admin_logout() {
		$this->UserAuth->logout(); 
		
        clearCache();
		
		//$this->Session->setFlash(__('You are successfully signed out'));
		$this->redirect("/admin/login");
	}
	/**
	 * Used to register on the site
	 *
	 * @access public
	 * @return void
	 */
	
	/**
	 * Used to change the password by user
	 *
	 * @access public
	 * @return void
	 */
	/*public function changePassword() {
		$userId = $this->UserAuth->getUserId();
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if ($this->User->RegisterValidate()) {
				$user=array();
				$user['User']['id']=$userId;
				$salt=$this->UserAuth->makeSalt();
				$user['User']['salt'] = $salt;
				$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$this->User->save($user,false);
				$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
				$this->Session->setFlash(__('Password changed successfully'));
				$this->redirect('/admin/dashboard');
			}
		}
	}*/
	

	/**
	 * Used to delete the user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function admin_delete($userId = null) {
		if (!empty($userId)) {
			if ($this->request -> isPost()) {
				if ($this->User->delete($userId, false)) {
					$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
					$this->Session->setFlash(__('User is successfully deleted'));
				}
			}
			$this->redirect('/admin/users/allUsers');
		} else {
			$this->redirect('/admin/users/allUsers');
		}
	}

/* Delete All bid record for a car_id  */

	public function admin_AllBidDelete($id)
	{
		$this->autoRender = false;
		if($this->request->is('post'))
		{
		   $returnId= $this->Bid->find('all',array('fields'=>'id','conditions'=>array('car_id'=>$id)));
		   //$deleteRecords = $this->Bid->deleteAll(array('Bid.car_id' => $id));
			$deleteRecords = $this->Bid->updateAll(array('deleted' => "1"),array('car_id' => $id));
			if ($deleteRecords)
			{
					$this->Session->setFlash(__('Bid Records is successfully deleted.'));
					$this->redirect('/admin/users/bid_report');
			}
			else
			{
				$this->Session->setFlash(__('Bid Records can not deleted.'));
				$this->redirect('/admin/users/bid_report');
			}
			
		}

	}
	
	
	
	
	/**
	 * Used to payment delete the user by Admin
	 *
	 * @access public
	 * @param integer $payment_id of user
	 * @return void
	 */
	
	
	public function admin_paymentdelete($payment_id=null)
	{
		$this->autoRender = false;
		if($this->UserAuth->isAdmin())
		{
			if(!empty($this->data['id'])) 
			{
				if ($this->ClientPaymentHistory->delete($this->data['id'], false)) 
				{
					echo json_encode(array("status"=>'success','message'=>'Successfully delete payment '));
				}else
				{
					echo json_encode(array("status"=>'failure','message'=>'Not deleted  '));
				}

			}
		}else
		{
			$this->Session->setFlash(__('You are not preform this action'));
		}
		
	}
		
		
	/**
	 * Used to show dashboard of the user
	 *
	 * @access public
	 * @return array
	 */
	public function admin_dashboard() {
		$userId=$this->UserAuth->getUserId();
		$user = $this->User->findById($userId);
		$this->set('user', $user);
	}
	/**
	 * Used to activate or deactivate user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @param integer $active active or inactive
	 * @return void
	 */
	public function admin_makeActiveInactive($userId = null, $active=0) {
		if (!empty($userId)) {
			$user=array();
			$user['User']['id']=$userId;
			$user['User']['active']=($active) ? 1 : 0;
			$this->User->save($user,false);
			if($active) {
				$this->Session->setFlash(__('User is successfully activated'));
			} else {
				$this->Session->setFlash(__('User is successfully deactivated'));
			}
		}
		$this->redirect('/admin/allUsers');
	}
	/**
	 * Used to verify email of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function verifyEmail($userId = null) {
		if (!empty($userId)) {
			$user=array(); 
			$user['User']['id']=$userId;
			$user['User']['email_verified']=1;
			$user['User']['active']=1;
			$this->User->save($user,false);
			$this->Session->setFlash(__('User email is successfully verified'));
		}
		$this->redirect('/');
	}
	/**
	 * Used to show access denied page if user want to view the page without permission
	 *
	 * @access public
	 * @return void
	 */
	public function accessDenied() {

	}
	/**
	 * Used to verify user's email address
	 *
	 * @access public
	 * @return void
	 */ 
	/*  register function here */
	public function register() {
	    $this->layout = 'default';
		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			//$this->redirect("/uprofile");
		}
		if (SITE_REGISTRATION) {
			$userGroups=$this->UserGroup->getGroupsForRegistration();
			$this->set('userGroups', $userGroups);
			if ($this->request -> isPost()) {
				
				if(USE_RECAPTCHA && !$this->RequestHandler->isAjax()) {
					$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";
				}
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					if (!isset($this->data['User']['user_group_id'])) {
						$this->request->data['User']['user_group_id']=DEFAULT_GROUP_ID;
					} elseif (!$this->UserGroup->isAllowedForRegistration($this->data['User']['user_group_id'])) {
						$this->Session->setFlash(__('Please select correct register as'));
						return;
					}
					$this->request->data['User']['active']=0;
					if (!EMAIL_VERIFICATION) {
						$this->request->data['User']['email_verified']=0;
					}
					$ip='';
					if(isset($_SERVER['REMOTE_ADDR'])) {
						$ip=$_SERVER['REMOTE_ADDR'];
					}
					$this->request->data['User']['ip_address']=$ip;
					$salt=$this->UserAuth->makeSalt();
					$this->request->data['User']['salt'] = $salt;
					$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->request->data['User']['uniqueid'] = $this->uniqueid();
					$this->User->save($this->request->data,false);
					
					$userId=$this->User->getLastInsertID();
					$user = $this->User->findById($userId);
					
					if (SEND_REGISTRATION_MAIL && !EMAIL_VERIFICATION) {
						$this->User->sendRegistrationMail($user);
					}
					if (EMAIL_VERIFICATION) {
						$this->User->sendVerificationMail($user);
					}
					if (isset($this->request->data['User']['email_verified']) && $this->request->data['User']['email_verified']) {
						$this->UserAuth->login($user);
						$this->redirect('/');
					} else { 
						$this->Session->setFlash(__('Please check your email and confirm your registration'));
						$this->redirect('/register');
					}
				}
			}
		} else {
			$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'));
			$this->redirect('/');
		}
	}
	/*  end registration */
	public function userVerification() {
		
		if (isset($_GET['ident']) && isset($_GET['activate'])) {
			$userId= $_GET['ident'];
			$activateKey= $_GET['activate'];
			$user = $this->User->read(null, $userId);
			
			if (!empty($user)) {
				if (!$user['User']['active']) {
					$password = $user['User']['password'];
					$theKey = $this->User->getActivationKey($password);
					if ($activateKey==$theKey) {

						$user['User']['email_verified']=1;
						$user['User']['active']=1;
						$this->User->save($user,false);
						if (SEND_REGISTRATION_MAIL && EMAIL_VERIFICATION) {
							$this->User->sendRegistrationMail($user);
						}
						$this->Session->setFlash(__('Thank you, your account is activated now'));
					}
				} else {
					$this->Session->setFlash(__('Thank you, your account is already activated'));
				}
			} else {
				$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
			}
		} else {
			$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
		}
		$this->redirect('/');
	}
	/**
	 * Used to send forgot password email to user
	 *
	 * @access public
	 * @return void
	 */
	public function forgotPassword($status='') {
		$this->layout = 'default';
		$this->set('status', $status);
		
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						return $this->redirect(array('action' => 'forgotPassword', 1));
					}
				}
				// check for inactive account
				if ($user['User']['id'] != 1 and $user['User']['email_verified']==0) {
					return $this->redirect(array('action' => 'forgotPassword', 2));
				}
				$this->User->forgotPassword($user,'/admin/activatePassword');
				return $this->redirect(array('action' => 'forgotPassword', 3));
			}
		}
	}
	/**
	 *  Used to reset password when user comes on the by clicking the password reset link from their email.
	 *
	 * @access public
	 * @return void
	 */
	public function activatePassword() {
		if ($this->request -> isPost()) {
			if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate'])) {
				$this->set('ident',$this->data['User']['ident']);
				$this->set('activate',$this->data['User']['activate']);
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$userId= $this->data['User']['ident'];
					$activateKey= $this->data['User']['activate'];
					$user = $this->User->read(null, $userId);
					if (!empty($user)) {
						$password = $user['User']['password'];
						$thekey =$this->User->getActivationKey($password);
						if ($thekey==$activateKey) {
							$user['User']['password']=$this->data['User']['password'];
							$salt=$this->UserAuth->makeSalt();
							$user['User']['salt'] = $salt;
							$user['User']['password'] = $this->UserAuth->makePassword($user['User']['password'], $salt);
							$this->User->save($user,false);
							$this->Session->setFlash(__('Your password has been reset successfully'));
							$this->redirect('/');
						} else {
							$this->Session->setFlash(__('Something went wrong, please send password reset link again'));
						}
					} else {
						$this->Session->setFlash(__('Something went wrong, please click again on the link in email'));
					}
				}
			} else {
				$this->Session->setFlash(__('Something went wrong, please click again on the link in email'));
			}
		} else {
			if (isset($_GET['ident']) && isset($_GET['activate'])) {
				$this->set('ident',$_GET['ident']);
				$this->set('activate',$_GET['activate']);
			}
		}
	}
	/**
	 * Used to send email verification mail to user
	 *
	 * @access public
	 * @return void
	 */
	public function emailVerification() {
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'));
						return;
					}
				}
				if($user['User']['email_verified']==0) {
					$this->User->sendVerificationMail($user);
					$this->Session->setFlash(__('Please check your mail to verify your email'));
				} else {
					$this->Session->setFlash(__('Your email is already verified'));
				}
				$this->redirect('/');
			}
		}
	}
	
   //-------------All Functions for Story-----------------------
	
	//****Manage Games***
	function admin_allCustomer()
	{
	$games=$this->Car->find('all');
	$this->set('games',$games);
		
		if($this->request->isPost())
		{

		$deleteImg=$this->ManageMap->find('all',array('conditions'=>array('game_id'=>$this->data['delete'])));
		foreach($deleteImg as $deleteVal)
			{
				if(file_exists('uploads/box_photo/'.$deleteVal['ManageMap']['box_photo']))
				{
				@unlink('uploads/box_photo/'.$deleteVal['ManageMap']['box_photo']);
				@unlink('uploads/box_photo/thumbs/'.$deleteVal['ManageMap']['box_photo']);
				}
				
				if(file_exists('uploads/map_image/'.$deleteVal['ManageMap']['map_image']))
				{
				@unlink('uploads/map_image/'.$deleteVal['ManageMap']['map_image']);
				@unlink('uploads/map_image/thumbs/'.$deleteVal['ManageMap']['map_image']);
				}
			}
			
			
			foreach($this->data['delete'] as $id)
			{
			$this->ManageGame->delete($id);
			}
		$this->Session->setFlash('Record Delete Successfully!');
		$this->redirect('/admin/manageContent');
		}
	}
	
	//****Add Games***
	function admin_addContent()
	{	
		if($this->request->isPost())
		{
			if($this->ManageGame->save($this->data))
			{
			$this->Session->setFlash('Content Insert Successfully!');
			$this->redirect('/admin/manageContent');
			} else {
			$this->Session->setFlash('Content Not Insert!');
			$this->redirect('/admin/manageContent');
			}
		}
	}
	
	//****Edit Games***
	function admin_editContent($id='')
	{
		if($id!='')
		{
		$editGame=$this->ManageGame->findById($id);
		}
		$this->set('game',$editGame);
		
		if($this->request->isPost())
		{
			if($this->ManageGame->save($this->data))
			{
			$this->Session->setFlash('Games Update Successfully!');
			$this->redirect('/admin/manageContent');
			} else {
			$this->Session->setFlash('Games Not Update!');
			$this->redirect('/admin/manageContent');
			}
		}
	}
	
	//*****View Map*****
	function viewMap($id)
	{
	$this->ManageMap->belongsTo  = array('ManageGame'=>array('foreignKey'=>'game_id'));
	$map=$this->ManageMap->find('first',array('conditions'=>array('ManageMap.id'=>$id)));

	$this->set('map',$map);	
	}
	 function admin_carmgmt()
	{
	     $carDetails=$this->Car->find('all');
	     $this->set('carDetail',$carDetails);
	}
	function admin_addnew_car()
	{
	
	if($this->request->is('post')){
		
		//pr($this->Session->read('tempFiles')); 
		$data=array();
		$data['uniqueid'] = $this->request->data['uniqueid'];
		$data['location'] = $this->request->data['location'];
		$data['cnumber'] = $this->request->data['cnumber'];
		$data['transmission'] = $this->request->data['transmission'];
		$data['drive'] = $this->request->data['drive'];
		$data['stock'] = $this->request->data['stock'];
		$data['color'] = $this->request->data['color'];
		$data['bstyle'] = $this->request->data['bstyle'];
		$data['mileage'] = $this->request->data['mileage'];
		$data['handle'] = $this->request->data['User']['handle'];
		$data['fuel'] = $this->request->data['User']['fuel'];
		$data['door'] = $this->request->data['User']['door'];
		$retData = $this->Car->save($data);
		if($retData){
			$this->Session->setFlash('Saved Successfully!');
			$carimages=$this->Session->read('tempFiles');
			//pr($this->Session->read());
			//pr($carimages);
			foreach($carimages as $val){
				
				$dest_dir = WWW_ROOT."img/carimages/"; //WWW_ROOT.'files/post_files/'
			    $src_file = WWW_ROOT."files/post_files/";
			   // pr($dest_dir.$carimage['temp_name']); die;
			if(copy($src_file.$val['temp_name'],$dest_dir.$val['temp_name'])){
					@unlink($dest_dir.$val['temp_name']);
					$data =  array();
					$data['car_id'] = $retData['Car']['id'];
					$data['image_source'] = $val['temp_name'];
					$data['image_name'] = $val['ori_name'];
					//pr($data); die('nodata');
					$this->CarImage->save($data);
				}else{
						echo 'not moved';die;
					}
			
			 
			}
			//$this->Session->delete('tempFiles');
			
		}else{
			$this->Session->setFlash('Not Saved !');
		}
	}else{
		
			$this->Session->delete('tempFiles');
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
					$tempName = time()."_".$fileName; 
					
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
						$tempName = time()."_".$fileName; 
						
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
	
	public function uniqueid(){
   
		   		 $code=substr(md5(rand()), 5, 10);
		   		 $UniqueNumber=$this->Car->find('count', array('conditions'=>array('uniqueid'=>$code)));
		   		 if($UniqueNumber)
		   		 	$this->uniquenumber($code);
                 
		    	  return $code;
		    	
				}
	public function getUniqueCountoryId($id)
	{

		$CounrtyDetails1 = $this->Country->find('list', array('fields'=>array('Country.country_name'),'conditions'=>array('Country.id'=>$id)));		
		foreach($CounrtyDetails1 as $data)
		{
			@$term =  substr($data, 0, 3);
		}
		$UniqueData = $this->User->query("SELECT count(id) as cnt FROM users WHERE uniqueid LIKE '%".$term."%'");
		$uniCount =  $UniqueData[0][0]['cnt'];
		$uniCount++;
		$uniqueId = $term.$uniCount;
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%','User.deleted'=>1,'User.deleted'=>0)));
		
		Ex:
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%','User.deleted'=>1,'User.deleted'=>0)));
		
		if($UniqueExData)
		{
			$uniCount++;
			$uniqueId = $term.$uniCount;
			goto Ex;
		}else
		{
			 return $uniqueId;
		}
		
		
		/*$CounrtyDetails1 = $this->Country->find('list', array('fields'=>array('Country.country_name'),'conditions'=>array('Country.id'=>$id)));		
		foreach($CounrtyDetails1 as $data)
		{
			@$term =  substr($data, 0, 3);
		}
		$UniqueData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$term.'%')));
		$uniCount =  count($UniqueData);
		$uniCount++;
		$uniqueId = $term.$uniCount;
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%')));
		
		Ex:
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%')));
		
		if($UniqueExData)
		{
			$uniCount++;
			$uniqueId = $term.$uniCount;
			goto Ex;
		}else
		{
			return $uniqueId;
		}*/
		
	}
	
	public function admin_test() 
	{
		$this->autoRender = false; 
		$CounrtyDetails1 = $this->Country->find('list', array('fields'=>array('Country.country_name'),'conditions'=>array('Country.id'=>2)));		
		foreach($CounrtyDetails1 as $data)
		{
			@$term =  substr($data, 0, 3);
		}

		 $uniCountD = $this->User->query("SELECT count(id) as cnt FROM users WHERE uniqueid LIKE '%".$term."%'");
		
		echo "===".$uniCount =  $uniCountD[0][0]['cnt'];
		$uniCount++;
		echo $uniCount;
		echo $uniqueId = $term.$uniCount;
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%','User.deleted'=>1,'User.deleted'=>0)));
		
		Ex:
		$UniqueExData = $this->User->find('all',array('conditions'=>array('User.uniqueid LIKE' => '%'.$uniqueId.'%','User.deleted'=>1,'User.deleted'=>0)));
		
		if($UniqueExData)
		{
			$uniCount++;
			$uniqueId = $term.$uniCount;
			goto Ex;
		}else
		{
			echo  $uniqueId;
		}
		
		
		
		die;
	}
	
		public function getInvoiceDetailsByUser($userId,$fromdate,$todate) {
		

		/*
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		*/

		$result = $this->User->query('SELECT CarPayment.yen,Car.user_doc_status,Car.doc_status,CarPayment.psale_freight, CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
		FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		WHERE CarPayment.user_id ="'.$userId.'" AND Car.deleted =0 AND CarPayment.deleted =0  AND CarPayment.updated_on BETWEEN "'.$fromdate.'" AND "'.$todate.'" order by CarPayment.updated_on DESC');
		return $result; 
	}

	public function getSaleInvoiceDetailsByUser($userId,$fromdate,$todate) {
		/*
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		*/

		$result = $this->User->query('SELECT CarPayment.yen,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
		FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		WHERE CarPayment.created_by ="'.$userId.'" AND Car.deleted =0 AND CarPayment.deleted =0 AND Car.groupid = 2 
		AND CarPayment.updated_on BETWEEN "'.$fromdate.'" AND "'.$todate.'" order by CarPayment.updated_on DESC');
		return $result;
	}
	
	public function getInvoiceDetailsSearchByUser($userId,$fromdate,$todate) {
		
		$result = $this->User->query('SELECT CarPayment.yen,Car.user_doc_status,Car.doc_status,CarPayment.car_id, CarPayment.psale_freight,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
		FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		WHERE CarPayment.user_id ="'.$userId.'" AND Car.deleted =0 AND CarPayment.updated_on BETWEEN "'.$todate.'" AND "'.$fromdate.'" order by CarPayment.updated_on DESC ');
		return $result;
	}

	public function getSaleInvoiceDetailsSearchByUser($userId,$fromdate,$todate) {

		$result = $this->User->query('SELECT CarPayment.yen,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
		FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		WHERE CarPayment.created_by ="'.$userId.'" AND Car.deleted =0 AND Car.groupid = 2 AND CarPayment.updated_on BETWEEN "'.$todate.'" AND "'.$fromdate.'" order by CarPayment.updated_on DESC ');
		return $result;
	}
	
	 // number of results per page.
		function getPagination($count){
      $paginationCount= floor($count / $this->perPage);
      $paginationModCount= $count % $this->perPage;
      if(!empty($paginationModCount)){
               $paginationCount++;
      }
      return $paginationCount;
}		

   function admin_pay_detail_search()
   {
				
		$id=$this->data['id'];
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));
		
		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));
		
		$payConditions = array('ClientPaymentHistory.payment_date BETWEEN ? and ?' => array($fromDate, $toDate),array('ClientPaymentHistory.client_id' => $id));
		
		$PaymentDetails = $this->ClientPaymentHistory->find('all', array('conditions' => $payConditions,'order' => array('ClientPaymentHistory.payment_date DESC'))); 
								
		$this->set('PaymentDetails',$PaymentDetails);
		
   }
   
   function admin_buy_detail_search()
   {				
		$id=$this->data['id'];
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));
		
		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));

		if($fromDate =='')
		{
			$fromDate='2013-01-01';
		}
		if($toDate =='')
		{
			$toDate= date("Y-m-d");
		}
		$SaleDetails = $this->getInvoiceDetailsSearchByUser($id,$fromDate,$toDate);
		$this->set('BuyInvDetails',$SaleDetails);
					
   }

	public function  admin_clear_buy_detail_search()
	{

		$id = $this->data['id'];
		$pastDate = "2013-01-01";
		$curDate = date("Y-m-d");

		//Buy history
		$BuyDetais = $this->getInvoiceDetailsByUser($id,$pastDate,$curDate);
		$this->set('BuyInvDetails',$BuyDetais);
		$this->layout = null;
		$this ->render('admin_buy_detail_search');
	}

	function admin_sale_detail_search()
	{
		$id=$this->data['id'];
		$fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));

		$toDate = $this->data['to'];
		$toDate = date("Y-m-d", strtotime($toDate));

		if($fromDate =='')
		{
			$fromDate='2013-01-01';
		}
		if($toDate =='')
		{
			$toDate= date("Y-m-d");
		}
		$SaleDetails = $this->getSaleInvoiceDetailsSearchByUser($id,$fromDate,$toDate);
		$this->set('SaleInvDetails',$SaleDetails);

	}

	public function  admin_clear_sale_detail_search()
	{

		$id = $this->data['id'];
		$pastDate = "2013-01-01";
		$curDate = date("Y-m-d");

		//sale history
		$SaleDetais = $this->getSaleInvoiceDetailsByUser($id,$pastDate,$curDate);
		$this->set('SaleInvDetails',$SaleDetais);
		$this->layout = null;
		$this ->render('admin_sale_detail_search');
	}
   
   public function admin_docStatus() {
		
		
		$carId = $this->data['cId'];
		$type  = $this->data['status'];		
		$this->Car->read(null, $carId);
		$this->Car->set('doc_status', $type);
		
		$update = $this->Car->save();
		if($update) 
		{
			if($type==1)
			{
				echo json_encode(array("status"=>"checked","message"=>""));
			}
			else
			{		
				echo json_encode(array("status"=>"unchecked","message"=>""));
			} 
		}	
		die;  	
	}
	
	
	public function admin_docShipStatus() {
		
		
		$carId = $this->data['cId'];
		$type  = $this->data['status'];		
		$this->Car->read(null, $carId);
		$this->Car->set('user_doc_status', $type);
		
		$update = $this->Car->save();
		if($update) 
		{
			if($type==1)
			{
				echo json_encode(array("status"=>"checked","message"=>""));
			}
			else
			{		
				echo json_encode(array("status"=>"unchecked","message"=>""));
			} 
		}	
		die;  	
	}
	//======   for bid report
	
	
	public function admin_bid_report() {
		$countArr = array();
		$bidDetail=$this->Bid->find('all',array('recursive'=>2,'order'=>array('Car.id','Bid.amount DESC')));
		//pr($bidDetail);die;
		foreach ($bidDetail as $key => $value) {
			$car_id = $value['Bid']['car_id'];
			//$carName[]=$value['Car']['CarName']['car_name'];
			//pr($carName);
			$bidCount=$this->Bid->find('first',array('fields'=>array('count(Bid.car_id) as total_bid'),'conditions'=>array('Bid.car_id'=>$car_id)));
			$countArr[$car_id] = $bidCount[0]['total_bid'];	

			$bidresult[$car_id] =$this->Bid->find('all',array('fields'=>array(),'recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id),'order'=>array('Car.id','Bid.amount DESC'), 'limit' => 2));
		} 


		$this->set('countArr',$countArr);
		//pr($bidresult);die;
		$this->set('bidresult',$bidresult);
	}
	
	
	
	//   for get current doller to yen convert rate
	
	public function admin_current_doller_to_yen_rate()
	{
		$this->Session->write('yenRate',$this->data['newrate']);
		echo  $this->Session->read('yenRate');
		die;
	}
	
	public function admin_user_bid_report($user_id=null)
	{
		$bidresult =$this->Bid->find('all',array('fields'=>array(),'recursive'=>2,'conditions'=>array('Bid.user_id'=>$user_id),'order'=>array('Car.id','Bid.amount DESC')));
		$this->set('bidresult',$bidresult);
		$this ->render('admin_bid_report');
		$this->layout = null;
		
	}

	/* chechis search on client all history*/
		public function admin_chassisSearch($client_id)
	{
		$this->autoRender = false;
		$term = $this->request->query['q'];
		$Cars = $this->getDetailsByCnumber($term,$client_id);
		$result = array();
		foreach($Cars as  $val) {
			$result[] = array("id"=>$val['CarPayment']['car_id'],"text"=>$val['Car']['cnumber']);	
		}
		echo json_encode($result);
	}
		public function getDetailsByCnumber($cnumber,$id) {
		$result = $this->User->query("SELECT  CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.currency, CarPayment.sale_price,CarPayment.yen, CarPayment.updated_on, Invoice.invoice_no, CarName.car_name, Car.cnumber,Car.price_editable, Car.country_id, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					WHERE  Car.cnumber  LIKE '%".$cnumber."%' AND CarPayment.user_id ='".$id."'  AND  CarPayment.deleted = 0 group by Car.stock");
		return $result;
	}


	public function admin_all_history_search_detail()
	{
		$car_id = $this->data['id'];
		$result = $this->getInvoiceDetailsByCarId($car_id);
		$this->set('SaleDetails',$result);

	}
	
	/* blank ajax on client all history*/
		public function admin_search_ajax()
	{
		$this->autoRender = false;		
		echo 'success';
	}
	
	
	
	public function admin_clear_all_history_search_detail()
	{
		$this->autoRender = false;
		$client_id=$this->data['client_id'];
		$car_id = $this->data['id'];
		$SaleDetails = $this->User->getAllHistoryByUserId($client_id);
		$this->set('SaleDetails',$SaleDetails);
		$this->layout = null;
		$this ->render('admin_all_history_search_detail');

	}
	


	public function getInvoiceDetailsByCarId($car_id) {
		$result = $this->User->query('SELECT Logistic.remark,Car.user_doc_updated,Logistic.ship_port,Logistic.departure_date,Logistic.arrival_date,Logistic.port_remark,Port.port_name,CarPayment.currency,CarPayment.updated_on,Car.manufacture_year,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.yen,CarPayment.sale_price, CarPayment.updated_on,CarPayment.created_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
					FROM  `car_payments` AS CarPayment
					LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
					LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
					LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
					LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
					LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
					LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
					LEFT JOIN ports AS Port ON Port.id = Logistic.port_id
					WHERE CarPayment.car_id ='.$car_id.'  AND  CarPayment.deleted = 0  group by Car.stock order by CarPayment.created_on DESC' ); 
		return $result;
	}
	
	public function getInvoiceDetailsByUserData($userId) {
		

		/*
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		*/

		$result = $this->User->query('SELECT CarPayment.yen,Car.user_doc_status,Car.doc_status,CarPayment.car_id,CarPayment.id,Logistic.created,CarPayment.sale_price,CarPayment.currency, CarPayment.updated_on, Invoice.invoice_no, CarName.car_name, Car.cnumber, Car.country_id,Car.price_editable, Car.brand_id, Car.stock,Logistic.destination_port, Logistic.status, Logistic.remark, Shipping.company_name
		FROM  `car_payments` AS CarPayment
		LEFT JOIN cars AS Car ON Car.id = CarPayment.car_id
		LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id
		LEFT JOIN shippings AS Shipping ON Logistic.shipping_id = Shipping.id
		LEFT JOIN car_names AS CarName ON CarName.id = Car.car_name_id
		LEFT JOIN invoice_details AS InvoiceDetail ON CarPayment.car_id = InvoiceDetail.car_id
		LEFT JOIN invoices AS Invoice ON Invoice.id = InvoiceDetail.invoice_id
		WHERE CarPayment.user_id ="'.$userId.'" AND Car.deleted =0 order by CarPayment.updated_on DESC');
		return $result; 
	}
	
    public function admin_pay_clear_search()
    {
		$id=$this->data['id'];
		$PaymentDetails = $this->ClientPaymentHistory->find('all',array('conditions' => array('ClientPaymentHistory.client_id' => $id),'order' => array('ClientPaymentHistory.payment_date DESC')));		
		$this->set('PaymentDetails',$PaymentDetails);
		$this ->render('admin_pay_detail_search');
		$this->layout = null;
	}	
	
	 
	
}
