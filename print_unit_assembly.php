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
	
	if ($module == 'assembly' && $act == 'print')
	{
		$assemblyID = $_GET['assemblyID'];
		$assemblyFaktur = $_GET['assemblyFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_assembly.pdf";
		$content = ob_get_clean();
		
		// showing up the main sales order data
		$queryMain = "SELECT * FROM as_assembly WHERE assemblyID = '$assemblyID' AND assemblyFaktur = '$assemblyFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$subtotal = rupiah($dataMain['subtotal']);
		$cost = rupiah($dataMain['cost']);
		$grandtotal = rupiah($dataMain['grandtotal']);
		
		$assemblyDate = tgl_indo2($dataMain['assemblyDate']);
		
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
								<span style='font-size: 11pt;'><b>ASSEMBLY</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 30mm;'>Kode</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 88mm;'>$dataMain[assemblyCode]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 20mm;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 118mm;'>$assemblyDate</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Kode Item</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataMain[productCode]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;>Qty</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;>$dataMain[qty]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Nama Item</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataMain[productName]</td>
							<td colspan='3'></td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 120mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>HARGA</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>QTY</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SUBTOTAL</th>
						</tr>";
						
						// showing the assembly detail
						$queryAssemblyDetail = "SELECT * FROM as_detail_assembly WHERE assemblyFaktur = '$assemblyFaktur' AND assemblyID = '$assemblyID' ORDER BY detailID ASC";
						$sqlAssemblyDetail = mysqli_query($connect, $queryAssemblyDetail);
						
						// fetch data
						$i = 1;
						while ($dtAssemblyDetail = mysqli_fetch_array($sqlAssemblyDetail))
						{
							$subt = $dtAssemblyDetail['qty'] * $dtAssemblyDetail['price'];
							$subtotalrp = rupiah($subt);
							
							$price = rupiah($dtAssemblyDetail['price']);
							
							$note = chunk_split($dtAssemblyDetail['note'], 42, "<br>");
							$productName = chunk_split($dtAssemblyDetail['productName'], 35, "<br>");
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtAssemblyDetail[qty]</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$subtotalrp</td>
									</tr>
							";
							
							$i++;
						}
			$content .= 
						"
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right; width: 193mm;'>Subtotal</td>
							<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$subtotal</td>
						</tr>
						<tr>
							<td style='padding: 2px 30px 2px 0px; text-align: right; font-size: 9pt;'>Cost</td>
							<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$cost</td>
						</tr>
						<tr>
							<td style='padding: 2px 30px 2px 0px; text-align: right; font-size: 9pt;'>Total</td>
							<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$grandtotal</td>
						</tr>
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr>
							<td style='width: 160mm;'></td>
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