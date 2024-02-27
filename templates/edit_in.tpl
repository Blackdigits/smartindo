<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#in").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var bbmNo = $("#bbmNo").val();
				var price = $("#price").val();
				var kursID = $("#kursID").val();
				var valas = $("#valas").val();
				var kurs = $("#kurs").val();
				
				if (detailID != '' && bbmNo != '' && price != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_in.php',
						dataType: 'JSON',
						data:{
							detailID: detailID,
							bbmNo: bbmNo,
							price: price,
							kursID: kursID,
							valas: valas,
							kurs: kurs
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'in' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Koreksi Harga</h3></td>
		</tr>
		<tr>
			<td>
				<p style="font-size: 11pt;">Koreksi ini akan menyebabkan harga HPP / pembelian produk berubah menyesuakan transaksi pembelian terakhir.</p>
				<form id="in" name="in" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="{$detailID}">
				<input type="hidden" id="bbmNo" name="bbmNo" value="{$bbmNo}">
				<input type="hidden" id="kursID" name="kursID" value="{$kursID}">
				<input type="hidden" id="valas" name="valas" value="{$valas}">
				<input type="hidden" id="kurs" name="kurs" value="{$kurs}">
				<table cellpadding="3" cellspacing="3">
					<tr>
						<td width="130">Nama Produk</td>
						<td width="5">:</td>
						<td><input type="text" id="productName" name="productName" value="{$productName}" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Valas</td>
						<td>:</td>
						<td><input type="text" id="valas" name="valas" value="{$valas}" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Kurs</td>
						<td>:</td>
						<td><input type="text" id="kurs" name="kurs" value="{$kursrp}" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Harga</td>
						<td>:</td>
						<td><input type="text" id="price" name="price" value="{$price}" class="form-control" style="width: 270px;" placeholder="Koreksi Harga" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>