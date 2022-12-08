<?php
$hostname = "localhost";
$database = "tokoapi";
$username = "root";
$password = "";
$connect = mysqli_connect($hostname, $username, $password, $database);
// script cek koneksi s  
if (!$connect) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}