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
		
		$filename="transfer.pdf";
		$content = ob_get_clean();
		
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
							<td>
								<span style='font-size: 11pt;'><b>TRANSFER GUDANG</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 18mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>ID TRF</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TANGGAL</th>
							<th style='width: 38mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>FROM</th>
							<th style='width: 38mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TO</th>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO</th>
							<th style='width: 84mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 15mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>QTY</th>
						</tr>";
						
						// showing the transfer
						$queryTransfer = "SELECT * FROM as_transfers ORDER BY transferID DESC";
						$sqlTransfer = mysqli_query($connect, $queryTransfer);
						
						// fetch data
						$i = 1;
						while ($dtTransfer = mysqli_fetch_array($sqlTransfer))
						{
							$trxDate = tgl_indo2($dtTransfer['trxDate']);
							
							// factory from
							$queryFrom = "SELECT factoryName FROM as_factories WHERE factoryID = '$dtTransfer[transferFrom]'";
							$sqlFrom = mysqli_query($connect, $queryFrom);
							$dataFrom = mysqli_fetch_array($sqlFrom);
							
							// factory to
							$queryTo = "SELECT factoryName FROM as_factories WHERE factoryID = '$dtTransfer[transferTo]'";
							$sqlTo = mysqli_query($connect, $queryTo);
							$dataTo = mysqli_fetch_array($sqlTo);
							
							// showing up the detail transfer
							$queryDetail = "SELECT * FROM as_detail_transfers WHERE transferFaktur = '$dtTransfer[transferFaktur]' AND transferCode = '$dtTransfer[transferCode]'";
							$sqlDetail = mysqli_query($connect, $queryDetail);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtTransfer[transferCode]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$trxDate</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataFrom[factoryName]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataTo[factoryName]</td>
										<td colspan='3'></td>
									</tr>
							";
							
							// fetch data
							$k = 1;
							while ($dtDetail = mysqli_fetch_array($sqlDetail))
							{
								
								$content .= "
									<tr valign='top'>
										<td colspan='5'></td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$k</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[productName]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[qty]</td>
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