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
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
	$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
	
	$s2Date = explode("-", $sDate);
	$e2Date = explode("-", $eDate);
	
	$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
	$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="pembayaran_transaksi_penjualan.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 150mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PUSTAKA AN-NAHDLAH
								</div>
							</td>
							<td style='width: 83mm;'></td>
						</tr>
						<tr valign='top'>
							<td>
								<span style='font-size: 11pt;'><b>BUKTI PEMBAYARAN TRANSAKSI</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO PAYMENT</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TGL</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO INVOICE</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO SO</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TIPE</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>VALAS</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TOTAL</th>
							<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>DIBUAT OLEH</th>
						</tr>";
						
						// showing up the pay out data
						if ($sDate != '' && $eDate != '')
						{
							$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo LIKE '%$q%' AND paymentDate BETWEEN '$startDate' AND '$endDate' ORDER BY paymentDate DESC";
						}
						else
						{
							$queryPay = "SELECT * FROM as_sales_payments WHERE paymentNo LIKE '%$q%' ORDER BY paymentDate DESC";
						}
						
						$sqlPay = mysqli_query($connect, $queryPay);
						
						// fetch data
						$i = 1 + $position;
						while ($dtPay = mysqli_fetch_array($sqlPay))
						{
							if ($dtPay['payType'] == '1')
							{
								$payType = "TUNAI";
								$effectiveDate = "";
							}
							else
							{
								$payType = "CEK";
								$effectiveDate = tgl_indo2($dtPay['effectiveDate']);
							}
							
							$querySales = "SELECT valas FROM as_sales_transactions WHERE invoiceNo = '$dtPay[invoiceNo]' AND soNo = '$dtPay[soNo]'";
							$sqlSales = mysqli_query($connect, $querySales);
							$dataSales = mysqli_fetch_array($sqlSales);
							
							$paymentDate = tgl_indo2($dtPay['paymentDate']);
							$total = rupiah($dtPay['total']);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtPay[paymentNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$paymentDate</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtPay[invoiceNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtPay[soNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$payType</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataSales[valas]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$total</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtPay[staffName]</td>
									</tr>
							";
							
							$i++;
						}
			$content .= 
						"
						
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