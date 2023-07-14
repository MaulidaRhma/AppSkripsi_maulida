<?php
include '../koneksi.php';
$id_pajak  = $_POST['id_pajak'];
$nama_pajak  = $_POST['nama_pajak'];

mysqli_query($koneksi, "update jenis_pajak set nama_pajak='$nama_pajak' where id_pajak='$id_pajak'");
header("location:jenis_pajak.php");
