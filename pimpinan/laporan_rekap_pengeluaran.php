<?php
include 'header.php';

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN REKAP PENGELUARAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Filter Laporan</h3>
                    </div>
                    <div class="box-body">
                        <form method="get" action="">
                            <div class="row">
                                <div class="col-md-5">

                                    <div class="form-group">
                                        <label>Mulai Tanggal</label>
                                        <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_dari'])) {
                                                                                            echo $_GET['tanggal_dari'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                                    </div>

                                </div>

                                <div class="col-md-5">

                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_sampai'])) {
                                                                                            echo $_GET['tanggal_sampai'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="form-group">
                                        <br />
                                        <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Rekap Pengeluaran</h3>
                    </div>
                    <div class="box-body">

                        <?php
                        if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
                            $tgl_dari = $_GET['tanggal_dari'];
                            $tgl_sampai = $_GET['tanggal_sampai'];
                        ?>

                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">DARI TANGGAL</th>
                                            <th width="1%">:</th>
                                            <td><?php echo $tgl_dari; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SAMPAI TANGGAL</th>
                                            <th>:</th>
                                            <td><?php echo $tgl_sampai; ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                            <a href="cetak/laporan_rekap_pengeluaran.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="1%">NO</th>
                                            <th>TANGGAL</th>
                                            <th>NO.BUKTI</th>
                                            <th>KEGIATAN</th>
                                            <th>AKUN BELANJA</th>
                                            <th>PENANGGUNG JAWAB</th>
                                            <th>URAIAN</th>
                                            <th>PENGELUARAN</th>
                                            <th>JENIS PAJAK</th>
                                            <th>NILAI</th>
                                            <th>FILE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $no = 1;
                                        if ("semua") {
                                            $data = mysqli_query($koneksi, "SELECT * FROM pengeluaran INNER JOIN kategori ON pengeluaran.kode_kegiatan = kategori.kode_kegiatan where date(tanggal)>='$tgl_dari' and date(tanggal)<='$tgl_sampai'");
                                        } else {
                                            $data = mysqli_query($koneksi, "SELECT * FROM pengeluaran INNER JOIN kategori ON pengeluaran.kode_kegiatan = kategori.kode_kegiatan where date(tanggal)>='$tgl_dari' and date(tanggal)<='$tgl_sampai'");
                                        }
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $d['tanggal']; ?></td>
                                                <td><?php echo $d['no_bukti']; ?></td>
                                                <td><?php echo $d['kategori']; ?></td>
                                                <td><?php echo $d['akun_belanja']; ?></td>
                                                <td><?php echo $d['tanggung_jawab']; ?></td>
                                                <td><?php echo $d['uraian']; ?></td>
                                                <td><?php echo number_format($d['pengeluaran']); ?></td>
                                                <td><?php echo $d['jpajak']; ?></td>
                                                <td><?php echo $d['pajak1']; ?></td>
                                                <td>
                                                    <div id="portfolio">
                                                        <div class="portfolio-item">
                                                            <a href=../admin/berkas/pengeluaran/<?= $d['berkas'] ?> class="portfolio-popup" target="_blank">
                                                                <img src="../admin/berkas/fdp.jpg " width="50">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="btn btn-primary"><?php echo $d['status']; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>



                            </div>

                        <?php
                        } else {
                        ?>

                            <div class="alert alert-info text-center">
                                Silahkan Filter Laporan Terlebih Dulu.
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </section>

</div>
<?php include 'footer.php'; ?>