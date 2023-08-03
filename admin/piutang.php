<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Piutang
      <small>Data Piutang</small>
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
            <h3 class="box-title">Catatan Piutang</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Piutang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="piutang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Piutang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Nama Pegawai</label>
                        <select name="nama_pegawai" id="cmb_pegawai" class="form-control" onchange="updateNIP()">
                          <option value="">-- Pilih Pegawai --</option>
                          <?php
                          $sql = $koneksi->query("SELECT * FROM karyawan");
                          while ($data = $sql->fetch_assoc()) {
                            echo "<option value='" . $data['nama_pegawai'] . "'>" . $data['nama_pegawai'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" readonly class="form-control">
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
                    <th width="1%">KODE</th>
                    <th width="10%" class="text-center">TANGGAL</th>
                    <th class="text-center">KETERANGAN</th>
                    <th class="text-center">NOMINAL</th>
                    <th class="text-center">NAMA PEGAWAI</th>
                    <th class="text-center">NIP</th>
                    <th width="10%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM piutang");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                      <td><?php echo $d['piutang_keterangan']; ?></td>
                      <td class="text-center"><?php echo "Rp. " . number_format($d['piutang_nominal']) . " ,-"; ?></td>
                      <td><?php echo $d['nama_pegawai']; ?></td>
                      <td><?php echo $d['nip']; ?></td>

                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_piutang_<?php echo $d['piutang_id'] ?>">
                          <i class="fa fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_piutang_<?php echo $d['piutang_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="piutang_update.php" method="post">
                          <div class="modal fade" id="edit_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit piutang</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['piutang_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['piutang_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Nominal</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['piutang_nominal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['piutang_keterangan'] ?></textarea>
                                  </div>

                                  <div class="form-group" style="width:100%">
                                    <label>Nama Pegawai</label>
                                    <select name="nama_pegawai" class="form-control" id="cmb_pegawai1" class="form-control" onchange="update()" readonly style="width:100%" style="width:100%">
                                      <option <?php echo $d['nama_pegawai'] ?>><?php echo $d['nama_pegawai'] ?></option>
                                      <!-- <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM karyawan");
                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                              if ($row['nama_pegawai'] == $d['nama_pegawai']) {
                                                echo "<option value='$row[nama_pegawai]' readonly selected>$row[nama_pegawai]readonly</option>";
                                              } else {
                                                echo "<option value='$row[nama_pegawai]' readonly>$row[nama_pegawai] readonly</option>";
                                              }
                                            }
                                            ?> -->
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%">
                                    <label>NIP</label>
                                    <input type="number" id="nip" name="nip" readonly required="required" class="form-control" placeholder="NIP Pegawai .." value="<?php echo $d['nip']; ?>" style="width:100%">
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
                        <div class="modal fade" id="hapus_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="piutang_hapus.php?id=<?php echo $d['piutang_id'] ?>" class="btn btn-primary">Hapus</a>
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
<?php include 'footer.php'; ?>s
<script>
  function updateNIP() {
    var cmbPegawai = document.getElementById('cmb_pegawai');
    var selectedPegawai = cmbPegawai.options[cmbPegawai.selectedIndex].value;

    // Lakukan AJAX request untuk mendapatkan NIP berdasarkan pegawai yang dipilih
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_nip.php?pegawai=' + selectedPegawai, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          document.getElementById('nip').value = response.nip;
        } else {
          console.error('Terjadi kesalahan saat memperoleh NIP pegawai.');
        }
      }
    };
    xhr.send();
  }
</script>

<script>
  function update() {
    var cmbPegawai1 = document.getElementById('cmb_pegawai1');
    var selectedPegawai = cmbPegawai1.options[cmbPegawai1.selectedIndex].value;

    // Lakukan AJAX request untuk mendapatkan NIP berdasarkan pegawai yang dipilih
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_nip.php?pegawai=' + selectedPegawai, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          document.getElementById('nip').value = response.nip;
        } else {
          console.error('Terjadi kesalahan saat memperoleh NIP pegawai.');
        }
      }
    };
    xhr.send();
  }
</script>