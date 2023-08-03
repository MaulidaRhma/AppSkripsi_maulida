<?php
include '../koneksi.php';

$id_pendapatan = $_POST['id_pendapatan'];
$tanggal = $_POST['tanggal'];
$no_bukti = $_POST['no_bukti'];
$id_retribusi = $_POST['id_retribusi'];
$kode_rekening = $_POST['kode_rekening'];
$uraian = $_POST['uraian'];
$jumlah = $_POST['jumlah'];

// Penanganan unggahan file
$file_upload = $_FILES['berkas']['name'];
$tmp_file = $_FILES['berkas']['tmp_name'];
$upload_dir = 'berkas/pemasukan/'; // Direktori tempat Anda ingin menyimpan file yang diunggah
$target_file = $upload_dir . basename($file_upload);
$upload_ok = true;
$file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Periksa apakah file yang diunggah adalah gambar atau bukan
if (!getimagesize($tmp_file)) {
    echo "Error: Hanya diperbolehkan mengunggah gambar.";
    $upload_ok = false;
}

// Batasi ukuran file yang diunggah (contoh: maksimal 5 MB)
$max_file_size = 5 * 1024 * 1024; // 5 MB
if ($_FILES['berkas']['size'] > $max_file_size) {
    echo "Error: Ukuran file terlalu besar. Maksimal 5 MB.";
    $upload_ok = false;
}

// Batasi jenis file yang diunggah (contoh: hanya diperbolehkan JPG, JPEG, PNG)
$allowed_extensions = array('jpg', 'jpeg', 'png');
if (!in_array($file_extension, $allowed_extensions)) {
    echo "Error: Jenis file tidak diperbolehkan. Hanya diperbolehkan JPG, JPEG, dan PNG.";
    $upload_ok = false;
}

if ($upload_ok) {
    if (move_uploaded_file($tmp_file, $target_file)) {
        // File berhasil diunggah, Anda dapat melakukan sesuatu di sini jika diperlukan.

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
        $query_update_pendapatan = "UPDATE pendapatan SET tanggal = ?, no_bukti = ?, id_retribusi = ?, kode_rekening = ?, uraian = ?, jumlah = ?, berkas = ? WHERE id_pendapatan = ?";
        $stmt_update_pendapatan = mysqli_prepare($koneksi, $query_update_pendapatan);
        mysqli_stmt_bind_param($stmt_update_pendapatan, "ssissdsi", $tanggal, $no_bukti, $id_retribusi, $kode_rekening, $uraian, $jumlah, $file_upload, $id_pendapatan);
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
    } else {
        echo "Error uploading file: " . $_FILES['berkas']['error'];
    }
} else {
    echo "Upload failed. Please check the errors above.";
}
