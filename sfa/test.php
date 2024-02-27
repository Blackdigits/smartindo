<script>sessionStorage.setItem("lastname", "Smith");</script>
<?php 

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

$profile = http_request("http://cloudrise.tech/api/smartindo/?function=get_toko");

// ubah string JSON menjadi array 
 
echo "<script>var dataToStore = JSON.stringify(".$profile."); localStorage.setItem('someData', dataToStore);";
echo "function getValue() { return localStorage.getItem('someData');  } console.log(getValue());</script>";
/*
setcookie('theme', 'jagowebdev', strtotime('+7 days'), '/');
var_dump($_COOKIE);
setcookie('theme', '', 0, '/');