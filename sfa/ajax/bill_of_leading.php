<?php  
include '../config.php';
 if(function_exists($_GET['function'])) {
    $_GET['function'](); 
 } else {
    $response=array(
        'status' => 500,
        'message' =>'Wrong params'
     );
    header('Content-Type: application/json');
    echo json_encode($response);
 } 

   function Hutang(){ 
        global $connect; 
		 $sqlTempSos = mysqli_query($connect, "SELECT * FROM as_sales_order WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]'"); 
         $dataSpb = mysqli_query($connect, "SELECT SUM(price*qty) AS Total FROM `as_detail_so` WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]';"); 
         if(mysqli_num_rows($dataSpb) > 0 ){  
                $dataSos = mysqli_fetch_array($sqlTempSos);
                $dataSoD = mysqli_fetch_array($dataSpb);
                $queryReceive = "INSERT INTO as_receivables(
                receiveNo,
                invoiceID,
                invoiceNo,
                customerID,
                customerName,
                customerAddress,
                receiveTotal ,
                incomingTotal,
                pajak,
                diskon,
                status,
                staffID,
                staffName,
                createdDate,
                createdUserID,
                modifiedDate,
                modifiedUserID)
                VALUES('$dataSos[soNo]',
                '$dataSos[soID]',
                '$dataSos[soFaktur]',
                '$dataSos[customerID]',
                '$dataSos[customerName]',
                '$dataSos[customerAddress]',
                '$dataSoD[Total]',
                '0',
                '$_POST[pajak]',
                '$_POST[diskon]',
                'Perlu Verifikasi',
                '$dataSos[needDate]',
                '$dataSos[staffName]',
                '$dataSos[createdDate]',
                '$dataSos[createdUserID]',
                '',
                '')";  

                $result = mysqli_query($connect, $queryReceive);  
               if($result) {
                  $response=array(
                     'status' => 1, 
                     'message' =>'Insert Success'
                  );
               }  else  {
                  $response=array(
                     'status' => 0,
                     'message' =>'Insert Failed.'
                  );
               }
         } else {
            $response=array(
                     'status' => 404,
                     'message' =>'Data not Found'
                  );
         } 
         header('Content-Type: application/json');
         echo json_encode($response);
   }
 
   function Cash(){ 
        global $connect; 
        $sqlTempSos = mysqli_query($connect, "SELECT * FROM as_sales_order WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]'"); 
        $dataSpb = mysqli_query($connect, "SELECT SUM(price*qty) AS Total FROM `as_detail_so` WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]';"); 
        if(mysqli_num_rows($dataSpb) > 0 ){  
               $dataSos = mysqli_fetch_array($sqlTempSos);
               $dataSoD = mysqli_fetch_array($dataSpb);
               $queryReceive = "INSERT INTO as_debts(
               debtNo,
               invoiceID,
               invoiceNo,
               supplierID,
               supplierName,
               supplierAddress,
               debtTotal,
               incomingTotal,
               pajak,
               diskon,
               status,
               staffID,
               staffName,
               createdDate,
               createdUserID,
               modifiedDate,
               modifiedUserID)
               VALUES('$dataSos[soNo]',
               '$dataSos[soID]',
               '$dataSos[soFaktur]',
               '$_COOKIE[supplierID]',
               '$_COOKIE[supplierName]',
               '$_COOKIE[supplierCode]',
               '$dataSoD[Total]',
               '0',
               '$_POST[pajak]',
               '$_POST[diskon]',
               'Belum Bayar',
               '$dataSos[needDate]',
               '$dataSos[staffName]',
               '$dataSos[createdDate]',
               '$dataSos[createdUserID]',
               '',
               '')";  

               $result = mysqli_query($connect, $queryReceive);  
              if($result) {
                 $response=array(
                    'status' => 1, 
                    'message' =>'Insert Success'
                 );
              }  else  {
                 $response=array(
                    'status' => 0,
                    'message' =>'Insert Failed.'
                 );
              }
        } else {
           $response=array(
                    'status' => 404,
                    'message' =>'Data not Found'
                 );
        }
        $total = $dataSoD['Total'] + $_POST['diskon'] - $_POST['pajak'];
        $result = mysqli_query($connect, "UPDATE as_suppliers SET balance = balance + $total WHERE supplierID = $_COOKIE[supplierID]"); 
        $total += $_COOKIE['balance'];
        setcookie('balance', $total, time()+86400, '/');
        header('Content-Type: application/json');
        echo json_encode($response);
   }

   function Transfer(){ 
        global $connect; 
		 $sqlTempSos = mysqli_query($connect, "SELECT * FROM as_sales_order WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]'"); 
         $dataSpb = mysqli_query($connect, "SELECT SUM(price*qty) AS Total FROM `as_detail_so` WHERE soNo = '$_POST[soNo]' AND soFaktur = '$_POST[soFaktur]';"); 
         if(mysqli_num_rows($dataSpb) > 0 ){  
                $dataSos = mysqli_fetch_array($sqlTempSos);
                $dataSoD = mysqli_fetch_array($dataSpb);
                $queryReceive = "INSERT INTO as_receivables(
                receiveNo,
                invoiceID,
                invoiceNo,
                customerID,
                customerName,
                customerAddress,
                receiveTotal ,
                incomingTotal,
                pajak,
                diskon,
                status,
                staffID,
                staffName,
                createdDate,
                createdUserID,
                modifiedDate,
                modifiedUserID)
                VALUES('$dataSos[soNo]',
                '$dataSos[soID]',
                '$dataSos[soFaktur]',
                '$dataSos[customerID]',
                '$dataSos[customerName]',
                '$dataSos[customerAddress]',
                '$dataSoD[Total]',
                '$dataSoD[Total]',
                '$_POST[pajak]',
                '$_POST[diskon]',
                'Perlu Verifikasi',
                '$dataSos[needDate]',
                '$dataSos[staffName]',
                '$dataSos[createdDate]',
                '$dataSos[createdUserID]',
                '',
                '')";  

                $result = mysqli_query($connect, $queryReceive);  
               if($result) {
                  $response=array(
                     'status' => 1, 
                     'message' =>'Insert Success'
                  );
               }  else  {
                  $response=array(
                     'status' => 0,
                     'message' =>'Insert Failed.'
                  );
               }
         } else {
            $response=array(
                     'status' => 404,
                     'message' =>'Data not Found'
                  );
         } 
         header('Content-Type: application/json');
         echo json_encode($response);
   }  
   
   function rebalancing(){
        global $connect;
        $cek_karyawan = mysqli_query($connect, "SELECT balance  FROM `as_suppliers` WHERE `supplierID` = $_POST[id] ");   
        if(mysqli_num_rows($cek_karyawan) > 0 ){
            $result = mysqli_fetch_array($cek_karyawan); 
            if($result)
            {
                $response=array(
                    'status' => 1,
                    'balance' => $result['balance'],
                    'message' =>'Update Success'               
                );
            } else {
                $response=array(
                    'status' => 0,
                    'message' =>'Wrong Parameter'                  
                );
            }
        } else {
             $response=array(
                    'status' => 400,
                    'message' =>'Data Not Found', 
             );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
   } 
 ?>