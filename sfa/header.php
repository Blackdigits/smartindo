<?php if (empty($_COOKIE['supplierCode']) AND empty($_COOKIE['supplierID'])){ header("location:multi_user"); } $supID = $_COOKIE['supplierID']; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>	MOBILE | SFA</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <style> 
    .password{
        width: -webkit-fill-available;
        padding: 5px 15px;
        border: none;
        border-bottom: 1px solid #ccc;
    }
    </style>
</head>

<body> 
<div class="bloom-mobile-header">
  <div class="toggle-nav">
    <i class="material-icons ico-menu" id="openNavButton">menu</i>
    <i class="material-icons ico-close" id="closeNavButton">close</i>  
  </div>
  <div class="logo">
    <?php if(isset($judul)){echo $judul;}else{echo 'DASHBOARD';} ?>
  </div>
  
  <ol class="nav"> 
    <li class="item">
      <a href="#work">
        Ubah Profile
      </a>
    </li>
    <li class="item">
      <a href="#password">
        Ganti Password
      </a>
    </li>
    <li class="item">
      <a href="cust.php">
        Daftar Toko
      </a>
    </li>
    <li class="item">
      <a href="#contact">
        Daftar Produk
      </a>
    </li>
  </ol>
  
  <div class="search-container">
    <i class="material-icons" onclick="window.location='logout.php'">power_settings_new</i>
  </div>
</div>  
<div id="password" class="overlay">
    <div class="popup">
        <h2>Ganti Password</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">   
            <input type="password" name="password" id="password" placeholder="Masukkan Password Baru" class="password" onchange="alert(this.value)">
        </div>
    </div>
</div>

<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
<script>  
function alert(value){ 
    $.ajax({
        url: 'ajax/password.php',
        type: "POST",
        data: {
            "password": value
        },
        dataType: "json",
        success: function(data) { 
                alert(data);
                location.href = "#";
            }  
    });
   
}
</script>
<script type="text/babel">
  
    const $compactHeader = $('.bloom-mobile-header');

    function openCompactMenu() {
    $compactHeader.addClass('nav-visible');
    }

    function closeCompactMenu() {
    $compactHeader.removeClass('nav-visible');
    }
    
    $('#openNavButton').click(openCompactMenu); 
    $('#closeNavButton').click(closeCompactMenu); 
</script>
<br /><br /><br />