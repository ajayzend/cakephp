<?php
 App::uses('AppController', 'Controller');
class SliderManagementsController extends AppController{
public $uses=array('SliderManagement','Product','Keyfeature','KeyfeatureOrder','SlideKeyfeature','Car');
/*Function for index page.
 * 
 * 
 * 
* */ 


			function admin_index(){
				
			$this->layout='default';
			$this->Product->unbindModel(array( 'belongsTo' => array( 'ProductCategory','ProductSubcategory') ) ) ;	
			//$this->cAR->bindModel( array( 'hasMany' => array('SliderManagement' => array('className'=>'SliderManagement','foreignKey' => 'cars_id') ) ) );
				//$slide_products=$this->SliderManagement->find('all',array('fields'=>array('COUNT(SliderManagement.id)','id','p_id'),'recursive'=>2));
				
			//$slide_products=$this->SliderManagement->find('all',array('group'=>'p_id',));
			 
			$slide_products=$this->Car->find('all');
			//pr($slide_products);die;
			$this->set('slide_products',$slide_products);
			//pr($slide_products);die;
			}
	
	
	
/*function for adding a new slide
 * 
 * 
 */	
				function admin_add($id=""){
			
					//$select_pro=$id;
					//pr($select_pro);die;
					//$this->set('select_pro',$select_pro);
					$p_id=$this->SliderManagement->find('all',array('fields'=>array('SliderManagement.p_id')));
					foreach($p_id as $val){
							$notProduct[]=$val['SliderManagement']['p_id'];
						
					}
					if(!isset($notProduct)){
					$notProduct = '';
					}
					
					$product=$this->Car->find('list',array('fields'=>array('id','name'),'conditions' => array('not'=>array('Car.id' =>$notProduct)/*,'Product.language_id'=>$this->_adminLanguage()*/)));
					//spr($product);
					$this->set('pid',$product);	

					if($id!=""){
							$select_pro=$id;
							$this->set('select_pro',$select_pro);
							//$slide_products=$this->SliderManagement->find('all',array('conditions'=>array('p_id'=>$select_pro)));
							//pr($slide_product);die;
							//$this->set('slide_products',$slide_products);


					}

						
							if($this->request->isPost()){
								
							$slide_numb=$this->data['SliderManagements']['slide_numb'];
							$this->set('slide_numb',$slide_numb);
							
							}
							
			
						
				}	
				
/*Function to save slide
 * 
 * 
 */
			function admin_saveSlide(){
			
				if($this->request->isPost()){
				$select_product=$this->data['SliderManagements']['pid'];
				
				
				//echo count($this->data['SliderManagements']['slide_desc']);die;
				//$slide_values=$this->data['SliderManagements'];
					$this->SliderManagement->deleteAll(array('SliderManagement.p_id' => $select_product));
					for($i=0;$i<count($this->data['SliderManagements']['slide_desc']);$i++){
						
						/*Code to resize the image starts*/		
							
							if(empty($this->data['SliderManagements']['image'][$i]['name']))
							$data['image']="";
								else{
								$data['image']=$this->data['SliderManagements']['image'][$i]['name'];
								
								
								$data['image_source']=substr(pathinfo($data['image'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo($data['image'], PATHINFO_EXTENSION);
								//pr($data['image_source']);die;
								// including image component 
								App::import('Component', 'Image');
								$imagename=	$data['image_source'];
								move_uploaded_file($this->request->data['SliderManagements']['image'][$i]['tmp_name'],WWW_ROOT.'img/SliderManagements/'.$data['image_source']);
								$MyImageCom = new ImageComponent();                 
								//$Largeimage=explode('.',$data['image_source']);
								$MyImageCom->imageToPng(WWW_ROOT."img/SliderManagements/".$data['image_source']);
								/*Code to resize the image ends*/
								}//else ends here
								
							
							$data['slide_title']=$this->data['SliderManagements']['slide_title'][$i];
							$data['description']=$this->data['SliderManagements']['slide_desc'][$i];
							
							$data['p_id']=$select_product;
								
							
							move_uploaded_file($this->request->data['SliderManagements']['image'][$i]['tmp_name'],WWW_ROOT.'img/SliderManagements/'.$this->request->data['SliderManagements']['image'][$i]['name']);
							
							 $a=$this->SliderManagement->save($data);
							// echo $a;
							 $this->SliderManagement->create();
							//pr($a);die;
							
							
						
							
					}
					$this->redirect(array('action'=>'index'));
					
					
				}	
			}	
		
/*function delete to remove all the slides associated with particular product
 * 
 * 
 */				

				
							 
				function admin_delete($id){
						
						//pr($eId);die;
						//$this->Pressrelease->delete($id);
						$slide_prod=$this->SliderManagement->find('all',array('conditions'=>array('SliderManagement.p_id'=>$id)));
						
					
							
						//pr($delete_slide);die;
						
						if($this->SliderManagement->deleteAll(array('SliderManagement.p_id' =>$id))){
							foreach($slide_prod as $delete_slide){
							//pr($delete_slide['SliderManagement']['image_source']);die;
							unlink(WWW_ROOT.'img/SliderManagements/'.$delete_slide['SliderManagement']['image_source']);
							}
							
							$this->Session->setFlash('Then Slide is successfully deleted.','flash_delete');
						}
						else{

							$this->Session->setFlash('The Slide has not been deleted.','flash_delete');
						}
							$this->redirect(array('action'=>'index'));
				}
				
/*function edit to list the number of slides for a particular product
 * 
 */				
				
				function admin_edit($id = null){
						
						$slide_edits=$this->SliderManagement->find('all',array('conditions'=>array('p_id'=>$id),'order' => array('SliderManagement.order' => 'ASC')));
						//pr($slide_edit);die;
						$this->set('slide_edits',$slide_edits);
						$this->set('product_id',$id);
					
				}
/*function to delete the slide selected 
 * 
 */				
				function admin_deleteSlide($id){
					
						$deleteSlide=$this->SliderManagement->find('all', array('conditions'=>array('id'=>$id)));
						//pr($deleteSlide);die;
						$image=$deleteSlide[0]['SliderManagement']['image_source'];
						
						if($this->SliderManagement->delete($id)){
						unlink(WWW_ROOT.'img/SliderManagements/'.$image);
						$this->Session->setFlash('Slide is successfully deleted.','flash_delete');	
						}
						else{
						$this->Session->setFlash('Slide is not deleted.','flash_delete');
						}
						$this->redirect(array('action'=>'index'));
				}
/*function to edit the slide and to add the keyfeatures for the Slide
 * 
 * 
 */
				function admin_editSlide($id){
					
						$this->layout=null;
						$select_pro=$id;
						
						$this->SlideKeyfeature->bindModel( array( 'belongsTo' => array('Keyfeature' => array('className'=>'Keyfeature','foreignKey' => 'k_id') ) ) );
						
						$product_keyfeature=$this->SlideKeyfeature->find('all',array('conditions' => array('s_id' => $select_pro)));

						
						//pr($product_keyfeature);die;
						foreach($product_keyfeature as $val){
						$notKeyFeature[] = $val['SlideKeyfeature']['k_id'];
						}


						if(!isset($notKeyFeature)){
						$notKeyFeature = '';
						}

						$keyfeature=$this->Keyfeature->find('all',array('conditions'=>array( 'NOT' => array('Keyfeature.id' => $notKeyFeature))));
						//return $keyfeatures;
						//pr($keyfeature);die;	
						//pr($product_keyfeature);die;
							
						$this->set('product_keyfeature',$product_keyfeature);
						$this->set('kid',$keyfeature);
						$this->set('slideId',$select_pro);
						
													
			   }
						
/*
 *function to save the keyfeature fo slides 
 * 
 */
				
				function admin_saveorder($id)
				{
					
					 $select_product=$id;
					
					$this->layout='ajax';
					$this->render = null;
					
					//pr($this->data['order']);die;
					//pr(count($this->data['order']));die;
					$i = 1;
					$b=array();
					 $rs = $this->SlideKeyfeature->deleteAll(array('SlideKeyfeature.s_id' => $select_product));
					
					//echo "delte=>".$rs."->";
					for($i=0;$i<count($this->data['order']);$i++)
					{
						
						$order=$i+1;
						$keyfeature_id=$this->data['order'][$i];			
					
						
							
					 $value = array(
							
							'k_id' => $keyfeature_id,
							"s_id"=>$select_product
							);		
						if(!$this->SlideKeyfeature->save($value)){
							
							echo "error"; 	
						}
						
						
						$this->SlideKeyfeature->create();
						 
						
					}
						echo "success";
					die;
				}
				
/*
 * To change the description of slides
 * Editing images,title
 * 
 * 
 */		function admin_modifySlide($id,$pid){
	
				$slides_details=$this->SliderManagement->find('all',array('conditions'=>array('SliderManagement.id'=>$id)));
				
				//pr($slides_details);die;
				$this->set('slides_details',$slides_details);
				if($this->request->isPost()){
						
						$data['id']=$id;
						if($this->data['SliderManagement']['New_image']['name']!=""){
						
							/*Code to resize the image starts*/	
							
							$data['image'] =$this->data['SliderManagement']['New_image']['name'];
							$data['image_source']=substr(pathinfo($data['image'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo($data['image'], PATHINFO_EXTENSION);
							
							App::import('Component', 'Image');
							$imagename=$data['image_source'];
							if(move_uploaded_file($this->request->data['SliderManagement']['New_image']['tmp_name'],WWW_ROOT.'img/SliderManagements/'.$data['image_source'])){
							
							$remove_image=$this->data['SliderManagement']['old_image_source'];	
							
							unlink(WWW_ROOT.'img/SliderManagements/'.$remove_image);
							}
							
							
						
							$MyImageCom = new ImageComponent();                 
							//$Largeimage=explode('.',$imagename);

							$MyImageCom->imageToPng(WWW_ROOT."img/SliderManagements/".$data['image_source'],405,383);
						}

						/*Code to resize the image ends*/
						else{
						$data['image']=$this->data['SliderManagement']['old_image_source'];	
						
						}
						//$this->Keyfeature->id=$id;
						$data['url_info']=$this->data['SliderManagement']['url_info'];
						$data['slide_title']=$this->data['SliderManagement']['slide_title'];
						
						$data['description']=$this->data['SliderManagement']['slide_desc'];
						$data['slide_tag']=$this->data['SliderManagement']['slideName']."=>".$this->data['SliderManagement']['slideName2'];
						
						

						//pr($data);die;
						if($this->SliderManagement->save($data)){
						$this->Session->setFlash('Slider is successfully updated ','flash_success');	
						$this->redirect(array('action'=>'edit',$pid));

						}
						else{
						$this->Session->setFlash('Slider is not updated ','flash_success');	
						}

			}//endIf Request Post
		
		
	}	//end function	
/*This is to add the new Slides
 * 
 * 
 */			
			function admin_addSlide(){
				
					if($this->request->isPost()){
						if(isset($this->data['SliderManagements']['slide_numb'])){
						$slide_numb=$this->data['SliderManagements']['slide_numb'];
						//pr($slide_numb);die;
						$this->set('slide_numb',$slide_numb);
						}
							
					if(!empty($this->data['SliderManagements']['slide_desc'])){
								
						//pr($this->data);die;
						$select_product=$this->data['SliderManagements']['pid'];			
						for($i=0;$i<count($this->data['SliderManagements']['slide_desc']);$i++){
							
							if(!empty($this->data['SliderManagements']['image'][$i]['name'])){
							
							/*Code to resize the image starts*/		
							$data['image'] = $this->data['SliderManagements']['image'][$i]['name'];
							
							$data['image_source']=substr(pathinfo($data['image'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo($data['image'], PATHINFO_EXTENSION);
							//pr($data['image_source']);die;
							// including image component 
							App::import('Component', 'Image');
							$imagename=	$data['image_source'];
							move_uploaded_file($this->request->data['SliderManagements']['image'][$i]['tmp_name'],WWW_ROOT.'img/SliderManagements/'.$data['image_source']);
							$MyImageCom = new ImageComponent();                 
							//$Largeimage=explode('.',$data['image_source']);
							
							
							$MyImageCom->imageToPng(WWW_ROOT."img/SliderManagements/".$data['image_source'],405,383);
							
							/*Code to resize the image ends*/
							
							
							
							}else{
								
								$data['image_source']='';
								$data['image']='';
								}
							$data['url_info']=$this->data['SliderManagements']['url_info'][$i];
							$data['slide_title']=$this->data['SliderManagements']['slide_title'][$i];
							$data['description']=$this->data['SliderManagements']['slide_desc'][$i];
							$data['status']=1;
							$data['p_id']=$select_product;
							$data['slide_tag'] = $this->data['SliderManagement']['slideName'][$i]."=>".$this->data['SliderManagement']['slideName2'][$i];
							if(!$this->SliderManagement->save($data)){
								echo 'error in saving';
								die;
							};

							$this->SliderManagement->create();
						
						} // ending for loop
									
									echo 'success';die;	
							
				} // endIF
						
		} //endIf for Request->post
		
	}
			
			
/*
 * Function to save the order of Slides 
 * 
 * 
 */
		 function admin_saveSlideOrder(){
			//pr($this->data);die;
			if ($this->request->is('post')){
				$order = $this->data['order'];
					foreach($order as $key=>$item){
						$data['id'] = $item;
						$data['order'] = $key;
						//pr($data);
						if(!$this->SliderManagement->save($data)){
						echo 'error';die;
						}

					}
				echo 'success';die;
			}else{
			echo 'format error';
			}
			 
		}		
/*Function to change the status of slide as inactive or active
 * 
 * 
 */		
		
		function admin_slider_status(){
			$this->layout='ajax';
			
				if ($this->request->is('post')) 
				{
					
					$data=array();
				   
					$data['id']=$this->request->data['id'];
					$data['status']=$this->request->data['status'];
					
					if($return  = $this->SliderManagement->save($data)){
						echo $return['SliderManagement']['status'];
						
						}else{
						echo false;
						}
					
				}
				die;
			
		
		}
			
				
						
}
