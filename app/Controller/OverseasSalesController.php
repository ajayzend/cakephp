<?php
App::uses('AppController', 'Controller');

class OverseasSalesController extends AppController {
	public $uses = array('OverseasSales');
	public $components = array('UserAuth','ControllerList','Paginator');
	public $helpers = array('Paginator','Common');
	var $limit = 10;

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
				$this->OverseasSales->delete($ids, false);
			}
			$this->set('success', 1);
		}
		
		$limit = $this->limit;
		$portDetails=$this->OverseasSales->find('all');
		$count = count($portDetails);
		$this->paginate = array('limit'=>$limit, 'order'=>array('id'=>'DESC'));  
		$portDetails = $this->Paginator->paginate('OverseasSales');
		
		if(isset($this->params->params['named']['page'])){
			$this->set('pages', $this->params->params['named']['page']);
		}else{
			$this->set('pages', 1);
		}

		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('RecordsData', $portDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);
	}
	
	public function admin_add() {
		if ($this->request -> isPost())
		{
			$this->autoRender = false;
			$this->OverseasSales->set($this->data);
			$return = $this->OverseasSales->save($this->data);
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function admin_update($id=null) {
	
		if ($this->request->isPost())
		{
			$this->OverseasSales->set($this->data);
			$this->OverseasSales->save($this->data);
			return $this->redirect(array('action' => 'index'));
		}
		else{
			$Data = $this->OverseasSales->find('first',array('conditions'=>array('OverseasSales.id'=>$id)));
			$this->set('RecordData',$Data);
		}
	}
	
	public function admin_delete() {
		$this->autoRender = false;
		if ($this->request -> isPost()) {
		if ($this->OverseasSales->delete($this->data['id'], false)) {
		//echo json_encode(array('status'=>'success'));
		echo json_encode(array("status"=>"success","message"=>"Record Deleted!"));
		}
		} else {
		echo json_encode(array('status'=>'failure'));
		}		
	}
	
	public function admin_export()
	{
		$saleReports=$this->OverseasSales->find('all');
		$this->set('saleReports',$saleReports);
		$this->render('export_sale_xls','export_sale_xls');
	}
}
