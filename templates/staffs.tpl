{include file="header.tpl"}

<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

{literal}
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
						
						<div class="box-header">
							<i class="ion ion-clipboard"></i>
							<h3 class="box-title">Data Admin / Pegawai</h3>
							<div class="box-tools pull-right">
								<div class="box-footer clearfix no-border">
									<form method="GET" action="staffs.php">
										<input type="hidden" name="module" value="staff">
										<input type="hidden" name="act" value="search">
										<button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Search</button>
										<input type="text" value="{$q}" id="q" name="q" class="form-control" placeholder="Pencarian : Kode atau Nama Staff" style="float: right; width: 270px;" required>
									
										<a href="#inline" class="modalbox" style="float: left;"><button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</button></a>
										<a href="print_staffs.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print PDF</button></a>
                                        <a href="print_staffs_excel.php?act=print&q={$q}" style="float: left;" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Excel</button></a>
										&nbsp;&nbsp;&nbsp;
									</form>
								</div>
							</div>
						</div><!-- /.box-header -->
						
						{if $module == 'staff' AND $act == 'search'}
							
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
											{section name=dataStaff loop=$dataStaff}
												<tr>
													<td>{$dataStaff[dataStaff].no}</td>
													<td>{$dataStaff[dataStaff].staffCode}</td>
													<td>{$dataStaff[dataStaff].staffName}</td>
													<td>{$dataStaff[dataStaff].phone}</td>
													<td>{$dataStaff[dataStaff].position}</td>
													<td>{$dataStaff[dataStaff].status}</td>
													<td>{$dataStaff[dataStaff].level}</td>
													<td>
														<a title="Edit" href="edit_staffs.php?module=staff&act=edit&staffID={$dataStaff[dataStaff].staffID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="staffs.php?module=staff&act=delete&staffID={$dataStaff[dataStaff].staffID}" onclick="return confirm('Anda Yakin ingin menghapus staff {$dataStaff[dataStaff].staffName}?');"><img src="img/icons/delete.png" width="18"></a>
													</td>
												</tr>
											{/section}
										</tbody>
									</table>
								</div>
							
							</div><!-- /.box-body -->
						
						{else}
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
											{section name=dataStaff loop=$dataStaff}
												<tr>
													<td>{$dataStaff[dataStaff].no}</td>
													<td>{$dataStaff[dataStaff].staffCode}</td>
													<td>{$dataStaff[dataStaff].staffName}</td>
													<td>{$dataStaff[dataStaff].phone}</td>
													<td>{$dataStaff[dataStaff].position}</td>
													<td>{$dataStaff[dataStaff].status}</td>
													<td>{$dataStaff[dataStaff].level}</td>
													<td>
														<a title="Edit" href="edit_staffs.php?module=staff&act=edit&staffID={$dataStaff[dataStaff].staffID}" data-width="900" data-height="420" class="various2 fancybox.iframe"><img src="img/icons/edit.png" width="18"></a>
														<a title="Delete" href="staffs.php?module=staff&act=delete&staffID={$dataStaff[dataStaff].staffID}" onclick="return confirm('Anda Yakin ingin menghapus staff {$dataStaff[dataStaff].staffName}?');"><img src="img/icons/delete.png" width="18"></a>
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
						{/if}
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
															{section name=dataModule loop=$dataModule}
																<li><input type="checkbox" id="authorize" name="authorize[]" value="{$dataModule[dataModule].moduleID}"> {$dataModule[dataModule].moduleName}</li>
															{/section}
														</ul>
													</div>
												</td>
					
				</section><!-- /.Left col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="footer.tpl"}