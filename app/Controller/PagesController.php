		<?php
		/**
		 * Static content controller.
		 *
		 * This file will render views from views/pages/
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
		App::uses('AppController', 'Controller');
		
		/**
		 * Static content controller
		 *
		 * Override this controller by placing a copy in controllers directory of an application
		 *
		 * @package       app.Controller
		 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
		 */
		class PagesController extends AppController {
		
		/**
		 * Controller name
		 *
		 * @var string
		 */
			public $name = 'Pages';
			//public $uses= array('Page');
		
		/**
		 * This controller does not use a model
		 *
		 * @var array
		 */
			public $uses = array();
		
		/**
		 * Displays a view
		 *
		 * @param mixed What page to display
		 * @return void
		 */
			public function display() {
				$path = func_get_args();
		
				$count = count($path);
				if (!$count) {
					$this->redirect('/');
				}
				$page = $subpage = $title_for_layout = null;
		
				if (!empty($path[0])) {
					$page = $path[0];
				}
				if (!empty($path[1])) {
					$subpage = $path[1];
				}
				if (!empty($path[$count - 1])) {
					$title_for_layout = Inflector::humanize($path[$count - 1]);
				}
				$this->set(compact('page', 'subpage', 'title_for_layout'));
				$this->render(implode('/', $path));
			}
			
			 public function aboutus(){
				 $content  = $this->dynamic_content('About');
				$this->set('content',$content);
				
		   }  
			 public function services(){
		   
		   }
		  
		   public function payment(){
		   
		   }
		    public function terms_condition (){
				
				$content  = $this->dynamic_content('Terms');
				$this->set('content',$content);
		   
		   }	
			 public function edit_car (){
		   
		   }
			 public function Contactus(){
				$content  = $this->dynamic_content('Contact');
				$this->set('content',$content);
		   
		   }
		   	 public function car_details(){
		   
		   }
		   public function policy(){
		   
				$content  = $this->dynamic_content('Policy');
				$this->set('content',$content);
		   }
		   
		   function  dynamic_content($term)
		   {
			   $this->loadModel('Page');
			   $result = $this->Page->find('first',array('conditions'=>array('Page.title'=>$term)));
			   return $result['Page']['content'];
		   }
		   
		   Public function page_list() 
		   {
			   
			  if($this->Session->read('UserAuth.User.user_group_id')==1)
			  {
			   $this->layout='default_admin';
			   $this->loadModel('Page');
			   $content = $this->Page->find('all');
			    $this->set('content',$content);
			}else
			{
				$this->redirect('/');
			}
		   }
		   
		   Public function edit_page($id = null)
		   {
			  if($this->Session->read('UserAuth.User.user_group_id')==1)
			  {
			  
			  
			   $this->layout='default_admin';
			   $this->loadModel('Page');
			   $result = $this->Page->find('first',array('conditions'=>array('id'=>$id)));
			    if ($this->request->is(array('post','put'))) 
				{						
					$this->Page->read(null, $id);
					$this->Page->set('content', $this->data['Page']['content']);
					if ($this->Page->save()) 
					{
						$this->Session->setFlash(__('Your post has been updated.'));
						return $this->redirect(array('action'=>'page_list'));
					  										  
					}
					else
					{
						$this->Session->setFlash(__('Something went wrong,try again.'));
						return $this->redirect(array('action'=>'page_list'));
					}
				}
			    $this->set('result',$result);
			}else
			{
				$this->redirect('/');
			}
		   } 
		    
		    
		   public function edit_aboutus($id=null)
		   {
			 if($this->Session->read('UserAuth.User.user_group_id')==1)
			  {
			  	
				$this->layout='default_admin';

			   $id=@$this->request->params['pass'][0];
			   $this->loadModel('About');
			  
			  if($id=='') 
			  {
					if($this->request->is('post'))
					{
						
							$data=array();
							$image =  array('gif','png' ,'jpg','jpeg','PNG');	
							$upload_path=WWW_ROOT.'uploads/about_img/';
						  if(!empty($_FILES))
						  {
							  $data['id']= $id;
							  $data['img_path']=$this->data['Demo']['img_path']['name'];
							  $data['img_source']=substr(pathinfo( $data['img_path'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo( $data['img_path'], PATHINFO_EXTENSION);
							  $data['discription']=$this->data['Demo']['discription'];
							  $fileName = $this->data['Demo']['img_path']['name'];
								$save_file = $this->About->save($data);
								if($save_file)
								{
									  $move_file=move_uploaded_file($this->data['Demo']['img_path']['tmp_name'],$upload_path.$data['img_source']);
									  if($move_file)
									  {
										  $this->Session->setFlash('File saved successfully');
										  $this->redirect(array('action'=>'aboutus_list'));
									  
									   }
								 }
							}		  
						   $data=$this->About->find('all');
						   
						   $this->set('data',$data);
					   }
			   }
			   else
			   {
				   
				     if (!$id) {
							throw new NotFoundException(__('Invalid post'));
						}

						$About = $this->About->findById($id);
						$this->set('About',$About);
					
						if (!$About)
						{
							throw new NotFoundException(__('Invalid post'));
						}
                       $data=array();
                       $upload_path=WWW_ROOT.'uploads/about_img/';
						if ($this->request->is(array('post'))) 
						{
						        
							  $this->About->id = $id;
							  $data['id']= $id;
							  if($this->data['Demo']['img_path']['name']!='')
							  {
								    $data['img_path']=$this->data['Demo']['img_path']['name'];
							
									$data['img_source']=substr(pathinfo( $data['img_path'], PATHINFO_FILENAME),0,8)."_".time().'.'.pathinfo( $data['img_path'], PATHINFO_EXTENSION); 
							  }
							 
							  $data['discription']=$this->data['Demo']['discription'];
							
							if ($this->About->save($data)) 
							{
							
							  if($this->data['Demo']['img_path']['name'] !='')
							  {
								  $move_file=move_uploaded_file($this->data['Demo']['img_path']['tmp_name'],$upload_path.$data['img_source']);
								  if($move_file)
								  {
									$this->Session->setFlash(__('Your post has been updated.'));
									return $this->redirect(array('action'=>'aboutus_list'));
								  
								   }
							  }else
							  {
								  $this->Session->setFlash(__('Your post has been updated.'));
									return $this->redirect(array('action'=>'aboutus_list'));
							  }								
							  
							}
						}

						if (!$this->request->data) {
							$this->request->data = $About;
						}			
			   }	
		   }else
			{
				$this->redirect('/');
			}		   
		}
			
		public function aboutus_list()
		{
			if($this->Session->read('UserAuth.User.user_group_id')==1)
			  {
			$this->layout='default_admin';
			$this->loadModel('About');
			$data=$this->About->find('all');	   
			$this->set('data',$data);
		}else
		{
			$this->redirect('/');
		}
		}
	
			
			   
	   public function address()
		{
				   
				   
		   
		   }
		   
		   
		public function delete_aboutus($Id)
		{
			 if($this->Session->read('UserAuth.User.user_group_id')==1)
			  {
			$this->loadModel('About');
			if(!empty($Id)) 
			{
				$this->About->softDelete = true;
				if($this->About->delete($Id)) 
				{
					
					$this->Session->setFlash(__('About Us data successfully deleted'));
					$this->redirect('/pages/aboutus_list');
				}else
				{
					$this->Session->setFlash(__('Something went Wrong!!!'));
					$this->redirect('/pages/aboutus_list');
				}
			}
			}else
			{
				$this->redirect('/');
			}
			
		}  
		public function invoice_address()
		{
			if($this->Session->read('UserAuth.User.user_group_id')==1)
			{
				$this->layout='default_admin';
				$this->loadModel('InvoiceAddress');
				$result = $this->InvoiceAddress->find('all');
				$this->set('content',$result);
				
			}else
			{
				$this->redirect('/');
			}
		} 
		
		public  function add_address()
		{
			if($this->Session->read('UserAuth.User.user_group_id')==1)
			{
				$this->layout='default_admin';
				$this->loadModel('InvoiceAddress');
				if ($this->request->is(array('post','put'))) 
				{						
									
					$data['InvoiceAddress']['discription'] =  $this->request->data['Page']['discription'];
					$data['InvoiceAddress']['line_1'] =  $this->request->data['Page']['line_1'];
					$data['InvoiceAddress']['line_2'] =  $this->request->data['Page']['line_2'];
					$data['InvoiceAddress']['line_3'] =  $this->request->data['Page']['line_3'];
					$data['InvoiceAddress']['line_4'] =  $this->request->data['Page']['line_4'];
					$data['InvoiceAddress']['line_5'] =  $this->request->data['Page']['line_5'];
					$data['InvoiceAddress']['line_6'] =  $this->request->data['Page']['line_6'];
					$data['InvoiceAddress']['line_7'] =  $this->request->data['Page']['line_7'];				
					if($this->InvoiceAddress->save($data)) 
					{
						$this->Session->setFlash(__('Invoice address successfully added !!.'));
						return $this->redirect(array('action'=>'invoice_address'));
					  										  
					}
					else
					{
						$this->Session->setFlash(__('Something went wrong,try again.'));
						return $this->redirect(array('action'=>'invoice_address'));
					}
				}
				
			}else
			{
				$this->redirect('/');
			}
		}
		
		public  function edit_address($id=null)
		{
			if($this->Session->read('UserAuth.User.user_group_id')==1)
			{
				$this->layout='default_admin';
				$this->loadModel('InvoiceAddress');
				if ($this->request->is(array('post','put'))) 
				{						
					$data['InvoiceAddress']['id'] =  $this->request->data['id'];				
					$data['InvoiceAddress']['discription'] =  $this->request->data['Page']['discription'];
					$data['InvoiceAddress']['line_1'] =  $this->request->data['Page']['line_1'];
					$data['InvoiceAddress']['line_2'] =  $this->request->data['Page']['line_2'];
					$data['InvoiceAddress']['line_3'] =  $this->request->data['Page']['line_3'];
					$data['InvoiceAddress']['line_4'] =  $this->request->data['Page']['line_4'];
					$data['InvoiceAddress']['line_5'] =  $this->request->data['Page']['line_5'];
					$data['InvoiceAddress']['line_6'] =  $this->request->data['Page']['line_6'];
					$data['InvoiceAddress']['line_7'] =  $this->request->data['Page']['line_7'];				
					if($this->InvoiceAddress->save($data)) 
					{
						$this->Session->setFlash(__('Invoice successfully Updated!!.'));
						return $this->redirect(array('action'=>'invoice_address'));
					  										  
					}
					else
					{
						$this->Session->setFlash(__('Something went wrong,try again.'));
						return $this->redirect(array('action'=>'invoice_address'));
					}
				}
				$result = $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$id)));
				$this->set('result',$result);
				
			}else
			{
				$this->redirect('/');
			}
		}
		
		public function simple_email()
		{
				$this->autoRender = false;
				$Email = new CakeEmail();
				$Email->from(array('testphpprogram@gmail.com' => 'My Site'));
				$Email->to('uktoyama@ukcarstokyo.com');
				$Email->subject('About123');
				$Email->send('My message');
				pr($Email);
		 }
		
		
		   
	}
		
	
