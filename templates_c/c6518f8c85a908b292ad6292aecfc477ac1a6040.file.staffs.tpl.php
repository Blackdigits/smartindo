<?php /* Smarty version Smarty-3.1.11, created on 2022-11-17 20:25:15
         compiled from ".\templates\staffs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10078576dc8f39e8569-13611477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6518f8c85a908b292ad6292aecfc477ac1a6040' => 
    array (
      0 => '.\\templates\\staffs.tpl',
      1 => 1668665357,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10078576dc8f39e8569-13611477',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576dc8f3b32044_43950990',
  'variables' => 
  array (
    'q' => 0,
    'module' => 0,
    'act' => 0,
    'dataStaff' => 0,
    'pageLink' => 0,
    'dataModule' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576dc8f3b32044_43950990')) {function content_576dc8f3b32044_43950990($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />


	<script>
		$(document).ready(function() {
			
			$('.dropdown-menu').on('click', function(e) {
				if($(this).hasClass('dropdown-menu-form')) {
					e.stopPropagation();
				}
			});
			
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
			
			// Image 1
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			new AjaxUpload(btnUpload, {
				action: 'upload_staff.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
	                    // extension is not allowed 
						mestatus.text('Hanya ekstensi .JPG/JPEG yang diijinkan.');
						return false;
					}
					//mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
					mestatus.html('');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text('');
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response!=="error"){
						$('<li></li>').appendTo('#files').html('<img src="img/staffs/'+response+'" alt="" height="100"/><br />').addClass('success');
						$('<li></li>').appendTo('#photostaff').html('<input type="hidden" id="photo" name="photo" value="'+response+'">').addClass('nameupload');
						
					} else{
						$('<li></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			});
			
			$(".modalbox").fancybox();
			$(".modalbox2").fancybox();
			
			$("#staff").submit(function() { return false; });
			$("#staff2").submit(function() { return false; });
			
			$("#send").on("click", function(){
				var staffCode = $("#staffCode").val();
				var staffName = $("#staffName").val();
				var address = $("#address").val();
				var address2 = $("#address2").val();
				var village = $("#village").val();
				var district = $("#district").val();
				var city = $("#city").val();
				var zipCode = $("#zipCode").val();
				var province = $("#province").val();
				var phone = $("#phone").val();
				var position = $("#position").val();
				var part = $("#part").val();
				var statusStaff = $("#statusStaff").val();
				var level = $("#level").val();
				var photo = $("#photo").val();
				var email = $("#email").val();
				var password = $("#password").val();
				//var authorize = [];
				//$("input:checked").each(function() {
				//	authorize.push($(this).val());
				//});
				
				if (staffCode != '' && staffName != '' && statusStaff != '' && level != '' && email != '' && password != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_staff.php',
						dataType: 'JSON',
						data:{
							staffCode: staffCode,
							staffName: staffName,
							address: address,
							address2: address2,
							village: village,
							district: district,
							city: city,
							zipCode: zipCode,
							province: province,
							phone: phone,
							position: position,
							part: part,
							statusStaff: statusStaff,
							level: level,
							photo: photo,
							email: email,
							password: password
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							setTimeout("$.fancybox.close()", 1000);
							window.location.href = "staffs.php?msg=Data berhasil disimpan";
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
							<h3 class="box-title">Data Admin / Pegawai</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<form method="GET" action="staffs.php">
										<input type="hidden" name="module" value="staff">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Staff" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_staffs.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
                                        <a href="print_staffs_excel.php?act=print&q=<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Excel</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						<?php if ($_smarty_tpl->tpl_vars['module']->value=='staff'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
							
							<div class="box-body">
							
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA ADMIN <i class="fa fa-sort"></i></th>
												<th>TELPON <i class="fa fa-sort"></i></th>
												<th>JABATAN <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>LEVEL <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
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
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['phone'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['position'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['level'];?>
</td>
													<td>
														<a title="Edit" href="edit_staffs.php?module=staff&act=edit&staffID=<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="staffs.php?module=staff&act=delete&staffID=<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus staff <?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
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
												<th>NO</th>
												<th>KODE <i class="fa fa-sort"></i></th>
												<th>NAMA ADMIN <i class="fa fa-sort"></i></th>
												<th>TELPON <i class="fa fa-sort"></i></th>
												<th>JABATAN <i class="fa fa-sort"></i></th>
												<th>STATUS <i class="fa fa-sort"></i></th>
												<th>LEVEL <i class="fa fa-sort"></i></th>
												<th width="60">AKSI</th>
											</tr>
										</thead>
										<tbody>
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
												<tr>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['no'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffCode'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['phone'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['position'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['status'];?>
</td>
													<td><?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['level'];?>
</td>
													<td>
														<a title="Edit" href="edit_staffs.php?module=staff&act=edit&staffID=<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="staffs.php?module=staff&act=delete&staffID=<?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus staff <?php echo $_smarty_tpl->tpl_vars['dataStaff']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataStaff']['index']]['staffName'];?>
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
										<td align="center"><h3><b>DATABASE ADMIN</b></h3></td>
									</tr>
									<tr>
										<td>
											<form id="staff" name="staff" method="POST" action="#">
											<table cellpadding="3" cellspacing="3">
												<tr>
													<td width="170">Kode</td>
													<td width="5">:</td>
													<td><input type="text" id="staffCode" name="staffCode" class="form-control" placeholder="Kode Admin" style="width: 270px;" required></td>
													<td width="50"></td>
													<td colspan="3"></td>
												</tr>
												<tr>
													<td colspan="3" align="center" bgcolor="#999999" style="border-left: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;"><span style="font-size: 16px;"><b>DATA PRIBADI</b></span></td>
													<td></td>
													<td colspan="3"><span style="font-size: 16px;"><b>DATA PERUSAHAAN</b></span></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Nama Lengkap</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="staffName" name="staffName" class="form-control" placeholder="Nama Admin" style="width: 270px;" required></td>
													<td></td>
													<td>Jabatan</td>
													<td>:</td>
													<td><input type="text" id="position" name="position" class="form-control" placeholder="Jabatan / Posisi" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 1</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address" name="address" class="form-control" placeholder="Alamat 1" style="width: 270px;"></td>
													<td></td>
													<td>Bagian</td>
													<td>:</td>
													<td><input type="text" id="part" name="part" class="form-control" placeholder="Bagian" style="width: 270px;"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Alamat 2</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="address2" name="address2" class="form-control" placeholder="Alamat 2" style="width: 270px;"></td>
													<td></td>
													<td>Level</td>
													<td>:</td>
													<td>
														<select id="level" name="level" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															<option value="1">Administrator</option>
															<option value="2">Gudang</option>
															<option value="3">Kasir</option> 
														</select>
													</td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kelurahan</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="village" name="village" class="form-control" placeholder="Kelurahan" style="width: 270px;"></td>
													<td></td>
													<td>Status</td>
													<td>:</td>
													<td>
														<select id="statusStaff" name="statusStaff" class="form-control" style="width: 270px;" required>
															<option value=""></option>
															<option value="Y">Y [Aktif]</option>
															<option value="N">N [Tidak Aktif]</option>
														</select>
													</td>
												</tr>
												<tr valign="top">
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kecamatan</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="district" name="district" class="form-control" placeholder="Kecamatan" style="width: 270px;"></td>
													<td></td>
													<td>Password</td>
													<td>:</td>
													<td><input type="text" value="123456" id="password" name="password" class="form-control" placeholder="Password" style="width: 270px;" required></td>
												</tr>
												<tr valign="top">
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kota</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="city" name="city" class="form-control" placeholder="Kota" style="width: 270px;"></td>
													<td></td>
													<td>Photo</td>
													<td>:</td>
													<td rowspan="4">
														<div id="me" class="styleall" style="cursor:pointer;">
															<label>
																<button class="btn btn-warning">Browse</button>
															</label>
														</div>
														<span id="mestatus"></span>
														<div id="photostaff">
															<li class="nameupload"></li>
														</div>
														<div id="files">
															<li class="success"></li>
														</div>
													</td>
												</tr>
												<tr valign="top">
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Kode Pos</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="number" id="zipCode" name="zipCode" class="form-control" placeholder="Kode Pos" style="width: 270px;"></td>
													<td></td>
													<td colspan="3"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Propinsi</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="province" name="province" class="form-control" placeholder="Propinsi" style="width: 270px;"></td>
													<td></td>
													<td colspan="3"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; background-color: #FFFFFF;">Telp / HP</td>
													<td style="background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; background-color: #FFFFFF;"><input type="text" id="phone" name="phone" class="form-control" placeholder="Nomor Telepon Admin" style="width: 270px;"></td>
													<td></td>
													<td colspan="3"></td>
												</tr>
												<tr>
													<td style="border-left: 1px solid #000000; border-bottom: 1px solid #000000; background-color: #FFFFFF;">Email</td>
													<td style="border-bottom: 1px solid #000000; background-color: #FFFFFF;">:</td>
													<td style="border-right: 1px solid #000000; border-bottom: 1px solid #000000; background-color: #FFFFFF;"><input type="email" id="email" name="email" class="form-control" placeholder="Email" style="width: 270px;" required></td>
													<td></td>
													<td colspan="3"></td>
												</tr>
											</table>
											<br>
											<button id="send" class="btn btn-primary">Simpan</button>
											</form>
										</td>
									</tr>
								</table>
							</div>
						<?php }?>
					</div><!-- /.box -->
					
					<td width="100">Authorize</td>
												<td width="5">:</td>
												<td>
													<div class="dropdown">
														<a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
															Pilih Authorize
															<b class="caret"></b>
														</a>
														<ul class="dropdown-menu dropdown-menu-form" role="menu">
															<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['name'] = 'dataModule';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataModule']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataModule']['total']);
?>
																<li><input type="checkbox" id="authorize" name="authorize[]" value="<?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['moduleID'];?>
"> <?php echo $_smarty_tpl->tpl_vars['dataModule']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataModule']['index']]['moduleName'];?>
</li>
															<?php endfor; endif; ?>
														</ul>
													</div>
												</td>
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>