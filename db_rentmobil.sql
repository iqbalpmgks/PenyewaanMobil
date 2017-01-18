-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2017 at 08:46 PM
-- Server version: 5.5.53-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_rentmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_denda`
--

CREATE TABLE IF NOT EXISTS `bukti_denda` (
  `no_bukden` varchar(7) NOT NULL,
  `tgl_bukden` date NOT NULL,
  `no_pengembalian` varchar(7) NOT NULL,
  `jml_denda` int(12) NOT NULL,
  `id_jnsdenda` varchar(4) NOT NULL,
  PRIMARY KEY (`no_bukden`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_mobil`
--

CREATE TABLE IF NOT EXISTS `detail_mobil` (
  `no_spsk` varchar(8) NOT NULL,
  `id_mobil` varchar(6) NOT NULL,
  `harga` int(12) NOT NULL,
  `jasa_supir` varchar(5) NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `no_invoice` varchar(7) NOT NULL,
  `tgl_invoice` date NOT NULL,
  `sisa_bayar` int(12) NOT NULL,
  `no_spsk` varchar(8) NOT NULL,
  PRIMARY KEY (`no_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_denda`
--

CREATE TABLE IF NOT EXISTS `jenis_denda` (
  `id_jnsdenda` varchar(4) NOT NULL,
  `nama_jnsdenda` varchar(50) NOT NULL,
  `nominal` int(12) NOT NULL,
  PRIMARY KEY (`id_jnsdenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_denda`
--

INSERT INTO `jenis_denda` (`id_jnsdenda`, `nama_jnsdenda`, `nominal`) VALUES
('JD01', 'Telat', 25000),
('JD02', 'Telat + Supir', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE IF NOT EXISTS `kwitansi` (
  `no_kwitansi` varchar(7) NOT NULL,
  `tgl_kwitansi` date NOT NULL,
  `no_spsk` varchar(8) NOT NULL,
  PRIMARY KEY (`no_kwitansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE IF NOT EXISTS `mobil` (
  `id_mobil` varchar(4) NOT NULL,
  `merk` varchar(35) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `warna` varchar(15) NOT NULL,
  `thn_buat` varchar(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `no_rangka` varchar(25) NOT NULL,
  `no_mesin` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `merk`, `no_pol`, `warna`, `thn_buat`, `harga`, `no_rangka`, `no_mesin`, `status`) VALUES
('MB01', 'Toyota Grand New Avanza', 'B 6014 NZU', 'Silver', '2016', 350000, 'GCCT-48911791738471831731', '6748193917381931738478133', 'Tersedia'),
('MB02', 'Camry', 'B 1234 SKB', 'Putih', '2015', 325000, 'GTTY-34938192482939500238', '8293000023842837417835855', 'Tersedia'),
('MB03', 'Camry', 'B 3564 SRS', 'Hitam', '2011', 300000, 'FUTO-23758957293927448429', '2909148959599577246728484', 'Tersedia'),
('MB04', 'Toyota Kijang Innova', 'B 4567 NBU', 'Hitam', '2011', 350000, 'EIYU-92385851824014005100', '9994847276635179450002399', 'Tersedia'),
('MB05', 'Toyota Grand Innova', 'B 6895 SKS', 'Hitam', '2015', 400000, 'FKYI-82894588203093894949', '1888840609823668952999595', 'Tersedia'),
('MB06', 'Toyota Agya', 'B 4565 VFT', 'Putih', '2015', 300000, 'FHTK-93499059193917394091', '1939480081839948571734184', 'Tersedia'),
('MB07', 'Toyota Vios', 'B 6784 NUK', 'Hitam', '2010', 300000, 'EKUY-48718934819385948381', '4992947293094905698888877', 'Tersedia'),
('MB08', 'Daihatsu Great New Xenia', 'B 7647 UTY', 'Hitam', '2016', 350000, 'GYTU-18894818317741240712', '0238203572304782357203520', 'Tersedia'),
('MB09', 'Daihatsu All New Xenia', 'B 4567 UTE', 'Hitam', '2015', 325000, 'FKUY-19491284834182424823', '2348239295000923858237277', 'Tersedia'),
('MB10', 'Daihatsu Ayla', 'B 5474 TUR', 'Silver', '2015', 300000, 'FYTI-13898849274985858888', '2392520358258295823833888', 'Tersedia'),
('MB11', 'Suzuki APV Arena', 'B 6578 UIY', 'Silver', '2015', 300000, 'FTRY-82839489479303839383', '9484842994859209284959595', 'Tersedia'),
('MB12', 'Suzuki Ertiga', 'B 6391 OBI', 'Hitam', '2015', 325000, 'FERT-13993371929173938838', '1839381830883847613837838', 'Tersedia'),
('MB13', 'Suzuki Mega Carry (pick Up)', 'B 4563 NKI', 'Hitam', '2012', 250000, 'SYTR-34192419842918248124', '9249179241580660024912484', 'Tersedia'),
('MB14', 'Nissan Grand Livina', 'B 4647 SER', 'Hitam', '2015', 400000, 'FYUR-29935950239529352592', '9230052385028305825820359', 'Tersedia'),
('MB15', 'Nissan X-trail', 'B 4574 STU', 'Hitam', '2005', 400000, 'AURY-23849084939274294848', '2480257237527239477938203', 'Tersedia'),
('MB16', 'Honda Mobilio', 'B 6745 VOL', 'Hitam', '2016', 350000, 'GERU-93003842834802384283', '9238528308028305820850283', 'Tersedia'),
('MB17', 'Honda Jazz RS', 'B 4572 SKD', 'Hitam', '2016', 400000, 'GQIW-34108402840238402384', '0823023840284029340293049', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE IF NOT EXISTS `pengembalian` (
  `no_pengembalian` varchar(7) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `jam_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `telat` int(4) NOT NULL,
  `pemeriksa_masuk` varchar(25) NOT NULL,
  `no_stk` varchar(7) NOT NULL,
  PRIMARY KEY (`no_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE IF NOT EXISTS `penyewa` (
  `id_penyewa` varchar(6) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `no_ktpsim` varchar(16) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `alamat_penyewa` varchar(80) NOT NULL,
  `telp_penyewa` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_penyewa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama_penyewa`, `no_ktpsim`, `jenkel`, `alamat_penyewa`, `telp_penyewa`, `email`) VALUES
('PM0001', 'Bosque', '3671061910950003', 'Laki-laki', 'Jalan H. Bilin', '08979166154', 'bosque@gmail.com'),
('PM0002', 'Maz Al', '3671402204950002', 'Laki-laki', 'Jalan Belandamai', '085710382371', 'al@gmail.com'),
('PM0003', 'Maz El', '3710085764320005', 'Laki-laki', 'Jalan Mawar', '085775227593', 'asd@gmail.com'),
('PM0004', 'Maz Dul', '3673483102960001', 'Laki-laki', 'Jalan Kostrad', '087788799716', 'erpeel@gmail.com'),
('PM0005', 'Maz Bagaz', '3574622703950001', 'Laki-laki', 'Jalan H. Radin', '089535289337', 'bagash@gmail.com'),
('PM0006', 'Maz Ripual', '3462562811930005', 'Laki-laki', 'Jalan Joglo', '081298552426', 'ripual@gmail.com'),
('PM0007', 'Maz Dennysdamn', '3687482512950002', 'Laki-laki', 'Jalan Bintaro', '08567105246', 'dennysdamn@gmail.com'),
('PM0008', 'Budi', '12345', 'Laki-laki', 'Jl. Ciledug', '123123', 'asd@asd'),
('PM0009', 'Luhur', '678890', 'Perempuan', 'Jl. Ciputat', '91228', 'asd@ansd');

-- --------------------------------------------------------

--
-- Table structure for table `periksa_keluar`
--

CREATE TABLE IF NOT EXISTS `periksa_keluar` (
  `no_stk` varchar(7) NOT NULL,
  `id_perkap` varchar(6) NOT NULL,
  `kondisi_keluar` varchar(8) NOT NULL,
  `keterangan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periksa_masuk`
--

CREATE TABLE IF NOT EXISTS `periksa_masuk` (
  `no_pengembalian` varchar(7) NOT NULL,
  `id_perkap` varchar(6) NOT NULL,
  `kondisi_masuk` varchar(15) NOT NULL,
  `keterangan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan`
--

CREATE TABLE IF NOT EXISTS `perlengkapan` (
  `id_perkap` varchar(4) NOT NULL,
  `nama_perkap` varchar(50) NOT NULL,
  PRIMARY KEY (`id_perkap`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perlengkapan`
--

INSERT INTO `perlengkapan` (`id_perkap`, `nama_perkap`) VALUES
('PK01', 'STNK, Plat Nomor'),
('PK02', 'Lighter & Kaca Spion Dalam'),
('PK03', 'Karpet'),
('PK04', 'Tool Set'),
('PK05', 'Kunci Roda / Palang'),
('PK06', 'Dongkrak'),
('PK07', 'Ban Cadangan'),
('PK08', 'Radio Tape'),
('PK09', 'Aksesoris / Lain-lain'),
('PK10', 'Lampu-lampu'),
('PK11', 'Bahan Bakar'),
('PK12', 'Body');

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE IF NOT EXISTS `spk` (
  `no_spk` varchar(7) NOT NULL,
  `tgl_spk` date NOT NULL,
  `no_spsk` varchar(8) NOT NULL,
  `id_supir` varchar(6) NOT NULL,
  `id_mobil` varchar(6) NOT NULL,
  PRIMARY KEY (`no_spk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spsk`
--

CREATE TABLE IF NOT EXISTS `spsk` (
  `no_spsk` varchar(8) NOT NULL,
  `tgl_spsk` date NOT NULL,
  `lama_sewa` int(2) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jam_keluar` time NOT NULL,
  `subtotal` int(12) NOT NULL,
  `jns_bayar` varchar(5) NOT NULL,
  `jml_bayar` int(12) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `jaminan` varchar(30) NOT NULL,
  `id_penyewa` varchar(6) NOT NULL,
  PRIMARY KEY (`no_spsk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` varchar(4) NOT NULL,
  `nama_staff` varchar(50) NOT NULL,
  `alamat_staff` varchar(80) NOT NULL,
  `telp_staff` varchar(12) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id_staff`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `nama_staff`, `alamat_staff`, `telp_staff`, `username`, `password`) VALUES
('ST02', 'Suprihatin', 'Jalan H. Jum', '089638847838', 'suprihatin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stk`
--

CREATE TABLE IF NOT EXISTS `stk` (
  `no_stk` varchar(7) NOT NULL,
  `tgl_stk` date NOT NULL,
  `pemeriksa_keluar` varchar(25) NOT NULL,
  `no_spsk` varchar(8) NOT NULL,
  `id_mobil` varchar(6) NOT NULL,
  PRIMARY KEY (`no_stk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE IF NOT EXISTS `supir` (
  `id_supir` varchar(4) NOT NULL,
  `nama_supir` varchar(50) NOT NULL,
  `alamat_supir` varchar(80) NOT NULL,
  `telp_supir` varchar(12) NOT NULL,
  `tarif` int(12) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama_supir`, `alamat_supir`, `telp_supir`, `tarif`, `status`) VALUES
('SP01', 'Sugeng', 'Jalan H. Kiran', '081538485938', 200000, 'Tersedia'),
('SP02', 'Soleh Hudin', 'Jalan Meruya Ilir', '085773856743', 200000, 'Tersedia'),
('SP03', 'Yatno', 'Jalan H. Jum I', '085783737653', 200000, 'Tersedia'),
('SP04', 'Priyatno', 'Jalan Tanah Seratus', '089974617847', 200000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `temp_kondisi`
--

CREATE TABLE IF NOT EXISTS `temp_kondisi` (
  `id_perkap` varchar(6) NOT NULL,
  `nama_perkap` varchar(50) NOT NULL,
  `kondisi` varchar(8) NOT NULL,
  `keterangan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_spsk`
--

CREATE TABLE IF NOT EXISTS `temp_spsk` (
  `id_mobil` varchar(7) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `warna` varchar(10) NOT NULL,
  `harga` int(12) NOT NULL,
  `jasa_supir` int(12) NOT NULL,
  `total_harga` int(12) NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
