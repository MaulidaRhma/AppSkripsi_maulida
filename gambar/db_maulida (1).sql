-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2023 pada 17.24
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_maulida`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_belanja`
--

CREATE TABLE `akun_belanja` (
  `id_akun` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun_belanja`
--

INSERT INTO `akun_belanja` (`id_akun`, `kode`, `nama`) VALUES
(3, '17710134', 'Barang dan Jasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_nama` varchar(255) NOT NULL,
  `bank_nomor` varchar(255) NOT NULL,
  `bank_pemilik` varchar(255) NOT NULL,
  `bank_saldo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_nama`, `bank_nomor`, `bank_pemilik`, `bank_saldo`) VALUES
(1, 'Bank BPD Kalsel', '0070004005289', 'BENDAHARA PENGELUARAN DINAS PERHUBUNGAN', 126000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `golongan` varchar(50) NOT NULL,
  `gaji_pokok` varchar(50) NOT NULL,
  `gaji_tunjangan` varchar(50) NOT NULL,
  `jumlah_bruto` varchar(100) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `jumlah_netto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `tanggal`, `nama_pegawai`, `nip`, `jabatan`, `golongan`, `gaji_pokok`, `gaji_tunjangan`, `jumlah_bruto`, `potongan`, `jumlah_netto`) VALUES
(18, '2023-07-01', 'Danoe Sulaiman, LLASPD.SH', '198011252002121003', 'Kepala Dinas', 'II/b', '30000000', '20000000', '50000000', '20000000', '30000000'),
(19, '2023-08-01', 'Vera Siska Wati, A.Md.Pjk', '198502052009012001', 'Sekretaris', 'II/b', '30000000', '20000000', '50000000', '200000', '49800000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` int(11) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `gaji_pokok` varchar(100) NOT NULL,
  `gaji_tunjangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `golongan`, `gaji_pokok`, `gaji_tunjangan`) VALUES
(4, 'II/a', '190000', '199999'),
(5, 'II/b', '30000000', '20000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `hutang_id` int(11) NOT NULL,
  `hutang_tanggal` date NOT NULL,
  `hutang_nominal` int(11) NOT NULL,
  `hutang_keterangan` text NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`hutang_id`, `hutang_tanggal`, `hutang_nominal`, `hutang_keterangan`, `nama_pegawai`, `nip`) VALUES
(10, '2023-06-07', 4444, '444', 'Danoe Sulaiman, LLASPD.SH', '198011252002121003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(5, 'Kepala Dinas'),
(6, 'Sekretaris'),
(10, 'Bendahara Pengeluaran'),
(11, 'Bendahara Penerimaan'),
(12, 'Kabid Lalin dan Angkutan'),
(14, 'Kabid Prasarana dan Keselamatan'),
(15, 'Kasi Angkutan'),
(16, 'Kasi Lalu Lintas'),
(17, 'Kasi Sarana dan Prasarana'),
(18, 'Kasi Keselamatan'),
(19, 'Kepala UPT Penguji Kendaraan Bermotor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pajak`
--

CREATE TABLE `jenis_pajak` (
  `id_pajak` int(11) NOT NULL,
  `nama_pajak` varchar(50) NOT NULL,
  `pajak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_pajak`
--

INSERT INTO `jenis_pajak` (`id_pajak`, `nama_pajak`, `pajak`) VALUES
(2, '411124-PPh Pasal 23', ''),
(3, '411211-PPN (Pajak Pertambahan Nilai)', ''),
(4, '411121 PPh Pasal 21', '25'),
(6, '411122-PPh Pasal 22', ''),
(8, '411128-PPh Final', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_retribusi`
--

CREATE TABLE `jenis_retribusi` (
  `id_retribusi` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kode_rekening` varchar(100) NOT NULL,
  `target` varchar(100) NOT NULL,
  `saldo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_retribusi`
--

INSERT INTO `jenis_retribusi` (`id_retribusi`, `jenis`, `kode_rekening`, `target`, `saldo`) VALUES
(3, 'Belanja', '1999181', '1 Tahun', 2600009),
(12, 'Barang dan Jasa', '17710134', '1 Tahun', 3700005),
(14, 'Parkir', '17710134', '30000000', 5000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(225) NOT NULL,
  `nip` varchar(225) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tempat` varchar(225) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(225) NOT NULL,
  `golongan` varchar(225) NOT NULL,
  `agama` varchar(225) NOT NULL,
  `pendidikan` varchar(222) NOT NULL,
  `telpon` varchar(225) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_pegawai`, `nama_pegawai`, `nip`, `nik`, `tempat`, `tanggal_lahir`, `jabatan`, `golongan`, `agama`, `pendidikan`, `telpon`, `alamat`) VALUES
(36, 'Danoe Sulaiman, LLASPD.SH', '198011252002121003', '198011252002121003', 'Palembang', '1980-11-25', 'Kepala Dinas', 'IV/a', 'Islam', 'S1', '085347576930', 'Jl. Empat Lima Sarang Halang'),
(37, 'Vera Siska Wati, A.Md.Pjk', '198502052009012001', '', 'Tanah Laut', '1985-02-05', 'Bendahara Pengeluaran', 'II/d', 'Islam', 'D3', '081245590035', 'Komp. Wengga Pabahanan'),
(38, 'Tedy Mulyana, ST.MT', '198006172005011007', '', 'Pelaihari', '1980-06-17', 'Sekretaris', 'IV/a', 'Islam', 'S2', '081257584380', 'JL. Teluk Baru Karang Taruna'),
(39, 'Andri Triyanto C, LLASDP', '198212132003121004', '', 'Pelaihari', '1982-12-13', 'Kabid Lalin dan Angkutan', 'III/c', 'Islam', 'D3', '081235672309', 'Jl. Soepirrman, Komp. Hamparan'),
(40, 'Harni Rahayu, S.IKom', '198008102008012040', '', 'Banjarmasin', '1980-08-10', 'Bendahara Penerimaan', 'III/b', 'Islam', 'S1', '082351226072', 'JL. Teluk Baru Karang Taruna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `anggaran_murni` varchar(100) NOT NULL,
  `anggaran` int(100) NOT NULL,
  `realisasi_persen` varchar(100) NOT NULL,
  `sisa_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`, `anggaran_murni`, `anggaran`, `realisasi_persen`, `sisa_anggaran`) VALUES
(2, 'Belanja Barang', '2000000', 599995, '', ''),
(22, 'Belanja', '20000000', 17000000, '', ''),
(23, 'Jasa', '1000000', 1000000, '', ''),
(24, 'Barang ', '20000000', 19000000, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pajak`
--

CREATE TABLE `pajak` (
  `id_pajak` int(11) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `billing` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `jpajak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pajak`
--

INSERT INTO `pajak` (`id_pajak`, `uraian`, `billing`, `tanggal`, `jumlah`, `jpajak`) VALUES
(13, 'PPN atas fotocopy dimas utk bulan Januari 2023', '027385446968040', '2023-02-13', '309190', '411211-PPN (Pajak Pertambahan Nilai)'),
(14, 'PPh 22 atas fotocopy dimas utk bulan Januari 2023', '12312', '2023-02-13', '42163', '411122-PPh Pasal 22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat`
--

CREATE TABLE `pangkat` (
  `id_pangkat` varchar(6) NOT NULL,
  `nama_golongan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `nama_golongan`) VALUES
('P001', 'I/a'),
('P002', 'I/b'),
('P004', 'I/d'),
('P005', 'II/a'),
('P006', 'II/b'),
('P007', 'II/c'),
('P008', 'II/d'),
('P009', 'III/a'),
('P010', 'III/b'),
('P011', 'III/c'),
('P012', 'III/d'),
('P013', 'IV/a'),
('P014', 'IV/b'),
('P015', 'IV/c'),
('P016', 'IV/d'),
('P017', 'IV/e'),
('P018', 'Lainya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_bukti` varchar(100) NOT NULL,
  `id_retribusi` int(100) NOT NULL,
  `kode_rekening` varchar(100) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`id_pendapatan`, `tanggal`, `no_bukti`, `id_retribusi`, `kode_rekening`, `uraian`, `jumlah`) VALUES
(62, '2023-07-19', '12312', 12, '17710134', 'Barang ', 700000),
(63, '2023-06-25', '23423', 14, '17710134', 'Barang ', 5000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_bukti` varchar(100) NOT NULL,
  `kategori_id` int(100) NOT NULL,
  `akun_belanja` varchar(100) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `pengeluaran` int(100) NOT NULL,
  `jpajak` text NOT NULL,
  `pajak1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `no_bukti`, `kategori_id`, `akun_belanja`, `uraian`, `pengeluaran`, `jpajak`, `pajak1`) VALUES
(9, '2023-07-20', '23423', 2, 'Barang dan Jasa', 'Barang ', 500000, '411211', ''),
(11, '2023-07-11', '12312', 22, 'Barang dan Jasa', 'Barang ', 2000000, '411128', ''),
(12, '2023-07-18', '23423', 22, 'Barang dan Jasa', 'Barang ', 1000000, '411121', ''),
(13, '2023-06-26', '222', 2, 'Barang dan Jasa', '2', 2, '411124', '25'),
(14, '2023-07-12', '234', 2, 'Barang dan Jasa', '32', 3, '411211', '25'),
(15, '2023-07-18', '17710134', 24, 'Barang dan Jasa', 'bebas', 1000000, '411128', '25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `piutang_id` int(11) NOT NULL,
  `piutang_tanggal` date NOT NULL,
  `piutang_nominal` int(11) NOT NULL,
  `piutang_keterangan` text NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`piutang_id`, `piutang_tanggal`, `piutang_nominal`, `piutang_keterangan`, `nama_pegawai`, `nip`) VALUES
(9, '2023-06-30', 207500, 'Pembayaran JKK PTT bulan Jan 2023 ke Kasubbag Umpeg', 'Tedy Mulyana, ST.MT', '198006172005011007'),
(10, '2023-06-26', 6345000, 'Pembayaran Listrik bulan Jan 2023 ke Kasubbag Umpeg', 'Vera Siska Wati, A.Md.Pjk', '198502052009012001'),
(11, '2023-05-29', 234100, 'Pembayaran JKM PTT bulan Januari 2023 ke Kasubbag Umpeg', 'Danoe Sulaiman, LLASPD.SH', '198011252002121003'),
(12, '2023-04-04', 207500, 'Pembayaran JKK PTT bulan Jan 2023 ke Kasubbag Umpeg', 'Harni Rahayu, S.IKom', '198008102008012040');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `institusi` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kepala` varchar(250) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notelp` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `kepala`, `nip`, `email`, `notelp`, `logo`) VALUES
(1, 'DINAS PERHUBUNGAN KAB. TANAH LAUT', 'PEMERINTAHAN', 'AKTIF', '<p>Jl. A. Syairani, Angsau, Kec. Pelaihari, Kabupaten Tanah Laut, Kalimantan Selatan</p>', 'GENTRY YULIANTONO, SE', '196607081993031002', 'dishub.kab.tala@gmail.com', '(0512) 21035', 'dishub1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_jenis` enum('Pengeluaran','Pemasukan') NOT NULL,
  `transaksi_kategori` int(11) NOT NULL,
  `transaksi_nominal` int(11) NOT NULL,
  `transaksi_keterangan` text NOT NULL,
  `transaksi_foto` varchar(255) NOT NULL,
  `transaksi_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tanggal`, `transaksi_jenis`, `transaksi_kategori`, `transaksi_nominal`, `transaksi_keterangan`, `transaksi_foto`, `transaksi_bank`) VALUES
(8, '2023-01-02', 'Pemasukan', 3, 156750900, 'Pembayaran Gaji PNS bulan Januari 2023', '1387341419_TBP - 15.08_06.0_000336_UP_2.15.0.00.0.00.01.0000_P.03_5_2023 - Kab. Tanah Laut.pdf', 1),
(9, '2023-07-03', 'Pengeluaran', 3, 156750900, 'Pembayaran Gaji PNS bulan Januari 2023', '146085669_TBP - 15.08_06.0_000342_UP_2.15.0.00.0.00.01.0000_P.03_5_2023 - Kab. Tanah Laut.pdf', 1),
(10, '2023-01-16', 'Pemasukan', 21, 202000000, 'Uang Persediaan (UP) TA 2023', '1000506171_TBP - 15.08_06.0_000337_UP_2.15.0.00.0.00.01.0000_P.03_5_2023 - Kab. Tanah Laut.pdf', 1),
(11, '2023-01-20', 'Pengeluaran', 5, 76000000, 'Pembayaran Gaji PTT Tenaga Administrasi bulan Januari 2023', '1657584447_TBP - 15.08_06.0_000341_UP_2.15.0.00.0.00.01.0000_P.03_5_2023 - Kab. Tanah Laut.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'dishub1.png', 'administrator'),
(4, 'Danoe Sulaiman, SH', 'Kadis', 'f984fbd6a856851e26cb3109fba5411f', '', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_belanja`
--
ALTER TABLE `akun_belanja`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indeks untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenis_pajak`
--
ALTER TABLE `jenis_pajak`
  ADD PRIMARY KEY (`id_pajak`);

--
-- Indeks untuk tabel `jenis_retribusi`
--
ALTER TABLE `jenis_retribusi`
  ADD PRIMARY KEY (`id_retribusi`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id_pajak`);

--
-- Indeks untuk tabel `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indeks untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun_belanja`
--
ALTER TABLE `akun_belanja`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jenis_pajak`
--
ALTER TABLE `jenis_pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis_retribusi`
--
ALTER TABLE `jenis_retribusi`
  MODIFY `id_retribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `piutang`
--
ALTER TABLE `piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
