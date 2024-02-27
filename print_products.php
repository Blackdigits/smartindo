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
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="product.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									CV. SMARTINDO TELEKOM
								</div>
								<span style='font-size: 10pt;'>Jl. Ring Road No.17C, Tj. Sari, Kec. Medan Tuntungan
                                Kota Medan, Sumatera Utara 20133</span>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA PRODUK</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
							<th style='width: 115mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE - NAMA PRODUK</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>SATUAN</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>HARGA 1</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>HARGA 2</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>HARGA 3</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>HPP</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>STOCK</th>
						</tr>";
						
						// showing the products
						if ($q != '')
						{
							$queryProduct = "SELECT * FROM as_products WHERE productCode LIKE '%$q%' OR productName LIKE '%$q%' ORDER BY productCode ASC";
						}
						else
						{
							$queryProduct = "SELECT * FROM as_products ORDER BY productCode ASC";
						}
						$sqlProduct = mysqli_query($connect, $queryProduct);
						
						// fetch data
						$i = 1;
						while ($dtProduct = mysqli_fetch_array($sqlProduct))
						{
							// count stock product
							$queryStock = "SELECT SUM(stock) as stockAmount FROM as_stock_products WHERE productID = '$dtProduct[productID]'";
							$sqlStock = mysqli_query($connect, $queryStock);
							$dataStock = mysqli_fetch_array($sqlStock);
							
							if ($dtProduct['unit'] == '1')
							{
								$unit = "SET";
							}
							else
							{
								$unit = "PCS";
							}
							
							$unitPrice1 = rupiah($dtProduct['unitPrice1']);
							$unitPrice2 = rupiah($dtProduct['unitPrice2']);
							$unitPrice3 = rupiah($dtProduct['unitPrice3']);
							$hpp = rupiah($dtProduct['hpp']);
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtProduct[productName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$unit</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$unitPrice1</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$unitPrice2</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$unitPrice3</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$hpp</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dataStock[stockAmount]</td>
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
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>