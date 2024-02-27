
<?php 
    include 'header.php'; 
    include 'config.php';  
    session_start();
    if (empty($_COOKIE["supplierCode"])){
        header("location: multi_user");
    }
?>
  <style>

    </style>	 
   
  <p style="margin:19px 0 6px 0"> Lagi ditoko mana kamu saat ini? </p>
  <select id="states" placeholder="Pilih Toko..." name="toko" required>
    <option value="<?= $_COOKIE['tokos']?>"><?= $_COOKIE['namatoko']?></option>
    <?php  
        $query ="SELECT customerID, customerName FROM as_customers";      
        $result = $connect->query($query); 
        while($row = mysqli_fetch_array($result)) {   ?>
        <option value="<?= $row['customerID'] ?>"><?= $row['customerName'] ?></option>
    <?php } ?>
  </select> 
	<p style="margin:19px 0 6px 0">Metode Pambayaran Toko? </p>
  <select id="payment" placeholder="Pilih Metode Pembayaran..." name="pay" required> 
    <option value="<?= $_COOKIE['paymethod']?>"><?= $_COOKIE['paymethod'] ?></option>
    <option value="Cash" >Cash (Tunai)</option>
    <option value="Transfer">Transfer</option>
    <option value="Hutang">Hutang</option> 
  </select>  
<p style="margin:19px 0 6px 0; margin-bottom:15px;">Mau jual produk apa? </p>
<div id="produk" style="text-align:center;overflow-x: scroll;">

    <table style="width:100%; border-collapse: collapse;" class="table" id="tableSelected">
        <thead style="border-bottom: 2px solid lightgrey;"> 
            <tr> 
                <td>Produk</td>
                <td>Harga</td>
                <td>Qty</td>
            </tr>
        </thead>
        <tbody>
            <tr> 
                <td colspan="4">masih kosong nih</td>
            </tr> 
        </tbody>
    </table>  
</div>  
<br />
<button onclick="showSelectedRow($rows);" class="hapus" id="hapus" style="display:none;">- Hapus</button>
<a class="tambah" href="#tambah">+ tambah</a>
<br /> <br /><br />
	<div style="display:none;" id="dengan-diskon" class="selectize-input">Diskon : <input type="text" value="0" id="dengan-rupiah"/><a onclick="diskon();">OKE</a></div>
<br />

<label style="font-size:14px;"><input type="checkbox" onclick="myFunction()" style="width:15px; height: 15px;" id="cek-diskon">Diskon (Harga Khusus)</label>
<br />
<label style="font-size:14px;"><input type="checkbox" style="width:15px; height: 15px;margin-top: 12px;" onclick="pajak()" id="cek-pajak">Pajak (PPh 21)</label>

<br /> <br />
  <table width="100%" border="0"> 
		<tr>
			<td rowspan="4" width="30%"></td>
			<td class="table-title" width="30%" >Subtotal</td>
			<td class="price-table" width="40%">Rp <input type="number" value="0" name="subtotal" id="substotal" readonly></td>
		</tr>
        <tr> 
			<td class="table-title" width="30%">Diskon</td>
			<td class="price-table" id="diskon" width="40%">Rp <input type="number" value="0" name="diskon" id="disc" readonly></td>
		</tr>
		<tr> 
			<td class="table-title" width="30%">Pajak</td>
			<td class="price-table" id="pajak" width="40%">Rp <input type="number" value="0" name="pajak" id="taxe" readonly></td>
		</tr>
		<tr> 
			<td class="table-title" width="30%">Total</td>
			<td class="price-table" width="40%">Rp <input type="number" value="0" name="total" id="totale" readonly></td>
		</tr> 
</table>


<br /><br />
  <center> 
    <button type="submit" class="button" id="konfir" DISABLED>
      Konfirmasi Transaksi <!-- if empty $total -> HIDE -->
    </button> 
  </center>  
     
<div id="tambah" class="overlay">
	<div class="popup">
		<h2>Tambah produk</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			 <p style="margin:19px 0 6px 0">Nama Produk </p>
				<select id="select-product" placeholder="Pilih produk..." name="produk" required> 
					<option value="">Pilih Produk</option>
                    <?php  
                        $query ="SELECT A.productID AS idp, productName AS NAMAProduk, B.stock AS stok, unitPrice1 AS harga1 FROM `as_products` A INNER JOIN as_stock_products B ON A.productID = B.productID WHERE B.stock > 0 AND B.supplierID = '$supID'";      
                        $result = $connect->query($query); 
                        while($row = mysqli_fetch_array($result)) {   ?>
                        <option value="<?= $row['idp'] ?>"><?= $row['NAMAProduk'] ?></option>
                    <?php } ?> 
				</select>  
                <p style="margin:19px 0 6px 0; display:none;" id="label-harga">Satuan Harga </p>
				<div id="selected-product"></div>
				<br />
				<div class="selectize-input" id="label-qty" style="display:none;">
				Jumlah : <input type="number" style="width: 50%" id="qty" name="qty" />pcs</div> 
			    <br /><br /><br />
			
			<center>
        <div  id="selling"></div>
				<button type="reset" onclick="location.href='#';" style="border:none;background:transparent;margin-right:15%;"> Batal </button>
				<button onclick="selling();" style="color:green;font-weight:bold;"> Tambah </button>
			</center>
		</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="tableSelection.js"></script> 
<script src="ajax/flow.go.js"></script>
<script type="text/javascript">  
 var button = document.getElementById("konfir");

button.addEventListener("click", function(){
    if (document.getElementById('cek-diskon').checked) {
            var diskon = document.getElementById("dengan-rupiah").value;
        } else {
            var diskon = 0;
    }
    if (document.getElementById('cek-pajak').checked) {
            var pajak = 'Y';
        } else {
            var pajak = 'N';
    }
    document.location.href = 'sukses.php?diskon='+diskon+'&pajak='+pajak;
});

</script> 
</body>
</html>