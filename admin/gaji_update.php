<?php
include '../koneksi.php';
$id_gaji = $_POST['id_gaji'];
$nama_pegawai = $_POST['nama_pegawai'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$golongan = $_POST['golongan'];
$sumberdana = $_POST['sumberdana'];
$gaji_pokok = $_POST['gaji_pokok'];
$tunjangan = $_POST['tunjangan'];


mysqli_query($koneksi, "UPDATE gaji set nama_pegawai='$nama_pegawai', nip='$nip', jabatan='$jabatan', golongan='$golongan',sumberdana='$sumberdana',gaji_pokok='$gaji_pokok',tunjangan='$tunjangan' where id_gaji='$id_gaji'") or die(mysqli_error($koneksi));

header("location:gaji.php");
