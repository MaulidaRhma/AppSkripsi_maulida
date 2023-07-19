<?php
include '../koneksi.php';
$id_akun  = $_POST['id_akun'];
$kode  = $_POST['kode'];
$nama  = $_POST['nama'];

mysqli_query($koneksi, "update akun_belanja set kode='$kode',nama='$nama' where id_akun='$id_akun'");
header("location:akun_belanja.php");
