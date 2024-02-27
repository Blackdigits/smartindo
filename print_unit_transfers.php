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
	
	if ($module == 'transfer' && $act == 'print')
	{
		$transferID = $_GET['transferID'];
		$transferFaktur = $_GET['transferfaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_transfer.pdf";
		$content = ob_get_clean();
		
		// showing up the main transfer data
		$queryMain = "SELECT * FROM as_transfers WHERE transferID = '$transferID' AND transferFaktur = '$transferFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		// transferFrom
		$queryFrom = "SELECT factoryName FROM as_factories WHERE factoryID = '$dataMain[transferFrom]'";
		$sqlFrom = mysqli_query($connect, $queryFrom);
		$dataFrom = mysqli_fetch_array($sqlFrom);
		
		// transfer to
		$queryTo = "SELECT factoryName FROM as_factories WHERE factoryID = '$dataMain[transferTo]'";
		$sqlTo = mysqli_query($connect, $queryTo);
		$dataTo = mysqli_fetch_array($sqlTo);
		
		$trxDate = tgl_indo2($dataMain['trxDate']);
		
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
							<td><span style='font-size: 8pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar<br>Bogor, Jawa Barat
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>TRANSFER GUDANG</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 20mm;'>Id Trf / Tgl</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[transferCode] / $trxDate</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 20mm;'>From</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 116mm;'>$dataFrom[factoryName]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Ref</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataMain[ref]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>To</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataTo[factoryName]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 90mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>QTY</th>
							<th style='width: 115mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NOTE</th>
						</tr>";
						
						// showing the transfer detail
						$queryTransferDetail = "SELECT * FROM as_detail_transfers WHERE transferFaktur = '$transferFaktur' ORDER BY detailID ASC";
						$sqlTransferDetail = mysqli_query($connect, $queryTransferDetail);
						
						// fetch data
						$i = 1;
						while ($dtTransferDetail = mysqli_fetch_array($sqlTransferDetail))
						{
							$content .= "
								<tr>
									<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
									<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtTransferDetail[productName]</td>
									<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtTransferDetail[qty]</td>
									<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$dtTransferDetail[note]</td>
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
		$html2pdf = new HTML2PDF('L', array('240', '130'),'fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>