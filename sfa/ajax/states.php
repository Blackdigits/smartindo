<?php  
   setcookie('tokos', $_GET['value'], time() + (86400 * 30), "/");
   if(!empty($_GET['text'])) { 
    setcookie('namatoko', $_GET['text'], time() + (86400 * 30), "/");
   } 
?>