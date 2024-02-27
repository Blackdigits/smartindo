
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
require 'vendor/autoload.php';
ob_start();
include '../includes/connection.php';
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connect -> connect_error;
  exit();
} 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_TIME, 'id_ID'); 
$harini = date('d F Y');
$whoops->register();

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load("input.xlsx");
$dateto = date("d-M-y"); $i = 16;
$date = date("Y-m-d"); //  "2023-09-18";

$styleLining = [
    'font' => [
        'bold' => true,
        'underline' => true,
    ], 
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 
        'startColor' => [
            'argb' => 'D9E1F2',
        ], 
    ],
];

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

$bold = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ], 
];

$stylePiutang = [
    'font' => [
        'bold' => false,
        'underline' => false,
    ], 
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 
        'startColor' => [
            'argb' => 'fffbe5d6',
        ], 
    ],
];


$querySFA = mysqli_query($connect, "SELECT supplierID,supplierName FROM `as_suppliers`;");
$listOfSFA = [];
while ($row = mysqli_fetch_array($querySFA, MYSQLI_ASSOC)) {
    $listOfSFA[$row['supplierID']] = $row;
} //print("<pre>".print_r($listOfSFA,true)."</pre>");

function namaSFA($targetID) {
    global $listOfSFA;
    foreach ($listOfSFA as $item) {
        if ($item['supplierID'] == $targetID) {
            return $item['supplierName'];
        }
    } return null; 
} // echo namaSFA(13);

function cetak($data){ print("<pre>".print_r($data,true)."</pre>"); }
$sheet = $spreadsheet->getSheetByName('laporan');
$sheet->setCellValue('E1', $harini); 

$sqlTOPSFA = mysqli_query($connect,"SELECT * FROM `as_buy_payments` WHERE `payType` = '2' AND `createdDate` = '$date' ORDER BY `paymentID` ASC");
while ($rowTOP = mysqli_fetch_array($sqlTOPSFA, MYSQLI_ASSOC)) { $i++;
    if ($rowTOP['effectiveDate'] == '0000-00-00') { $effectiveDate = " ";}else {$effectiveDate = date("d-M-y", strtotime($rowTOP['effectiveDate']));}
    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1); 
    $sheet->setCellValue('A'.$i, $effectiveDate);
    $sheet->setCellValue('B'.$i, 'SETORAN SALES');
    $sheet->setCellValue('C'.$i, $rowTOP['total']);
    $sheet->setCellValue('D'.$i, $rowTOP['bankName'].' '.$rowTOP['bankAC']);
    $sheet->setCellValue('E'.$i, $rowTOP['supplierName']);
    $sheet->setCellValue('F'.$i, $rowTOP['note']); 
    $sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($NOstyle);
} // transfer dari toko
$sqlTRFTOKO = mysqli_query($connect,"SELECT * FROM `as_sales_payments` WHERE `payType` LIKE '2' AND `createdDate` = '$date' ORDER BY `paymentID` ASC");
while ($rowTRF = mysqli_fetch_array($sqlTRFTOKO, MYSQLI_ASSOC)) { $i++;
    if ($rowTRF['effectiveDate'] == '0000-00-00') { $effectiveDate = " ";} else {$effectiveDate =  date("d-M-y", strtotime($rowTRF['effectiveDate'])); }
    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
    $sheet->setCellValue('A'.$i, $effectiveDate);
    $sheet->setCellValue('B'.$i, $rowTRF['customerName']);
    $sheet->setCellValue('C'.$i, $rowTRF['total']);
    $sheet->setCellValue('D'.$i, $rowTRF['bankName'].' '.$rowTRF['bankAC']);
    $sheet->setCellValue('E'.$i, $rowTRF['staffName']);
    $sheet->setCellValue('F'.$i, $rowTRF['note']); 
    $sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($NOstyle);
} $i++;
 
