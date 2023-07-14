<?php
include '../koneksi.php';
$id_gaji  = $_GET['id_gaji'];

mysqli_query($koneksi, "delete from gaji where id_gaji='$id_gaji'");
header("location:gaji.php");
