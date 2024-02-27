<?php
function tgl_indo($tgl){
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function getBulan($bln){
	switch ($bln){
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februaiy";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function tgl_indo2($tgl){
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan2(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.'-'.$bulan.'-'.$tahun;		 
}	

function getBulan2($bln){
	switch ($bln){
		case 1: 
			return "01";
			break;
		case 2:
			return "02";
			break;
		case 3:
			return "03";
			break;
		case 4:
			return "04";
			break;
		case 5:
			return "05";
			break;
		case 6:
			return "06";
			break;
		case 7:
			return "07";
			break;
		case 8:
			return "08";
			break;
		case 9:
			return "09";
			break;
		case 10:
			return "10";
			break;
		case 11:
			return "11";
			break;
		case 12:
			return "12";
			break;
	}
}  
?>
