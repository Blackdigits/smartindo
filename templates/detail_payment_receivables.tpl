<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>

<body>				

{if $module == 'payment' AND $act == 'detail'}
	<table align="center">
		<tr>
			<td align="center"><h3><b>RINCIAN PEMBAYARAN</b></h3></td>
		</tr>
	</table>
	<table cellpadding="3" cellspacing="3">
		<tr>
			<td width="130" style="font-size: 14px;">NOMOR</td>
			<td width="5" style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$paymentNo}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TANGGAL</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$paymentDate}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">CARA BAYAR</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$payType}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">BANK</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$bankName}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NOMOR AKUN</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$bankNo}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NAMA AKUN</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$bankAC}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TANGGAL EFEKTIF</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$effectiveDate}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">TOTAL</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$total}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">REF</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$ref}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">NOTE</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$note}</td>
		</tr>
		<tr>
			<td style="font-size: 14px;">OPERATOR</td>
			<td style="font-size: 14px;">:</td>
			<td style="font-size: 14px;">{$staffName}</td>
		</tr>
	</table>
{/if}
</body>