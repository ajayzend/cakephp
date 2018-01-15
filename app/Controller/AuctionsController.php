<?php
App::uses('AppController', 'Controller');

class AuctionsController extends AppController {
	
	public $uses = array('Auction','Country','Session');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
	var $limit=10;
////////////////////////////////////////////////////////

	public function beforeFilter() {
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';

	}
	
	
     public function admin_index(){
	 
		 
		 }
		 
	   /* add Auction   */	 
	   
				 public function admin_add(){
					if($this->request->is('post')){
						$this->Auction->set($this->data);
			         if($this->Auction->auctValidate()){
						$data = array();
						$data['country_id'] = $this->request->data['auction']['country_id'];
						$data['auction_name'] = $this->request->data['auction']['auction_name'];
						$data['auction_place'] = $this->request->data['auction']['auction_place'];
						$data['fees'] = $this->request->data['auction']['fees'];
						//pr($data); die;
						$this->Auction->save($data);
					    
						if($this->Auction->save($data)){
							
							$this->Session->setFlash("Data successfully saved");
							//$this->redirect(array('controller' => 'auctions', 'action' => 'add'));
							}
							
							}else{
								
								//$this->Session->setFlash("Some thing went wrong");
								$this->redirect(array('controller' => 'auctions', 'action' => 'add'));
								
								}
						
						} 

					 $CountryDetails=$this->Country->find('list',array('fields'=>array('Country.country_name')));

				     $this->set('CountryDetail',$CountryDetails);
				     /*$this->paginate = array('limit'=>5, 'order'=>array('id'=>'ASC'));		
					$Auctions= $this->Paginator->paginate('Auction');  		
					$this->set('auction', $Auctions);*/
				 
		$limit = $this->limit;
		$Auction=$this->Auction->find('all');
		$count = count($Auction);
		$this->set('auction',$Auction);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'desc'));		
		$Auction= $this->Paginator->paginate('Auction');
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('auction', $Auction);
		$this->set('limit', $limit);
		$this->set('count', $count);
		}
	   /*  admin edit Country   */
		/*	 public function admin_edit_auction($id = null){
		    if($this->request->isPost()){
			if($this->data['model'] && $this->data['id']){
				$model = $this->data['model'];
				$id = $this->data['id'];
				$this->$model->alias = 'Auction';
				$name = $this->$model->findById($id);
				//pr($name);die;
				$this->set('name',$name);
				$this->set('model',$model);
				$this->set('id',$id);
				
			}else{
				echo 'error';
				$this->autoRender = false;
			}
		
		}
		$CountryDetails=$this->Country->find('list',array('fields'=>array('Country.id','Country.country_name')));
		$this->set('CountryDetail',$CountryDetails);
	
	}
	*/
	
		/*    admin delete auction  */
	public function admin_delete_auction (){
	$this->autoRender = false;
		if($this->request->isPost()){
			
			$model = "Auction";
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
		}
	
	}
	/*  admin edit Auction here  */
	
	public function admin_saveAuctName(){
		$this->autoRender = false;
		if($this->request->isPost()){
			if($this->data['auction']['id']){
				//$model = $this->data['model'];
				$id = $this->data['auction']['id'];
				$AuctionName = $this->data['auction']['auction_name'];
				$AuctionPlace = $this->data['auction']['auction_place'];
				$fees = $this->data['auction']['fees'];

				//if(strlen($name)>0){
				$data = array('id'=>$id,'auction_name'=>$AuctionName,'auction_place'=>$AuctionPlace,'fees'=>$fees);
			//	pr($data); die;
				$ret = $this->Auction->save($data);
				
				if($ret){
					echo json_encode(array('status'=>'success','data'=>$ret));
				}else{
				
				}
			//	}else{
				//	echo json_encode(array('status'=>'error','data'=>$ret[$model]['name'],'message'=>'Cateegory name can not be empty'));
				//}
			}
		
		}
	
	}
	
	 /*  admin edit Auction   */
			 public function admin_edit_auction($id =null){
		    if ($this->request -> isPost()){
		
			$this->autoRender = false;
			$this->Auction->set($this->data);
		if ($this->Auction->auctValidate()) {
			$data = array();
			$data['id'] = $this->data['Auction']['id'];
			$data['auction_name'] = $this->data['Auction']['auction_name'];
			$data['auction_place'] = $this->data['Auction']['auction_place'];
			$data['fees']= $this->data['Auction']['fees'];
			$data['country_id'] = $this->data['Auction']['country_name'];
          // pr($data); die;
			$returnMyData = $this->Auction->save($data);
			echo json_encode(array("status"=>"success","message"=>"Auction is successfully Updated!","data"=>$returnMyData)); die;
		}else{
			
			echo json_encode(array("status"=>"error","message"=>$this->Auction->validationErrors));
			
			}
}
		   //  $this->Auction->unbindModel(array('hasMany' => array('C')));
             $AuctionData = $this->Auction->find('all',array('conditions'=>array('Auction.id'=>$id)),array('order'=>'Auction.id desc'));
         //    pr($AuctionData); die;
             	foreach($AuctionData as $key=>$val)
             				{		
					$auctionId = $val['Auction']['id'];
					$auctionName = $val['Auction']['auction_name'];
					$auctionplace = $val['Auction']['auction_place'];
					$auctionfee = $val['Auction']['fees'];
					$CountryData1 = $val['Country']['id'];

				}

				$this->set('auctionId',@$auctionId);
				$this->set('auctionName',@$auctionName);
				$this->set('auctionplace',@$auctionplace);
				$this->set('auctionfee',@$auctionfee);
				$this->set('CountryData1',@$CountryData1);
				
		$CountryDetails=$this->Country->find('list',array('fields'=>array('Country.id','Country.country_name')));
		
		$this->set('CountryDetail',$CountryDetails);
	}
	  
	  /*    search for auction name    */
		public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
   $term = $this->request->query['q'];
  // $this->Car->unbindModel(array('hasMany' => array('CarImage')));
 
    $AuctionData = $this->Auction->find('all',array('conditions'=>array(					
						'Auction.auction_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('Auction.id','Auction.auction_name','Auction.auction_place'),'group'=>'Auction.auction_place')
       );

    // Format the result for select1
		$result = array();
		foreach($AuctionData as $key => $myauction) {
			$result[] = array("id"=>$myauction['Auction']['id'],"text"=>$myauction['Auction']['auction_name'].'-'.$myauction['Auction']['auction_place']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_auction_detail(){
	
		//	$this->Country->unbindModel(array('hasMany' => array('Auction')));
			if($this->request->is('ajax')){
			$arr=explode('-',$this->data['name']);
			$Auction = $this->Auction->find('all',array('conditions'=>array(
					'Auction.auction_name LIKE' => '%'.$arr[0].'%','Auction.auction_place LIKE' => '%'.$arr[1].'%',
					)));
		
			$this->set('auction',$Auction);
		}
	}
	   
	    public function admin_render_page_auction(){
		
		 
		$limit = $this->limit;
		$Auction=$this->Auction->find('all');
		$count = count($Auction);
		$this->set('Auction',$Auction);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		
		$Auction= $this->Paginator->paginate('Auction');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('Auction', $Auction);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}   
	
	   
	   
}
