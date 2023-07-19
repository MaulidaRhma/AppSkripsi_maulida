<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Pajak Pusat
            <small>Data Pajak Pusat</small>
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
                        <h3 class="box-title">Rekapitulasi Pajak Pusat</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Pajak
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="pajak_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pajak</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="font-weight-bold">Uraian</label>
                                                <input autocomplete="off" type="text" name="uraian" id="uraian" required class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">No. Bukti</label>
                                                <select name="billing" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <?php

                                                    $sql = $koneksi->query("select * from pengeluaran order by no_bukti");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='$data[no_bukti]'>$data[no_bukti]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <label class="font-weight-bold">Tanggal</label>
                                                <input autocomplete="off" type="date" name="tanggal" id="tanggal" required class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Nilai</label>
                                                <input autocomplete="off" type="number" name="jumlah" id="jumlah" required class="form-control" />
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
                                        <th>URAIAN</th>
                                        <th>NO. BUKTI</th>
                                        <th>TANGGAL</th>
                                        <th>NILAI</th>
                                        <th>JENIS PAJAK</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM pajak");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['uraian']; ?></td>
                                            <td><?php echo $d['billing']; ?></td>
                                            <td><?php echo $d['tanggal']; ?></td>
                                            <td><?php echo number_format($d['jumlah']); ?></td>
                                            <td><?php echo $d['jpajak']; ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_pajak'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pajak_edit<?php echo $d['id_pajak'] ?>">
                                                        <i class="fa fa-cog"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pajak_hapus<?php echo $d['id_pajak'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="pajak_update.php" method="post">
                                                    <div class="modal fade" id="pajak_edit<?php echo $d['id_pajak'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pajak</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Uraian</label>
                                                                        <input type="hidden" name="id_pajak" value="<?= $d['id_pajak'] ?>">
                                                                        <input type="text" name="uraian" required="required" class="form-control" placeholder="Uraian .." value="<?php echo $d['uraian']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>No. Bukti</label>
                                                                        <select name="billing" class="form-control" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['no_bukti'] == $d['billing']) {
                                                                                    echo "<option value='$row[no_bukti]' selected>$row[no_bukti]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[no_bukti]'>$row[no_bukti]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tanggal</label>
                                                                        <input type="date" name="tanggal" required="required" class="form-control" placeholder="Tanggal .." value="<?php echo $d['tanggal']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Nilai</label>
                                                                        <input type="number" name="jumlah" required="required" class="form-control" placeholder="Nilai .." value="<?php echo $d['jumlah']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jenis Pajak</label>
                                                                        <select name="jpajak" class="form-control" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_pajak");
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
                                                <div class="modal fade" id="pajak_hapus<?php echo $d['id_pajak'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="pajak_hapus.php?id_pajak=<?php echo $d['id_pajak'] ?>" class="btn btn-primary">Hapus</a>
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