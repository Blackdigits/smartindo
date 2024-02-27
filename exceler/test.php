<?php

phpinfo();

include '../includes/connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
$i = 0; 
$total = 0;
$nama = null; 
$querySales = "SELECT * FROM `as_stock_products` WHERE supplierID = 15;";
$sqlSales = mysqli_query($connect, $querySales);  
while ($rw = mysqli_fetch_array($sqlSales)) {  
    $sid =  $rw['supplierID']; 
    $pid =  $rw['productID']; 
    $stock =  $rw['stock'];
     
    $dupCheck = "SELECT id FROM `as_stock_record` WHERE `supplierID` = $sid AND `productID` = $pid AND `stock` = $stock AND date = CURRENT_DATE();";
    $Rcheck = mysqli_query($connect, $dupCheck);
    if (mysqli_num_rows($Rcheck) == 0) { 
        $stackRecord = "INSERT INTO `as_stock_record` (`supplierID`, `productID`, `stock`, `date`) VALUES ($sid, $pid, $stock, CURRENT_DATE());";
        mysqli_query($connect, $stackRecord);
        mysqli_free_result($Rcheck); 
    } 
    // $q = "SELECT *,SUM(qty) as qty FROM `as_detail_so` WHERE createdUserID = $sid GROUP BY productID";
    // $r = mysqli_query($connect, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connect));
}