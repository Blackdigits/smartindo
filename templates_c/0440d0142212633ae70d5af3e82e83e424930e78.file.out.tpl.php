<?php /* Smarty version Smarty-3.1.11, created on 2016-07-14 22:52:44
         compiled from ".\templates\out.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146145787b54c00ae81-31398369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0440d0142212633ae70d5af3e82e83e424930e78' => 
    array (
      0 => '.\\templates\\out.tpl',
      1 => 1451981492,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146145787b54c00ae81-31398369',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'doNo' => 0,
    'customerID' => 0,
    'customerName' => 0,
    'customerAddress' => 0,
    'soNo' => 0,
    'invoiceNo' => 0,
    'invoiceDate' => 0,
    'numsDo' => 0,
    'numsSSales' => 0,
    'dataDoDetail' => 0,
    'total' => 0,
    'totalrp' => 0,
    'invoiceID' => 0,
    'paymentType' => 0,
    'expiredPayment' => 0,
    'ppnType' => 0,
    'discount' => 0,
    'basic' => 0,
    'ppn' => 0,
    'grandtotal' => 0,
    'pay' => 0,
    'debt' => 0,
    'q' => 0,
    'page' => 0,
    'endDate' => 0,
    'startDate' => 0,
    'dataSales' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5787b54c3e4914_66545527',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5787b54c3e4914_66545527')) {function content_5787b54c3e4914_66545527($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
		
		function sum() {
			var total = eval($("#total").val());
			var ppn = eval($("#ppn").val());
			var discount = eval($("#discount").val());
			var basic = eval($("#basic").val());
			var grandtotal = eval($("#grandtotal").val());
			//var pay = eval($("#pay").val());
			var ppnType = $("#ppnType").val();
			
			// ppn
			if (ppnType == '1') {
				// dasar pengenaan pajak
				var basicproccess = eval(total - discount);
				var basicproccessrp = toRp(basicproccess);
				var ppnproccess = eval(0.1 * basicproccess);
				var ppnproccessrp = toRp(ppnproccess);
				
				// grandtotal 
				var grandtotalproccess = eval(basicproccess + ppnproccess);
				var grandtotalproccessrp = toRp(grandtotalproccess);
				// piutang
				//var receiveproccess = eval(grandtotalproccess - pay);
				//var receiveproccessrp = toRp(receiveproccess);
				document.getElementById('ppn').value = ppnproccess.toFixed(2);
				document.getElementById('ppnrp').value = ppnproccessrp;
				document.getElementById('basic').value = basicproccess.toFixed(2);
				document.getElementById('basicrp').value = basicproccessrp;
				document.getElementById('grandtotal').value = grandtotalproccess.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalproccessrp;
				//document.getElementById('receive').value = receiveproccess.toFixed(2);
				//document.getElementById('receiverp').value = receiveproccessrp;
			}
			else{
				// dasar pengenaan pajak
				var basicproccess = eval(total - discount);
				var basicproccessrp = toRp(basicproccess);
				var ppnproccess = 0;
				// grandtotal 
				var grandtotalproccess = eval(basicproccess + ppnproccess);
				var grandtotalproccessrp = toRp(grandtotalproccess);
				// terhutang
				//var receiveproccess = eval(grandtotalproccess - pay);
				//var receiveproccessrp = toRp(receiveproccess);
				
				var ppnproccessrp = toRp(ppnproccess);
				document.getElementById('ppn').value = 0;
				document.getElementById('ppnrp').value = 0;
				document.getElementById('basic').value = basicproccess.toFixed(2);
				document.getElementById('basicrp').value = basicproccessrp;
				document.getElementById('grandtotal').value = grandtotalproccess.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalproccessrp;
				//document.getElementById('receive').value = receiveproccess.toFixed(2);
				//document.getElementById('receiverp').value = receiveproccessrp;
			}
		}
		
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
			
			$("#paymentType").change(function(e){
				var paymentType = $("#paymentType").val();
				
				$("#searchStatus").empty(); 
				
				if (paymentType == '2'){
					
					var newinput3 = $('<input type="text" id="expiredDate" name="expiredDate" class="form-control" style="width: 170px;" placeholder="Jatuh Tempo" required>');
					
					newinput3.appendTo('#searchStatus').datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd-mm-yy",
						yearRange: 'c-0:c+1'
					});
				}
			});
			
			$("#ppnType").change(function(e){
				var ppnType = $("#ppnType").val();
				var discount = eval($("#discount").val());
				var total = eval($("#total").val());
				//var pay = eval($("#pay").val());
				
				document.getElementById("ppn").value = 0;
				document.getElementById("ppnrp").value = 0;
				
				if (ppnType == '1'){
					var sisatotal = eval(total - discount);
					var ppnValue = eval(0.1 * sisatotal);
					var grandtotal = eval(sisatotal + ppnValue);
					//var receive = eval(grandtotal - pay);
					
					var ppnrp = toRp(ppnValue);
					var basicrp = toRp(sisatotal);
					var grandtotalrp = toRp(grandtotal);
					//var receiverp = toRp(receive);
				
					document.getElementById("ppn").value = ppnValue.toFixed(2);
					document.getElementById("ppnrp").value = ppnrp;
					document.getElementById("basic").value = sisatotal.toFixed(2);
					document.getElementById("basicrp").value = basicrp;
					document.getElementById("grandtotalrp").value = grandtotalrp;
					document.getElementById("grandtotal").value = grandtotal.toFixed(2);
					//document.getElementById("receiverp").value = receiverp;
					//document.getElementById("receive").value = receive.toFixed(2);
				}
				else {
					var sisagrand = eval(total - discount);
					var sisagrandrp = toRp(sisagrand);
					//var receive = eval(sisagrand - pay);
					//var receiverp = toRp(receive);
					
					document.getElementById("ppn").value = 0;
					document.getElementById("ppnrp").value = 0;
					document.getElementById("basic").value = sisagrand.toFixed(2);
					document.getElementById("basicrp").value = sisagrandrp;
					document.getElementById("grandtotalrp").value = sisagrandrp;
					document.getElementById("grandtotal").value = sisagrand.toFixed(2);
					//document.getElementById("receiverp").value = receiverp;
					//document.getElementById("receive").value = receive.toFixed(2);
				}
			});
			
			$( "#invoiceDate" ).datepicker({
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
			
			$('#doNo').change(function () {
				var doNo = $("#doNo").val();
				
				window.location.href = "out.php?module=out&act=add&doNo=" + doNo;
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
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='out'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
							
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
								<h3 class="box-title">Tambah Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="out.php?module=out&act=cancel&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi penjualan ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="out.php?module=out&act=input">
								<input type="hidden" id="customerID" name="customerID" value="<?php echo $_smarty_tpl->tpl_vars['customerID']->value;?>
">
								<input type="hidden" id="customerName" name="customerName" value="<?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
">
								<input type="hidden" id="customerAddress" name="customerAddress" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
">
								<input type="hidden" id="soNo" name="soNo" value="<?php echo $_smarty_tpl->tpl_vars['soNo']->value;?>
">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
">
											<input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="<?php echo $_smarty_tpl->tpl_vars['invoiceDate']->value;?>
" class="form-control" placeholder="Tanggal Transaksi Pembelian" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="Nomor DO" style="width: 270px;" required> 
											<?php if ($_smarty_tpl->tpl_vars['numsDo']->value=='0'&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
												<font color="#f56954">Nomor delivery order tidak ditemukan.</font>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['numsSSales']->value>0&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
												<font color="#f56954">Nomor delivery order sudah digunakan.</font>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>TIPE BAYAR</td>
										<td>:</td>
										<td><select id="paymentType" name="paymentType" class="form-control" style="width: 100px; float: left;" required>
												<option value=""></option>
												<option value="1">Tunai</option>
												<option value="2">Termin</option>
											</select>
											<div id="searchStatus"></div>
										</td>
									</tr>
									<tr>
										<td>PPN</td>
										<td>:</td>
										<td><select id="ppnType" name="ppnType" class="form-control" style="width: 100px; float: left;" required>
												<option value=""></option>
												<option value="1">PPN</option>
												<option value="2">No PPN</option>
											</select>
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
												<th>NAMA PRODUK</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
												<th>KOREKSI HARGA</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($_smarty_tpl->tpl_vars['numsDo']->value>0&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
												<?php if ($_smarty_tpl->tpl_vars['numsSSales']->value=='0'&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
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
															<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['pricerp'];?>
</td>
															<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['deliveredQty'];?>
</td>
															<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['subtotal'];?>
</td>
															<td><a title="Koreksi Harga" href="edit_out.php?module=out&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['detailID'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a></td>
														</tr>
													<?php endfor; endif; ?>
												<?php }?>
											<?php }?>
										</tbody>
									</table>
								</div>
								<br>
								<?php if ($_smarty_tpl->tpl_vars['numsDo']->value>0&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
									<?php if ($_smarty_tpl->tpl_vars['numsSSales']->value=='0'&&$_smarty_tpl->tpl_vars['doNo']->value!=''){?>
										<table cellpadding="3" cellspacing="3">
											<tr>
												<td width="190">JUMLAH HARGA BELI</td>
												<td width="5">:</td>
												<td><input type="hidden" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['totalrp']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
											<tr>
												<td>POTONGAN</td>
												<td>:</td>
												<td><input type="text" id="discount" name="discount" value="0" class="form-control" style="width: 270px;" onkeyup="sum();" required></td>
											</tr>
											<tr>
												<td>DASAR PENGENAAN PAJAK</td>
												<td>:</td>
												<td><input type="hidden" id="basic" name="basic" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="basicrp" name="basicrp" value="<?php echo $_smarty_tpl->tpl_vars['totalrp']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
											<tr>
												<td>PPN (10%)</td>
												<td>:</td>
												<td><input type="hidden" id="ppn" name="ppn" value="0">
													<input type="text" id="ppnrp" name="ppnrp" value="0" class="form-control" style="width: 270px;" DISABLED></td>
											</tr>
											<tr>
												<td>GRANDTOTAL</td>
												<td>:</td>
												<td><input type="hidden" id="grandtotal" name="grandtotal" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
">
													<input type="text" id="grandtotalrp" name="grandtotalrp" value="<?php echo $_smarty_tpl->tpl_vars['totalrp']->value;?>
" class="form-control" style="width: 270px;" DISABLED>
												</td>
											</tr>
											<!--<tr>
												<td>TITIP BAYAR</td>
												<td>:</td>
												<td><input type="text" id="pay" name="pay" value="0" class="form-control" style="width: 270px;" onkeyup="sum();" required></td>
											</tr>
											<tr>
												<td>TERHUTANG</td>
												<td>:</td>
												<td><input type="hidden" id="receive" name="receive" value="0">
													<input type="text" id="receiverp" name="receiverp" value="0" class="form-control" style="width: 270px;" DISABLED></td>
											</tr>-->
										</table>
										<br>
										<button type="submit" class="btn btn-primary">Simpan</button>
									<?php }?>
								<?php }?>
								</form>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='out'&&$_smarty_tpl->tpl_vars['act']->value=='finish'){?>
							
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
								<h3 class="box-title">Faktur Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_out.php?module=out&act=print&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="out.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" class="form-control" placeholder="Nomor Faktur" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="<?php echo $_smarty_tpl->tpl_vars['invoiceDate']->value;?>
" class="form-control" placeholder="Tanggal Pengiriman" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="Nomor DO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr valign="top">
										<td>TIPE BAYAR</td>
										<td>:</td>
										<td><input type="text" id="paymentType" name="paymentType" value="<?php echo $_smarty_tpl->tpl_vars['paymentType']->value;?>
" class="form-control" placeholder="Tipe Bayar" style="width: 135px; float: left;" DISABLED>
											<input type="text" id="expiredDate" name="expiredDate" value="<?php echo $_smarty_tpl->tpl_vars['expiredPayment']->value;?>
" class="form-control" placeholder="Jatuh Tempo" style="width: 135px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>PPN</td>
										<td>:</td>
										<td><input type="text" id="ppnType" name="ppnType" value="<?php echo $_smarty_tpl->tpl_vars['ppnType']->value;?>
" class="form-control" placeholder="PPN" style="width: 80px; float: left;" DISABLED>
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
												<th>NAMA PRODUK</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
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
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['pricerp'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['deliveredQty'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['subtotal'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA JUAL</td>
										<td width="5">:</td>
										<td><input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>POTONGAN</td>
										<td>:</td>
										<td><input type="text" id="discount" name="discount" value="<?php echo $_smarty_tpl->tpl_vars['discount']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>DASAR PENGENAAN PAJAK</td>
										<td>:</td>
										<td><input type="text" id="basicrp" name="basicrp" value="<?php echo $_smarty_tpl->tpl_vars['basic']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PPN (10%)</td>
										<td>:</td>
										<td><input type="text" id="ppnrp" name="ppnrp" value="<?php echo $_smarty_tpl->tpl_vars['ppn']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="text" id="grandtotalrp" name="grandtotalrp" value="<?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<!--<tr>
										<td>TITIP BAYAR</td>
										<td>:</td>
										<td><input type="text" id="pay" name="pay" value="<?php echo $_smarty_tpl->tpl_vars['pay']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtrp" name="debtrp" value="<?php echo $_smarty_tpl->tpl_vars['debt']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>-->
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='out'&&$_smarty_tpl->tpl_vars['act']->value=='detailout'){?>
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_out.php?module=out&act=print&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<?php if ($_smarty_tpl->tpl_vars['q']->value!=''){?>
											<a href="out.php?module=out&act=search&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }else{ ?>
											<a href="out.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><button class="btn btn-default pull-right">Back</button></a>
										<?php }?>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo $_smarty_tpl->tpl_vars['invoiceNo']->value;?>
" class="form-control" placeholder="Nomor Faktur" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="<?php echo $_smarty_tpl->tpl_vars['invoiceDate']->value;?>
" class="form-control" placeholder="Tanggal Pengiriman" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="<?php echo $_smarty_tpl->tpl_vars['doNo']->value;?>
" class="form-control" placeholder="Nomor DO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr valign="top">
										<td>TIPE BAYAR</td>
										<td>:</td>
										<td><input type="text" id="paymentType" name="paymentType" value="<?php echo $_smarty_tpl->tpl_vars['paymentType']->value;?>
" class="form-control" placeholder="Tipe Bayar" style="width: 135px; float: left;" DISABLED>
											<input type="text" id="expiredDate" name="expiredDate" value="<?php echo $_smarty_tpl->tpl_vars['expiredPayment']->value;?>
" class="form-control" placeholder="Jatuh Tempo" style="width: 135px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>PPN</td>
										<td>:</td>
										<td><input type="text" id="ppnType" name="ppnType" value="<?php echo $_smarty_tpl->tpl_vars['ppnType']->value;?>
" class="form-control" placeholder="PPN" style="width: 80px; float: left;" DISABLED>
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
												<th>NAMA PRODUK</th>
												<th>HARGA</th>
												<th>QTY</th>
												<th>SUBTOTAL</th>
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
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['pricerp'];?>
</td>
													<td style='text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['deliveredQty'];?>
</td>
													<td style='text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDoDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDoDetail']['index']]['subtotal'];?>
</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA JUAL</td>
										<td width="5">:</td>
										<td><input type="text" id="total" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>POTONGAN</td>
										<td>:</td>
										<td><input type="text" id="discount" name="discount" value="<?php echo $_smarty_tpl->tpl_vars['discount']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>DASAR PENGENAAN PAJAK</td>
										<td>:</td>
										<td><input type="text" id="basicrp" name="basicrp" value="<?php echo $_smarty_tpl->tpl_vars['basic']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PPN (10%)</td>
										<td>:</td>
										<td><input type="text" id="ppnrp" name="ppnrp" value="<?php echo $_smarty_tpl->tpl_vars['ppn']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="text" id="grandtotalrp" name="grandtotalrp" value="<?php echo $_smarty_tpl->tpl_vars['grandtotal']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<!--<tr>
										<td>TITIP BAYAR</td>
										<td>:</td>
										<td><input type="text" id="pay" name="pay" value="<?php echo $_smarty_tpl->tpl_vars['pay']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtrp" name="debtrp" value="<?php echo $_smarty_tpl->tpl_vars['debt']->value;?>
" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>-->
								</table>
							
							</div><!-- /.box-body -->
							
						<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='out'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Penjualan" style="float: right; width: 270px;" required>
											<a href="out.php?module=out&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_out.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO INVOICE <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['name'] = 'dataSales';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSales']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="out.php?module=out&act=detailout&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="out.php?module=out&act=delete&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
? penghapusan ini akan membatalkan seluruh hutang dan pembayaran konsumen terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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
									
										<form method="GET" action="out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Penjualan" style="float: right; width: 270px;">
											<a href="out.php?module=out&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_out.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
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
												<th>NO INVOICE <i class="fa fa-sort"></i></th>
												<th>TGL <i class="fa fa-sort"></i></th>
												<th>NO DO <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['name'] = 'dataSales';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSales']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSales']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceDate'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['grandtotal'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['staffName'];?>
</td>
													<td>
														<a title="Detail" href="out.php?module=out&act=detailout&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="out.php?module=out&act=delete&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceID'];?>
&invoiceNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
&doNo=<?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['doNo'];?>
&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi <?php echo $_smarty_tpl->tpl_vars['dataSales']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSales']['index']]['invoiceNo'];?>
? penghapusan ini akan membatalkan seluruh hutang dan pembayaran konsumen terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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