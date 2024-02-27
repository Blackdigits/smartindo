<?php
include "header.php";
session_start();

mysqli_query($connect, "UPDATE as_staffs SET lastLogin = '$_SESSION[lastLogin]' WHERE staffID = '$_SESSION[staffID]'");

session_destroy();

header('Location: index.php?msg=Anda telah keluar [Sign Out] dari aplikasi.');
?>