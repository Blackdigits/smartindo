<?php
include "header.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header("Cache-Control: no-cache, must-revalidate");
 header("Expires: 0"); 
 header('Content-Transfer-Encoding: binary');
 header("Content-Disposition: attachment;filename=123.xls");
 
// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	
	ob_start();
//	require ("includes/html2pdf/html2pdf.class.php");
	//require_once "excel_class.php";
	$act = $_GET['act'];
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
	//	$filename="customer.xls";
		$q = mysqli_real_escape_string($connect, $_GET['q']);
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
                                  CV. SMARTINDO TELEKOM
								</div>
								<span style='font-size: 10pt;'>Bukit Cimanggu City Blok J2 No.20, Jl.KH.Shaleh Iskandar, Bogor, Jawa Barat</span>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA STAFF</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NO</th>
							<th style='width: 32mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE</th>
							<th style='width: 70mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NAMA STAFF</th>
							<th style='width: 45mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>TLP</th>
							<th style='width: 50mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>POSITION</th>
							<th style='width: 20mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>STATUS</th>
							<th style='width: 65mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>EMAIL</th>
						</tr>";
						
						// showing the staff
						if ($q != '')
						{
							$queryStaff = "SELECT * FROM as_staffs WHERE staffCode LIKE '%$q%' OR staffName LIKE '%$q%' AND staffID != '1' ORDER BY staffCode ASC";
						}
						else
						{
							$queryStaff = "SELECT * FROM as_staffs WHERE staffID != '1' ORDER BY staffCode ASC";
						}
						
						$sqlStaff= $mysqli->query($connect,$queryStaff);
                         $arrmhs = array();
                                   while ($row = $sql->fetch_assoc()) {
	                               array_push($arrmhs, $row);
                                  }
								  
								  $excel = new Excel();
#Send Header
$excel->setHeader('contoh-2.xls');
$excel->BOF();
 
#header tabel
$excel->writeLabel(0, 0, "ID");
$excel->writeLabel(0, 1, "KODE");
$excel->writeLabel(0, 2, "NAMA");
$excel->writeLabel(0, 3, "PHONE");
$excel->writeLabel(0, 4, "POSITION");
$excel->writeLabel(0, 5, "EMAIL");

				$content .=		// fetch data
						$i = 1;
						
						foreach ($arrmhs as $baris) {
							$j = 0;
							foreach ($baris as $value) {
		                              $excel->writeLabel($i, $j, $value);
		                              $j++;
	                                 }
									 /*
							$content .= "
                                <tr>
                                 <td>" . $no++ . ".</td>
                                 <td>" . $data['staffCode'] . "</td>
                                 <td>" . $data['staffName'] . "</td>
                                 <td>" . $data['phone'] . "</td>
								 <td>" . $data['position'] . "</td>
								 <td>" . $data['status'] . "</td>
								 <td>" . $data['email'] . "</td>
                                </tr>*/
							;  
							$i++;
						}
		 $excel->EOF();
         // readfile('123.xlsx');
         exit();
	}
}

?>