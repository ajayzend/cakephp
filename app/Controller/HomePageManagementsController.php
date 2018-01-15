<?php
App::uses('AppController', 'Controller');

/*
 * @HomePageManagement Controller to controll 
 * the logic of home page like slider, featured product etc.
 * 
 * 
 * 
 */
class HomePageManagementsController extends AppController {
	
	public $helpers = array('Html', 'Form', 'Session');
	public $uses=array('Car',"HomePageData","homeSliderOrders","HomePageSlide");
/*
 * Use to show homepagemanagement page in admin section
 * @required nothing
 * @return view logic for homepage management page 
 * @return products and selected products for homepage slider 
 */
		 public function beforeFilter() {
				$this->UserAuth->loginPage='/admin/login';
				parent::beforeFilter();
				$this->layout='default_admin';
				//$this->User->userAuth=$this->UserAuth;
			}
			
	
	public function admin_index()
	{		
		if ($this->request->is('post'))
		{
			$this->Session->write('slide_limit', $this->data['limit']['no_of_pages']);
			//$this->Session->write('limit', '1');
		}
		if($this->Session->read('slide_limit') == 0 || $this->Session->read('slide_limit') == null)
		{
			$this->Session->write('slide_limit', '10');

		}	
		$this->paginate=array('order'=>'HomePageSlide.order ASC', 'limit'=>10);
		$slides= $this->paginate('HomePageSlide');

		//$slides = $this->HomePageSlide->find('all',array('order'=>array('HomePageSlide.order'=>'ASC'),'limit'=>5));
		$this->set('slides',$slides);
		
	}
	
	function admin_add(){
		      	
		      	//echo "sudhir";
					//$Cars = $this->Car->find('all',array('fields'=>array('id','car_name')));
					//pr($Cars); die;
					//$this->set('Cars',$Cars);
					//$this->set('keyfeatures',$this->Keyfeature->find('all'));
			
						
	}	
	
	function admin_delete($id = null)
	{
		if($id==null)
		{
			$this->Session->setFlash('No Slide To Delete ','success_flash');
			$this->redirect(array('action'=>'index'));
		}else
		{
			$this->HomePageSlide->id=$id;
			$record = $this->HomePageSlide->find('first',array('fields'=>array('image_source')));
			
			if ($this->HomePageSlide->delete($id)) 
			{
				@unlink(WWW_ROOT.'img/HomePageManagements/'.$record['HomePageSlide']['image_source']);
				$this->Session->setFlash('Slide data successfull deleted.!!! ','success_flash');
				$this->redirect(array(
					'action' => 'index'
				));
			}
			
		}					
	}	
	
