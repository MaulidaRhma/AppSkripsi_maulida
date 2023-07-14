<?php
include '../koneksi.php';
$id_pegawai = $_POST['id_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$nip = $_POST['nip'];
$tempat = $_POST['tempat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jabatan = $_POST['jabatan'];
$golongan = $_POST['golongan'];
$agama = $_POST['agama'];
$pendidikan = $_POST['pendidikan'];
$telpon = $_POST['telpon'];
$alamat = $_POST['alamat'];


mysqli_query($koneksi, "UPDATE karyawan SET nama_pegawai='$nama_pegawai', nip='$nip', tempat='$tempat', tanggal_lahir='$tanggal_lahir', jabatan='$jabatan',golongan='$golongan',agama='$agama',pendidikan='$pendidikan',telpon='$telpon', alamat='$alamat' WHERE id_pegawai='$id_pegawai'");


header("location:pegawai.php");
