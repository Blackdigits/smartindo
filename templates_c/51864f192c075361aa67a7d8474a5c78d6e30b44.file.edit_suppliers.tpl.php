<?php /* Smarty version Smarty-3.1.11, created on 2023-09-21 20:16:02
         compiled from "./templates/edit_suppliers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171533236263886203b2f083-96671571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51864f192c075361aa67a7d8474a5c78d6e30b44' => 
    array (
      0 => './templates/edit_suppliers.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171533236263886203b2f083-96671571',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_63886203b6a751_86241196',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'supplierID' => 0,
    'supplierCode' => 0,
    'supplierName' => 0,
    'contactPerson' => 0,
    'address' => 0,
    'city' => 0,
    'phone' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63886203b6a751_86241196')) {function content_63886203b6a751_86241196($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#supplier").submit(function() { return false; });
	
			$("#send").on("click", function(){
                var supplierCode = $("#supplierCode").val();
				var supplierID = $("#supplierID").val();
				var supplierName = $("#supplierName").val();
				var contactPerson = $("#contactPerson").val();
				var address = $("#address").val();
				var city = $("#city").val();
				var phone = $("#phone").val();
				var fax = $("#fax").val();
				var email = $("#email").val();
				var privat = $("#privat").val();
				
				if (supplierID != '' && supplierName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_supplier.php',
						dataType: 'JSON',
						data:{
                            supplierCode: supplierCode,
							supplierID: supplierID,
							supplierName: supplierName,
							contactPerson: contactPerson,
							address: address,
							city: city,
							phone: phone,
							fax: fax,
							email: email
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='supplier'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Data</h3></td>
		</tr>
		<tr>
			<td>
				<form id="supplier" name="supplier" method="POST" action="#">
				<input type="hidden" id="supplierID" name="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode</td>
						<td width="5">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
" id="supplierCode" name="supplierCode" class="form-control" placeholder="Kode Sales" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Nama Sales</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
" id="supplierName" name="supplierName" class="form-control" placeholder="Username Login" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Username Login</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['contactPerson']->value;?>
" id="contactPerson" name="contactPerson" class="form-control" placeholder="Nama Sales" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" id="address" name="address" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Kota</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" id="city" name="city" class="form-control" placeholder="Kota" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" id="phone" name="phone" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" id="fax" name="fax" class="form-control" placeholder="****" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" id="email" name="email" class="form-control" placeholder="Email" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>