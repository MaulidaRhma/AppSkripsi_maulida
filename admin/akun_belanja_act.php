<?php
include '../koneksi.php';
$kode  = $_POST['kode'];
$nama  = $_POST['nama'];

mysqli_query($koneksi, "insert into akun_belanja values (NULL,'$kode','$nama')");
header("location:akun_belanja.php");
