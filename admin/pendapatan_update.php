<?php
include '../koneksi.php';

$id_pendapatan = $_POST['id_pendapatan'];
$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$id_retribusi = $_POST['id_retribusi'];
$kode_rekening = $_POST['kode_rekening'];
$uraian = $_POST['uraian'];
$jumlah = $_POST['jumlah'];

// Get the current saldo from jenis_retribusi
$query_select_retribusi = "SELECT saldo FROM jenis_retribusi WHERE id_retribusi = ?";
$stmt_select_retribusi = mysqli_prepare($koneksi, $query_select_retribusi);
mysqli_stmt_bind_param($stmt_select_retribusi, "i", $id_retribusi);
mysqli_stmt_execute($stmt_select_retribusi);
$result_select_retribusi = mysqli_stmt_get_result($stmt_select_retribusi);
$row_retribusi = mysqli_fetch_assoc($result_select_retribusi);
$current_saldo = $row_retribusi['saldo'];
mysqli_stmt_close($stmt_select_retribusi);

// Calculate the difference in saldo
$difference = $jumlah - $_POST['old_jumlah'];
$new_saldo = $current_saldo + $difference;

// Update the pendapatan table
$query_update_pendapatan = "UPDATE pendapatan SET tanggal = ?, no_bukti = ?, id_retribusi = ?, kode_rekening = ?, uraian = ?, jumlah = ? WHERE id_pendapatan = ?";
$stmt_update_pendapatan = mysqli_prepare($koneksi, $query_update_pendapatan);
mysqli_stmt_bind_param($stmt_update_pendapatan, "ssissdi", $tanggal, $no_bukti, $id_retribusi, $kode_rekening, $uraian, $jumlah, $id_pendapatan);
$update_pendapatan_result = mysqli_stmt_execute($stmt_update_pendapatan);
mysqli_stmt_close($stmt_update_pendapatan);

// Update the saldo in jenis_retribusi
$query_update_retribusi = "UPDATE jenis_retribusi SET saldo = ? WHERE id_retribusi = ?";
$stmt_update_retribusi = mysqli_prepare($koneksi, $query_update_retribusi);
mysqli_stmt_bind_param($stmt_update_retribusi, "di", $new_saldo, $id_retribusi);
$update_retribusi_result = mysqli_stmt_execute($stmt_update_retribusi);
mysqli_stmt_close($stmt_update_retribusi);

if ($update_pendapatan_result && $update_retribusi_result) {
    header("Location: pendapatan.php");
    exit();
} else {
    echo "Error updating pendapatan or jenis_retribusi: " . mysqli_error($koneksi);
}
