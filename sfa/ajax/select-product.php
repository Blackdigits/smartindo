<?php
$supID = $_COOKIE['supplierID'];
 include '../config.php';   
 $idp = $_GET['value']; 
 $query ="SELECT B.stock AS stok FROM `as_products` A INNER JOIN as_stock_products B ON A.productID = B.productID WHERE A.productID = '$idp' AND B.supplierID = '$supID'";      
 $result = $connect->query($query); 
 $row = mysqli_fetch_array($result);
 // query kurangi stok?>
 <input type="hidden" id="quantity" value="<?= $row['stok'] ?>">
 