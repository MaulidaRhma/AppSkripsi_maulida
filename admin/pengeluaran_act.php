<?php
include '../koneksi.php';

$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$kode_kegiatan = $_POST['kode_kegiatan'];
$akun_belanja = $_POST['akun_belanja'];
$uraian = $_POST['uraian'];
$pengeluaran = $_POST['pengeluaran'];
$jpajak = $_POST['jpajak'];
$pajak1 = $_POST['pajak1'];

// Proses upload berkas
$nama_berkas = $_FILES['berkas']['name'];
$ukuran_berkas = $_FILES['berkas']['size'];
$tmp_berkas = $_FILES['berkas']['tmp_name'];
$lokasi_upload = "berkas/pengeluaran/"; // Ganti dengan lokasi folder upload yang sesuai di server

// Jika berhasil diupload, pindahkan ke lokasi folder upload
if (move_uploaded_file($tmp_berkas, $lokasi_upload . $nama_berkas)) {
    // Lanjutkan dengan proses data lainnya
    $query_insert = "INSERT INTO pengeluaran (tanggal, no_bukti, kode_kegiatan, akun_belanja, uraian, pengeluaran, jpajak, pajak1, berkas,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    $menunggu = "Menunggu";
    mysqli_stmt_bind_param($stmt_insert, "sssssdssss", $tanggal, $no_bukti, $kode_kegiatan, $akun_belanja, $uraian, $pengeluaran, $jpajak, $pajak1, $nama_berkas, $menunggu);
    $insert_result = mysqli_stmt_execute($stmt_insert);

    if ($insert_result) {
        // Update jenis_retribusi saldo
        $query_select = "SELECT anggaran FROM kategori WHERE kode_kegiatan = ?";
        $stmt_select = mysqli_prepare($koneksi, $query_select);
        mysqli_stmt_bind_param($stmt_select, "s", $kode_kegiatan);
        mysqli_stmt_execute($stmt_select);
        $result_select = mysqli_stmt_get_result($stmt_select);
        $row = mysqli_fetch_assoc($result_select);
        $saldo_sekarang = $row['anggaran'];
        mysqli_stmt_close($stmt_select);

        $total_saldo = $saldo_sekarang + $pengeluaran;

        $query_update = "UPDATE kategori SET anggaran = ? WHERE kode_kegiatan = ?";
        $stmt_update = mysqli_prepare($koneksi, $query_update);
        mysqli_stmt_bind_param($stmt_update, "ds", $total_saldo, $kode_kegiatan);
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
} else {
    echo "Error uploading file: " . $_FILES['berkas']['error'];
}
