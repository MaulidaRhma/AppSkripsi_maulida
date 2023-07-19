<?php
include("koneksi.php");
$id_retribusi = $_GET['id_retribusi'];

$sql = "SELECT kode_rekening FROM jenis_retribusi WHERE id_retribusi = '$id_retribusi'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $kode_rekening = $row["kode_rekening"];
    $response = array("kode_rekening" => $kode_rekening);
    echo json_encode($response);
} else {
    echo "KOSONG / BELUM ADA";
}

mysqli_close($koneksi);
