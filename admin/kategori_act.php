<?php
include '../koneksi.php';
$kode_kegiatan  = $_POST['kode_kegiatan'];
$kategori  = $_POST['kategori'];
$anggaran_murni  = $_POST['anggaran_murni'];


mysqli_query($koneksi, "insert into kategori values (NULL,'$kode_kegiatan','$kategori','$anggaran_murni','','','')");
header("location:kategori.php");
