<?php
 include '../config.php';   
 $soNo = $_GET['soNo'];
 $soFaktur = $_GET['soFaktur'];
 $productID = $_POST['productID']; 
 $productName = $_POST['productName'];
 $price = $_POST['price']; 
 $qty = $_POST['qty'];
 $createdDate = date('Y-m-d H:i:s');
 $createdUserID = $_COOKIE['supplierCode'];
 if (!empty($_GET['soNo']) AND !empty($_GET['soFaktur'])) { 
    $querySaveSo = "INSERT INTO as_detail_so (	
                soNo,
                soFaktur,
                productID,
                productName,
                price,
                qty,
                note,
                createdDate,
                createdUserID,
                modifiedDate,
                modifiedUserID)
        VALUES(	'$soNo',
                '$soFaktur',
                '$productID',
                '$productName',
                '$price',
                '$qty',
                '',
                '$createdDate',
                '$createdUserID',
                '',
                '')";
    $save = mysqli_query($connect, $querySaveSo);
    $last_id = $connect->insert_id;
    if ($save) {
        echo $last_id; 
        $queryUpdateMin = "UPDATE as_stock_products SET stock = stock-$qty WHERE productID = $productID AND supplierID = $_COOKIE[supplierID];";
        $sqlUpdateMin = mysqli_query($connect, $queryUpdateMin);
    } else {
        echo '0';
    }
} else {
    echo '0';
}