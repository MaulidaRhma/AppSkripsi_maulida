<?php
include '../koneksi.php';
$kategori  = $_POST['kategori'];
$anggaran_murni  = $_POST['anggaran_murni'];


mysqli_query($koneksi, "insert into kategori values (NULL,'$kategori','$anggaran_murni','','','')");
header("location:kategori.php");
