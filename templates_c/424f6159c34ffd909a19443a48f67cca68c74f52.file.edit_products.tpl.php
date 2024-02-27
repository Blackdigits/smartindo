<?php /* Smarty version Smarty-3.1.11, created on 2016-07-15 20:58:15
         compiled from ".\templates\edit_products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:304785788ebf74c0f11-04115543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '424f6159c34ffd909a19443a48f67cca68c74f52' => 
    array (
      0 => '.\\templates\\edit_products.tpl',
      1 => 1416554744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304785788ebf74c0f11-04115543',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'productID' => 0,
    'image' => 0,
    'productCode' => 0,
    'purchasePrice' => 0,
    'productName' => 0,
    'minimumStock' => 0,
    'dataCategory' => 0,
    'categoryID' => 0,
    'note' => 0,
    'unit' => 0,
    'unitPrice1' => 0,
    'unitPrice2' => 0,
    'unitPrice3' => 0,
    'hpp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5788ebf77caf12_05481561',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5788ebf77caf12_05481561')) {function content_5788ebf77caf12_05481561($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

<body style='background-color: #FFF; color: #000;'>

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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='product'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Produk</h3></td>
		</tr>
		<tr>
			<td>
				<form id="product" name="product" method="POST" action="#">
				<input type="hidden" id="productID" name="productID" value="<?php echo $_smarty_tpl->tpl_vars['productID']->value;?>
">
				<input type="hidden" id="picture" name="picture" value="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr valign="top">
						<td width="130" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kode Produk</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
" id="productCode" name="productCode">
							<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productCode']->value;?>
" id="productCode" name="productCode" class="form-control" placeholder="Kode Produk" style="width: 270px;" DISABLED>
						</td>
						<td width="120" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Beli</td>
						<td width="5" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['purchasePrice']->value;?>
" id="purchasePrice" name="purchasePrice" class="form-control" placeholder="Harga Beli" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Nama Produk</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" required></td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Minimum Stok</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['minimumStock']->value;?>
" id="minimumStock" name="minimumStock" class="form-control" placeholder="Minimum Stok" style="width: 270px;" required></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Kategori</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="categoryID" name="categoryID" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
									<?php if ($_smarty_tpl->tpl_vars['categoryID']->value==$_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID']){?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
									<?php }else{ ?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
									<?php }?>
								<?php endfor; endif; ?>
							</select>
						</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Note</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
					</tr>
					<tr valign="top">
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Satuan</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td>
							<select id="unit" name="unit" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='1'){?> SELECTED <?php }?>>SET</option>
								<option value="2" <?php if ($_smarty_tpl->tpl_vars['unit']->value=='2'){?> SELECTED <?php }?>>PCS</option>
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
									<?php if ($_smarty_tpl->tpl_vars['image']->value!=''){?>
										<img src="img/products/thumb/small_<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
"><br>
										<span style="font-size: 10pt;"><a id="deleteimage" href="products.php?module=product&act=deleteimage&productID=<?php echo $_smarty_tpl->tpl_vars['productID']->value;?>
&picture=<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
">Hapus Gambar</a></span>
									<?php }?>
								</li>
							</div>
						</td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 1</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice1']->value;?>
" id="unitPrice1" name="unitPrice1" class="form-control" placeholder="Harga Satuan 1" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 2</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice2']->value;?>
" id="unitPrice2" name="unitPrice2" class="form-control" placeholder="Harga Satuan 2" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">Harga Unit 3</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['unitPrice3']->value;?>
" id="unitPrice3" name="unitPrice3" class="form-control" placeholder="Harga Satuan 3" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">HPP</td>
						<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 14px;">:</td>
						<td><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['hpp']->value;?>
" id="hpp" name="hpp" class="form-control" placeholder="HPP" style="width: 270px;" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>