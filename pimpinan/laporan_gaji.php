<?php
include 'header.php';

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN GAJI PEGAWAI
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
                        <h3 class="box-title">Laporan Gaji</h3>
                    </div>
                    <div class="box-body">

                        <a href="cetak/laporan_gaji.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>NAMA PEGAWAI</th>
                                        <th>NIP</th>
                                        <th>JABATAN</th>
                                        <th>GOLONGAN</th>
                                        <th>SUMBERDANA</th>
                                        <th>GAJI POKOK</th>
                                        <th>TUNJANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM gaji");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['nama_pegawai']; ?></td>
                                            <td><?php echo $d['nip']; ?></td>
                                            <td><?php echo $d['jabatan']; ?></td>
                                            <td><?php echo $d['golongan']; ?></td>
                                            <td><?php echo $d['sumberdana']; ?></td>
                                            <td><?php echo number_format($d['gaji_pokok']); ?></td>
                                            <td><?php echo number_format($d['tunjangan']); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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