<?php
include '../koneksi.php';
$nama_pegawai = $_POST['nama_pegawai'];
$nip = $_POST['nip'];
$nik = $_POST['nik'];
$tempat = $_POST['tempat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jabatan = $_POST['jabatan'];
$golongan = $_POST['golongan'];
$agama = $_POST['agama'];
$pendidikan = $_POST['pendidikan'];
$telpon = $_POST['telpon'];
$alamat = $_POST['alamat'];


mysqli_query($koneksi, "insert into karyawan values (NULL,'$nama_pegawai','$nip','$nik','$tempat','$tanggal_lahir','$jabatan','$golongan','$agama','$pendidikan','$telpon','$alamat')");
header("location:pegawai.php");
