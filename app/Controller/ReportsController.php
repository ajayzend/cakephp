<?php

class ReportsController extends AppController
{
    public $uses= array('Invoice','Bid','User','CarPayment','Logistic','Car','Bank','Brand','Country','Transport');
    public $components = array('UserAuth','ControllerList','Paginator','PhpExcel','Paginator');
	public $helpers = array('PhpExcel','Paginator','Common');  
	var $limit = 10;
	
    public function beforeFilter()
	{
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
		//$this->User->userAuth=$this->UserAuth;
	}

	public function admin_report_login()
	{
		if($this->Session->read('reportLogin') =='success')
		{
			$this->redirect(array('action' => 'view_sale_report'));
		}else
		{
			if($this->request->is('post'))
			{	
				$userId=$this->UserAuth->getUserId();
				$password=$this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
				if ($this->data['Reports']['report_password']==$password['User']['report_password'])
				{

					$this->Session->write('reportLogin', 'success');	
					return $this->redirect(array('action' => 'view_sale_report'));
				}
				else
				{
					$this->Session->setFlash('Password is wrong. Please enter correct Password!');
					$this->redirect(array('action' => 'report_login'));

				}
			}
		}
		
	}
	
	public function  admin_view_sale_report() 
	{
		   
		if($this->Session->read('reportLogin') !='success')
		{
			$this->redirect(array('action' => 'report_login'));
		}else
		{
		   $chassisArr =  array();
			$Cars = $this->Car->find('list',array('fields'=>array('Car.cnumber','Car.cnumber')));
			$this->set('Cars', $Cars);
			
			$Brands = $this->Brand->find('list',array('fields'=>array('Brand.id','Brand.brand_name')));
			$this->set('Brands', $Brands);
			
			$Country = $this->Country->find('list',array('fields'=>array('Country.id','Country.country_name')));
			$this->set('Country', $Country);
			/*$r = $this->Car->find("all", array('fields'=>array('Car.country_id','Country.country_name'),"joins" => array(array(
	                "table" => "countries",
	                "alias" => "countries",
	                "type" => "INNER",
	                "conditions" => array(
	                    "countries.id = Car.country_id"
	                )))));
			
			$Country = array();
			foreach($r as $val)
			{
				$Country[$val['Car']['country_id']] = $val['Country']['country_name'];
			}
			$this->set('Country', $Country);*/
			
			
			
			$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name)");	
			$Users = $this->User->find('list',array('fields'=>array('User.id','User.full_name'),'conditions'=>array('User.user_group_id' => 2)));
			$this->set('Users', $Users);
		}
	}
		
     public function admin_yearly_report_ajax()
     {
			set_time_limit(600);
			//date_default_timezone_set('Asia/Kolkata');
			/*$currdate = date("Y-m-d");
			$fromDate = '2013-01-01';
			$this->set('fromDate',$fromDate);
			$todate = date('d-m-Y',strtotime($currdate));
			$this->set('toDate',$todate);
			
			$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $currdate),'Car.new_arrival !=' =>1 );    ,'order'=>array('Car.pdate'=>'DESC')  STR_TO_DATE(Car.pdate, "%d-%m-%Y") */
		
			$limit = 20;
			$content ='';


			 $yearlyDetais1 = $this->CarPayment->find('count',array('conditions'=>array('Car.new_arrival !=' =>1)));
			 $yearlyDetais = $this->CarPayment->find('all',array('conditions'=>array('Car.new_arrival !=' =>1),'limit'=>$limit,'recursive'=>3,'order'=>array('Car.pdate'=>'DESC')));
			//echo "<pre>";
			//print_r($yearlyDetais);die;
			// $count = count($yearlyDetais1);
			 
			$this->set('yearlyDetais', $yearlyDetais);
			$count = $yearlyDetais1;
			$this->set('limit', $limit);
		    $this->set('count', $count);
		    
		    if($count > 0){
				$paginationCount=$this->getPagination($count);
			}
 

				if($count > 0){
				 
				$content .='<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">';
					for($i=1;$i<=$paginationCount;$i++){
				 
						$content .='<li id="'.$i.'_no" class="link">
						  <a  href="javascript:void(0)" onclick="changePagination(\''.$i.'\',\''.$i.'_no\')">
							  '.($i).'
						  </a>
					</li>';
					}
				 
					$content .='<li class="flash"></li>
				</ul>';
				}
			
			$this->set('content', $content);

     }

