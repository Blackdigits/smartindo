<?php /* Smarty version Smarty-3.1.11, created on 2016-07-15 14:19:24
         compiled from ".\templates\edit_authorize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49585787a896a6b713-03621999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a39def438cb96a033d541d82b3ae3500e6055ef' => 
    array (
      0 => '.\\templates\\edit_authorize.tpl',
      1 => 1468567130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49585787a896a6b713-03621999',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787a896cbbfb9_30939612',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'modulID' => 0,
    'modulName' => 0,
    'status' => 0,
    'adm' => 0,
    'sls' => 0,
    'ksr' => 0,
    'spv' => 0,
    'top' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787a896cbbfb9_30939612')) {function content_5787a896cbbfb9_30939612($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#authorize").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var modulID = $("#modulID").val();
				var status = $("#status").val();
				if ($("#authorize1").is(':checked')){
					var authorize1 = "1,";
				}
				else{
					var authorize1 = "0,";
				}
				
				if ($("#authorize2").is(':checked')){
					var authorize2 = "2,";
				}
				else{
					var authorize2 = "0,";
				}
				
				if ($("#authorize3").is(':checked')){
					var authorize3 = "3,";
				}
				else{
					var authorize3 = "0,";
				}
				
				if ($("#authorize4").is(':checked')){
					var authorize4 = "4,";
				}
				else{
					var authorize4 = "0,";
				}
				
				if ($("#authorize5").is(':checked')){
					var authorize5 = "5";
				}
				else{
					var authorize5 = "0";
				}
				
				if (modulID != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_authorize.php',
						dataType: 'JSON',
						data:{
							modulID: modulID,
							status: status,
							authorize1: authorize1,
							authorize2: authorize2,
							authorize3: authorize3,
							authorize4: authorize4,
							authorize5: authorize5
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='authorize'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td align="center"><h3><b>OTORISASI LEVEL</b></h3></td>
		</tr>
		<tr>
			<td>
				<form id="authorize" name="authorize" method="POST" action="#">
				<input type="hidden" id="modulID" name="modulID" value="<?php echo $_smarty_tpl->tpl_vars['modulID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Nama Modul</td>
						<td width="5">:</td>
						<td><input type="text" id="modulName" name="modulName" value="<?php echo $_smarty_tpl->tpl_vars['modulName']->value;?>
" class="form-control" placeholder="Nama Modul" style="width: 270px;" DISABLED></td>
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
						<td>Level</td>
						<td>:</td>
						<td> 	<input type="checkbox" id="authorize1" name="authorize1" <?php if ($_smarty_tpl->tpl_vars['adm']->value=='1'){?> CHECKED <?php }?>> Administrator <br>
								<input type="checkbox" id="authorize2" name="authorize2" <?php if ($_smarty_tpl->tpl_vars['sls']->value=='2'){?> CHECKED <?php }?>> Sales <br>
								<input type="checkbox" id="authorize3" name="authorize3" <?php if ($_smarty_tpl->tpl_vars['ksr']->value=='3'){?> CHECKED <?php }?>> Kasir <br>
								<input type="checkbox" id="authorize4" name="authorize4" <?php if ($_smarty_tpl->tpl_vars['spv']->value=='4'){?> CHECKED <?php }?>> Distributor <br>
								<input type="checkbox" id="authorize5" name="authorize5" <?php if ($_smarty_tpl->tpl_vars['top']->value=='5'){?> CHECKED <?php }?>> Agen <br>
						</td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>