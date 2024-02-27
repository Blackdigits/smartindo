<?php
// include header
include "header.php"; 

$modified_date = date('Y-m-d H:i:s');
$staffID = $_SESSION['staffID'];
$level = $_SESSION['level'];
$productID = $_POST['productID'];
$gudang = $_POST['gudang'];
$stock = $_POST['stock'];
$numsFactory = $_POST['numsFactory'];

if ($productID != '' && $level == 1){
	
	for ($i = 1; $i <= $numsFactory; $i++)
	{
        $queryStock = "SELECT stock FROM as_stock_products WHERE productID = '$productID' AND factoryID = '$gudang[$i]' AND supplierID IS NULL";
        $sqlStock = mysqli_query($connect, $queryStock); 
        if (mysqli_num_rows($sqlStock) == 0) {
            $queryStocks = "INSERT INTO as_stock_products (	productID,
														factoryID,
                                                        staffID,
														stock,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$productID',
														'$gudang[$i]',
                                                        '$staffID',
														'$stock[$i]',
														'$modified_date',
														'$staffID',
														'',
														'')"; 
		    $sqlStocks = mysqli_query($connect, $queryStocks);
        } else {
            $queryUpdatePlus = "UPDATE as_stock_products SET stock = $stock[$i] WHERE factoryID = '$gudang[$i]' AND productID = $productID AND supplierID IS NULL;";
			$sqlUpdatePlus = mysqli_query($connect, $queryUpdatePlus);
        }
		
	}
	
	echo json_encode('OK');
}
exit();
?>