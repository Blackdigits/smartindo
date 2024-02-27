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
		
		$filename="delivery_order.pdf";
		$content = ob_get_clean();
		
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
								<span style='font-size: 11pt;'><b>SURAT JALAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO DO</th>
							<th style='width: 25mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO SO</th>
							<th style='width: 38mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TGL</th>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO</th>
							<th style='width: 112mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #00; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML</th>
						</tr>";
						
						// showing the do
						$queryDo = "SELECT * FROM as_delivery_order WHERE doNo LIKE '%$q%' ORDER BY doID DESC";
						$sqlDo = mysqli_query($connect, $queryDo);
						
						// fetch data
						$i = 1;
						while ($dtDo = mysqli_fetch_array($sqlDo))
						{
							$deliveredDate = tgl_indo2($dtDo['deliveredDate']);
							
							// showing up the detail do
							$queryDetail = "SELECT * FROM as_detail_do WHERE doFaktur = '$dtDo[doFaktur]' AND doNo = '$dtDo[doNo]'";
							$sqlDetail = mysqli_query($connect, $queryDetail);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDo[doNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDo[soNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$deliveredDate</td>
										<td colspan='4'></td>
									</tr>
							";
							
							// fetch data
							$k = 1;
							while ($dtDetail = mysqli_fetch_array($sqlDetail))
							{
								
								$content .= "
									<tr valign='top'>
										<td colspan='4'></td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$k</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[productName]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[deliveredQty]</td>
									</tr>
								";
								$k++;
							}
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
		$html2pdf = new HTML2PDF('L', array('240', '130'),'fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>