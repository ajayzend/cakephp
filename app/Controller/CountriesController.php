<?php
App::uses('AppController', 'Controller');

class CountriesController extends AppController {
	
	public $uses = array('Car','CarImage','CarShipment','Auction','Venue','Country','Brand','Paginate','Paginator','Session');
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
		 $LastOrder= $this->Country->find('first',array('order' => array('Country.id DESC')));
		 
		 $OrderName=++$LastOrder['Country']['order'] ;

		if($this->request->isPost())
				{
					$this->request->data['Country']['country_image'] = $this->request->data['Country']['file']['name'];
				$this->Country->set($this->data);
				
			         if($this->Country->countryValidation()){
	
					$data = array();
					$data['country_name'] = $this->request->data['Country']['country_name'];
					$data['rickshaw'] = $this->request->data['Country']['rickshaw'];
					$data['freight'] = $this->request->data['Country']['freight'];
					$data['shipping'] = $this->request->data['Country']['shipping'];
					$data['others'] = $this->request->data['Country']['others'];
					$data['password'] = $this->request->data['Country']['password'];
					$data['order'] = $OrderName;
					$data['country_image']="images/countryImg/".$this->request->data['Country']['file']['name'];
					
					$this->Country->save($data);
				  
					if($this->Country->save($data)){
					 move_uploaded_file($this->request->data['Country']['file']['tmp_name'], WWW_ROOT . 'images/countryImg/' .$this->request->data['Country']['file']['name']);
				
					$this->Session->setFlash("Saved successfully");
				}
				    }
				 else{
					//$this->Session->setFlash("Not Saved Try Again!");
						
						}
					
				}
					

