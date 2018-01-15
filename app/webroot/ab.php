<?php
require_once ROOT_DIR.'/vendors/PHPExcel/Classes/PHPExcel.php';
require_once ROOT_DIR.'/vendors/PHPExcel/Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Something 1');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Something 2');
$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Something 2');
$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Something 3');
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Something 5');
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Something 7');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Name of Sheet 1');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Second sheet');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
