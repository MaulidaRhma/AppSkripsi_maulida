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
                        <table>
                            <form method="get" action="">
                                <select name="filter" id="filter" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="1">Per Tanggal </option>
                                    <option value="2">Per Bulan</option>
                                    <option value="3">Per Tahun</option>
                                </select>
                                <br>
                                <div id="form-tanggal">
                                    <label>Tanggal</label><br>
                                    <input type="date" name="tanggal" class="form-control" />
                                    <br>
                                </div>
                                <div id="form-bulan">
                                    <label>Bulan</label><br>
                                    <select name="bulan" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <br />
                                </div>
                                <div id="form-tahun">
                                    <label>Tahun</label><br>
                                    <select name="tahun" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        $query = "SELECT YEAR(tanggal) AS tahun FROM gaji GROUP BY YEAR(tanggal)"; // Tampilkan tahun sesuai di tabel transaksi
                                        $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
                                        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                                            echo '<option value="' . $data['tahun'] . '">' . $data['tahun'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <br /><br />
                                </div>
                                <button type="submit" class="btn btn-warning ml-2">Tampilkan</button>
                                <a href="laporan_gaji.php" class="btn btn-danger ml-2">Reset Filter</a>
                            </form>
                            <hr />
                            <?php
                            if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
                                $filter = $_GET['filter']; // Ambil data filder yang dipilih user
                                if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                                    $tgl = date('d-m-y', strtotime($_GET['tanggal']));
                                    echo '<b>Gaji Pegawai Tanggal ' . $tgl . '</b><br /><br />';
                                    echo '<a href="cetak/laporan_gaji.php?filter=1&tanggal=' . $_GET['tanggal'] . '" class="btn btn-primary">Cetak PDF</a><br /><br />';
                                    $query = "SELECT * FROM gaji WHERE DATE(tanggal)='" . $_GET['tanggal'] . "'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
                                } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                                    $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                    echo '<b>Gaji Pegawai Bulan ' . $nama_bulan[$_GET['bulan']] . ' ' . $_GET['tahun'] . '</b><br /><br />';
                                    echo '<a href="cetak/laporan_gaji.php?filter=2&bulan=' . $_GET['bulan'] . '&tahun=' . $_GET['tahun'] . '" class="btn btn-primary">Cetak PDF</a><br /><br />';
                                    $query = "SELECT * FROM gaji WHERE MONTH(tanggal)='" . $_GET['bulan'] . "' AND YEAR(tanggal)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
                                } else { // Jika filter nya 3 (per tahun)
                                    echo '<b>Gaji Pegawai Tahun ' . $_GET['tahun'] . '</b><br /><br />';
                                    echo '<a href="cetak/laporan_gaji.php?filter=3&tahun=' . $_GET['tahun'] . '" class="btn btn-primary">Cetak PDF</a><br /><br />';
                                    $query = "SELECT * FROM gaji WHERE YEAR(tanggal)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
                                }
                            } else { // Jika user tidak mengklik tombol tampilkan
                                echo '<b>Semua Gaji Pegawai </b><br /><br />';
                                echo '<a href="cetak/laporan_gaji.php" class="btn btn-primary">Cetak PDF</a><br /><br />';
                                $query = "SELECT * FROM gaji ORDER BY tanggal"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
                            }
                            ?>

                        </table>

                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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
                                        while ($d = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                                            $tgl = date('d-m-Y', strtotime($d['tanggal'])); // Ubah format tanggal jadi dd-mm-yyyy

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
                                    <?php } ?>
                                </tbody>
                            </table>



                        </div>

                    </div>
                </div>
            </section>
        </div>


</div>

<?php include 'footer.php'; ?>