		/*	$this->paginate = array('limit'=>5, 'order'=>array('id'=>'desc'));		
			$Auctions= $this->Paginator->paginate('Country');  		
			$this->set('Auction', $Auctions);	*/
		$limit = $this->limit;
		$Country=$this->Country->find('all');
		$count = count($Country);
		$this->set('Auction',$Country);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'desc'));		
		$Country= $this->Paginator->paginate('Country');
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('Auction', $Country);
		$this->set('limit', $limit);
		$this->set('count', $count);
	//	$Order=$this->Country->find('list',array('fields'=>array('Country.id','Country.order')));
	//	$this->set('Order',$Order);	
	   }
	   
	   /*  admin edit Country   */
			 public function admin_edit_country($id =null){
			
			
		    if ($this->request -> isPost()){	
			$id=$this->data['country']['id'];
			$OldData=$this->Country->find('first',array('conditions'=>array('Country.id'=>$id)));			
			

		   $PostData=$this->Country->find('first',array('conditions'=>array('Country.order'=>$this->data['country']['order'])));

		   if(isset($PostData)){
		    $CData=array();
		    
		    $CData['Country']['id']= $PostData['Country']['id'];
			
			$CData['Country']['order']=$OldData['Country']['order'];
			
			$this->Country->save($CData);
			
		
			 $this->autoRender = false;
			
			$this->Country->set($this->data);
			if($this->Country->countryValidation()){
			$data = array();
			$data['id'] = $this->data['country']['id'];
			$data['country_name'] = $this->data['country']['country_name'];
			$data['rickshaw'] = $this->data['country']['rickshaw'];
			$data['freight']= $this->data['country']['freight'];
			$data['shipping'] = $this->data['country']['shipping'];
			$data['others'] = $this->data['country']['others'];
			$data['password'] = $this->data['country']['password'];
			$data['order'] = $this->data['country']['order'];
			
			
			//$this->data['country']['order'];
			if(isset($this->data['country']['file']['name']))
			$data['country_image']="images/countryImg/".$this->data['country']['file']['name'];
			//pr($returnData); die;
			$returnData = $this->Country->save($data);
		}
			$returnData['id'] =  $PostData['Country']['id'];
			$returnData['order'] =  $OldData['Country']['order'];
			if($returnData)
			if(isset($this->data['country']['file']['name']))
			 move_uploaded_file($this->request->data['country']['file']['tmp_name'], WWW_ROOT . 'images/countryImg/' .$this->request->data['country']['file']['name']);
			echo json_encode(array("status"=>"success","message"=>"Country is successfully Updated!","data"=>$returnData));die;
		}else{
			
			echo json_encode(array("status"=>"error","message"=>$this->Country->validationErrors));
			
			}
		}
			
		     $this->Country->unbindModel(array('hasMany' => array('Auction')));
             $CountryData = $this->Country->find('all',array('conditions'=>array('Country.id'=>$id)),array('order'=>'Country.id desc'));
          
             	foreach($CountryData as $key=>$val)
             				{
					$countryId = $val['Country']['id'];
					$countryName = $val['Country']['country_name'];
					$rickshaw = $val['Country']['rickshaw'];
					$freight = $val['Country']['freight'];
					$shipping = $val['Country']['shipping'];
					$others = $val['Country']['others'];
					$order = $val['Country']['order'];
					$Image = $val['Country']['country_image'];
					$Pass = $val['Country']['password'];
				}
                
				$this->set('countryId',$countryId);
				$this->set('countryName',$countryName);
				$this->set('rickshaw',$rickshaw);
				$this->set('freight',$freight);
				$this->set('shipping',$shipping);
				$this->set('others',$others);
				$this->set('order',$order);
				$this->set('Image',$Image);
				$this->set('Pass',$Pass);
		$CountryData = $this->Country->find('list',array('fields'=>array('Country.id','Country.country_name')));
             $this->set('CountryData',$CountryData);
	       //   $portId = $val['Port']['id'];
	}
		/*    admin delete country  */
	public function admin_delete_country(){
		$this->autoRender = false;
		if($this->request->isPost()){
			
			$model = "Country";
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
	
	public function admin_countryStatus() {
		
		$status = $this->data['status'];
		$country_id= $this->data['id'];			
		$this->Country->read(null, $country_id);
		$this->Country->set('status', $status);
		
		$update = $this->Country->save();
		if($update && $status == 1) {
			echo "Unpublish";
		} else {
			echo "Publish";
		}	
		die;  	
	}
	
	
		public function admin_saveCatName(){
		$this->autoRender = false;
		if($this->request->isPost()){
			if($this->data['country']['id']){
				//$model = $this->data['model'];
				$id = $this->data['country']['id'];
				$name = $this->data['country']['country_name'];
				$rick = $this->data['country']['rickshaw'];
				$freight = $this->data['country']['freight'];
				$shipping = $this->data['country']['shipping'];
				$Other = $this->data['country']['others'];
				if(strlen($name)>0){
				$data = array('id'=>$id,'country_name'=>$name,'rickshaw'=>$rick,'freight'=>$freight,'shipping'=>$shipping,'others'=>$Other);
			//	pr($data); die;
				$ret = $this->Country->save($data);
				
				if($ret){
					echo json_encode(array('status'=>'success','data'=>$ret));
				}else{
				
				}
				}else{
					echo json_encode(array('status'=>'error','data'=>$ret[$model]['name'],'message'=>'Cateegory name can not be empty'));
				}
			}
		
		}
	
	}
	
	/*    search for country name    */
		public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
   $term = $this->request->query['q'];
  // $this->Car->unbindModel(array('hasMany' => array('CarImage')));
 
    $Country = $this->Country->find('all',array('conditions'=>array(					
						'Country.country_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('Country.id','Country.country_name'))
       );

    // Format the result for select1
		$result = array();
		foreach($Country as $key => $mycountry) {
			$result[] = array("id"=>$mycountry['Country']['id'],"text"=>$mycountry['Country']['country_name']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_country_detail(){
	
			$this->Country->unbindModel(array('hasMany' => array('Auction')));
			if($this->request->is('ajax')){
    
			$Country = $this->Country->find('all',array('conditions'=>array(
					'Country.country_name LIKE' => '%'.$this->data['name'].'%',
					)));
			
			$this->set('Auction',$Country);
		}
	}
	  /* clear search function */
	  
	  public function admin_render_page_country(){
		
		 
		$limit = $this->limit;;
		$Country=$this->Country->find('all');
		$count = count($Country);
		$this->set('Country',$Country);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		
		$Country= $this->Paginator->paginate('Country');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('Auction', $Country);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}   
	/* delete the country  Image */
	public function admin_delete_images(){
					$this->autoRender = false;
					if($this -> request ->is('post')){
							if(isset($this->data['country_image'])){
									 $returnId= $this->Country->find('first',array('fields'=>'id','conditions'=>array('country_image'=>$this->data['country_image'])));
								//	pr($returnId); die;
									if($returnId){
										if($this->Country->delete($returnId['Country']['id'])){
												@unlink(WWW_ROOT.'/images/countryImg'.$this->data['country_image']);
												echo json_encode(array('status'=>'success','message'=>'deleted'));
											}else{
												echo json_encode(array('status'=>'successWithWarning','message'=>'not saved'));
										      
										      }
				                        }
				                     }
				                   }
	                         }
	                         
	      /* function for change the order of country */  
	      public function admin_changeOrder(){
			  
			  pr($this->data); die;
			  
			  
			  
			  }
	      
	                       
	                         
}

