<?php
// include header
include "header.php";
// set the tpl page
$page = "suppliers.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '6'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is supplier and action is delete
	if ($module == 'supplier' && $act == 'delete')
	{
		// insert method into a variable
		$supplierID = $_GET['supplierID'];
		
		// delete supplier
		$querySupplier = "DELETE FROM as_suppliers WHERE supplierID = '$supplierID'";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// redirect to the supplier page
		header("Location: suppliers.php?msg=Data supplier berhasil dihapus");
	} // close bracket
	
	// if module is supplier and action is search
	elseif ($module == 'supplier' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$querySupplier = "SELECT * FROM as_suppliers WHERE supplierCode LIKE '%$q%' OR supplierName LIKE '%$q%' ORDER BY supplierName ASC";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		$i = 1;
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName'],
									'address' => $dtSupplier['address'],
									'phone' => $dtSupplier['phone'],
									'fax' => $dtSupplier['fax'],
									'contactPerson' => $dtSupplier['contactPerson'],
									'email' => $dtSupplier['email'],
									'no' => $i);
			$i++;
		}
		
		// assign
		$smarty->assign("dataSupplier", $dataSupplier);
		$smarty->assign("q", $q);
	}
	
	else
	{
		// get last sort supplier number
		$queryNoSupplier = "SELECT supplierCode FROM as_suppliers ORDER BY supplierCode DESC LIMIT 1";
		$sqlNoSupplier = mysqli_query($connect, $queryNoSupplier);
		$numsNoSupplier = mysqli_num_rows($sqlNoSupplier);
		$dataNoSupplier = mysqli_fetch_array($sqlNoSupplier);
		
		$start = substr($dataNoSupplier['supplierCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoSupplier == '0')
		{
			$supplierNo = "0000";
		}
		elseif ($tempNo == 1)
		{
			$supplierNo = "0000";
		}
		elseif ($tempNo == 2)
		{
			$supplierNo = "000";
		}
		elseif ($tempNo == 3)
		{
			$supplierNo = "00";
		}
		elseif ($tempNo == 4)
		{
			$supplierNo = "0";
		}
		elseif ($tempNo == 5)
		{
			$supplierNo = "";
		}
		
		$supplierCode = $supplierNo.$next;
		
		$smarty->assign("supplierCode", $supplierCode);
		
		// create new object pagination
		$p = new PaginationSupplier;
		// limit 20 data for page
		$limit  = 20;
		$position = $p->searchPosition($limit);
		
		// showing up the supplier data
		$querySupplier = "SELECT * FROM as_suppliers ORDER BY supplierCode ASC LIMIT $position,$limit";
		$sqlSupplier = mysqli_query($connect, $querySupplier);
		
		// fetch data
		$i = 1 + $position;
		while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
		{
			$dataSupplier[] = array('supplierID' => $dtSupplier['supplierID'],
									'supplierCode' => $dtSupplier['supplierCode'],
									'supplierName' => $dtSupplier['supplierName'],
									'address' => $dtSupplier['address'],
									'phone' => $dtSupplier['phone'],
									'fax' => $dtSupplier['fax'],
									'contactPerson' => $dtSupplier['contactPerson'],
									'email' => $dtSupplier['email'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataSupplier", $dataSupplier);
		
		// count data
		$queryCountSupplier = "SELECT * FROM as_suppliers";
		$sqlCountSupplier = mysqli_query($connect, $queryCountSupplier);
		$amountData = mysqli_num_rows($sqlCountSupplier);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Sales / SFA");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master SFA / Sales.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Sales");
}

// include footer
include "footer.php";
?>