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
	
	if ($module == 'so' && $act == 'print')
	{
		$soID = $_GET['soID'];
		$soFaktur = $_GET['soFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_sales_order.pdf";
		$content = ob_get_clean();
		
		// showing up the main sales order data
		$queryMain = "SELECT * FROM as_sales_order WHERE soID = '$soID' AND soFaktur = '$soFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$orderDate = tgl_indo2($dataMain['orderDate']); 
		
        $querySt = "SELECT supplierName, supplierCode FROM `as_suppliers` WHERE supplierID = '$dataMain[needDate]'";
		$sqlSt = mysqli_query($connect, $querySt);
		$dataSt = mysqli_fetch_array($sqlSt);

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
							<td><span style='font-size: 8pt;'>Jl. Ring Road No.17C, Tj. Sari, Kec. Medan Tuntungan<br>Kota Medan, Sumatera Utara 20133
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>SALES ORDER</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[soFaktur]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$orderDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[customerName]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Nama Sales</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataSt[supplierName]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[customerAddress]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 81mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>HARGA</th>
							<th style='width: 15mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>QTY</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SUBTOTAL</th>
							<th style='width: 80mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOTE</th>
						</tr>";
						
						// showing the sales order detail
						$querySoDetail = "SELECT * FROM as_detail_so WHERE soFaktur = '$soFaktur' AND soNo = '$dataMain[soNo]' ORDER BY detailID ASC";
						$sqlSoDetail = mysqli_query($connect, $querySoDetail);
						
						// fetch data
						$i = 1;
						while ($dtSoDetail = mysqli_fetch_array($sqlSoDetail))
						{
							$subtotal = $dtSoDetail['qty'] * $dtSoDetail['price'];
							$subtotalrp = rupiah($subtotal);
							
							$price = rupiah($dtSoDetail['price']);
							
							$note = chunk_split($dtSoDetail['note'], 42, "<br>");
							$productName = chunk_split($dtSoDetail['productName'], 35, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtSoDetail[qty]</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$subtotalrp</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$note</td>
									</tr>
							";
							
							$i++;
						}
			$content .= "
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr>
							<td style='width: 160mm;'><p style='padding: 5px 0px 5px 0px; font-size: 8pt;'>Note : <br>$dataMain[note]</p></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 40mm;'>HORMAT KAMI,</td>
						</tr>
						<tr>
							<td style='width: 160mm;'></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 30mm;'><br><br><br><br>Administrasi</td>
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