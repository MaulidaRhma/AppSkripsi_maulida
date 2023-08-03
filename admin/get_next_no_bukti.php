<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_kegiatan = $_POST['kode_kegiatan'];

    // Get the last used nomor bukti for the selected kategori_id
    $query_select = "SELECT no_bukti FROM pengeluaran WHERE kode_kegiatan = ? ORDER BY no_bukti DESC LIMIT 1";
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    mysqli_stmt_bind_param($stmt_select, "i", $kode_kegiatan);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);

    if (mysqli_num_rows($result_select) > 0) {
        // Jika ada hasil dari kueri, ambil nomor bukti terakhir
        $row = mysqli_fetch_assoc($result_select);
        $last_no_bukti = $row['no_bukti'];

        // Generate the next nomor bukti based on the last no_bukti
        $next_no_bukti = generateNextNoBukti($last_no_bukti, $kode_kegiatan);

        echo $next_no_bukti;
    } else {
        // Jika tidak ada hasil dari kueri, berarti ini nomor bukti pertama untuk kategori_id tersebut
        // Anda dapat menentukan nomor bukti awal sesuai dengan kebutuhan
        // Misalnya, jika Anda ingin memulai dengan nomor bukti 001, Anda dapat menggunakan kode berikut:
        $next_no_bukti = "001/" . $kode_kegiatan . "/2023";
        echo $next_no_bukti;
    }
}
function generateNextNoBukti($last_no_bukti, $kode_kegiatan)
{
    // Split the last_no_bukti into parts based on '/'
    $parts = explode('/', $last_no_bukti);

    // Check if the last_no_bukti has all necessary parts (nomor, kegiatan, tahun)
    if (count($parts) === 3) {
        // Extract the numeric part and increment it by 1
        $numeric_part = intval($parts[0]);
        $numeric_part++;

        // Reconstruct the next_no_bukti
        $next_no_bukti = str_pad($numeric_part, 3, '0', STR_PAD_LEFT) . '/' . $kode_kegiatan . '/' . $parts[2];
    } else {
        // Jika belum ada data dengan kode kegiatan yang dipilih, buat nomor bukti awal sebagai 001/kode_kegiatan/tahun
        $next_no_bukti = '001/' . $kode_kegiatan . '/2023';
    }

    return $next_no_bukti;
}

function getKodeKegiatan($kategori_id)
{
    include 'koneksi.php';

    // Query to get the kode_kegiatan from the selected kategori_id
    // Adjust this query based on your database schema
    $query = "SELECT kode_kegiatan FROM kategori WHERE kategori_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $kategori_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $kode_kegiatan);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $kode_kegiatan;
}
