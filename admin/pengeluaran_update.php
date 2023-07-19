<?php
include '../koneksi.php';

$id_pengeluaran = $_POST['id_pengeluaran'];
$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$kategori_id = $_POST['kategori_id'];
$akun_belanja = $_POST['akun_belanja'];
$uraian = $_POST['uraian'];
$pengeluaran = $_POST['pengeluaran'];
$jpajak = $_POST['jpajak'];
$pajak1 = $_POST['pajak1'];


// Get the current expense details
$query_select = "SELECT kategori_id, pengeluaran FROM pengeluaran WHERE id_pengeluaran = ?";
$stmt_select = mysqli_prepare($koneksi, $query_select);
mysqli_stmt_bind_param($stmt_select, "i", $id_pengeluaran);
mysqli_stmt_execute($stmt_select);
$result_select = mysqli_stmt_get_result($stmt_select);
$row = mysqli_fetch_assoc($result_select);
$current_kategori_id = $row['kategori_id'];
$current_pengeluaran = $row['pengeluaran'];
mysqli_stmt_close($stmt_select);

// Calculate the difference in expenses
$difference = $current_pengeluaran - $pengeluaran;

// Update the expense details
$query_update = "UPDATE pengeluaran SET tanggal = ?, no_bukti = ?, kategori_id = ?, akun_belanja = ?, uraian = ?, pengeluaran = ?, jpajak = ? , pajak1 = ? WHERE id_pengeluaran = ?";
$stmt_update = mysqli_prepare($koneksi, $query_update);
mysqli_stmt_bind_param($stmt_update, "ssisssdii", $tanggal, $no_bukti, $kategori_id, $akun_belanja, $uraian, $pengeluaran, $jpajak, $pajak, $id_pengeluaran);
$update_result = mysqli_stmt_execute($stmt_update);
mysqli_stmt_close($stmt_update);

if ($update_result) {
    // Update the budget in the corresponding category
    $query_select_kategori = "SELECT anggaran FROM kategori WHERE kategori_id = ?";
    $stmt_select_kategori = mysqli_prepare($koneksi, $query_select_kategori);
    mysqli_stmt_bind_param($stmt_select_kategori, "i", $kategori_id);
    mysqli_stmt_execute($stmt_select_kategori);
    $result_select_kategori = mysqli_stmt_get_result($stmt_select_kategori);
    $row_kategori = mysqli_fetch_assoc($result_select_kategori);
    $current_anggaran = $row_kategori['anggaran'];
    mysqli_stmt_close($stmt_select_kategori);

    $new_anggaran = $current_anggaran + $difference;

    $query_update_kategori = "UPDATE kategori SET anggaran = ? WHERE kategori_id = ?";
    $stmt_update_kategori = mysqli_prepare($koneksi, $query_update_kategori);
    mysqli_stmt_bind_param($stmt_update_kategori, "di", $new_anggaran, $kategori_id);
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
