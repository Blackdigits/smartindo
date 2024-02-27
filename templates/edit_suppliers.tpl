<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#supplier").submit(function() { return false; });
	
			$("#send").on("click", function(){
                var supplierCode = $("#supplierCode").val();
				var supplierID = $("#supplierID").val();
				var supplierName = $("#supplierName").val();
				var contactPerson = $("#contactPerson").val();
				var address = $("#address").val();
				var city = $("#city").val();
				var phone = $("#phone").val();
				var fax = $("#fax").val();
				var email = $("#email").val();
				var privat = $("#privat").val();
				
				if (supplierID != '' && supplierName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_supplier.php',
						dataType: 'JSON',
						data:{
                            supplierCode: supplierCode,
							supplierID: supplierID,
							supplierName: supplierName,
							contactPerson: contactPerson,
							address: address,
							city: city,
							phone: phone,
							fax: fax,
							email: email
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'supplier' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Data</h3></td>
		</tr>
		<tr>
			<td>
				<form id="supplier" name="supplier" method="POST" action="#">
				<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode</td>
						<td width="5">:</td>
						<td><input type="text" value="{$supplierCode}" id="supplierCode" name="supplierCode" class="form-control" placeholder="Kode Sales" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Nama Sales</td>
						<td>:</td>
						<td><input type="text" value="{$supplierName}" id="supplierName" name="supplierName" class="form-control" placeholder="Username Login" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Username Login</td>
						<td>:</td>
						<td><input type="text" value="{$contactPerson}" id="contactPerson" name="contactPerson" class="form-control" placeholder="Nama Sales" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" value="{$address}" id="address" name="address" class="form-control" placeholder="Alamat" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Kota</td>
						<td>:</td>
						<td><input type="text" value="{$city}" id="city" name="city" class="form-control" placeholder="Kota" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><input type="text" value="{$phone}" id="phone" name="phone" class="form-control" placeholder="Telepon" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" id="fax" name="fax" class="form-control" placeholder="****" style="width: 270px;"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="email" value="{$email}" id="email" name="email" class="form-control" placeholder="Email" style="width: 270px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>