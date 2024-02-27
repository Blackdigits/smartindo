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
			
			$("#transfer").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var qty = parseInt($("#qty").val());
				var stock = parseInt($("#stock1").val());
				var desc = $("#desc").val();
				
				if (detailID != '' && qty != '' && stock != ''){
				
					if (qty > stock) {
						alert("Qty tidak mencukupi jumlah stok.");
						return false;
					}
					else{
						$.ajax({
							type: 'POST',
							url: 'save_edit_transfer.php',
							dataType: 'JSON',
							data:{
								detailID: detailID,
								qty: qty,
								stock: stock,
								desc: desc
							},
							beforeSend: function (data) {
								$('#send').hide();
							},
							success: function(data) {
								parent.jQuery.fancybox.close();
							}
						});
					}
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'transfer' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Item</h3></td>
		</tr>
		<tr>
			<td>
				<form id="transfer" name="transfer" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="{$detailID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Produk</td>
						<td width="5">:</td>
						<td><input type="text" id="productBarcode" value="{$productCode}" name="productBarcode" class="form-control" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td><input type="text" value="{$productName}" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td><input type="hidden" value="{$stock}" id="stock1" name="stock1" class="form-control">
							<input type="text" value="{$stock}" id="stock" name="stock" class="form-control" placeholder="Jumlah Stok" style="width: 270px;" DISABLED>
						</td>
					</tr>
					<tr>
						<td>Qty</td>
						<td>:</td>
						<td><input type="number" value="{$qty}" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Note</td>
						<td>:</td>
						<td><input type="text" value="{$note}" id="desc" name="desc" class="form-control" placeholder="Note" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>