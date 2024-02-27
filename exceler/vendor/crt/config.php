<?php

$hostName   = "sql850.main-hosting.eu";
$username   = "u244925661_smartindo_mdn";
$password   = "|g2vMR]C0?ED";
$dbName     = "u244925661_smartindo_mdn";

$connect = mysqli_connect($hostName,$username,$password,$dbName);
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connect -> connect_error;
  exit();
}