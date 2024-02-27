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
			
			$("#category").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var categoryID = $("#categoryID").val();
				var categoryName = $("#categoryName").val();
				var categoryStatus = $("#categoryStatus").val();
				var categoryPrivat = $("#categoryprivat").val();
				
				if (categoryID != '' && categoryName != '' && categoryStatus != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_category.php',
						dataType: 'JSON',
						data:{
							categoryID: categoryID,
							categoryName: categoryName,
							categoryStatus: categoryStatus
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
				

{if $module == 'category' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Kategori</h3></td>
		</tr>
		<tr>
			<td>
				<form id="category" name="category" method="POST" action="#">
				<input type="hidden" id="categoryID" name="categoryID" value="{$categoryID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Nama Kategori</td>
						<td width="5">:</td>
						<td><input type="text" id="categoryName" name="categoryName" value="{$categoryName}" class="form-control" placeholder="Nama kategori" style="width: 270px;" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="categoryStatus" id="categoryStatus" class="form-control" placeholder="Nama kategori" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" {if $categoryStatus == 'Y'} SELECTED {/if}>Y (Aktif)</option>
							<option value="N" {if $categoryStatus == 'N'} SELECTED {/if}>N (Tidak Aktif)</option>
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