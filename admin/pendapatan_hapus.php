<?php
include '../koneksi.php';
$id_pendapatan  = $_GET['id_pendapatan'];

mysqli_query($koneksi, "delete from pendapatan where id_pendapatan='$id_pendapatan'");
header("location:pendapatan.php");
