<?php
include '../koneksi.php';
$tanggal = $_POST['tanggal'];
$nama_pegawai = $_POST['nama_pegawai'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$golongan = $_POST['golongan'];
$gaji_pokok = $_POST['gaji_pokok'];
$gaji_tunjangan = $_POST['gaji_tunjangan'];
$jumlah_bruto = $_POST['jumlah_bruto'];
$potongan = $_POST['potongan'];
$jumlah_netto = $_POST['jumlah_netto'];

mysqli_query($koneksi, "insert into gaji values (NULL,'$tanggal','$nama_pegawai','$nip','$jabatan','$golongan','$gaji_pokok','$gaji_tunjangan','$jumlah_bruto','$potongan','$jumlah_netto')");
header("location:gaji.php");
