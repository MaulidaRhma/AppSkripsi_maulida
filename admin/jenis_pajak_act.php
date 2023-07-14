<?php
include '../koneksi.php';
$nama_pajak  = $_POST['nama_pajak'];

mysqli_query($koneksi, "insert into jenis_pajak values (NULL,'$nama_pajak')");
header("location:jenis_pajak.php");