$sheet->setCellValue('A'.$i, 'TOTAL');
$sheet->setCellValue('C'.$i, '=SUM(C17:C'.$i.')');
$sheet->setCellValue('C5', '=C'.$i); 
$sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($bold); $i++;
$spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
$i += 3;
$s=0;
$totality = 0;
$total_unit = 0; 
$querySales = "SELECT factory,pajak,GROUP_CONCAT(soFaktur) as faktur FROM `as_sales_order` WHERE `status` != 'Invalid' AND orderDate = '$date' AND factory != 'SFA' GROUP BY factory;";
$sqlSales = mysqli_query($connect, $querySales); 
while ($rw = mysqli_fetch_array($sqlSales)) { $s++;
    $name =  $rw['factory']; 

    $q = "SELECT *,SUM(qty) as qty FROM `as_detail_so` WHERE soFaktur IN ('$rw[faktur]') AND createdDate = '$date' GROUP BY productID";
    $r = mysqli_query($connect, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connect));

    while ( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) { $s++;
        $produk = $row['productName'];
        $harga = $row['price'];
        $unit = $row['qty']; 
        $total = $harga*$unit; 
        $keterangan = $row['note']; 
        $totality = $totality +$total;
        $total_unit = $total_unit + $unit;

        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);

        $sheet->setCellValue('A'.$i, $produk);
        $sheet->setCellValue('B'.$i, $name); 
        $sheet->setCellValue('C'.$i, $harga); 
        $sheet->setCellValue('D'.$i, $unit); 
        $sheet->setCellValue('E'.$i, $total); 
        $sheet->setCellValue('F'.$i, $keterangan);  
        $sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($NOstyle); 
        }

    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
    $spreadsheet->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($styleLining);
    if ($rw['pajak'] > 0) {
        $spreadsheet->getActiveSheet()->getComment('F'.$i)->getText()->createTextRun('Pajak : '.$rw['pajak']);
    }  $sheet->setCellValue('A'.$i, $name); }

$querySales = "SELECT SUM(pajak) as pajak,soFaktur,needDate FROM `as_sales_order` WHERE `status` != 'Invalid' AND orderDate = '$date' AND factory = 'SFA' GROUP BY needDate;";
$sqlSales = mysqli_query($connect, $querySales);
while ($rw = mysqli_fetch_array($sqlSales)) { $s++;
    $name =  namaSFA($rw['needDate']);
    $sid =  $rw['needDate']; 

    $q = "SELECT *,SUM(qty) as qty FROM `as_detail_so` WHERE createdUserID = $sid AND createdDate = '$date' GROUP BY productID";
    $r = mysqli_query($connect, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connect));
    

    while ( $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) { $s++;
        $produk = $row['productName'];
        $harga = $row['price'];
        $unit = $row['qty']; 
        $total = $harga*$unit; 
        $keterangan = $row['note']; 
        $totality = $totality +$total;
        $total_unit = $total_unit + $unit;

        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);

        $sheet->setCellValue('A'.$i, $produk);
        $sheet->setCellValue('B'.$i, $name); 
        $sheet->setCellValue('C'.$i, $harga); 
        $sheet->setCellValue('D'.$i, $unit); 
        $sheet->setCellValue('E'.$i, $total); 
        $sheet->setCellValue('F'.$i, $keterangan);  
        $sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($NOstyle);

        }

    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
    $spreadsheet->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($styleLining);
    if ($rw['pajak'] > 0) {
        $spreadsheet->getActiveSheet()->getComment('F'.$i)->getText()->createTextRun('Pajak : '.$rw['pajak']);
    }  $sheet->setCellValue('A'.$i, $name); 

} $i=$i+$s;

    $sheet->insertNewRowBefore($i, 1);
    $sheet->setCellValue('A'.$i, 'TOTAL'); 
    $sheet->setCellValue('C6', $totality);
    $sheet->setCellValue('E'.$i, $totality);
    $sheet->setCellValue('D'.$i, $total_unit);
    $sheet->getStyle('A'.$i.':F'.$i)->applyFromArray($bold); 
    $sheet->getStyle('E'.$i)->getNumberFormat()->setFormatCode('#,##0');

