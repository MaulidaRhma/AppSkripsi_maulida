<?php
include '../koneksi.php';
$id_akun  = $_GET['id_akun'];

mysqli_query($koneksi, "delete from akun_belanja where id_akun='$id_akun'");
header("location:akun_belanja.php");
