<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Jenis Pajak
            <small>Data Jenis Pajak</small>
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
                        <h3 class="box-title">Data Jenis Pajak</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Jenis Pajak
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="jenis_pajak_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pajak</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>Jenis Pajak</label>
                                                <input type="text" name="nama_pajak" required="required" class="form-control" placeholder="Jenis Pajak ..">
                                            </div>

                                            <div class="form-group">
                                                <label>Pajak</label>
                                                <input type="text" name="pajak" required="required" class="form-control" placeholder="Pajak ..">
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
                                        <th>JENIS PAJAK</th>
                                        <th>PAJAK (%)</th>
                                        <th width="10%">OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM jenis_pajak ORDER BY nama_pajak ASC");
                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['nama_pajak']; ?></td>
                                            <td><?php echo $d['pajak']; ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_pajak'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pajak<?php echo $d['id_pajak'] ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#jenis_pajak_hapus<?php echo $d['id_pajak'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="jenis_pajak_update.php" method="post">
                                                    <div class="modal fade" id="edit_pajak<?php echo $d['id_pajak'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <label>Jenis Pajak</label>
                                                                        <input type="hidden" name="id_pajak" required="required" class="form-control" placeholder="Jenis Pajak .." value="<?php echo $d['id_pajak']; ?>">

                                                                        <input type="text" name="nama_pajak" required="required" class="form-control" placeholder="Jenis Pajak .." value="<?php echo $d['nama_pajak']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jenis Pajak</label>
                                                                        <input type="text" name="pajak" required="required" class="form-control" placeholder="Pajak .." value="<?php echo $d['pajak']; ?>" style="width:100%">
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
                                                <div class="modal fade" id="jenis_pajak_hapus<?php echo $d['id_pajak'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="jenis_pajak_hapus.php?id_pajak=<?php echo $d['id_pajak'] ?>" class="btn btn-primary">Hapus</a>
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