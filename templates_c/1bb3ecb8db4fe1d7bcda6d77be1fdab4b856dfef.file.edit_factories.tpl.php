<?php /* Smarty version Smarty-3.1.11, created on 2023-09-13 16:11:20
         compiled from "./templates/edit_factories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:554006351638f69b96a0b92-04314718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bb3ecb8db4fe1d7bcda6d77be1fdab4b856dfef' => 
    array (
      0 => './templates/edit_factories.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '554006351638f69b96a0b92-04314718',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_638f69b96d7725_34131382',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'factoryID' => 0,
    'factoryCode' => 0,
    'factoryName' => 0,
    'factoryType' => 0,
    'status' => 0,
    'note' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_638f69b96d7725_34131382')) {function content_638f69b96d7725_34131382($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#factory").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var factoryID = $("#factoryID").val();
				var factoryName = $("#factoryName").val();
				var factoryType = $("#factoryType").val();
				var status = $("#status").val();
				var note = $("#note").val();
				
				if (factoryID != '' && factoryName != '' && factoryType != '' && status != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_factory.php',
						dataType: 'JSON',
						data:{
							factoryID: factoryID,
							factoryName: factoryName,
							factoryType: factoryType,
							status: status,
							note: note
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='factory'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Gudang / Pabrik</h3></td>
		</tr>
		<tr>
			<td>
				<form id="factory" name="factory" method="POST" action="#">
				<input type="hidden" id="factoryID" name="factoryID" value="<?php echo $_smarty_tpl->tpl_vars['factoryID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Gudang</td>
						<td width="5">:</td>
						<td><input type="text" id="factoryCode" name="factoryCode" value="<?php echo $_smarty_tpl->tpl_vars['factoryCode']->value;?>
" class="form-control" placeholder="Kode Gudang" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Nama Gudang</td>
						<td>:</td>
						<td><input type="text" id="factoryName" name="factoryName" value="<?php echo $_smarty_tpl->tpl_vars['factoryName']->value;?>
" class="form-control" placeholder="Nama Gudang" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Tipe</td>
						<td>:</td>
						<td><select name="factoryType" id="factoryType" class="form-control" required>
							<option value="">- Pilih Status -</option>
							<option value="1" <?php if ($_smarty_tpl->tpl_vars['factoryType']->value=='1'){?> SELECTED <?php }?>>Tetap</option>
							<option value="2" <?php if ($_smarty_tpl->tpl_vars['factoryType']->value=='2'){?> SELECTED <?php }?>>Sementara (Sewa)</option>
						</select></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="status" id="status" class="form-control" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" <?php if ($_smarty_tpl->tpl_vars['status']->value=='Y'){?> SELECTED <?php }?>>Y (Aktif)</option>
							<option value="N" <?php if ($_smarty_tpl->tpl_vars['status']->value=='N'){?> SELECTED <?php }?>>N (Tidak Aktif)</option>
						</select></td>
					</tr>
					<tr valign="top">
						<td>Note</td>
						<td>:</td>
						<td><textarea class="textarea" name="note" id="note" placeholder="Note" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</textarea></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>