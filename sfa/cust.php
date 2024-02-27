<?php
$judul = 'TOKO'; 
include 'header.php'; 
include 'config.php';   
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body><!--
<a href="cust.php?sinkron=go">Sinkron Database Toko</a>
<input type="text" id="search" placeholder="Cari . . .">-->
<div>
<table style="width:100%" id="example">
	<thead>
		<tr>
			<th>Kode Toko</th>
			<th>Nama Toko</th>
			<th><i class="material-icons">store</i></th>
			<th>Kontak</th>
		</tr>
	</thead>
	<tbody> 
    <?php  
        $queryProduct = "SELECT customerCode,customerName,address,phonecp1 FROM `as_customers`;";
        $sqlProduct = mysqli_query($connect, $queryProduct); 
        while ($dtProduct = mysqli_fetch_array($sqlProduct)) {
            $phone = substr($dtProduct['phonecp1'], 1);
        ?>

		<tr>
			<td><?= $dtProduct['customerCode']; ?> </td>
			<td><?= $dtProduct['customerName']; ?> </td>
			<td><a href="maps.google.com"><i class="material-icons">map</i></a></td>
			<td><a href="#" id="<?= $phone; ?>" onClick="showup('<?= $phone; ?>');">Lihat</a></td>
		</tr>
	
	<?php } ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
new DataTable('#example');
function showup(no) { 
    document.getElementById(no).innerHTML = no;
} /*
var $rows = $('#table tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});*/
</script>
</body>
</html> 