<?php /* Smarty version Smarty-3.1.11, created on 2022-11-29 21:09:09
         compiled from "./templates/edit_categories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191761370763861285a49f53-59215675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1de8086f81dad37ffcc14bca4f2bcb8872eb5a25' => 
    array (
      0 => './templates/edit_categories.tpl',
      1 => 1669252984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191761370763861285a49f53-59215675',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'categoryID' => 0,
    'categoryName' => 0,
    'categoryStatus' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_63861285a83849_48759848',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63861285a83849_48759848')) {function content_63861285a83849_48759848($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#category").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var categoryID = $("#categoryID").val();
				var categoryName = $("#categoryName").val();
				var categoryStatus = $("#categoryStatus").val();
				var categoryPrivat = $("#categoryprivat").val();
				
				if (categoryID != '' && categoryName != '' && categoryStatus != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_category.php',
						dataType: 'JSON',
						data:{
							categoryID: categoryID,
							categoryName: categoryName,
							categoryStatus: categoryStatus
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='category'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Kategori</h3></td>
		</tr>
		<tr>
			<td>
				<form id="category" name="category" method="POST" action="#">
				<input type="hidden" id="categoryID" name="categoryID" value="<?php echo $_smarty_tpl->tpl_vars['categoryID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Nama Kategori</td>
						<td width="5">:</td>
						<td><input type="text" id="categoryName" name="categoryName" value="<?php echo $_smarty_tpl->tpl_vars['categoryName']->value;?>
" class="form-control" placeholder="Nama kategori" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="categoryStatus" id="categoryStatus" class="form-control" placeholder="Nama kategori" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" <?php if ($_smarty_tpl->tpl_vars['categoryStatus']->value=='Y'){?> SELECTED <?php }?>>Y (Aktif)</option>
							<option value="N" <?php if ($_smarty_tpl->tpl_vars['categoryStatus']->value=='N'){?> SELECTED <?php }?>>N (Tidak Aktif)</option>
						</select></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>