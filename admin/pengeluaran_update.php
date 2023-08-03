<?php
include '../koneksi.php';

$id_pengeluaran = $_POST['id_pengeluaran'];
$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$kode_kegiatan = $_POST['kode_kegiatan'];
$akun_belanja = $_POST['akun_belanja'];
$uraian = $_POST['uraian'];
$pengeluaran = $_POST['pengeluaran'];
$jpajak = $_POST['jpajak'];
$pajak1 = $_POST['pajak1'];

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
$difference = $pengeluaran - $current_pengeluaran;

// Update the expense details
$update_result = mysqli_query($koneksi, "UPDATE pengeluaran SET tanggal='$tanggal', no_bukti='$no_bukti', kode_kegiatan='$kode_kegiatan', akun_belanja='$akun_belanja', uraian='$uraian', pengeluaran='$pengeluaran', jpajak='$jpajak', pajak1='$pajak1' WHERE id_pengeluaran='$id_pengeluaran'");

if ($update_result) {
    // Update the budget in the corresponding category
    $query_select_kategori = "SELECT anggaran FROM kategori WHERE kode_kegiatan = ?";
    $stmt_select_kategori = mysqli_prepare($koneksi, $query_select_kategori);
    mysqli_stmt_bind_param($stmt_select_kategori, "s", $kode_kegiatan);
    mysqli_stmt_execute($stmt_select_kategori);
    $result_select_kategori = mysqli_stmt_get_result($stmt_select_kategori);
    $row_kategori = mysqli_fetch_assoc($result_select_kategori);
    $current_anggaran = $row_kategori['anggaran'];
    mysqli_stmt_close($stmt_select_kategori);

    $new_anggaran = $current_anggaran + $difference;

    // Update the budget in the corresponding category
    $query_update_kategori = "UPDATE kategori SET anggaran = ? WHERE kode_kegiatan = ?";
    $stmt_update_kategori = mysqli_prepare($koneksi, $query_update_kategori);
    mysqli_stmt_bind_param($stmt_update_kategori, "ds", $new_anggaran, $kode_kegiatan);
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
