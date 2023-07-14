<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Gaji
            <small>Data Gaji Pegawai</small>
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
                        <h3 class="box-title">Gaji Pegawai Dinas Perhubungan Tanah Laut</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Gaji Pegawai
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="gaji_act.php" method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Gaji Pegawai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="font-weight-bold">Nama Pegawai</label>
                                                <select name="nama_pegawai" class="form-control" />
                                                <option value="">-- Pilih Pegawai --</option>
                                                <?php
                                                $sql = $koneksi->query("select * from karyawan ");
                                                while ($data = $sql->fetch_assoc()) {
                                                    echo "<option value='$data[nama_pegawai]'>$data[nama_pegawai]</option>";
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">NIP</label>
                                                <input autocomplete="off" type="number" name="nip" id="nip" required class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Jabatan</label>
                                                <select name="jabatan" class="form-control" />
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $sql = $koneksi->query("select * from jabatan");
                                                while ($data = $sql->fetch_assoc()) {
                                                    echo "<option value='$data[jabatan]'>$data[jabatan]</option>";
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Golongan</label>
                                                <select name="golongan" class="form-control" />
                                                <option value="">-- Pilih Golongan --</option>
                                                <?php
                                                $sql = $koneksi->query("select * from pangkat");
                                                while ($data = $sql->fetch_assoc()) {
                                                    echo "<option value='$data[nama_golongan]'>$data[nama_golongan]</option>";
                                                }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Sumberdana</label>
                                                <input type="text" name="sumberdana" class="form-control" id="sumberdana">
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Gaji Pokok (Rp.)</label>
                                                <input autocomplete="off" type="text" name="gaji_pokok" id="gaji_pokok" required class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Tunjangan (Rp.)</label>
                                                <input autocomplete="off" type="text" name="tunjangan" id="tunjangan" required class="form-control" />
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
                                        <th>NAMA PEGAWAI</th>
                                        <th>NIP</th>
                                        <th>JABATAN</th>
                                        <th>GOLONGAN</th>
                                        <th>SUMBERDANA</th>
                                        <th>GAJI POKOK</th>
                                        <th>TUNJANGAN</th>
                                        <th width="10%">OPSI</th>
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
                                            <td>
                                                <?php
                                                if ($d['id_gaji'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#gaji_edit<?php echo $d['id_gaji'] ?>">
                                                        <i class="fa fa-cog"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#gaji_hapus<?php echo $d['id_gaji'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="gaji_update.php" method="post">
                                                    <div class="modal fade" id="gaji_edit<?php echo $d['id_gaji'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Gaji Pegawai</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Nama Pegawai</label>
                                                                        <input type="hidden" name="id_gaji" required="required" class="form-control" placeholder="Nama Pegawai .." value="<?php echo $d['id_gaji']; ?>">

                                                                        <select name="nama_pegawai" class="form-control" style="width:100%" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM karyawan");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['nama_pegawai'] == $d['nama_pegawai']) {
                                                                                    echo "<option value='$row[nama_pegawai]' selected>$row[nama_pegawai]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[nama_pegawai]'>$row[nama_pegawai]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>NIP</label>
                                                                        <input type="number" name="nip" required="required" class="form-control" placeholder="NIP Pegawai .." value="<?php echo $d['nip']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jabatan</label>
                                                                        <select name="jabatan" class="form-control" style="width:100%" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM jabatan");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['jabatan'] == $d['jabatan']) {
                                                                                    echo "<option value='$row[jabatan]' selected>$row[jabatan]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[jabatan]'>$row[jabatan]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Golongan</label>
                                                                        <select name="golongan" class="form-control" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM pangkat");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['nama_golongan'] == $d['golongan']) {
                                                                                    echo "<option value='$row[nama_golongan]' selected>$row[nama_golongan]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[nama_golongan]'>$row[nama_golongan]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Sumberdana</label>
                                                                        <input type="text" name="sumberdana" required="required" class="form-control" placeholder="Sumberdana .." value="<?php echo $d['sumberdana']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Gaji Pokok</label>
                                                                        <input type="number" name="gaji_pokok" required="required" class="form-control" placeholder="Gaji Pokok .." value="<?php echo $d['gaji_pokok']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tunjangan</label>
                                                                        <input type="number" name="tunjangan" required="required" class="form-control" placeholder="Tunjangan .." value="<?php echo $d['tunjangan']; ?>" style="width:100%">
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
                                                <div class="modal fade" id="gaji_hapus<?php echo $d['id_gaji'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="gaji_hapus.php?id_gaji=<?php echo $d['id_gaji'] ?>" class="btn btn-primary">Hapus</a>
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