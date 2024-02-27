<?php /* Smarty version Smarty-3.1.11, created on 2022-11-15 15:12:31
         compiled from ".\templates\customers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22604576dc99e9a3ea7-80932669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd91deeb02ba7c0f9e775ea285522511d9e5726f' => 
    array (
      0 => '.\\templates\\customers.tpl',
      1 => 1668499950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22604576dc99e9a3ea7-80932669',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc99eb0e7f6_70280052',
  'variables' => 
  array (
    'q' => 0,
    'module' => 0,
    'act' => 0,
    'dataCustomer' => 0,
    'page' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc99eb0e7f6_70280052')) {function content_576dc99eb0e7f6_70280052($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>


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
			
			$("#customer").submit(function() { return false; });
			$("#customer2").submit(function() { return false; });
					
			$("#send").on("click", function(){
				var customerCode = $("#customerCode").val();
				var customerName = $("#customerName").val();
				var contactPerson = $("#contactPerson").val();
				var address = $("#address").val();
				var address2 = $("#address2").val();
				var village = $("#village").val();
				var district = $("#district").val();
				var city = $("#city").val();
				var zipCode = $("#zipCode").val();
				var province = $("#province").val();
				var phone1 = $("#phone1").val();
				var phone2 = $("#phone2").val();
				var phone3 = $("#phone3").val();
				var fax1 = $("#fax1").val();
				var fax2 = $("#fax2").val();
				var fax3 = $("#fax3").val();
				var phonecp1 = $("#phonecp1").val();
				var phonecp2 = $("#phonecp2").val();
				var email = $("#email").val();
				var limitBalance = $("#limitBalance").val();
				var discount1 = $("#discount1").val();
				var discount2 = $("#discount2").val();
				var discount3 = $("#discount3").val();
				var note = $("#note").val();
				var npwp = $("#npwp").val();
				var pkpName = $("#pkpName").val();
				var staffCode = $("#staffCode").val(); 
				
				if (customerCode != '' && customerName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_customer.php',
						dataType: 'JSON',
						data:{
							customerCode: customerCode,
							customerName: customerName,
							contactPerson: contactPerson,
							address: address,
							address2: address2,
							village: village,
							district: district,
							city: city,
							zipCode: zipCode,
							province: province,
							phone1: phone1,
							phone2: phone2,
							phone3: phone3,
							fax1: fax1,
							fax2: fax2,
							fax3: fax3,
							phonecp1: phonecp1,
							phonecp2: phonecp2,
							email: email,
							limitBalance: limitBalance,
							discount1: discount1,
							discount2: discount2,
							discount3: discount3,
							note: note,
							npwp: npwp,
							pkpName: pkpName,
							staffCode: staffCode
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "customers.php?msg=Data berhasil disimpan";
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
						
						<div class="box-header">
							<i class="ion ion-clipboard"></i>
							<h3 class="box-title">Data Toko</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
								
									<form method="GET" action="customers.php">
										<input type="hidden" name="module" value="customer">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Kode, nama toko atau kota" style="float: right; width: 275px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_customers.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='customer'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
							<div class="box-body">
								
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA TOKO <i class="fa fa-sort"></i></th>
												<th>KONTAK PERSON <i class="fa fa-sort"></i></th>
												<th>KOTA <i class="fa fa-sort"></i></th>
												<th>TLP <i class="fa fa-sort"></i></th> 
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['name'] = 'dataCustomer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCustomer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['contactPerson'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['city'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['phone1'];?>
</td> 
													<td>
														<a title="Edit" href="edit_customers.php?module=customer&act=edit&customerID=<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
" data-width="900" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="customers.php?module=customer&act=delete&customerID=<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus DATA <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											<?php endfor; endif; ?>
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						<?php }else{ ?>
						
							<div class="box-body">
							
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO <i class="fa fa-sort"></i></th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA TOKO <i class="fa fa-sort"></i></th>
												<th>KONTAK PERSON <i class="fa fa-sort"></i></th>
												<th>KOTA <i class="fa fa-sort"></i></th> 
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['name'] = 'dataCustomer';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCustomer']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCustomer']['total']);
?>
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['contactPerson'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['city'];?>
</td> 
													<td>
														<a title="Edit" href="edit_customers.php?module=customer&act=edit&customerID=<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
" data-width="900" data-height="180" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="customers.php?module=customer&act=delete&customerID=<?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerID'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus customer <?php echo $_smarty_tpl->tpl_vars['dataCustomer']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCustomer']['index']]['customerName'];?>
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
							
							
							<div id="inline">	
								<table width="95%" align="center">
									<tr>
										<td align="center"><h3><b>MASTER DATA TOKO</b></h3></td>
									</tr>
									<tr>
										<td>
											<form id="customer" name="customer" method="POST" action="#">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="150">Kode Toko</td>
													<td width="5">:</td>
													<td><input type="text" id="customerCode" name="customerCode" class="form-control" placeholder="Kode Customer" style="width: 270px;" required></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<td colspan="3" align="center" bgcolor="#999999" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;"><span style="font-size: 16px;"><b>DATA TOKO</b></span></td>
													<td></td>
													<td colspan="3" align="center" bgcolor="#999999" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;"><span style="font-size: 16px;"><b>ORANG YANG DIHUBUNGI</b></span></td>
												</tr>
												<tr>
													<td width="150" style="border-left: 1px solid #000000; background-color: #FFFFFF;">Nama Toko</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="customerName" name="customerName" class="form-control" placeholder="Nama Customer" style="width: 270px;" required></td>
													<td width="50"></td>
													<td width="140" style="border-left: 1px solid #000000; background-color: #FFFFFF;">Nama Lengkap</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="contactPerson" name="contactPerson" class="form-control" placeholder="Kontak Person" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 1</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address" name="address" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
													<td></td>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">No. HP 1</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="phonecp1" name="phonecp1" class="form-control" placeholder="No. Handphone 1" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 2</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address2" name="address2" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
													<td></td>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">No. HP 2</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="phonecp2" name="phonecp2" class="form-control" placeholder="No. Handphone 2" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kelurahan</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="village" name="village" class="form-control" placeholder="Kelurahan" style="width: 270px;"></td>
													<td></td>
													<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; background-color: #FFFFFF;">Email</td>
													<td style="border-bottom: 1px solid #000000; background-color: #FFFFFF;">:</td>
													<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="email" id="email" name="email" class="form-control" placeholder="Email" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kecamatan</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="district" name="district" class="form-control" placeholder="Kecamatan" style="width: 270px;"></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kota/Kode Pos</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="city" name="city" class="form-control" placeholder="Kota" style="width: 160px; float: left; margin-right: 5px;"> <input type="number" id="zipCode" name="zipCode" class="form-control" placeholder="Kode Pos" style="width: 105px;"></td>
													<td></td>
													<td align="center" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; background-color: #999999;" colspan="3"><span style="font-size: 16px;"><b>IDENTITAS PAJAK</b></span></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Propinsi</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="province" name="province" class="form-control" placeholder="Propinsi" style="width: 270px;"></td>
													<td></td>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Nomor NPWP</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="npwp" name="npwp" class="form-control" placeholder="Nomor NPWP" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;"></td>
													<td style="background-color: #FFFFFF;"></td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;">
														<input type="hidden" id="phone1" name="phone1" class="form-control" placeholder="Telepon 1" style="width: 85px; float: left; margin-right: 5px;">
														<input type="hidden" id="phone2" name="phone2" class="form-control" placeholder="Telepon 2" style="width: 87px; float: left; margin-right: 5px;">
														<input type="hidden" id="phone3" name="phone3" class="form-control" placeholder="Telepon 3" style="width: 87px;"> 
													</td>
													<td></td>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Lokasi KPP</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="pkpName" name="pkpName" class="form-control" placeholder="Nama PKP" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;"></td>
													<td style="background-color: #FFFFFF;"></td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;">
														<input type="hidden" id="fax1" name="fax1" class="form-control" placeholder="Fax 1" style="width: 85px; float: left; margin-right: 5px;">
														<input type="hidden" id="fax2" name="fax2" class="form-control" placeholder="Fax 2" style="width: 87px; float: left; margin-right: 5px;">
														<input type="hidden" id="fax3" name="fax3" class="form-control" placeholder="Fax 3" style="width: 87px;"> 
													</td>
													<td></td>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Note</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td rowspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><textarea id="note" name="note" class="form-control" placeholder="Keterangan" style="width: 270px; height: 72px;"></textarea></td>
												</tr>
												<tr valign="top">
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Diskon</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="number" id="discount1" name="discount1" class="form-control" placeholder="Disc 1" style="width: 85px; float: left; margin-right: 5px;">
														<input type="number" id="discount2" name="discount2" class="form-control" placeholder="Disc 2" style="width: 87px; float: left; margin-right: 5px;">
														<input type="number" id="discount3" name="discount3" class="form-control" placeholder="Disc 3" style="width: 87px;"> 
													</td>
													<td></td>
													<td colspan="2" style="background-color: #FFFFFF; border-left: 1px solid #000000; border-bottom: 1px solid #000000;"></td>
												</tr>
												<tr>
													<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; background-color: #FFFFFF;">Kode Sales</td>
													<td style="border-bottom: 1px solid #000000; background-color: #FFFFFF;">:</td>
													<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="hidden" id="limitBalance" name="limitBalance" class="form-control" placeholder="Limit" style="width: 165px; float: left; margin-right: 5px;">
														<input type="text" id="staffCode" name="staffCode" class="form-control" placeholder="Kode Sales" style="width: 100px;">
													</td>
													<td colspan="4"></td>
												</tr>
											</table>
											<br>
											<button id="send" class="btn btn-primary" style="float:right;">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						<?php }?>
					</div><!-- /.box -->
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>