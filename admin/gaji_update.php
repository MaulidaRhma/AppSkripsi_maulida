<?php
include '../koneksi.php';
$id_gaji = $_POST['id_gaji'];
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


mysqli_query($koneksi, "UPDATE gaji set tanggal='$tanggal',nama_pegawai='$nama_pegawai', nip='$nip', jabatan='$jabatan', golongan='$golongan',gaji_pokok='$gaji_pokok',gaji_tunjangan='$gaji_tunjangan',jumlah_bruto='$jumlah_bruto',potongan='$potongan',jumlah_netto='$jumlah_netto' where id_gaji='$id_gaji'") or die(mysqli_error($koneksi));

header("location:gaji.php");
