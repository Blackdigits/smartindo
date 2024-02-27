<?php
session_start();
if( isset($_POST['supplierName']) ) {
    // save values from other page to session
    $_SESSION['bbm_spbm'] = $_POST['supplierName'];

}
?>