<?php
include '../koneksi.php';
$jenis  = $_POST['jenis'];
$kode_rekening  = $_POST['kode_rekening'];
$target  = $_POST['target'];

mysqli_query($koneksi, "insert into jenis_retribusi values (NULL,'$jenis','$kode_rekening','$target','')");
header("location:jenis_retribusi.php");
