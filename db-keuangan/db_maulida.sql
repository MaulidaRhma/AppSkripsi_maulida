-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2023 pada 05.32
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
(1, 'BRI', 'Tegar Putera', '085347576930', 700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `golongan` varchar(50) NOT NULL,
  `sumberdana` varchar(50) NOT NULL,
  `gaji_pokok` varchar(50) NOT NULL,
  `tunjangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `nama_pegawai`, `nip`, `jabatan`, `golongan`, `sumberdana`, `gaji_pokok`, `tunjangan`) VALUES
(8, 'Gentry Yuliantono, SE', '196607081993031002', 'Kepala Dinas', 'IV/c', 'APBD', '6000000', '10000000'),
(9, 'Vera Siska Wati, A.Md.Pjk', '198502052009012001', 'Bendahara Pengeluaran', 'II/d', 'APBD', '3000000', '4000000'),
(10, 'Danoe Sulaiman, LLASDP.SH', '198011252002121003', 'Kabid Lalin dan Angkutan', 'III/d', 'APBD', '4000000', '5000000'),
(11, 'Tedy Mulyana, ST.MT', '198006172005011007', 'Sekretaris', 'IV/a', 'APBD', '5000000', '8000000'),
(12, 'Harni Rahayu, S.IKom', '198008102008012040', 'Bendahara Penerimaan', 'III/b', 'APBD', '3500000', '5000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `hutang_id` int(11) NOT NULL,
  `hutang_tanggal` date NOT NULL,
  `hutang_nominal` int(11) NOT NULL,
  `hutang_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`hutang_id`, `hutang_tanggal`, `hutang_nominal`, `hutang_keterangan`) VALUES
(1, '2023-07-02', 10000, 'Nukar Pentol'),
(2, '2023-07-03', 20000, 'Behutang');

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
  `nama_pajak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_pajak`
--

INSERT INTO `jenis_pajak` (`id_pajak`, `nama_pajak`) VALUES
(2, 'Kendaraan Roda 2'),
(3, 'Kendaraan Roda 4'),
(4, 'Kendaraan Roda 6/ Bus'),
(6, 'Kendaraan Roda 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(225) NOT NULL,
  `nip` varchar(225) NOT NULL,
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

INSERT INTO `karyawan` (`id_pegawai`, `nama_pegawai`, `nip`, `tempat`, `tanggal_lahir`, `jabatan`, `golongan`, `agama`, `pendidikan`, `telpon`, `alamat`) VALUES
(36, 'Tegar Putera', '196607081993031002', 'Semarang', '1966-07-08', 'Kepala Dinas', 'IV/e', 'Islam', 'S3', '085347576930', 'Jl. Tambun Bungai'),
(37, 'Vera Siska Wati, A.Md.Pjk', '198502052009012001', 'Tanah Laut', '1985-02-05', 'Bendahara Pengeluaran', 'II/d', 'Islam', 'D3', '081245590035', 'Komp. Wengga Pabahanan'),
(38, 'Tedy Mulyana, ST.MT', '198006172005011007', 'Pelaihari', '1980-06-17', 'Sekretaris', 'IV/a', 'Islam', 'S2', '081257584380', 'JL. Teluk Baru Karang Taruna'),
(39, 'Danoe Sulaiman, LLASDP.SH', '198011252002121003', 'Palembang', '1980-11-25', 'Kabid Lalin dan Angkutan', 'III/d', 'Islam', 'S1', '085231428802', 'JL. Empat Lima Sarang Halang'),
(40, 'Harni Rahayu, S.IKom', '198008102008012040', 'Banjarmasin', '1980-08-10', 'Bendahara Penerimaan', 'III/b', 'Islam', 'S1', '082351226072', 'JL. Teluk Baru Karang Taruna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`) VALUES
(1, '01. LAINNYA'),
(2, '02. DIV. INFO & SEKRETARIAT'),
(3, '03. DIV. SAKSI & PENGAMANAN SUARA'),
(4, '04. DIV. SOSIALISASI & KAMPANYE'),
(5, '05. DIV. HUKUM & ADVOKASI'),
(6, '06. DIV. RELAWAN & SOSIAL KEMASYARAKATAN'),
(7, '07. DIV. MEDIA ONLINE & CETAK'),
(8, '08. DIV. KREATIF & IT'),
(9, '09. OPERASIONAL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pajak`
--

CREATE TABLE `pajak` (
  `id_pajak` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_plat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pajak`
--

INSERT INTO `pajak` (`id_pajak`, `nama`, `no_plat`, `tanggal`, `biaya`, `keterangan`) VALUES
(6, 'Gentry Yuliantono, SE', 'DA 293 L', '2023-02-01', '1200000', 'Kendaraan Roda 4'),
(7, 'Abdurrahman Sidik', 'DA 77 L', '2023-02-10', '750000', 'Kendaraan Roda 4'),
(8, 'Riswan Akbar', 'DA 1049 LO', '2023-01-18', '500000', 'Kendaraan Roda 4'),
(9, 'Marlianie', 'DA 2059 LX', '2023-02-09', '75000', 'Kendaraan Roda 2'),
(12, 'Rahmat Hidayat', 'DA 7030 LD', '2023-02-06', '2100000', 'Kendaraan Roda 2');

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
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `piutang_id` int(11) NOT NULL,
  `piutang_tanggal` date NOT NULL,
  `piutang_nominal` int(11) NOT NULL,
  `piutang_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`piutang_id`, `piutang_tanggal`, `piutang_nominal`, `piutang_keterangan`) VALUES
(1, '2019-06-22', 1000000, 'Hutang oleh rahman'),
(3, '2019-06-23', 70000, 'Hutang oleh jony untuk belu pulsa'),
(4, '2023-07-02', 50000, 'beli popice'),
(5, '2023-07-13', 10000, 'sdh dibayar\r\n');

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
(1, '2023-07-02', 'Pemasukan', 9, 50000, 'pemasukan', '1496935873_HASIL-SEMINAR-PROPOSAL-19630357.pdf', 1),
(2, '2023-07-04', 'Pengeluaran', 8, 50000, 'Beli Ayam', '1763197184_5423924fd0f422bced467d848659e638.jpg', 1),
(3, '2023-07-04', 'Pemasukan', 1, 50000, 'Jackpot', '949182574_businesswoman-using-tablet-analysis.jpg', 1);

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
(4, 'tegar', 'tegar', '1d31802d64bae29d88923d795fc73734', '', 'pimpinan');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jenis_pajak`
--
ALTER TABLE `jenis_pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `piutang`
--
ALTER TABLE `piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
