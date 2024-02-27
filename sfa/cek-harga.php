<?php
include 'config.php';  
$idproduk = $_GET['idp'];
 
$query ="SELECT unitPrice1,unitPrice2,unitPrice3 FROM `as_products` WHERE productID=$idproduk";      
$result = $connect->query($query); 
$row = mysqli_fetch_array($result);   ?>
<option value="<?= $row['unitPrice1'] ?>"><?= $row['unitPrice1'] ?></option>
<option value="<?= $row['unitPrice2'] ?>"><?= $row['unitPrice2'] ?></option>
<option value="<?= $row['unitPrice3'] ?>"><?= $row['unitPrice3'] ?></option>  