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

        function toko(selectObject) {
            var sleTex = selectObject.options[selectObject.selectedIndex].innerHTML;
            var selVal = selectObject.value;
            sessionStorage.setItem("tokoid", selVal);
            sessionStorage.setItem("nama_toko", sleTex); 
            url.searchParams.append('invoiceNo', selVal);
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
             document.getElementById('customerName').value = sessionStorage.getItem("nama_toko");
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
				
				window.location.href = "retur_staffs.php?module=retursale&act=add&invoiceNo=" + invoiceNo;
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#returbuy").submit(function() { return false; });
			$("#returbuy2").submit(function() { return false; });
			
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
						
						{if $module == 'retursale' AND $act == 'add'}
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
								<h3 class="box-title">Tambah Retur Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="retur_staffs.php?module=retursale&act=cancel" onclick="return confirm('Anda Yakin ingin membatalkan retur penjualan ini?');"><button class="btn btn-default pull-right">Batalkan Retur</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<form method="POST" action="retur_staffs.php?module=retursale&act=input">
								<input type="hidden" id="customerID" name="customerID" value="{$invoiceNo}">
								<input type="hidden" id="customerName" name="kustodian" value="{$customerName}"> 
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td><input type="hidden" id="returNo" name="returNo" value="{$returNo}">
											<input type="text" id="returNo" name="returNo" value="{$returNo}" class="form-control" placeholder="NO RETUR" style="width: 110px; float: left" DISABLED>
											<input type="text" id="returDate" name="returDate" value="{$returDate}" class="form-control" placeholder="Tanggal Retur Penjualan" style="width: 160px;" required>
										</td>
									</tr>
									<tr valign="top">
										<td>PILIH TOKO</td>
										<td>:</td>
										<td>
                                            <input type="hidden" name="customerName" id="nama-toko" value="">
                                            <select id="invoiceNo" name="customerID" class="form-control" style="width: 270px;" onchange="toko(this)" required>
												<option value=""></option>
												{section name=dataStaff loop=$dataStaff}
													{if $dataStaff[dataStaff].supplierID == $invoiceNo}
														<option value="{$dataStaff[dataStaff].supplierID}" SELECTED>{$dataStaff[dataStaff].supplierName}</option>
													{else}
														<option value="{$dataStaff[dataStaff].supplierID}">{$dataStaff[dataStaff].supplierName}</option>
													{/if}
												{/section}
											</select> 
										</td>
									</tr> 
                                    <tr>
										<td>PILIH GUDANG</td>
										<td>:</td>
										<td>  
											<input type="hidden" name="factoryName" id="nama-gudang" value="">
                                            <select id="pilihgudang" name="factoryID" class="form-control" style="width: 270px;" onchange="gudang(this)" required>
												<option value=""></option>
												{section name=dataGudang loop=$dataGudang}
													{if $dataGudang[dataGudang].factoryID == $GudangID}
														<option value="{$dataGudang[dataGudang].factoryID}" SELECTED>{$dataGudang[dataGudang].factoryName}</option>
													{else}
														<option value="{$dataGudang[dataGudang].factoryID}">{$dataGudang[dataGudang].factoryName}</option>
													{/if}
												{/section}
											</select> 
                                        </td>
									</tr>
									<tr>
										<td>PENGEMBALIAN</td>
										<td>:</td>
										<td><select id="returType" name="returType" class="form-control" style="width: 100px; float: left;" required>
												<option value=""></option>
												<option value="1">Cashback</option>
												<option value="2">Tukar Baru</option> 
											</select>
										</td>
									</tr> 
									<tr>
										<td>REF</td>
										<td>:</td>
										<td><input type="text" id="ref" name="ref" class="form-control" placeholder="Ref" style="width: 270px;"></td>
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
												<th>HARGA</th>
												<th>QTY RETUR</th>
												<th>NOTE</th>
											</tr>
										</thead>
										<tbody> 
												{section name=dataDoDetail loop=$dataDoDetail}
													<tr>
														<td>{$dataDoDetail[dataDoDetail].no}</td> 
														<td>{$dataDoDetail[dataDoDetail].productName} <input type="hidden" name="productID[]" value="{$dataDoDetail[dataDoDetail].productID}"> <input type="hidden" name="productName[]" value="{$dataDoDetail[dataDoDetail].productName}"></td>
														<td style='text-align: right;'>{$dataDoDetail[dataDoDetail].pricerp} <input type="hidden" name="unitPrice[]" value="{$dataDoDetail[dataDoDetail].price}"></td>
														<td><input type="text" id="qty" name="qty[]" value="0" class="form-control" placeholder="Qty Retur" style="width: 80px;"></td>
														<td><input type="text" id="desc" name="desc[]" class="form-control" placeholder="Note" style="width: 200px;"></td>
													</tr>
												{/section} 
										</tbody>
									</table>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">Simpan</button>
								</form>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'retursale' AND $act == 'finish'}
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
								<h3 class="box-title">Retur Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_retursale.php?module=retursale&act=print&invoiceNo={$invoiceNo}&returNo={$returNo}&returID={$returID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_staffs.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td>{$returNo} / {$returDate}</td>
									</tr>
									<tr valign="top">
										<td>TOKO</td>
										<td>:</td>
										<td>{$customerName}</td>
									</tr>
									<tr>
										<td>PENGEMBALIAN</td>
										<td>:</td>
										<td>{$returType}</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>{$customerAddress}</td>
									</tr>
									<tr>
										<td>REF</td>
										<td>:</td>
										<td>{$ref}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
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
											{section name=dataReturDetail loop=$dataReturDetail}
												<tr>
													<td>{$dataReturDetail[dataReturDetail].no} </td>
													<td>{$dataReturDetail[dataReturDetail].factoryName}</td>
													<td>{$dataReturDetail[dataReturDetail].productName}</td>
													<td style='text-align: right;'>{$dataReturDetail[dataReturDetail].price}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].qty}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].subtotal}</td>
													<td>{$dataReturDetail[dataReturDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">SUBTOTAL</td>
										<td width="5">:</td>
										<td>{$subtotal}</td>
									</tr>
									<tr>
										<td>PPN</td>
										<td>:</td>
										<td>{$ppn}</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td>{$grandtotal}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'retursale' AND $act == 'detailretur'}
							
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<h3 class="box-title">Retur Penjualan</h3>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
										<a href="print_unit_retursale.php?module=retursale&act=print&invoiceNo={$invoiceNo}&returNo={$returNo}&returID={$returID}" target="_blank"><button class="btn btn-default pull-right">Print</button></a>
										<a href="retur_staffs.php"><button class="btn btn-default pull-right">Close</button></a>
									</div>
								</div>
							</div><!-- /.box-header -->
							
							<div class="box-body">
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="150">NO RETUR / TGL</td>
										<td width="5">:</td>
										<td>{$returNo} / {$returDate}</td>
									</tr>
									<tr valign="top">
										<td>TOKO</td>
										<td>:</td>
										<td>{$customerName}</td>
									</tr>
									<tr>
										<td>PENGEMBALIAN</td>
										<td>:</td>
										<td>{$returType}</td>
									</tr>
									<tr>
										<td>GUDANG</td>
										<td>:</td>
										<td>{$customerAddress}</td>
									</tr>
									<tr>
										<td>REF</td>
										<td>:</td>
										<td>{$ref}</td>
									</tr>
									<tr>
										<td>NOTE</td>
										<td>:</td>
										<td>{$note}</td>
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
											{section name=dataReturDetail loop=$dataReturDetail}
												<tr>
													<td>{$dataReturDetail[dataReturDetail].no} </td>
													<td>{$dataReturDetail[dataReturDetail].factoryName}</td>
													<td>{$dataReturDetail[dataReturDetail].productName}</td>
													<td style='text-align: right;'>{$dataReturDetail[dataReturDetail].price}</td>
													<td style='text-align: center;'>{$dataReturDetail[dataReturDetail].qty}</td>
													<td>{$dataReturDetail[dataReturDetail].note}</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
								<br>
								<table cellpadding="3" cellspacing="3">
									<tr>
										<td width="190">SUBTOTAL</td>
										<td width="5">:</td>
										<td>{$subtotal}</td>
									</tr>
									<tr>
										<td>PPN</td>
										<td>:</td>
										<td>{$ppn}</td>
									</tr>
									<tr>
										<td>GRANDTOTAL</td>
										<td>:</td>
										<td>{$grandtotal}</td>
									</tr>
								</table>
							
							</div><!-- /.box-body -->
							
						{elseif $module == 'retursale' AND $act == 'search'}
						
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="retur_staffs.php">
											<input type="hidden" name="module" value="retursale">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Retur Penjualan" style="float: right; width: 270px;">
											<a href="retur_staffs.php?module=retursale&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_retursale.php?act=print&q={$q}&startDate={$startDate}&endDate={$endDate}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>TOKO <i class="fa fa-sort"></i></th>
												<th>PENGEMBALIAN <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataRetur loop=$dataRetur}
												<tr>
													<td>{$dataRetur[dataRetur].no}</td> 
													<td>{$dataRetur[dataRetur].returDate}</td>
													<td>{$dataRetur[dataRetur].customerAddress}</td>
													<td>{$dataRetur[dataRetur].customerName}</td>
													<td>{$dataRetur[dataRetur].returType}</td>
													<td>{$dataRetur[dataRetur].grandtotal}</td>
													<td>{$dataRetur[dataRetur].staffName}</td>
													<td>
														<a title="Detail" href="retur_staffs.php?module=retursale&act=detailretur&returID={$dataRetur[dataRetur].returID}&returNo={$dataRetur[dataRetur].returNo}&invoiceNo={$dataRetur[dataRetur].invoiceNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="retur_staffs.php?module=retursale&act=delete&returID={$dataRetur[dataRetur].returID}&returNo={$dataRetur[dataRetur].returNo}&invoiceNo={$dataRetur[dataRetur].invoiceNo}" onclick="return confirm('Anda Yakin ingin membatalkan retur {$dataRetur[dataRetur].returNo}? penghapusan ini akan membatalkan seluruh retur barang dan lainnya terkait retur ini.');"><img src="img/icons/delete.png" width="18"></a>
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
													
						{else}
							<div class="box-header">
								<i class="ion ion-clipboard"></i>
								<div class="box-tools pull-right">
									<div class="box-footer clearfix no-border">
									
										<form method="GET" action="retur_staffs.php">
											<input type="hidden" name="module" value="retursale">
											<input type="hidden" name="act" value="search">
											<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
											<input type="text" value="{$endDate}" id="endDate" name="endDate" class="form-control" placeholder="Periode Akhir" style="float: right; width: 115px;">
											<input type="text" value="{$startDate}" id="startDate" name="startDate" class="form-control" placeholder="Periode Awal" style="float: right; width: 115px;">
											<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Nomor Retur Penjualan" style="float: right; width: 270px;">
											<a href="retur_staffs.php?module=retursale&act=add" style="float: left;"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
											<a href="print_retursale.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
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
												<th>TANGGAL <i class="fa fa-sort"></i></th>
												<th>GUDANG <i class="fa fa-sort"></i></th>
												<th>TOKO <i class="fa fa-sort"></i></th>
												<th>PENGEMBALIAN <i class="fa fa-sort"></i></th>
												<th>TOTAL <i class="fa fa-sort"></i></th>
												<th>DIBUAT OLEH <i class="fa fa-sort"></i></th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											{section name=dataRetur loop=$dataRetur}
												<tr>
													<td>{$dataRetur[dataRetur].no}</td> 
													<td>{$dataRetur[dataRetur].returDate}</td>
													<td>{$dataRetur[dataRetur].customerAddress}</td>
													<td>{$dataRetur[dataRetur].customerName}</td>
													<td>{$dataRetur[dataRetur].returType}</td>
													<td>{$dataRetur[dataRetur].grandtotal}</td>
													<td>{$dataRetur[dataRetur].staffName}</td>
													<td>
														<a title="Detail" href="retur_staffs.php?module=retursale&act=detailretur&returID={$dataRetur[dataRetur].returID}&returNo={$dataRetur[dataRetur].returNo}&invoiceNo={$dataRetur[dataRetur].invoiceNo}&page={$page}"><img src="img/icons/view.png" width="18"></a>
														<a title="Delete" href="retur_staffs.php?module=retursale&act=delete&returID={$dataRetur[dataRetur].returID}&returNo={$dataRetur[dataRetur].returNo}&invoiceNo={$dataRetur[dataRetur].invoiceNo}" onclick="return confirm('Anda Yakin ingin membatalkan retur {$dataRetur[dataRetur].returNo}? penghapusan ini akan membatalkan seluruh retur barang dan lainnya terkait retur ini.');"><img src="img/icons/delete.png" width="18"></a>
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