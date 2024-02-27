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
			
			$("#stock").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var numsFactory = $("#numsFactory").val();
				
				var i;
				var gudang = [];
				var stock = [];
				for (i = 1; i <= numsFactory; i++) {
					gudang[i] = $("#gudang"+i).val();
					stock[i] = $("#stock"+i).val();
				} 
				
				if (productID != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_stock.php',
						dataType: 'JSON',
						data:{
							productID: productID,
							numsFactory: numsFactory,
							gudang: gudang,
							stock: stock
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
				

{if $module == 'product' AND $act == 'stock' }
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Stok Gudang</h3></td>
		</tr>
		<tr>
			<td>
				<form id="stock" name="stock" method="POST" action="#">
				<input type="hidden" id="productID" name="productID" value="{$productID}">
				<table>
					<tr valign="top">
						<td>
							<table cellpadding="3" cellspacing="3">
								<tr>
									<td width="130">Nama Produk</td>
									<td width="5">:</td>
									<td><input type="text" value="{$productName}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td><input type="text" value="{$categoryName}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Satuan</td>
									<td>:</td>
									<td><input type="text" value="{$unit}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 1</td>
									<td>:</td>
									<td><input type="text" value="{$unitPrice1}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 2</td>
									<td>:</td>
									<td><input type="text" value="{$unitPrice2}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>Harga 3</td>
									<td>:</td>
									<td><input type="text" value="{$unitPrice3}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
								<tr>
									<td>HPP</td>
									<td>:</td>
									<td><input type="text" value="{$hpp}" id="#" name="#" class="form-control" style="width: 270px;" DISABLED></td>
								</tr>
							</table>
						</td>
						<td>
							<table cellpadding="3" cellspacing="3">
								<input type="hidden" name="numsFactory" id="numsFactory" value="{$numsFactory}">
								{section name=dataFactory loop=$dataFactory}
								<tr>
									<td width="130">{$dataFactory[dataFactory].factoryName}</td>
									<td width="5">:</td>
									<td>
										<input type="hidden" id="gudang{$dataFactory[dataFactory].no}" name="gudang{$dataFactory[dataFactory].no}" class="form-control" value="{$dataFactory[dataFactory].factoryID}" style="width: 270px;">
										<input type="number" id="stock{$dataFactory[dataFactory].no}" name="stock{$dataFactory[dataFactory].no}" class="form-control" value="{$dataFactory[dataFactory].stock}" placeholder="Stok Gudang gudang {$dataFactory[dataFactory].no}" style="width: 270px;"></td>
								</tr>
								{/section}
							</table>
						</td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>