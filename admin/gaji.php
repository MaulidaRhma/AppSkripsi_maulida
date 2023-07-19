<?php include 'header.php'; ?>
<?php
$gaji_pokok = 0;
$gaji_tunjangan = 0;
$jumlah_bruto = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memproses data yang dikirimkan
    // Anda dapat mengakses data yang dikirimkan melalui $_POST

    // Misalnya, jika Anda menggunakan MySQL dan memiliki tabel golongan dengan kolom gaji_pokok dan gaji_tunjangan
    $golongan = $_POST['golongan'];
    $sql = "SELECT * FROM golongan WHERE golongan = '$golongan'";
    $result = $koneksi->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gaji_pokok = $row['gaji_pokok'];
        $gaji_tunjangan = $row['gaji_tunjangan'];
        $jumlah_bruto = $gaji_pokok + $gaji_tunjangan;
    }
}
?>
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
                                                <label for="gaji_pokok">Tanggal</label>
                                                <input type="date" id="tanggal" name="tanggal" class="form-control">
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

                                            <div class="form-group">
                                                <label class="font-weight-bold">Jabatan</label>
                                                <select name="jabatan" class="form-control">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <?php
                                                    $sql = $koneksi->query("SELECT * FROM jabatan");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $data['jabatan'] . "'>" . $data['jabatan'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="golongan">Golongan</label>
                                                <select name="golongan" id="cmb_golongan" onchange="calculateBruto()" class="form-control">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    <?php
                                                    $sql = $koneksi->query("SELECT * FROM golongan");
                                                    while ($data = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $data['golongan'] . "'>" . $data['golongan'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="gaji_pokok">Gaji Pokok</label>
                                                <input type="text" id="gaji_pokok" name="gaji_pokok" readonly class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="gaji_tunjangan">Tunjangan</label>
                                                <input type="text" id="gaji_tunjangan" name="gaji_tunjangan" readonly class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah_bruto">Jumlah Bruto</label>
                                                <input type="text" id="jumlah_bruto" name="jumlah_bruto" readonly class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah_bruto">Potongan</label>
                                                <input type="number" id="potongan" name="potongan" class="form-control" oninput="calculateNetto()">

                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah_bruto">Jumlah Netto</label>
                                                <input type="text" id="jumlah_netto" name="jumlah_netto" readonly class="form-control">
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
                                                                        <label>Tanggal</label>
                                                                        <input type="date" name="tanggal" required="required" class="form-control" placeholder="Tanggal.." value="<?php echo $d['tanggal']; ?>" style="width:100%">
                                                                    </div>

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
                                                                        <label for="golongan">Golongan</label>
                                                                        <select name="golongan" id="cmb_golongan1" style="width:100%" onchange="calculateBruto1()" class="form-control">
                                                                            <option value="">-- Pilih Golongan --</option>
                                                                            <?php
                                                                            $tampil = mysqli_query($koneksi, "SELECT * FROM golongan");
                                                                            while ($row = mysqli_fetch_assoc($tampil)) {
                                                                                if ($row['golongan'] == $d['golongan']) {
                                                                                    echo "<option value='$row[golongan]' selected>$row[golongan]</option>";
                                                                                } else {
                                                                                    echo "<option value='$row[golongan]'>$row[golongan]</option>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="gaji_pokok">Gaji Pokok</label>
                                                                        <input type="text" id="gaji_pokok1" value="<?php echo $d['gaji_pokok']; ?>" name="gaji_pokok" style="width:100%" readonly class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="gaji_tunjangan">Tunjangan</label>
                                                                        <input type="text" id="gaji_tunjangan1" value="<?php echo $d['gaji_tunjangan']; ?>" name="gaji_tunjangan" style="width:100%" readonly class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="jumlah_bruto">Jumlah Bruto</label>
                                                                        <input type="text" id="jumlah_bruto1" value="<?php echo $d['jumlah_bruto']; ?>" style="width:100%" name="jumlah_bruto" readonly class="form-control">
                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="jumlah_bruto">Potongan</label>
                                                                        <input type="number" id="potongan1" value="<?php echo $d['potongan']; ?>" name="potongan" style="width:100%" class="form-control" oninput="calculateNetto1()">

                                                                    </div>

                                                                    <div class="form-group" style="width:100%">
                                                                        <label for="jumlah_bruto">Jumlah Netto</label>
                                                                        <input type="text" style="width:100%" id="jumlah_netto1" value="<?php echo $d['jumlah_netto']; ?>" name="jumlah_netto" readonly class="form-control">
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
    function calculateNetto() {
        var gaji_pokok = parseInt(document.getElementById('gaji_pokok').value);
        var gaji_tunjangan = parseInt(document.getElementById('gaji_tunjangan').value);
        var jumlah_bruto = gaji_pokok + gaji_tunjangan;
        var potongan = parseInt(document.getElementById('potongan').value);
        var jumlah_netto = jumlah_bruto - potongan;

        document.getElementById('jumlah_bruto').value = jumlah_bruto;
        document.getElementById('jumlah_netto').value = jumlah_netto;
    }

    function calculateBruto() {
        var golongan = document.getElementById('cmb_golongan').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_golongan.php?golongan=' + golongan, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var gaji_pokok = response.gaji_pokok;
                    var gaji_tunjangan = response.gaji_tunjangan;

                    document.getElementById('gaji_pokok').value = gaji_pokok;
                    document.getElementById('gaji_tunjangan').value = gaji_tunjangan;

                    calculateNetto();
                } else {
                    console.error('Terjadi kesalahan saat memperoleh data golongan.');
                }
            }
        };
        xhr.send();
    }
</script>
<script>
    function calculateNetto1() {
        var gaji_pokok = parseInt(document.getElementById('gaji_pokok1').value);
        var gaji_tunjangan = parseInt(document.getElementById('gaji_tunjangan1').value);
        var jumlah_bruto = gaji_pokok + gaji_tunjangan;
        var potongan = parseInt(document.getElementById('potongan1').value);
        var jumlah_netto = jumlah_bruto - potongan;

        document.getElementById('jumlah_bruto1').value = jumlah_bruto;
        document.getElementById('jumlah_netto1').value = jumlah_netto;
    }

    function calculateBruto1() {
        var golongan = document.getElementById('cmb_golongan1').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_golongan.php?golongan=' + golongan, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var gaji_pokok = response.gaji_pokok;
                    var gaji_tunjangan = response.gaji_tunjangan;

                    document.getElementById('gaji_pokok1').value = gaji_pokok;
                    document.getElementById('gaji_tunjangan1').value = gaji_tunjangan;

                    calculateNetto1();
                } else {
                    console.error('Terjadi kesalahan saat memperoleh data golongan.');
                }
            }
        };
        xhr.send();
    }
</script>

<?php include 'footer.php'; ?>