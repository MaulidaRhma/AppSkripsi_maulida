<?php
include 'koneksi.php';

$id_pendapatan = $_GET['id_pendapatan'];

// Get the amount to be deleted before removing the data
$query_select = "SELECT id_retribusi, jumlah FROM pendapatan WHERE id_pendapatan = ?";
$stmt_select = mysqli_prepare($koneksi, $query_select);
mysqli_stmt_bind_param($stmt_select, "i", $id_pendapatan);
mysqli_stmt_execute($stmt_select);
$result_select = mysqli_stmt_get_result($stmt_select);
$row = mysqli_fetch_assoc($result_select);
$id_retribusi = $row['id_retribusi'];
$jumlah = $row['jumlah'];
mysqli_stmt_close($stmt_select);

// Delete the data from the database
$query_delete = "DELETE FROM pendapatan WHERE id_pendapatan = ?";
$stmt_delete = mysqli_prepare($koneksi, $query_delete);
mysqli_stmt_bind_param($stmt_delete, "i", $id_pendapatan);
$delete_result = mysqli_stmt_execute($stmt_delete);
mysqli_stmt_close($stmt_delete);

if ($delete_result) {
    // Update the jenis_retribusi saldo
    $query_select = "SELECT saldo FROM jenis_retribusi WHERE id_retribusi = ?";
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    mysqli_stmt_bind_param($stmt_select, "i", $id_retribusi);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $row = mysqli_fetch_assoc($result_select);
    $saldo_sekarang = $row['saldo'];
    mysqli_stmt_close($stmt_select);

    $total_saldo = $saldo_sekarang - $jumlah;

    $query_update = "UPDATE jenis_retribusi SET saldo = ? WHERE id_retribusi = ?";
    $stmt_update = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt_update, "ii", $total_saldo, $id_retribusi);
    $update_result = mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    if ($update_result) {
        header("Location: pendapatan.php");
        exit();
    } else {
        echo "Error updating jenis_retribusi: " . mysqli_error($koneksi);
    }
} else {
    echo "Error deleting from pendapatan: " . mysqli_error($koneksi);
}
