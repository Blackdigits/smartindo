<?php
// include header
include "header.php";
// set the tpl page
$page = "customers.tpl";

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
	$queryAuthorizeStaff = "SELECT * FROM as_modules WHERE modulID = '2'";
	$sqlAuthorizeStaff = mysqli_query($connect, $queryAuthorizeStaff);
	$dataAuthorizeStaff = mysqli_fetch_array($sqlAuthorizeStaff);
	
	if (strpos($dataAuthorizeStaff['authorize'], $_SESSION['level']) === FALSE){
		echo "Anda tidak berhak akses modul ini.";
		exit();
	}
		
	// if module is customer and action is delete
	if ($module == 'customer' && $act == 'delete')
	{
		// insert method into a variable
		$customerID = $_GET['customerID'];
		$page = $_GET['page'];
		
		// delete customer
		$queryCustomer = "DELETE FROM as_customers WHERE customerID = '$customerID'";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		// redirect to the customer page
		header("Location: customers.php?page=".$page."&msg=Data customer berhasil dihapus");
	} // close bracket
	
	// if module is customer and act is search
	elseif ($module == 'customer' && $act == 'search')
	{
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		
		$queryCustomer = "SELECT * FROM as_customers WHERE customerCode LIKE '%$q%' OR customerName LIKE '%$q%' OR city LIKE '%$q%'";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		// fetch data
		$i = 1;
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName'],
									'contactPerson' => $dtCustomer['contactPerson'],
									'city' => $dtCustomer['city'],
									'phone1' => $dtCustomer['phone1'],
									'limitBalance' => rupiah($dtCustomer['limitBalance']),
									'disc1' => $dtCustomer['disc1'],
									'disc2' => $dtCustomer['disc2'],
									'disc3' => $dtCustomer['disc3'],
									'note' => $dtCustomer['note'],
									'npwp' => $dtCustomer['npwp'],
									'pkpName' => $dtCustomer['pkpName'],
									'no' => $i);
			$i++;
		}
		
		// assign 
		$smarty->assign("dataCustomer", $dataCustomer);
		$smarty->assign("q", $q);
	}
	
	else
	{	
		// create new object pagination
		$p = new PaginationCustomer;
		// limit 20 data for page
		$limit  = 10;
		$position = $p->searchPosition($limit);
		
		// showing up the customer data
		$queryCustomer = "SELECT * FROM as_customers ORDER BY customerCode ASC LIMIT $position,$limit";
		$sqlCustomer = mysqli_query($connect, $queryCustomer);
		
		// fetch data
		$i = 1 + $position;
		while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
		{
			$dataCustomer[] = array('customerID' => $dtCustomer['customerID'],
									'customerCode' => $dtCustomer['customerCode'],
									'customerName' => $dtCustomer['customerName'],
									'contactPerson' => $dtCustomer['contactPerson'],
									'city' => $dtCustomer['city'],
									'phone1' => $dtCustomer['phone1'],
									'limitBalance' => rupiah($dtCustomer['limitBalance']),
									'disc1' => $dtCustomer['disc1'],
									'disc2' => $dtCustomer['disc2'],
									'disc3' => $dtCustomer['disc3'],
									'note' => $dtCustomer['note'],
									'npwp' => $dtCustomer['npwp'],
									'pkpName' => $dtCustomer['pkpName'],
									'no' => $i);
			$i++;
		}
		
		$smarty->assign("dataCustomer", $dataCustomer);
		
		// count data
		$queryCountCustomer = "SELECT * FROM as_customers";
		$sqlCountCustomer = mysqli_query($connect, $queryCountCustomer);
		$amountData = mysqli_num_rows($sqlCountCustomer);
		
		$amountPage = $p->amountPage($amountData, $limit);
		$pageLink = $p->navPage($_GET['page'], $amountPage);
		
		$smarty->assign("pageLink", $pageLink);
		$smarty->assign("page", $_GET['page']);
	}
	
	$smarty->assign("msg", $_GET['msg']);
	$smarty->assign("breadcumbTitle", "Manajemen Customer");
	$smarty->assign("breadcumbTitleSmall", "Halaman untuk melakukan pengolahan data master Toko.");
	$smarty->assign("breadcumbMenuName", "Master Data");
	$smarty->assign("breadcumbMenuSubName", "Customer");
}

// include footer
include "footer.php";
?>