$i += 4;
 
        $noStock = $i;
        $current_name = null;
        $queryStock = "SELECT B.productName,C.supplierName,D.factoryName,B.hpp,A.supplierID,A.productID,A.factoryID,A.stock\n"

        . "FROM `as_stock_products` A \n"

        . "INNER JOIN as_products B on A.productID = B.productID \n"

        . "LEFT JOIN as_suppliers C on A.supplierID = C.supplierID \n"
         
        . "RIGHT JOIN as_factories D on A.factoryID = D.factoryID 
        
        ORDER BY A.factoryID, A.supplierID, B.productName, B.categoryID;"; // WHERE A.supplierID IS NULL AND A.factoryID = 1 
        $sqlStock = mysqli_query($connect, $queryStock);  
        while ($rw = mysqli_fetch_array($sqlStock)) { 

            $harga = $rw['hpp'];
            $stok = $rw['stock'];  
            $productID = $rw['productID'];
           
            if (is_null($rw['supplierID'])) {
            $kategori = $rw['factoryName']; $gdg = 0;
            } else { $kategori = $rw['supplierName']; }
             
            if ($current_name != $kategori) {
                $sheet->getStyle('A'.$noStock.':I'.$noStock)->applyFromArray($styleLining);
                $sheet->setCellValue('A'.$noStock, $kategori); $noStock++;
                $current_name = $kategori;
            } // pemisah batas kategori
            
            if (is_null($rw['supplierID'])) { $factoryID = $rw['factoryID'];

                $sqlRetur = mysqli_query($connect, "SELECT SUM(qty) as qty FROM `as_detail_retur_suppliers` WHERE `factoryID` = $factoryID AND `productID` = $productID AND modifiedDate = '$date';");
                $queryRetur = mysqli_fetch_array($sqlRetur);
                $masuk = $queryRetur['qty']; // Query retur
                
                $sqlABM =  mysqli_query($connect, "SELECT SUM(receiveQty) as qty FROM `as_detail_bbm` WHERE `factoryID` = $factoryID AND `productID` = $productID AND createdDate LIKE '%$date%';");
                $queryABM = mysqli_fetch_array($sqlABM);
                $alokasi = $queryABM['qty']; // Query Alokasi
                
                $sqlSO = mysqli_query($connect, "SELECT SUM(B.qty) as qty FROM `as_sales_order` A INNER JOIN as_detail_so B WHERE A.soNo = B.soNo AND A.`factory` LIKE '$kategori' AND A.`status` NOT LIKE 'Invalid' AND B.productID = $productID AND A.orderDate = '$date';");
                $querySO = mysqli_fetch_array($sqlSO);
                $penjualan =  $querySO['qty']; // Query Sales

                $sqlTRF = mysqli_query($connect, "SELECT SUM(B.qty) as qty FROM `as_transfers` A INNER JOIN as_detail_transfers B WHERE A.transferFaktur = B.transferFaktur AND A.`transferFrom` = $factoryID AND B.productID = $productID AND B.createdDate LIKE '%$date%';");
                $queryTRF = mysqli_fetch_array($sqlTRF);
                $pindah_gudang = $queryTRF['qty']; // Query Transfer 

                $sqlSPB =  mysqli_query($connect, "SELECT SUM(B.qty) as qty FROM `as_spb` A INNER JOIN as_detail_spb B WHERE A.spbFaktur = B.spbFaktur AND A.`status` = 'Sukses' AND A.`factoryID` = $factoryID AND B.productID = $productID AND A.createdDate = '$date';");
                $querySPB = mysqli_fetch_array($sqlSPB);
                $sales = $querySPB['qty']; // Query SPB / Mutasi Stok

            } else {   $supplierID = $rw['supplierID']; 

                $sqlSPB = mysqli_query($connect, "SELECT SUM(qty) as qty FROM `as_detail_spb` WHERE `productID` = $productID AND `modifiedUserID` = $supplierID AND createdDate = '$date';;");
                $querySPB = mysqli_fetch_array($sqlSPB);
                $masuk = $querySPB['qty']; // SPB / in

                $alokasi = 0;

                $sqlSO =  mysqli_query($connect, "SELECT SUM(qty) as qty FROM `as_detail_so` WHERE `productID` = $productID AND `modifiedUserID` = $supplierID AND createdDate = '$date';");
                $querySO = mysqli_fetch_array($sqlSO);
                $penjualan =$querySO['qty']; // SO / out

                $sqlTRF =  mysqli_query($connect, "SELECT SUM(qty) as qty FROM `as_detail_retur_suppliers` WHERE `productID` = $productID AND `createdUserID` = $supplierID AND modifiedDate = '$date';");
                $queryTRF = mysqli_fetch_array($sqlTRF);
                $pindah_gudang = $queryTRF['qty']; // retur / out

                $sales = 0;
                
            } // Date not yet filtered
            
            
            $sheet->setCellValue('A'.$noStock, $rw['productName']);
            $sheet->setCellValue('B'.$noStock, $kategori); 
            $sheet->setCellValue('D'.$noStock, $masuk);         //in
            $sheet->setCellValue('E'.$noStock, $alokasi);       //in
            $sheet->setCellValue('F'.$noStock, $penjualan);     //out
            $sheet->setCellValue('G'.$noStock, $pindah_gudang); //out
            $sheet->setCellValue('H'.$noStock, $sales);         //out
            $sheet->setCellValue('I'.$noStock, $stok);          //?? 

           $sheet->setCellValue('C'.$noStock, '=D'.$noStock.'+E'.$noStock.'-F'.$noStock.'-G'.$noStock.'-H'.$noStock.'-I'.$noStock);
            
            $sheet->setCellValue('J'.$noStock, $harga);
            $sheet->setCellValue('K'.$noStock, '=I'.$noStock.'*J'.$noStock);
            $sheet->getStyle('K'.$noStock)->getNumberFormat()->setFormatCode('Rp#,##0');
            $sheet->getStyle('A'.$noStock.':I'.$noStock)->applyFromArray($NOstyle);
        
            $noStock++; 
        }
            $sheet->setCellValue('B'.$noStock, 'TOTAL');
            $sheet->setCellValue('C'.$noStock, '=SUM(C'.$i.':C'.$noStock.')');
            $sheet->setCellValue('D'.$noStock, '=SUM(D'.$i.':D'.$noStock.')');
            $sheet->setCellValue('E'.$noStock, '=SUM(E'.$i.':E'.$noStock.')');
            $sheet->setCellValue('F'.$noStock, '=SUM(F'.$i.':F'.$noStock.')');
            $sheet->setCellValue('G'.$noStock, '=SUM(G'.$i.':G'.$noStock.')');
            $sheet->setCellValue('H'.$noStock, '=SUM(H'.$i.':H'.$noStock.')');
            $sheet->setCellValue('I'.$noStock, '=SUM(I'.$i.':I'.$noStock.')');
            $sheet->getStyle('I'.$noStock)->getNumberFormat()->setFormatCode('Rp#,##0');
            $sheet->getStyle('A'.$noStock.':I'.$noStock)->applyFromArray($bold);

