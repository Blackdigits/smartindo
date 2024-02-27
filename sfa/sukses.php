<?php 
include 'config.php'; 

        $createdDate = date('Y-m-d H:i:s');
        $orderDate = date('Y-m-d');
        $soFaktur = date('Ymdhis'); 
        $note = $_COOKIE['paymethod'];
        $customerID = $_COOKIE['tokos'];
        $customerName = $_COOKIE['namatoko']; 
        
        $queryNoSo = "SELECT soNo FROM as_detail_so ORDER BY soNo DESC LIMIT 1";
		$sqlNoSo = mysqli_query($connect, $queryNoSo);
		$numsNoSo = mysqli_num_rows($sqlNoSo);
		$dataNoSo = mysqli_fetch_array($sqlNoSo); 
		$start = substr($dataNoSo['soNo'],0-5);
		$next = $start + 1;
		$tempNo = strlen($next); 

		if ($numsNoSo == '0') {
		    	$sNo = "00000";
            } elseif ($tempNo == 1) {
                $sNo = "00000";
            } elseif ($tempNo == 2) {
                $sNo = "0000";
            } elseif ($tempNo == 3) {
                $sNo = "000";
            } elseif ($tempNo == 4) {
                $sNo = "00";
            } elseif ($tempNo == 5) {
                $sNo = "0";
            } elseif ($tempNo == 6) {
                $sNo = "";
		}  $soNo = "SO".$sNo.$next;  

if (!empty($_COOKIE['namatoko']) AND !empty($_COOKIE['paymethod']) AND !empty($_COOKIE['tokos'])) {    
		
		$showSo1 = "SELECT * FROM as_sales_order WHERE soFaktur = '$soFaktur'";
		$sqlSo1 = mysqli_query($connect, $showSo1);
		$numsSo = mysqli_num_rows($sqlSo1);
		
		if ($numsSo == 0) { 
			$sName = $_COOKIE['supplierCode']." ".$_COOKIE['supplierName'];
            $createdUserID = $_COOKIE['supplierCode'];
            $needDate = $_COOKIE['supplierID'];
			$querySo = "INSERT INTO as_sales_order(soNo,
													soFaktur,
													customerID,
													customerName,
													customerAddress,
													staffID,
													staffName,
													orderDate,
													needDate,
                                                    factory,
													note,
													status,
													createdDate,
													createdUserID,
													modifiedDate,
													modifiedUserID)
											VALUES(	'$soNo',
													'$soFaktur',
													'$customerID',
													'$customerName',
													'',
													'0',
													'$sName',
													'$orderDate',
													'$needDate',
                                                    'SFA',
													'$note',
													'Validasi',
													'$createdDate',
													'$createdUserID',
													'',
													'')";
        mysqli_query($connect, $querySo); } 
        unset($_COOKIE['tokos']);  
        unset($_COOKIE['namatoko']); 
        unset($_COOKIE['paymethod']);  
        setcookie('tokos', null, -1, '/'); 
        setcookie('namatoko', null, -1, '/'); 
        setcookie('paymethod', null, -1, '/'); 
} else { echo "<script type='text/javascript'>alert('Kamu belum pilih toko atau metode pembayaran !');</script>"; header('Location: ' . $_SERVER['HTTP_REFERER']); } ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SALES | KARYAWAN</title> 
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
		 <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        body {
        text-align: center; 
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
					margin-top: 0 ;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        width: -webkit-fill-available;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    .tombol{
        border: 1px solid green; 
        background: white;
        color: black;
        display: block; 
        padding: 10px;
        text-decoration: none;
        border-radius:5px;  
    }
    </style>
</head>
<body>  
		 <div class="card">
		 <h1 id="status" >Proses !</h1> 
      <div style="border-radius:200px; width:100%; background: #F8FAF5; margin:0 auto;">
        <img src="ajax/waiting-response.gif" width="100%" id="statue"> 
      </div>
       <br />
        <p id="deathnote">Mohon tunggu,<br/> Data sedang diproses!</p>
        <br /><br /><a href="index.php" class="tombol">KEMBALI KE DASHBOARD</a>
      </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var soNo = '<?= $soNo ?>';
    var soFaktur = '<?= $soFaktur ?>';
    
    for (var i = 0; i < sessionStorage.length; i++) {
        var data = JSON.parse(sessionStorage.getItem(sessionStorage.key(i))); 
        $.ajax({
            url: 'ajax/submit_product.php?soNo='+soNo+"&soFaktur="+soFaktur,
            type: "POST",
            data: {
                "productID": data[0],
                "productName": data[1],
                "price": data[2],
                "qty": data[3]
            },
            dataType: "html",
            success: function(data) {
                if (data > 0) {
                    document.getElementById("statue").src="https://media.tenor.com/BSY1qTH8g-oAAAAM/check.gif";
                    document.getElementById("status").innerHTML = "Sukses !";
                    document.getElementById("deathnote").innerHTML = "Transaksi Berhasil<br /> Terima kasih !";
                    sessionStorage.clear();
                } else {
                    document.getElementById("statue").src="ajax/fail.gif";
                    document.getElementById("status").innerHTML = "Gagal !";
                    document.getElementById("deathnote").innerHTML = "Transaksi Gagal <br />Silahkan Coba kembali !";
                    sessionStorage.clear();
                } 
            }
        });
    }
        $.ajax({
            url: 'ajax/bill_of_leading.php?function=<?= $note ?>',
            type: "POST",
            data: {
                "soNo": soNo,
                "soFaktur": soFaktur,
                "diskon": '<?= $_GET['diskon'] ?>',
                "pajak": '<?= $_GET['pajak'] ?>'
            },
            dataType: "json",
            success: function(data) { 
                    console.log(data);
                }  
        });
});  
</script>
</body>
</html>   