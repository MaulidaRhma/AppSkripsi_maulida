<?php
include 'header.php';

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN PIUTANG
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
                        <h3 class="box-title">Laporan Piutang</h3>
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
                            <a href="cetak/laporan_piutang.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="1%">NO</th>
                                            <th width="1%">KODE</th>
                                            <th width="10%" class="text-center">TANGGAL</th>
                                            <th class="text-center">KETERANGAN</th>
                                            <th class="text-center">NOMINAL</th>
                                            <th class="text-center">NAMA PEGAWAI</th>
                                            <th class="text-center">NIP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $no = 1;
                                        if ("semua") {
                                            $data = mysqli_query($koneksi, "SELECT * FROM piutang where date(piutang_tanggal)>='$tgl_dari' and date(piutang_tanggal)<='$tgl_sampai'");
                                        } else {
                                            $data = mysqli_query($koneksi, "SELECT * FROM piutang where date(piutang_tanggal)>='$tgl_dari' and date(piutang_tanggal)<='$tgl_sampai'");
                                        }
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                                                <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                                                <td><?php echo $d['piutang_keterangan']; ?></td>
                                                <td class="text-center"><?php echo "Rp. " . number_format($d['piutang_nominal']) . " ,-"; ?></td>
                                                <td><?php echo $d['nama_pegawai']; ?></td>
                                                <td><?php echo $d['nip']; ?></td>
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