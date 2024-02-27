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
	
	if ($act == 'print')
	{
		$customerID = mysqli_real_escape_string($connect, $_GET['customerID']);
		$invoiceNo = mysqli_real_escape_string($connect, $_GET['invoiceNo']);
		$sDate = explode("-", $_GET['startDate']);
		$startDate = $sDate[2]."-".$sDate[1]."-".$sDate[0];
		$eDate = explode("-", $_GET['endDate']);
		$endDate = explode("-", $_GET['endDate']);
		$now = date('Y-m-d');
		
		$filename="kartu_piutang.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 140mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PT. CAHAYA MATAHARI PRIMA
								</div>
							</td>
							<td style='width: 93mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>No. NPWP : 02.860.734.9-032.000 <br>
								No. PKP : 02.860.734.9-032.000 <br>
								No. Pengukuhan : PEM-00014/WPJ.05.0303/2009 <br>
								Tanggal : 08 Januari 2009
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>KARTU PIUTANG</b></span>
							</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOMOR</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO FAKTUR</th>
							<th style='width: 70mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>CUSTOMER</th>
							<th style='width: 18mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>VALAS</th>
							<th style='width: 23mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TOTAL</th>
							<th style='width: 23mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>INCOMING</th>
							<th style='width: 23mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>REDUCTION</th>
							<th style='width: 23mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: right;'>SISA</th>
						</tr>";
						
						// showing the payment detail
						if ($_GET['startDate'] != '' && $_GET['endtDate'] != '')
						{
							if ($invoiceNo != '' && $customerID == '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
							}
							elseif ($invoiceNo == '' && $customerID != '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
							}
							elseif ($invoiceNo != '' && $customerID != '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.customerID = '$customerID' AND B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
							}
							else
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE B.invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY A.createdDate DESC";
							}
						}
						else
						{
							if ($invoiceNo != '' && $customerID == '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' ORDER BY A.createdDate DESC";
							}
							elseif ($invoiceNo == '' && $customerID != '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.customerID = '$customerID' ORDER BY A.createdDate DESC";
							}
							elseif ($invoiceNo != '' && $customerID != '')
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID WHERE A.invoiceNo LIKE '%$invoiceNo%' AND A.customerID = '$customerID' ORDER BY A.createdDate DESC";
							}
							else
							{
								$queryReceive = "SELECT * FROM as_receivables A INNER JOIN as_sales_transactions B ON A.invoiceID=B.invoiceID ORDER BY A.createdDate DESC";
							}
						}
						
						$sqlReceive = mysqli_query($connect, $queryReceive);
						
						// fetch data
						$i = 1;
						while ($dataReceive = mysqli_fetch_array($sqlReceive))
						{
							$total = rupiah($dataReceive['receiveTotal']);
							$incomingTotal = rupiah($dataReceive['incomingTotal']);
							$reductionTotal = rupiah($dataReceive['reductionTotal']);
							$sisa = rupiah($dataReceive['receiveTotal'] - ($dataReceive['incomingTotal'] + $dataReceive['reductionTotal']));
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataReceive[receiveNo]</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt;'>$dataReceive[invoiceNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataReceive[customerName]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataReceive[valas]</td>
										<td style='padding: 2px 10px 2px 0px; font-size: 9pt; text-align: right;'>$total</td>
										<td style='padding: 2px 10px 2px 0px; font-size: 9pt; text-align: right;'>$incomingTotal</td>
										<td style='padding: 2px 10px 2px 0px; font-size: 9pt; text-align: right;'>$reductionTotal</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$sisa</td>
									</tr>
							"; 
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 100mm;'>
								<br><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi
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