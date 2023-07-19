<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Pegawai
            <small>Data Pegawai</small>
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
                        <h3 class="box-title">Data Pegawai Perhubungan Tanah Laut</h3>
                        <div class="btn-group pull-right">

                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Data Pegawai
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="pegawai_act.php" method="post">
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
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Nama Pegawai</label>
                                                        <input autocomplete="off" type="text" name="nama_pegawai" id="nama_pegawai" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">NIP</label>
                                                        <input autocomplete="off" type="number" name="nip" id="nip" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">NIK</label>
                                                        <input autocomplete="off" type="number" name="nik" id="nik" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Tempat</label>
                                                        <input autocomplete="off" type="text" name="tempat" id="tempat" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Jabatan</label>
                                                        <select name="jabatan" class="form-control" />
                                                        <option value="">-- Pilih Jabatan --</option>
                                                        <?php

                                                        $sql = $koneksi->query("select * from jabatan order by jabatan");
                                                        while ($data = $sql->fetch_assoc()) {
                                                            echo "<option value='$data[jabatan]'>$data[jabatan]</option>";
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Golongan</label>
                                                        <select name="golongan" class="form-control" />
                                                        <option value="">-- Pilih Jabatan --</option>
                                                        <?php

                                                        $sql = $koneksi->query("select * from pangkat order by nama_golongan");
                                                        while ($data = $sql->fetch_assoc()) {
                                                            echo "<option value='$data[nama_golongan]'>$data[nama_golongan]</option>";
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Agama</label>
                                                        <div class="form-group form-float">
                                                            <select name="agama" class="form-control show-tick">
                                                                <option>-- Pilih Agama --</option>
                                                                <option name="agama" value="Islam"> Islam </option>
                                                                <option name="agama" value="Kristen Protestan"> Kristen Protestan </option>
                                                                <option name="agama" value="Kristen Katolik"> Kristen Katolik </option>
                                                                <option name="agama" value="Hindu"> Hindu </option>
                                                                <option name="agama" value="Budha"> Budha </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Pendidikan Terakhir</label>
                                                        <input autocomplete="off" type="text" name="pendidikan" id="pendidikan" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Telpon</label>
                                                        <input autocomplete="off" type="number" name="telpon" id="telpon" required class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Alamat</label>
                                                        <input autocomplete="off" type="text" name="alamat" id="alamat" required class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
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
                                        <th>NIK</th>
                                        <th>TEMPAT LAHIR</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>JABATAN</th>
                                        <th>GOLONGAN</th>
                                        <th>AGAMA</th>
                                        <th>PENDIDIKAN TERAKHIR</th>
                                        <th>TELEPON</th>
                                        <th>ALAMAT</th>
                                        <th width="10%">OPSI</th>
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
                                            <td><?php echo $d['nik']; ?></td>
                                            <td><?php echo $d['tempat']; ?></td>
                                            <td><?php echo $d['tanggal_lahir']; ?></td>
                                            <td><?php echo $d['jabatan']; ?></td>
                                            <td><?php echo $d['golongan']; ?></td>
                                            <td><?php echo $d['agama']; ?></td>
                                            <td><?php echo $d['pendidikan']; ?></td>
                                            <td><?php echo $d['telpon']; ?></td>
                                            <td><?php echo $d['alamat']; ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_pegawai'] != 1) {
                                                ?>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pegawai_edit<?php echo $d['id_pegawai'] ?>">
                                                        <i class="fa fa-cog"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pegawai_hapus<?php echo $d['id_pegawai'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php
                                                }
                                                ?>

                                                <form action="pegawai_update.php" method="post">
                                                    <div class="modal fade" id="pegawai_edit<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pajak</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id_pegawai" value="<?= $d['id_pegawai'] ?>">
                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Nama Pegawai</label>
                                                                        <input type="text" name="nama_pegawai" required="required" class="form-control" placeholder="Nama .." value="<?php echo $d['nama_pegawai']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>NIP</label>
                                                                        <input type="number" name="nip" required="required" class="form-control" placeholder="NO Plat .." value="<?php echo $d['nip']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>NIK</label>
                                                                        <input type="number" name="nik" required="required" class="form-control" placeholder="NIK .." value="<?php echo $d['nik']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tempat Lahir</label>
                                                                        <input type="text" name="tempat" required="required" class="form-control" placeholder="Tanggal .." value="<?php echo $d['tempat']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tanggal Lahir</label>
                                                                        <input type="date" name="tanggal_lahir" required="required" class="form-control" placeholder="Biaya .." value="<?php echo $d['tanggal_lahir']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jabatan</label>
                                                                        <select name="jabatan" class="form-control" style="width:100%">
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
                                                                        <label>Agama</label>
                                                                        <select name="agama" class="form-control show-tick" style="width:100%">
                                                                            <option value="<?= $d['agama'] ?>"><?= $d['agama'] ?></option>
                                                                            <option value="Islam"> Islam </option>
                                                                            <option value="Kristen Protestan"> Kristen Protestan </option>
                                                                            <option value="Kristen Katolik"> Kristen Katolik </option>
                                                                            <option value="Hindu"> Hindu </option>
                                                                            <option value="Budha"> Budha </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Pendidikan Terakhir</label>
                                                                        <input type="text" name="pendidikan" required="required" class="form-control" placeholder="Pendidikan .." value="<?php echo $d['pendidikan']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Nomor Telepon</label>
                                                                        <input type="number" name="telpon" required="required" class="form-control" placeholder="telpon .." value="<?php echo $d['telpon']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Alamat</label>
                                                                        <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat .." value="<?php echo $d['alamat']; ?>" style="width:100%">
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
                                                <div class="modal fade" id="pegawai_hapus<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="pegawai_hapus.php?id_pegawai=<?php echo $d['id_pegawai'] ?>" class="btn btn-primary">Hapus</a>
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