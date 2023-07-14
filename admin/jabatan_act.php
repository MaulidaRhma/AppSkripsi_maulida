<?php
include '../koneksi.php';
$jabatan  = $_POST['jabatan'];

mysqli_query($koneksi, "insert into jabatan values (NULL,'$jabatan')");
header("location:jabatan.php");
