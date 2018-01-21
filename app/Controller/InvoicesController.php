<?php
App::import('Vendor', 'PHPExcel/Classes/PHPExcel'); 
App::uses('CakeEmail', 'Network/Email');    
#require_once '/var/www/html/website/app/webroot/Mandrill.php'; 
#require_once('/var/www/html/website/app/webroot/phpmailer/class.phpmailer.php');
//Not required with Composer
class InvoicesController extends AppController
{
    public $uses= array('Invoice','User','CarPayment','Logistic','Car','Bank','InvoiceDetail','Page');
    public $components = array('UserAuth','ControllerList','Paginator','PhpExcel','Email','Paginator');
	public $helpers = array('PhpExcel','Paginator','Common');  
	var $limit = 10;
	
    

	
    public function beforeFilter()
	{
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		$this->layout='default_admin';
		//$this->User->userAuth=$this->UserAuth;
	}
	
               
	public function index(){

	}


	public function admin_list()
	{	
		$limit = $this->limit;
		$invoiceDetails = $this->Invoice->find('all',array('limit'=>20)); 
		$count = count($invoiceDetails);
		$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('Invoice.id'=> 'DESC'));		
		$invoiceDetails= $this->Paginator->paginate('Invoice');
		//echo $count = count($invoiceDetails);
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		//pr($invoiceDetails);die;
		$this->set('invoiceDetails', $invoiceDetails);
		//pr($invoiceDetails);die;
		//echo $count = count($invoiceDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);

	}
	
	public function admin_invoice($id)
	{
		$this->layout='';
		
		$invoNo = "INVOICE/".$id;
		$invoDetails = $this->Invoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		
		$this->loadModel('InvoiceAddress');
		$ofc_address =  $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$invoDetails[0]['Invoice']['invoice_address_id'])));
		$this->set('address', $ofc_address);
		$this->set('InvoiceDetail', $invoDetails);
	}
			
	public function admin_add()
	{

		if ($this->request -> isPost())
		{ 
			//$rand =rand(1000, 9999);
			$price = 0;
			$invoiceNo =  $this->getUniqueInvoiceNo();
			$total = $this->CarPayment->find('first',array('fields' => array('sum(CarPayment.sale_price)   AS ptotal'), 'conditions'=>array('CarPayment.user_id'=>$this->data['uId'],'CarPayment.car_id' =>$this->data['cId'])));
			
			$this->request->data['Invoice']['invoice_no'] = "INVOICE/".$invoiceNo;//"INVO/NO/".$invoiceNo;
			$this->request->data['Invoice']['amount'] = $total[0]['ptotal'];
			$this->request->data['Invoice']['bank_id'] = $this->data['bId'];
			$this->request->data['Invoice']['invoice_address_id'] = $this->data['aId'];
			$this->Invoice->set($this->data); 	
			$result =$this->Invoice->save();
			if($result) 
			{	
				
				 foreach($this->data['cId'] as $val)
				 {
					$this->request->data['InvoiceDetail']['invoice_id'] = $result['Invoice']['id'];	
					$this->request->data['InvoiceDetail']['user_id']  = $this->data['uId']; 
					$this->request->data['InvoiceDetail']['car_id'] = $val;
					$this->InvoiceDetail->save($this->data);
					$this->InvoiceDetail->create();
					
				 }

					$invoiceDetails = $this->Invoice->find('all',array('recursive'=>3,'fields'=>array('invoice_no','id','created','amount'),'conditions'=>array('invoice_no'=>"INVOICE/".$invoiceNo)));
					$this->set('invoiceDetails',$invoiceDetails);			
					$this ->render('admin_search');
					$this->layout = null;
				 
			}
			else
			{
					echo "not save";
			}
			 
		}else
		{
			if(isset($this->request->params['named'])) 
			{
				
				$userId = isset($this->request->params['named']['user_id']) ? $this->request->params['named']['user_id'] : '';
				$date = isset($this->request->params['named']['date']) ? $this->request->params['named']['date'] : '';
				$carId = isset($this->request->params['named']['car_id']) ? $this->request->params['named']['car_id'] : '';
				$this->set('userId',$userId);
				$this->set('date',$date);
				$this->set('carId',$carId);
				$Cars  = $this->CarPayment->query(' SELECT Bank.id AS bank_id, CarPayment.car_id, Car.cnumber, CarName.car_name
													FROM car_payments AS CarPayment
													LEFT JOIN cars AS Car ON ( Car.id = CarPayment.car_id ) 
													LEFT JOIN users AS User ON ( User.id = CarPayment.user_id ) 
													LEFT JOIN banks AS Bank ON ( Bank.id = User.bank_id ) 
													LEFT JOIN car_names AS CarName ON ( Car.car_name_id = CarName.id ) 
													WHERE CarPayment.car_id NOT 
													IN (

													SELECT InvoiceDetail.car_id
													FROM invoice_details AS InvoiceDetail
													)
													AND CarPayment.car_id ="'.$carId.'"
													AND CarPayment.deleted =0');

				if(!empty($Cars))
				{
					$carList = array(); 			
					$carList[$Cars[0]['CarPayment']['car_id']] = $Cars[0]['CarName']['car_name'].'['.$Cars[0]['Car']['cnumber'].']';
					$this->set('carList',$carList); 		
					$this->set('bankId',$Cars[0]['Bank']['bank_id']); 
				}else
				{
					
					//$this->Session->setFlash(__('This car invoice already generated  by system'));
					$this->set('carList'," ");
					//$this->set('msg',"This car invoice already generated  by system ");
				}		
			}
				$userList = array(); 
				//$userDetail = $this->CarPayment->find('all', array('fields'=>array('DISTINCT CarPayment.user_id','User.first_name','User.last_name'),'conditions'=>array('CarPayment.user_id !='=>0)));
				$userDetail = $this->CarPayment->query("SELECT  DISTINCT  User.first_name,User.last_name,User.id FROM `car_payments` as CarPayment Left join `users` as User on User.id = CarPayment.user_id where User.first_name !='' and User.last_name !='' and  CarPayment.car_id NOT IN (select InvoiceDetail.car_id from invoice_details as InvoiceDetail) and CarPayment.deleted=0 and User.deleted=0");
				
				//$userDetail = $this->CarPayment->query("SELECT  DISTINCT  User.first_name,User.last_name,User.id FROM `car_payments` as CarPayment right join `users` as User on User.id = CarPayment.user_id where CarPayment.user_id!=0 and  CarPayment.deleted=0 and User.deleted=0");
				
				
					foreach($userDetail as $userVal)
					{	
						$userList[$userVal['User']['id']] = $userVal['User']['first_name']." ".$userVal['User']['last_name']; 		
					}					
					$this->set('userList',$userList);
		 
					/*$Cars  = $this->CarPayment->query(" select CarPayment.car_id,Car.cnumber,CarName.car_name  from car_payments as CarPayment left join cars as Car on (Car.id = CarPayment.car_id) left join car_names as CarName on (Car.car_name_id = CarName.id) where CarPayment.car_id NOT IN (select InvoiceDetail.car_id from invoice_details as InvoiceDetail)");

					$carList = array(); 
					foreach($Cars as $c)
					{		
						$carList[$c['CarPayment']['car_id']] = $c['CarName']['car_name'].'['.$c['Car']['cnumber'].']'; 		
					}	
					
					$this->set('carDetails',$carList);*/
					
					$bankDetails = $this->Bank->find('list', array('fields'=>array('Bank.id','Bank.bank_name'),'order' => array('Bank.id' => 'ASC')));
					
					$this->set('bankDetails',$bankDetails);
					$this->loadModel('InvoiceAddress');
					
					$invoice_address = $this->InvoiceAddress->find('list', array('fields'=>array('InvoiceAddress.id','InvoiceAddress.discription'),'order' => array('InvoiceAddress.id' => 'DESC')));
					$this->set('address_list',$invoice_address);
			
			
		}
		
	}

	public function admin_generate($id=null) 
	{
		
		$invoNo = "INVOICE/".$id;
		$invoDetails = $this->Invoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		
		//$ofc_address = $this->Page->find('first',array('conditions'=>array('Page.title'=>'ofc_address')));
		//$str = explode('@',strip_tags($ofc_address['Page']['content']));
		
		$this->loadModel('InvoiceAddress');
		$ofc_address  =  $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$invoDetails[0]['Invoice']['invoice_address_id'])));		
	
		if($invoDetails[0]['InvoiceDetail'][0]['User']['user_invoice_name'] != '')
		{
			$fileName =  $invoDetails[0]['InvoiceDetail'][0]['User']['user_invoice_name'].'.xls';
		}
		else
		{
			$fileName = 'Report.xls';
		}

		$objPHPExcel = new PHPExcel();
		$totalCount = count($invoDetails[0]['InvoiceDetail']);
		$c =1;
		$cell = 4;
		$cell1 = 17;
		$cell2 =$totalCount+$cell1+3;
		$logoCell = $cell2+2;
		$signatureCell = $logoCell+4;
		$price = 0;	
					$objPHPExcel->getProperties()->setCreator("Invoice")
											 ->setLastModifiedBy("Invoice")
											 ->setTitle("Office 2007 XLSX Test Document")
											 ->setSubject("Office 2007 XLSX Test Document")
											 ->setDescription("Generazione report inverter")
											 ->setKeywords("office 2007 openxml php")
											 ->setCategory("");
			
					//$objRichText = new PHPExcel_RichText();
					//$objRichText->createText('');
					//$objPayable = $objRichText->createTextRun('Invoice Details ');;
					//$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
					//$objPHPExcel->getActiveSheet()->getCell('C1')->setValue($objRichText);
					

					$sheet = $objPHPExcel->getActiveSheet();
					$sheet->setCellValue('A1','INVOICE DETAILS');
					$sheet->mergeCells('A1:D1');
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
					
					
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', trim(@$ofc_address['InvoiceAddress']['line_1']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', trim(@$ofc_address['InvoiceAddress']['line_2']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', trim(@$ofc_address['InvoiceAddress']['line_3']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', trim(@$ofc_address['InvoiceAddress']['line_4']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', trim(@$ofc_address['InvoiceAddress']['line_5']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', trim(@$ofc_address['InvoiceAddress']['line_6']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', trim(@$ofc_address['InvoiceAddress']['line_7']));
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'CLIENT NAME' .' - '.strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['first_name'])." ".strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['last_name']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'CUSTOMER CODE'.' - '. $invoDetails[0]['InvoiceDetail'][0]['User']['uniqueid']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D13', $invoDetails[0]['Invoice']['invoice_no']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', date('d-m-Y',strtotime($invoDetails[0]['Invoice']['created'])));

					$styleArray = array(
					  'font' => array(
					    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
					  ));
					

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'S.NO.');
					$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', 'CAR NAME');
					$objPHPExcel->getActiveSheet()->getStyle('B16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C16', 'CHASSIS NO');
					$objPHPExcel->getActiveSheet()->getStyle('C16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D16', 'PRICE');
					$objPHPExcel->getActiveSheet()->getStyle('D16')->applyFromArray($styleArray);
					unset($styleArray);
					$objPHPExcel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					foreach($invoDetails[0]['InvoiceDetail'] as $InvoVal)
					{

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell1, $c);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$cell1, $c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell1, strtoupper($InvoVal['Car']['CarName']['car_name']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell1, strtoupper($InvoVal['Car']['cnumber']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price']);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price'])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell2, "");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell2, "TOTAL(".$totalCount.")");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell2, "PRICE");
					
						$price += $InvoVal['Car']['CarPayment']['sale_price'];
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$c++;
						$cell++;
						$cell1++;
					}
		
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$logoCell, 'BANK NAME'.' - '.strtoupper($invoDetails[0]['Bank']['bank_name']));
					$branchNameCell = $logoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$branchNameCell, 'BRANCH NAME'.' - '.strtoupper($invoDetails[0]['Bank']['branch_name']));
					$swiftCodeCell = $branchNameCell+1;
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D25', 'Branch No.'.'-'."");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$swiftCodeCell, 'SWIFT NAME'.' - '.strtoupper($invoDetails[0]['Bank']['swift_name']));
					$acNoCell = $swiftCodeCell+1;	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNoCell, 'A/C NO'.' - '.$invoDetails[0]['Bank']['account_no']);
					$acNameCell = $acNoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNameCell, 'A/C NAME'.' - '.strtoupper($invoDetails[0]['Bank']['account_name']));
					$bank_desc =$invoDetails[0]['Bank']['discription'];
					//$spaceCount = substr_count($str, ' ');
					
					$words = explode(" ", $bank_desc);
					$firstpart = join(" ", array_slice($words, 0,3));
					$restpart = join(" ", array_slice($words, 3));
					
					 $description = $acNameCell+1;
					
					$description2 = $description+2;
				
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setWrapText(true);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$description.':D'.$description2);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$description,'DESCRIPTION'.' - '.@$firstpart.' '.$restpart);
					
				
		
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				
				$objDrawing->setName('Stamp logo');
				$objDrawing->setDescription('Stamp logo');
				$objDrawing->setPath("./images/stamp.jpg");      
				
				$objDrawing->setResizeProportional(false);
				$objDrawing->setWidth(240);
				$objDrawing->setHeight(210);
				// sets the image height to 36px (overriding the actual image height); 
				$objDrawing->setCoordinates('A'.$logoCell);    // pins the top-left corner of the image to cell D24
				$objDrawing->setOffsetX(0);                // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				
				/*$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Sign logo');
				$objDrawing->setDescription('Sign logo');
				$objDrawing->setPath('./images/sign.jpg');
				$objDrawing->setHeight(36);
				$objDrawing->setCoordinates('A'.$signatureCell);
				$objDrawing->setOffsetX(10);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/
		
		
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			
			$objPHPExcel->getActiveSheet()->getStyle('A16:D16')->getFont()->setBold(true);
			$totalPriceCell=$cell2-1;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$totalPriceCell)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$cell2)->applyFromArray($styleThinBlackBorderOutline);
			//$objPHPExcel->setActiveSheetIndex(0)->getStyle('A18:D18')->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D16')->applyFromArray($styleThinBlackBorderOutline);
			$BorderOutline=$description2+3;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:D'.$BorderOutline)->applyFromArray($styleThinBlackBorderOutline);
			
												 
											 // Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Invoice');
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				// Redirect output to a client’s web browser (Excel5)
				ob_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$fileName.'"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				
					
		
							
		$this->autoRender=false;
	}	
		
	public function admin_search()
	{	
		$con = array();
		if($this->data['id'] && $this->data['carid'] == "" && $this->data['date'] ==""){
			$con[] = array('CarPayment.user_id'=>$this->data['id']);
		}else if($this->data['id'] =="" && $this->data['carid'] && $this->data['date'] =="")
		{
			$con[] = array('CarPayment.car_id'=>$this->data['carid']);
		}
		else if($this->data['id'] && $this->data['carid'] && $this->data['date'] =="")
		{
			$con[] = array('CarPayment.car_id'=>$this->data['carid'],'CarPayment.user_id'=>$this->data['id']);
		}
		
		$carSaleDetails = $this->CarPayment->find('all',array('conditions'=>array('OR'=>$con),'order' => array('CarPayment.user_id' => 'ASC')));  
		$this->set('carSaleDetails',$carSaleDetails);
		
		$bankDetails = $this->Bank->find('list', array('fields'=>array('Bank.id','Bank.bank_name'),'order' => array('Bank.id' => 'ASC')));
		$this->set('bankDetails',$bankDetails);
		$this->autoRender=true; 
		
	}
	
	public function admin_invosearch() {
         $this->autoRender = false;

    // get the search term from URL
   $term = $this->request->query['q'];
  
 
    $Invoice = $this->Invoice->find('all',array('conditions'=>array('Invoice.invoice_no LIKE' => '%'.$term.'%'),'fields' =>array('Invoice.id','Invoice.invoice_no'),'group'=>'Invoice.invoice_no'));


    // Format the result for select1
		$result = array();
		foreach($Invoice as $key => $val) {
			$result[] = array("id"=>$val['Invoice']['id'],"text"=>$val['Invoice']['invoice_no']);	
		}
 
		echo json_encode($result);
		 
	}
	
	public function admin_detail_search() 
	{

		if($this->request->is('ajax'))
		{		
			//$Invoice = $this->Invoice->find('all',array('conditions'=>array('Invoice.invoice_no ' => $this->data['name']),'group'=>'Invoice.invoice_no'));
			//$this->set('Invoice',$Invoice);
			
			$invoiceDetails = $this->Invoice->find('all',array('recursive'=>3,'fields'=>array('invoice_no','id','created','amount'),'conditions'=>array('invoice_no'=>$this->data['name'])));
			$this->set('invoiceDetails',$invoiceDetails);
		}
	}
	
	public function admin_all_invoice() 
	{

		if($this->request->is('ajax'))
		{		
			$limit = $this->limit;
		$invoiceDetails = $this->Invoice->find('all',array('group'=>'invoice_no'));
		$carDetailsInInvoice =array();
 		
		$count = count($invoiceDetails);
		$this->set('invoiceDetails',$invoiceDetails);
		$this->paginate = array('limit'=>$limit,'group'=>'invoice_no');		
		$invoiceDetails= $this->Paginator->paginate('Invoice');

		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		$this->set('invoiceDetails', $invoiceDetails);
		$this->set('limit', $limit);
		$this->set('count', $count);
		}
	}
	
	public function admin_invoClientSearch() {
         $this->autoRender = false;

			// get the search term from URL
		 $term = $this->request->query['q'];
		
		$this->User->unbindModelAll();
		$user = $this->User->query("SELECT DISTINCT User.id, User.first_name, User.last_name, User.username FROM users AS User RIGHT JOIN invoice_details AS InvoiceDetail ON ( User.id = InvoiceDetail.user_id ) WHERE User.first_name LIKE '%".$term."%' ");
		 
		
		 $result = array();
		 foreach($user as $val) { 
			 $result[] = array("id"=>$val['User']['id'],"text"=>strtoupper($val['User']['first_name']).' '.strtoupper($val['User']['last_name']));	
		 }
		 echo json_encode($result);
 
	}	
	
	public function admin_Invoclient_search() 
	{
		if($this->request->is('ajax'))
		{		
			
			$invoiceDetails  =  $this->Invoice->find('all',
										array(
										"joins" => array(
											array(
												"table" => "invoice_details",
												"alias"=> "InvoiceDetail",
												"conditions" => array(
													"Invoice.id=InvoiceDetail.invoice_id"
												)
											)
										),'recursive'=>3,'conditions'=>array('InvoiceDetail.user_id'=>$this->data['id']),'group'=>'invoice_id','order'=>array('Invoice.modified'=> 'DESC')	
									));

		$limit = $this->limit;
		$count = count($invoiceDetails);

		$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('Invoice.id DESC'));

		//$invoiceDetails= $this->Paginator->paginate('Invoice');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('invoiceDetails', $invoiceDetails);
		
		$this->set('limit', $limit);
		$this->set('count', $count);

			//$Invoice = $this->Invoice->find('all',array(array('joins')'conditions'=>array('InvoiceDetail.user_id ' => $this->data['id']),'group'=>'InvoiceDetail.invoice_id'));
			//pr($Invoice);
			//$Invoice = $this->Invoice->find('all',array('conditions'=>array('Invoice.user_id ' => $this->data['id']),'group'=>'Invoice.user_id'));
			//$this->set('Invoice',$Invoice);
		}
	}
	
	public function admin_InvoChasis_search() 
	{
		if($this->request->is('ajax'))
		{		
			
			$invoiceDetails  =  $this->Invoice->find('all',
										array(
										"joins" => array(
											array(
												"table" => "invoice_details",
												"alias"=> "InvoiceDetail",
												"conditions" => array("Invoice.id=InvoiceDetail.invoice_id")
											),
											array(
												"table" => "cars",
												"alias"=> "Car",
												"conditions" => array("Car.id=InvoiceDetail.car_id")
											),
										),'recursive'=>3,'conditions'=>array('Car.cnumber'=>$this->data['name']),'order'=>array('Invoice.modified'=> 'DESC')	
									));

		$limit = $this->limit;
		
		
		$count = count($invoiceDetails);

		$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('Invoice.id DESC'));

		//$invoiceDetails= $this->Paginator->paginate('Invoice');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('invoiceDetails', $invoiceDetails);
		
		$this->set('limit', $limit);
		$this->set('count', $count);

			//$Invoice = $this->Invoice->find('all',array(array('joins')'conditions'=>array('InvoiceDetail.user_id ' => $this->data['id']),'group'=>'InvoiceDetail.invoice_id'));
			//pr($Invoice);
			//$Invoice = $this->Invoice->find('all',array('conditions'=>array('Invoice.user_id ' => $this->data['id']),'group'=>'Invoice.user_id'));
			//$this->set('Invoice',$Invoice);
		}
	}

	function admin_export_xls($id) { 
	
		/*$invoNo = "INVOICE/".$id;
		$invoiceDetails = $this->Invoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		$this->set('invoiceDetails',$invoiceDetails);
		$this->render('export_xls','export_xls');*/
		
		$invoNo = "INVOICE/".$id;
		$invoDetails = $this->Invoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		//$ofc_address = $this->Page->find('first',array('conditions'=>array('Page.title'=>'ofc_address')));
		//$str = explode('@',strip_tags($ofc_address['Page']['content']));
		
		$this->loadModel('InvoiceAddress');
		$ofc_address  =  $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$invoDetails[0]['Invoice']['invoice_address_id'])));
		
		if($invoDetails[0]['InvoiceDetail'][0]['User']['user_invoice_name'] != '')
		{
			$fileName =  $invoDetails[0]['InvoiceDetail'][0]['User']['user_invoice_name'].'.xls';
		}
		else
		{
			$fileName = 'Report.xls';
		}

		$objPHPExcel = new PHPExcel();
		$totalCount = count($invoDetails[0]['InvoiceDetail']);
		$c =1;
		$cell = 4;
		$cell1 = 17;
		$cell2 =$totalCount+$cell1+3;
		$logoCell = $cell2+2;
		$signatureCell = $logoCell+4;
		$price = 0;	
					$objPHPExcel->getProperties()->setCreator("Invoice")
											 ->setLastModifiedBy("Invoice")
											 ->setTitle("Office 2007 XLSX Test Document")
											 ->setSubject("Office 2007 XLSX Test Document")
											 ->setDescription("Generazione report inverter")
											 ->setKeywords("office 2007 openxml php")
											 ->setCategory("");
			
					//$objRichText = new PHPExcel_RichText();
					//$objRichText->createText('');
					//$objPayable = $objRichText->createTextRun('Invoice Details ');;
					//$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
					//$objPHPExcel->getActiveSheet()->getCell('C1')->setValue($objRichText);
					

					$sheet = $objPHPExcel->getActiveSheet();
					$sheet->setCellValue('A1','INVOICE DETAILS');
					$sheet->mergeCells('A1:D1');
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
					
					
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', trim(@$ofc_address['InvoiceAddress']['line_1']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', trim(@$ofc_address['InvoiceAddress']['line_2']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', trim(@$ofc_address['InvoiceAddress']['line_3']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', trim(@$ofc_address['InvoiceAddress']['line_4']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', trim(@$ofc_address['InvoiceAddress']['line_5']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', trim(@$ofc_address['InvoiceAddress']['line_6']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', trim(@$ofc_address['InvoiceAddress']['line_7']));
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'CLIENT NAME' .' - '.strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['first_name'])." ".strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['last_name']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'CUSTOMER CODE'.' - '. $invoDetails[0]['InvoiceDetail'][0]['User']['uniqueid']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D13', $invoDetails[0]['Invoice']['invoice_no']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', date('d-m-Y',strtotime($invoDetails[0]['Invoice']['created'])));

					$styleArray = array(
					  'font' => array(
					    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
					  ));
					

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'S.NO.');
					$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', 'CAR NAME');
					$objPHPExcel->getActiveSheet()->getStyle('B16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C16', 'CHASSIS NO');
					$objPHPExcel->getActiveSheet()->getStyle('C16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D16', 'PRICE');
					$objPHPExcel->getActiveSheet()->getStyle('D16')->applyFromArray($styleArray);
					unset($styleArray);
					$objPHPExcel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					foreach($invoDetails[0]['InvoiceDetail'] as $InvoVal)
					{

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell1, $c);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$cell1, $c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell1, strtoupper($InvoVal['Car']['CarName']['car_name']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell1, strtoupper($InvoVal['Car']['cnumber']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price']);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price'])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell2, "");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell2, "TOTAL(".$totalCount.")");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell2, "PRICE");
					
						$price += $InvoVal['Car']['CarPayment']['sale_price'];
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$c++;
						$cell++;
						$cell1++;
					}
		
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$logoCell, 'BANK NAME'.' - '.strtoupper($invoDetails[0]['Bank']['bank_name']));
					$branchNameCell = $logoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$branchNameCell, 'BRANCH NAME'.' - '.strtoupper($invoDetails[0]['Bank']['branch_name']));
					$swiftCodeCell = $branchNameCell+1;
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D25', 'Branch No.'.'-'."");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$swiftCodeCell, 'SWIFT NAME'.' - '.strtoupper($invoDetails[0]['Bank']['swift_name']));
					$acNoCell = $swiftCodeCell+1;	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNoCell, 'A/C NO'.' - '.$invoDetails[0]['Bank']['account_no']);
					$acNameCell = $acNoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNameCell, 'A/C NAME'.' - '.strtoupper($invoDetails[0]['Bank']['account_name']));
					$bank_desc =$invoDetails[0]['Bank']['discription'];
					//$spaceCount = substr_count($str, ' ');
					
					$words = explode(" ", $bank_desc);
					$firstpart = join(" ", array_slice($words, 0,3));
					$restpart = join(" ", array_slice($words, 3));
					
					  $description = $acNameCell+1;
					
					$description2 = $description+2;
				
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setWrapText(true);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$description.':D'.$description2);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$description,'DESCRIPTION'.' - '.@$firstpart.' '.$restpart);
		
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				
				$objDrawing->setName('Stamp logo');
				$objDrawing->setDescription('Stamp logo');
				$objDrawing->setPath("./images/stamp.jpg");
				
				$objDrawing->setResizeProportional(false);
				$objDrawing->setWidth(250);
				$objDrawing->setHeight(210);
				// sets the image height to 36px (overriding the actual image height); 
				$objDrawing->setCoordinates('A'.$logoCell);    // pins the top-left corner of the image to cell D24
				$objDrawing->setOffsetX(0);                // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				
				/*$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Sign logo');
				$objDrawing->setDescription('Sign logo');
				$objDrawing->setPath('./images/stamp.jpg');
				$objDrawing->setHeight(36);
				$objDrawing->setCoordinates('A'.$signatureCell);
				$objDrawing->setOffsetX(10);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/
		
		
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			
			$objPHPExcel->getActiveSheet()->getStyle('A16:D16')->getFont()->setBold(true);
			$totalPriceCell=$cell2-1;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$totalPriceCell)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$cell2)->applyFromArray($styleThinBlackBorderOutline);
			//$objPHPExcel->setActiveSheetIndex(0)->getStyle('A18:D18')->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D16')->applyFromArray($styleThinBlackBorderOutline);
			$BorderOutline=$description2+3;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:D'.$BorderOutline)->applyFromArray($styleThinBlackBorderOutline);
												 
											 // Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Invoice');
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				// Redirect output to a client’s web browser (Excel5)
				ob_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$fileName.'"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				
					
		
							
		$this->autoRender=false;
		
		
		
		

	}	
	
	function admin_carlist($id = null)
	{
		 $this->autoRender = false;
		 
		$Cars  = $this->CarPayment->query("select User.bank_id,CarPayment.car_id,Car.cnumber,CarName.car_name  from car_payments as CarPayment left join cars as Car on (Car.id = CarPayment.car_id)  left join users as User on (User.id = CarPayment.user_id)  left join car_names as CarName on (Car.car_name_id = CarName.id) where CarPayment.car_id NOT IN (select InvoiceDetail.car_id from invoice_details as InvoiceDetail) and CarPayment.user_id = '".$id."' AND  CarPayment.deleted = 0 ");
		
		//$Cars  = $this->CarPayment->query("select User.bank_id,CarPayment.car_id,Car.cnumber,CarName.car_name  from car_payments as CarPayment left join cars as Car on (Car.id = CarPayment.car_id)  left join users as User on (User.id = CarPayment.user_id)  left join car_names as CarName on (Car.car_name_id = CarName.id) where  CarPayment.user_id = '".$id."' AND  CarPayment.deleted = 0 ");
			
		$option =array();
		if(empty($Cars))
		{
			$option[] = array('car_id'=>'','cnumber'=>'','car_name'=>'','bank_id'=>'');
		}else
		{
			foreach($Cars  as $val)
			{
				 $option[] = array('car_id'=>$val['CarPayment']['car_id'],'cnumber'=>$val['Car']['cnumber'],'car_name'=>$val['CarName']['car_name'],'bank_id'=>$val['User']['bank_id']);
			}
		}
		echo json_encode($option);
	}
	
	public function admin_delete($Id = null,$invo_no = null) {
		
		//echo $Id."".$invo_no;
		
		$invoDetails = $this->Invoice->find('all',array('conditions'=>array('Invoice.id'=>$Id)));
			$currency_data = $this->CarPayment->find('first',array('fields'=>array('currency'),'conditions'=>array('CarPayment.car_id'=>$invoDetails[0]['InvoiceDetail'][0]['car_id'])));
		//echo "<pre>";
	//print_r($currency_data['CarPayment']['currency']);
		//echo $invoDetails[0]['InvoiceDetail'][0]['user_id'];die;
		$this->loadModel('DeletedInvoice');
		$this->loadModel('DeletedInvoiceDetail');
		$data = array();
		$data['DeletedInvoice']['invoice_no'] = $invoDetails[0]['Invoice']['invoice_no'];
		$data['DeletedInvoice']['user_id'] = $invoDetails[0]['InvoiceDetail'][0]['user_id'];	
		$data['DeletedInvoice']['amount'] = $invoDetails[0]['Invoice']['amount'];
		$data['DeletedInvoice']['currency_type'] = $currency_data['CarPayment']['currency'];
		$data['DeletedInvoice']['bank_id'] = $invoDetails[0]['Invoice']['bank_id'];
		$data['DeletedInvoice']['invoice_address_id'] = $invoDetails[0]['Invoice']['invoice_address_id'];
		$save_result = $this->DeletedInvoice->save($data);
		if($save_result)
		{
			foreach($invoDetails[0]['InvoiceDetail'] as $val)
		    {
				$delete_data['DeletedInvoiceDetail']['deleted_invoice_id'] = $save_result['DeletedInvoice']['id'];	
				$delete_data['DeletedInvoiceDetail']['car_id'] = $val['car_id'];
				$save_del_data =  $this->DeletedInvoiceDetail->save($delete_data);
				$this->DeletedInvoiceDetail->create();				
			}
		}
		if ($save_del_data) 
		{
					$this->Invoice->softDelete = true;
				//if ($this->request -> isPost()) {
					if ($this->Invoice->delete($Id)) {
						$this->InvoiceDetail->deleteAll(array('InvoiceDetail.invoice_id'=>$Id), false);
						//$this->InvoiceDetail->delete(array('InvoiceDetail.deleted'=>1), array('InvoiceDetail.invoice_id'=>$Id));
						$this->Session->setFlash(__('Invoice successfully deleted'));
					}
				//}
				$this->redirect('/admin/invoices/list');
		}else 
		{
			$this->redirect('/admin/invoices/list');
		}
		
		

		/*$this->getMailData($invo_no,'Deleted');
		
		if (!empty($Id)) {
					$this->Invoice->softDelete = true;
				//if ($this->request -> isPost()) {
					if ($this->Invoice->delete($Id)) {
						$this->InvoiceDetail->deleteAll(array('InvoiceDetail.invoice_id'=>$Id), false);
						//$this->InvoiceDetail->delete(array('InvoiceDetail.deleted'=>1), array('InvoiceDetail.invoice_id'=>$Id));
						$this->Session->setFlash(__('Invoice successfully deleted'));
					}
				//}
				$this->redirect('/admin/invoices/list');
			} else {
				$this->redirect('/admin/invoices/list');
			}*/
	}
	
	/*public function admin_delete($Id = null) {
	
		//$Id = $this->data['id'];
		if (!empty($this->data['id'])) {
			$Id = $this->data['id'];
			
			if ($this->request -> isPost()) {
				if ($this->Invoice->delete($Id, false)) {
					$del  =$this->InvoiceDetail->deleteAll(array('InvoiceDetail.invoice_id'=>$Id), false);
					
						$limit = 5;
						$invoiceDetails = $this->Invoice->find('all');
						$count = count($invoiceDetails);
						$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('Invoice.id DESC'));		
						$invoiceDetails= $this->Paginator->paginate('Invoice');
						//echo $count = count($invoiceDetails);
						$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
						$this->set('invoiceDetails', $invoiceDetails);
						//echo $count = count($invoiceDetails);
						$this->set('limit', $limit);
						$this->set('count', $count);
						$this->Session->setFlash(__('Invoice successfully deleted'));
					
					//$this->Session->setFlash(__('Invoice successfully deleted'));
				}
			}
			//$this->redirect('/admin/invoices/list');
		//} else {
			//$this->redirect('/admin/invoices/list');
		}
	}*/
	
	
	public function getUniqueInvoiceNo() 
	{
		//$this->autoRender= false;
		//$r = $this->Invoice->find('first',array('fields'=>array('count(Invoice.invoice_no) AS Count')));
		
		$r = $this->Invoice->query("select Invoice.id AS Count from invoices as Invoice Order by Invoice.id DESC LIMIT 1");
		$c= $r[0]['Invoice']['Count'];
		//$c= $r[0][0]['Count'];
		$c++;
		if(strlen($c) == 1)
			return "0000".$c;
		else if(strlen($c) == 2)
			return "000".$c;
		else if(strlen($c) == 3)
			return "00".$c;
		else if(strlen($c) == 4) 
			return "0".$c;
		 else if(strlen($c) == 5)
			return $c;
  
	}
	
	
	public function admin_send_mail(){
		$this->autoRender = false;
		//echo 'no access'; die;

		if($this->request->is('post'))
		{//echo 'no access'; die;			
			$user_id = $this->data['userId'];

			$userDetails = $this->User->find('first', array('fields'=>array('User.email','User.alternate_email'),'conditions' => array('User.user_group_id !=' => 1,'User.id'=>$user_id)));								
			
			if($userDetails['User']['alternate_email'] !='')
			{
				$emailArr =$userDetails['User']['email'];  
			}
			else
			{
				$emailArr =$userDetails['User']['email'];
			}	

			//$this->data['email']

			$this->getMailData($this->data['invoiceId']);

			$file = WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls';

			$this->Email->smtpOptions = array(
			 'port'=>'465',
			 'timeout'=>'30',
			 'host' => 'smtp.gmail.com',
			 'username'=> EMAIL_ACCOUNT,
			 'password'=> EMAIL_PASSWORD,
			 'transport' => 'Smtp', 
			);
			


           ///////////////////////////////////////////////////////////////////////////
           /*
			$this->Email->to = $emailArr;
			$this->Email->subject = 'INVOICE/'.$this->data['invoiceId'];
			$this->Email->from = EMAIL_ACCOUNT;
			//$this->Email->cc = EMAIL_ACCOUNT;
			$this->Email->bcc = EMAIL_ACCOUNT;
			$this->Email->attachments =  array($file);
			$data = "hello........";
			$sendMail =  $this->Email->send($data);

          */


			$data = "hello........";
			#$attachment = file_get_contents($file);
			#$attachment_encoded = base64_encode($attachment);


			$fromEmail = EMAIL_ACCOUNT;
			$toEmail  = $emailArr;
			#$toEmail  = "jainmca4444@gmail.com";
			$toName = "";
			$fromName ="";



//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "tls";
$mail->SMTPDebug = false;
$mail->Host       = EMAIL_HOST;
$mail->Username   = AWSAccessKeyId;
$mail->Password   = AWSSecretKey;
$mail->SetFrom(EMAIL_FROM, FromName); //from (verified email address)
$mail->Subject = 'INVOICE/'.$this->data['invoiceId'];

$mail->MsgHTML($data);
$mail->AddAttachment($file);

$mail->AddAddress(EMAIL_ACCOUNT);
$mail->AddAddress($toEmail);

$sendMail = $mail->Send();

if($sendMail)
  {	
    @unlink(WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls');
    echo json_encode(array("status"=>"success","message"=>"Your mail is successfully send!"));
  }
  else
  {
    echo json_encode(array("status"=>"error","message"=>"Your detail something wrong!"));
  }

/*
$mail = new phpmailer;

// Set mailer to use AmazonSES.
$mail->IsAmazonSES();

// Set AWSAccessKeyId and AWSSecretKey provided by amazon.
$mail->AddAmazonSESKey("AKIAJNW43Q52MXLEMYGQ", "ApRR8hKrq5CzGH94DIs3XTmLxzcArs2tEwwp7Hlx+5c2");
$mail->SMTPDebug = false;
// "From" must be a verified address.
$mail->From = $fromEmail;

$mail->AddAddress($toEmail);
$mail->AddAddress(EMAIL_ACCOUNT);
$mail->AddAttachment($file);
$mail->Subject = 'INVOICE/'.$this->data['invoiceId'];
$mail->Body = $data;
$sendMail = $mail->Send(); // send message
unset($sendMail['headers']);
if($sendMail)
  {	
    @unlink(WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls');
    echo json_encode(array("status"=>"success","message"=>"Your mail is successfully send!"));
  }
  else
  {
    echo json_encode(array("status"=>"error","message"=>"Your detail something wrong!"));
  }

*/


			

           ///////////////////////////////////////////////////////////////////////////


		/*	if($sendMail)
			{	
				@unlink(WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls');
				echo json_encode(array("status"=>"success","message"=>"Your mail is successfully send!"));
			}else
			{
				echo $this->Email->smtpError;
			}
                */
			/*
			 $this->Email->smtpOptions = array(
			 'port'=>'465',
			 'timeout'=>'30',
			 'host' => 'ssl://smtp.gmail.com',
			 'username'=>'ukcarstokyo@gmail.com',
			 'password'=>'uktokyo123',
			 //'password'=>'uktokyo234',
			);
			
			 $this->Email->to = $this->data['email']; 
			$this->getMailData($this->data['invoiceId']);
			$file = WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls';
			$this->Email->cc = 'nikhil.tiwari@webenturetech.com'; 
			$this->Email->replyTo = 'nikhil.tiwari@webenturetech.com'; 	
			$this->Email->subject = 'Invoice mail '; 
			$this->Email->from = 'nikhil.tiwari@webenturetech.com';
			$this->Email->attachments =  array($file); 
			$data = "hello........";
			$sendMail = $this->Email->send($data);
			if($sendMail)
			{	
				@unlink(WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls');
				echo json_encode(array("status"=>"success","message"=>"Your mail is successfully send!"));
			}*/
			/*
			 /*$Email = new CakeEmail();
			$Email->config('smtp');
			$Email->to($emailArr[0]);
			$Email->subject('UsedCar Invoice Mail');
			$Email->from('ukcarsjapan@gmail.com', 'INVOICE MAIL FROM ukcarsjapan@gmail.com');
			//$Email->sender('ukcarsjapan@gmail.com', 'INVOICE MAIL FROM ukcarsjapan@gmail.com');
			$Email->attachments(array($file));			
			$data = "hello........";
			$sendMail =   $Email->send($data);
			if($sendMail)
			{	
				@unlink(WWW_ROOT.'files/Report'.$this->data['invoiceId'].'.xls');
				echo json_encode(array("status"=>"success","message"=>"Your mail is successfully send!"));
			}else
			{
				echo $this->Email->smtpError;
			}*/
			
			  
			 
			
		}else{
			echo json_encode(array("status"=>"error","message"=>"Your detail something wrong!"));
		}
		
		
	} 
	
	public function getMailData($id= null,$type = null)
	{
		
		$invoNo = "INVOICE/".$id;
		$invoDetails = $this->Invoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		
		//$ofc_address = $this->Page->find('first',array('conditions'=>array('Page.title'=>'ofc_address')));
		//$str = explode('@',strip_tags($ofc_address['Page']['content']));
		
		$this->loadModel('InvoiceAddress');
		$ofc_address  =  $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$invoDetails[0]['Invoice']['invoice_address_id'])));


		
		$objPHPExcel = new PHPExcel();

		$totalCount = count($invoDetails[0]['InvoiceDetail']);
		$c =1;
		$cell = 4;
		$cell1 = 17;
		$cell2 =$totalCount+$cell1+3;
		$logoCell = $cell2+2;
		$signatureCell = $logoCell+4;
		$price = 0;	
		$currency='';
					$objPHPExcel->getProperties()->setCreator("Invoice")
											 ->setLastModifiedBy("Invoice")
											 ->setTitle("Office 2007 XLSX Test Document")
											 ->setSubject("Office 2007 XLSX Test Document")
											 ->setDescription("Generazione report inverter")
											 ->setKeywords("office 2007 openxml php")
											 ->setCategory("");
			
					$sheet = $objPHPExcel->getActiveSheet();
					$sheet->setCellValue('A1','INVOICE DETAILS');
					$sheet->mergeCells('A1:D1');
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
					
					
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', trim(@$ofc_address['InvoiceAddress']['line_1']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', trim(@$ofc_address['InvoiceAddress']['line_2']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', trim(@$ofc_address['InvoiceAddress']['line_3']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', trim(@$ofc_address['InvoiceAddress']['line_4']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', trim(@$ofc_address['InvoiceAddress']['line_5']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', trim(@$ofc_address['InvoiceAddress']['line_6']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', trim(@$ofc_address['InvoiceAddress']['line_7']));
					
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'CLIENT NAME' .' - '.strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['first_name'])." ".strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['last_name']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'CUSTOMER CODE'.' - '. $invoDetails[0]['InvoiceDetail'][0]['User']['uniqueid']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D13', $invoDetails[0]['Invoice']['invoice_no']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', date('d-m-Y',strtotime($invoDetails[0]['Invoice']['created'])));

					$styleArray = array(
					  'font' => array(
					    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
					  ));
					

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'S.NO.');
					$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', 'CAR NAME');
					$objPHPExcel->getActiveSheet()->getStyle('B16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C16', 'CHASSIS NO');
					$objPHPExcel->getActiveSheet()->getStyle('C16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D16', 'PRICE');
					$objPHPExcel->getActiveSheet()->getStyle('D16')->applyFromArray($styleArray);
					unset($styleArray);
					$objPHPExcel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					foreach($invoDetails[0]['InvoiceDetail'] as $InvoVal)
					{

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell1, $c);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$cell1, $c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell1, strtoupper($InvoVal['Car']['CarName']['car_name']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell1, strtoupper($InvoVal['Car']['cnumber']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price']);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$InvoVal['Car']['CarPayment']['sale_price'])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell2, "");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell2, "TOTAL(".$totalCount.")");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell2, "PRICE");
					
						$price += $InvoVal['Car']['CarPayment']['sale_price'];
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$price)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$c++;
						$cell++;
						$cell1++;
					}
		
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$logoCell, 'BANK NAME'.' - '.strtoupper($invoDetails[0]['Bank']['bank_name']));
					$branchNameCell = $logoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$branchNameCell, 'BRANCH NAME'.' - '.strtoupper($invoDetails[0]['Bank']['branch_name']));
					$swiftCodeCell = $branchNameCell+1;
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D25', 'Branch No.'.'-'."");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$swiftCodeCell, 'SWIFT NAME'.' - '.strtoupper($invoDetails[0]['Bank']['swift_name']));
					$acNoCell = $swiftCodeCell+1;	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNoCell, 'A/C NO'.' - '.strtoupper($invoDetails[0]['Bank']['account_no']));
					$acNameCell = $acNoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNameCell, 'A/C NAME'.' - '.strtoupper($invoDetails[0]['Bank']['account_name']));
					$bank_desc =$invoDetails[0]['Bank']['discription'];
					//$spaceCount = substr_count($str, ' ');
					
					$words = explode(" ", $bank_desc);
					$firstpart = join(" ", array_slice($words, 0,3));
					$restpart = join(" ", array_slice($words, 3));
					
					 $description = $acNameCell+1;
					
					$description2 = $description+2;
				
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setWrapText(true);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$description.':D'.$description2);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$description,'DESCRIPTION'.' - '.@$firstpart.' '.$restpart);
					
					//$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$description2.':D'.$description2);
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$description2,@$$restpart);
		
				
				
		
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				
				$objDrawing->setName('Stamp logo');
				$objDrawing->setDescription('Stamp logo');
				$objDrawing->setPath("./images/stamp.jpg");      
				
				$objDrawing->setResizeProportional(false);
				$objDrawing->setWidth(240);
				$objDrawing->setHeight(210);
				// sets the image height to 36px (overriding the actual image height); 
				$objDrawing->setCoordinates('A'.$logoCell);    // pins the top-left corner of the image to cell D24
				$objDrawing->setOffsetX(0);                // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				
				/*$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Sign logo');
				$objDrawing->setDescription('Sign logo');
				$objDrawing->setPath('./images/sign.jpg');
				$objDrawing->setHeight(36);
				$objDrawing->setCoordinates('A'.$signatureCell);
				$objDrawing->setOffsetX(10);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/
		
		
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			
			$objPHPExcel->getActiveSheet()->getStyle('A16:D16')->getFont()->setBold(true);
			$totalPriceCell=$cell2-1;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$totalPriceCell)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$cell2)->applyFromArray($styleThinBlackBorderOutline);
			//$objPHPExcel->setActiveSheetIndex(0)->getStyle('A18:D18')->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D16')->applyFromArray($styleThinBlackBorderOutline);
			$BorderOutline=$description2+3;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:D'.$BorderOutline)->applyFromArray($styleThinBlackBorderOutline);
			
												 
											 // Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Invoice');
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				
				if($type =='Send')
				{
					$file = WWW_ROOT.'files/Report'.$id.'.xls'; // not viewable by public 
				}
				else if($type =='Deleted')
				{
					$file = WWW_ROOT.'files/delete_report/Report'.$id.'.xls'; // not viewable by public
					$client_name = strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['first_name'])." ".strtoupper($invoDetails[0]['InvoiceDetail'][0]['User']['last_name']); 
					$this->loadModel('DeletedInvoice');
					$data = array();
					$data['DeletedInvoice']['invoice_no'] = $invoNo;
					$data['DeletedInvoice']['user_id'] = $invoDetails[0]['InvoiceDetail'][0]['User']['id'];	
					$data['DeletedInvoice']['client_name'] = $client_name; 
					$data['DeletedInvoice']['excel_path'] = 'files/delete_report/Report'.$id.'.xls';
					$this->DeletedInvoice->save($data);
					
					 
				}else
				{
					$file = WWW_ROOT.'files/Report'.$id.'.xls'; // not viewable by public 
				}


				$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 

				$sa = $objWriter->save($file);

				
				
				
	}  
	
	public function admin_delete_invoice()
	{
		$limit = $this->limit;
		$this->loadModel('DeletedInvoice');
		$deleteInvoiceResult = $this->DeletedInvoice->find('all');
		$count = count($deleteInvoiceResult);
		
		$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('DeletedInvoice.id'=> 'DESC'));		
		$deleteInvoiceResult1= $this->Paginator->paginate('DeletedInvoice');
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'1'));
		$this->set('invoiceDetails',$deleteInvoiceResult1);
		$this->set('limit', $limit);
		$this->set('count', $count);		
	}
	
	public function admin_delete_server_invoice($Id = null)
	{
		$this->loadModel('DeletedInvoice');
		$this->loadModel('DeletedInvoiceDetail');
		if (!empty($Id)) 
		{
			$this->Invoice->softDelete = false;
		
			if($this->DeletedInvoice->delete($Id)) 
			{
				$this->DeletedInvoiceDetail->deleteAll(array('DeletedInvoiceDetail.deleted_invoice_id'=>$Id), false);
				$this->Session->setFlash(__('Invoice deleted form your server. you have no data for this invoice !!!'));
				$this->redirect('/admin/invoices/delete_invoice');
			}
			else
			{
				$this->Session->setFlash(__('Something went wrong !!!'));
				$this->redirect('/admin/invoices/delete_invoice');
			}
			
		} else 
		{
		    $this->Session->setFlash(__('Something went wrong !!!'));
				$this->redirect('/admin/invoices/delete_invoice');
		}
		
	}	
	
	public function admin_delete_invoice_search() {
			$this->autoRender = false;

			// get the search term from URL
			$term = $this->request->query['q'];
			$this->loadModel('DeletedInvoice');

			$Invoice = $this->DeletedInvoice->find('all',array('conditions'=>array('DeletedInvoice.invoice_no LIKE' => '%'.$term.'%'),'fields' =>array('DeletedInvoice.id','DeletedInvoice.invoice_no'),'group'=>'DeletedInvoice.invoice_no'));

			// Format the result for select1
			$result = array();
			foreach($Invoice as $key => $val) 
			{
				$result[] = array("id"=>$val['DeletedInvoice']['id'],"text"=>$val['DeletedInvoice']['invoice_no']);	
			}
 
		echo json_encode($result);
 
	}
			
	public function admin_delete_invoice_client_Search() {
         $this->autoRender = false;

			// get the search term from URL
		 $term = $this->request->query['q'];
		$this->loadModel('DeletedInvoice');
		$this->User->unbindModelAll();
		$user = $this->User->query("SELECT DISTINCT User.id, User.first_name, User.last_name, User.username FROM users AS User RIGHT JOIN deleted_invoices AS DeletedInvoice ON ( User.id = DeletedInvoice.user_id ) WHERE User.first_name LIKE '%".$term."%' ");
		 
		
		 $result = array();
		 foreach($user as $val) { 
			 $result[] = array("id"=>$val['User']['id'],"text"=>strtoupper($val['User']['first_name']).' '.strtoupper($val['User']['last_name']));	
		 }
		 echo json_encode($result);
 
	}
	
	public function admin_delete_detail_search() 
	{
		if($this->request->is('ajax'))
		{		
			//$Invoice = $this->Invoice->find('all',array('conditions'=>array('Invoice.invoice_no ' => $this->data['name']),'group'=>'Invoice.invoice_no'));
			//$this->set('Invoice',$Invoice);
			
			$this->loadModel('DeletedInvoice');
			$deleteInvoiceResult = $this->DeletedInvoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$this->data['name'])));
			$this->set('invoiceDetails',$deleteInvoiceResult);
			$this->render('admin_detele_search_data');
			$this->layout = null;
		}
	}		
			
	public function admin_delete_invoice_details_client() 
	{
		if($this->request->is('ajax'))
		{		
			$this->loadModel('DeletedInvoice');
			/*$invoiceDetails  =  $this->DeletedInvoice->find('all',
										array(
										"joins" => array(
											array(
												"table" => "users",
												"alias"=> "User",
												"conditions" => array(
													"DeletedInvoice.user_id=User.id"
												)
											)
										),'conditions'=>array('DeletedInvoice.user_id'=>$this->data['id']),'group'=>'invoice_no','order'=>array('DeletedInvoice.modified'=> 'DESC')	
									));*/
			$invoiceDetails = $this->DeletedInvoice->find('all',array('recursive'=>3,'conditions'=>array('DeletedInvoice.user_id'=>$this->data['id'])));
							

		$limit = $this->limit;
		$count = count($invoiceDetails);

		$this->paginate = array('limit'=>$limit,'recursive'=>3,'order' => array('DeletedInvoice.id DESC'));

		//$invoiceDetails= $this->Paginator->paginate('Invoice');
		
		$this->set('srNo',(isset($this->params->params['named']['page'])? ($this->params->params['named']['page']-1)*$limit:'0'));
		
		$this->set('invoiceDetails', $invoiceDetails);
		
		$this->set('limit', $limit);
		$this->set('count', $count);
		$this->render('admin_detele_search_data');
			$this->layout = null;

		}
	}
	
	public function admin_clear_search_for_delete()
	{
		$this->loadModel('DeletedInvoice');
		$deleteInvoiceResult = $this->DeletedInvoice->find('all');
		$this->set('invoiceDetails',$deleteInvoiceResult);
	}
	
	public function admin_delete_invoice_generate($id=null)
	{
		$invoNo = "INVOICE/".$id;
		$this->loadModel('DeletedInvoice');
		$invoDetails = $this->DeletedInvoice->find('all',array('recursive'=>3,'conditions'=>array('invoice_no'=>$invoNo)));
		//echo "<pre>";
		//print_r($invoDetails);die;
		//$ofc_address = $this->Page->find('first',array('conditions'=>array('Page.title'=>'ofc_address')));
		//$str = explode('@',strip_tags($ofc_address['Page']['content']));
		
		$this->loadModel('InvoiceAddress');
		$ofc_address  =  $this->InvoiceAddress->find('first',array('conditions'=>array('id'=>$invoDetails[0]['DeletedInvoice']['invoice_address_id'])));	
	//echo "<pre>";
	//print_r($invoDetails);die;
		if($invoDetails[0]['User']['user_invoice_name'] != '')
		{
			$fileName =  $invoDetails[0]['User']['user_invoice_name'].'.xls';
		}
		else
		{
			$fileName = 'Report.xls';
		}

		$objPHPExcel = new PHPExcel();
		$totalCount = count($invoDetails[0]['DeletedInvoiceDetail']);
		$c =1;
		$cell = 4;
		$cell1 = 17;
		$cell2 =$totalCount+$cell1+3;
		$logoCell = $cell2+2;
		$signatureCell = $logoCell+4;
		$price = 0;	
					$objPHPExcel->getProperties()->setCreator("Invoice")
											 ->setLastModifiedBy("Invoice")
											 ->setTitle("Office 2007 XLSX Test Document")
											 ->setSubject("Office 2007 XLSX Test Document")
											 ->setDescription("Generazione report inverter")
											 ->setKeywords("office 2007 openxml php")
											 ->setCategory("");
			
					//$objRichText = new PHPExcel_RichText();
					//$objRichText->createText('');
					//$objPayable = $objRichText->createTextRun('Invoice Details ');;
					//$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
					//$objPHPExcel->getActiveSheet()->getCell('C1')->setValue($objRichText);
					

					$sheet = $objPHPExcel->getActiveSheet();
					$sheet->setCellValue('A1','INVOICE DETAILS');
					$sheet->mergeCells('A1:D1');
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
					
					
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', trim(@$ofc_address['InvoiceAddress']['line_1']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', trim(@$ofc_address['InvoiceAddress']['line_2']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', trim(@$ofc_address['InvoiceAddress']['line_3']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', trim(@$ofc_address['InvoiceAddress']['line_4']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', trim(@$ofc_address['InvoiceAddress']['line_5']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', trim(@$ofc_address['InvoiceAddress']['line_6']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', trim(@$ofc_address['InvoiceAddress']['line_7']));
					
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'CLIENT NAME' .' - '.strtoupper($invoDetails[0]['User']['first_name'])." ".strtoupper($invoDetails[0]['User']['last_name']));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'CUSTOMER CODE'.' - '. $invoDetails[0]['User']['uniqueid']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D13', $invoDetails[0]['DeletedInvoice']['invoice_no']);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D14', date('d-m-Y',strtotime($invoDetails[0]['DeletedInvoice']['created'])));

					$styleArray = array(
					  'font' => array(
					    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
					  ));
					

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'S.NO.');
					$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', 'CAR NAME');
					$objPHPExcel->getActiveSheet()->getStyle('B16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C16', 'CHASSIS NO');
					$objPHPExcel->getActiveSheet()->getStyle('C16')->applyFromArray($styleArray);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D16', 'PRICE');
					$objPHPExcel->getActiveSheet()->getStyle('D16')->applyFromArray($styleArray);
					unset($styleArray);
					$objPHPExcel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					foreach($invoDetails[0]['DeletedInvoiceDetail'] as $InvoVal)
					{

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell1, $c);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$cell1, $c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell1, strtoupper($InvoVal['Car']['CarName']['car_name']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell1, strtoupper($InvoVal['Car']['cnumber']));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$invoDetails[0]['DeletedInvoice']['amount']);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell1, $InvoVal['Car']['CarPayment']['currency'].''.$invoDetails[0]['DeletedInvoice']['amount'])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cell2, "");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cell2, "TOTAL(".$totalCount.")");
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cell2, "PRICE");
					
						$price += $InvoVal['Car']['CarPayment']['sale_price'];
						//$delete_in
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$invoDetails[0]['DeletedInvoice']['amount']);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$cell2, $InvoVal['Car']['CarPayment']['currency'].''.$invoDetails[0]['DeletedInvoice']['amount'])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$c++;
						$cell++;
						$cell1++;
					}
		
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$logoCell, 'BANK NAME'.' - '.strtoupper($invoDetails[0]['Bank']['bank_name']));
					$branchNameCell = $logoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$branchNameCell, 'BRANCH NAME'.' - '.strtoupper($invoDetails[0]['Bank']['branch_name']));
					$swiftCodeCell = $branchNameCell+1;
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D25', 'Branch No.'.'-'."");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$swiftCodeCell, 'SWIFT NAME'.' - '.strtoupper($invoDetails[0]['Bank']['swift_name']));
					$acNoCell = $swiftCodeCell+1;	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNoCell, 'A/C NO'.' - '.$invoDetails[0]['Bank']['account_no']);
					$acNameCell = $acNoCell+1;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$acNameCell, 'A/C NAME'.' - '.strtoupper($invoDetails[0]['Bank']['account_name']));
					$bank_desc =$invoDetails[0]['Bank']['discription'];
					//$spaceCount = substr_count($str, ' ');
					
					$words = explode(" ", $bank_desc);
					$firstpart = join(" ", array_slice($words, 0,3));
					$restpart = join(" ", array_slice($words, 3));
					
					 $description = $acNameCell+1;
					
					$description2 = $description+2;
				
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$description)->getAlignment()->setWrapText(true);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$description.':D'.$description2);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$description,'DESCRIPTION'.' - '.@$firstpart.' '.$restpart);
					
				
		
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				
				$objDrawing->setName('Stamp logo');
				$objDrawing->setDescription('Stamp logo');
				$objDrawing->setPath("./images/stamp.jpg");      
				
				$objDrawing->setResizeProportional(false);
				$objDrawing->setWidth(240);
				$objDrawing->setHeight(210);
				// sets the image height to 36px (overriding the actual image height); 
				$objDrawing->setCoordinates('A'.$logoCell);    // pins the top-left corner of the image to cell D24
				$objDrawing->setOffsetX(0);                // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				
				/*$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Sign logo');
				$objDrawing->setDescription('Sign logo');
				$objDrawing->setPath('./images/sign.jpg');
				$objDrawing->setHeight(36);
				$objDrawing->setCoordinates('A'.$signatureCell);
				$objDrawing->setOffsetX(10);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/
		
		
			$styleThinBlackBorderOutline = array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);
			
			
			$objPHPExcel->getActiveSheet()->getStyle('A16:D16')->getFont()->setBold(true);
			$totalPriceCell=$cell2-1;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$totalPriceCell)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D'.$cell2)->applyFromArray($styleThinBlackBorderOutline);
			//$objPHPExcel->setActiveSheetIndex(0)->getStyle('A18:D18')->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:D16')->applyFromArray($styleThinBlackBorderOutline);
			$BorderOutline=$description2+3;
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:D'.$BorderOutline)->applyFromArray($styleThinBlackBorderOutline);
			
												 
											 // Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Invoice');
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				// Redirect output to a client’s web browser (Excel5)
				ob_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$fileName.'"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				
					
		
							
		$this->autoRender=false;
	}	
	
	
		
				
}
