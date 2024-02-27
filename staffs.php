<?php
// include header
include "header.php";
// set the tpl page
$page = "staffs.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '1'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
	
	// if module is staff and action is delete
	if ($module == 'staff' && $act == 'delete')
	{
		// insert method into a variable
		$staffID = $_GET['staffID'];
		
		// delete staff
		$queryStaff = "DELETE FROM as_staffs WHERE staffID = '$staffID'";
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		// redirect to the staff page
		header("Location: staffs.php?msg=Data staff berhasil dihapus");
	} // close bracket
	
	// if the module is staff and action is search
	elseif ($module == 'staff' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		if ($q != '')
		{
			$queryStaff = "SELECT * FROM as_staffs WHERE staffCode LIKE '%$q%' OR staffName LIKE '%$q%' AND staffID != '1' ORDER BY staffName ASC";
		}
		else
		{
			$queryStaff = "SELECT * FROM as_staffs WHERE staffID != '' ORDER BY staffName ASC";
		}
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		// fetch data
		$i = 1;
		while ($dtStaff = mysqli_fetch_array($sqlStaff))
		{
			if ($dtStaff['level'] == '1')
			{
				$level = "ADMINISTRATOR";
			}
			elseif ($dtStaff['level'] == '2')
			{
				$level = "GUDANG";
			}
			elseif ($dtStaff['level'] == '3')
			{
				$level = "KASIR";
			}  
			else
			{
				$level = "-";
			}
			
			$dataStaff[] = array(	'staffID' => $dtStaff['staffID'],
									'staffCode' => $dtStaff['staffCode'],
									'staffName' => $dtStaff['staffName'],
									'address' => $dtStaff['address'],
									'phone' => $dtStaff['phone'],
									'position' => $dtStaff['position'],
									'status' => $dtStaff['status'],
									'level' => $level,
									'no' => $i);
			$i++;
		}

		// assign
		$smarty->assign("dataStaff", $dataStaff);
		$smarty->assign("q", $q);
	}
	
	// if module is staff and action is delete photo
	elseif ($module == 'staff' && $act == 'deletephoto')
	{
		$staffID = $_GET['staffID'];
		$photo = $_GET['photo'];
		
		$queryStaff = "UPDATE as_staffs SET photo = '' WHERE staffID = '$staffID'";
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		if ($sqlStaff)
		{
			unlink("img/staffs/".$photo);
			unlink("img/staffs/thumb/small_".$photo);
		}
		
		// redirect to the staff page
		header("Location: staffs.php?msg=Foto staff berhasil dihapus");
	}
	
	else
	{
		// get last sort staff number
		$queryNoStaff = "SELECT staffCode FROM as_staffs ORDER BY staffCode DESC LIMIT 1";
		$sqlNoStaff = mysqli_query($connect, $queryNoStaff);
		$numsNoStaff = mysqli_num_rows($sqlNoStaff);
		$dataNoStaff = mysqli_fetch_array($sqlNoStaff);
		
		$start = substr($dataNoStaff['staffCode'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next);
		
		if ($numsNoStaff == '0')
		{
			$staffNo = "0000";
		}
		elseif ($tempNo == 1)
		{
			$staffNo = "0000";
		}
		elseif ($tempNo == 2)
		{
			$staffNo = "000";
		}
		elseif ($tempNo == 3)
		{
			$staffNo = "00";
		}
		elseif ($tempNo == 4)
		{
			$staffNo = "0";
		}
		elseif ($tempNo == 5)
		{
			$staffNo = "";
		}
		
		$staffCode = $staffNo.$next;
		
		$smarty->assign("staffCode", $staffCode);
		
		// create new object pagination
		$p = new PaginationStaff;
		// limit 20 data for page
		$limit  = 20;
		$position = $p->searchPosition($limit);
		
		// showing up the staff data
		$queryStaff = "SELECT * FROM as_staffs WHERE staffID != '1' ORDER BY staffCode ASC LIMIT $position,$limit";
		$sqlStaff = mysqli_query($connect, $queryStaff);
		
		// fetch data
		$i = 1 + $position;
		while ($dtStaff = mysqli_fetch_array($sqlStaff))
		{
			if ($dtStaff['level'] == '1')
			{
				$level = "ADMINISTRATOR";
			}
			elseif ($dtStaff['level'] == '2')
			{
				$level = "GUDANG";
			}
			elseif ($dtStaff['level'] == '3')
			{
				$level = "KASIR";
			} 
			else
			{
				$level = "-";
			}
			
			$dataStaff[] = array(	'staffID' => $dtStaff['staffID'],
									'staffCode' => $dtStaff['staffCode'],
									'staffName' => $dtStaff['staffName'],
									'address' => $dtStaff['address'],
									'phone' => $dtStaff['phone'],
									'position' => $dtStaff['position'],
									'status' => $dtStaff['status'],
									'level' => $level,
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataStaff", $dataStaff);
		
		// count data
		$queryCountStaff = "SELECT * FROM as_staffs";
		$sqlCountStaff = mysqli_query($connect, $queryCountStaff);
		$amountData = mysqli_num_rows($sqlCountStaff);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		
		// set module
		$queryModule = "SELECT * FROM as_modules WHERE status = 'Y' ORDER BY modulName ASC";
		$sqlModule = mysqli_query($connect, $queryModule);
		
		// fetch data
		$k = 1;
		while ($dtModule = mysqli_fetch_array($sqlModule))
		{
			$dataModule[] = array(	'moduleID' => $dtModule['modulID'],
									'moduleName' => $dtModule['modulName'],
									'no' => $k);
			
			$k++;
		}
		
		$smarty->assign("dataModule", $dataModule);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Admin");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master admin atau pegawai.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Admin");
}

// include footer
include "footer.php";
?>