$sheet = $spreadsheet->getSheetByName('piutang');
  
    $sqlReceive = mysqli_query($connect, "SELECT * FROM `as_sales_order` A INNER JOIN as_receivables B WHERE A.soNo = B.receiveNo AND A.soFaktur = B.invoiceNo AND A.`note` LIKE 'Hutang' AND A.`status` LIKE 'Validasi';");  
    while ($receivable = mysqli_fetch_array($sqlReceive)) { 
        $sisa = $receivable['receiveTotal'] - ($receivable['incomingTotal'] + $receivable['reductionTotal']);
        $sfa = namaSFA($receivable['needDate']);
        $spreadsheet->getActiveSheet()->insertNewRowBefore(1, 1);
        $sheet->setCellValue('A2', $receivable['createdDate']);
        $sheet->setCellValue('B2', $sfa);
        $sheet->setCellValue('C2', $receivable['invoiceNo']);
        $sheet->setCellValue('D2', $receivable['customerName']);
        $sheet->setCellValue('E2', "-");
        $sheet->setCellValue('F2', $receivable['receiveTotal']);
        $sheet->getStyle('F2')->getNumberFormat()->setFormatCode('Rp#,##0');
        $sheet->setCellValue('G2', "");
        $sheet->setCellValue('H2', $sisa);
        $sheet->getStyle('H2')->getNumberFormat()->setFormatCode('Rp#,##0');
        $sheet->setCellValue('I2', ""); 
        $sheet->setCellValue('J2', "");
        $sheet->setCellValue('K2', ""); 
    }


$writer = new Xlsx($spreadsheet);
$writer->save('lapkeu/laporan_'.$dateto.'.xlsx');
if (!empty($_GET['cron'])) {
    header("Location: https://docs.google.com/viewerng/viewer?hl=en&url=https://smartindo.online/exceler/lapkeu/laporan_".$dateto.".xlsx");
} else {
    echo 'Lapkeu '.$harini;
}

/* SALES SHEET WRITTER
  
            $sheet->setCellValue('C'.$noStock, $rw['stock']);
            // $sheet->setCellValue('D'.$i, $MASUK); // MASUK
            // $sheet->setCellValue('E'.$i, $ALOKASI);
             $sheet->setCellValue("F".$noStock, 0);
            // $sheet->setCellValue('G'.$i, $PINDAH_GUDANG);
            $sheet->setCellValue('K'.$noStock, '=C'.$noStock.'+D'.$noStock.'+E'.$noStock.'-F'.$noStock.'-G'.$noStock.'-H'.$noStock.'-I'.$noStock.'-J'.$noStock);
            $sheet->setCellValue('L'.$noStock, $rw['hpp']);
            $sheet->setCellValue('M'.$noStock, '=K'.$noStock.'*L'.$noStock);

echo "=SUMIFS('SALES'!D17:'SALES'!D".$i.";'SALES'!A17:'SALES'!A".$i.";A".$noStock.";'SALES'!B17:'SALES'!".$i.";B".$noStock.")";
    // THIS FOR SUM TOTAL 
    $sheet->setCellValue('A'.$noStock, 'TOTAL'); 
    $sheet->setCellValue('C'.$noStock, '=SUM(C3:C'.$noStock.')');
    $sheet->setCellValue('K'.$noStock, '=SUM(K3:K'.$noStock.')');
    $sheet->setCellValue('M'.$noStock, '=SUM(M3:M'.$noStock.')');
    $sheet->getStyle('A'.$noStock.':M'.$noStock)->applyFromArray($bold); 

    */