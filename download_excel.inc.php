<?php
	include ("config.inc.php");
	if ($_GET){foreach($_GET as $key => $value){$$key = $value;}}
	if ($_POST){foreach($_POST as $key => $value){$$key = $value;}}

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Europe/London');
	
	if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

	/** Include PHPExcel */
	require_once './library/Classes/PHPExcel.php';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	// Border
	$sharedStyle1 = new PHPExcel_Style();
	$sharedStyle1->applyFromArray(
		array(
			  'borders' => array(
									'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
									'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
									'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
								)
			 ));
	
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("JabarSoft")
								 ->setLastModifiedBy("Andriyana")
								 ->setTitle("Office 2007 xlsx Test Document")
								 ->setSubject("Office 2007 xlsx Test Document")
								 ->setDescription("Test document for Office 2007 xlsx, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");
	
	$Qry=_mysql_query("select `field`, `primary` from reg_db_dwh_field where dbname='{$dbname}' and table_name='{$table_name}' order by `primary` desc , urutan asc");	

	$QJml=_mysql_query("select `field`, `primary` from reg_db_dwh_field where `primary`='1' and dbname='{$dbname}' and table_name='{$table_name}' order by `primary` desc, urutan asc ");	
	
	$JmlRowsPrimary=_mysql_num_rows($QJml);
	$JmlRows=_mysql_num_rows($Qry);
	$MainIsi="";
	$MainTd="";
	$JRecord=10;
	$i=1;

	foreach(range('A',$Ref->Abjad[$JmlRows-1]) as $columnID) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
	}
	$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A1:".$Ref->Abjad[$JmlRows-1].$JRecord);

	while($Isi=_mysql_fetch_array($Qry)){
		$wr=$Isi['primary']=="1"?"bgcolor='#cacaca'":"";
		$MainIsi.="<th $wr>{$Isi['field']}</th>";
		
		

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Ref->Abjad[$i-1].'1', $Isi['field'])
					->getStyle('A1:'.$Ref->Abjad[$JmlRows-1].'1')->getFont()->setBold(true)
					->getActiveSheet()->getStyle('A1:'.$Ref->Abjad[$JmlRows-1].$JRecord)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getActiveSheet()->getStyle('A1:'.$Ref->Abjad[$JmlRowsPrimary-1].$JRecord)->getFill()->getStartColor()->setARGB('339900');


		$ArrKolom=$Ref->Abjad[$i-1];	
		$i++;
	}
	
	


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.trim($table_name).'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>