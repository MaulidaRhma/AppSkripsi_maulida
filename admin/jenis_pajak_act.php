<?php
include '../koneksi.php';
$nama_pajak  = $_POST['nama_pajak'];
$pajak  = $_POST['pajak'];
mysqli_query($koneksi, "insert into jenis_pajak values (NULL,'$nama_pajak','$pajak')");
header("location:jenis_pajak.php");
