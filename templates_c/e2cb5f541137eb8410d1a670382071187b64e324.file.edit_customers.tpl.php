<?php /* Smarty version Smarty-3.1.11, created on 2023-09-30 08:36:47
         compiled from "./templates/edit_customers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:452139839637ee182774fb5-15296043%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2cb5f541137eb8410d1a670382071187b64e324' => 
    array (
      0 => './templates/edit_customers.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '452139839637ee182774fb5-15296043',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ee18277fbd2_55922594',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'customerID' => 0,
    'customerCode' => 0,
    'customerName' => 0,
    'contactPerson' => 0,
    'address' => 0,
    'phonecp1' => 0,
    'address2' => 0,
    'phonecp2' => 0,
    'village' => 0,
    'email' => 0,
    'district' => 0,
    'city' => 0,
    'zipCode' => 0,
    'province' => 0,
    'npwp' => 0,
    'phone1' => 0,
    'phone2' => 0,
    'phone3' => 0,
    'pkpName' => 0,
    'fax1' => 0,
    'fax2' => 0,
    'fax3' => 0,
    'note' => 0,
    'disc1' => 0,
    'disc2' => 0,
    'disc3' => 0,
    'limitBalance' => 0,
    'staffCode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ee18277fbd2_55922594')) {function content_637ee18277fbd2_55922594($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #EEEEEE; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#customer").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var customerID = $("#customerID").val();
				var customerCode = $("#customerCode").val();
				var customerName = $("#customerName").val();
				var contactPerson = $("#contactPerson").val();
				var address = $("#address").val();
				var address2 = $("#address2").val();
				var village = $("#village").val();
				var district = $("#district").val();
				var city = $("#city").val();
				var zipCode = $("#zipCode").val();
				var province = $("#province").val();
				var phone1 = $("#phone1").val();
				var phone2 = $("#phone2").val();
				var phone3 = $("#phone3").val();
				var fax1 = $("#fax1").val();
				var fax2 = $("#fax2").val();
				var fax3 = $("#fax3").val();
				var phonecp1 = $("#phonecp1").val();
				var phonecp2 = $("#phonecp2").val();
				var email = $("#email").val();
				var limitBalance = $("#limitBalance").val();
				var discount1 = $("#discount1").val();
				var discount2 = $("#discount2").val();
				var discount3 = $("#discount3").val();
				var note = $("#note").val();
				var npwp = $("#npwp").val();
				var pkpName = $("#pkpName").val();
				var staffCode = $("#staffCode").val();
				var privat = $("#privat").val();
				
				if (customerID != '' && customerCode != '' && customerName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_customer.php',
						dataType: 'JSON',
						data:{
							customerID: customerID,
							customerCode: customerCode,
							customerName: customerName,
							contactPerson: contactPerson,
							address: address,
							address2: address2,
							village: village,
							district: district,
							city: city,
							zipCode: zipCode,
							province: province,
							phone1: phone1,
							phone2: phone2,
							phone3: phone3,
							fax1: fax1,
							fax2: fax2,
							fax3: fax3,
							phonecp1: phonecp1,
							phonecp2: phonecp2,
							email: email,
							limitBalance: limitBalance,
							discount1: discount1,
							discount2: discount2,
							discount3: discount3,
							note: note,
							npwp: npwp,
							pkpName: pkpName,
							staffCode: staffCode,
							privat: privat
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='customer'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td align="center"><h3><b>MASTER DATA TOKO</b></h3></td>
		</tr>
		<tr>
			<td>
				<form id="customer" name="customer" method="POST" action="#">
				<input type="hidden" id="customerID" name="customerID" value="<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
">
				<table cellpadding="3" cellspacing="3">
					<tr>
						<td width="150" style="font-size: 14px;">Kode Toko</td>
						<td width="5" style="font-size: 14px;">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerCode']->value;?>
" id="customerCode" name="customerCode" class="form-control" placeholder="Kode Toko" style="width: 270px;" required></td>
						<td colspan="4"></td>
					</tr>
					<tr>
						<td colspan="3" align="center" bgcolor="#999999" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;"><span style="font-size: 16px;"><b>IDENTITAS TOKO</b></span></td>
						<td></td>
						<td colspan="3" align="center" bgcolor="#999999" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;"><span style="font-size: 16px;"><b>ORANG YANG DIHUBUNGI</b></span></td>
					</tr>
					<tr>
						<td width="150" style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Nama Toko</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="font-size: 14px; border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
" id="customerName" name="customerName" class="form-control" placeholder="Nama Toko" style="width: 270px;" required></td>
						<td width="50"></td>
						<td width="140" style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Nama Lengkap</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="contactPerson" value="<?php echo $_smarty_tpl->tpl_vars['contactPerson']->value;?>
" name="contactPerson" class="form-control" placeholder="Kontak Person" style="width: 270px;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 1</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address" name="address" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
						<td></td>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">No. HP 1</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="phonecp1" name="phonecp1" value="<?php echo $_smarty_tpl->tpl_vars['phonecp1']->value;?>
" class="form-control" placeholder="No. Handphone 1" style="width: 270px;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 2</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address2" name="address2" value="<?php echo $_smarty_tpl->tpl_vars['address2']->value;?>
" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
						<td></td>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">No. HP 2</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="phonecp2" name="phonecp2" value="<?php echo $_smarty_tpl->tpl_vars['phonecp2']->value;?>
" class="form-control" placeholder="No. Handphone 2" style="width: 270px;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Kelurahan</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="village" name="village" value="<?php echo $_smarty_tpl->tpl_vars['village']->value;?>
" class="form-control" placeholder="Kelurahan" style="width: 270px;"></td>
						<td></td>
						<td style="font-size: 14px; border-bottom: 1px solid #000000; border-left: 1px solid #000000; background-color: #FFFFFF;">Email</td>
						<td style="font-size: 14px; border-bottom: 1px solid #000000; background-color: #FFFFFF;">:</td>
						<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" name="email" class="form-control" placeholder="Email" style="width: 270px;" required="false"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Kecamatan</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="district" name="district" value="<?php echo $_smarty_tpl->tpl_vars['district']->value;?>
" class="form-control" placeholder="Kecamatan" style="width: 270px;"></td>
						<td colspan="4"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Kota/Kode Pos</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="city" name="city" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" class="form-control" placeholder="Kota" style="width: 170px; float: left;"> <input type="number" id="zipCode" value="<?php echo $_smarty_tpl->tpl_vars['zipCode']->value;?>
" name="zipCode" class="form-control" placeholder="Kode Pos" style="width: 100px;"></td>
						<td></td>
						<td align="center" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; background-color: #999999;" colspan="3"><span style="font-size: 16px;"><b>IDENTITAS PAJAK</b></span></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Propinsi</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="province" name="province" value="<?php echo $_smarty_tpl->tpl_vars['province']->value;?>
" class="form-control" placeholder="Propinsi" style="width: 270px;"></td>
						<td></td>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Nomor NPWP</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="npwp" name="npwp" value="<?php echo $_smarty_tpl->tpl_vars['npwp']->value;?>
" class="form-control" placeholder="Nomor NPWP" style="width: 270px;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;"></td>
						<td style="font-size: 14px; background-color: #FFFFFF;"></td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;">
							<input type="hidden" id="phone1" name="phone1" value="<?php echo $_smarty_tpl->tpl_vars['phone1']->value;?>
" class="form-control" placeholder="Telepon 1" style="width: 90px; float: left;">
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['phone2']->value;?>
" id="phone2" name="phone2" class="form-control" placeholder="Telepon 2" style="width: 90px; float: left;">
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['phone3']->value;?>
" id="phone3" name="phone3" class="form-control" placeholder="Telepon 3" style="width: 90px;"> 
						</td>
						<td></td>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Lokasi KPP</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="pkpName" name="pkpName" value="<?php echo $_smarty_tpl->tpl_vars['pkpName']->value;?>
" class="form-control" placeholder="Nama PKP" style="width: 270px;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;"></td>
						<td style="font-size: 14px; background-color: #FFFFFF;"></td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;">
							<input type="hidden" id="fax1" name="fax1" value="<?php echo $_smarty_tpl->tpl_vars['fax1']->value;?>
" class="form-control" placeholder="Fax 1" style="width: 90px; float: left;">
							<input type="hidden" id="fax2" value="<?php echo $_smarty_tpl->tpl_vars['fax2']->value;?>
" name="fax2" class="form-control" placeholder="Fax 2" style="width: 90px; float: left;">
							<input type="hidden" id="fax3" name="fax3" value="<?php echo $_smarty_tpl->tpl_vars['fax3']->value;?>
" class="form-control" placeholder="Fax 3" style="width: 90px;"> 
						</td>
						<td></td>
						<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Note</td>
						<td style="background-color: #FFFFFF;">:</td>
						<td rowspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><textarea id="note" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" name="note" class="form-control" placeholder="Keterangan" style="width: 270px; height: 72px;"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</textarea></td>
					</tr>
					<tr valign="top">
						<td style="font-size: 14px; border-left: 1px solid #000000; background-color: #FFFFFF;">Diskon</td>
						<td style="font-size: 14px; background-color: #FFFFFF;">:</td>
						<td style="border-right: 1px solid #000000; background-color: #FFFFFF;">
							<input type="number" id="discount1" name="discount1" value="<?php echo $_smarty_tpl->tpl_vars['disc1']->value;?>
" class="form-control" placeholder="Diskon 1" style="width: 90px; float: left;">
							<input type="number" id="discount2" value="<?php echo $_smarty_tpl->tpl_vars['disc2']->value;?>
" name="discount2" class="form-control" placeholder="Diskon 2" style="width: 90px; float: left;">
							<input type="number" id="discount3" value="<?php echo $_smarty_tpl->tpl_vars['disc3']->value;?>
" name="discount3" class="form-control" placeholder="Diskon 3" style="width: 90px;"> 
						</td>
						<td></td>
						<td colspan="2" style="background-color: #FFFFFF; border-left: 1px solid #000000; border-bottom: 1px solid #000000;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px; border-bottom: 1px solid #000000; border-left: 1px solid #000000; background-color: #FFFFFF;">Limit/Kode Sales</td>
						<td style="font-size: 14px; border-bottom: 1px solid #000000; background-color: #FFFFFF;">:</td>
						<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="number" value="<?php echo $_smarty_tpl->tpl_vars['limitBalance']->value;?>
" id="limitBalance" name="limitBalance" class="form-control" placeholder="Limit" style="width: 170px; float: left;">
							<input type="text" id="staffCode" value="<?php echo $_smarty_tpl->tpl_vars['staffCode']->value;?>
" name="staffCode" class="form-control" placeholder="Kode Sales" style="width: 100px;">
						</td>
						<td colspan="4"></td>
					</tr>
				</table>
				<br>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>