<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

require 'vendor/autoload.php'; 
$hostName	= "localhost";
$username	= "u606309387_smartindo";
$password	= "Smartindo0!";
$dbName		= "u606309387_cluster0";
date_default_timezone_set("Asia/Bangkok");
$connect = mysqli_connect($hostName,$username,$password,$dbName);

/*
if (empty($_GET['act']) OR empty($_GET['sfaID'])) {
    header('Location : report_stock_sales.php?msg=Data tidak ditemukan!');
} $sfaID = $_GET['sfaID'];

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0"); 
header('Content-Transfer-Encoding: binary');
header("Content-Disposition: attachment;filename=stocksfa.xlsx"); */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$yesterday = date("Y-m-d", time() - 60 * 60 * 24);
$spreadsheet = $reader->load("stocksfa.xlsx");

$namaSFA = $_GET['sfa'];
$sfaID = $_GET['sfaID'];
$dateto = date("Y-m-d"); 

$NOstyle = [
    'font' => [
        'bold' => false,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
    ],
     'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];
 
$sheet = $spreadsheet->getSheetByName('Sheet1'); 
$querySales = "SELECT B.productName, B.purchasePrice, A.supplierID, A.productID, A.stock FROM `as_stock_products` A INNER JOIN as_products B WHERE A.productID = B.productID AND A.supplierID = $sfaID ORDER BY B.productName, B.categoryID;";
$sqlSales = mysqli_query($connect, $querySales); $i = 1;
while ($rw = mysqli_fetch_array($sqlSales)) { $i++;
    $spreadsheet->getActiveSheet()->insertNewRowBefore(2, 1);
    $sid =  $rw['supplierID']; 
    $pid =  $rw['productID']; 
    $stock =  $rw['stock'];
    // echo $pid.' ~ '.$sid.' ~ '.$dateto;
    $nama_produk =  $rw['productName']; 
    $sheet->setCellValue('A2', $nama_produk);
    $harga =  $rw['purchasePrice'];
    $sheet->setCellValue('F2', $harga); 

    // record today stock
    $dupCheck = "SELECT id FROM `as_stock_record` WHERE `supplierID` = $sid AND `productID` = $pid AND `stock` = $stock AND date = CURRENT_DATE();";
    $Rcheck = mysqli_query($connect, $dupCheck);
    if (mysqli_num_rows($Rcheck) == 0) { 
        $stackRecord = "INSERT INTO `as_stock_record` (`supplierID`, `productID`, `stock`, `date`) VALUES ($sid, $pid, $stock, CURRENT_DATE());";
        mysqli_query($connect, $stackRecord); 
    }

    // get yesterday stock 
    $lastStock = "SELECT stock FROM `as_stock_record` WHERE `supplierID` = $sid AND `productID` = $pid and date = '$yesterday';";
    $laststok = mysqli_query($connect, $lastStock);
    if (mysqli_num_rows($laststok) > 0) {   
        $lasted = mysqli_fetch_array($laststok); 
        $sheet->setCellValue('B2', $lasted['stock']);
    }  $sheet->setCellValue('B2', '=E2+D2-C2');

    // get today sales
    $q = "SELECT * FROM `as_detail_so` WHERE productID = $pid AND createdUserID = $sid AND createdDate = '$dateto' GROUP BY productID;";
    $r = mysqli_query($connect, $q);
    if (mysqli_num_rows($r) > 0) {   
        $sales = mysqli_fetch_array($r);
        $sheet->setCellValue('D2', $sales['qty']);
    } else { $sheet->setCellValue('D2', '0'); }

    // inquery stock assign
    $ms = "SELECT SUM(qty) as qty FROM `as_spb` A INNER JOIN as_detail_spb B WHERE A.spbFaktur = B.spbFaktur AND A.`supplierID` = $sid AND A.`createdDate` = '$dateto' AND B.productID = $pid;";
    $stacked = mysqli_query($connect, $ms);
    if (mysqli_num_rows($stacked) > 0) {   
        $stack = mysqli_fetch_array($stacked);
        $sheet->setCellValue('C2', $stack['qty']);
    } else { $sheet->setCellValue('C2', '0'); }
    
    $sheet->setCellValue('E2', $stock);
    $sheet->setCellValue('G2', '=F2*E2');

    $sheet->getStyle('A2:G2')->applyFromArray($NOstyle);
} $i++;

$sheet->setCellValue('G'.$i, '=SUM(G2:G'.$i.')');
$sheet->setCellValue('A'.$i, $namaSFA);
$sheet->setCellValue('C'.$i, $dateto);

echo $yesterday;
$writer = new Xlsx($spreadsheet);
$writer->save('stoksfa/'.$namaSFA.'_'.$dateto.'.xlsx');

if (!empty($_GET['cron'])) {
    echo $namaSFA.' OKE';
} else {
    $host  = $namaSFA;
    $uri   = '_'.$dateto;
    $extra = '.xlsx';
    header("Location: https://docs.google.com/viewerng/viewer?hl=en&url=https://smartindo.online/exceler/stoksfa/$host$uri$extra"); 
}
