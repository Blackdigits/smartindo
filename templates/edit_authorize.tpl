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
			
			$("#authorize").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var modulID = $("#modulID").val();
				var status = $("#status").val();
				if ($("#authorize1").is(':checked')){
					var authorize1 = "1,";
				}
				else{
					var authorize1 = "0,";
				}
				
				if ($("#authorize2").is(':checked')){
					var authorize2 = "2,";
				}
				else{
					var authorize2 = "0,";
				}
				
				if ($("#authorize3").is(':checked')){
					var authorize3 = "3,";
				}
				else{
					var authorize3 = "0,";
				}
				
				if ($("#authorize4").is(':checked')){
					var authorize4 = "4,";
				}
				else{
					var authorize4 = "0,";
				}
				
				if ($("#authorize5").is(':checked')){
					var authorize5 = "5";
				}
				else{
					var authorize5 = "0";
				}
				
				if (modulID != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_authorize.php',
						dataType: 'JSON',
						data:{
							modulID: modulID,
							status: status,
							authorize1: authorize1,
							authorize2: authorize2,
							authorize3: authorize3,
							authorize4: authorize4,
							authorize5: authorize5
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
				

{if $module == 'authorize' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td align="center"><h3><b>OTORISASI LEVEL</b></h3></td>
		</tr>
		<tr>
			<td>
				<form id="authorize" name="authorize" method="POST" action="#">
				<input type="hidden" id="modulID" name="modulID" value="{$modulID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Nama Modul</td>
						<td width="5">:</td>
						<td><input type="text" id="modulName" name="modulName" value="{$modulName}" class="form-control" placeholder="Nama Modul" style="width: 270px;" DISABLED></td>
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
						<td>Level</td>
						<td>:</td>
						<td> 	<input type="checkbox" id="authorize1" name="authorize1" {if $adm == '1'} CHECKED {/if}> Administrator <br>
								<input type="checkbox" id="authorize2" name="authorize2" {if $sls == '2'} CHECKED {/if}> Sales <br>
								<input type="checkbox" id="authorize3" name="authorize3" {if $ksr == '3'} CHECKED {/if}> Kasir <br>
								<input type="checkbox" id="authorize4" name="authorize4" {if $spv == '4'} CHECKED {/if}> Distributor <br>
								<input type="checkbox" id="authorize5" name="authorize5" {if $top == '5'} CHECKED {/if}> Agen <br>
						</td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>