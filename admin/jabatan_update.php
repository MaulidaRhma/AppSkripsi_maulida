<?php
include '../koneksi.php';
$id_jabatan  = $_POST['id_jabatan'];
$jabatan  = $_POST['jabatan'];

mysqli_query($koneksi, "update jabatan set jabatan='$jabatan' where id_jabatan='$id_jabatan'");
header("location:jabatan.php");
