<?php
include '../koneksi.php';
$id  = $_POST['id'];
$kode_kegiatan  = $_POST['kode_kegiatan'];
$kategori  = $_POST['kategori'];
$anggaran  = $_POST['anggaran'];
$anggaran_murni  = $_POST['anggaran_murni'];

mysqli_query($koneksi, "update kategori set kode_kegiatan='$kode_kegiatan',kategori='$kategori',anggaran='$anggaran',anggaran_murni='$anggaran_murni' where kategori_id='$id'");
header("location:kategori.php");
