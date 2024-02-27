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
		
		$filename="supplier.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
                                  CV. SMARTINDO TELEKOM
								</div>
								<span style='font-size: 10pt;'>Jl. Ring Road No.17C, Tj. Sari, Kec. Medan Tuntungan<br>Kota Medan, Sumatera Utara 20133</span>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA SUPPLIER</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NO</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE</th>
							<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NAMA SUPPLIER</th>
							<th style='width: 50mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KONTAK PERSON</th>
							<th style='width: 90mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>ALAMAT</th>
							<th style='width: 35mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KOTA</th>
							<th style='width: 27mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>TLP</th>
						</tr>";
						
						// showing the supplier
						$querySupplier = "SELECT * FROM as_suppliers WHERE supplierCode LIKE '%$q%' OR supplierName LIKE '%$q%' ORDER BY supplierCode ASC";
						$sqlSupplier = mysqli_query($connect, $querySupplier);
						
						// fetch data
						$i = 1;
						while ($dtSupplier = mysqli_fetch_array($sqlSupplier))
						{
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[supplierCode]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[supplierName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[contactPerson]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[address]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[city]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtSupplier[phone]</td>
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