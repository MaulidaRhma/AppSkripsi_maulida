<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">

    <div class="row">

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
            $tanggal = date('Y-m-d');
            $pemasukan = mysqli_query($koneksi, "SELECT sum(jumlah) as total_pemasukan FROM pendapatan WHERE tanggal='$tanggal'");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></h4>
            <p>Pemasukan Hari Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
            $bulan = date('m');
            $pemasukan = mysqli_query($koneksi, "SELECT sum(jumlah) as total_pemasukan FROM pendapatan WHERE  month(tanggal)='$bulan'");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></h4>
            <p>Pemasukan Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
            $tahun = date('Y');
            $pemasukan = mysqli_query($koneksi, "SELECT sum(jumlah) as total_pemasukan FROM pendapatan WHERE year(tanggal)='$tahun'");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></h4>
            <p>Pemasukan Tahun Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
            $pemasukan = mysqli_query($koneksi, "SELECT sum(jumlah) as total_pemasukan FROM pendapatan ");
            $p = mysqli_fetch_assoc($pemasukan);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></h4>
            <p>Seluruh Pemasukan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <!-- BATAS -->
      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <?php
            $tanggal = date('Y-m-d');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(anggaran_murni) as total_pengeluaran FROM kategori ");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>

            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></h4>
            <p>Anggaran Murni</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <?php
            $bulan = date('m');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(target) as target FROM jenis_retribusi");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>

            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['target']) . " ,-" ?></h4>
            <p>Anggaran Pendapatan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>



      <!-- AKHIR BATAS -->

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php
            $tanggal = date('Y-m-d');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(pengeluaran) as total_pengeluaran FROM pengeluaran WHERE  tanggal='$tanggal'");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>

            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></h4>
            <p>Pengeluaran Hari Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php
            $bulan = date('m');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(pengeluaran) as total_pengeluaran FROM pengeluaran WHERE  month(tanggal)='$bulan'");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>

            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></h4>
            <p>Pengeluaran Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php
            $tahun = date('Y');
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(pengeluaran) as total_pengeluaran FROM pengeluaran WHERE year(tanggal)='$tahun'");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>

            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></h4>
            <p>Pengeluaran Tahun Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php
            $pengeluaran = mysqli_query($koneksi, "SELECT sum(pengeluaran) as total_pengeluaran FROM pengeluaran ");
            $p = mysqli_fetch_assoc($pengeluaran);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></h4>
            <p>Seluruh Pengeluaran</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <!-- Left col -->
      <section class="col-lg-6">

        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs pull-right">
            <!-- <li><a href="#tab2" data-toggle="tab">Pemasukan</a></li> -->
            <li class="active"><a href="#tab1" data-toggle="tab">Pendapatan & Pengeluaran</a></li>
            <li class="pull-left header">Grafik</li>
          </ul>

          <div class="tab-content" style="padding: 20px">

            <div class="chart tab-pane active" id="tab1">


              <h4 class="text-center">Grafik Data Pendapatan & Pengeluaran Per <b>Bulan</b></h4>
              <canvas id="grafik1" style="position: relative; height: 300px;"></canvas>

            </div>
            <div class="chart tab-pane" id="tab2" style="position: relative; height: 300px;">

            </div>
          </div>

        </div>

      </section>
      <!-- /.Left col -->


      <section class="col-lg-6">
        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs pull-right">
            <!-- <li><a href="#tab2" data-toggle="tab">Pemasukan</a></li> -->
            <li class="active"><a href="#tab1" data-toggle="tab">Pendapatan & Pengeluaran</a></li>
            <li class="pull-left header">Grafik</li>
          </ul>
          <div class="tab-content" style="padding: 20px">

            <div class="chart tab-pane active" id="tab1">

              <!-- Calendar -->
              <h4 class="text-center">Grafik Data Pendapatan & Pengeluaran Per <b>Tahun</b></h4>
              <canvas id="grafik2" style="position: relative; height: 300px;"></canvas>
            </div>
            <div class="chart tab-pane" id="tab2" style="position: relative; height: 300px;">

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->










  </section>

</div>

















<?php include 'footer.php'; ?>