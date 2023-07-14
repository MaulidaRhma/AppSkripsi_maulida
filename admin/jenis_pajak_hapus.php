<?php
include '../koneksi.php';
$id_pajak  = $_GET['id_pajak'];

mysqli_query($koneksi, "delete from jenis_pajak where id_pajak='$id_pajak'");
header("location:jenis_pajak.php");
