<?php include 'header.php'; ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Data Pendapatan
            <small>Data Pendapatan</small>
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
                        <h3 class="box-title">Data Pendapatan Dinas Perhubungan Tanah Laut</h3>
                        <div class="btn-group pull-right">
                            <!-- 
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> &nbsp Tambah Data Pendapatan -->
                            </button>
                        </div>
                    </div>
                    <div class="box-body">

                        <!-- Modal -->
                        <form action="pendapatan_act.php" method="POST" enctype="multipart/form-data">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pendapatan</h5>
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
                                                <label class="font-weight-bold">Jenis Retribusi</label>
                                                <select name="id_retribusi" id="cmb_jenis" class="form-control" onchange="updateJenis()">
                                                    <option value="">- Pilih -</option>
                                                    <?php
                                                    $kategori = mysqli_query($koneksi, "SELECT * FROM jenis_retribusi");
                                                    while ($k = mysqli_fetch_array($kategori)) {
                                                    ?>
                                                        <option value="<?php echo $k['id_retribusi']; ?>"><?php echo $k['jenis']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kode_rekening">Kode Rekening</label>
                                                <input type="text" id="kode_rekening" name="kode_rekening" readonly class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="uraian">Uraian</label>
                                                <input type="text" id="uraian" name="uraian" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" id="jumlah" name="jumlah" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="berkas">File</label>
                                                <input type="file" id="berkas" name="berkas" class="form-control">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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
                                        <th>JENIS RETRIBUSI</th>
                                        <th>KODE REKENING</th>
                                        <th>URAIAN</th>
                                        <th>JUMLAH</th>
                                        <th>FILE</th>
                                        <th>STATUS</th>
                                        <!-- <th width="10%">OPSI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM pendapatan INNER JOIN jenis_retribusi ON pendapatan.id_retribusi = jenis_retribusi.id_retribusi");
                                    while ($d = mysqli_fetch_array($data)) {
                                        // Tampilkan data sesuai kebutuhan
                                    ?>

                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['tanggal']; ?></td>
                                            <td><?php echo $d['no_bukti']; ?></td>
                                            <td><?php echo $d['jenis']; ?></td>
                                            <td><?php echo $d['kode_rekening']; ?></td>
                                            <td><?php echo $d['uraian']; ?></td>
                                            <td><?php echo number_format($d['jumlah']); ?></td>
                                            <td>
                                                <div id="portfolio">
                                                    <div class="portfolio-item">
                                                        <a href=../admin/berkas/pemasukan/<?= $d['berkas'] ?> class="portfolio-popup" target="_blank">
                                                            <img src="../admin/berkas/fdp.jpg " width="50">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="btn btn-primary"><?php echo $d['status']; ?></td>
                                            <td>
                                                <?php
                                                if ($d['id_pendapatan'] != 1) {
                                                ?>
                                                    <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pendapatan_edit<?php echo $d['id_pendapatan'] ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#pendapatan_hapus<?php echo $d['id_pendapatan'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button> -->
                                                <?php
                                                }
                                                ?>

                                                <form action="pendapatan_update.php" method="post">
                                                    <div class="modal fade" id="pendapatan_edit<?php echo $d['id_pendapatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit pendapatan </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Tanggal</label>
                                                                        <input type="hidden" name="id_pendapatan" required="required" class="form-control" placeholder="Nama Pegawai .." value="<?php echo $d['id_pendapatan']; ?>">

                                                                        <input type="date" name="tanggal" style="width:100%" required="required" class="form-control" placeholder="Tanggal .." value="<?php echo $d['tanggal']; ?>">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>No. Bukti</label>
                                                                        <input type="text" name="no_bukti" required="required" class="form-control" placeholder="No. Bukti.." value="<?php echo $d['no_bukti']; ?>" style="width:100%">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label>Jenis Retribusi</label>
                                                                        <select name="id_retribusi" class="form-control" style="width:100%" style="width:100%">
                                                                            <option value="">--Pilih--</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_retribusi");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['id_retribusi'] == $d['id_retribusi']) {
                                                                                    echo "<option value='$row[id_retribusi]' selected>$row[jenis]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[id_retribusi]'>$row[jenis]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="kode_rekening">Kode Rekening</label>
                                                                        <input type="text" id="uraian" name="kode_rekening" readonly value="<?php echo $d['kode_rekening']; ?>" style="width:100%" class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="uraian">Uraian</label>
                                                                        <input type="text" id="uraian" name="uraian" value="<?php echo $d['uraian']; ?>" style="width:100%" class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="jumlah">Jumlah</label>
                                                                        <input type="number" id="jumlah" value="<?php echo $d['jumlah']; ?>" name="jumlah" style="width:100%" class="form-control">
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
                                                <div class="modal fade" id="pendapatan_hapus<?php echo $d['id_pendapatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <a href="pendapatan_hapus.php?id_pendapatan=<?php echo $d['id_pendapatan'] ?>" class="btn btn-primary">Hapus</a>
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

<script>
    function updateJenis() {
        var cmbJenis = document.getElementById('cmb_jenis');
        var selectedJenis = cmbJenis.options[cmbJenis.selectedIndex].value;

        // Lakukan AJAX request untuk mendapatkan Kode Rekening berdasarkan jenis retribusi yang dipilih
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_kode.php?id_retribusi=' + selectedJenis, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('kode_rekening').value = response.kode_rekening;
                } else {
                    console.error('Terjadi kesalahan saat memperoleh Kode Rekening.');
                }
            }
        };
        xhr.send();
    }
</script>

<?php include 'footer.php'; ?>