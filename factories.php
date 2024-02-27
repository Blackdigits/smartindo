<?php
// include header
include "header.php";
// set the tpl page
$page = "factories.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '12'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is factory and action is delete
	if ($module == 'factory' && $act == 'delete')
	{
		// insert method into a variable
		$factoryID = $_GET['factoryID'];
		
		// delete factories
		$queryFactory = "DELETE FROM as_factories WHERE factoryID = '$factoryID'";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		// redirect to the factory page
		header("Location: factories.php?msg=Data gudang berhasil dihapus");
	} // close bracket
	
	// if the module is factory and action is search
	elseif ($module == 'factory' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryFactory = "SELECT * FROM as_factories WHERE factoryCode LIKE '%$q%' OR factoryName LIKE '%$q%' ORDER BY factoryName ASC";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		// fetch data
		$i = 1;
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			if ($dtFactory['factoryType'] == '1')
			{
				$factoryType = "TETAP";
			}
			else
			{
				$factoryType = "SEMENTARA (SEWA)";
			}
			
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName'],
									'factoryType' => $factoryType,
									'status' => $dtFactory['status'],
									'note' => $dtFactory['note'],
									'no' => $i);
			$i++;
		}
		
		// assign
		$smarty->assign("dataFactory", $dataFactory);
		$smarty->assign("q", $q);
	}
	
	else
	{
		// get last sort factory number
		$queryNoFactory = "SELECT factoryCode FROM as_factories ORDER BY factoryCode DESC LIMIT 1";
		$sqlNoFactory = mysqli_query($connect, $queryNoFactory);
		$numsNoFactory = mysqli_num_rows($sqlNoFactory);
		$dataNoFactory = mysqli_fetch_array($sqlNoFactory);
		
		$start = substr($dataNoFactory['factoryCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoFactory == '0')
		{
			$factoryNo = "0000";
		}
		elseif ($tempNo == 1)
		{
			$factoryNo = "0000";
		}
		elseif ($tempNo == 2)
		{
			$factoryNo = "000";
		}
		elseif ($tempNo == 3)
		{
			$factoryNo = "00";
		}
		elseif ($tempNo == 4)
		{
			$factoryNo = "0";
		}
		elseif ($tempNo == 5)
		{
			$factoryNo = "";
		}
		
		$factoryCode = $factoryNo.$next;
		
		$smarty->assign("factoryCode", $factoryCode);
		
		// create new object pagination
		$p = new PaginationFactory;
		// limit 20 data for page
		$limit  = 20;
		$position = $p->searchPosition($limit);
		
		// showing up the factories data
		$queryFactory = "SELECT * FROM as_factories ORDER BY factoryCode ASC LIMIT $position,$limit";
		$sqlFactory = mysqli_query($connect, $queryFactory);
		
		// fetch data
		$i = 1 + $position;
		while ($dtFactory = mysqli_fetch_array($sqlFactory))
		{
			if ($dtFactory['factoryType'] == '1')
			{
				$factoryType = "TETAP";
			}
			else
			{
				$factoryType = "SEMENTARA (SEWA)";
			}
			
			$dataFactory[] = array(	'factoryID' => $dtFactory['factoryID'],
									'factoryCode' => $dtFactory['factoryCode'],
									'factoryName' => $dtFactory['factoryName'],
									'factoryType' => $factoryType,
									'status' => $dtFactory['status'],
									'note' => $dtFactory['note'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataFactory", $dataFactory);
		
		// count data
		$queryCountFactory = "SELECT * FROM as_factories";
		$sqlCountFactory = mysqli_query($connect, $queryCountFactory);
		$amountData = mysqli_num_rows($sqlCountFactory);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Gudang / Pabrik");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master gudang atau pabrik.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Gudang / Pabrik");
}

// include footer
include "footer.php";
?>