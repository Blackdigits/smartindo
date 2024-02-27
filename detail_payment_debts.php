<?php
// include header
include "header.php";
// set the tpl page
$page = "detail_payment_debts.tpl";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "Anda tidak berhak akses modul ini.";
	exit();
}

else 
{
	// get variable
	$module = $_GET['module'];
	$act = $_GET['act'];
	
	if ($module == 'payment' && $act == 'detail')
	{
		// insert method into a variable
		$paymentID = $_GET['paymentID'];
		$paymentNo = $_GET['paymentNo'];
		
		// showing up the payment data based on payment id
		$queryPayment = "SELECT * FROM as_buy_payments WHERE paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPayment = mysqli_query($connect, $queryPayment);
		
		// fetch data
		$dataPayment = mysqli_fetch_array($sqlPayment);
		
		if ($dataPayment['payType'] == '1')
		{
			$payType = "TUNAI";
		}
		elseif ($dataPayment['payType'] == '2')
		{
			$payType = "TRANSFER";
		}
		elseif ($dataPayment['payType'] == '3')
		{
			$payType = "CEK";
		}
		else
		{
			$payType = "GIRO";
		}
		
		// assign fetch data to the tpl
		$smarty->assign("paymentNo", $dataPayment['paymentNo']);
		$smarty->assign("paymentDate", tgl_indo2($dataPayment['paymentDate']));
		$smarty->assign("payType", $payType);
		$smarty->assign("bankNo", $dataPayment['bankNo']);
		$smarty->assign("bankName", $dataPayment['bankName']);
		$smarty->assign("bankAC", $dataPayment['bankAC']);
		$smarty->assign("effectiveDate", tgl_indo2($dataPayment['effectiveDate']));
		$smarty->assign("total", rupiah($dataPayment['total']));
		$smarty->assign("ref", $dataPayment['ref']);
		$smarty->assign("note", $dataPayment['note']);
		$smarty->assign("staffName", $dataPayment['staffName']);
	} //close bracket
	
	// assign code to the tpl
	$smarty->assign("code", $_GET['code']);
	$smarty->assign("module", $_GET['module']);
	$smarty->assign("act", $_GET['act']);
	
} // close bracket

// include footer
include "footer.php";
?>