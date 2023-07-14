<?php
include '../koneksi.php';
$id_pajak = $_POST['id_pajak'];
$uraian = $_POST['uraian'];
$billing = $_POST['billing'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$jpajak = $_POST['jpajak'];


mysqli_query($koneksi, "UPDATE pajak set uraian='$uraian', billing='$billing', tanggal='$tanggal', jumlah='$jumlah', jpajak='$jpajak' where id_pajak='$id_pajak'");


header("location:pajak.php");
