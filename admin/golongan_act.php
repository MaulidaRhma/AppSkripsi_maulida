<?php
include '../koneksi.php';
$golongan  = $_POST['golongan'];
$gaji_pokok  = $_POST['gaji_pokok'];
$gaji_tunjangan  = $_POST['gaji_tunjangan'];

mysqli_query($koneksi, "insert into golongan values (NULL,'$golongan','$gaji_pokok','$gaji_tunjangan')");
header("location:golongan.php");
