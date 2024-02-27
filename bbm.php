<?php
// include header
include "header.php";
// set the tpl page
$page = "bbm.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '13'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is bbm and action is delete
	if ($module == 'bbm' && $act == 'delete')
	{
		// insert method into a variable
		$bbmID = $_GET['bbmID'];
		$bbmNo = $_GET['bbmNo'];
		$bbmFaktur = $_GET['bbmFaktur'];
		
		$queryBD = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBD = mysqli_query($connect, $queryBD);
		
		// fetch data
		while ($dataBD = mysqli_fetch_array($sqlBD))
		{
			$querySP = "UPDATE as_stock_products SET stock=stock-$dataBD[receiveQty] WHERE productID = '$dataBD[productID]' AND factoryID = '$dataBD[factoryID]' AND supplierID IS NULL";
			mysqli_query($connect, $querySP);
		}
		
		// delete bbm
		$queryBbm = "DELETE FROM as_bbm WHERE bbmID = '$bbmID' AND bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// delete bbm detail
		$queryBbmDetail = "DELETE FROM as_detail_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		// redirect to the bbm page
		header("Location: bbm.php?msg=Data bukti barang masuk berhasil dihapus");
	} // close bracket
	
	// if the module is bbm and act is input
	elseif ($module == 'bbm' && $act == 'input')
	{ 
        // cetak($_POST);
		$bbmFaktur = $_SESSION['bbmFaktur'];
		$modifiedDate = date('Y-m-d H:i:s');
		$staffID = $_SESSION['staffID'];
		$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
		$bbmNo = $_POST['bbmNo'];
		$bbmID = $_POST['bbmID'];
		$spbNo = $_POST['spbNo'];
		$supplierID = $_POST['supplierName'];
		$supplierAddress = mysqli_real_escape_string($connect, $_POST['supplierAddress']);
		$rDate = explode("-", $_POST['receiveDate']);
		$receiveDate = $rDate[2]."-".$rDate[1]."-".$rDate[0];
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
		$receiveQty = $_POST['receiveQty'];
		$status = $_POST['status'];
		$factory = $_POST['factory'];
		$notedetail = $_POST['notedetail']; 
		$dataSpb = mysqli_fetch_array(mysqli_query($connect, "SELECT factoryName FROM `as_factories` WHERE `factoryID` = '$supplierID'"));
		$supplierName = $dataSpb['factoryName'];
		for ($i = 0; $i < $countDetailID; $i++)
		{
			$f = explode("#", $factory[$i]);
			$factoryID = $_POST['supplierName']; //$f[0];
			$factoryName = $f[1]." ".$f[2];
			$productNm = mysqli_real_escape_string($connect, $productName[$i]);
			$notedet = mysqli_real_escape_string($connect, $notedetail[$i]);
			$total = $price[$i] * $receiveQty[$i];
			
			$queryInsert = "INSERT INTO as_detail_bbm (	bbmNo,
														bbmFaktur,
														productID,
														productName,
														price,
														qty,
														receiveQty,
														receiveStatus,
														factoryID,
														factoryName,
														note,
														createdDate,
														createdUserID)
												VALUES(	'$bbmNo',
														'$bbmFaktur',
														'$productID[$i]',
														'$productNm',
														'$price[$i]',
														'$qty[$i]',
														'$receiveQty[$i]',
														'$status[$i]',
														'$factoryID',
														'$factoryName',
														'$notedet',
														'$modifiedDate',
														'$staffID')";
			
			mysqli_query($connect, $queryInsert);
			
			$queryStockStaff = "SELECT stockProductID FROM as_stock_products WHERE factoryID = '$factoryID' AND productID = '$productID[$i]' AND supplierID IS NULL";
			$sqlStaffStock = mysqli_query($connect, $queryStockStaff);
			
			if (mysqli_num_rows($sqlStaffStock) == 0) {
				$queryStock = "INSERT INTO as_stock_products (	productID,
																factoryID, 
                                                                staffID, 
																stock,
																createdDate,
																createdUserID,
																modifiedDate,
																modifiedUserID)
														VALUES(	'$productID[$i]',
																 $factoryID, 
                                                                 $staffID, 
																 $receiveQty[$i],
																'$modifiedDate',
																'$staffID',
																'',
																'')"; 
				$sqlStock = mysqli_query($connect, $queryStock);
			} else { 
				$queryStock = "UPDATE as_stock_products SET staffID = '$staffID',stock=stock+$receiveQty[$i], modifiedDate = '$modifiedDate', modifiedUserID = '$staffID' WHERE factoryID = '$factoryID' AND productID = '$productID[$i]' AND supplierID IS NULL";
				mysqli_query($connect, $queryStock);
			} 
			$grandtotal += $total;
		}

		// update bbm
		$queryBbm = "UPDATE as_bbm SET 	spbID = '', 
										spbNo = '$spbNo',
										supplierID = '$supplierID',
										supplierName = '$supplierName',
										supplierAddress = '$supplierAddress', 
										staffID = '$staffID',
										staffName = '$sName',
										receiveDate = '$receiveDate',
										orderDate = '$orderDate',
										needDate = '$needDate',
										total = '$grandtotal',
										note = '$note',
										modifiedDate = '$modifiedDate',
										modifiedUserID = '$staffID'
										WHERE bbmID = '$bbmID' AND bbmFaktur = '$bbmFaktur'";
										
		$sqlBbm = mysqli_query($connect, $queryBbm);

		$_SESSION['bbmFaktur'] = "";
		
		header("Location: bbm.php?module=bbm&act=finish&bbmNo=".$bbmNo."&bbmFaktur=".$bbmFaktur);
	}
	
	// if the module is bbm and act is detailbbm
	elseif ($module == 'bbm' && $act == 'detailbbm')
	{
		$bbmID = $_GET['bbmID'];
		$bbmFaktur = $_GET['bbmFaktur'];
		$bbmNo = $_GET['bbmNo'];
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryBbm = "SELECT * FROM as_bbm WHERE bbmID = '$bbmID' AND bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		// assign to the tpl
		$smarty->assign("bbmFaktur", $dataBbm['bbmFaktur']);
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		$smarty->assign("bbmNo", $dataBbm['bbmNo']);
		$smarty->assign("spbID", $dataBbm['spbID']);
		$smarty->assign("spbNo", $dataBbm['spbNo']);
		$smarty->assign("supplierID", $dataBbm['supplierID']);
		$smarty->assign("supplierName", $dataBbm['supplierName']);
		$smarty->assign("supplierAddress", $dataBbm['supplierAddress']);
		$smarty->assign("staffID", $dataBbm['staffID']);
		$smarty->assign("staffName", $dataBbm['staffName']);
		$smarty->assign("receiveDate", tgl_indo2($dataBbm['receiveDate']));
		$smarty->assign("orderDate", tgl_indo2($dataBbm['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataBbm['needDate']));
		$smarty->assign("note", $dataBbm['note']);
		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur' ORDER BY detailID ASC";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		$i = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'bbmNo' => $dtBbmDetail['bbmNo'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productID' => $dtBbmDetail['productID'],
										'productName' => $dtBbmDetail['productName'],
										'price' => $dtBbmDetail['price'],
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'status' => $dtBbmDetail['receiveStatus'],
										'factoryID' => $dtBbmDetail['factoryID'],
										'factoryName' => $dtBbmDetail['factoryName'],
										'note' => $dtBbmDetail['note'],
										'no' => $i
										);
			$i++;
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $_GET['q']);
		
		$smarty->assign("breadcumbTitle", "Bukti Barang Masuk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penerimaan barang / bukti barang masuk.");
		$smarty->assign("breadcumbMenuName", "Bukti Barang Masuk");
		$smarty->assign("breadcumbMenuSubName", "Bukti Barang Masuk");
	}
	
	// if the module bbm and act is cancel
	elseif ($module == 'bbm' && $act == 'cancel')
	{
		$bbmFaktur = $_SESSION['bbmFaktur'];
		
		// delete bbm
		$queryBbm = "DELETE FROM as_bbm WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		$_SESSION['bbmFaktur'] = "";
		
		header("Location: bbm.php?msg=Data bukti barang masuk dibatalkan.");
	}
	
	// if module bbm and act is finish
	elseif ($module == 'bbm' && $act == 'finish')
	{
		$bbmNo = $_GET['bbmNo'];
		$bbmFaktur = $_GET['bbmFaktur'];
		
		$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		$smarty->assign("bbmNo", $dataBbm['bbmNo']);
		$smarty->assign("bbmFaktur", $dataBbm['bbmFaktur']);
		$smarty->assign("spbID", $dataBbm['spbID']);
		$smarty->assign("spbNo", $dataBbm['spbNo']);
		$smarty->assign("supplierID", $dataBbm['supplierID']);
		$smarty->assign("supplierName", $dataBbm['supplierName']);
		$smarty->assign("staffID", $dataBbm['staffID']);
		$smarty->assign("staffName", $dataBbm['staffName']);
		$smarty->assign("receiveDate", tgl_indo2($dataBbm['receiveDate']));
		$smarty->assign("orderDate", tgl_indo2($dataBbm['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataBbm['needDate']));
		$smarty->assign("note", $dataBbm['note']);
		
		// show the bbm detail
		$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$bbmFaktur'";
		$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
		
		// fetch data
		$k = 1;
		while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
		{
			if ($dtBbmDetail['receiveStatus'] == 'Y')
			{
				$status = "Y";
			}
			else
			{
				$status = "N";
			}
			
			$dataBbmDetail[] = array(	'detailID' => $dtBbmDetail['detailID'],
										'bbmNo' => $dtBbmDetail['bbmNo'],
										'bbmFaktur' => $dtBbmDetail['bbmFaktur'],
										'productName' => $dtBbmDetail['productName'],
										'price' => rupiah($dtBbmDetail['price']),
										'qty' => $dtBbmDetail['qty'],
										'receiveQty' => $dtBbmDetail['receiveQty'],
										'status' => $status,
										'factoryName' => $dtBbmDetail['factoryName'],
										'note' => $dtBbmDetail['note'],
										'no' => $k 
										);
			$k++;
		}
		
		$smarty->assign("dataBbmDetail", $dataBbmDetail);
		
		$smarty->assign("breadcumbTitle", "Bukti Barang Masuk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penerimaan barang / bukti barang masuk.");
		$smarty->assign("breadcumbMenuName", "Bukti Barang Masuk");
		$smarty->assign("breadcumbMenuSubName", "Bukti Barang Masuk");
	}
	
	// if the module bbm and act is add
	elseif ($module == 'bbm' && $act == 'add')
	{
		$bbmFaktur = $_SESSION['bbmFaktur'];
		
		// get last sort bbm number ID
		$queryNoBbm = "SELECT bbmNo FROM as_bbm ORDER BY bbmNo DESC LIMIT 1";
		$sqlNoBbm = mysqli_query($connect, $queryNoBbm);
		$numsNoBbm = mysqli_num_rows($sqlNoBbm);
		$dataNoBbm = mysqli_fetch_array($sqlNoBbm);
		
		$start = substr($dataNoBbm['bbmNo'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoBbm == '0')
		{
			$bbmNo = "00000";
		}
		elseif ($tempNo == 1)
		{
			$bbmNo = "00000";
		}
		elseif ($tempNo == 2)
		{
			$bbmNo = "0000";
		}
		elseif ($tempNo == 3)
		{
			$bbmNo = "000";
		}
		elseif ($tempNo == 4)
		{
			$bbmNo = "00";
		}
		elseif ($tempNo == 5)
		{
			$bbmNo = "0";
		}
		elseif ($tempNo == 6)
		{
			$bbmNo = "";
		}
		
		$bbmCode = "BB".$bbmNo.$next;
		
		// count bbm based on bbmNo
		$showBbm = "SELECT * FROM as_bbm WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $showBbm);
		$numsBbm = mysqli_num_rows($sqlBbm);
		
		if ($numsBbm == 0)
		{
			$receiveDate = date('Y-m-d');
			$sName = $_SESSION['staffCode']." ".$_SESSION['staffName'];
			$queryBbm = "INSERT INTO as_bbm(bbmFaktur,
											bbmNo,
											spbID,
											spbNo,
											supplierID,
											supplierName,
											staffID,
											staffName,
											receiveDate,
											orderDate,
											needDate,
											total,
											note,
											createdDate,
											createdUserID,
											modifiedDate,
											modifiedUserID)
									VALUES(	'$bbmFaktur',
											'$bbmCode',
											'',
											'',
											'',
											'',
											'$_SESSION[staffID]',
											'$sName',
											'$receiveDate',
											'',
											'',
											'',
											'',
											'$createdDate',
											'$staffID',
											'',
											'')";
			mysqli_query($connect, $queryBbm);
		}
		
		// count bbm based on bbmNo
		$showBbm = "SELECT * FROM as_bbm WHERE bbmFaktur = '$bbmFaktur'";
		$sqlBbm = mysqli_query($connect, $showBbm);
		$dataBbm = mysqli_fetch_array($sqlBbm);
		$bbmNo = $dataBbm['bbmNo'];
		$smarty->assign("bbmNo", $dataBbm['bbmNo']);
		$smarty->assign("bbmID", $dataBbm['bbmID']);
		
		if ($dataBbm['receiveDate'] == '0000-00-00')
		{
			$receiveDate = date('Y-m-d');
		}
		else
		{
			$receiveDate = $dataBbm['receiveDate'];
		}
		
		$smarty->assign("receiveDate", tgl_indo2($receiveDate));
		$smarty->assign("note", $dataBbm['note']);
		
		// show the spb data based on spbNo
		$bbmNo = mysqli_real_escape_string($connect, $bbmNo);
		$querySpb = "SELECT * FROM as_bbm WHERE bbmNo = '$bbmNo'";
		$sqlSpb = mysqli_query($connect, $querySpb);
		$dataSpb = mysqli_fetch_array($sqlSpb);
		$numsSpb = mysqli_num_rows($sqlSpb);
		
		$smarty->assign("numsSpb", $numsSpb);
		
		// show the bbm data
		$queryBbm = "SELECT A.bbmID FROM as_bbm A INNER JOIN as_detail_bbm B ON B.bbmNo=A.bbmNo WHERE A.bbmNo = '$bbmNo'";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		$numsBbm = mysqli_num_rows($sqlBbm);
		
		$smarty->assign("numsBbm", $numsBbm);
		
		// assign to the bbm tpl
		$smarty->assign("spbNo", $dataSpb['spbNo']);
		$smarty->assign("supplierName", $_SESSION['bbm_spbm']); 
		$smarty->assign("supplierID", $dataSpb['supplierID']);
		$smarty->assign("orderDate", tgl_indo2($dataSpb['orderDate']));
		$smarty->assign("needDate", tgl_indo2($dataSpb['needDate']));
		
		// show the spb detail based on spbNo
		$i = 1;
		$querySpbDetail = "SELECT * FROM as_temp_detail_bbm WHERE bbmNo = '$bbmNo' AND bbmFaktur = '$dataSpb[bbmFaktur]'";
		$sqlSpbDetail = mysqli_query($connect, $querySpbDetail);
		while ($dataSpbDetail = mysqli_fetch_array($sqlSpbDetail))
		{
			$subtotal = $dataSpbDetail['qty'] * $dataSpbDetail['price'];
			
			$dataDetail[] = array(	'detailID' => $dataSpbDetail['detailID'],
									'bbmNo' => $dataSpbDetail['bbmNo'],
									'bbmFaktur' => $dataSpbDetail['bbmFaktur'],
									'productID' => $dataSpbDetail['productID'],
									'productName' => $dataSpbDetail['productName'],
									'price' => $dataSpbDetail['price'],
									'qty' => $dataSpbDetail['qty'],
									'subtotal' => $subtotal,
									'note' => $dataSpbDetail['note'],
									'no' => $i
									);
			$i++;
		}
		
		// assign to the spb tpl
		$smarty->assign("dataDetail", $dataDetail); 
		
		// show the factories data
		$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryCode ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName']);
		}
		
		$smarty->assign("dataFactory", $dataFactory);

		$smarty->assign("breadcumbTitle", "Bukti Barang Masuk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penerimaan barang / bukti barang masuk.");
		$smarty->assign("breadcumbMenuName", "Bukti Barang Masuk");
		$smarty->assign("breadcumbMenuSubName", "Bukti Barang Masuk");
	}

	elseif ($module == 'bbm' && $act == 'search')
	{
		$bbmFaktur = date('Ymdhis');
		$_SESSION['bbmFaktur'] = $bbmFaktur;
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
		$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
		
		$smarty->assign("startDate", $sDate);
		$smarty->assign("endDate", $eDate);
		
		$s2Date = explode("-", $sDate);
		$e2Date = explode("-", $eDate);
		
		$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
		$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
		
		// showing up the bbm data
		if ($sDate != '' || $eDate != '')
		{
			$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo LIKE '%$q%' AND receiveDate BETWEEN '$startDate' AND '$endDate' ORDER BY bbmID DESC";
		}
		else
		{
			$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo LIKE '%$q%' ORDER BY bbmID DESC";
		}
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBbm = mysqli_fetch_array($sqlBbm))
		{
			$dataBbm[] = array(	'bbmID' => $dtBbm['bbmID'],
								'bbmNo' => $dtBbm['bbmNo'],
								'bbmFaktur' => $dtBbm['bbmFaktur'],
								'spbID' => $dtBbm['spdID'],
								'spbNo' => $dtBbm['spbNo'],
								'supplierID' => $dtBbm['supplierID'],
								'supplierName' => $dtBbm['supplierName'],
								'staffID' => $dtBbm['staffID'],
								'staffName' => $dtBbm['staffName'],
								'receiveDate' => tgl_indo2($dtBbm['receiveDate']),
								'note' => $dtBbm['note'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataBbm", $dataBbm);
		
		$smarty->assign("page", $_GET['page']);
		$smarty->assign("q", $q);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Bukti Barang Masuk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penerimaan barang / bukti barang masuk.");
		$smarty->assign("breadcumbMenuName", "Bukti Barang Masuk");
		$smarty->assign("breadcumbMenuSubName", "Bukti Barang Masuk");
	} 
	
	else
	{
		$bbmFaktur = date('Ymdhis');
		$_SESSION['bbmFaktur'] = $bbmFaktur;
		
		// create new object pagination
		$p = new PaginationBbm;
		// limit 20 data for page
		$limit  = 30;
		$position = $p->searchPosition($limit);
		
		// showing up the bbm data
		$queryBbm = "SELECT * FROM as_bbm ORDER BY bbmID DESC LIMIT $position,$limit";
		$sqlBbm = mysqli_query($connect, $queryBbm);
		
		// fetch data
		$i = 1 + $position;
		while ($dtBbm = mysqli_fetch_array($sqlBbm))
		{
			$dataBbm[] = array(	'bbmID' => $dtBbm['bbmID'],
								'bbmNo' => $dtBbm['bbmNo'],
								'bbmFaktur' => $dtBbm['bbmFaktur'],
								'spbID' => $dtBbm['spdID'],
								'spbNo' => $dtBbm['spbNo'],
								'supplierID' => $dtBbm['supplierID'],
								'supplierName' => $dtBbm['supplierName'],
								'staffID' => $dtBbm['staffID'],
								'staffName' => $dtBbm['staffName'],
								'receiveDate' => tgl_indo2($dtBbm['receiveDate']),
								'note' => $dtBbm['note'],
								'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataBbm", $dataBbm);
		
		// count data
		$queryCountBbm = "SELECT * FROM as_bbm";
		$sqlCountBbm = mysqli_query($connect, $queryCountBbm);
		$amountData = mysqli_num_rows($sqlCountBbm);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
		
		$smarty->assign("msg", $_GET['msg']);
		$smarty->assign("breadcumbTitle", "Bukti Barang Masuk");
		$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan transaksi penerimaan barang / bukti barang masuk.");
		$smarty->assign("breadcumbMenuName", "Bukti Barang Masuk");
		$smarty->assign("breadcumbMenuSubName", "Bukti Barang Masuk");
	}
	
	$smarty->assign("module", $module);
	$smarty->assign("act", $act);
}

// include footer
include "footer.php";
?>