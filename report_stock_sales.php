<?php
// include header
include "header.php";
// set the tpl page
$page = "report_stock_sales.tpl";

$module = $_GET['module'];
$act = $_GET['act'];

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '17'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
	
	// if the module is stock product and act is search
	if ($module == 'stocksales' && $act == 'search')
	{
		$categoryID = $_GET['categoryID'];
		
		$smarty->assign("categoryID", $categoryID);
		
		$qCat = "SELECT supplierName FROM as_suppliers WHERE supplierID = '$categoryID'";
		$sCat = mysqli_query($connect, $qCat);
		$dCat = mysqli_fetch_array($sCat);
		
		if ($categoryID != '')
		{
			$smarty->assign("categoryName", $dCat['supplierName']);
		}
		else
		{
			$smarty->assign("categoryName", 'Semua Sales');
		}
		
		
		// show the category data
		$queryCategory = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['supplierID'],
									'categoryName' => $dtCategory['supplierName']);
		}
        $smarty->assign("dataCategory", $dataCategory);

		if ($categoryID != '')
		{ 
            $queryStock = "SELECT * FROM as_products WHERE productID IN (SELECT productID FROM as_stock_products WHERE supplierID = $categoryID AND supplierID IS NOT NULL AND stock > 0) ORDER BY productCode ASC"; 
            $queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryID ASC";
            $queryFac = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryID ASC"; 
            $sqlFac = mysqli_query($connect, $queryFac);
            while ($dtFac = mysqli_fetch_array($sqlFac))
            {
                $dataFac[] = array(	'factoryID' => $dtFac['factoryID'],
                                    'factoryName' => $dtFac['factoryName']
                                    );
            }
		}
		else
		{ 
            $queryStock = "SELECT * FROM as_products WHERE productID IN (SELECT productID FROM as_stock_products WHERE stock > 0) ORDER BY productCode ASC"; 
            $queryFactory = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
            $queryFac = "SELECT * FROM as_suppliers ORDER BY supplierName ASC";
            $sqlFac = mysqli_query($connect, $queryFac);
            while ($dtFac = mysqli_fetch_array($sqlFac))
            {
                $dataFac[] = array(	'factoryID' => $dtFac['supplierID'],
                                    'factoryName' => $dtFac['supplierName']
                                    );
            }
		}
 
		$smarty->assign("dataFac", $dataFac); 
		$sqlStock = mysqli_query($connect, $queryStock);
		
		
		// create new object pagination
		$p = new PaginationStockSales; 
		$limit  = mysqli_num_rows($sqlStock);
		$position = $p->searchPosition($limit);
		
		// fetch data
		$i = 1 + $position;
		while ($dtStock = mysqli_fetch_array($sqlStock))
		{
			$dataFactory = array();
			$total = array();
			
			$sqlFactory = mysqli_query($connect, $queryFactory);
			while ($dtFactory = mysqli_fetch_array($sqlFactory))
			{   
                if ($categoryID != '')
                {
                    $querySP = "SELECT SUM(stock) as total, stock FROM as_stock_products WHERE productID = '$dtStock[productID]' AND factoryID = '$dtFactory[factoryID]' AND supplierID = $categoryID";
                    $sqlSP = mysqli_query($connect, $querySP);
                    $dtSP = mysqli_fetch_array($sqlSP);
                    
                    $total[] = $dtSP['total'];
                    
                    $dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
                                            'factoryName' => $dtFactory['factoryName'],
                                            'stock' => $dtSP['stock']
                                            );
                }
                else
                {
                $querySP = "SELECT SUM(stock) as total, stock FROM as_stock_products WHERE productID = '$dtStock[productID]' AND supplierID = $dtFactory[supplierID]";
				$sqlSP = mysqli_query($connect, $querySP);
				$dtSP = mysqli_fetch_array($sqlSP);
				
				$total[] = $dtSP['total'];
				
				$dataFactory[] = array(	'factoryID' => $dtFactory['supplierID'],
										'factoryName' => $dtFactory['supplierName'],
										'stock' => $dtSP['stock']
										);
                } 
			}
			 
			$unit = $dtStock['hpp'] * array_sum($total);
			$dataStock[] = array(	'productID' => $dtStock['productID'],
									'productName' => $dtStock['productCode']." ".$dtStock['productName'],
									'unit' => rupiah($unit),
									'price1' => rupiah($dtStock['unitPrice1']),
									'price2' => rupiah($dtStock['unitPrice2']),
									'price3' => rupiah($dtStock['unitPrice3']),
									'hpp' => rupiah($dtStock['hpp']),
									'factory' => $dataFactory,
									'total' => array_sum($total),
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataStock", $dataStock);
		 
		$queryCountSP = "SELECT * FROM as_products";  
		$sqlCountSP = mysqli_query($connect, $queryCountSP);
		$amountData = mysqli_num_rows($sqlCountSP);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Stok Produk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan stok produk.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Stok Produk");
	} 
	
	else
	{
		// show the category data
		$queryCategory = "SELECT * FROM as_suppliers ORDER BY supplierName  ASC";
		$sqlCategory = mysqli_query($connect, $queryCategory);
		
		while ($dtCategory = mysqli_fetch_array($sqlCategory))
		{
			$dataCategory[] = array('categoryID' => $dtCategory['supplierID'],
									'categoryName' => $dtCategory['supplierName']);
		}
		
		$smarty->assign("dataCategory", $dataCategory);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Laporan Stok Sales");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melihat laporan stok Sales.");
		$smarty->assign("breadcumbMenuName", "Laporan");
		$smarty->assign("breadcumbMenuSubName", "Stok Sales");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>