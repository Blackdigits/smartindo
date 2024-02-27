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
			
			$("#currency").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var currencyID = $("#kursID").val();
				var valas = $("#valas").val();
				var kurs = $("#kurs").val();
				var status = $("#status").val();
				
				if (currencyID != '' && valas != '' && status != '' && kurs != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_kurs.php',
						dataType: 'JSON',
						data:{
							currencyID: currencyID,
							valas: valas,
							kurs: kurs,
							status: status
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
				

{if $module == 'kurs' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Kurs / Valas</h3></td>
		</tr>
		<tr>
			<td>
				<form id="currency" name="currency" method="POST" action="#">
				<input type="hidden" id="kursID" name="kursID" value="{$kursID}">
				<table cellpadding="3" cellspacing="3">
					<tr>
						<td width="100">Valas</td>
						<td width="5">:</td>
						<td><input type="text" id="valas" value="{$valas}" name="valas" class="form-control" placeholder="Valas" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Kurs</td>
						<td>:</td>
						<td><input type="number" id="kurs" value="{$kurs}" name="kurs" class="form-control" placeholder="Kurs IDR" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="status" id="status" class="form-control" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" {if $status == 'Y'} SELECTED {/if}>Y (Aktif)</option>
							<option value="N" {if $status == 'N'} SELECTED {/if}>N (Tidak Aktif)</option>
						</select></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>