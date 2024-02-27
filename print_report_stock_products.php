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
		$categoryID = mysqli_real_escape_string($connect, $_GET['categoryID']);
		$now = date('Y-m-d');
		
		$filename="laporan_stok_produk.pdf";
		$content = ob_get_clean();
		
		$date = date('d-m-Y');
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 140mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									CV. Smartindo Telekom
								</div>
							</td>
							<td style='width: 93mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>Jl. Ring Road No.17C, Tj. Sari, Kec. Medan Tuntungan<br>Kota Medan, Sumatera Utara 20133
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>LAPORAN STOK PRODUK</b><br>Tanggal : $date</span> 
							</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 85mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KODE - NAMA PRODUK</th>";
									if ($categoryID != '')
									{
										$queryFac = "SELECT * FROM as_factories WHERE status = 'Y' AND factoryID = '$categoryID' ORDER BY factoryID ASC";
									}
									else
									{
										$queryFac = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryID ASC";
									}
							$sqlFac = mysqli_query($connect, $queryFac);
							while ($dtFac = mysqli_fetch_array($sqlFac))
							{
								$content .= "<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>$dtFac[factoryName]</th>";
							}
							
						$content .= "
								<th style='width: 20mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>TOTAL</th>	
						</tr>";
						 
						$queryStock = "SELECT * FROM as_products ORDER BY productCode ASC"; 
						$sqlStock = mysqli_query($connect, $queryStock);
						
						// fetch data
						$i = 1;
						while ($dataStock = mysqli_fetch_array($sqlStock))
						{
							if ($dataStock['unit'])
							{
								$unit = "SET";
							}
							else
							{
								$unit = "PCS";
							}
							
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataStock[productName]</td>";
										
							if ($categoryID != '')
							{ 
									$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' AND factoryID = '$categoryID' ORDER BY factoryID ASC";
							}
							else
							{
									$queryFactory = "SELECT * FROM as_factories WHERE status = 'Y' ORDER BY factoryID ASC";
							}
										$sqlFactory = mysqli_query($connect, $queryFactory);
							$total = array();
							while ($dtFactory = mysqli_fetch_array($sqlFactory))
							{
								$querySP = "SELECT SUM(stock) as total, stock FROM as_stock_products WHERE productID = '$dataStock[productID]' AND factoryID = '$dtFactory[factoryID]'";
								$sqlSP = mysqli_query($connect, $querySP);
								$dtSP = mysqli_fetch_array($sqlSP);
								
								$total[] = $dtSP['total'];
				
								$content .= "<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtSP[stock]</td>";
							}
							
							$sum = array_sum($total);
							
							$content .= "
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$sum</td>	
									</tr>
							"; 
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 100mm;'>
								<br><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi
							</td>
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