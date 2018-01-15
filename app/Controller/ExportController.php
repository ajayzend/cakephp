<?php
App::uses('AppController', 'Controller');

class ExportController extends AppController {
	public $uses = array('Purchase');
	
public function beforeFilter() {
		$this->UserAuth->loginPage='/admin/login';
		parent::beforeFilter();
		
		$this->User->userAuth=$this->UserAuth;
	}


	public function admin_index() {
	
                   	


	//$this->autoRender = false;
require_once ROOT_DIR.'/vendors/PHPExcel/Classes/PHPExcel.php';
require_once ROOT_DIR.'/vendors/PHPExcel/Classes/PHPExcel/IOFactory.php';
ob_clean();

$alfa = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);

	$psql = "SELECT * FROM purchases where deleted=0";
	$psqlName = $this->Purchase->query($psql);
	$i = 2;
	$objPHPExcel->getActiveSheet()->setCellValue('A1', "ID");
	$objPHPExcel->getActiveSheet()->setCellValue('B1', "purchase_auction_day");
	$objPHPExcel->getActiveSheet()->setCellValue('C1', "purchase_auction_name");
	$objPHPExcel->getActiveSheet()->setCellValue('D1', "purchase_vechinle_no");
	$objPHPExcel->getActiveSheet()->setCellValue('E1', "purchase_modal");
	$objPHPExcel->getActiveSheet()->setCellValue('F1', "purchase_price");
	$objPHPExcel->getActiveSheet()->setCellValue('G1', "purchase_unit");
	$objPHPExcel->getActiveSheet()->setCellValue('H1', "purchase_car_price");
	$objPHPExcel->getActiveSheet()->setCellValue('I1', "purchase_recycling");
	$objPHPExcel->getActiveSheet()->setCellValue('J1', "purchase_tax");
	$objPHPExcel->getActiveSheet()->setCellValue('K1', "purchase_bid_charge");
	$objPHPExcel->getActiveSheet()->setCellValue('L1', "purchase_panelty");
	$objPHPExcel->getActiveSheet()->setCellValue('M1', "purchase_agecy_fee");
	$objPHPExcel->getActiveSheet()->setCellValue('N1', "purchase_payment_date");
	$objPHPExcel->getActiveSheet()->setCellValue('O1', "purchase_bank");
	$objPHPExcel->getActiveSheet()->setCellValue('P1', "purchase_payment");
	$objPHPExcel->getActiveSheet()->setCellValue('Q1', "purchase_cancel_date");
	$objPHPExcel->getActiveSheet()->setCellValue('R1', "purchase_first_year");
	$objPHPExcel->getActiveSheet()->setCellValue('S1', "final_last_remark");

	foreach($psqlName as $purchase){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $purchase['purchases']['id']);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $purchase['purchases']['purchase_auction_day']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $purchase['purchases']['purchase_auction_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $purchase['purchases']['purchase_vechinle_no']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $purchase['purchases']['purchase_modal']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $purchase['purchases']['purchase_price']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $purchase['purchases']['purchase_unit']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $purchase['purchases']['purchase_car_price']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $purchase['purchases']['purchase_recycling']);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $purchase['purchases']['purchase_tax']);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $purchase['purchases']['purchase_bid_charge']);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $purchase['purchases']['purchase_panelty']);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $purchase['purchases']['purchase_agecy_fee']);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $purchase['purchases']['purchase_payment_date']);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $purchase['purchases']['purchase_bank']);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $purchase['purchases']['purchase_payment']);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $purchase['purchases']['purchase_cancel_date']);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $purchase['purchases']['purchase_first_year']);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $purchase['purchases']['final_last_remark']);


	$i++;
	}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('OP Purchase');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);

$dsql = "SELECT * FROM domestics where deleted=0";
	$dsqlName = $this->Purchase->query($dsql);

	$i = 2;
	$objPHPExcel->getActiveSheet()->setCellValue('A1', "ID");
	$objPHPExcel->getActiveSheet()->setCellValue('B1', "sales_day");
	$objPHPExcel->getActiveSheet()->setCellValue('C1', "auction_name");
	$objPHPExcel->getActiveSheet()->setCellValue('D1', "indentification");
	$objPHPExcel->getActiveSheet()->setCellValue('E1', "model");
	$objPHPExcel->getActiveSheet()->setCellValue('F1', "price");
	$objPHPExcel->getActiveSheet()->setCellValue('G1', "unit");
	$objPHPExcel->getActiveSheet()->setCellValue('H1', "car_price");
	$objPHPExcel->getActiveSheet()->setCellValue('I1', "exhibition");
	$objPHPExcel->getActiveSheet()->setCellValue('J1', "contact_fee");
	$objPHPExcel->getActiveSheet()->setCellValue('K1', "remark");
	$objPHPExcel->getActiveSheet()->setCellValue('L1', "payment_day");
	$objPHPExcel->getActiveSheet()->setCellValue('M1', "payment_bank");
	$objPHPExcel->getActiveSheet()->setCellValue('N1', "payment_amount");
	$objPHPExcel->getActiveSheet()->setCellValue('O1', "final_last_remark");
	

	foreach($dsqlName as $purchase){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $purchase['domestics']['id']);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $purchase['domestics']['sales_day']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $purchase['domestics']['auction_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $purchase['domestics']['indentification']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $purchase['domestics']['model']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $purchase['domestics']['price']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $purchase['domestics']['unit']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $purchase['domestics']['car_price']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $purchase['domestics']['exhibition']);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $purchase['domestics']['contact_fee']);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $purchase['domestics']['remark']);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $purchase['domestics']['payment_day']);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $purchase['domestics']['payment_bank']);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $purchase['purchases']['payment_amount']);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $purchase['purchases']['final_last_remark']);
	$i++;
	}

//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('OP Domestic');




//////////////////////////////////////////////////



// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);

$osql = "SELECT * FROM overseas_sales where deleted=0";
	$osqlName = $this->Purchase->query($osql);

	$i = 2;
	$cols = array();

	foreach($osqlName as $key=>$purchase){
        $rows[] = key($purchase['overseas_sales']);

	$i++;
	}


print_r($rows);
exit;

//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('OP Domestic');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel;  charset=UTF-8');  
header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
                 
                                
	}
	
	
}
