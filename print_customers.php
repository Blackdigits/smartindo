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
		
		$filename="customer.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PUSTAKA AN-NAHDLAH
								</div>
								<span style='font-size: 10pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar, Bogor, Jawa Barat</span>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA CUSTOMER</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NO</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE</th>
							<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NAMA CUSTOMER</th>
							<th style='width: 50mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KONTAK PERSON</th>
							<th style='width: 90mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>ALAMAT</th>
							<th style='width: 35mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KOTA</th>
							<th style='width: 27mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>TLP</th>
						</tr>";
						
						// showing the customer
						if ($q != '')
						{
							$queryCustomer = "SELECT * FROM as_customers WHERE customerCode LIKE '%$q%' OR customerName LIKE '%$q%' OR city LIKE '%$q%' ORDER BY customerCode ASC";
						}
						else
						{
							$queryCustomer = "SELECT * FROM as_customers ORDER BY customerCode ASC";
						}
						$sqlCustomer = mysqli_query($connect, $queryCustomer);
						
						// fetch data
						$i = 1;
						while ($dtCustomer = mysqli_fetch_array($sqlCustomer))
						{
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[customerCode]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[customerName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[contactPerson]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[address]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[city]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtCustomer[phone1]</td>
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