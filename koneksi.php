<?php
$host = 'localhost';
$db_name = 'db_sayur';
$user = 'root';
$pass = '';

$koneksi = mysqli_connect($host, $user, $pass, $db_name);

if (mysqli_connect_error()) {
    die("Error pada koneksi: " . mysqli_connect_error());
}
