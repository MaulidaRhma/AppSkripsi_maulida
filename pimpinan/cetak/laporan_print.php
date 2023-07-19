 <!DOCTYPE html>
 <html>

 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>LAPORAN PEMASUKAN DAN PENGELUARAN</title>

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
 		<h4><b><u>LAPORAN PENDAPATAN DAN PENGELUARAN</u></b></h4>
 	</center>

 	<div class="table-responsive">
 		<br>
 		<h5>LAPORAN PENDAPATAN</h5>
 		<table border="1" cellspacing="0" width="100%">
 			<thead>
 				<tr>
 					<th width="1%">NO</th>
 					<th>JENIS RETRIBUSI</th>
 					<th>KODE REKENING</th>
 					<th>TARGET</th>
 					<th>SALDO</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php
					$total_pemasukan = 0;
					include '../koneksi.php';
					$no = 1;
					$data = mysqli_query($koneksi, "SELECT * FROM jenis_retribusi");
					while ($d = mysqli_fetch_array($data)) {
						if ($d['jenis']) {
							$total_pemasukan += $d['saldo'];
						}
					?>
 					<tr>
 						<td><?php echo $no++; ?></td>
 						<td><?php echo $d['jenis']; ?></td>
 						<td><?php echo $d['kode_rekening']; ?></td>
 						<td><?php echo $d['target']; ?></td>
 						<td class="text-center"><?php echo "Rp. " . number_format($d['saldo']); ?></td>
 					</tr>
 				<?php
					}
					?>
 				<tr>
 					<th colspan="4" class="text-right">TOTAL</th>
 					<td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
 				</tr>
 			</tbody>
 		</table>

 		<h5>LAPORAN PENGELUARAN</h5>
 		<!-- PENGELUARAN -->
 		<table border="1" cellspacing="0" width="100%">
 			<thead>
 				<tr>
 					<th width="1%">NO</th>
 					<th>NAMA</th>
 					<th>ANGGARAN</th>
 					<th>REALISASI</th>
 					<th>REALISASI (%)</th>
 					<th>SISA ANGGARAN</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php
					$total_pemasukan1 = 0;
					include '../koneksi.php';
					$no = 1;
					$data = mysqli_query($koneksi, "SELECT * FROM kategori");
					while ($d = mysqli_fetch_array($data)) {
						if ($d['kategori']) {
							$total_pemasukan1 += $d['anggaran'];
							$anggaran_murni = $d['anggaran_murni'];
							$anggaran = $d['anggaran'];
						}
					?>
 					<tr>
 						<td><?php echo $no++; ?></td>
 						<td><?php echo $d['kategori']; ?></td>
 						<td class="text-center"><?php echo "Rp. " . number_format($d['anggaran_murni']); ?></td>
 						<td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']); ?></td>
 						<td class="text-center"><?php echo $realisasi_persen = ($anggaran / $anggaran_murni) * 100; ?>%</td>
 						<td class="text-center"><?php echo "Rp. " . number_format($d['anggaran']); ?></td>
 					</tr>
 				<?php
					}
					?>
 				<tr>
 					<th colspan="5" class="text-right">TOTAL</th>
 					<td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pemasukan1) . " ,-"; ?></td>
 				</tr>
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

 	<?php

		?>


 	<script>
 		window.print();
 		$(document).ready(function() {

 		});
 	</script>

 </body>

 </html>