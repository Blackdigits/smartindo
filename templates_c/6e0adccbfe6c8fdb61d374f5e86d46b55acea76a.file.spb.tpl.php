<?php /* Smarty version Smarty-3.1.11, created on 2023-09-08 14:39:27
         compiled from "./templates/spb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1906861354637ec8fd0f9f23-65207215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e0adccbfe6c8fdb61d374f5e86d46b55acea76a' => 
    array (
      0 => './templates/spb.tpl',
      1 => 1693930207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1906861354637ec8fd0f9f23-65207215',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_637ec8fd12f445_92943443',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'spbNo' => 0,
    'orderDateIndo' => 0,
    'needDateIndo' => 0,
    'dataSupplier' => 0,
    'supplierID' => 0,
    'dataFactory' => 0,
    'factoryID' => 0,
    'note' => 0,
    'numsDetilSpb' => 0,
    'dataDetilSpb' => 0,
    'status' => 0,
    'spbFaktur' => 0,
    'spbID' => 0,
    'q' => 0,
    'pageNumber' => 0,
    'orderDate' => 0,
    'needDate' => 0,
    'supplierName' => 0,
    'dataDetail' => 0,
    'grandtotal' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataSpb' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_637ec8fd12f445_92943443')) {function content_637ec8fd12f445_92943443($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

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
			
			$( "#orderDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: 'c-1:c-0'
			});
			
			$( "#startDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
			});
			
			$( "#endDate" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd-mm-yy",
				yearRange: '2014:c-0'
			});
			
			$('#needDate').focusout(function () {
				var spbNo = $("#spbNo").val();
				var needDate = $("#needDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_needdate.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						needDate: needDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			
			$('#orderDate').change(function () {
				var spbNo = $("#spbNo").val();
				var orderDate = $("#orderDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_orderdate.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						orderDate: orderDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			
			$('#note').change(function () {
				var spbNo = $("#spbNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_note.php',
					dataType: 'JSON',
					data:{
						spbNo: spbNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});
			 
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#spb").submit(function() { return false; });
			$("#spb2").submit(function() { return false; });
			
			var sisastock = {};
			$("#productBarcode").autocomplete("product_spb_autocomplete.php", {
				width: 310
			}).result(function(event, item, a) {
				var myarr = item[0].split(" # ");
				
				document.getElementById('productBarcode').value = myarr[0];
				document.getElementById('productName1').value = myarr[1];
				document.getElementById('productName').value = myarr[1];
				document.getElementById('productID').value = myarr[2];
				document.getElementById('price').value = myarr[3]; 
				document.getElementById('qty').value = myarr[4];
				sisastock = myarr[4];
				$("#qty").attr({
				"max" : sisastock, 
				"min" : 0  
				});
				
			});
  
			$("#supplierID").change(function(e){
				var supplierID = $("#supplierID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_supplier.php',
					dataType: 'JSON',
					data:{
						supplierID: supplierID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});

            $("#factoryID").change(function(e){
				var factoryID = $("#factoryID").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_spb_factory.php',
					dataType: 'JSON',
					data:{
						factoryID: factoryID
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "spb.php?module=spb&act=add";
					}
				});
			});

					
			$("#send2").on("click", function(){
				var spbNo = $("#spbNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty <= sisastock && qty > 0 && spbNo != '' && productID != '' && price > 0){
					
					$.ajax({
						type: 'POST',
						url: 'save_spb.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							spbNo: spbNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "spb.php?module=spb&act=add&msg=Data berhasil disimpan";
						}
					});
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='spb'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="spb.php?module=spb&act=cancel"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- on <a> : onclick="return confirm('Anda Yakin ingin membatalkan PO ini?');" -->
							
							<div class="box-body">
								<form method="POST" action="spb.php?module=spb&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">No TRX / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
">
											<input type="text" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
" class="form-control" placeholder="NO PO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDateIndo']->value;?>
" class="form-control" placeholder="Tanggal PO" style="width: 160px;" required>
										</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td><input type="time" id="needDate" name="needDate" value="<?php echo $_smarty_tpl->tpl_vars['needDateIndo']->value;?>
" class="form-control" placeholder="Jam Transaksi" style="width: 270px;" required></td>
									</tr>
									<tr>
										<td>SALES</td>
										<td>:</td>
										<td>
											<select id="supplierID" name="supplierID" class="form-control" style="width: 270px;" required>
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID']==$_smarty_tpl->tpl_vars['supplierID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
]</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
 [<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
]</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
                                    <tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>
											<select id="factoryID" name="factoryID" class="form-control" style="width: 270px;" required>
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
													<?php if ($_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierID']==$_smarty_tpl->tpl_vars['factoryID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierName'];?>
 [<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierCode'];?>
]</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierName'];?>
 [<?php echo $_smarty_tpl->tpl_vars['dataFactory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['supplierCode'];?>
]</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
											<?php if ($_smarty_tpl->tpl_vars['numsDetilSpb']->value<100){?>
											<a href="#inline" class="modalbox"><button class="btn btn-default pull-left"><i class="fa fa-plus"></i> tambah</button></a>
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
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>NOTE</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['name'] = 'dataDetilSpb';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetilSpb']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetilSpb']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['productName'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['qty'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['note'];?>
</td>
													<td>
														<a title="Edit" href="edit_spb.php?module=spb&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['detailID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=deletedetail&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['detailID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus item produk <?php echo $_smarty_tpl->tpl_vars['dataDetilSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetilSpb']['index']]['productName'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsDetilSpb']->value>0){?>
									<button type="submit" class="btn btn-primary">Simpan</button>
								<?php }else{ ?>
									<button type="button" class="btn btn-primary">Simpan</button>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
							<div id="inline">	
								<table width="95%" align="center">
									<td colspan="3"><h3>Tambah Item</h3></td>
										<tr>
									</tr>
									<tr>
										<td>
											<form id="spb" name="spb" method="POST" action="#">
											<input type="hidden" id="spbNo" name="spbNo" value="<?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="130">Kode Produk</td>
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
													<td>Harga Satuan</td>
													<td>:</td>
													<td><input type="number" id="price" name="price" class="form-control" placeholder="Harga Satuan" style="width: 270px;" required></td>
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
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='spb'&&$_smarty_tpl->tpl_vars['act']->value=='detailtrf'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Detail Mutasi Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<?php if ($_smarty_tpl->tpl_vars['status']->value=='Invalid'){?>
										<a href="spb.php?module=spb&act=add&faktur=<?php echo $_smarty_tpl->tpl_vars['spbFaktur']->value;?>
"><button class="btn btn-default pull-right" style="background-color:#f56954;color:white;font-weight:bold;">EDIT</button></a>
										<?php }else{ ?>
										<a href="print_unit_spb.php?module=spb&act=print&spbID=<?php echo $_smarty_tpl->tpl_vars['spbID']->value;?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['spbFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="spb.php?module=spb&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Kembali</button></a>
										<?php }else{ ?>
											<a href="spb.php?page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
"><button class="btn btn-default pull-right">Kembali</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
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
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
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
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
</td>
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
												<tr>
													<td colspan="4"></td>
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
													<td></td>
												</tr>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='spb'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
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
								<h3 class="box-title">Detail Mutasi Stok Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_spb.php?module=spb&act=print&spbID=<?php echo $_smarty_tpl->tpl_vars['spbID']->value;?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['spbFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="spb.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="130">ID TRX / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['spbNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
</td>
									</tr>
									<tr>
										<td>JAM TRANSAKSI</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
</td>
									</tr>
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
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
												<th>HARGA SATUAN</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
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
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
</td>
													<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
</td>
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
												<tr>
													<td colspan="4"></td>
													<td style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
													<td></td>
												</tr>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='spb'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="spb.php">
											<input type="hidden" name="module" value="spb">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor PO" style="float: right; width: 270px;" required>
										
											<a href="spb.php?module=spb&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</button></a>
											<a href="print_spb.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NO TRX <i class="fa fa-sort"></i></th>
												<th>TGL TRX <i class="fa fa-sort"></i></th>
												<th>JAM TRANSAKSI <i class="fa fa-sort"></i></th>
												<th>NAMA SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DISERAHKAN OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['name'] = 'dataSpb';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSpb']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['orderDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['needDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['supplierName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="spb.php?module=spb&act=detailtrf&spbID=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbID'];?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbFaktur'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=delete&spbID=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbID'];?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbFaktur'];?>
&spbNo=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
" onclick="return confirm('Anda Yakin ingin menghapus transaksi <?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
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
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="spb.php">
											<input type="hidden" name="module" value="spb">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" id="endDate" name="endDate" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" id="startDate" name="startDate" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor PO" style="float: right; width: 270px;">
										
											<a href="spb.php?module=spb&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah</button></a>
											<a href="print_spb.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
											&nbsp;&nbsp;&nbsp;
										</form>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>NO TRX <i class="fa fa-sort"></i></th>
												<th>TGL TRX <i class="fa fa-sort"></i></th>
												<th>JAM TRANSAKSI <i class="fa fa-sort"></i></th>
												<th>NAMA SALES <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>DISERAHKAN OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['name'] = 'dataSpb';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSpb']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSpb']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['orderDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['needDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['supplierName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="spb.php?module=spb&act=detailtrf&spbID=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbID'];?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="spb.php?module=spb&act=delete&spbID=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbID'];?>
&spbFaktur=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbFaktur'];?>
&spbNo=<?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
" onclick="return confirm('Anda Yakin ingin menghapus transaksi <?php echo $_smarty_tpl->tpl_vars['dataSpb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSpb']['index']]['spbNo'];?>
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