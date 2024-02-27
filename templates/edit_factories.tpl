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
			
			$("#factory").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var factoryID = $("#factoryID").val();
				var factoryName = $("#factoryName").val();
				var factoryType = $("#factoryType").val();
				var status = $("#status").val();
				var note = $("#note").val();
				
				if (factoryID != '' && factoryName != '' && factoryType != '' && status != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_factory.php',
						dataType: 'JSON',
						data:{
							factoryID: factoryID,
							factoryName: factoryName,
							factoryType: factoryType,
							status: status,
							note: note
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
				

{if $module == 'factory' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Gudang / Pabrik</h3></td>
		</tr>
		<tr>
			<td>
				<form id="factory" name="factory" method="POST" action="#">
				<input type="hidden" id="factoryID" name="factoryID" value="{$factoryID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Gudang</td>
						<td width="5">:</td>
						<td><input type="text" id="factoryCode" name="factoryCode" value="{$factoryCode}" class="form-control" placeholder="Kode Gudang" style="width: 270px;" DISABLED></td>
					</tr>
					<tr>
						<td>Nama Gudang</td>
						<td>:</td>
						<td><input type="text" id="factoryName" name="factoryName" value="{$factoryName}" class="form-control" placeholder="Nama Gudang" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Tipe</td>
						<td>:</td>
						<td><select name="factoryType" id="factoryType" class="form-control" required>
							<option value="">- Pilih Status -</option>
							<option value="1" {if $factoryType == '1'} SELECTED {/if}>Tetap</option>
							<option value="2" {if $factoryType == '2'} SELECTED {/if}>Sementara (Sewa)</option>
						</select></td>
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
					<tr valign="top">
						<td>Note</td>
						<td>:</td>
						<td><textarea class="textarea" name="note" id="note" placeholder="Note" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{$note}</textarea></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>