/*
	 public function admin_bid_report_ajax()
     {
     		$countArr = array();
			$bidDetail=$this->Bid->find('all',array('recursive'=>2,'order'=>array('Car.id','Bid.amount DESC')));
			foreach ($bidDetail as $key => $value) {
				$car_id = $value['Bid']['car_id'];
				$bidCount=$this->Bid->find('all',array('fields'=>array('count(Bid.car_id) as total_bid'),'conditions'=>array('Bid.car_id'=>$car_id)));
				
				$countArr[$car_id] = $bidCount[0][0]['total_bid'];	

				$bidresult[$car_id] =$this->Bid->find('all',array('fields'=>array(),'recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id),'group'=>'Bid.car_id','order'=>array('Car.id','Bid.amount DESC')));
			} 

			$this->set('countArr',$countArr);
			$this->set('bidresult',$bidresult);	
     }
*/

	public function admin_index(){ 
		
			$currdate = date("Y-m-d");// Car.pdate = ,  $currdate = date("Y-m-d");
			
			$set = array();
			
			$dailyReports = $this->CarPayment->query("SELECT Car.cnumber,Car.pdate, CarPayment.auction_name, Car.lot_number, Logistic.yard_name,Logistic.remark, Port.port_name, CarName.car_name FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Car.new_arrival !=1 AND  Car.pdate =  '".$currdate."' AND CarPayment.deleted = 0 AND Car.deleted = 0 " );
			//echo "<pre>";
			#print_r($dailyReports);

			
			
			$countArr = array();
			$bidresult = array();
			$bidDetail=$this->Bid->find('all',array('recursive'=>2,'order'=>array('Car.id','Bid.amount DESC')));
			foreach ($bidDetail as $key => $value) {
				$car_id = $value['Bid']['car_id'];
				$bidCount=$this->Bid->find('all',array('fields'=>array('count(Bid.car_id) as total_bid'),'conditions'=>array('Bid.car_id'=>$car_id)));
				
				$countArr[$car_id] = $bidCount[0][0]['total_bid'];	

				$bidresult[$car_id] =$this->Bid->find('all',array('fields'=>array(),'recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id),'group'=>'Bid.car_id','order'=>array('Car.id','Bid.amount DESC')));
			} 

			$this->set('countArr',$countArr);
			$this->set('bidresult',$bidresult);
		
			$this->set('dailyReports',$dailyReports);
			
			$set[] = array('currDate'=>$currdate);
			$set[] = array('onlyDate'=>'onlyDate');
			$this->set('data',$set);
		
			
			//==============================
			
			$Transports = $this->Transport->find('list',array('fields'=>array('Transport.id','Transport.transport_name')));
			$this->set('transports',$Transports);
			//==============================
			$fromDate = '2013-01-01';
			$this->set('fromDate',$fromDate);
			$todate = date('d-m-Y',strtotime($currdate));
			$this->set('toDate',$todate);
			
			/*$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $currdate),'Car.new_arrival !=' =>1 );
			//$yearlyDetais = $this->CarPayment->find('all', array('recursive'=>3,'conditions' => $Conditions));
			//$this->set('yearlyDetais',$yearlyDetais);
			
			
			$limit = 100;
			 $yearlyDetais = $this->CarPayment->find('all',array('recursive'=>3,'conditions' => $Conditions));
			
			//$this->paginate = array('limit'=>$limit,'recursive'=>3,'conditions' => $Conditions);
			//$yearlyDetais= $this->Paginator->paginate('CarPayment');
			//$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
			//pr($yearlyDetais);die;
			$this->set('yearlyDetais', $yearlyDetais);
			$count = count($yearlyDetais);
			$this->set('limit', $limit);
		    $this->set('count', $count);
			
			//===============================
			$chassisArr =  array();
			
			$Cars = $this->Car->find('list',array('fields'=>array('Car.cnumber','Car.cnumber')));
			$this->set('Cars', $Cars);
			
			$Brands = $this->Brand->find('list',array('fields'=>array('Brand.id','Brand.brand_name')));
			$this->set('Brands', $Brands);
			
			$r = $this->Car->find("all", array('fields'=>array('Car.country_id','Country.country_name'),"joins" => array(array(
	                "table" => "countries",
	                "alias" => "countries",
	                "type" => "INNER",
	                "conditions" => array(
	                    "countries.id = Car.country_id"
	                )))));
			
			$Country = array();
			foreach($r as $val)
			{
				$Country[$val['Car']['country_id']] = $val['Country']['country_name'];
			}
			$this->set('Country', $Country);*/
			
			
			
			$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name)");	
			$Users = $this->User->find('list',array('fields'=>array('User.id','User.full_name'),'conditions'=>array('User.user_group_id' => 2)));
			$this->set('Users', $Users);
	
	}
	
	public function admin_yearly_report()
	{
		
		set_time_limit(600);
			$limit = 100;
			$content ='';
			
			
			//$fromDate = $this->data['from'];
			$fromDate = date("Y-m-d", strtotime($this->data['from']));
			//echo $fromDate = date("d-m-Y", strtotime($fromDate));
			$this->set('fromDate',$fromDate);
			
			//$toDate = $this->data['todate'];
			$toDate = date("Y-m-d", strtotime($this->data['todate']));
			//echo $toDate = date("d-m-Y", strtotime($toDate));
			$this->set('toDate',$toDate);
			
			$Conditions = array();
			if($this->data['from'] != "" && $this->data['todate'] != "")
			{
				$Conditions[] = array('Car.pdate BETWEEN ? AND ?' => array($fromDate, $toDate),'Car.new_arrival !=' =>1); 
			}
			
			if($this->data['client'] != "")
			{
				$firstname = array('User.first_name like' => "%".$this->data['client']."%"); 
				$lastname = array('User.last_name like' => "%".$this->data['client']."%"); 
			}

			 $yearlyDetais1 = $this->CarPayment->find('count',array('conditions' =>array($Conditions, 'OR' => array(array($firstname), array($lastname)))));
			 
			 $yearlyDetais = $this->CarPayment->find('all',array('limit'=>$limit,'conditions' => array($Conditions, 'OR' => array(array($firstname), array($lastname))),'recursive'=>3,'order'=>array('Car.pdate'=>'DESC')));
			//$log = $this->CarPayment->getDataSource()->getLog(false, false);
			//debug($log);
			
			//pr($yearlyDetais);
//die;
			// $count = count($yearlyDetais);
			 $count = $yearlyDetais1;
			 
			$this->set('yearlyDetais', $yearlyDetais);
			$this->set('limit', $limit);
		    $this->set('count', $count);
		    
		    if($count > 0){
				$paginationCount=$this->getPagination($count);
			}
 

				if($count > 0){
				 
				/*$content .='<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">';
					for($i=1;$i<$paginationCount;$i++){
				 
						$content .='<li id="'.$i.'_no" class="link">
						  <a  href="javascript:void(0)" onclick="changePagination(\''.$i.'\',\''.$i.'_no\')">
							  '.($i).'
						  </a>
					</li>';
					} */
					
					$content .='<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">';
					for($i=1;$i<=$paginationCount;$i++){
				
						$content .='<li id="'.$i.'_no" class="link">
						  <a  href="javascript:void(0)" onclick="changePagination1(\''.$i.'\',\''.$i.'_no\',\''.$fromDate.'\',\''.$toDate.'\')">
							  '.($i).'
						  </a>
					</li>';
					}
					
					
				 
					$content .='<li class="flash"></li></ul>';
				}


			$this->set('content', $content);
			$this->layout = false;
			$this->render('admin_yearly_report_ajax');
		
		/* hide old code
		 * 
		 * $fromDate = $this->data['from'];
		$fromDate = date("Y-m-d", strtotime($fromDate));
		$this->set('fromDate',$fromDate);
		
		$toDate = $this->data['todate'];
		$toDate = date("Y-m-d", strtotime($toDate));
		$this->set('toDate',$toDate);
		
		$Conditions = array('Car.pdate BETWEEN ? and ?' => array($fromDate, $toDate),'Car.new_arrival !=' =>1); 
		$yearlyDetais = $this->CarPayment->find('all', array('recursive'=>3,'limit'=>5,'conditions' => $Conditions,'order'=>array('Car.pdate'=>'DESC')));
		$this->set('yearlyDetais',$yearlyDetais);*/
		
		/*$this->paginate = array('limit'=>500,'recursive'=>3,'conditions' => $Conditions,'order'=>array('Car.created'=>'DESC'));
		$yearlyDetais= $this->Paginator->paginate('CarPayment');
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('yearlyDetais', $yearlyDetais);
		$count = count($yearlyDetais);
		$this->set('limit', $limit);
		$this->set('count', $count);*/
		
	}
	
	public function admin_export_daily_xls(){
		
			foreach($this->request->query('ids') as $val)
			{
				
				if(isset($val['onlyDate']))
				{
						//date_default_timezone_set('Asia/Kolkata');
						$currdate = date("Y-m-d");
						$dailyReports = $this->CarPayment->query("SELECT Car.cnumber, CarPayment.auction_name,Car.pdate, Car.lot_number, Logistic.yard_name, Port.port_name,Logistic.remark, CarName.car_name FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Car.pdate =  '".$currdate."' AND    Car.new_arrival !=1 AND CarPayment.deleted= 0 ");
				}else
				{
				
					if(isset($val['tId']))
					{	
						$date = $val['currDate'];
						$transportId = $val['tId'];
						$dailyReports = $this->CarPayment->query("SELECT Car.cnumber, CarPayment.auction_name, Car.lot_number, Logistic.yard_name,Logistic.remark, Port.port_name,Car.pdate, CarName.car_name,Transport.transport_name FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN transports AS Transport ON Transport.id = Logistic.transport_id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Logistic.transport_id ='".$transportId."' AND Car.pdate =  '".$date."' AND  Car.new_arrival !=1 AND CarPayment.deleted= 0 ");
						$this->set('transportName',$dailyReports[0]['Transport']['transport_name']);
					}
					else
					{
						$date = $val['currDate'];
						$dailyReports = $this->CarPayment->query("SELECT Car.cnumber,Car.pdate, CarPayment.auction_name, Car.lot_number, Logistic.yard_name,Logistic.remark, Port.port_name, CarName.car_name FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Car.pdate =  '".$date."' AND  Car.new_arrival !=1 AND CarPayment.deleted= 0 ");
					}
				}
			}
		
		//$currdate = date("Y-m-d");
		//$currdate = '2014-01-28';
		
		//$dailyReports = $this->CarPayment->find('all',array('recursive'=>3,'conditions'=>array('updated_on'=>$date,'CarPayment.user_id !='=>0) ,'order' => array('CarPayment.id' => 'ASC')));
		//pr($dailyReports);die;
		$this->set('daily_date',$date);
		$this->set('dailyReports',$dailyReports);
		$this->render('export_daily_xls','export_daily_xls');
	}
	
	public function admin_export_yearly_xls($fromDate,$toDate){
		
		$toDate = date("Y-m-d", strtotime($toDate));
		$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $toDate),'Car.new_arrival !=' =>1);
		$yearlyDetais = $this->CarPayment->find('all', array('recursive'=>3,'conditions' => $Conditions,'limit'=>500,'order'=>array('Car.created'=>'DESC')));
		$this->set('yearlyDetais',$yearlyDetais);
		$this->render('export_yearly_xls','export_yearly_xls');
	}
	//$brandId,$countryId,$cnumber,
	public function admin_export_sale_xls(){
			$con = array();
			foreach($this->request->query('ids') as $val)
			{
				if(isset($val['cId']))
				{
					$con[] = array('Car.country_id'=>$val['cId']);
				}
				if(isset($val['bId']))
				{
					$con[] = array('Car.brand_id'=>$val['bId']);
				}
				if(isset($val['cnum']))
				{
					$con[] = array('Car.cnumber'=>$val['cnum']);
				}
				if(isset($val['uId']))
				{
					$con[] = array('CarPayment.user_id'=>$val['uId']);
				}
				if(isset($val['from']) && isset($val['toDate']))
				{
					$fromDate = date("Y-m-d", strtotime($val['from']));
					$toDate = date("Y-m-d", strtotime($val['toDate']));
					$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $toDate));
					$con[] = $Conditions;
				}
				if(isset($val['null']))
				{
					$con[] = '';
				}
			}
				
		//$saleReports = $this->Car->find('all',array('recursive'=>2,'conditions'=>array('AND'=>$con,'CarPayment.user_id !=' => '0','Car.new_arrival !=' =>1),'order' => array('CarPayment.user_id' => 'ASC')));
		
		$saleReports = $this->Car->find('all',array('recursive'=>2,'conditions'=>array('AND'=>$con,'CarPayment.user_id !=' => '0','CarPayment.currency !=' => '','Car.new_arrival !=' =>1),'order' => array('Car.pdate' => 'DESC')));
		$this->set('saleReports',$saleReports);
		$this->render('export_sale_xls','export_sale_xls');
	}
	public function admin_sales_report_search()
	{
		
		$fromDate = date("Y-m-d", strtotime($this->data['fromDate']));
		$toDate = date("Y-m-d", strtotime($this->data['toDate']));
		$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $toDate),'CarPayment.user_id !=' => '0','Car.new_arrival !=' =>1);
		$saleReports = $this->Car->find('all',array('recursive'=>2,'conditions'=>$Conditions,'order' => array('CarPayment.user_id' => 'ASC')));
		$this->set('saleReports',$saleReports);
		$TotalCost ='';
		$TotalSale ='';
		foreach($saleReports as $report)
		{	
			$TotalCost += $report['CarPayment']['asking_price']; 
			$TotalSale += $report['CarPayment']['sale_price'];		
		}
		$TotalCar = count($saleReports); 
		$profitLoss = $TotalSale - $TotalCost;
		//echo $TotalCar." === ".$TotalCost." === ".$TotalSale.' === '.$profitLoss;
		$this->set('TotalCar',$TotalCar);
		$this->set('TotalCost',$TotalCost);
		$this->set('TotalSale',$TotalSale);
		$this->set('profitLoss',$profitLoss);
		$this ->render('admin_sales_report');
		$this->layout = null;
		
	}
	
	public function admin_sales_report(){
		
		$con = array();
		$set = array();
		if($this->data['country'])
		{
			$con[] = array('Car.country_id'=>$this->data['country']);
			$set[] =array('cId'=>$this->data['country']);
			
		}
		if($this->data['brand'])
		{
			$con[] = array('Car.brand_id'=>$this->data['brand']);
			$set[] =array('bId'=>$this->data['brand']);
		}
		if($this->data['cnumber'])
		{
			$con[] = array('Car.cnumber'=>$this->data['cnumber']);;
			$set[] = array('cnum'=>$this->data['cnumber']);
		}
		if($this->data['user'])
		{
			$con[] = array('CarPayment.user_id'=>$this->data['user']);
			$set[] = array('uId'=>$this->data['user']);
		}
		if($this->data['from'] && $this->data['toDate'])
		{
			$fromDate = date("Y-m-d", strtotime($this->data['from']));
			$toDate = date("Y-m-d", strtotime($this->data['toDate']));
			$Conditions = array('CarPayment.updated_on BETWEEN ? and ?' => array($fromDate, $toDate));
			$con[] = $Conditions;
			$set[] = array('from'=>$this->data['from'],'toDate'=>$this->data['toDate']);
		}
		//echo $set;
		$this->set('data',$set);
		$saleReports = $this->Car->find('all',array('recursive'=>2,'conditions'=>array('AND'=>$con,'CarPayment.user_id !=' => '0','CarPayment.currency !=' => '','Car.new_arrival !=' =>1),'order' => array('Car.pdate' => 'DESC')));
		$this->set('saleReports',$saleReports);
		$TotalCost =0;
		$TotalSale =0;
		$TotalYenCost = 0; 
		$TotalYenSale=0;
		foreach($saleReports as $report)
		{	
			if($report['CarPayment']['currency'] =='$')
			{
				$TotalCost += $report['CarPayment']['asking_price']; 
				$TotalSale += $report['CarPayment']['sale_price'];	
			}else if($report['CarPayment']['currency'] =='￥')
			{
				$TotalYenCost += $report['CarPayment']['yen']; 
				$TotalYenSale += $report['CarPayment']['sale_price'];	
			}
				
		}
		$TotalCar = count($saleReports); 
		
		//echo $TotalCar." === ".$TotalCost." === ".$TotalSale.' === '.$profitLoss;
			
				if($TotalSale > $TotalCost)
				{
					$profit = $TotalSale - $TotalCost;
					$loss = 0;
					
				}else
				{
					$loss = $TotalSale - $TotalCost;
					$profit = 0;
				}
				
				if($TotalYenSale > $TotalYenCost)
				{
					$yenProfit = $TotalYenSale - $TotalYenCost;
					$yenLoss = 0;
					
				}else
				{
					$yenLoss = $TotalYenCost - $TotalYenSale;
					$yenProfit = 0;
				}
			
		$this->set('TotalCar',$TotalCar);
		$this->set('TotalCost',$TotalCost);
		$this->set('TotalYenSale',$TotalYenSale);
		$this->set('TotalYenCost',$TotalYenCost);
		$this->set('TotalSale',$TotalSale);
		$this->set('profit',$profit);
		$this->set('loss',$loss);
		$this->set('yen_profit',$yenProfit);
		$this->set('yen_loss',$yenLoss);
 
	}
	
	public function admin_sale_head()
	{
		$chassisArr =  array();
		
		$Cars = $this->Car->find('list',array('fields'=>array('Car.cnumber','Car.cnumber')));
		$this->set('Cars', $Cars);
		
		$Brands = $this->Brand->find('list',array('fields'=>array('Brand.id','Brand.brand_name')));
		$this->set('Brands', $Brands);
		
		$r = $this->Car->find("all", array('fields'=>array('Car.country_id','Country.country_name'),"joins" => array(array(
                "table" => "countries",
                "alias" => "countries",
                "type" => "INNER",
                "conditions" => array(
                    "countries.id = Car.country_id"
                )))));
		
		$Country = array();
		foreach($r as $val)
		{
			$Country[$val['Car']['country_id']] = $val['Country']['country_name'];
		}
		$this->set('Country', $Country);
		
		
		
		$this->User->virtualFields = array('full_name' => "CONCAT(User.first_name,' ', User.last_name)");	
		$Users = $this->User->find('list',array('fields'=>array('User.id','User.full_name'),'conditions'=>array('User.user_group_id' => 2)));
		$this->set('Users', $Users);
	}
	
	public function admin_search_report()
	{
	
		$currDate = date('Y-m-d',strtotime($this->data['date']));
		
		$con = array();
		$set = array();
		if($this->data['id'])
		{
			 
			$dailyReports = $this->CarPayment->query("SELECT Car.cnumber,Car.pdate, CarPayment.auction_name, Car.lot_number, Logistic.yard_name, Port.port_name, CarName.car_name,Transport.transport_name,Logistic.remark FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN transports AS Transport ON Transport.id = Logistic.transport_id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Logistic.transport_id ='".$this->data['id']."' AND Car.new_arrival !=1 AND Car.deleted = 0 AND CarPayment.deleted = 0 AND Car.pdate ='".$currDate."' ");
			$set[] = array('tId'=>$this->data['id'],'currDate'=>$currDate);
			
		}else
		{
			$dailyReports = $this->CarPayment->query("SELECT Car.cnumber,Car.pdate, CarPayment.auction_name, Car.lot_number, Logistic.yard_name, Port.port_name, CarName.car_name,Logistic.remark FROM cars AS Car LEFT JOIN car_names AS CarName ON Car.car_name_id = CarName.id LEFT JOIN logistics AS Logistic ON Logistic.car_id = Car.id LEFT JOIN ports AS Port ON Logistic.port_id = Port.id LEFT JOIN car_payments AS CarPayment ON CarPayment.car_id = Car.id WHERE Car.pdate =  '".$currDate."' AND Car.deleted = 0 AND CarPayment.deleted = 0 AND  Car.new_arrival !=1 ");
			$set[] = array('currDate'=>$currDate,'only'=>'only');
			
		}
	
//echo "<pre>";
//print_r($dailyReports);
		$this->set('dailyReports',$dailyReports);
		$this->set('data',$set);
		//$this->set('currdate',$currDate);
	}

	public function admin_clear_search()
	{
		$this->autoRender = false;
	}
	
	public function admin_test()
	{
		$dailyReports = $this->CarPayment->find('all',array('recursive'=>3,'conditions'=>array('CarPayment.user_id !='=>0)));
		pr($dailyReports);
		$this->autoRender = false;
	}
			
	/*    admin delete Report  */
			public function admin_delete($id) {
			if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}

			if ($this->Bid->delete($id)) {
				$this->Session->setFlash(
					__(' Report delete successfully !')
				);
				return $this->redirect(array('action' => 'index'));
			}
		}
		
	public function admin_AllBidDelete()
	{
		//pr($this->data);die;
		$this->autoRender = false;
		if($this->request->is('post'))
		{
		   $deleteRecords = $this->Bid->delete($this->data['cId']);
			if ($deleteRecords)
			{
				return json_encode(array("status"=>"success"));
			}
			else
			{
				return json_encode(array("status"=>"error"));
			}			
		}
	}

		
		public function admin_chassis_yearly_report_search()
		{
			 $this->autoRender = false;
   
			$term = $this->request->query['q'];
			$this->Car->unbindModel(array('hasMany' => array('CarImage')));
	   
			/*$cars = $this->Car->find('all',array('conditions'=>array(					
						'Car.cnumber LIKE' => '%'.$term.'%' ,'CarPayment.user_id !=' =>0,'Car.new_arrival !=' =>1
					), 'fields' =>array('Car.id','Car.cnumber'))
       );*/
			$cars = $this->Car->find('all',array('conditions'=>array(					
						'Car.cnumber LIKE' => '%'.$term.'%','Car.new_arrival !=' =>1 
					), 'fields' =>array('Car.id','Car.cnumber'))
       );
       
    
			$result = array();
			foreach($cars as $key => $mycar) {
				$result[] = array("id"=>$mycar['Car']['id'],"text"=>$mycar['Car']['cnumber']);	
			}

			echo json_encode($result); 
		}
		
		public function admin_chassis_search_report()
		{
			$this->Car->unbindModel(array('hasMany' => array('CarImage')));
			if($this->request->is('ajax'))
			{

				/*$yearlyDetais= $this->CarPayment->find('all',array('recursive'=>3,'conditions'=>array(
					'Car.cnumber LIKE' => '%'.$this->data['name'].'%','CarPayment.user_id !=' =>0
					)));*/
				$yearlyDetais= $this->CarPayment->find('all',array('recursive'=>3,'conditions'=>array(
					'Car.cnumber LIKE' => '%'.$this->data['name'].'%'
					)));
						
				$this->set('yearlyDetais',$yearlyDetais);

		}
		}
		
		public function admin_car_bid_report($car_id)
		{
			//$bidresult =$this->Bid->find('all',array('fields'=>array(),'recursive'=>2,'conditions'=>array('Bid.user_id'=>$user_id),'order'=>array('Car.id','Bid.amount DESC')));
					
			//$bidresult =$this->Bid->find('all',array('recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id),'order'=>array('Car.id','Bid.amount DESC'),'limit'=>2));
			//$this->set('bidresult',$bidresult);  hide old code
			
			$bidresultInDollar =$this->Bid->find('all',array('recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id,'Bid.currency_type'=>'$'),'order'=>array('Car.id','Bid.amount DESC'),'limit'=>2));
			$this->set('bidresult',$bidresultInDollar);
			
			$bidresultInYen =$this->Bid->find('all',array('recursive'=>2,'conditions'=>array('Bid.car_id'=>$car_id,'Bid.currency_type'=>'￥'),'order'=>array('Car.id','Bid.amount DESC'),'limit'=>2));
			$this->set('bidresultInYen',$bidresultInYen);
			
			
			
		}
					
		function getPagination($count)
		{
		  $per_page = 100;
		  $paginationCount= floor($count / $per_page);
		  $paginationModCount= $count % $per_page;
		  if(!empty($paginationModCount))
		  {
			 $paginationCount++;
		  }
		  return $paginationCount;
		}	
		
		public function admin_yearly_report_ajax_find()
		{
			set_time_limit(600);
			
			 if($this->data['pageId']>1)
			 {	
				$limit = 101 ;				
				$sr_no = $limit * ($this->data['pageId']-1);
			 }
			 else
			 {		
				  $limit = 100; 		 
				 $sr_no = $limit;
			 }	
			 $yearlyDetais = $this->CarPayment->find('all',array('conditions'=>array('Car.new_arrival !=' =>1),'page'=>$this->data['pageId'],'limit'=>$limit,'recursive'=>3,'order'=>array('Car.pdate'=>'DESC')));		
			 $this->set('yearlyDetais', $yearlyDetais); 
			 $this->set('sr_no', $sr_no);
			
			 //$this ->render('admin_yearly_report_find');
			 //$this->layout = null;

        }
        
        public function admin_yearly_report_ajax_find_cal()
		{
			set_time_limit(600);
			
			 if($this->data['pageId']>1)
			 {	
				$limit = 101 ;				
				$sr_no = $limit * ($this->data['pageId']-1);
			 }
			 else
			 {		
				 $limit = 100; 		 
				 $sr_no = 1;
			 }	
			 //echo $sr_no;die;		 
			 $content = '';
			$fromDate = $this->data['frm_date'];
							//echo $fromDate = date("d-m-Y", strtotime($fromDate));
			$this->set('fromDate',$fromDate);
			
							//$toDate = $this->data['todate'];
			$toDate = $this->data['to_date'];
										//echo $toDate = date("d-m-Y", strtotime($toDate));
			$this->set('toDate',$toDate);
		
			$Conditions = array('Car.pdate BETWEEN ? AND ?' => array($fromDate, $toDate),'Car.new_arrival !=' =>1); 
			

			 //$yearlyDetais1 = $this->CarPayment->find('all');
			 $yearlyDetais = $this->CarPayment->find('all',array('page'=>$this->data['pageId'],'limit'=>$limit,'conditions' => $Conditions,'recursive'=>3,'order'=>array('Car.pdate'=>'DESC')));
			 
			 
			 
			 	
			 //$yearlyDetais = $this->CarPayment->find('all',array('conditions'=>array('Car.new_arrival !=' =>1),'page'=>$this->data['pageId'],'limit'=>$limit,'recursive'=>3,'order'=>array('Car.pdate'=>'DESC')));		
			 $this->set('yearlyDetais', $yearlyDetais); 
			 $this->set('sr_no', $sr_no);
			
			$this->layout = false;
			$this->render('admin_yearly_report_ajax_find');

        }	
}
