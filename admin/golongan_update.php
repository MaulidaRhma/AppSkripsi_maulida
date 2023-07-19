<?php
include '../koneksi.php';
$id_golongan  = $_POST['id_golongan'];
$golongan  = $_POST['golongan'];
$gaji_pokok  = $_POST['gaji_pokok'];
$gaji_tunjangan  = $_POST['gaji_tunjangan'];

mysqli_query($koneksi, "update golongan set golongan='$golongan',gaji_pokok='$gaji_pokok', gaji_tunjangan='$gaji_tunjangan' where id_golongan='$id_golongan'");
header("location:golongan.php");
