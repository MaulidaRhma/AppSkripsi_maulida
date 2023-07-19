<?php
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];
$nama_pegawai  = $_POST['nama_pegawai'];
$nip  = $_POST['nip'];

mysqli_query($koneksi, "insert into piutang values (NULL,'$tanggal','$nominal','$keterangan','$nama_pegawai','$nip')") or die(mysqli_error($koneksi));
header("location:piutang.php");
