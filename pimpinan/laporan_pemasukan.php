<?php
include 'header.php';

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN PENDAPATAN
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
                    <!-- <div class="box-header">
                        <h3 class="box-title">Filter Laporan</h3>
                    </div>
                    <div class="box-body"> -->
                    <form method="get" action="">
                        <div class="row">
                            <!-- <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Mulai Tanggal</label>
                                        <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_dari'])) {
                                                                                            echo $_GET['tanggal_dari'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_sampai'])) {
                                                                                            echo $_GET['tanggal_sampai'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                                    </div>

                                </div> -->

                            <!-- 
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <br />
                                        <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                                    </div>

                                </div> -->
                        </div>
                    </form>
                </div>
        </div>

        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Laporan Pendapatan</h3>
            </div>
            <div class="box-body">
                <a href="cetak/laporan_pemasukan.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">NO</th>
                                <th>JENIS RETRIBUSI</th>
                                <th>KODE REKENING</th>
                                <th>TARGET</th>
                                <th>SALDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_pemasukan = 0;
                            include '../koneksi.php';
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM jenis_retribusi");
                            while ($d = mysqli_fetch_array($data)) {
                                if ($d['jenis']) {
                                    $total_pemasukan += $d['saldo'];
                                }
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['jenis']; ?></td>
                                    <td><?php echo $d['kode_rekening']; ?></td>
                                    <td><?php echo "Rp. " . number_format($d['target']); ?></td>
                                    <td class="text-center"><?php echo "Rp. " . number_format($d['saldo']); ?></td>
                                    <td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <th colspan="4" class="text-right">TOTAL</th>
                                <td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
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