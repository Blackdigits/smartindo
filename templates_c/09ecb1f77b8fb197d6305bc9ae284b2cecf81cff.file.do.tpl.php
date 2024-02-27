<?php /* Smarty version Smarty-3.1.11, created on 2022-10-28 20:19:05
         compiled from ".\templates\do.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129515787b55206cbe2-98422584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09ecb1f77b8fb197d6305bc9ae284b2cecf81cff' => 
    array (
      0 => '.\\templates\\do.tpl',
      1 => 1666963138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129515787b55206cbe2-98422584',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787b5526c9183_16548444',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'doNo' => 0,
    'doID' => 0,
    'deliveredDate' => 0,
    'soNo' => 0,
    'numsSo' => 0,
    'numsDo' => 0,
    'customerID' => 0,
    'customerName' => 0,
    'customerAddress' => 0,
    'orderDate' => 0,
    'needDate' => 0,
    'note' => 0,
    'dataDetail' => 0,
    'doFaktur' => 0,
    'dataDoDetail' => 0,
    'q' => 0,
    'page' => 0,
    'dataBbmDetail' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataDo' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787b5526c9183_16548444')) {function content_5787b5526c9183_16548444($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
			
			$( "#deliveredDate" ).datepicker({
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
			
			$('#deliveredDate').change(function () {
				var doNo = $("#doNo").val();
				var doID = $("#doID").val();
				var soNo = $("#soNo").val();
				var deliveredDate = $("#deliveredDate").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_do_delivereddate.php',
					dataType: 'JSON',
					data:{
						doNo: doNo,
						doID: doID,
						deliveredDate: deliveredDate
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
					}
				});
			});
			
			$('#note').change(function () {
				var doNo = $("#doNo").val();
				var doID = $("#doID").val();
				var soNo = $("#soNo").val();
				var note = $("#note").val();
				
				$.ajax({
					type: 'POST',
					url: 'save_do_note.php',
					dataType: 'JSON',
					data:{
						doNo: doNo,
						doID: doID,
						soNo: soNo,
						note: note
					},
					success: function(data) {
						setTimeout("$.fancybox.close()", 1000);
						window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
					}
				});
			});
			
			$('#soNo').change(function () {
				var soNo = $("#soNo").val();
				
				window.location.href = "do.php?module=do&act=add&soNo=" + soNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#do").submit(function() { return false; });
			$("#do2").submit(function() { return false; });
			
			$("#send2").on("click", function(){
				var doNo = $("#doNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty != '' && soNo != '' && productID != '' && price != ''){
					
					$.ajax({
						type: 'POST',
						url: 'save_so.php',
						dataType: 'JSON',
						data:{
							qty: qty,
							price: price,
							soNo: soNo,
							productID: productID,
							productName1: productName1,
							desc: desc
						},
						beforeSend: function (data) {
							$('#send2').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "so.php?module=so&act=add&msg=Data berhasil disimpan";
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='do'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Surat Jalan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="do.php?module=do&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan surat jalan ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="do.php?module=do&act=input">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
">
											<input type="hidden" id="doID" name="doID" value="<?php echo $_smarty_tpl->tpl_vars['doID']->value;?>
">
											<input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="NO DO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="<?php echo $_smarty_tpl->tpl_vars['deliveredDate']->value;?>
" class="form-control" placeholder="Tanggal DO" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="<?php echo $_smarty_tpl->tpl_vars['soNo']->value;?>
" class="form-control" placeholder="Nomor SO" style="width: 270px;" required>
											
											<?php if ($_smarty_tpl->tpl_vars['numsSo']->value=='0'&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
												<font color="#f56954">Nomor SO tidak ditemukan.</font>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['numsDo']->value>0&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
												<font color="#f56954">Nomor SO sudah digunakan.</font>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td><?php if ($_smarty_tpl->tpl_vars['numsDo']->value=='0'&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
											<input type="hidden" id="customerID" name="customerID" value="<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
">
											<input type="hidden" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
">
											<input type="hidden" id="customerAddress" name="customerAddress" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
">
											<input type="text" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED>
											<?php }else{ ?>
											<input type="text" id="customerName" name="customerName" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="hidden" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
"><input type="hidden" id="needDate" name="needDate" value="<?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
">
											<?php if ($_smarty_tpl->tpl_vars['numsDo']->value=='0'&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
												<input type="text" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="<?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
											<?php }else{ ?>
												<input type="text" id="orderDate" name="orderDate" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
											<?php }?>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><?php if ($_smarty_tpl->tpl_vars['numsDo']->value=='0'&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
												<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;">
											<?php }else{ ?>
												<input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;">
											<?php }?></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>KIRIM</th>
												<th>DARI GUDANG</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($_smarty_tpl->tpl_vars['numsDo']->value=='0'&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
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
 <input type="hidden" name="detailID[]" id="detailID" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailID'];?>
"></td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
 <input type="hidden" name="productName[]" id="productName" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
"> <input type="hidden" name="productID[]" id="productID" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productID'];?>
"></td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
 <input type="hidden" name="notedetail[]" id="notedetail" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['note'];?>
"></td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
 <input type="hidden" name="qty[]" id="qty" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['qty'];?>
"> <input type="hidden" name="price[]" id="price" value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['price'];?>
"></td>
													<td><input type="number" value="0" id="deliveredQty" name="deliveredQty[]" class="form-control" placeholder="Jml" style="width: 100px;" required></td>
													<td>
														<select id="status" name="status[]" class="form-control" style="width: 100px;" required>
															<option value=""></option>
															<option value="Y">YA</option>
															<option value="N">TIDAK</option>
														</select>
													</td>
													<td>
														<select id="factory" name="factory[]" class="form-control" style="width: 180px;" required>
															<option value=""></option>
															<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['name'] = 'dataFactory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFactory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
																<option value="<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryID'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryCode'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryCode'];?>
 <?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['factoryName'];?>
 [Stok : <?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['dataFactory'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFactory']['index']]['stock'];?>
]</option>
															<?php endfor; endif; ?>
														</select>
													</td>
												</tr>
											<?php endfor; endif; ?>
											<?php }?>
										</tbody>
									</table>
								</div>
								<br>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsSo']->value>0){?>
									<?php if ($_smarty_tpl->tpl_vars['numsDo']->value>0&&$_smarty_tpl->tpl_vars['soNo']->value!=''){?>
									<?php }else{ ?>
										<button type="submit" class="btn btn-primary">Simpan</button>
									<?php }?>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='do'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
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
								<h3 class="box-title">Delivery Order</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_do.php?module=do&act=print&doID=<?php echo $_smarty_tpl->tpl_vars['doID']->value;?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['doFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="do.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="<?php echo $_smarty_tpl->tpl_vars['deliveredDate']->value;?>
" class="form-control" placeholder="Tanggal DO" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="<?php echo $_smarty_tpl->tpl_vars['soNo']->value;?>
" class="form-control" placeholder="Nomor SO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TOKO</td>
										<td>:</td>
										<td><input type="text" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="text" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="<?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>KIRIM</th>
												<th>DARI GUDANG</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['name'] = 'dataDoDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDoDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['note'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['qty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['deliveredQty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['factoryName'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='do'&&$_smarty_tpl->tpl_vars['act']->value=='detaildo'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Surat Jalan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_do.php?module=do&act=print&doID=<?php echo $_smarty_tpl->tpl_vars['doID']->value;?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['doFaktur']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="do.php?module=do&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }else{ ?>
											<a href="do.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO DO / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="NO DO" style="width: 110px; float: left" DISABLED>
											<input type="text" id="deliveredDate" name="deliveredDate" value="<?php echo $_smarty_tpl->tpl_vars['deliveredDate']->value;?>
" class="form-control" placeholder="Tanggal DO" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO SO</td>
										<td>:</td>
										<td><input type="text" id="soNo" name="soNo" value="<?php echo $_smarty_tpl->tpl_vars['soNo']->value;?>
" class="form-control" placeholder="Nomor SO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>CUSTOMER</td>
										<td>:</td>
										<td><input type="text" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
" class="form-control" placeholder="Customer" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TGL SO/DIBUTUHKAN</td>
										<td>:</td>
										<td><input type="text" id="orderDate" name="orderDate" value="<?php echo $_smarty_tpl->tpl_vars['orderDate']->value;?>
" class="form-control" placeholder="Tgl Order" style="float: left; width: 135px;" DISABLED><input type="text" id="orderDate" name="needDate" value="<?php echo $_smarty_tpl->tpl_vars['needDate']->value;?>
" class="form-control" placeholder="Tgl Dibutuhkan" style="width: 135px;" DISABLED></td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['note']->value;?>
" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td colspan="3">
											<br>
										</td>
									</tr>
								</table>

								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>NAMA PRODUK</th>
												<th>NOTE</th>
												<th>JML ORDER</th>
												<th>JML DIKIRIM</th>
												<th>TERIMA</th>
												<th>GUDANG</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['name'] = 'dataDoDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbmDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDoDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['productName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoetail']['index']]['note'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['qty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['receiveQty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['factoryName'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='do'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<form method="GET" action="do.php">
											<input type="hidden" name="module" value="do">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor DO" style="float: right; width: 270px;">
										
											<a href="do.php?module=do&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_do.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>NO SO <i class="fa fa-sort"></i></th>
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TGL PENGIRIMAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['name'] = 'dataDo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['soNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['deliveredDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="do.php?module=do&act=detaildo&doID=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doID'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doFaktur'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="do.php?module=do&act=delete&doID=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doID'];?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doFaktur'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
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
										<form method="GET" action="do.php">
											<input type="hidden" name="module" value="do">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" id="q" name="q" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" class="form-control" placeholder="Pencarian : Nomor DO" style="float: right; width: 270px;" required>
										
											<a href="do.php?module=do&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_do.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>NO SO <i class="fa fa-sort"></i></th>
												<th>CUSTOMER <i class="fa fa-sort"></i></th>
												<th>TGL PENGIRIMAN <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['name'] = 'dataDo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDo']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['soNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['deliveredDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="do.php?module=do&act=detaildo&bbmID=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doID'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doFaktur'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="do.php?module=do&act=delete&doID=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doID'];?>
&doFaktur=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doFaktur'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataDo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDo']['index']]['doNo'];?>
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