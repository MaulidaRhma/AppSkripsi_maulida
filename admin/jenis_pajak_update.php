<?php
include '../koneksi.php';
$id_pajak  = $_POST['id_pajak'];
$nama_pajak  = $_POST['nama_pajak'];
$pajak  = $_POST['pajak'];
mysqli_query($koneksi, "update jenis_pajak set nama_pajak='$nama_pajak',pajak='$pajak' where id_pajak='$id_pajak'");
header("location:jenis_pajak.php");
