<?php
include("koneksi.php");
$pegawai = $_GET['pegawai'];

$sql = "SELECT nip FROM karyawan WHERE nama_pegawai = '$pegawai'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nip = $row["nip"];
    $response = array("nip" => $nip);
    echo json_encode($response);
} else {
    echo "KOSONG / BELUM ADA";
}

mysqli_close($koneksi);
