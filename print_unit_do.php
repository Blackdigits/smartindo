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
	
	if ($module == 'do' && $act == 'print')
	{
		$doID = $_GET['doID'];
		$doNo = $_GET['doNo'];
		$doFaktur = $_GET['doFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_delivery_order.pdf";
		$content = ob_get_clean();
		
		// showing up the main do data
		$queryMain = "SELECT * FROM as_delivery_order WHERE doID = '$doID' AND doFaktur = '$doFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$orderDate = tgl_indo2($dataMain['orderDate']);
		$needDate = tgl_indo2($dataMain['needDate']);
		$deliveredDate = tgl_indo2($dataMain['deliveredDate']);
		
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
							<td><span style='font-size: 8pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar<br>Bogor, Jawa Barat
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>SURAT JALAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[doNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$deliveredDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[customerName]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Sales</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>-</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[customerAddress]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 100mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML</th>
							<th style='width: 105mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOTE</th>
						</tr>";
						
						// showing the delivery order detail
						$queryDoDetail = "SELECT * FROM as_detail_do WHERE doFaktur = '$doFaktur' AND doNo = '$doNo' ORDER BY doID ASC";
						$sqlDoDetail = mysqli_query($connect, $queryDoDetail);
						
						// fetch data
						$i = 1;
						while ($dtDoDetail = mysqli_fetch_array($sqlDoDetail))
						{
							$note = chunk_split($dtDoDetail['note'], 42, "<br>");
							$productName = chunk_split($dtDoDetail['productName'], 35, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDoDetail[deliveredQty]</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt;'>$note</td>
									</tr>
							";
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr>
							<td style='width: 150mm;'><p style='padding: 5px 0px 5px 0px; font-size: 8pt;'><b>PERHATIAN :</b>
							Mohon diperiksa kembali barang-barang yang kami kirim dengan seksama<br>
							Barang2 yang telah dibeli tidak dapat ditukar/dikembalikan (terutama electric parts), kecuali ada perjanjian<br>
							Tukar/Retur atau Claim hanya dilayani dalam 10 (sepuluh) hari kerja tanggal pembelian/pengiriman</p></td>
							<td></td>
						</tr>
						<tr>
							<td style='padding: 5px 0px 5px 150px; font-size: 8pt; width: 50mm;'><br>PENERIMA,</td>
							<td style='padding: 5px 0px 5px 0px; font-size: 8pt; text-align: center; width: 50mm;'><br>HORMAT KAMI,</td>
						</tr>
						<tr>
							<td style='font-size: 8pt; padding-left: 150px;'><br><br><br><br>(Nama Jelas)</td>
							<td style='padding: 5px 0px 5px 0px; font-size: 8pt; text-align: center; width: 30mm;'><br><br><br><br>Administrasi</td>
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