<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LAPORAN GAJI PEGAWAI</title>

    <link rel="shortcut icon" href="../../assets/dishub1.png">
</head>

<body>

    <table border="0" align="center" width="100%">
        <tr align="center">
            <td width="1px">
                <img width="80px" src="../../assets/dishub1.png">
            </td>
            <td>
                <b>
                    <font size="5">DINAS PERHUBUNGAN TANAH LAUT</font>
                </b> <br>
                <font size="3">Alamat : Jl. A. Syairani, Angsau, Kec. Pelaihari, Kabupaten Tanah Laut,<br> Kalimantan Selatan 70815<br>
                </font>

                <font size="3">Website : <b> https://dishub.tanahlautkab.go.id/ </b><br>
                </font>

            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr size="3px" color="black">
            </td>
        </tr>
    </table>

    <center>
        <h4><b><u>LAPORAN GAJI PEGAWAI</u></b></h4>
    </center>
    <br>
    <?php
    // Load file koneksi.php
    include '../koneksi.php';
    if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user
        if ($filter == '1') { // Jika filter nya 1 (per tanggal)
            $tgl = date('d-m-y', strtotime($_GET['tanggal']));

            $query = "SELECT * FROM gaji WHERE DATE(tanggal)='" . $_GET['tanggal'] . "'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
        } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
            $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

            $query = "SELECT * FROM gaji WHERE MONTH(tanggal)='" . $_GET['bulan'] . "' AND YEAR(tanggal)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
        } else { // Jika filter nya 3 (per tahun)

            $query = "SELECT * FROM gaji WHERE YEAR(tanggal)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
        }
    } else { // Jika user tidak mengklik tombol tampilkan

        $query = "SELECT * FROM gaji ORDER BY tanggal"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    }
    ?>
    <div class="table-responsive">
        <table border="1" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="1%">NO</th>
                    <th>TANGGAL</th>
                    <th>NAMA PEGAWAI</th>
                    <th>NIP</th>
                    <th>JABATAN</th>
                    <th>GOLONGAN</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th>JUMLAH BRUTO</th>
                    <th>POTONGAN</th>
                    <th>JUMLAH NETTO</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
                $d = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                if ($d > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                    while ($d = mysqli_fetch_array($sql)) {
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['tanggal']; ?></td>
                            <td><?php echo $d['nama_pegawai']; ?></td>
                            <td><?php echo $d['nip']; ?></td>
                            <td><?php echo $d['jabatan']; ?></td>
                            <td><?php echo $d['golongan']; ?></td>
                            <td><?php echo number_format($d['gaji_pokok']); ?></td>
                            <td><?php echo number_format($d['gaji_tunjangan']); ?></td>
                            <td><?php echo number_format($d['jumlah_bruto']); ?></td>
                            <td><?php echo number_format($d['potongan']); ?></td>
                            <td><?php echo number_format($d['jumlah_netto']); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>



    </div>
    <br>
    <br>
    <?php
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_instansi WHERE id_instansi = '1'");
                    while ($row = mysqli_fetch_assoc($sql)) {
    ?>
        <div style="width:240px;float:right;">
            Tanah Laut : <?= date('d-m-Y') ?><br>
            <ol></ol>
            <div style="font-weight:bold;text-align:center">
                KEPALA DINAS</br>
                PERHUBUNGAN TANAH LAUT<br />
                <p>&nbsp;</p>
                <br />
                <?php echo $row['kepala']; ?> <br>
                <?php echo $row['nip']; ?></p>
            </div>
        </div>
        </div>
    <?php } ?>
<?php
                }
?>



<script>
    window.print();
    $(document).ready(function() {

    });
</script>

</body>

</html>