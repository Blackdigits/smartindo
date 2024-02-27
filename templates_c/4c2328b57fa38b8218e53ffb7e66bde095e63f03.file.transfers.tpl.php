<?php /* Smarty version Smarty-3.1.11, created on 2022-11-18 00:51:01
         compiled from ".\templates\transfers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:249175787bc56ab2eb9-46145952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c2328b57fa38b8218e53ffb7e66bde095e63f03' => 
    array (
      0 => '.\\templates\\transfers.tpl',
      1 => 1668707461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249175787bc56ab2eb9-46145952',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787bc5709d9f9_65629937',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'trxDate' => 0,
    'transferCode' => 0,
    'trxIndo' => 0,
    'dataFactory' => 0,
    'transferFrom' => 0,
    'dataStaff' => 0,
    'transferTo' => 0,
    'dataDetilTransfer' => 0,
    'numsDetilTransfer' => 0,
    'transferID' => 0,
    'transferFaktur' => 0,
    'pageNumber' => 0,
    'ref' => 0,
    'note' => 0,
    'dataDetail' => 0,
    'dataTransfer' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787bc5709d9f9_65629937')) {function content_5787bc5709d9f9_65629937($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />


	<script>
		$(document).ready(function() {
			
			$(".various2").fancybox({
				fitToView: false,
				scrolling: 'no',
				afterLoad: function(){
					this.width = $(this.element).data("width");
					this.height = $(this.element).data("height");
				},
				'afterClose':function () {
					window.location.reload();
				}
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#transfer").submit(function() { return false; });
			$("#transfer2").submit(function() { return false; });
			
			$("#productBarcode").autocomplete("product_autocomplete.php", {
				width: 310
			}).result(function(event, item) {
				
				var myarr = item[0].split(" - ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('stock1').value = myarr[3];
				document.getElementById('stock').value = myarr[3];
			});
			
			$("#transferFrom").change(function(e){
				var transferFrom = $("#transferFrom").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_transfer_from.php',
					dataType: 'JSON',
					data:{
						transferFrom: transferFrom
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "transfers.php?module=transfer&act=add";
					}
				});
			});
			
			$("#transferTo").change(function(e){
				var transferTo = $("#transferTo").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_transfer_to.php',
					dataType: 'JSON',
					data:{
						transferTo: transferTo
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "transfers.php?module=transfer&act=add";
					}
				});
			});
					
			$("#send2").on("click", function(){
				var transferCode = $("#transferCode").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var desc = $("#desc").val();
				var stock1 = parseInt($("#stock1").val());
				
				if (qty != '' && transferCode != '' && productID != ''){
					if (qty > stock1) {
						alert("Qty tidak mencukupi jumlah stok.");
						return false;
					}
					else{
					
						$.ajax({
							type: 'POST',
							url: 'save_transfer.php',
							dataType: 'JSON',
							data:{
								qty: qty,
								transferCode: transferCode,
								productID: productID,
								productName1: productName1,
								stock1: stock1,
								desc: desc
							},
							beforeSend: function (data) {
								$('#send2').hide();
							},
							success: function(data) {
								setTimeout("$.fancybox.close()", 1000);
								window.location.href = "transfers.php?module=transfer&act=add&msg=Data berhasil disimpan";
							}
						});
					}
				}
			});
		});
	</script>


<header class="header">
	
	<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<?php echo $_smarty_tpl->getSubTemplate ("user_panel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        	
			<?php echo $_smarty_tpl->getSubTemplate ("side_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		<?php echo $_smarty_tpl->getSubTemplate ("breadcumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='transfer'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Transaksi Transfer Stok</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="transfers.php?module=transfer&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan transaksi ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="transfers.php?module=transfer&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="120">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="trxDate" value="<?php echo $_smarty_tpl->tpl_vars['trxDate']->value;?>
" name="trxDate">
											<input type="hidden" id="transferCode" name="transferCode" value="<?php echo $_smarty_tpl->tpl_vars['transferCode']->value;?>
">
											<input type="text" id="transferCode" name="transferCode" value="<?php echo $_smarty_tpl->tpl_vars['transferCode']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['trxIndo']->value;?>
" class="form-control" placeholder="ID Transaksi" style="width: 270px;" DISABLED>
										</td>
									</tr>
									<tr>
										<td>DARI</td>
										<td>:</td>
										<td>
											<select id="transferFrom" name="transferFrom" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['name'] = 'dataFactory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataFactory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID']==$_smarty_tpl->tpl_vars['transferFrom']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td>UNTUK</td>
										<td>:</td>
										<td>
											<select id="transferTo" name="transferTo" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['name'] = 'dataStaff';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataStaff']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataStaff']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID']==$_smarty_tpl->tpl_vars['transferTo']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td width="120">NO REF</td>
										<td width="5">:</td>
										<td><input type="text" id="ref" name="ref" class="form-control" placeholder="Nomor Referensi" style="width: 270px;"></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											<?php if ($_smarty_tpl->tpl_vars['transferFrom']->value!=''&&$_smarty_tpl->tpl_vars['transferTo']->value!=''){?>
												<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Tambah Produk</button></a>
											<?php }else{ ?>
												<a href="#inline"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> Add</button></a>
											<?php }?>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>QTY</th>
												<th>NOTE</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['name'] = 'dataDetilTransfer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetilTransfer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilTransfer']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['qty'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['note'];?>
</td>
													<td>
														<a title="Edit" href="edit_transfers.php?module=transfer&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['detailID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="transfers.php?module=transfer&act=deletedetail&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['detailID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus item produk <?php echo $_smarty_tpl->tpl_vars['dataDetilTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilTransfer']['index']]['productName'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsDetilTransfer']->value>0){?>
									<button type="submit" class="btn btn-primary">Simpan</button>
								<?php }else{ ?>
									<button type="button" class="btn btn-primary">Simpan</button>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td colspan="3"><h3>Tambah Item</h3></td>
									</tr>
									<tr>
										<td>
											<form id="transfer" name="transfer" method="POST" action="#">
											<input type="hidden" id="transferCode" name="transferCode" value="<?php echo $_smarty_tpl->tpl_vars['transferCode']->value;?>
">
											<table cellpadding="7" cellspacing="7">
												<tr>
													<td width="140">Kode Produk</td>
													<td width="5">:</td>
													<td><input type="text" id="productBarcode" name="productBarcode" class="form-control" placeholder="Kode atau Nama Produk" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="productID" name="productID">
														<input type="hidden" id="productName1" name="productName1">
														<input type="text" id="productName" name="productName" class="form-control" placeholder="Nama Produk" style="width: 270px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td><input type="hidden" id="stock1" name="stock1" class="form-control">
														<input type="text" id="stock" name="stock" class="form-control" placeholder="Jumlah Stok" style="width: 270px;" DISABLED>
													</td>
												</tr>
												<tr>
													<td>Qty</td>
													<td>:</td>
													<td><input type="number" id="qty" name="qty" class="form-control" placeholder="Qty Produk" style="width: 270px;" required></td>
												</tr>
												<tr>
													<td>Note</td>
													<td>:</td>
													<td><input type="text" id="desc" name="desc" class="form-control" placeholder="Note" style="width: 270px;"></td>
												</tr>
											</table>
											<button id="send2" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='transfer'&&$_smarty_tpl->tpl_vars['act']->value=='detailtrf'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Transaksi Transfer Gudang</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_transfers.php?module=transfer&act=print&transferID=<?php echo $_smarty_tpl->tpl_vars['transferID']->value;?>
&transferfaktur=<?php echo $_smarty_tpl->tpl_vars['transferFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="transfers.php?page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="120">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['transferCode']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['trxIndo']->value;?>
</td>
									</tr>
									<tr>
										<td>DARI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['transferFrom']->value;?>
</td>
									</tr>
									<tr>
										<td>UNTUK</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['transferTo']->value;?>
</td>
									</tr>
									<tr>
										<td width="120">NO REF</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['ref']->value;?>
</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
									</tr>
									<tr>
										<td colspan="3"><br></td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>QTY</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }else{ ?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Data Transaksi Transfer Stok</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_transfers.php?act=print" target="_blank"><button class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										<a href="transfers.php?module=transfer&act=add"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>ID TRX <i class="fa fa-sort"></i></th>
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>REF <i class="fa fa-sort"></i></th>
												<th>DARI <i class="fa fa-sort"></i></th>
												<th>UNTUK <i class="fa fa-sort"></i></th> 
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['name'] = 'dataTransfer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataTransfer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTransfer']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['trxDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['ref'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['from'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['to'];?>
</td> 
													<td>
														<a title="Detail" href="transfers.php?module=transfer&act=detailtrf&transferID=<?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferID'];?>
&transferFaktur=<?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="transfers.php?module=transfer&act=delete&transferID=<?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferID'];?>
&transferFaktur=<?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferFaktur'];?>
" onclick="return confirm('Anda Yakin ingin menghapus kode transaksi <?php echo $_smarty_tpl->tpl_vars['dataTransfer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTransfer']['index']]['transferCode'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										<?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>

										<!--<li><a href="#">&laquo;</a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">&raquo;</a></li>-->
									</ul>
								</div>
							</div><!-- /.box-header -->
						<?php }?>
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>