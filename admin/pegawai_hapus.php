<?php
include '../koneksi.php';
$id_pegawai  = $_GET['id_pegawai'];

mysqli_query($koneksi, "delete from karyawan where id_pegawai='$id_pegawai'");
header("location:pegawai.php");
