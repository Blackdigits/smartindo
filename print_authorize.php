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
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="authorize.pdf";
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
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA OTORISASI LEVEL</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NO.</th>
							<th style='width: 80mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NAMA MODUL</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>STATUS</th>
							<th style='width: 170mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>OTORISASI</th>
						</tr>";
						
						// showing the modules
						$queryModul = "SELECT * FROM as_modules ORDER BY modulID ASC";
						$sqlModul = mysqli_query($connect, $queryModul);
						
						// fetch data
						$i = 1;
						while ($dtModul = mysqli_fetch_array($sqlModul))
						{
							$a = str_replace("1", " ADMINISTRATOR", $dtModul['authorize']);
							$b = str_replace("2", " SALES", $a);
							$c = str_replace("3", " KASIR", $b);
							$d = str_replace("4", " SPV", $c);
							$e = str_replace("5", " TOP", $d); 
							$f = str_replace("0", "", $e);
							$g = str_replace(",,,", ",", $f);
							$h = str_replace(",,", ",", $g);
							
							$modulName = strtoupper($dtModul['modulName']);
		
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$modulName</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$dtModul[status]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 9pt;'>$h</td>
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