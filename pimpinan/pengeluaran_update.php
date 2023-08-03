<?php
include '../koneksi.php';

$id_pengeluaran = $_POST['id_pengeluaran'];
$status = $_POST['status'];

// Get the current expense details
$query_select = "SELECT kode_kegiatan, pengeluaran FROM pengeluaran WHERE id_pengeluaran = ?";
$stmt_select = mysqli_prepare($koneksi, $query_select);
mysqli_stmt_bind_param($stmt_select, "i", $id_pengeluaran);
mysqli_stmt_execute($stmt_select);
$result_select = mysqli_stmt_get_result($stmt_select);
$row = mysqli_fetch_assoc($result_select);
$current_kode_kegiatan = $row['kode_kegiatan'];
$current_pengeluaran = $row['pengeluaran'];
mysqli_stmt_close($stmt_select);

// Calculate the difference in expenses
$difference = $current_pengeluaran - $pengeluaran;

// Update the expense details
$query_update = "UPDATE pengeluaran SET status = ? WHERE id_pengeluaran = ?";
$stmt_update = mysqli_prepare($koneksi, $query_update);
mysqli_stmt_bind_param($stmt_update, "si", $status, $id_pengeluaran);
$update_result = mysqli_stmt_execute($stmt_update);
mysqli_stmt_close($stmt_update);

if ($update_result) {
    // Update the budget in the corresponding category
    $query_select_kategori = "SELECT anggaran FROM kategori WHERE kode_kegiatan = ?";
    $stmt_select_kategori = mysqli_prepare($koneksi, $query_select_kategori);
    mysqli_stmt_bind_param($stmt_select_kategori, "i", $kode_kegiatan);
    mysqli_stmt_execute($stmt_select_kategori);
    $result_select_kategori = mysqli_stmt_get_result($stmt_select_kategori);
    $row_kategori = mysqli_fetch_assoc($result_select_kategori);
    $current_anggaran = $row_kategori['anggaran'];
    mysqli_stmt_close($stmt_select_kategori);

    $new_anggaran = $current_anggaran + $difference;

    $query_update_kategori = "UPDATE kategori SET anggaran = ? WHERE kode_kegiatan = ?";
    $stmt_update_kategori = mysqli_prepare($koneksi, $query_update_kategori);
    mysqli_stmt_bind_param($stmt_update_kategori, "di", $new_anggaran, $kode_kegiatan);
    $update_kategori_result = mysqli_stmt_execute($stmt_update_kategori);
    mysqli_stmt_close($stmt_update_kategori);

    if ($update_kategori_result) {
        header("Location: pengeluaran.php");
        exit();
    } else {
        echo "Error updating kategori: " . mysqli_error($koneksi);
    }
} else {
    echo "Error updating pengeluaran: " . mysqli_error($koneksi);
}
