<?php
include '../koneksi.php';
$uraian = $_POST['uraian'];
$billing = $_POST['billing'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$jpajak = $_POST['jpajak'];

mysqli_query($koneksi, "insert into pajak values (NULL,'$uraian','$billing','$tanggal','$jumlah','$jpajak')");
header("location:pajak.php");
