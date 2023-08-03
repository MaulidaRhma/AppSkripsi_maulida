<?php
include 'koneksi.php';

$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$id_retribusi = $_POST['id_retribusi'];
$kode_rekening = $_POST['kode_rekening'];
$uraian = $_POST['uraian'];
$jumlah = $_POST['jumlah'];

// Proses upload berkas
$nama_berkas = $_FILES['berkas']['name'];
$ukuran_berkas = $_FILES['berkas']['size'];
$tmp_berkas = $_FILES['berkas']['tmp_name'];
$lokasi_upload = "berkas/pemasukan/"; // Ganti dengan lokasi folder upload yang sesuai di server

// Jika berhasil diupload, pindahkan ke lokasi folder upload
if (move_uploaded_file($tmp_berkas, $lokasi_upload . $nama_berkas)) {
    // Lanjutkan dengan proses data lainnya
    $query_insert = "INSERT INTO pendapatan (tanggal, no_bukti, id_retribusi, kode_rekening, uraian, jumlah, berkas, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    $menunggu = "Menunggu";
    mysqli_stmt_bind_param($stmt_insert, "ssisssss", $tanggal, $no_bukti, $id_retribusi, $kode_rekening, $uraian, $jumlah, $nama_berkas, $menunggu);
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
} else {
    echo "Error uploading file: " . $_FILES['berkas']['error'];
}
