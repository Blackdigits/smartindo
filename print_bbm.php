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
	$sDate = mysqli_real_escape_string($connect, $_GET['startDate']);
	$eDate = mysqli_real_escape_string($connect, $_GET['endDate']);
	
	$s2Date = explode("-", $sDate);
	$e2Date = explode("-", $eDate);
	
	$startDate = $s2Date[2]."-".$s2Date[1]."-".$s2Date[0];
	$endDate = $e2Date[2]."-".$e2Date[1]."-".$e2Date[0];
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="bukti_barang_masuk.pdf";
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
                                <span style='font-size: 11pt;'><b>ALOKASI BARANG MASUK</b></span>
                            </td>
                        </tr>
                    </table>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 18mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO BBM</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO PO</th>
							<th style='width: 38mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>TGL PENERIMAAN</th>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO</th>
							<th style='width: 91mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA PRODUK</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML ORDER</th>
							<th style='width: 23mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>JML TERIMA</th>
						</tr>";
						
						// showing the bbm
						if ($sDate != '' || $eDate != '')
						{
							$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo LIKE '%$q%' AND receiveDate BETWEEN '$startDate' AND '$endDate' ORDER BY bbmID DESC";
						}
						else
						{
							$queryBbm = "SELECT * FROM as_bbm WHERE bbmNo LIKE '%$q%' ORDER BY bbmID DESC";
						}
						
						$sqlBbm = mysqli_query($connect, $queryBbm);
						
						// fetch data
						$i = 1;
						while ($dtBbm = mysqli_fetch_array($sqlBbm))
						{
							$receiveDate = tgl_indo2($dtBbm['receiveDate']);
							
							// showing up the detail bbm
							$queryDetail = "SELECT * FROM as_detail_bbm WHERE bbmFaktur = '$dtBbm[bbmFaktur]' AND bbmNo = '$dtBbm[bbmNo]'";
							$sqlDetail = mysqli_query($connect, $queryDetail);
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtBbm[bbmNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtBbm[spbNo]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$receiveDate</td>
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
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[qty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dtDetail[receiveQty]</td>
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