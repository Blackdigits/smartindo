 <?php 
 include '../includes/connection.php';  
 session_start();
 
$querySales = "SELECT SUM(price * qty) as net_sales FROM `as_detail_so` WHERE DATE(`createdDate`) = CURDATE(); ";
$sqlSales = mysqli_query($connect, $querySales);
$dtSales = mysqli_fetch_array($sqlSales); 

$querySaled = "SELECT SUM(price * qty) as net_sales FROM `as_detail_so` WHERE DATE(`createdDate`) = CURDATE()-1; ";
$sqlSaled = mysqli_query($connect, $querySaled);
$dtSaled = mysqli_fetch_array($sqlSaled);

$querySale = "SELECT SUM(price * qty) as net_sales FROM `as_detail_so` WHERE MONTH(`createdDate`) = MONTH(CURRENT_DATE()); ";
$sqlSale = mysqli_query($connect, $querySale);
$dtSale = mysqli_fetch_array($sqlSale);

$percentChange = (1 - $dtSaled['net_sales'] / $dtSales['net_sales']) * 100;

$queryToko = "SELECT COUNT(customerID) AS CID, orderDate FROM `as_sales_order` WHERE DATE(orderDate) = CURDATE(); ";
$sqlToko = mysqli_query($connect, $queryToko);
$dtToko = mysqli_fetch_array($sqlToko);  

$queryTokod = "SELECT COUNT(customerID) AS CID, orderDate FROM `as_sales_order` WHERE DATE(orderDate) = CURDATE()-1; ";
$sqlTokod = mysqli_query($connect, $queryTokod);
$dtTokod = mysqli_fetch_array($sqlTokod);

$queryTokos = "SELECT COUNT(customerID) AS CID, orderDate FROM `as_sales_order` WHERE MONTH(orderDate) = MONTH(CURRENT_DATE()); ";
$sqlTokos = mysqli_query($connect, $queryTokos);
$dtTokos = mysqli_fetch_array($sqlTokos);

$percentChanges = (1 - $dtTokod['CID'] / $dtToko['CID']) * 100;

$queryPay = "SELECT SUM(total) AS total FROM `as_buy_payments` WHERE `paymentDate` = CURDATE();";
$sqlPay = mysqli_query($connect, $queryPay);
$dtPay = mysqli_fetch_array($sqlPay);

$queryPayed = "SELECT SUM(total) AS total FROM `as_buy_payments` WHERE `paymentDate` = CURDATE()-1;";
$sqlPayed = mysqli_query($connect, $queryPayed);
$dtPayed = mysqli_fetch_array($sqlPayed);

$queryPays = "SELECT SUM(total) AS total FROM `as_buy_payments` WHERE MONTH(paymentDate) =  MONTH(CURRENT_DATE());";
$sqlPays = mysqli_query($connect, $queryPays);
$dtPays = mysqli_fetch_array($sqlPays);

$percentChanged = (1 - $dtPayed['total'] / $dtPay['total']) * 100;
 ?>

<!doctype html>
<html lang="en" style="overflow:hidden">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" >
    <link rel="stylesheet" href="stats.css" > 
  </head>
  <body style="background-color:#f9f9f9;">
     <div class="container pt-5 pb-5"> `
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">Penjualan hari ini</p>
                            <h2>Rp <?= number_format($dtSales['net_sales'],2,',','.');  ?></h2>
                        </div>
                        <?php if($percentChange < 0){  ?>
                            <span class="badge badge-pill badge-cyan badge-red">
                                <i class="fas fa-arrow-down"></i>
                                <span class="font-weight-semibold ml-1"><?= number_format($percentChange, 2);  ?>%</span>
                            </span> 
                        <?php  } else { ?> 
                            <span class="badge badge-pill badge-cyan">
                                <i class="fas fa-arrow-up"></i>
                                <span class="font-weight-semibold ml-1"><?= number_format($percentChange, 2);  ?>%</span>
                            </span> 
                        <?php } ?>
                    </div>
                    <div class="m-t-40">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary badge-dot mr-2"></span>
                                <span class="text-gray font-weight-semibold font-size-13">Total Bulan Ini</span>
                            </div>
                            <span class="text-dark font-weight-semibold font-size-13 mt-2">Rp <?= number_format($dtSale['net_sales'],2,',','.');  ?></span>
                        </div>
                        <div class="progress progress-sm w-100 m-b-0 mt-2">
                            <div class="progress-bar bg-primary" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-muted">Toko Penjualan Hari ini</p>
                            <h2><?= $dtToko['CID'] ?> Toko</h2>
                        </div>
                        <?php if($percentChanges < 0){  ?>
                            <span class="badge badge-pill badge-cyan badge-red">
                                <i class="fas fa-arrow-down"></i>
                                <span class="font-weight-semibold ml-1"><?= number_format($percentChanges, 2);  ?>%</span>
                            </span> 
                        <?php  } else { ?> 
                            <span class="badge badge-pill badge-cyan">
                                <i class="fas fa-arrow-up"></i>
                                <span class="font-weight-semibold ml-1"><?= number_format($percentChanges, 2);  ?>%</span>
                            </span> 
                        <?php } ?>
                        
                    </div>
                    <div class="m-t-40">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary badge-dot mr-2"></span>
                                <span class="text-gray font-weight-semibold font-size-13">Total bulan ini</span>
                            </div>
                            <span class="text-dark font-weight-semibold font-size-13 mt-2"><?= $dtTokos['CID'] ?> Toko</span>
                        </div>
                        <div class="progress progress-sm w-100 m-b-0 mt-2">
                            <div class="progress-bar bg-primary" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-muted">Setoran SFA hari ini</p>
                                <h2>Rp <?= number_format($dtPay['total'],2,',','.');  ?></h2>
                            </div>
                            <?php if($percentChanged < 0){  ?>
                                <span class="badge badge-pill badge-cyan badge-red">
                                    <i class="fas fa-arrow-down"></i>
                                    <span class="font-weight-semibold ml-1"><?= number_format($percentChanged, 2);  ?>%</span>
                                </span> 
                            <?php  } else { ?> 
                                <span class="badge badge-pill badge-cyan">
                                    <i class="fas fa-arrow-up"></i>
                                    <span class="font-weight-semibold ml-1"><?= number_format($percentChanged, 2);  ?>%</span>
                                </span> 
                            <?php } ?>
                        </div>
                        <div class="m-t-40">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-primary badge-dot mr-2"></span>
                                    <span class="text-gray font-weight-semibold font-size-13">Total Bulan ini</span>
                                </div>
                                <span class="text-dark font-weight-semibold font-size-13 mt-2">Rp <?= number_format($dtPays['total'],2,',','.');  ?></span>
                            </div>
                            <div class="progress progress-sm w-100 m-b-0 mt-2">
                                <div class="progress-bar bg-primary" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>