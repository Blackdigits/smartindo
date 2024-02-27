<?php
include "header.php";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$act = $_GET['act'];
	$module = $_GET['module'];
	
	if ($module == 'payin' && $act == 'print')
	{
		$invoiceNo = $_GET['invoiceNo'];
		$paymentNo = $_GET['paymentNo'];
		$paymentID = $_GET['paymentID'];
		$now = date('Y-m-d');
		
		$filename="bukti_pembayaran.pdf";
		$content = ob_get_clean();
		
		// show the buy transaction
		$queryBuy = "SELECT * FROM as_buy_transactions WHERE invoiceNo = '$invoiceNo'";
		$sqlBuy = mysqli_query($connect, $queryBuy);
		$dataBuy = mysqli_fetch_array($sqlBuy);
		
		// show the payment 
		$queryPay = "SELECT * FROM as_buy_payments WHERE invoiceNo = '$invoiceNo' AND paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlPay = mysqli_query($connect, $queryPay);
		$dataPay = mysqli_fetch_array($sqlPay);
		
		$queryTotal = "SELECT SUM(total) as total FROM as_buy_payments WHERE invoiceNo = '$invoiceNo' AND paymentID = '$paymentID' AND paymentNo = '$paymentNo'";
		$sqlTotal = mysqli_query($connect, $queryTotal);
		$dataTotal = mysqli_fetch_array($sqlTotal);
		
		// debt
		$debt = $dataTotal['total'] - $dataBuy['grandtotal'];
		
		if ($dataPay['payType'] == '1')
		{
			$payType = "TUNAI";
		}
		elseif ($dataPay['payType'] == '2')
		{
			$payType = "TRANSFER";
		}
		elseif ($dataPay['payType'] == '3')
		{
			$payType = "CEK";
		}
		else
		{
			$payType = "GIRO";
		}
		
		$paymentDate = tgl_indo2($dataPay['paymentDate']);
		
		if ($dataPay['payType'] == '1')
		{
			$payType = "Tunai";
		}
		elseif ($dataPay['payType'] == '2')
		{
			$payType = "Transfer";
		}
		elseif ($dataPay['payType'] == '3')
		{
			$payType = "Cek";
		}
		else
		{
			$payType = "Giro";
		}
		
		if ($dataPay['effectiveDate'] == '0000-00-00')
		{
			$effectiveDate = "-";
		}
		else
		{
			$effectiveDate = tgl_indo2($dataPay['effectiveDate']);
		}
		
		$debt = rupiah($dataTotal['total'] - $dataBuy['grandtotal']);
		$total = rupiah($dataPay['total']);
		$discount = rupiah($dataBuy['discount']);
		$basic = rupiah($dataBuy['basic']);
		$ppn = rupiah($dataBuy['ppn']);
		$grandtotal = rupiah($dataBuy['grandtotal']);
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 150mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
                                CV. SMARTINDO TELEKOM
								</div>
							</td>
							<td style='width: 83mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar<br> Bogor, Jawa Barat
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>BUKTI PEMBAYARAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor </td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 75mm;'>$dataPay[paymentNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 120mm;'>Supplier :</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor Faktur</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 75mm;'>$dataPay[invoiceNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataPay[supplierName]</td>
						</tr>
						<tr valign='top'>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$paymentDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3' rowspan='3'>$dataPay[supplierAddress]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Jenis Pembayaran</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$payType</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>No Rek/Cek/Giro</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPay[bankNo]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Nama Bank</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPay[bankName]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Nama Akun</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPay[bankAC]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal Efektif</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$effectiveDate</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Jumlah</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$total</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Ref</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPay[ref]</td>
						</tr>
					</table>
					<p style='font-size: 9pt;'>Note : <br>$dataPay[note]</p>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 130mm;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm; text-align: center;'>HORMAT KAMI,<br><br><br><br><br>Administrasi</td>
							<td colspan='2'></td>
						</tr>
					</table>
					";
	}
	
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', array('240', '130'),'fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>