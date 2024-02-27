<?php
include '../includes/connection.php';

    #clearing DB
    $query1 = mysqli_query($connect, "DELETE FROM as_temp_detail_bbm");
    $query2 = mysqli_query($connect, "DELETE FROM as_temp_detail_so");
    $query3 = mysqli_query($connect, "DELETE FROM as_temp_detail_spb");
    $query4 = mysqli_query($connect, "DELETE FROM as_temp_detail_transfers"); 
    $query5 = mysqli_query($connect, "DELETE FROM as_bbm WHERE supplierName = '' OR supplierID = 0");
    $query6 = mysqli_query($connect, "DELETE FROM as_sales_order WHERE status = 'invalid'"); 

    function callExternalScript($getParams = []) { 
        $scriptUrl = 'https://smartindo.online/exceler/export_stock_sfa.php';
        $queryParams = http_build_query($getParams);
        $ch = curl_init(); 

        if (!empty($queryParams)) {  $scriptUrl .= '?' . $queryParams; } 
        curl_setopt($ch, CURLOPT_URL, $scriptUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch); 
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }   curl_close($ch); 
        return $response;
    } 

    $querySFA = mysqli_query($connect, "SELECT supplierID,supplierName FROM `as_suppliers`;"); 
    while ($row = mysqli_fetch_array($querySFA)) {
        $getParams = ['sfa' => $row['supplierName'], 'sfaID' => $row['supplierID'], 'cron' => 'true'];
        $result = callExternalScript($getParams);
        echo $result;
    }