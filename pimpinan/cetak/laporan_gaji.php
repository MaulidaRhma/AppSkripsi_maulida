<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LAPORAN GAJI PEGAWAI</title>

    <link rel="shortcut icon" href="../../assets/dishub1.png">
</head>

<body>

    <table border="0" align="center" width="100%">
        <tr align="center">
            <td width="1px">
                <img width="80px" src="../../assets/dishub1.png">
            </td>
            <td>
                <b>
                    <font size="5">DINAS PERHUBUNGAN TANAH LAUT</font>
                </b> <br>
                <font size="3">Alamat : Jl. A. Syairani, Angsau, Kec. Pelaihari, Kabupaten Tanah Laut,<br> Kalimantan Selatan 70815<br>
                </font>

                <font size="3">Website : <b> https://dishub.tanahlautkab.go.id/ </b><br>
                </font>

            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr size="3px" color="black">
            </td>
        </tr>
    </table>

    <center>
        <h4><b><u>LAPORAN GAJI PEGAWAI</u></b></h4>
    </center>
    <br>

    <div class="table-responsive">
        <table border="1" cellspacing="0" width="100%">
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
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>



    </div>
    <br>
    <br>
    <?php
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_instansi WHERE id_instansi = '1'");
    while ($row = mysqli_fetch_assoc($sql)) {
    ?>
        <div style="width:240px;float:right;">
            Tanah Laut : <?= date('d-m-Y') ?><br>
            <ol></ol>
            <div style="font-weight:bold;text-align:center">
                KEPALA DINAS</br>
                PERHUBUNGAN TANAH LAUT<br />
                <p>&nbsp;</p>
                <br />
                <?php echo $row['kepala']; ?> <br>
                <?php echo $row['nip']; ?></p>
            </div>
        </div>
        </div>
    <?php } ?>




    <script>
        window.print();
        $(document).ready(function() {

        });
    </script>

</body>

</html>