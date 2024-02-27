<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#product").submit(function() { return false; });
			
			// Image
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			new AjaxUpload(btnUpload, {
				action: 'upload_product.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
	                    // extension is not allowed 
						mestatus.text('Hanya ekstensi .JPG/JPEG yang diijinkan.');
						return false;
					}
					//mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
					mestatus.html('');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text('');
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response!=="error"){
						$('<li></li>').appendTo('#files').html('<img src="img/products/'+response+'" alt="" height="100"/><br />').addClass('success');
						$('<li></li>').appendTo('#photoproduct').html('<input type="hidden" id="image" name="image" value="'+response+'">').addClass('nameupload');
						
					} else{
						$('<li></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			});
			
			$("#deleteimage").on("click", function(){
				parent.jQuery.fancybox.close();
			});
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var productName = $("#productName").val();
				var categoryID = $("#categoryID").val();
				var unit = $("#unit").val();
				var unitPrice1 = $("#unitPrice1").val();
				var unitPrice2 = $("#unitPrice2").val();
				var unitPrice3 = $("#unitPrice3").val();
				var hpp = $("#hpp").val();
				var purchasePrice = $("#purchasePrice").val();
				var note = $("#note").val();
				var image = $("#image").val();
				var picture = $("#picture").val();
				var minimumStock = $("#minimumStock").val();
				
				if (productID != '' && productName != '' && categoryID != '' && unit != '' && unitPrice1 != '' && unitPrice2 != '' && unitPrice3 != '' && hpp != '' && purchasePrice != '' && minimumStock != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_product.php',
						dataType: 'JSON',
						data:{
							productID: productID,
							productName: productName,
							categoryID: categoryID,
							unit: unit,
							unitPrice1: unitPrice1,
							unitPrice2: unitPrice2,
							unitPrice3: unitPrice3,
							hpp: hpp,
							purchasePrice: purchasePrice,
							note: note,
							image: image,
							picture: picture,
							minimumStock: minimumStock
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
				

{if $module == 'product' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Produk</h3></td>
		</tr>
		<tr>
			<td>
				<form id="product" name="product" method="POST" action="#">
				<input type="hidden" id="productID" name="productID" value="{$productID}">
				<input type="hidden" id="picture" name="picture" value="{$image}">
				<table cellpadding="7" cellspacing="7">
					<tr valign="top">
						<td width="130" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kode Produk</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<input type="hidden" value="{$productCode}" id="productCode" name="productCode">
							<input type="text" value="{$productCode}" id="productCode" name="productCode" class="form-control" placeholder="Kode Produk" style="width: 270px;" DISABLED>
						</td>
						<td width="120" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Beli</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$purchasePrice}" id="purchasePrice" name="purchasePrice" class="form-control" placeholder="Harga Beli" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Nama Produk</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="{$productName}" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" required></td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Minimum Stok</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$minimumStock}" id="minimumStock" name="minimumStock" class="form-control" placeholder="Minimum Stok" style="width: 270px;" required></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kategori</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								{section name=dataCategory loop=$dataCategory}
									{if $categoryID == $dataCategory[dataCategory].categoryID}
										<option value="{$dataCategory[dataCategory].categoryID}" SELECTED>{$dataCategory[dataCategory].categoryName}</option>
									{else}
										<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
									{/if}
								{/section}
							</select>
						</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Note</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="{$note}" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Satuan</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="1" {if $unit == '1'} SELECTED {/if}>SET</option>
								<option value="2" {if $unit == '2'} SELECTED {/if}>PCS</option>
							</select>
						</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Gambar</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td rowspan="8">
							<div id="me" class="styleall" style="cursor:pointer;">
								<label>
									<button class="btn btn-warning">Browse</button>
								</label>
							</div>
							<span id="mestatus"></span>
							<div id="photoproduct">
								<li class="nameupload"></li>
							</div>
							<div id="files">
								<li class="success">
									{if $image != ''}
										<img src="img/products/thumb/small_{$image}"><br>
										<span style="font-size: 10pt;"><a id="deleteimage" href="products.php?module=product&act=deleteimage&productID={$productID}&picture={$image}">Hapus Gambar</a></span>
									{/if}
								</li>
							</div>
						</td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 1</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$unitPrice1}" id="unitPrice1" name="unitPrice1" class="form-control" placeholder="Harga Satuan 1" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 2</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$unitPrice2}" id="unitPrice2" name="unitPrice2" class="form-control" placeholder="Harga Satuan 2" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 3</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$unitPrice3}" id="unitPrice3" name="unitPrice3" class="form-control" placeholder="Harga Satuan 3" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">HPP</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="{$hpp}" id="hpp" name="hpp" class="form-control" placeholder="HPP" style="width: 270px;" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>