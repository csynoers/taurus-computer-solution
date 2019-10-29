-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 12:23 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_noni`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_servis`
--

CREATE TABLE `detail_servis` (
  `id_detail` int(5) NOT NULL,
  `id_servis` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_sparepart` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_servis`
--

INSERT INTO `detail_servis` (`id_detail`, `id_servis`, `id_sparepart`, `jumlah`) VALUES
(2, 'SRV001', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `stok_temp` int(5) NOT NULL,
  `price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(5) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `alamat_member` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `email`, `password`, `nama`, `no_telp`, `alamat_member`, `tgl_daftar`) VALUES
(8, 'fajar@gmail.com', '24bc50d85ad8fa9cda686145cf1f8aca', 'Fajar Nugroho A', '085675847524', 'Jl. Solo Jogja KM 6', '2019-10-16'),
(9, 'retno@gmail.com', 'edd39370424d54db23ccec123f0ce66b', 'Retno Wulandari', '085675847578', 'Jl. Solo Jogja KM 5', '2019-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id_merk` int(5) NOT NULL,
  `nama_merk` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES
(1, 'ASUS'),
(2, 'TOSHIBA');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_member` int(5) NOT NULL,
  `kode` int(5) NOT NULL,
  `total` double NOT NULL,
  `grandtotal` double NOT NULL,
  `ongkir` double NOT NULL,
  `alamat_pengiriman` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `kurir` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `paket` varchar(25) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `id_member`, `kode`, `total`, `grandtotal`, `ongkir`, `alamat_pengiriman`, `status`, `tanggal`, `jam`, `kurir`, `paket`) VALUES
('4BOPE3', 1, 912, 6500000, 6507912, 7000, 'Jl. Solo Jogja KM 5', 'Lunas', '2019-04-11', '04:18:50', 'pos', 'Paket'),
('GXGU8I', 1, 187, 4500000, 4510187, 10000, 'Jl. Solo Jogja KM 5', 'Lunas', '2019-04-11', '05:36:46', 'tiki', 'ONS'),
('6MLROL', 2, 365, 4500000, 4512365, 12000, 'Jl. Solo Jogja KM 5', 'Lunas', '2019-04-11', '09:22:08', 'tiki', 'HDS'),
('OJSISX', 3, 365, 6500770, 6501135, 0, 'gfyfjhfkjfgkugkjgjgkjgkjhklhkljkljh', 'Lunas', '2019-04-27', '18:07:31', 'pos', ''),
('SFYAYH', 4, 529, 10796000, 10796529, 0, 'kebumen', 'Baru', '2019-05-11', '04:13:44', 'tiki', ''),
('O1MPB9', 4, 535, 4499000, 4499535, 0, 'kebumen', 'Baru', '2019-05-13', '15:46:13', 'pos', ''),
('LXYTGJ', 1, 733, 959000, 991733, 32000, 'Jl. Solo Jogja KM 5', 'Baru', '2019-05-24', '07:15:32', 'pos', 'Paket'),
('LFB5YH', 1, 935, 959000, 973935, 14000, 'Jl. Solo Jogja KM 5', 'Baru', '2019-05-24', '08:32:25', 'pos', 'Paket'),
('D3LXNH', 8, 542, 5000000, 5014542, 14000, 'Jl. Solo Jogja KM 5', 'Baru', '2019-10-17', '14:24:17', 'tiki', 'ECO');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`) VALUES
('4BOPE3', 2, 1),
('GXGU8I', 1, 1),
('6MLROL', 1, 1),
('OJSISX', 3, 2),
('OJSISX', 2, 1),
('SFYAYH', 7, 1),
('SFYAYH', 8, 3),
('O1MPB9', 6, 1),
('LXYTGJ', 9, 1),
('LFB5YH', 9, 1),
('D3LXNH', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `id_merk` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `berat` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `stok` int(5) NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_merk`, `nama_produk`, `deskripsi`, `harga`, `berat`, `stok`, `gambar`) VALUES
(1, 2, 'Toshiba A', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 5000000, '2.00', 14, '271.jpg'),
(2, 1, 'ASUS', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 6000000, '2.00', 10, '404.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id_servis` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_member` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id_servis`, `id_member`, `tanggal`, `status`, `keterangan`) VALUES
('SRV001', 8, '2019-10-16', '', 'Servis Laptop TOshiba A');

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `id_sparepart` int(5) NOT NULL,
  `nama_sparepart` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`id_sparepart`, `nama_sparepart`, `harga`, `stok`) VALUES
(1, 'Memori Vgen 4GB', 250000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(15) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Agus Riyanto', 'kartini@gmail.com', '08238923848', 'admin'),
(3, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'Maharani A', 'admin2@gmail.com', '08578654344', 'admin'),
(4, 'karyawan', '9e014682c94e0f2cc834bf7348bda428', 'Hesti Gemblung', 'karyawan@gmail.com', '087765544352', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_servis`
--
ALTER TABLE `detail_servis`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id_servis`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_servis`
--
ALTER TABLE `detail_servis`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `id_sparepart` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
