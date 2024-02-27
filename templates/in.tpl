{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
	}
</style>

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />

{literal}
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
				// terhutang
				//var debtproccess = eval(grandtotalproccess - pay);
				//var debtproccessrp = toRp(debtproccess);
				document.getElementById('ppn').value = ppnproccess.toFixed(2);
				document.getElementById('ppnrp').value = ppnproccessrp;
				document.getElementById('basic').value = basicproccess.toFixed(2);
				document.getElementById('basicrp').value = basicproccessrp;
				document.getElementById('grandtotal').value = grandtotalproccess.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalproccessrp;
				//document.getElementById('debt').value = debtproccess.toFixed(2);
				//document.getElementById('debtrp').value = debtproccessrp;
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
				//var debtproccess = eval(grandtotalproccess - pay);
				//var debtproccessrp = toRp(debtproccess);
				
				var ppnproccessrp = toRp(ppnproccess);
				document.getElementById('ppn').value = 0;
				document.getElementById('ppnrp').value = 0;
				document.getElementById('basic').value = basicproccess.toFixed(2);
				document.getElementById('basicrp').value = basicproccessrp;
				document.getElementById('grandtotal').value = grandtotalproccess.toFixed(2);
				document.getElementById('grandtotalrp').value = grandtotalproccessrp;
				//document.getElementById('debt').value = debtproccess.toFixed(2);
				//document.getElementById('debtrp').value = debtproccessrp;
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
					//var debt = eval(grandtotal - pay);
					
					var ppnrp = toRp(ppnValue);
					var basicrp = toRp(sisatotal);
					var grandtotalrp = toRp(grandtotal);
					//var debtrp = toRp(debt);
				
					document.getElementById("ppn").value = ppnValue.toFixed(2);
					document.getElementById("ppnrp").value = ppnrp;
					document.getElementById("basic").value = sisatotal.toFixed(2);
					document.getElementById("basicrp").value = basicrp;
					document.getElementById("grandtotalrp").value = grandtotalrp;
					document.getElementById("grandtotal").value = grandtotal.toFixed(2);
					//document.getElementById("debtrp").value = debtrp;
					//document.getElementById("debt").value = debt.toFixed(2);
				}
				else {
					var sisagrand = eval(total - discount);
					var sisagrandrp = toRp(sisagrand);
					//var debt = eval(sisagrand - pay);
					//var debtrp = toRp(debt);
					
					document.getElementById("ppn").value = 0;
					document.getElementById("ppnrp").value = 0;
					document.getElementById("basic").value = sisagrand.toFixed(2);
					document.getElementById("basicrp").value = sisagrandrp;
					document.getElementById("grandtotalrp").value = sisagrandrp;
					document.getElementById("grandtotal").value = sisagrand.toFixed(2);
					//document.getElementById("debtrp").value = debtrp;
					//document.getElementById("debt").value = debt.toFixed(2);
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
			
			$('#bbmNo').change(function () {
				var bbmNo = $("#bbmNo").val();
				
				window.location.href = "in.php?module=in&act=add&bbmNo=" + bbmNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#bbm").submit(function() { return false; });
			$("#bbm2").submit(function() { return false; });
			
			$("#send2").on("click", function(){
				var bbmNo = $("#bbmNo").val();
				var productID = $("#productID").val();
				var productName1 = $("#productName1").val();
				var qty = parseInt($("#qty").val());
				var price = parseInt($("#price").val());
				var desc = $("#desc").val();
				
				if (qty != '' && spbNo != '' && productID != '' && price != ''){
					
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
{/literal}

<header class="header">
	
	{include file="logo.tpl"}
		
	{include file="navigation.tpl"}
		
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			{include file="user_panel.tpl"}
        	
			{include file="side_menu.tpl"}

		</section>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		
		{include file="breadcumb.tpl"}
		
		<!-- Main content -->
		<section class="content">
		
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-12 connectedSortable">
				
					<!-- TO DO List -->
					<div class="box box-primary">
						
						{if $module == 'in' AND $act == 'add'}
							{literal}
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
							{/literal}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Tambah Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="in.php?module=in&act=cancel&bbmNo={$bbmNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi pembelian ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="in.php?module=in&act=input">
								<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
								<input type="hidden" id="supplierName" name="supplierName" value="{$supplierName}">
								<input type="hidden" id="supplierAddress" name="supplierAddress" value="{$supplierAddress}">
								<input type="hidden" id="spbNo" name="spbNo" value="{$spbNo}">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="invoiceNo" name="invoiceNo" value="TB{$invoiceNo}">
											<input type="text" id="invoiceNo" name="invoiceNo" value="TB{$invoiceNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Transaksi Pembelian" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO BBM</td>
										<td>:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="Nomor BBM" style="width: 270px;" required> 
											{if $numsBbm == '0' AND $bbmNo != ''}
												<font color="#f56954">Nomor bukti barang masuk tidak ditemukan.</font>
											{/if}
											{if $numsBBuy > 0 AND $bbmNo != ''}
												<font color="#f56954">Nomor bukti barang masuk sudah digunakan.</font>
											{/if}
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
											{if $numsBbm > 0 AND $bbmNo != ''}
												{if $numsBBuy == '0' AND $bbmNo != ''}
													{section name=dataBbmDetail loop=$dataBbmDetail}
														<tr>
															<td>{$dataBbmDetail[dataBbmDetail].no}</td>
															<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
															<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].pricerp}</td>
															<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].receiveQty}</td>
															<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].subtotal}</td>
															<td><a title="Koreksi Harga" href="edit_in.php?module=in&act=edit&detailID={$dataBbmDetail[dataBbmDetail].detailID}&bbmNo={$bbmNo}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a></td>
														</tr>
													{/section}
												{/if}
											{/if}
										</tbody>
									</table>
								</div>
								<br>
								{if $numsBbm > 0 AND $bbmNo != ''}
									{if $numsBBuy == '0' AND $bbmNo != ''}
										<table cellpadding="3" cellspacing="3">
											<tr>
												<td width="190">JUMLAH HARGA BELI</td>
												<td width="5">:</td>
												<td><input type="hidden" id="total" name="total" value="{$total}">
													<input type="text" id="total" name="total" value="{$totalrp}" class="form-control" style="width: 270px;" DISABLED>
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
												<td><input type="hidden" id="basic" name="basic" value="{$total}">
													<input type="text" id="basicrp" name="basicrp" value="{$totalrp}" class="form-control" style="width: 270px;" DISABLED>
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
												<td><input type="hidden" id="grandtotal" name="grandtotal" value="{$total}">
													<input type="text" id="grandtotalrp" name="grandtotalrp" value="{$totalrp}" class="form-control" style="width: 270px;" DISABLED>
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
												<td><input type="hidden" id="debt" name="debt" value="0">
													<input type="text" id="debtrp" name="debtrp" value="0" class="form-control" style="width: 270px;" DISABLED></td>
											</tr>-->
										</table>
										<br>
										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'in' AND $act == 'finish'}
							{literal}
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
							{/literal}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_in.php?module=in&act=print&invoiceID={$invoiceID}&bbmNo={$bbmNo}&invoiceNo={$invoiceNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="in.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}" class="form-control" placeholder="Nomor Faktur" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO BBM</td>
										<td>:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr valign="top">
										<td>TIPE BAYAR</td>
										<td>:</td>
										<td><input type="text" id="paymentType" name="paymentType" value="{$paymentType}" class="form-control" placeholder="Tipe Bayar" style="width: 135px; float: left;" DISABLED>
											<input type="text" id="expiredDate" name="expiredDate" value="{$expiredPayment}" class="form-control" placeholder="Jatuh Tempo" style="width: 135px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>PPN /</td>
										<td>:</td>
										<td><input type="text" id="ppnType" name="ppnType" value="{$ppnType}" class="form-control" placeholder="PPN" style="width: 80px; float: left;" DISABLED>
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
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].pricerp}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].receiveQty}</td>
													<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].subtotal}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA BELI</td>
										<td width="5">:</td>
										<td><input type="text" id="total" name="total" value="{$total}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>POTONGAN</td>
										<td>:</td>
										<td><input type="text" id="discount" name="discount" value="{$discount}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>DASAR PENGENAAN PAJAK</td>
										<td>:</td>
										<td><input type="text" id="basicrp" name="basicrp" value="{$basic}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PPN (10%)</td>
										<td>:</td>
										<td><input type="text" id="ppnrp" name="ppnrp" value="{$ppn}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="text" id="grandtotalrp" name="grandtotalrp" value="{$grandtotal}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<!--<tr>
										<td>TITIP BAYAR</td>
										<td>:</td>
										<td><input type="text" id="pay" name="pay" value="{$pay}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtrp" name="debtrp" value="{$debt}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>-->
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'in' AND $act == 'detailin'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Pembelian</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_in.php?module=in&act=print&invoiceID={$invoiceID}&bbmNo={$bbmNo}&invoiceNo={$invoiceNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="in.php?module=in&act=search&q={$q}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="in.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
										{/if}
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}" class="form-control" placeholder="Nomor Faktur" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Penerimaan" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO BBM</td>
										<td>:</td>
										<td><input type="text" id="bbmNo" name="bbmNo" value="{$bbmNo}" class="form-control" placeholder="Nomor PO" style="width: 270px;" DISABLED></td>
									</tr>
									<tr valign="top">
										<td>TIPE BAYAR</td>
										<td>:</td>
										<td><input type="text" id="paymentType" name="paymentType" value="{$paymentType}" class="form-control" placeholder="Tipe Bayar" style="width: 135px; float: left;" DISABLED>
											<input type="text" id="expiredDate" name="expiredDate" value="{$expiredPayment}" class="form-control" placeholder="Jatuh Tempo" style="width: 135px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>PPN</td>
										<td>:</td>
										<td><input type="text" id="ppnType" name="ppnType" value="{$ppnType}" class="form-control" placeholder="PPN" style="width: 80px; float: left;" DISABLED>
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
											{section name=dataBbmDetail loop=$dataBbmDetail}
												<tr>
													<td>{$dataBbmDetail[dataBbmDetail].no}</td>
													<td>{$dataBbmDetail[dataBbmDetail].productName}</td>
													<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].pricerp}</td>
													<td style='text-align: center;'>{$dataBbmDetail[dataBbmDetail].receiveQty}</td>
													<td style='text-align: right;'>{$dataBbmDetail[dataBbmDetail].subtotal}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA BELI</td>
										<td width="5">:</td>
										<td><input type="text" id="total" name="total" value="{$total}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>POTONGAN</td>
										<td>:</td>
										<td><input type="text" id="discount" name="discount" value="{$discount}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>DASAR PENGENAAN PAJAK</td>
										<td>:</td>
										<td><input type="text" id="basicrp" name="basicrp" value="{$basic}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>PPN (10%)</td>
										<td>:</td>
										<td><input type="text" id="ppnrp" name="ppnrp" value="{$ppn}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td><input type="text" id="grandtotalrp" name="grandtotalrp" value="{$grandtotal}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<!--<tr>
										<td>TITIP BAYAR</td>
										<td>:</td>
										<td><input type="text" id="pay" name="pay" value="{$pay}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>
									<tr>
										<td>TERHUTANG</td>
										<td>:</td>
										<td><input type="text" id="debtrp" name="debtrp" value="{$debt}" class="form-control" style="width: 270px;" DISABLED></td>
									</tr>-->
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'in' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="in.php">
											<input type="hidden" name="module" value="in">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Pembelian" style="float: right; width: 270px;">
											<a href="in.php?module=in&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_in.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO BBM <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBuy loop=$dataBuy}
												<tr>
													<td>{$dataBuy[dataBuy].no}</td>
													<td>{$dataBuy[dataBuy].invoiceNo}</td>
													<td>{$dataBuy[dataBuy].invoiceDate}</td>
													<td>{$dataBuy[dataBuy].bbmNo}</td>
													<td>{$dataBuy[dataBuy].grandtotal}</td>
													<td>{$dataBuy[dataBuy].staffName}</td>
													<td>
														<a title="Detail" href="in.php?module=in&act=detailin&invoiceID={$dataBuy[dataBuy].invoiceID}&invoiceNo={$dataBuy[dataBuy].invoiceNo}&bbmNo={$dataBuy[dataBuy].bbmNo}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="in.php?module=in&act=delete&invoiceID={$dataBuy[dataBuy].invoiceID}&invoiceNo={$dataBuy[dataBuy].invoiceNo}&bbmNo={$dataBuy[dataBuy].bbmNo}&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBuy[dataBuy].invoiceNo}? penghapusan ini akan membatalkan seluruh hutang dan pembayaran terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="in.php">
											<input type="hidden" name="module" value="in">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Pembelian" style="float: right; width: 270px;">
											<a href="in.php?module=in&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_in.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>NO BBM <i class="fa fa-sort"></i></th>
												<th>GRANDTOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataBuy loop=$dataBuy}
												<tr>
													<td>{$dataBuy[dataBuy].no}</td>
													<td>{$dataBuy[dataBuy].invoiceNo}</td>
													<td>{$dataBuy[dataBuy].invoiceDate}</td>
													<td>{$dataBuy[dataBuy].bbmNo}</td>
													<td>{$dataBuy[dataBuy].grandtotal}</td>
													<td>{$dataBuy[dataBuy].staffName}</td>
													<td>
														<a title="Detail" href="in.php?module=in&act=detailin&invoiceID={$dataBuy[dataBuy].invoiceID}&invoiceNo={$dataBuy[dataBuy].invoiceNo}&bbmNo={$dataBuy[dataBuy].bbmNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="in.php?module=in&act=delete&invoiceID={$dataBuy[dataBuy].invoiceID}&invoiceNo={$dataBuy[dataBuy].invoiceNo}&bbmNo={$dataBuy[dataBuy].bbmNo}&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataBuy[dataBuy].invoiceNo}? penghapusan ini akan membatalkan seluruh hutang dan pembayaran terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-left">
									<ul class="pagination pagination-sm inline">
										{$pageLink}
									</ul>
								</div>
							</div><!-- /.box-header -->
						{/if}
						
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}