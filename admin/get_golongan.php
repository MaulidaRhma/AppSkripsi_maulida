<?php
include("koneksi.php");
$kode_bar = $_GET['golongan'];

$sql = "SELECT * FROM golongan WHERE golongan = '$kode_bar'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $gaji_pokok = $row["gaji_pokok"];
    $gaji_tunjangan = $row["gaji_tunjangan"];
    $response = array("gaji_pokok" => $gaji_pokok, "gaji_tunjangan" => $gaji_tunjangan);
    echo json_encode($response);
} else {
    echo "KOSONG / BELUM ADA";
}

mysqli_close($koneksi);
