<?php
// include header
include "header.php";
// set the tpl page
$page = "home.tpl"; 

$module = $_GET['module'];
$act = $_GET['act']; 

$queryStock = "SELECT B.supplierName,A.stock FROM `as_stock_products` A INNER JOIN as_suppliers B WHERE A.supplierID = B.supplierID AND A.supplierID IS NOT NULL GROUP BY A.supplierID;";
$result = mysqli_query($connect, $queryStock);
$dataStok = array();
while ($row = $result->fetch_assoc()) {
    $dataStok[] = $row;
}

$queryTrx = "SELECT B.supplierName,COUNT(A.soFaktur) as transaksi FROM `as_sales_order` A INNER JOIN as_suppliers B WHERE A.needDate = B.supplierID AND MONTH(A.createdDate) = MONTH(CURRENT_DATE());";
$resultTrx = mysqli_query($connect, $queryTrx);
$dataTrx = array();
while ($rowTrx = $resultTrx->fetch_assoc()) {
    $dataTrx[] = $rowTrx;
}

$queryProduct = "SELECT A.hpp, A.productCode, A.productName, SUM(B.stock) as stock, SUM(B.stock*A.hpp) as total FROM as_products A LEFT JOIN as_stock_products B ON A.productID=B.productID WHERE B.stock > 0 GROUP BY A.productID;";
$sqlProduct = mysqli_query($connect, $queryProduct);
$dataProduct = array();
while ($rowTrx = $sqlProduct->fetch_assoc()) {
    $dataProduct[] = $rowTrx;
}

$smarty->assign('sqlProduct', $dataProduct);
$smarty->assign('BarchartData', json_encode($dataTrx));
$smarty->assign('chartData', json_encode($dataStok));
$smarty->assign("monthSales", $monthSales);
$smarty->assign("todaySales", $todaySales);
$smarty->assign("msg", $_GET['msg']);
$smarty->assign("breadcumbTitle", "Home");
$smarty->assign("breadcumbTitleSmall", "Halaman utama aplikasi");
$smarty->assign("breadcumbMenuName", "Home");
$smarty->assign("breadcumbMenuSubName", "Dashboard");

// include footer
include "footer.php";
?>