	/*
	*function to edit homePage slide 
	*@required all data related to slide in post request
	*@Type Post
	*@return - redirect to homepage management index page with success message
	*/
	function admin_edit($id = null)
	{
		if(isset($id))
		{
			$selected_pro = $this->HomePageSlide->find('first',array('conditions'=>array('HomePageSlide.id'=>$id)));
			if(!empty($id))
			{
					$this->set('selected_pro',$selected_pro);
					
					$this->data = $this->HomePageSlide->read(null, $id);
					$this->set($this->data);
					
			}else
			{
						$this->Session->setFlash('This record does not exist','flash_delete');
						$this->redirect(array('action'=>'index'));
			}
		}else
		{
					$this->Session->setFlash('Please select ID','flash_delete');
					$this->redirect(array('action'=>'index'));
		}
										
	}	
	
	

	
	function admin_saveSlide($id=null){
				
				if($this->request->isPost())
				{
					//pr($this->request->data);  die;
					$image =  array('gif','png' ,'jpg','jpeg');	
					$data['order'] = $this->request->data['HomePageSlide']['order'];
					$data['slide_name'] = $this->request->data['HomePageSlide']['slide_name'];
					/* Image Coding */
										
		    	  	if($this->request->data['HomePageSlide']['image']['error'] == 0)
		    	  	{
						$data['image_name'] = $this->request->data['HomePageSlide']['image']['name'];
						$data['image_source']=substr(pathinfo($data['image_name'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo($data['image_name'], PATHINFO_EXTENSION);
					
					}
		    	 
					if($id != null){
						$this->HomePageSlide->id = $id;
						//$this->HomePageSlideKeyfeature->deleteAll(array('HomePageSlideKeyfeature.home_page_slide_id' => $id));
					}
					
					
					$retId = $this->HomePageSlide->save($data);
					if($retId)
					{
									/* file moving code  */
						if($this->request->data['HomePageSlide']['image']['error'] == 0)
						{
							if(move_uploaded_file($this->request->data['HomePageSlide']['image']['tmp_name'],WWW_ROOT.'img/HomePageManagements/'.$data['image_source']))
							{
								@unlink(WWW_ROOT.'img/HomePageManagements/'.$this->request->data['HomePageSlide']['old_img']);
										
							}else
							{
								echo 'error in moving file ';die;
							}	
						}
						$this->Session->setFlash('Slide data successfull updated','success_flash');
						$this->redirect(array('action'=>'index'));
					}	
				}
				else
				{
						$this->Session->setFlash('Direct access is not allowed','flash_delete');
						$this->redirect('/admin');
				}
		}

/*
 * saveSlider function to save slider of homepagemanage and 
 * keep the ordering  
 * @required params sorted product ids 
 * @return true on success and flase on faliure
 */
 
	/*function admin_saveSlider(){
			$this->render = false;
			
			@$sorted = $this->data['sorted'];
			
			
			$this->homeSliderOrders->deleteAll(array(1 => 1), false);
			if(count($sorted) > 0){
				foreach($sorted as $key=>$val){
						$insertedVal = array(check_img
									'car_id'=>$val,'order'=>++$key);
									//pr($insertedVal);
					
					$return = $this->homeSliderOrders->save($insertedVal);
					$this->homeSliderOrders->create();
					if(!$return){
							echo 'error';die;
						}
					}
			}
			echo 'Success';
			die;
		
	
	}*/
	
/*
 * slider_status function change the status of slider 
 * @required params are 1 and 0 
 * return currnet status of slider 
 */	
	
	function admin_slider_status(){
			$this->layout='ajax';
			
				if ($this->request->is('post')) 
				{
					
					$data=array();
				   
					$data['id']=$this->request->data['id'];
					$data['status']=$this->request->data['status'];
					
					if($return  = $this->HomePageSlide->save($data)){
						echo $return['HomePageSlide']['status'];
						
						}else{
						echo false;
						}
					
				}
				die;
			
		
		}
		
/*
 * Save slide order 
 * 
 */	
		 function admin_saveSlideOrder()
		 {
			if ($this->request->is('post'))
			{
				$order = $this->data['order'];
					foreach($order as $key=>$item)
					{
						$data['id'] = $item;
						$data['order'] = $key;
						$updateOrder = $this->HomePageSlide->save($data);
					}
					if($updateOrder)
					{
						return json_encode(array('status'=>'success','message'=>'Order successfully updated.!!!'));
					}
					else
					{
						return json_encode(array('status'=>'success','message'=>'Something went wrong.!!!'));
					}
				
			}
			else
			{
				return json_encode(array('status'=>'success','message'=>'Something went wrong.!!!'));
			}
			 
		}		
				
		
		
	function admin_delete_old($id = null){
			if($id){
					/*$products = $this->Product->findById($id);
					$image=$products['Product']['banner'];
					*/
					if ($this->HomePageSliderOrder->delete($id)){
						//unlink(WWW_ROOT.'files/'.$image);
	   
						$this->Session->setFlash('The Slide with id: ' . $id . ' has been deleted.','flash_delete');
		   
						$this->redirect(array('action' => 'admin_index'));
					}
					
					
					
					
					
					
					}else{
							$i = 0;
							$id = $this->request->data;
							if(is_array($id)){
								foreach($id as $val){
										if($val != 0){
											$i++;
											//$products = $this->Product->findById($val);
											
											//$image=$products['Product']['banner'];
											
											if ($this->HomePageSliderOrder->delete($val)){
												//@unlink(WWW_ROOT.'files/'.$image);
							   
												
												$this->Product->create();
												//$this->redirect(array('action' => 'admin_index'));
											}
										}
									}
									
									$this->Session->setFlash('Total : ' . $i . ' Slide has been deleted.','flash_delete');
									$this->redirect(array('action' => 'admin_index'));
							
							}
							$this->Session->setFlash('Total : ' . $i . ' Slide has been deleted.','flash_delete');
							$this->redirect(array('action' => 'admin_index'));
							
			
					}
		
		
		
		
		}

	
	
	function admin_keyfeature_edit($id){
		
					
						$this->layout=null;
						$select_pro=$id;	
						#############################################################
						#Bind HomePageSlideKeyfeature model to keyfeature 			#
						#############################################################
						
						$this->HomePageSlideKeyfeature->bindModel( array( 'belongsTo' => array('Keyfeature' => array('className'=>'Keyfeature','foreignKey' => 'keyfeature_id') ) ) );
						
						#############################################################
						#Find  keyfeature that are related to selected slide		#
						#############################################################
						
						$slide_keyfeature=$this->HomePageSlideKeyfeature->find('all',array('conditions' => array('home_page_slide_id' => $select_pro)));
						//pr($product_keyfeature);die;
						foreach($slide_keyfeature as $val){
						$notKeyFeature[] = $val['HomePageSlideKeyfeature']['keyfeature_id'];
						}


						if(!isset($notKeyFeature)){
						$notKeyFeature = '';
						}

						############################################################
						#Find all keyfeature not slected keyfeature($notKeyFeature)#
						############################################################
						$keyfeature=$this->Keyfeature->find('all',array('conditions'=>array( 'NOT' => array('Keyfeature.id' => $notKeyFeature))));
						//return $keyfeatures;
						//pr($keyfeature);die;	
						//pr($product_keyfeature);die;
							
						$this->set('product_keyfeature',$slide_keyfeature);
						$this->set('kid',$keyfeature);
						$this->set('slideId',$select_pro);

		
		}

	function admin_save_slide_keyfeature($id){
				
				if($id == null || !isset($this->data['order'])){
					if($id){
					$this->HomePageSlideKeyfeature->deleteAll(array('HomePageSlideKeyfeature.home_page_slide_id' => $id));
					 echo 'success';die;
					}echo 'Nothing To save';die;
					
					
					}
					$select_product=$id;
					$this->layout='ajax';
					$this->render = null;
					
					//pr($this->data['order']);die;
					//pr(count($this->data['order']));die;
					$i = 1;
					$b=array();
					############################################################
					# Delete all slides keyfeatures related to selected slide  #
					############################################################
					$this->HomePageSlideKeyfeature->deleteAll(array('HomePageSlideKeyfeature.home_page_slide_id' => $select_product));
					
					//echo "delte=>".$rs."->";
					for($i=0;$i<count($this->data['order']);$i++)
					{
						
						$order=$i+1;
						$keyfeature_id=$this->data['order'][$i];			
					
						
							
					 $value = array(
							
							'keyfeature_id' => $keyfeature_id,
							"home_page_slide_id"=>$select_product
							);		
						if(!$this->HomePageSlideKeyfeature->save($value)){
							
							echo "error"; 	
						}
						
						
						$this->HomePageSlideKeyfeature->create();
						 
						
					}
						echo "success";
					die;
		
		
		}	

/*
 * save home page text data in db
 * @text required
 * @return true on success flase on faliure
 * 
 */
	function admin_saveText(){
		//pr($this->data);die;
			$data['description'] = $this->data['HomePageData']['description'];
			$data['id'] = 1;
			$this->HomePageData->id = 1;
			if($this->HomePageData->saveField("description",$data['description'])){
				echo json_encode(array("status"=>"success"));die;
				}else{
					echo 'error';
					}
		
	}
/*
 * Function admin_updateFeatureProducts to update featured products for home page 
 * @required four products IDs to update.
 * @return true on success, false on failure
 */
 
	function admin_updateFeatureProducts(){
			$this->render = false;
			if($this->data['featureProducts']){
			
				$this->Product->updateAll( array('Product.home_feature' => 0) );
				$this->Product->create();
			$data = $this->data['featureProducts'];
		
			foreach($data as $item){
					$a['id'] = $item; 
					$a['home_feature'] =  1;
				
					$this->Product->save($a);
		
					$this->Product->create();
				}
	    }else{
				echo 'error';die;
			}
		
		echo 'success';die;
		}
	
}
