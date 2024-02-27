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
	
	if ($module == 'bbm' && $act == 'print')
	{
		$bbmID = $_GET['bbmID'];
		$bbmNo = $_GET['bbmNo'];
		$bbmFaktur = $_GET['bbmFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_bbm.pdf";
		$content = ob_get_clean();
		
		// showing up the main transfer data
		$queryMain = "SELECT * FROM as_bbm WHERE bbmID = '$bbmID' AND bbmFaktur = '$bbmFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$orderDate = tgl_indo2($dataMain['orderDate']);
		$needDate = tgl_indo2($dataMain['needDate']);
		$receiveDate = tgl_indo2($dataMain['receiveDate']);
		
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
								<span style='font-size: 11pt;'><b>ALOKASI BARANG MASUK</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor BBM / PO</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[bbmNo] / $dataMain[spbNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tgl. Penerimaan</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$receiveDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[supplierName]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tgl. Order/Dibutuhkan</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$orderDate / $needDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[supplierAddress]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 75mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML ORDER</th>
							<th style='width: 25mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML DITERIMA</th>
							<th style='width: 45mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>GUDANG</th>
							<th style='width: 55mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOTE</th>
						</tr>";
						
						// showing the bbm detail
						$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmFaktur = '$bbmFaktur' AND bbmNo = '$bbmNo' ORDER BY detailID ASC";
						$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
						
						// fetch data
						$i = 1;
						while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
						{
							$note = chunk_split($dtBbmDetail['note'], 42, "<br>");
							$productName = chunk_split($dtBbmDetail['productName'], 35, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtBbmDetail[qty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtBbmDetail[receiveQty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtBbmDetail[factoryName]</td>
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