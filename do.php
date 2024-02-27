<?php
// include header
include "header.php";
// set the tpl page
$page = "do.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '29'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is do and action is delete
	if ($module == 'do' && $act == 'delete')
	{
		// insert method into a variable
		$doID = $_GET['doID'];
		$doNo = $_GET['doNo'];
		$doFaktur = $_GET['doFaktur'];
		
		$queryDo = "SELECT * FROM as_detail_do WHERE doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $queryDo);
		
		// fetch data
		while ($dataDo = mysqli_fetch_array($sqlDo))
		{
			$querySP = "UPDATE as_stock_products SET stock=stock+$dataDo[deliveredQty] WHERE productID = '$dataDo[productID]' AND factoryID = '$dataDo[factoryID]'";
			mysqli_query($connect, $querySP);
		}
		
		// delete do
		$queryDo2 = "DELETE FROM as_delivery_order WHERE doID = '$doID' AND doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDo2 = mysqli_query($connect, $queryDo2);
		
		// delete delivery order detail
		$queryDoDetail = "DELETE FROM as_detail_do WHERE doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		// redirect to the delivery order page
		header("Location: do.php?msg=Data bukti barang keluar berhasil dihapus");
	} // close bracket
	
	// if the module is do and act is input
	elseif ($module == 'do' && $act == 'input')
	{
		$doFaktur = $_SESSION['doFaktur'];
		$modifiedDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$doNo = $_POST['doNo'];
		$doID = $_POST['doID'];
		$soNo = $_POST['soNo'];
		$customerID = $_POST['customerID'];
		$customerName = $_POST['customerName'];
		$customerAddress = mysqli_real_escape_string($connect, $_POST['customerAddress']);
		$dDate = explode("-", $_POST['deliveredDate']);
		$deliveredDate = $dDate[2]."-".$dDate[1]."-".$dDate[0];
		$oDate = explode("-", $_POST['orderDate']);
		$orderDate = $oDate[2]."-".$oDate[1]."-".$oDate[0];
		$nDate = explode("-", $_POST['needDate']);
		$needDate = $nDate[2]."-".$nDate[1]."-".$nDate[0];
		$note = mysqli_real_escape_string($connect, $_POST['note']);
		$detailID = $_POST['detailID'];
		$countDetailID = COUNT($detailID);
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$price = $_POST['price'];
		$qty = $_POST['qty'];
		$deliveredQty = $_POST['deliveredQty'];
		$status = $_POST['status'];
		$factory = $_POST['factory'];
		$notedetail = $_POST['notedetail'];
		
		$dataSo = mysqli_fetch_array(mysqli_query($connect, "SELECT soID FROM as_sales_order WHERE soNo = '$soNo'"));
		
		for ($i = 0; $i < $countDetailID; $i++)
		{
			$f = explode("#", $factory[$i]);
			$factoryID = $f[0];
			$factoryName = $f[1]." ".$f[2];
			$productNm = mysqli_real_escape_string($connect, $productName[$i]);
			$notedet = mysqli_real_escape_string($connect, $notedetail[$i]);
			$total = $price[$i] * $deliveredQty[$i];
			
			if ($status[$i] == 'Y')
			{
				$queryInsert = "INSERT INTO as_detail_do (	doNo,
															doFaktur,
															productID,
															productName,
															price,
															qty,
															deliveredQty,
															deliveredStatus,
															factoryID,
															factoryName,
															note,
															createdDate,
															createdUserID)
													VALUES(	'$doNo',
															'$doFaktur',
															'$productID[$i]',
															'$productNm',
															'$price[$i]',
															'$qty[$i]',
															'$deliveredQty[$i]',
															'$status[$i]',
															'$factoryID',
															'$factoryName',
															'$notedet',
															'$modifiedDate',
															'$staffID')";
				
				mysqli_query($connect, $queryInsert);
				
				$queryStock = "UPDATE as_stock_products SET stock=stock-$deliveredQty[$i] WHERE factoryID = '$factoryID' AND productID = '$productID[$i]'";
				mysqli_query($connect, $queryStock);
				
				$grandtotal += $total;
			}
		}

		// update delivery order
		$queryDo = "UPDATE as_delivery_order SET	soID = '$dataSo[soID]', 
													soNo = '$soNo',
													customerID = '$customerID',
													customerName = '$customerName',
													customerAddress = '$customerAddress', 
													staffID = '$staffID',
													staffName = '$sName',
													deliveredDate = '$deliveredDate',
													orderDate = '$orderDate',
													needDate = '$needDate',
													total = '$grandtotal',
													note = '$note',
													modifiedDate = '$modifiedDate',
													modifiedUserID = '$staffID'
													WHERE doID = '$doID' AND doFaktur = '$doFaktur'";
										
		$sqlDo = mysqli_query($connect, $queryDo);

		$_SESSION['doFaktur'] = "";
		
		header("Location: do.php?module=do&act=finish&doNo=".$doNo."&doFaktur=".$doFaktur);
	}
	
	// if the module is do and act is detaildo
	elseif ($module == 'do' && $act == 'detaildo')
	{
		$doID = $_GET['doID'];
		$doFaktur = $_GET['doFaktur'];
		$doNo = $_GET['doNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryDo = "SELECT * FROM as_delivery_order WHERE doID = '$doID' AND doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $queryDo);
		$dataDo = mysqli_fetch_array($sqlDo);
		
		// assign to the tpl
		$smarty->assign("doFaktur", $dataDo['doFaktur']);
		$smarty->assign("doID", $dataDo['doID']);
		$smarty->assign("doNo", $dataDo['doNo']);
		$smarty->assign("soID", $dataDo['soID']);
		$smarty->assign("soNo", $dataDo['soNo']);
		$smarty->assign("customerID", $dataDo['customerID']);
		$smarty->assign("customerName", $dataDo['customerName']);
		$smarty->assign("customerAddress", $dataDo['customerAddress']);
		$smarty->assign("staffID", $dataDo['staffID']);
		$smarty->assign("staffName", $dataDo['staffName']);
		$smarty->assign("deliveredDate", tgl_indo2($dataDo['deliveredDate']));
		$smarty->assign("orderDate", tgl_indo2($dataDo['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataDo['needDate']));
		$smarty->assign("note", $dataDo['note']);
		
		// show the delivered order detail
		$queryDoDetail = "SELECT * FROM as_detail_do WHERE doNo = '$doNo' AND doFaktur = '$doFaktur' ORDER BY detailID ASC";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		$i = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			$dataDoDetail[] = array(	'detailID' => $dtDoDetail['detailID'],
										'doNo' => $dtDoDetail['doNo'],
										'doFaktur' => $dtDoDetail['doFaktur'],
										'productID' => $dtDoDetail['productID'],
										'productName' => $dtDoDetail['productName'],
										'price' => $dtDoDetail['price'],
										'qty' => $dtDoDetail['qty'],
										'deliveredQty' => $dtDoDetail['deliveredQty'],
										'status' => $dtDoDetail['deliveredStatus'],
										'factoryID' => $dtDoDetail['factoryID'],
										'factoryName' => $dtDoDetail['factoryName'],
										'note' => $dtDoDetail['note'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $_GET['q']);
		
		$smarty->assign("breadcumbTitle", "Delivery Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi delivery order.");
		$smarty->assign("breadcumbMenuName", "Delivery Order");
		$smarty->assign("breadcumbMenuSubName", "Delivery Order");
	}
	
	// if the module do and act is cancel
	elseif ($module == 'do' && $act == 'cancel')
	{
		$doFaktur = $_SESSION['doFaktur'];
		
		// delete delivery order
		$queryDo = "DELETE FROM as_delivery_order WHERE doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $queryDo);
		
		$_SESSION['doFaktur'] = "";
		
		header("Location: do.php?msg=Data delivery order dibatalkan.");
	}
	
	// if module do and act is finish
	elseif ($module == 'do' && $act == 'finish')
	{
		$doNo = $_GET['doNo'];
		$doFaktur = $_GET['doFaktur'];
		
		$queryDo = "SELECT * FROM as_delivery_order WHERE doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $queryDo);
		$dataDo = mysqli_fetch_array($sqlDo);
		
		$smarty->assign("doID", $dataDo['doID']);
		$smarty->assign("doNo", $dataDo['doNo']);
		$smarty->assign("doFaktur", $dataDo['doFaktur']);
		$smarty->assign("soID", $dataDo['soID']);
		$smarty->assign("soNo", $dataDo['soNo']);
		$smarty->assign("customerID", $dataDo['customerID']);
		$smarty->assign("customerName", $dataDo['customerName']);
		$smarty->assign("staffID", $dataDo['staffID']);
		$smarty->assign("staffName", $dataDo['staffName']);
		$smarty->assign("deliveredDate", tgl_indo2($dataDo['deliveredDate']));
		$smarty->assign("orderDate", tgl_indo2($dataDo['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataDo['needDate']));
		$smarty->assign("note", $dataDo['note']);
		
		// show the do detail
		$queryDoDetail = "SELECT * FROM as_detail_do WHERE doNo = '$doNo' AND doFaktur = '$doFaktur'";
		$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
		
		// fetch data
		$k = 1;
		while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
		{
			if ($dtDoDetail['deliveredStatus'] == 'Y')
			{
				$status = "Y";
			}
			else
			{
				$status = "N";
			}
			
			$dataDoDetail[] = array(	'detailID' => $dtDoDetail['detailID'],
										'doNo' => $dtDoDetail['doNo'],
										'doFaktur' => $dtDoDetail['doFaktur'],
										'productName' => $dtDoDetail['productName'],
										'price' => rupiah($dtDoDetail['price']),
										'qty' => $dtDoDetail['qty'],
										'deliveredQty' => $dtDoDetail['deliveredQty'],
										'status' => $status,
										'factoryName' => $dtDoDetail['factoryName'],
										'note' => $dtDoDetail['note'],
										'no' => $k 
										);
			$k++;
		}
		
		$smarty->assign("dataDoDetail", $dataDoDetail);
		
		$smarty->assign("breadcumbTitle", "Delivery Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi delivery order.");
		$smarty->assign("breadcumbMenuName", "Delivery Order");
		$smarty->assign("breadcumbMenuSubName", "Delivery Order");
	}
	
	// if the module do and act is add
	elseif ($module == 'do' && $act == 'add')
	{
		$doFaktur = $_SESSION['doFaktur'];
		
		// get last sort bbm number ID
		$queryNoDo = "SELECT doNo FROM as_delivery_order ORDER BY doNo DESC LIMIT 1";
		$sqlNoDo = mysqli_query($connect, $queryNoDo);
		$numsNoDo = mysqli_num_rows($sqlNoDo);
		$dataNoDo = mysqli_fetch_array($sqlNoDo);
		
		$start = substr($dataNoDo['doNo'],2-7);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoDo == '0')
		{
			$dNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$dNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$dNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$dNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$dNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$dNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$dNo = "";
		}
		
		$doNo = "DO".$dNo.$next;
		
		// count delivery order based on doNo
		$showDo = "SELECT * FROM as_delivery_order WHERE doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $showDo);
		$numsDo = mysqli_num_rows($sqlDo);
		
		if ($numsDo == 0)
		{
			$deliveredDate = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$queryDo = "INSERT INTO as_delivery_order (	doFaktur,
														doNo,
														soID,
														soNo,
														customerID,
														customerName,
														staffID,
														staffName,
														deliveredDate,
														orderDate,
														needDate,
														total,
														note,
														createdDate,
														createdUserID,
														modifiedDate,
														modifiedUserID)
												VALUES(	'$doFaktur',
														'$doNo',
														'',
														'',
														'',
														'',
														'$_SESSION[staffID]',
														'$sName',
														'$deliveredDate',
														'',
														'',
														'',
														'',
														'$createdDate',
														'$staffID',
														'',
														'')";
			mysqli_query($connect, $queryDo);
		}
		
		// count delivery order based on doNo
		$showDo = "SELECT * FROM as_delivery_order WHERE doFaktur = '$doFaktur'";
		$sqlDo = mysqli_query($connect, $showDo);
		$dataDo = mysqli_fetch_array($sqlDo);
		
		$smarty->assign("doNo", $dataDo['doNo']);
		$smarty->assign("doID", $dataDo['doID']);
		
		if ($dataDo['deliveredDate'] == '0000-00-00')
		{
			$deliveredDate = date('Y-m-d');
		}
		else
		{
			$deliveredDate = $dataDo['deliveredDate'];
		}
		
		$smarty->assign("deliveredDate", tgl_indo2($deliveredDate));
		$smarty->assign("note", $dataDo['note']);
		
		// show the sales order data based on soNo
		$soNo = mysqli_real_escape_string($connect, $_GET['soNo']);
		$querySo = "SELECT * FROM as_sales_order WHERE soNo = '$soNo'";
		$sqlSo = mysqli_query($connect, $querySo);
		$dataSo = mysqli_fetch_array($sqlSo);
		$numsSo = mysqli_num_rows($sqlSo);
		
		$smarty->assign("numsSo", $numsSo);
		
		// show the delivery order data
		$queryDo = "SELECT A.doID FROM as_delivery_order A INNER JOIN as_detail_do B ON B.doNo=A.doNo WHERE A.soNo = '$soNo'";
		$sqlDo = mysqli_query($connect, $queryDo);
		$numsDo = mysqli_num_rows($sqlDo);
		
		$smarty->assign("numsDo", $numsDo);
		
		// assign to the do tpl
		$smarty->assign("soNo", $soNo);
		$smarty->assign("customerName", $dataSo['customerName']);
		$smarty->assign("customerAddress", $dataSo['customerAddress']);
		$smarty->assign("customerID", $dataSo['customerID']);
		$smarty->assign("orderDate", tgl_indo2($dataSo['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataSo['needDate']));
		
		// show the so detail based on soNo
		$i = 1;
		$querySoDetail = "SELECT * FROM as_detail_so WHERE soNo = '$soNo' AND soFaktur = '$dataSo[soFaktur]'";
		$sqlSoDetail = mysqli_query($connect, $querySoDetail);
		while ($dataSoDetail = mysqli_fetch_array($sqlSoDetail))
		{
			$subtotal = $dataSoDetail['qty'] * $dataSoDetail['price'];
			
			// show the factories data
			$queryFactory = "SELECT A.factoryID, A.factoryCode, A.factoryName, B.stock FROM as_factories A LEFT JOIN as_stock_products B ON A.factoryID=B.factoryID WHERE A.status = 'Y' AND B.productID = '$dataSoDetail[productID]' ORDER BY A.factoryCode ASC";
			$sqlFactory = mysqli_query($connect, $queryFactory);
			
			$dataFactory = array();
			
			while ($dtFactory = mysqli_fetch_array($sqlFactory))
			{
				$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
										'factoryCode' => $dtFactory['factoryCode'],
										'factoryName' => $dtFactory['factoryName'],
										'stock' => $dtFactory['stock']);
			}
			
			$dataDetail[] = array(	'detailID' => $dataSoDetail['detailID'],
									'soNo' => $dataSoDetail['spbNo'],
									'soFaktur' => $dataSoDetail['spbFaktur'],
									'productID' => $dataSoDetail['productID'],
									'productName' => $dataSoDetail['productName'],
									'price' => $dataSoDetail['price'],
									'qty' => $dataSoDetail['qty'],
									'subtotal' => $subtotal,
									'note' => $dataSoDetail['note'],
									'dataFactory' => $dataFactory,
									'no' => $i
									);
			$i++;
		}
		
		// assign to the spb tpl
		$smarty->assign("dataDetail", $dataDetail);
		
		//$smarty->assign("dataFactory", $dataFactory);
		
		$smarty->assign("breadcumbTitle", "Delivery Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi delivery order.");
		$smarty->assign("breadcumbMenuName", "Delivery Order");
		$smarty->assign("breadcumbMenuSubName", "Delivery Order");
	}

	elseif ($module == 'do' && $act == 'search')
	{
		$doFaktur = date('Ymdhis');
		$_SESSION['doFaktur'] = $doFaktur;
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the do data
		if ($sDate != '' && $eDate != '')
		{
			$queryDo = "SELECT * FROM as_delivery_order WHERE doNo LIKE '%$q%' AND deliveredDate BETWEEN '$startDate' AND '$endDate' ORDER BY doID DESC";
		}
		else
		{
			$queryDo = "SELECT * FROM as_delivery_order WHERE doNo LIKE '%$q%' ORDER BY doID DESC";
		}
		
		$sqlDo = mysqli_query($connect, $queryDo);
		
		// fetch data
		$i = 1 + $position;
		while ($dtDo = mysqli_fetch_array($sqlDo))
		{
			$dataDo[] = array(	'doID' => $dtDo['doID'],
								'doNo' => $dtDo['doNo'],
								'doFaktur' => $dtDo['doFaktur'],
								'soID' => $dtDo['soID'],
								'soNo' => $dtDo['soNo'],
								'customerID' => $dtDo['customerID'],
								'customerName' => $dtDo['customerName'],
								'staffID' => $dtDo['staffID'],
								'staffName' => $dtDo['staffName'],
								'deliveredDate' => tgl_indo2($dtDo['deliveredDate']),
								'note' => $dtDo['note'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataDo", $dataDo);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Delivery Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi delivery order.");
		$smarty->assign("breadcumbMenuName", "Delivery Order");
		$smarty->assign("breadcumbMenuSubName", "Delivery Order");
	} 
	
	else
	{
		$doFaktur = date('Ymdhis');
		$_SESSION['doFaktur'] = $doFaktur;
		
		// create new object pagination
		$p = new PaginationDo;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the do data
		$queryDo = "SELECT * FROM as_delivery_order ORDER BY doID DESC LIMIT $position,$limit";
		$sqlDo = mysqli_query($connect, $queryDo);
		
		// fetch data
		$i = 1 + $position;
		while ($dtDo = mysqli_fetch_array($sqlDo))
		{
			$dataDo[] = array(	'doID' => $dtDo['doID'],
								'doNo' => $dtDo['doNo'],
								'doFaktur' => $dtDo['doFaktur'],
								'soID' => $dtDo['soID'],
								'soNo' => $dtDo['soNo'],
								'customerID' => $dtDo['customerID'],
								'customerName' => $dtDo['customerName'],
								'staffID' => $dtDo['staffID'],
								'staffName' => $dtDo['staffName'],
								'deliveredDate' => tgl_indo2($dtDo['deliveredDate']),
								'note' => $dtDo['note'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataDo", $dataDo);
		
		// count data
		$queryCountDo = "SELECT * FROM as_delivery_order";
		$sqlCountDo = mysqli_query($connect, $queryCountDo);
		$amountData = mysqli_num_rows($sqlCountDo);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Delivery Order");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi delivery order.");
		$smarty->assign("breadcumbMenuName", "Delivery Order");
		$smarty->assign("breadcumbMenuSubName", "Delivery Order");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>