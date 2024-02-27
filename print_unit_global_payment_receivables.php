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
	
	if ($module == 'payment' && $act == 'print')
	{
		$receiveID = mysqli_real_escape_string($connect, $_GET['receiveID']);
		$receiveNo = mysqli_real_escape_string($connect, $_GET['receiveNo']);
		$now = date('Y-m-d');
		
		$filename="rincian_pembayaran_piutang.pdf";
		$content = ob_get_clean();
		
		// showing up the main receive data
		$queryMain = "SELECT * FROM as_receivables WHERE receiveID = '$receiveID' AND receiveNo = '$receiveNo'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$receiveTotal = rupiah($dataMain['receiveTotal']);
		$incomingTotal = rupiah($dataMain['incomingTotal']);
		$reductionTotal = rupiah($dataMain['reductionTotal']);
		$s = $dataMain['receiveTotal'] - ($dataMain['incomingTotal'] + $dataMain['reductionTotal']);
		
		if ($s <= 0)
		{
			$sisa = 0;
		}
		else
		{
			$sisa = rupiah($s);
		}
		
		$dateNow = tgl_indo2(date('Y-m-d'));
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 140mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
                                CV. SMARTINDO TELEKOM
								</div>
							</td>
							<td style='width: 93mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar<br>Bogor, Jawa Barat
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>RINCIAN BUKTI PEMBAYARAN PIUTANG</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 35mm;'>$dataMain[receiveNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Total Piutang</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 35mm;'>$receiveTotal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Customer :</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dateNow</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Sudah Dibayar</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$incomingTotal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[customerName]</td>
						</tr>
						<tr valign='top'>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Nomor Faktur</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataMain[invoiceNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Pengurangan</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$reductionTotal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3' rowspan='2'>$dataMain[customerAddress]</td>
						</tr>
						<tr valign='top'>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Sisa</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$sisa</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'></td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOMOR</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TANGGAL</th>
							<th style='width: 30mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>CARA BAYAR</th>
							<th style='width: 90mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>BANK</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TGL EFEKTIF</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: right;'>TOTAL</th>
						</tr>";
						
						// showing the payment detail
						$queryPayment = "SELECT * FROM as_sales_payments WHERE invoiceNo = '$dataMain[invoiceNo]' AND invoiceID = '$dataMain[invoiceID]' ORDER BY paymentDate ASC";
						$sqlPayment = mysqli_query($connect, $queryPayment);
						
						// fetch data
						$i = 1;
						while ($dataPayment = mysqli_fetch_array($sqlPayment))
						{
							$paymentDt = tgl_indo2($dataPayment['paymentDate']);
							
							if ($dataPayment['payType'] == '1')
							{
								$pType = "Tunai";
							}
							elseif ($dataPayment['payType'] == '2')
							{
								$pType = "Transfer";
							}
							elseif ($dataPayment['payType'] == '3')
							{
								$pType = "Cek";
							}
							else
							{
								$pType = "Giro";
							}
							
							if ($dataPayment['effectiveDate'] == '0000-00-00')
							{
								$effectiveDate = "-";
							}
							else
							{
								$effectiveDate = tgl_indo2($dataPayment['effectiveDate']);
							}
							
							$total = rupiah($dataPayment['total']);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPayment[paymentNo]</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt;'>$paymentDt</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$pType</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataPayment[bankName] / $dataPayment[bankNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$effectiveDate</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$total</td>
									</tr>
							"; 
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'><br><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi</td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: right; width: 100mm;'>
								<table>
									<tr>
										<td style='width: 60mm; text-align: right;'>Total Sudah Dibayar</td>
										<td style='width: 5mm;'>:</td>
										<td style='text-align: right; width: 35mm;'>$incomingTotal</td>
									</tr>
								</table>
							</td>
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