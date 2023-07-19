<?php
include '../koneksi.php';
$id_retribusi  = $_GET['id_retribusi'];

mysqli_query($koneksi, "delete from jenis_retribusi where id_retribusi='$id_retribusi'");
header("location:jenis_retribusi.php");
