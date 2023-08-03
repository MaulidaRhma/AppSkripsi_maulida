<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "db_maulida";

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
