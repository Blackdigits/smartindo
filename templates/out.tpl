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
						
						{if $module == 'out' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="out.php?module=out&act=cancel&doNo={$doNo}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi penjualan ini?');"><button class="btn btn-default pull-right">Batal Trx</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="out.php?module=out&act=input">
								<input type="hidden" id="customerID" name="customerID" value="{$customerID}">
								<input type="hidden" id="customerName" name="customerName" value="{$customerName}">
								<input type="hidden" id="customerAddress" name="customerAddress" value="{$customerAddress}">
								<input type="hidden" id="soNo" name="soNo" value="{$soNo}">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}">
											<input type="text" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}" class="form-control" placeholder="ID BBM" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Transaksi Pembelian" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="Nomor DO" style="width: 270px;" required> 
											{if $numsDo == '0' AND $doNo != ''}
												<font color="#f56954">Nomor delivery order tidak ditemukan.</font>
											{/if}
											{if $numsSSales > 0 AND $doNo != ''}
												<font color="#f56954">Nomor delivery order sudah digunakan.</font>
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
											{if $numsDo > 0 AND $doNo != ''}
												{if $numsSSales == '0' AND $doNo != ''}
													{section name=dataDoDetail loop=$dataDoDetail}
														<tr>
															<td>{$dataDoDetail[dataDoDetail].no}</td>
															<td>{$dataDoDetail[dataDoDetail].productName}</td>
															<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].pricerp}</td>
															<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].deliveredQty}</td>
															<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].subtotal}</td>
															<td><a title="Koreksi Harga" href="edit_out.php?module=out&act=edit&detailID={$dataDoDetail[dataDoDetail].detailID}&doNo={$doNo}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a></td>
														</tr>
													{/section}
												{/if}
											{/if}
										</tbody>
									</table>
								</div>
								<br>
								{if $numsDo > 0 AND $doNo != ''}
									{if $numsSSales == '0' AND $doNo != ''}
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
												<td><input type="hidden" id="receive" name="receive" value="0">
													<input type="text" id="receiverp" name="receiverp" value="0" class="form-control" style="width: 270px;" DISABLED></td>
											</tr>-->
										</table>
										<br>
										<button type="submit" class="btn btn-primary">Simpan</button>
									{/if}
								{/if}
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'out' AND $act == 'finish'}
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
								<h3 class="box-title">Faktur Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_out.php?module=out&act=print&invoiceID={$invoiceID}&doNo={$doNo}&invoiceNo={$invoiceNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="out.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO FAKTUR / TGL</td>
										<td width="5">:</td>
										<td><input type="text" id="invoiceNo" name="invoiceNo" value="{$invoiceNo}" class="form-control" placeholder="Nomor Faktur" style="width: 110px; float: left" DISABLED>
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Pengiriman" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="Nomor DO" style="width: 270px;" DISABLED></td>
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
											{section name=dataDoDetail loop=$dataDoDetail}
												<tr>
													<td>{$dataDoDetail[dataDoDetail].no}</td>
													<td>{$dataDoDetail[dataDoDetail].productName}</td>
													<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].pricerp}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].deliveredQty}</td>
													<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].subtotal}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA JUAL</td>
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
							
						{elseif $module == 'out' AND $act == 'detailout'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Faktur Transaksi Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_out.php?module=out&act=print&invoiceID={$invoiceID}&doNo={$doNo}&invoiceNo={$invoiceNo}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										{if $q != ''}
											<a href="out.php?module=out&act=search&q={$q}"><button class="btn btn-default pull-right">Back</button></a>
										{else}
											<a href="out.php?page={$page}"><button class="btn btn-default pull-right">Back</button></a>
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
											<input type="text" id="invoiceDate" name="invoiceDate" value="{$invoiceDate}" class="form-control" placeholder="Tanggal Pengiriman" style="width: 160px;" DISABLED>
										</td>
									</tr>
									<tr valign="top">
										<td>NO DO</td>
										<td>:</td>
										<td><input type="text" id="doNo" name="doNo" value="{$doNo}" class="form-control" placeholder="Nomor DO" style="width: 270px;" DISABLED></td>
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
											{section name=dataDoDetail loop=$dataDoDetail}
												<tr>
													<td>{$dataDoDetail[dataDoDetail].no}</td>
													<td>{$dataDoDetail[dataDoDetail].productName}</td>
													<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].pricerp}</td>
													<td style='text-align: center;'>{$dataDoDetail[dataDoDetail].deliveredQty}</td>
													<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].subtotal}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">JUMLAH HARGA JUAL</td>
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
							
						{elseif $module == 'out' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Penjualan" style="float: right; width: 270px;" required>
											<a href="out.php?module=out&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_out.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataSales loop=$dataSales}
												<tr>
													<td>{$dataSales[dataSales].no}</td>
													<td>{$dataSales[dataSales].invoiceNo}</td>
													<td>{$dataSales[dataSales].invoiceDate}</td>
													<td>{$dataSales[dataSales].doNo}</td>
													<td>{$dataSales[dataSales].grandtotal}</td>
													<td>{$dataSales[dataSales].staffName}</td>
													<td>
														<a title="Detail" href="out.php?module=out&act=detailout&invoiceID={$dataSales[dataSales].invoiceID}&invoiceNo={$dataSales[dataSales].invoiceNo}&doNo={$dataSales[dataSales].doNo}&q={$q}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="out.php?module=out&act=delete&invoiceID={$dataSales[dataSales].invoiceID}&invoiceNo={$dataSales[dataSales].invoiceNo}&doNo={$dataSales[dataSales].doNo}&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataSales[dataSales].invoiceNo}? penghapusan ini akan membatalkan seluruh hutang dan pembayaran konsumen terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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
									
										<form method="GET" action="out.php">
											<input type="hidden" name="module" value="out">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Faktur Penjualan" style="float: right; width: 270px;">
											<a href="out.php?module=out&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_out.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
											{section name=dataSales loop=$dataSales}
												<tr>
													<td>{$dataSales[dataSales].no}</td>
													<td>{$dataSales[dataSales].invoiceNo}</td>
													<td>{$dataSales[dataSales].invoiceDate}</td>
													<td>{$dataSales[dataSales].doNo}</td>
													<td>{$dataSales[dataSales].grandtotal}</td>
													<td>{$dataSales[dataSales].staffName}</td>
													<td>
														<a title="Detail" href="out.php?module=out&act=detailout&invoiceID={$dataSales[dataSales].invoiceID}&invoiceNo={$dataSales[dataSales].invoiceNo}&doNo={$dataSales[dataSales].doNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="out.php?module=out&act=delete&invoiceID={$dataSales[dataSales].invoiceID}&invoiceNo={$dataSales[dataSales].invoiceNo}&doNo={$dataSales[dataSales].doNo}&" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataSales[dataSales].invoiceNo}? penghapusan ini akan membatalkan seluruh hutang dan pembayaran konsumen terkait transaksi ini.');"><img src="img/icons/delete.png" width="18"></a>
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