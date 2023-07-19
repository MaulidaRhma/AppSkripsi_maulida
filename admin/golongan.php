<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Golongan
            <small>Data Golongan</small>
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
                        <h3 class="box-title">Data Golongan Pegawai</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Golongan
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="golongan_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Golongan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>Nama Golongan</label>
                                                <input type="text" name="golongan" required="required" class="form-control" placeholder="Nama Golongan ..">
                                            </div>
                                            <div class="form-group">
                                                <label>Gaji Pokok</label>
                                                <input type="number" name="gaji_pokok" required="required" class="form-control" placeholder="Gaji Pokok ..">
                                            </div>
                                            <div class="form-group">
                                                <label>Tunjangan</label>
                                                <input type="number" name="gaji_tunjangan" required="required" class="form-control" placeholder="Nama golongan ..">
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
                                        <th>NAMA GOLONGAN</th>
                                        <th>GAJI POKOK</th>
                                        <th>TUNJANGAN</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM golongan ORDER BY golongan ASC");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['golongan']; ?></td>
                                            <td><?php echo number_format($d['gaji_pokok']); ?></td>
                                            <td><?php echo number_format($d['gaji_tunjangan']); ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_golongan'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_golongan<?php echo $d['id_golongan'] ?>">
                                                        <i class="fa fa-cog"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#golongan_hapus<?php echo $d['id_golongan'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="golongan_update.php" method="post">
                                                    <div class="modal fade" id="edit_golongan<?php echo $d['id_golongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Golongan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Nama golongan</label>
                                                                        <input type="hidden" name="id_golongan" required="required" class="form-control" placeholder="Nama golongan .." value="<?php echo $d['id_golongan']; ?>">

                                                                        <input type="text" name="golongan" required="required" class="form-control" placeholder="Nama golongan .." value="<?php echo $d['golongan']; ?>" style="width:100%">

                                                                    </div>
                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Gaji Pokok</label>
                                                                        <input type="number" name="gaji_pokok" required="required" class="form-control" placeholder="Gaji Pokok .." value="<?php echo $d['gaji_pokok']; ?>" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tunjangan</label>
                                                                        <input type="text" name="gaji_tunjangan" required="required" class="form-control" placeholder="Gaji Tunjangan .." value="<?php echo $d['gaji_tunjangan']; ?>" style="width:100%">
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
                                                <div class="modal fade" id="golongan_hapus<?php echo $d['id_golongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="golongan_hapus.php?id_golongan=<?php echo $d['id_golongan'] ?>" class="btn btn-primary">Hapus</a>
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
<?php include 'footer.php'; ?>.