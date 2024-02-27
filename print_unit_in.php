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
	
	if ($module == 'in' && $act == 'print')
	{
		$invoiceID = $_GET['invoiceID'];
		$invoiceNo = $_GET['invoiceNo'];
		$bbmNo = $_GET['bbmNo'];
		$now = date('Y-m-d');
		
		$filename="faktur_pembelian.pdf";
		$content = ob_get_clean();
		
		// showing up the main invoice data
		$queryMain = "SELECT * FROM as_buy_transactions WHERE invoiceID = '$invoiceID' AND invoiceNo = '$invoiceNo'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$invoiceDate = tgl_indo2($dataMain['invoiceDate']);
		
		if ($dataMain['expiredPayment'] == '0000-00-00')
		{
			$expiredPayment = "-";
		}
		else
		{
			$expiredPayment = tgl_indo2($dataMain['expiredPayment']);
		}
		
		if ($dataMain['paymentType'] == '1')
		{
			$paymentType = "Tunai";
		}
		else
		{
			$paymentType = "Termin";
		}
		
		if ($dataMain['ppnType'] == '1')
		{
			$ppnType = "PPN";
		}
		else
		{
			$ppnType = "No PPN";
		}
		
		$ppn = rupiah($dataMain['ppn']);
		$total = rupiah($dataMain['total']);
		$basic = rupiah($dataMain['basic']);
		$discount = rupiah($dataMain['discount']);
		$grandtotal = rupiah($dataMain['grandtotal']);
		$pay = rupiah($dataMain['pay']);
		$kurs = rupiah($dataMain['kurs']);
		
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
							<td><span style='font-size: 8pt;'>Bukit Cimanggu City Blok J2 No.20. Jl.KH.Shaleh Iskandar<br>Bogor, Jawa Barat
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>FAKTUR PEMBELIAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor Faktur</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 35mm;'>$dataMain[invoiceNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor BBM</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 35mm;'>$dataMain[bbmNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$invoiceDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>PPN</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$ppnType</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[supplierName]</td>
						</tr>
						<tr valign='top'>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tipe Bayar</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$paymentType</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3' rowspan='2'>$dataMain[supplierAddress]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Jatuh Tempo</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$expiredPayment</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'></td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 120mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>HARGA</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>QTY</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: right;'>SUBTOTAL</th>
						</tr>";
						
						// showing the bbm detail
						$queryBbmDetail = "SELECT * FROM as_detail_bbm WHERE bbmNo = '$bbmNo' ORDER BY detailID ASC";
						$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
						
						// fetch data
						$i = 1;
						while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
						{
							$productName = chunk_split($dtBbmDetail['productName'], 50, "<br>");
							$subtotal = rupiah($dtBbmDetail['receiveQty'] * $dtBbmDetail['price']);
							$price = rupiah($dtBbmDetail['price']);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtBbmDetail[receiveQty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$subtotal</td>
									</tr>
							";
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi</td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: right; width: 100mm;'>
								<table>
									<tr>
										<td style='width: 60mm; text-align: right;'>Jumlah Harga Beli</td>
										<td style='width: 5mm;'>:</td>
										<td style='text-align: right; width: 35mm;'>$total</td>
									</tr>
									<tr>
										<td style='text-align: right;'>Potongan</td>
										<td>:</td>
										<td style='text-align: right;'>$discount</td>
									</tr>
									<tr>
										<td style='text-align: right;'>Dasar Pengenaan Pajak</td>
										<td>:</td>
										<td style='text-align: right;'>$basic</td>
									</tr>
									<tr>
										<td style='text-align: right;'>PPN ( 10 % )</td>
										<td>:</td>
										<td style='text-align: right;'>$ppn</td>
									</tr>
									<tr>
										<td style='text-align: right;'>Total</td>
										<td>:</td>
										<td style='text-align: right;'><b>$grandtotal</b></td>
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