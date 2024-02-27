<?php /* Smarty version Smarty-3.1.11, created on 2023-09-15 14:21:18
         compiled from "./templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1870655216637ec8868ff811-96721079%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1694762475,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1870655216637ec8868ff811-96721079',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec886900768_99647911',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec886900768_99647911')) {function content_637ec886900768_99647911($_smarty_tpl) {?>		<script>
		// Check if 'msg' parameter is present in the URL
		if (window.location.search.includes('msg=')) {
			// Get the value of 'msg' parameter from the URL
			const params = new URLSearchParams(window.location.search);
			const message = params.get('msg');

			// Create a Bootstrap alert element
			const alertDiv = document.createElement('div');
			alertDiv.className = 'alert alert-success';
			alertDiv.innerHTML = message;

			// Add the alert to the top of the page 
			document.body.insertBefore(alertDiv, document.body.firstChild);

			// Automatically close the alert after 5 seconds
			setTimeout(function() {
				alertDiv.remove();
			}, 5000);
		}
		</script>
	</body>
</html><?php }} ?>