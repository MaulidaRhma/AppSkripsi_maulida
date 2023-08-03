<?php
include 'header.php';

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN PENDAPATAN DAN PENGELUARAN
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
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">

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

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required="required">
                
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <br />
                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div> -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Laporan Pendapatan & Pegeluaran</h3>
            </div>
            <div class="box-body">

              <a href="cetak/laporan_print.php" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
              <div class="table-responsive">
                <br>
                <h5>LAPORAN PENDAPATAN</h5>
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
                        <td><?php echo $d['target']; ?></td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['saldo']); ?></td>
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

                <h5>LAPORAN PENGELUARAN</h5>
                <!-- PENGELUARAN -->
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
                    $data = mysqli_query($koneksi, "SELECT * FROM kategori");
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