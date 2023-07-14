<?php
include '../koneksi.php';
$id_jabatan  = $_GET['id_jabatan'];

mysqli_query($koneksi, "delete from jabatan where id_jabatan='$id_jabatan'");
header("location:jabatan.php");
