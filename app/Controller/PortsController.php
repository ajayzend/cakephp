<?php
App::uses('AppController', 'Controller');

class PortsController extends AppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('User','Port', 'UserGroup', 'LoginToken','Country','Auction','Transport');
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
	
	
		if($this->request->isPost() && $_POST['modeval'] == "delete")
		{
			foreach($_POST['PortIds'] as $ids)
			{
				$this->Port->delete($ids, false);
			}
			$this->set('success', 1);
		}
		
		$limit = $this->limit;
		$portDetails=$this->Port->find('all');
		$count = count($portDetails);
		$this->set('portDetails',$portDetails);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));  
		$portDetails = $this->Paginator->paginate('Port');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}

		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		//pr($portDetails);die;
		$this->set('portDetails', $portDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);
		
	}
	
	public function admin_view($id=null) { 
		$portDetails = $this->Port->find('all',array('conditions'=>array('Port.id'=>$id)),array('order'=>'Port.id desc'));
		foreach($portDetails as $key=>$val)
		{
			$this->set('portDetails',$val);
		}
	}
	
	public function admin_add() { 
		$this->layout = false;
				if ($this->request -> isPost())
				{
					$this->autoRender = false;

					$this->Port->set($this->data);
					if($this->Port->portValidation()){
					
						$this->Port->set($this->data);
						$data = array();
						$data['Port']['port_name'] = $this->data['Port']['port_name'];
						$data['Port']['country_id'] = $this->data['Port']['country_name'];
						$data['Port']['auction_id']= $this->data['Port']['auction'];
						$data['Port']['transport_id'] = $this->data['Port']['transport_name'];
						
						$return = $this->Port->save($data);
						
						$returnData = $this->Port->findById($return['Port']['id']);
						//$this->autoRender = false;
						echo json_encode(array('status'=>'success',"message"=>"Your Port information is successfully added!",'data'=>$returnData));	
					}else{
						echo json_encode(array("status"=>"error","message"=>$this->Port->validationErrors));
					}					
				}else{
					
				$CountriesDetails = $this->Country->find('list', array('fields'=>array('Country.id','Country.country_name')));		
				$this->set('CountriesDetails',$CountriesDetails);

				$transportDetails = $this->Transport->find('list', array('fields'=>array('Transport.id','Transport.transport_name')));		
				$this->set('transportDetails',$transportDetails);	
		
		}	
			
	}
	
	public function admin_showlist()
	{
		if($this->request->is('ajax'))
				{
					$id = $this->data['id'];
					$this->Auction->virtualFields = array('auction_name_place' => "CONCAT(Auction.auction_name,'-', Auction.auction_place)");
					
					$AuctionDetails = $this->Auction->find('list', array('fields'=>array('Auction.id','Auction.auction_name_place'),'conditions'=>array('Auction.country_id' =>$id)));		
					
					$option = "";
					
					$array = array();
					if(!empty($AuctionDetails)){
						foreach($AuctionDetails as $key=>$val)
						{
							echo $option = "<option value=".$key.">".$val."</option>";				
						}
					}else{
						//$select = "Select Auction";
						echo "Please Select Auction!";
					}
					die;					
				}
	}	
	
	public function admin_update($id=null,$pageNo=null) {
	
		if ($this->request -> isPost())
		{	
			echo $pageNo;
			$this->autoRender = false;
			$this->Port->set($this->data);
			if($this->Port->portValidation()){
				$data = array();
				$data['Port']['id'] = $this->data['id'];
				$data['Port']['port_name'] = $this->data['port_name'];
				$data['Port']['country_id'] = $this->data['country_name'];
				$data['Port']['auction_id']= $this->data['auction'];
				$data['Port']['transport_id'] = $this->data['transport_name'];
				
				$this->Port->save($data);
				$returnData = $this->Port->findById($data['Port']['id']);
				echo json_encode(array('status'=>'success',"message"=>"Your Port information is successfully edited!",'data'=>$returnData,"pageNo"=>$pageNo));
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Port->validationErrors));
				
			}
			
										
		}else{
				$this->layout = false;
				$portDdata = $this->Port->find('all',array('conditions'=>array('Port.id'=>$id)),array('order'=>'Port.id desc'));
				foreach($portDdata as $key=>$val)
				{
					$portId = $val['Port']['id'];
					$portName = $val['Port']['port_name'];
					$rickshaw = $val['Port']['rickshaw'];
					$aictionId = $val['Auction']['id'];
					$countryId = $val['Auction']['country_id'];
					$transportId = $val['Transport']['id'];
				}
				$this->set('portId',$portId);
				$this->set('portName',$portName);
				$this->set('rickshaw',$rickshaw);
				//pr($portDdata);
				
				$CountriesDetails = $this->Country->find('list', array('fields'=>array('Country.id','Country.country_name'),array('Conditions'=>array('Country.id'=>$countryId ))));		
				$this->set('CountriesDetails',$CountriesDetails);
				$this->set('CountriesId',$countryId);

				$this->Auction->virtualFields = array('auction_name_place' => "CONCAT(Auction.auction_name,'-', Auction.auction_place)");
							
				$AuctionDetails = $this->Auction->find('list', array('fields'=>array('Auction.id','Auction.auction_name_place'),'conditions'=>array('Auction.id' =>$aictionId)));
				$this->set('AuctionDetails',$AuctionDetails);
				
				//$transportDetails = $this->Transport->find('list', array('fields'=>array('Transport.id','Transport.transport_name'),'conditions'=>array('Transport.id' =>$transportId)));
				
				
				$transportDetails = $this->Transport->find('list', array('fields'=>array('Transport.id','Transport.transport_name')));		
				$this->set('transportDetails',$transportDetails);
				$this->set('transportId',$transportId);
				$this->set('pages',$pageNo);		

			}
	}
	
	public function admin_delete() {
		$this->autoRender = false;
		
			if ($this->request -> isPost()) {
				
				if ($this->Port->delete($this->data['id'], false)) {
					//echo json_encode(array('status'=>'success'));
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
  // $this->Car->unbindModel(array('hasMany' => array('CarImage')));
 
    $Port = $this->Port->find('all',array('conditions'=>array(					
						'Port.port_name LIKE' => '%'.$term.'%' ,
					),
					'group' => array('Port.port_name'),
					'fields' =>array('Port.id','Port.port_name'))
       );
			$result = array();
		foreach($Port as $key => $myPort) {
			$result[] = array("id"=>@$myPort['Port']['id'],"text"=>@$myPort['Port']['port_name']);	
					}
		echo json_encode($result);
		 
	}
	 
	public function admin_port_detail(){
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}	
			
		if($this->request->is('ajax')){		
			$count=$this->Port->find('count',array('conditions'=>array(
							'Port.port_name LIKE' => '%'.$this->data['name'].'%',
							)));
			$limit = $this->limit;
			$this->paginate = array(        
			'limit' => $limit,
			'conditions' => array('Port.port_name LIKE' => '%'.$this->data['name'].'%'),
			'order' => array(
				'Port.id' => 'desc'
				)
			);	
			$Port = $this->Paginator->paginate('Port');
				
			//$this->set('pages', $this->data['pageNo']);
			
			
					
			$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
			$this->set('Port', $Port);
			$this->set('limit', $limit);
			$this->set('count', $count);
			$this->set('searchName',$this->data['name']);
			
		} else{
			//echo $key;
			echo $this->passedArgs['searchName'];
			//$this->passedArgs['page'];
			
			$count=$this->Port->find('count',array('conditions'=>array(
							'Port.port_name LIKE' => '%'.$this->passedArgs['searchName'].'%',
							)));
			$limit = $this->limit;
			$this->paginate = array(        
			'limit' => $limit,
			'conditions' => array('Port.port_name LIKE' => '%'.$this->passedArgs['searchName'].'%'),
			'order' => array(
				'Port.id' => 'desc'
				)
			);	
			$Port = $this->Paginator->paginate('Port');
			
			$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
			$this->set('Port', $Port);
			$this->set('limit', $limit);
			$this->set('count', $count);
			$this->set('searchName',$this->passedArgs['searchName']);
		}
		
		
	}
	
	public function admin_show_all_user(){
		if($this->request->is('ajax')){
			$portDetails = $this->Port->find('all');
			$this->set('portDetails',$portDetails);
		}
	}
	
	public function admin_render_page_port(){
		
		
		$limit = $this->limit;
		$Port=$this->Port->find('all');
		$count = count($Port);
		$this->set('Port',$Port);
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
		}	
		else{
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
		}	
		
		$portDetails= $this->Paginator->paginate('Port');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('portDetails', $portDetails);
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
			
		$count=$this->Port->find('count',array('conditions'=>array(
						'Port.port_name LIKE' => '%'.$this->passedArgs['searchName'].'%',
						)));
		$limit = $this->limit;
		$this->paginate = array(        
		'limit' => $limit,
		'conditions' => array('Port.port_name LIKE' => '%'.$this->passedArgs['searchName'].'%'),
		'order' => array(
			'Port.id' => 'desc'
			)
		);	
		$Port = $this->Paginator->paginate('Port');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('Port', $Port);
		$this->set('limit', $limit);
		$this->set('count', $count);
		$this->set('searchName',$this->passedArgs['searchName']);
	
	}
	
	public function admin_upload_excel(){
		if($this->request->isPost()){
			$type = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/pjpeg','images/x-png','image/PNG');
			$data = array();
			$fileName = "exltemp/".time()."_".$this->request->data['Port']['PortExcel']['name'];
			move_uploaded_file($this->request->data['Port']['PortExcel']['tmp_name'], WWW_ROOT . $fileName);
			
			
			$dataExl = new Spreadsheet_Excel_Reader($fileName, true);
			$temp = $dataExl->dumptoarray();
			
			for($i = 2; $i <= count($temp); $i++)
			{
				if($temp[$i][1] != "" && $temp[$i][2] != "" && $temp[$i][3] != "" && $temp[$i][4] != "" && $temp[$i][5] != "")
				{
					$CountCountry=$this->Country->find('all',array('conditions'=>array('country_name' => $temp[$i][2])));
					$CountryId = $CountCountry[0]['Country']['id'];
					
					$CountAuction=$this->Auction->find('all',array('conditions'=>array('auction_name' => $temp[$i][3], "auction_place" => $temp[$i][4])));
					$AuctionId = $CountAuction[0]['Auction']['id'];
					
					$CountTransport=$this->Transport->find('all',array('conditions'=>array('transport_name' => $temp[$i][5])));
					$TransportId = $CountTransport[0]['Transport']['id'];
						
					$this->Port->create();
					$datas = array();
					$datas['port_name'] = $temp[$i][1];
					$datas['country_id'] = $CountryId;
					$datas['transport_id'] = $TransportId;
					$datas['auction_id'] = $AuctionId;
					$datas['rickshaw'] = $temp[$i][6];
					$this->Port->set($datas);
					if($this->Port->portValidation()){
						$this->Port->save($datas);
					}
				}
			}
			$this->redirect('/admin/ports/');
		}
	}
}
