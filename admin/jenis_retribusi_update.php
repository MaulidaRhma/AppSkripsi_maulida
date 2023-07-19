<?php
include '../koneksi.php';
$id_retribusi  = $_POST['id_retribusi'];
$jenis  = $_POST['jenis'];
$kode_rekening  = $_POST['kode_rekening'];
$target  = $_POST['target'];
$saldo  = $_POST['saldo'];

mysqli_query($koneksi, "update jenis_retribusi set jenis='$jenis',kode_rekening='$kode_rekening',target='$target',saldo='$saldo' where id_retribusi='$id_retribusi'");
header("location:jenis_retribusi.php");
