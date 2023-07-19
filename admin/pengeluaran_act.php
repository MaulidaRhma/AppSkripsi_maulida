<?php
include '../koneksi.php';
$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$kategori_id = $_POST['kategori_id'];
$akun_belanja = $_POST['akun_belanja'];
$uraian = $_POST['uraian'];
$pengeluaran = $_POST['pengeluaran'];
$jpajak = $_POST['jpajak'];
$pajak1 = $_POST['pajak1'];

$query_insert = "INSERT INTO pengeluaran (tanggal, no_bukti, kategori_id, akun_belanja, uraian, pengeluaran,jpajak,pajak1) VALUES (?, ?, ?, ?, ?, ?,?,?)";
$stmt_insert = mysqli_prepare($koneksi, $query_insert);
mysqli_stmt_bind_param($stmt_insert, "ssisssdd", $tanggal, $no_bukti, $kategori_id, $akun_belanja, $uraian, $pengeluaran, $jpajak, $pajak1);
$insert_result = mysqli_stmt_execute($stmt_insert);

if ($insert_result) {
    // Update jenis_retribusi saldo
    $query_select = "SELECT anggaran FROM kategori WHERE kategori_id = ?";
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    mysqli_stmt_bind_param($stmt_select, "i", $kategori_id);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $row = mysqli_fetch_assoc($result_select);
    $saldo_sekarang = $row['anggaran'];
    mysqli_stmt_close($stmt_select);

    $total_saldo = $pengeluaran;

    $query_update = "UPDATE kategori SET anggaran = ? WHERE kategori_id = ?";
    $stmt_update = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt_update, "ii", $total_saldo, $kategori_id);
    $update_result = mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);

    if ($update_result) {
        header("Location: pengeluaran.php");
        exit();
    } else {
        echo "Error updating pengeluaran: " . mysqli_error($koneksi);
    }
} else {
    echo "Error inserting into pengeluaran: " . mysqli_error($koneksi);
}
