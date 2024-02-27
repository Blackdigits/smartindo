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
		
		$filename="factory.pdf";
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
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA GUDANG / PABRIK</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Kode Gudang</th>
							<th style='width: 50mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama</th>
							<th style='width: 40mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Tipe</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Status</th>
							<th style='width: 147mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Note</th>
						</tr>";
						
						// showing the factories
						$queryFactory = "SELECT * FROM as_factories WHERE factoryCode LIKE '%$q%' OR factoryName LIKE '%$q%' ORDER BY factoryCode ASC";
						$sqlFactory = mysqli_query($connect, $queryFactory);
						
						// fetch data
						$i = 1;
						while ($dtFactory = mysqli_fetch_array($sqlFactory))
						{
							if ($dtFactory['factoryType'] == '1')
							{
								$factoryType = "TETAP";
							}
							else
							{
								$factoryType = "SEMENTARA (SEWA)";
							}
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtFactory[factoryCode]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtFactory[factoryName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$factoryType</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtFactory[status]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtFactory[note]</td>
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