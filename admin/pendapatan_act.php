<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $no_bukti = $_POST['no_bukti'];
    $id_retribusi = $_POST['id_retribusi'];
    $kode_rekening = $_POST['kode_rekening'];
    $uraian = $_POST['uraian'];
    $jumlah = $_POST['jumlah'];

    $query_insert = "INSERT INTO pendapatan (tanggal, no_bukti, id_retribusi, kode_rekening, uraian, jumlah) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, "ssisss", $tanggal, $no_bukti, $id_retribusi, $kode_rekening, $uraian, $jumlah);
    $insert_result = mysqli_stmt_execute($stmt_insert);

    if ($insert_result) {
        // Update jenis_retribusi saldo
        $query_select = "SELECT saldo FROM jenis_retribusi WHERE id_retribusi = ?";
        $stmt_select = mysqli_prepare($koneksi, $query_select);
        mysqli_stmt_bind_param($stmt_select, "i", $id_retribusi);
        mysqli_stmt_execute($stmt_select);
        $result_select = mysqli_stmt_get_result($stmt_select);
        $row = mysqli_fetch_assoc($result_select);
        $saldo_sekarang = $row['saldo'];
        mysqli_stmt_close($stmt_select);

        $total_saldo = $saldo_sekarang + $jumlah;

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
        echo "Error inserting into pendapatan: " . mysqli_error($koneksi);
    }
}
