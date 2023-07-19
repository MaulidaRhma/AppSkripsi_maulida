<?php
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];
$nama_pegawai  = $_POST['nama_pegawai'];
$nip  = $_POST['nip'];

mysqli_query($koneksi, "update piutang set piutang_tanggal='$tanggal', piutang_nominal='$nominal', piutang_keterangan='$keterangan', nama_pegawai='$nama_pegawai', nip='$nip' where piutang_id='$id'") or die(mysqli_error($koneksi));
header("location:piutang.php");
