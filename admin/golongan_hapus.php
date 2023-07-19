<?php
include '../koneksi.php';
$id_golongan  = $_GET['id_golongan'];

mysqli_query($koneksi, "delete from golongan where id_golongan='$id_golongan'");
header("location:golongan.php");
