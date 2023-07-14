<?php
include 'header.php';

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN PEGAWAI
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
                        <h3 class="box-title">Laporan Pegawai</h3>
                    </div>
                    <div class="box-body">

                        <a href="cetak/laporan_pegawai.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>NAMA PEGAWAI</th>
                                        <th>NIP</th>
                                        <th>TEMPAT LAHIR</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>JABATAN</th>
                                        <th>GOLONGAN</th>
                                        <th>AGAMA</th>
                                        <th>PENDIDIKAN TERAKHIR</th>
                                        <th>TELEPON</th>
                                        <th>ALAMAT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM karyawan");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['nama_pegawai']; ?></td>
                                            <td><?php echo $d['nip']; ?></td>
                                            <td><?php echo $d['tempat']; ?></td>
                                            <td><?php echo $d['tanggal_lahir']; ?></td>
                                            <td><?php echo $d['jabatan']; ?></td>
                                            <td><?php echo $d['golongan']; ?></td>
                                            <td><?php echo $d['agama']; ?></td>
                                            <td><?php echo $d['pendidikan']; ?></td>
                                            <td><?php echo $d['telpon']; ?></td>
                                            <td><?php echo $d['alamat']; ?></td>
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