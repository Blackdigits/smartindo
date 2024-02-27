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
	
	$smarty->assign("startDate", $sDate);
	$smarty->assign("endDate", $eDate);
	
	$s2Date = explode("-", $sDate);
	$e2Date = explode("-", $eDate);
	
	$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
	$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="faktur_penjualan.pdf";
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
								<span style='font-size: 11pt;'><b>FAKTUR PENJUALAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO FAKTUR</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO DO</th>
							<th style='width: 22mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TGL</th>
							<th style='width: 17mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>VALAS</th>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO</th>
							<th style='width: 70mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>HARGA</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>QTY</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SUBTOTAL</th>
						</tr>";
						
						// showing the sales invoice
						if ($sDate != '' && $eDate != '')
						{
							$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo LIKE '%$q%' AND invoiceDate BETWEEN '$startDate' AND '$endDate' ORDER BY invoiceID DESC";
						}
						else
						{
							$querySales = "SELECT * FROM as_sales_transactions WHERE invoiceNo LIKE '%$q%' ORDER BY invoiceID DESC";
						}
						
						$sqlSales = mysqli_query($connect, $querySales);
						
						// fetch data
						$i = 1;
						
						while ($dtSales = mysqli_fetch_array($sqlSales))
						{
							$invoiceDate = tgl_indo2($dtSales['invoiceDate']);
							
							// showing up the detail do
							$queryDetail = "SELECT * FROM as_detail_do WHERE doNo = '$dtSales[doNo]'";
							$sqlDetail = mysqli_query($connect, $queryDetail);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtSales[invoiceNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtSales[doNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$invoiceDate</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtSales[valas]</td>
										<td colspan='4'></td>
									</tr>
							";
							
							// fetch data
							$k = 1;
							$sum = array();
							while ($dtDetail = mysqli_fetch_array($sqlDetail))
							{
								$price = rupiah($dtDetail['price']);
								$subt = $dtDetail['price'] * $dtDetail['deliveredQty'];
								$sum[] = $subt;
								$subtotal = rupiah($subt);
								
								$grand = array_sum($sum);
								
								$content .= "
									<tr valign='top'>
										<td colspan='5'></td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$k</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[productName]</td>
										<td style='padding: 2px 25px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[deliveredQty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$subtotal</td>
									</tr>
								";
								$k++;
							}
							$grandtotal = rupiah($grand);
							$content .= "<tr valign='top'>
											<td colspan='9' style='text-align: right;'><b>Total</b></td>
											<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$grandtotal</td>
										</tr>";
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