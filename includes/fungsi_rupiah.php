<?php
function rupiah($angka){
	//$rupiah=number_format($angka,0,',','.');
	$rupiah = number_format($angka, 2, ',', '.');
	return $rupiah;
}
?> 