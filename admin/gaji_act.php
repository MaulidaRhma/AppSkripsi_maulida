<?php
include '../koneksi.php';
$nama_pegawai = $_POST['nama_pegawai'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$golongan = $_POST['golongan'];
$sumberdana = $_POST['sumberdana'];
$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan = $_POST['tunjangan'];

mysqli_query($koneksi, "insert into gaji values (NULL,'$nama_pegawai','$nip','$jabatan','$golongan','$sumberdana','$gaji_pokok','$tunjangan')");
header("location:gaji.php");
