<?php
include 'header.php';
$tahunDipilih = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN PENGELUARAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- Tambahkan form untuk filter berdasarkan tahun -->
            <section class="col-lg-12">
                <form method="get" action="">
                    <div class="form-group col-md-2">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control" required="required">
                            <?php
                            // Tampilkan daftar tahun dari tahun saat ini hingga 10 tahun ke depan
                            for ($i = date('Y'); $i <= date('Y') + 10; $i++) {
                                $selected = ($tahunDipilih == $i) ? 'selected="selected"' : '';
                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <br />
                        <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </section>
        </div>

        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Laporan Pengeluaran <?php echo $tahunDipilih; ?></h3>
            </div>
            <div class="box-body">

                <a href="cetak/laporan_pengeluaran.php?tahun=<?php echo $tahunDipilih; ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp CETAK</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
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
                            $total_sisa_anggaran = 0; // variabel untuk menyimpan jumlah total sisa anggaran
                            include '../koneksi.php';
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT p.*, k.* FROM pengeluaran p INNER JOIN kategori k ON p.kode_kegiatan = k.kode_kegiatan WHERE YEAR(p.tanggal) = $tahunDipilih GROUP BY p.kode_kegiatan");



                            while ($d = mysqli_fetch_array($data)) {
                                if ($d['kategori']) {
                                    $total_pemasukan1 = $d['anggaran_murni'] - $d['anggaran'];
                                    $anggaran_murni = $d['anggaran_murni'];
                                    $anggaran = $d['anggaran'];
                                    $realisasi_persen = ($anggaran / $anggaran_murni) * 100;

                                    $sisa_anggaran = $anggaran_murni - $anggaran;
                                    $total_sisa_anggaran += $sisa_anggaran; // menambahkan sisa anggaran ke total
                                }
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['kategori']; ?></td>
                                    <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran_murni']); ?></td>
                                    <td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']); ?></td>
                                    <td class="text-center"><?php echo number_format($realisasi_persen, 2); ?>%</td>
                                    <td class="text-center"><?php echo "Rp. " . number_format($sisa_anggaran); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <th colspan="5" class="text-right">TOTAL</th>
                                <td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_sisa_anggaran); ?></td>
                            </tr>
                        </tbody>

                    </table>



                </div>


            </div>
        </div>
    </section>
</div>
</section>

</div>
<?php include 'footer.php'; ?>