<?php
// include header
include "header.php";
// set the tpl page
$page = "stock_opname.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '16'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is stock opname and action is delete
	if ($module == 'stockopname' && $act == 'delete')
	{
		// insert method into a variable
		$soID = $_GET['soID'];
		
		// show up the detail stock opname
		$querySo = "SELECT productStock, realStock, factoryID, productID FROM as_stock_opname WHERE soID = '$soID'";
		$sqlSo = mysqli_query($connect, $querySo);
		
		while ($dataSo = mysqli_fetch_array($sqlSo))
		{
			$qty = $dataSo['productStock'];
			
			// update stock product
			$queryStock = "UPDATE as_stock_products SET stock = '$qty' WHERE productID = '$dataSo[productID]' AND factoryID = '$dataSo[factoryID]'";
			mysqli_query($connect, $queryStock);
		}
		
		// delete stock opname
		$queryStockOpname = "DELETE FROM as_stock_opname WHERE soID = '$soID'";
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		
		// redirect to the stock opname page
		header("Location: stock_opname.php?msg=Data stock opname berhasil dihapus");
	} // close bracket
	
	// if the module is stock opname and the act is add
	elseif ($module == 'stockopname' && $act == 'add')
	{
		$smarty->assign("soDate", tgl_indo2(date('Y-m-d')));
		
		$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryCode ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		// fetch data
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']);
		}

		$smarty->assign("dataFactory", $dataFactory);
		
		$smarty->assign("factoryID", $_GET['factoryID']);
		$_SESSION['factorID'] = $_GET['factoryID'];
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Stock Opname");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan stock opname.");
		$smarty->assign("breadcumbMenuName", "Stock Opname");
		$smarty->assign("breadcumbMenuSubName", "Add Stock Opname");
		$smarty->assign("pageNumber", $_GET['page']);
	} // close bracket
	
	// if the module is stock opname and the act is input
	elseif ($module == 'stockopname' && $act == 'input')
	{
		$createdDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		
		$sDate = explode("-", $_POST['soDate']);
		$soDate = $sDate[2]."-".$sDate[1]."-".$sDate[0];
		$factoryID = $_POST['factoryID'];
		$productID = $_POST['productID'];
		$productName = mysqli_real_escape_string($connect, $_POST['productName']);
		$productStock = $_POST['productStock'];
		$realStock = $_POST['realStock'];
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		
		$queryFactory = "SELECT factoryID, factoryCode, factoryName FROM as_factories WHERE factoryID = '$factoryID'";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		$dataFactory = mysqli_fetch_array($sqlFactory);
		
		$factoryName = $dataFactory['factoryCode']." ".$dataFactory['factoryName'];
		
		// save into the database
		$queryStockOpname = "INSERT INTO as_stock_opname (	soDate,
															productID,
															productName,
															factoryID,
															factoryName,
															productStock,
															realStock,
															note,
															staffID,
															staffName,
															createdDate,
															createdUserID,
															modifiedDate,
															modifiedUserID)
													VALUES(	'$soDate',
															'$productID',
															'$productName',
															'$factoryID',
															'$factoryName',
															'$productStock',
															'$realStock',
															'$note',
															'$staffID',
															'$sName',
															'$createdDate',
															'$staffID',
															'',
															'')";
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		
		$soID = mysqli_insert_id($connect);
		
		if ($sqlStockOpname)
		{
			$querySP = "UPDATE as_stock_products SET stock = '$realStock' WHERE factoryID = '$factoryID' AND productID = '$productID'";
			mysqli_query($connect, $querySP);
		}
		
		// redirect to the stock opname finish page
		header("Location: stock_opname.php?module=stockopname&act=finish&soID=".$soID."&msg=Data stock opname berhasil disimpan.");
	}
	
	// if module is stock opname and act is finish
	elseif ($module == 'stockopname' && $act == 'finish')
	{
		$soID = $_GET['soID'];
		
		// showing up the main stock opname
		$queryStockOpname = "SELECT * FROM as_stock_opname WHERE soID = '$soID'";
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		$dataStockOpname = mysqli_fetch_array($sqlStockOpname);
		
		// assign to the tpl
		$smarty->assign("soID", $dataStockOpname['soID']);
		$smarty->assign("soDate", tgl_indo2($dataStockOpname['soDate']));
		$smarty->assign("productID", $dataStockOpname['productID']);
		$smarty->assign("productName", $dataStockOpname['productName']);
		$smarty->assign("factoryID", $dataStockOpname['factoryID']);
		$smarty->assign("factoryName", $dataStockOpname['factoryName']);
		$smarty->assign("productStock", $dataStockOpname['productStock']);
		$smarty->assign("realStock", $dataStockOpname['realStock']);
		$smarty->assign("note", $dataStockOpname['note']);
		$smarty->assign("staffID", $dataStockOpname['staffID']);
		$smarty->assign("staffName", $dataStockOpname['staffName']);
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Stock Opname");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan stock opname.");
		$smarty->assign("breadcumbMenuName", "Stock Opname");
		$smarty->assign("breadcumbMenuSubName", "Detail Stock Opname");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is stock opname and act is detailstockopname
	elseif ($module == 'stockopname' && $act == 'detailstockopname')
	{
		$soID = $_GET['soID'];
		
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		// showing up the main stock opname
		$queryStockOpname = "SELECT * FROM as_stock_opname WHERE soID = '$soID'";
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		$dataStockOpname = mysqli_fetch_array($sqlStockOpname);
		
		// assign to the tpl
		$smarty->assign("soID", $dataStockOpname['soID']);
		$smarty->assign("soDate", tgl_indo2($dataStockOpname['soDate']));
		$smarty->assign("productID", $dataStockOpname['productID']);
		$smarty->assign("productName", $dataStockOpname['productName']);
		$smarty->assign("factoryID", $dataStockOpname['factoryID']);
		$smarty->assign("factoryName", $dataStockOpname['factoryName']);
		$smarty->assign("productStock", $dataStockOpname['productStock']);
		$smarty->assign("realStock", $dataStockOpname['realStock']);
		$smarty->assign("note", $dataStockOpname['note']);
		$smarty->assign("staffID", $dataStockOpname['staffID']);
		$smarty->assign("staffName", $dataStockOpname['staffName']);
		
		$smarty->assign("q", $q);
		
		// assign to the tpl
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Stock Opname");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan stock opname.");
		$smarty->assign("breadcumbMenuName", "Stock Opname");
		$smarty->assign("breadcumbMenuSubName", "Detail Stock Opname");
		$smarty->assign("pageNumber", $_GET['page']);
	}
	
	// if module is stock opname and act is cancel
	elseif ($module == 'stockopname' && $act == 'cancel')
	{
		$_SESSION['factorID'] = "";
		
		// redirect to the stock opname page
		header("Location: stock_opname.php?msg=Stock opname berhasil dibatalkan");
	} 
	
	// if the module is stockopname and act is search
	elseif ($module == 'stockopname' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the sales order data
		if ($sDate != '' && $eDate != '')
		{
			$queryStockOpname = "SELECT * FROM as_stock_opname WHERE productName LIKE '%$q%' AND soDate BETWEEN '$startDate' AND '$endDate' ORDER BY createdDate DESC";
		}
		else
		{
			$queryStockOpname = "SELECT * FROM as_stock_opname WHERE productName LIKE '%$q%' ORDER BY createdDate DESC";
		}
		
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		
		// fetch data
		$i = 1;
		while ($dtStockOpname = mysqli_fetch_array($sqlStockOpname))
		{
			$dataStockOpname[] = array(	'soID' => $dtStockOpname['soID'],
										'soDate' => tgl_indo2($dtStockOpname['soDate']),
										'productName' => $dtStockOpname['productName'],
										'factoryName' => $dtStockOpname['factoryName'],
										'productStock' => $dtStockOpname['productStock'],
										'realStock' => $dtStockOpname['realStock'],
										'staffName' => $dtStockOpname['staffName'],
										'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataStockOpname", $dataStockOpname);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Stock Opname");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan stock opname.");
		$smarty->assign("breadcumbMenuName", "Stock Opname");
		$smarty->assign("breadcumbMenuSubName", "Stock Opname");
	} 
	
	else
	{
		// create new object pagination
		$p = new PaginationStockOpname;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the stock opname data
		$queryStockOpname = "SELECT * FROM as_stock_opname ORDER BY createdDate DESC LIMIT $position,$limit";
		$sqlStockOpname = mysqli_query($connect, $queryStockOpname);
		
		// fetch data
		$i = 1 + $position;
		while ($dtStockOpname = mysqli_fetch_array($sqlStockOpname))
		{
			$dataStockOpname[] = array(	'soID' => $dtStockOpname['soID'],
										'soDate' => tgl_indo2($dtStockOpname['soDate']),
										'productName' => $dtStockOpname['productName'],
										'factoryName' => $dtStockOpname['factoryName'],
										'productStock' => $dtStockOpname['productStock'],
										'realStock' => $dtStockOpname['realStock'],
										'staffName' => $dtStockOpname['staffName'],
										'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataStockOpname", $dataStockOpname);
		
		// count data
		$queryCountStockOpname = "SELECT * FROM as_stock_opname";
		$sqlCountStockOpname = mysqli_query($connect, $queryCountStockOpname);
		$amountData = mysqli_num_rows($sqlCountStockOpname);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Stock Opname");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan stock opname.");
		$smarty->assign("breadcumbMenuName", "Stock Opname");
		$smarty->assign("breadcumbMenuSubName", "Stock Opname");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>