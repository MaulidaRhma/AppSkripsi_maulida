<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LAPORAN PENGELUARAN</title>

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
        <h4><b><u>LAPORAN PENGELUARAN</u></b></h4>
    </center>
    <br>

    <?php
    // if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
    //     $tgl_dari = $_GET['tanggal_dari'];
    //     $tgl_sampai = $_GET['tanggal_sampai'];
    //     $kategori = $_GET['kategori'];
    // 
    ?>

    <!-- <div class="row">
            <div class="col-lg-6">
                <table border="0" cellspacing="0" width="100%" style="text-align: left;">
                    <tr>
                        <th width="25%">DARI TANGGAL</th>
                        <th width="1%">:</th>
                        <td><?php echo date('d-m-Y', strtotime($tgl_dari)); ?></td>
                    </tr>
                    <tr>
                        <th>SAMPAI TANGGAL</th>
                        <th>:</th>
                        <td><?php echo date('d-m-Y', strtotime($tgl_sampai)); ?></td>
                    </tr>
                    <tr>
                        <th>KATEGORI</th>
                        <th>:</th>
                        <td>
                            <?php
                            if ($kategori == "semua") {
                                echo "SEMUA KATEGORI";
                            } else {
                                $k = mysqli_query($koneksi, "select * from kategori where kategori_id='$kategori'");
                                $kk = mysqli_fetch_assoc($k);
                                echo $kk['kategori'];
                            }
                            ?>

                        </td>
                    </tr>
                </table>

            </div>
        </div> -->
    <br>
    <div class="table-responsive">
        <table border="1" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>ANGGARAN</th>
                    <th>REALISASI</th>
                    <th>REALISASI (%)</th>
                    <th>SISA ANGGARAN</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $total_pemasukan1 = 0;
                include '../koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM kategori");
                while ($d = mysqli_fetch_array($data)) {
                    if ($d['kategori']) {
                        $total_pemasukan1 += $d['anggaran'];
                        $anggaran_murni = $d['anggaran_murni'];
                        $anggaran = $d['anggaran'];
                    }
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran_murni']); ?></td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']); ?></td>
                        <td class="text-center"><?php echo $realisasi_persen = ($anggaran / $anggaran_murni) * 100; ?>%</td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']); ?></td>

                    </tr>
                <?php
                }
                ?>
                <tr>
                    <th colspan="5" class="text-right">TOTAL</th>
                    <td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pemasukan1) . " ,-"; ?></td>
                </tr>
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




    <script>
        window.print();
        $(document).ready(function() {

        });
    </script>

</body>

</html>