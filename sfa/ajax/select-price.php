<?php
 include '../config.php';  
 $idp = $_GET['idp']; 
 $query ="SELECT unitPrice1,unitPrice2,unitPrice3 FROM as_products WHERE productID = '$idp';";      
 $result = $connect->query($query); 
 $row = mysqli_fetch_array($result);  ?>

<select id="select-price" placeholder="Pilih Satuan Harga..." name="harga" required>  
    <option value="<?= $row['unitPrice1'] ?>"><?= number_format($row['unitPrice1'], 0, ",", "."); ?></option>
    <option value="<?= $row['unitPrice2'] ?>"><?= number_format($row['unitPrice2'], 0, ",", "."); ?></option>  
    <option value="<?= $row['unitPrice3'] ?>"><?= number_format($row['unitPrice3'], 0, ",", "."); ?></option>  
</select> 