<?php
include '../koneksi.php';
$id_pengeluaran  = $_GET['id_pengeluaran'];

mysqli_query($koneksi, "delete from pengeluaran where id_pengeluaran='$id_pengeluaran'");
header("location:pengeluaran.php");
