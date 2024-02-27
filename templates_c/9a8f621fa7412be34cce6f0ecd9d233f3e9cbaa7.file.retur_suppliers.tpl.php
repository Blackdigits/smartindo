<?php /* Smarty version Smarty-3.1.11, created on 2023-09-18 01:46:45
         compiled from "./templates/retur_suppliers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210026344463859d578e5845-07681586%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a8f621fa7412be34cce6f0ecd9d233f3e9cbaa7' => 
    array (
      0 => './templates/retur_suppliers.tpl',
      1 => 1694874151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210026344463859d578e5845-07681586',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_63859d57916e79_40390927',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'invoiceNo' => 0,
    'supplierName' => 0,
    'supplierAddress' => 0,
    'returNo' => 0,
    'returDate' => 0,
    'dataStaff' => 0,
    'supplierCode' => 0,
    'dataGudang' => 0,
    'GudangID' => 0,
    'numsBBuy' => 0,
    'dataBbmDetail' => 0,
    'returID' => 0,
    'ref' => 0,
    'note' => 0,
    'dataReturDetail' => 0,
    'grandtotal' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'q' => 0,
    'dataRetur' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63859d57916e79_40390927')) {function content_63859d57916e79_40390927($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
		function toRp(amount, decimalSeparator, thousandsSeparator, nDecimalDigits){
			var num = parseFloat( amount ); //convert to float
			//default values
			decimalSeparator = decimalSeparator || ',';
			thousandsSeparator = thousandsSeparator || ',';
			nDecimalDigits = nDecimalDigits == null? 2 : nDecimalDigits;
			
			var fixed = num.toFixed(nDecimalDigits); //limit or add decimal digits
			//separate begin [$1], middle [$2] and decimal digits [$4]
			var parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed);
			
			if(parts){ //num >= 1000 || num < = -1000
				return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
			}else{
				return fixed.replace('.', decimalSeparator);
			}
		}  
        
        function gudang(selectObject) {
            var sleTex = selectObject.options[selectObject.selectedIndex].innerHTML;
            var selVal = selectObject.value;
            sessionStorage.setItem("gudangid", selVal);
            sessionStorage.setItem("nama_gudang", sleTex); 
        }
		
		function sum() {
			var subtotal = eval($("#subtotal").val());
			var grandtotal = eval($("#grandtotal").val());
			var ppnType = $("#ppnType").val();
			
			// ppn
			if (ppnType == '1') {
				var ppn = eval(0.1 * subtotal);
				var ppnrp = toRp(ppn);
				var grandtotal2 = eval(subtotal + ppn);
				var grandtotalrp = toRp(grandtotal2);
				
				document.getElementById('ppn').value = ppn.toFixed(2);
				document.getElementById('ppnrp').value = ppnrp;
				document.getElementById('grandtotal').value = grandtotal2.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalrp;
			}
			else{
				var ppn = eval(0 * subtotal);
				var ppnrp = toRp(ppn);
				var grandtotal2 = eval(subtotal + ppn);
				var grandtotalrp = toRp(grandtotal2);
				
				document.getElementById('ppn').value = ppn.toFixed(2);
				document.getElementById('ppnrp').value = ppnrp;
				document.getElementById('grandtotal').value = grandtotal2.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalrp;
			}
		}
		
		$(document).ready(function() {
			 document.getElementById('pilihgudang').value = sessionStorage.getItem("gudangid");
			 document.getElementById('nama-gudang').value = sessionStorage.getItem("nama_gudang");
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
			
			$( "#returDate" ).datepicker({
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
			
			$('#invoiceNo').change(function () {
				var invoiceNo = $("#invoiceNo").val();
				
				window.location.href = "retur_suppliers.php?module=returbuy&act=add&invoiceNo=" + invoiceNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#returbuy").submit(function() { return false; });
			$("#returbuy2").submit(function() { return false; });
			
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='returbuy'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Retur Stok</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="retur_suppliers.php?module=returbuy&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan retur pembelian ini?');"><button class="btn btn-default pull-right">Batalkan Retur</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="retur_suppliers.php?module=returbuy&act=input">
								<input type="hidden" id="supplierID" name="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
">
								<input type="hidden" id="supplierName" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
">
								<input type="hidden" id="supplierAddress" name="supplierAddress" value="<?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="returNo" name="returNo" value="<?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
">
											<input type="text" id="returNo" name="returNo" value="<?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
" class="form-control" placeholder="NO RETUR" style="width: 110px; float: left" DISABLED>
											<input type="text" id="returDate" name="returDate" value="<?php echo $_smarty_tpl->tpl_vars['returDate']->value;?>
" class="form-control" placeholder="Tanggal Retur Pembelian" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>PILIH SALES</td>
										<td>:</td>
										<td>
											<select id="invoiceNo" name="invoiceNo" class="form-control" style="width: 270px;" required>
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
													<?php if ($_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['supplierID']==$_smarty_tpl->tpl_vars['invoiceNo']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['supplierID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['supplierName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['supplierName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select> 
										</td>
									</tr>
									<tr>
										<td>KODE SALES</td>
										<td>:</td> 
										<td><input type="text" id="supplier" name="supplier" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
" class="form-control" placeholder="Supplier" style="width: 270px;" DISABLED></td>
									</tr> 
									<tr>
										<td>PILIH GUDANG</td>
										<td>:</td>
										<td>  
											<input type="hidden" name="factoryName" id="nama-gudang" value="">
                                            <select id="pilihgudang" name="factoryID" class="form-control" style="width: 270px;" onchange="gudang(this)" required>
												<option value=""></option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['name'] = 'dataGudang';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataGudang']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataGudang']['total']);
?>
													<?php if ($_smarty_tpl->tpl_vars['dataGudang']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataGudang']['index']]['factoryID']==$_smarty_tpl->tpl_vars['GudangID']->value){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataGudang']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataGudang']['index']]['factoryID'];?>
" SELECTED><?php echo $_smarty_tpl->tpl_vars['dataGudang']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataGudang']['index']]['factoryName'];?>
</option>
													<?php }else{ ?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['dataGudang']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataGudang']['index']]['factoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataGudang']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataGudang']['index']]['factoryName'];?>
</option>
													<?php }?>
												<?php endfor; endif; ?>
											</select> 
                                        </td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td><input type="text" id="note" name="note" class="form-control" placeholder="Note" style="width: 270px;"></td>
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
												<th>HARGA BELI</th>
												<th>QTY SISA</th>
												<th>QTY RETUR</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($_smarty_tpl->tpl_vars['numsBBuy']->value>0){?>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['name'] = 'dataBbmDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBbmDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBbmDetail']['total']);
?>
													<tr>
														<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['no'];?>
 <input type="hidden" name="detailID[]" value="<?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['detailID'];?>
"></td>
														<td><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['productName'];?>
 <input type="hidden" name="productID[]" value="<?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['productID'];?>
"> <input type="hidden" name="productName[]" value="<?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['productName'];?>
"></td>
														<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['pricerp'];?>
 <input type="hidden" name="unitPrice[]" value="<?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['price'];?>
"></td>
														<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBbmDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBbmDetail']['index']]['stockAmount'];?>
</td>
														<td><input type="text" id="qty" name="qty[]" value="0" class="form-control" placeholder="Qty Retur" style="width: 80px;"></td>
														<td><input type="text" id="desc" name="desc[]" class="form-control" placeholder="Note" style="width: 200px;"></td>
													</tr>
												<?php endfor; endif; ?>
											<?php }?>
										</tbody>
									</table>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">Simpan</button>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='returbuy'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
								<script>
									window.location.hash="no-back-button";
									window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
									window.onhashchange=function(){window.location.hash="no-back-button";}
									sessionStorage.clear();
									document.onkeydown = function (e) {
										if (e.keyCode === 116) {
											return false;
										}
									};
								</script>
							
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Retur Sales</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_returbuy.php?module=returbuy&act=print&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
&returID=<?php echo $_smarty_tpl->tpl_vars['returID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_suppliers.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['returDate']->value;?>
</td>
									</tr><!--
									<tr valign="top">
										<td>ID / CODE SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
</td>
									</tr> -->
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
</td>
									</tr>
									<tr>
										<td>REF</td>
										<td>:</td>
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
												<th>GUDANG</th>
												<th>NAMA PRODUK</th>
												<th>HARGA</th>
												<th>QTY RETUR</th>
												<th>SUBTOTAL</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['name'] = 'dataReturDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReturDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['no'];?>
 </td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['productName'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['qty'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['subtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3"> 
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='returbuy'&&$_smarty_tpl->tpl_vars['act']->value=='detailretur'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Retur Stok SFA</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_returbuy.php?module=returbuy&act=print&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
&returID=<?php echo $_smarty_tpl->tpl_vars['returID']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_suppliers.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['returNo']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['returDate']->value;?>
</td>
									</tr><!--
									<tr valign="top">
										<td>ID / KODE SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
</td>
									</tr> -->
									<tr>
										<td>NAMA SALES</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
</td>
									</tr>
									<tr>
										<td>REF</td>
										<td>:</td>
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
												<th>GUDANG</th>
												<th>NAMA PRODUK</th>
												<th>HARGA</th>
												<th>QTY RETUR</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['name'] = 'dataReturDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReturDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReturDetail']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['no'];?>
 </td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['factoryName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['productName'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['price'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['qty'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataReturDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReturDetail']['index']]['note'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3"> 
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='returbuy'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="retur_suppliers.php">
											<input type="hidden" name="module" value="returbuy">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Retur Pembelian" style="float: right; width: 270px;">
											<a href="retur_suppliers.php?module=returbuy&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_returbuy.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<!-- <th>NO RETUR <i class="fa fa-sort"></i></th> -->
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<!-- <th>INVOICE <i class="fa fa-sort"></i></th> -->
												<th>SFA <i class="fa fa-sort"></i></th>
												<!-- <th>CARA RETUR <i class="fa fa-sort"></i></th> -->
												<th>NILAI <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['name'] = 'dataRetur';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataRetur']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['no'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returDate'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['supplierName'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returType'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="retur_suppliers.php?module=returbuy&act=detailretur&returID=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returID'];?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="retur_suppliers.php?module=returbuy&act=delete&returID=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returID'];?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan retur <?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
? penghapusan ini akan membatalkan seluruh retur barang dan lainnya terkait retur ini.');"><img src="img/icons/delete.png" width="18"></a>
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
													
						<?php }else{ ?>
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="retur_suppliers.php">
											<input type="hidden" name="module" value="returbuy">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Retur Pembelian" style="float: right; width: 270px;">
											<a href="retur_suppliers.php?module=returbuy&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_returbuy.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<!-- <th>NO RETUR <i class="fa fa-sort"></i></th> -->
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<!-- <th>INVOICE <i class="fa fa-sort"></i></th> -->
												<th>SFA <i class="fa fa-sort"></i></th>
												<!-- <th>CARA RETUR <i class="fa fa-sort"></i></th> -->
												<th>NILAI <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['name'] = 'dataRetur';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataRetur']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataRetur']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['no'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returDate'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['supplierName'];?>
</td>
													<!-- <td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returType'];?>
</td> -->
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="retur_suppliers.php?module=returbuy&act=detailretur&returID=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returID'];?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="retur_suppliers.php?module=returbuy&act=delete&returID=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returID'];?>
&returNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['invoiceNo'];?>
" onclick="return confirm('Anda Yakin ingin membatalkan retur <?php echo $_smarty_tpl->tpl_vars['dataRetur']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataRetur']['index']]['returNo'];?>
? penghapusan ini akan membatalkan seluruh retur barang dan lainnya terkait retur ini.');"><img src="img/icons/delete.png" width="18"></a>
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