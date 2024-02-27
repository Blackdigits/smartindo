<html>
<?php 
    include 'header.php'; 
    include 'config.php';  
    $sid = $_COOKIE['supplierID'];
    $scode = $_COOKIE['supplierCode'];
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        #nav {
            text-align: center;
            word-spacing: 5px;
            margin-top: 10px;
        }
        /* The snackbar - position it at the bottom and in the middle of the screen */
        #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */ 
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 30px; /* 30px from the bottom */
        }

        /* Show the snackbar when clicking on a button (class added with JavaScript) */
        #snackbar.show {
        visibility: visible; /* Show the snackbar */
        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        /* Animations to fade the snackbar in and out */
        @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }
    </style>
<head>
<body style="padding:20px;">
    <p> Hallo, <b><?= $_COOKIE['supplierName'] ?></b>  </p>
    <p style="margin-bottom: 9px;">Penjualan kamu sebanyak, <a href="#" onclick="balancing();" style="float: right;">refresh</a></p> 
    <div> 
        <h3 style="display: inline;" id="balance">Rp<?= number_format($_COOKIE['balance'],2,',','.') ?></h3>
        <a  href="sale.php" class="tambah">+ Tambah</a>
    </div>
    <br />
    <table style="text-align: center;width: 100%;font-size: 12px;"> 
            <tr>
                <td>Toko dikunjungi bulan ini</td>
                <td>Toko belum dikunjungi</td>
                <td>Toko penjualan kamu</td>
            </tr>
            <tr>
                <?php 
                    $arrived = mysqli_query($connect,"SELECT * FROM `as_sales_order` WHERE `needDate` = $sid AND MONTH(orderDate) = MONTH(CURRENT_DATE())  GROUP BY customerID;"); 
                    $cek = mysqli_num_rows($arrived);

                    $arriving = mysqli_query($connect,"SELECT customerName,phone1,phone2 FROM `as_customers` WHERE staffCode = '$scode' AND customerID NOT IN (SELECT customerID FROM `as_sales_order` WHERE MONTH(orderDate) = MONTH(CURRENT_DATE()) AND needDate = $sid GROUP BY customerID);"); 
                    $uncek = mysqli_num_rows($arriving);

                    $arrival = mysqli_query($connect,"SELECT customerName,phone1,phone2 FROM `as_customers` WHERE staffCode = '$scode'"); 
                    $ceklist = mysqli_num_rows($arrival);
                ?>
                <td><a href="#toko" class="circle"><?= $num_padded = sprintf("%02d", $cek); ?></a></td>
                <td><a href="#tokos" class="circle"><?= $num_padded = sprintf("%02d", $uncek); ?></a></td>
                <td><a href="#tokod" class="circle"><?= $num_padded = sprintf("%02d", $ceklist); ?></a></td>
            </tr> 
    </table>
    <!-- <img src="banner.jpg" width="100%"> -->
    <h4>Transaksi Terakhir :</h4>
    
    <table style="border-collapse: collapse;" width="100%" class="table">
        <tr style="font-weight: bold;border-bottom: 1px solid #ccc;text-align: center;background-color:#f2f2f2">
            <td>Tanggal & Waktu</td>
            <td style="text-align: center;">Toko</td>
            <td>Total</td>
        </tr>
        <?php  
        $queryProduct = "SELECT A.*,SUM(B.price*B.qty) as total FROM `as_sales_order` A INNER JOIN as_detail_so B WHERE A.soFaktur = B.soFaktur AND A.factory LIKE 'SFA' AND A.needDate = $sid GROUP by A.soFaktur ORDER BY A.createdDate DESC";
        $sqlProduct = mysqli_query($connect, $queryProduct); 
        while ($dtProduct = mysqli_fetch_array($sqlProduct)) {
        ?>
        <tr>   
            <td style="text-align:center;"><?= $dtProduct['createdDate']; ?></td>
            <td style="text-align:center;"><?= substr($dtProduct['customerName'], 8); ?></td> 
            <td style="text-align:left;">Rp<?= number_format($dtProduct['total'],0,',','.'); ?></td>
        </tr>
        <?php } ?>
        <tr style="border-bottom: 1px solid #ccc;text-align: center;">   
                    <td colspan="3"></td>
        </tr>
    </table>
    <div id="snackbar">Saldo berhasil di Update!</div>
<div id="toko" class="overlay">
    <div class="popup">
        <h2>Daftar Toko</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">   
            <table width="100%" style="border-collapse: collapse;text-align: center;" id="datad">
                <thead>
                    <tr style="border-bottom: 1px solid black;">
                        <td>No</td>
                        <td>Nama Toko</td>
                        <td>Lokasi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $no = 1;
                    while($row = mysqli_fetch_assoc($arrived)) {    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= substr($row['customerName'], 8);?></td>
                        <td><a href="https://maps.google.com/?q=<?= substr($row['customerName'], 8)?> <?= $row['customerAddress'] ?>"><i class="material-icons">map</i></a></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="tokos" class="overlay">
    <div class="popup">
        <h2>Daftar Toko</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">   
            <table width="100%" style="border-collapse: collapse;text-align: center;" id="datas">
                <thead>
                    <tr style="border-bottom: 1px solid black;">
                        <td>No</td>
                        <td>Nama Toko</td>
                        <td>Lokasi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $no = 1;
                    while (($row = mysqli_fetch_assoc($arriving)) && ($no < 100)) {    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['customerName'] ?></td>
                        <td><a href="https://maps.google.com/?q=<?= $row['customerName']?> <?= $row['customerAddress'] ?>"><i class="material-icons">map</i></a></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="tokod" class="overlay">
    <div class="popup">
        <h2>Daftar Toko</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">   
            <table width="100%" style="border-collapse: collapse;text-align: center;" id="data">
                <thead>
                    <tr style="border-bottom: 1px solid black;">
                        <td>No</td>
                        <td>Nama Toko</td>
                        <td>Lokasi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $no = 1;
                    while (($row = mysqli_fetch_assoc($arrival)) && ($no < 100)) {    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['customerName'] ?></td>
                        <td><a href="https://maps.google.com/?q=<?= $row['customerName']?> <?= $row['customerAddress'] ?>"><i class="material-icons">map</i></a></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
<script type="text/javascript">
    const rupiah = (number)=>{
        return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
        }).format(number);
    }
    function setCookie(cName, cValue, expDays) {
        let date = new Date();
        date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
    }

    function snackbar() {  var snackbar = document.getElementById("snackbar");  snackbar.className = "show"; 
    setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);  }

  $(document).ready(function(){
        $('#data').after('<div id="nav"></div>');
        var rowsShown = 10;
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#tokod" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    });

  $(document).ready(function(){
        $('#datas').after('<div id="nav"></div>');
        var rowsShown = 10;
        var rowsTotal = $('#datas tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#tokos" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#datas tbody tr').hide();
        $('#datas tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#datas tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    });

    $(document).ready(function(){
        $('#datad').after('<div id="nav"></div>');
        var rowsShown = 10;
        var rowsTotal = $('#datad tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#toko" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#datad tbody tr').hide();
        $('#datad tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#datad tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    });
    
    function balancing() {
        $.ajax({
            url: 'ajax/bill_of_leading.php?function=rebalancing',
            type: "POST",
            data: {
                "id": <?= $sid ?> 
            },
            dataType: "json",
            success: function(data) { 
                    console.log(data);
                    var balance = rupiah(data.balance)
                    document.getElementById("balance").innerHTML = balance;
                    setCookie('balance', data.balance, 1);
                    snackbar();
                }  
        });
    }
</script>
</body>
</html>