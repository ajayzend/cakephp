<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'excel_reader2');

class BrandsController extends AppController {
	
	public $uses = array('Brand','Country','Session');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
	var $limit = 10;


	public function beforeFilter() {
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
	}
	
	
     public function admin_index(){
	 
		 
	}
		 
	   /* this action used for add brand 
	    * 
	     
	    * */	 
	   
	
	public function admin_add_brand(){
		
		if($this->request->isPost() && @$_POST['modeval'] == "")
		{
			$this->autoRender = false;
		//pr($this->request->data);
		//die;
		$type = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/pjpeg','images/x-png','image/PNG');
		//die;
			$data = array();
			$data['brand_name'] = $this->data['Brand']['brand_name'];
			$data['brand_image'] = $this->request->data['Brand']['brand_image']['name'];
			$this->Brand->set($data);
			
			if($this->Brand->brandValidation()){
				if(in_array($this->request->data['Brand']['brand_image']['type'],$type)){
					
					
					$data['brand_name'] = $this->data['Brand']['brand_name'];
				
					//$data['brand_image']="images/".$this->request->data['Brand']['file']['name'];
					$data['brand_image']="images/".time()."_".$this->request->data['Brand']['brand_image']['name'];
					$Brand = $this->Brand->save($data);
					
					//echo json_encode($Brand);
					if($Brand){
					  move_uploaded_file($this->request->data['Brand']['brand_image']['tmp_name'], WWW_ROOT . 'images/'.time()."_" .$this->request->data['Brand']['brand_image']['name']);
						echo json_encode(array("status"=>"success","message"=>"your Brand  is successfully added!","data"=>$Brand));
					}
				}else{
						echo json_encode(array("status"=>"error","message"=>"Please upload image type!"));
					}
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Brand->validationErrors));
			}
		
		
	}
	
		if($this->request->isPost() && $_POST['modeval'] == "delete")
		{
			$model = "Brand";
			foreach($_POST['BrandIds'] as $ids)
			{
				$id = $ids;
				$this->$model->id = $id;
				
				$ret = $this->$model->beforeDelete();
				$this->$model->create();
				if($ret==1){			
					$this->$model->deleteAll(array($model.'.id'=>$id));
					$this->set('success', 1);
				}else{
					$this->set('error', 1);
				}
			}
		}
		
		$limit = $this->limit;
		$Brand=$this->Brand->find('all');
		$count = count($Brand);
		$this->set('Brand',$Brand);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		$Brand= $this->Paginator->paginate('Brand');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('Brand', $Brand);
		$this->set('limit', $limit);
		$this->set('count', $count);
		
		

	}
			  	
			  	
	   /*  admin edit Brand   */
	public function admin_edit_brand($id = null){
		if($this->request->isPost()){
			$id = $this->data['id'];
			$name = $this->Brand->findById($id);
			//pr($name); die;
			$this->set('brand_name',$name['Brand']['brand_name']);
			$this->set('brand_image',$name['Brand']['brand_image']);
			$this->set('id',$id);
		}
	
	}
	
	/* this function used when user want edit our brand name  by admin_edit_brand.ctp*/
	public function admin_save_brandname(){
		$this->autoRender = false;
		if($this->request->isPost()){
			$type = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/pjpeg','images/x-png','image/PNG');
			//$this->Brand->set($this->data);
			$data = array();
			$data['id'] = $this->data['Brand']['id'];
			$data['brand_name'] = $this->data['Brand']['brand_name'];
			if(isset($this->request->data['Brand']['brand_image']['name']))
			 $data['brand_image'] = $this->request->data['Brand']['brand_image']['name'];
			
			$this->Brand->set($data);
			if($this->Brand->brandValidation()){
				if(isset($this->request->data['Brand']['brand_image']['type'])){
					if(in_array($this->request->data['Brand']['brand_image']['type'],$type)){
						$data['id'] = $this->data['Brand']['id'];
						$data['brand_name'] = $this->data['Brand']['brand_name'];
						$fileName = "images/".time()."_".$this->request->data['Brand']['brand_image']['name'];
						$data['brand_image'] = $fileName;
						$brandRes = $this->Brand->save($data);
						 move_uploaded_file($this->request->data['Brand']['brand_image']['tmp_name'], WWW_ROOT . $fileName);
						echo json_encode(array("status"=>"success","message"=>"Your Brand is successfully edited!","data"=>$brandRes));
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"Please upload image type!"));
						
					}
				}else{
					$brandRes = $this->Brand->save($data);
					echo json_encode(array("status"=>"success","message"=>"Your Brand is successfully edited!","data"=>$brandRes));
				}
			}else{
				echo json_encode(array("status"=>"error","message"=>$this->Brand->validationErrors));
			}
		}
	}
	
	/*    admin delete Brand name  */
	public function admin_delete_brand(){
		$this->autoRender = false;
		if($this->request->isPost()){
			
			$model = "Brand";
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
	
	
	public function admin_search() {
         $this->autoRender = false;

    // get the search term from URL
   $term = $this->request->query['q'];
  // $this->Car->unbindModel(array('hasMany' => array('CarImage')));
 
    $Brand = $this->Brand->find('all',array('conditions'=>array(					
						'Brand.brand_name LIKE' => '%'.$term.'%' ,
					), 'fields' =>array('Brand.id','Brand.brand_name'))
       );

    // Format the result for select1
		$result = array();
		foreach($Brand as $key => $mybrand) {
			$result[] = array("id"=>$mybrand['Brand']['id'],"text"=>$mybrand['Brand']['brand_name']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_brand_detail(){
		
		if($this->request->is('ajax')){
			$Brand = $this->Brand->find('all',array('conditions'=>array(
					'Brand.brand_name LIKE' => '%'.$this->data['name'].'%',
					)));
			$this->set('Brand',$Brand);
			$this->set('pages', $this->data['pageNo']);
		}
	}
	
	public function admin_show_all_user(){
		if($this->request->is('ajax')){
			$Brand = $this->Brand->find('all');
			$this->set('Brand',$Brand);
		}
	}
	
	public function admin_render_page_brand(){
		
		
		$limit = $this->limit;
		$Brand=$this->Brand->find('all');
		$count = count($Brand);
		$this->set('Brand',$Brand);
		//
		
			if(isset($this->data['pageNo'])){
			
			$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'), 'page'=>$this->data['pageNo']);
			$this->set('pages', $this->data['pageNo']);
			}	
			else{
				$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));	
			}
		//
		//$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));		
		
		$Brand= $this->Paginator->paginate('Brand');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('Brand', $Brand);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	
	
	public function admin_upload_excel(){
		if($this->request->isPost()){
			$type = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/pjpeg','images/x-png','image/PNG');
			$data = array();
			$fileName = "exltemp/".time()."_".$this->request->data['Brand']['BrandExcel']['name'];
			move_uploaded_file($this->request->data['Brand']['BrandExcel']['tmp_name'], WWW_ROOT . $fileName);
			
			
			$dataExl = new Spreadsheet_Excel_Reader($fileName, true);
			$temp = $dataExl->dumptoarray();
			
			for($i = 2; $i <= count($temp); $i++)
			{
				if($temp[$i][2] != "" && $temp[$i][3] != "")
				{
					$this->Brand->create();
					$datas = array();
					$datas['brand_name'] = $temp[$i][2];
					$datas['brand_image'] = $temp[$i][3];
					$this->Brand->set($datas);
					if($this->Brand->brandValidation()){
						$datas['brand_name'] = $temp[$i][2];
						$datas['brand_image'] = $temp[$i][3];
						$this->Brand->save($datas);
					}
				}
			}
			$this->redirect('/admin/brands/add_brand/');
		}
	}
	   
}
