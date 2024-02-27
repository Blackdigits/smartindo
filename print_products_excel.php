<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'PHPExcel.php';
require_once 'includes/connection.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="select * from as_products ";
$hasil = mysqli_query($connect,$query);
 
// Set properties
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");

 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'No')
       ->setCellValue('B1', 'Propinsi')
       ->setCellValue('C1', 'Upah');
 
$baris = 2;
$no = 0;			
while($row=mysqli_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $row['productID'])
     ->setCellValue("B$baris", $row['productName'])
     ->setCellValue("C$baris", $row['hpp']);
$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="products.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 