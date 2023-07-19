<?php include 'header.php'; ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Data Pengeluaran
            <small>Data Pengeluaran</small>
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
                        <h3 class="box-title">Data Pengeluaran Dinas Perhubungan Tanah Laut</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Data Pengeluaran
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="pengeluaran_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal </label>
                                                <input type="date" id="tanggal" name="tanggal" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="no_bukti">No Bukti</label>
                                                <input type="text" id="no_bukti" name="no_bukti" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Kegiatan</label>
                                                <select name="kategori_id" class="form-control">
                                                    <option value="">-- Pilih Kegiatan --</option>
                                                    <?php
                                                    $sql = $koneksi->query("SELECT * FROM kategori");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $data['kategori_id'] . "'>" . $data['kategori'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="akun_belanja">Akun Belanja</label>
                                                <select name="akun_belanja" class="form-control">
                                                    <option value="">-- Pilih Akun Belanja --</option>
                                                    <?php
                                                    $sql = $koneksi->query("SELECT * FROM akun_belanja");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $data['nama'] . "'>" . $data['nama'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="uraian">Uraian</label>
                                                <input type="text" id="uraian" name="uraian" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="pengeluaran">Pengeluaran</label>
                                                <input type="number" id="pengeluaran" name="pengeluaran" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Jenis Pajak</label>
                                                <select name="jpajak" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <?php

                                                    $sql = $koneksi->query("select * from jenis_pajak order by nama_pajak");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='$data[nama_pajak]'>$data[nama_pajak]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="pajak1">Nilai</label>
                                                <input type="number" id="pajak1" name="pajak1" class="form-control">
                                            </div>

                                            <!--<div class="form-group" style="width:100%">
                                                <label>Pajak</label>
                                                <select name="pajak1" class="form-control" style="width:100%">
                                                    <option value="">--Pilih--</option>
                                                    <?php
                                                    $sql = $koneksi->query("SELECT * FROM jenis_pajak");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $data['pajak'] . "'>" . $data['pajak'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div> -->


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>



                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%">NO</th>
                                        <th>TANGGAL</th>
                                        <th>NO.BUKTI</th>
                                        <th>KEGIATAN</th>
                                        <th>AKUN BELANJA</th>
                                        <th>URAIAN</th>
                                        <th>PENGELUARAN</th>
                                        <th>JENIS PAJAK</th>
                                        <th>NILAI</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM pengeluaran INNER JOIN kategori ON pengeluaran.kategori_id = kategori.kategori_id");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['tanggal']; ?></td>
                                            <td><?php echo $d['no_bukti']; ?></td>
                                            <td><?php echo $d['kategori']; ?></td>
                                            <td><?php echo $d['akun_belanja']; ?></td>
                                            <td><?php echo $d['uraian']; ?></td>
                                            <td><?php echo number_format($d['pengeluaran']); ?></td>
                                            <td><?php echo $d['jpajak']; ?></td>
                                            <td><?php echo number_format($d['pajak1']); ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_pengeluaran'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pengeluaran_edit<?php echo $d['id_pengeluaran'] ?>">
                                                        <i class="fa fa-cog"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pengeluaran_hapus<?php echo $d['id_pengeluaran'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="pengeluaran_update.php" method="post">
                                                    <div class="modal fade" id="pengeluaran_edit<?php echo $d['id_pengeluaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tanggal</label>
                                                                        <input type="hidden" name="id_pengeluaran" required="required" class="form-control" placeholder="Nama Pegawai .." value="<?php echo $d['id_pengeluaran']; ?>">

                                                                        <input type="date" name="tanggal" style="width:100%" required="required" class="form-control" placeholder="Tanggal .." value="<?php echo $d['tanggal']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>No. Bukti</label>
                                                                        <input type="text" name="no_bukti" required="required" class="form-control" placeholder="No. Bukti.." value="<?php echo $d['no_bukti']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Kegiatan</label>
                                                                        <select name="kategori_id" class="form-control" style="width:100%" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['kategori_id'] == $d['kategori_id']) {
                                                                                    echo "<option value='$row[kategori_id]' selected>$row[kategori]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="akun_belanja">Akun Belanja</label>
                                                                        <select name="akun_belanja" style="width:100%" class="form-control">
                                                                            <option value="">-- Pilih --</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM akun_belanja");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['nama'] == $d['akun_belanja']) {
                                                                                    echo "<option value='$row[nama]' selected>$row[nama]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[nama]'>$row[nama]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="uraian">Uraian</label>
                                                                        <input type="text" id="uraian" name="uraian" value="<?php echo $d['uraian']; ?>" style="width:100%" class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="pengeluaran">Pengeluaran</label>
                                                                        <input type="number" id="pengeluaran" value="<?php echo $d['pengeluaran']; ?>" name="pengeluaran" style="width:100%" class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jenis Pajak</label>
                                                                        <select name="jpajak" class="form-control" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_pajak order by nama_pajak");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['nama_pajak'] == $d['jpajak']) {
                                                                                    echo "<option value='$row[nama_pajak]' selected>$row[nama_pajak]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[nama_pajak]'>$row[nama_pajak]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="pajak1">Nilai</label>
                                                                        <input type="text" id="pajak1" value="<?php echo $d['pajak1']; ?>" name="pajak1" style="width:100%" class="form-control">
                                                                    </div>

                                                                    <!--<div class="form-group" style="width:100%">
                                                                        <label>Pajak</label>
                                                                        <select name="pajak1" class="form-control" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_pajak");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['id_pajak'] == $d['pajak1']) {
                                                                                    echo "<option value='$row[id_pajak]' selected>$row[pajak]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[id_pajak]'>$row[pajak]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>-->



                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- modal hapus -->
                                                <div class="modal fade" id="pengeluaran_hapus<?php echo $d['id_pengeluaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <p>Yakin ingin menghapus data ini ?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <a href="pengeluaran_hapus.php?id_pengeluaran=<?php echo $d['id_pengeluaran'] ?>" class="btn btn-primary">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
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