-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2020 at 02:54 AM
-- Server version: 10.2.26-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpnseda_tauruskomputer`
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

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_produk`, `id_session`, `jumlah`, `tgl`, `jam`, `stok_temp`, `price`) VALUES
(80, 4, 'md6inkviq2keqlqgb61ik4df92', 1, '2020-01-23', '12:16:38', 15, 3999999);

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
  `alamat_member` text DEFAULT NULL,
  `tgl_daftar` date NOT NULL,
  `session` varchar(32) DEFAULT NULL,
  `status` enum('aktif','tertunda') DEFAULT NULL,
  `provinsi` int(4) DEFAULT NULL,
  `kota` int(4) DEFAULT NULL,
  `kode_pos` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `email`, `password`, `nama`, `no_telp`, `alamat_member`, `tgl_daftar`, `session`, `status`, `provinsi`, `kota`, `kode_pos`) VALUES
(27, 'membertauruskomputer1@gmail.com', 'd6987aae2794fec73b2eff72109b8ed6', 'member satu', '081234567895', 'Baciro, Gondokusuman, Yogyakarta City', '2020-01-18', '0c08a45be57cbff408f3e5fdb25ded54', 'aktif', 9, 78, '16911'),
(30, 'nonitomagola@gmail.com', 'aeec44b57c4280f2079c3a0ad3b08824', 'noni', '08994155416', 'Dusun Amparsaga 1 km 6 rt 001 rw 002 desa amboyo inti kec. ngabang', '2020-01-18', '6883d95f5abac5f43452ef8f1d2361e9', 'aktif', 12, 228, '78319'),
(31, 'Liaramadhani.1011@gmail.com', 'aad06d2cb62d76ac314387acc0f22462', 'Lia', '082328523348', 'Kedungwaru kidul Rt 001 Rw 005, Kec. Karanganyar', '2020-01-23', '1e7c23794afee538d9da5b6bf36027a9', 'aktif', 10, 113, '59519');

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
(2, 'TOSHIBA'),
(3, 'HP');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_member` int(5) NOT NULL,
  `external_id` text COLLATE latin1_general_ci DEFAULT NULL,
  `invoice_url` text COLLATE latin1_general_ci DEFAULT NULL,
  `kode` int(5) NOT NULL,
  `total` double NOT NULL,
  `grandtotal` double NOT NULL,
  `ongkir` double NOT NULL,
  `alamat_pengiriman` text COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `kurir` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `no_resi` varchar(64) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `id_member`, `external_id`, `invoice_url`, `kode`, `total`, `grandtotal`, `ongkir`, `alamat_pengiriman`, `status`, `tanggal`, `jam`, `kurir`, `status_order`, `no_resi`) VALUES
('ONQ3PH', 30, '5e22c586ec17a6231c0105c2', 'https://invoice-staging.xendit.co/web/invoices/5e22c586ec17a6231c0105c2', 443, 11999999, 12335442, 335000, '\n								<b>noni</b><br>\n								08994155416 (nonitomagola@gmail.com)<br>\n								Dusun Amparsaga 1 km 6 rt 001 rw 002 desa amboyo inti kec. ngabang, Kabupaten Landak, Kalimantan Barat 78319\n							', 'PAID', '2020-01-18', '15:45:21', 'TIKI REG Rp. 335.000 (3 HARI)', NULL, NULL),
('H5H2SK', 30, '5e29215df8a4d24146f56c0f', 'https://invoice-staging.xendit.co/web/invoices/5e29215df8a4d24146f56c0f', 762, 6000000, 6094762, 94000, '\n								<b>noni</b><br>\n								08994155416 (nonitomagola@gmail.com)<br>\n								Dusun Amparsaga 1 km 6 rt 001 rw 002 desa amboyo inti kec. ngabang, Kabupaten Landak, Kalimantan Barat 78319\n							', 'PAID', '2020-01-23', '11:30:56', 'JNE REG Rp. 94.000 (3-5 HARI)', 'selesai', ''),
('Z3I77S', 27, '5e21ed63ec17a6231c00fcf3', 'https://invoice-staging.xendit.co/web/invoices/5e21ed63ec17a6231c00fcf3', 692, 6999999, 7051691, 51000, '\n								<b>member satu</b><br>\n								081234567895 (membertauruskomputer1@gmail.com)<br>\n								bogor, Kabupaten Bogor, Jawa Barat 16911\n							', 'PAID', '2020-01-18', '00:23:09', 'JNE REG Rp. 51.000 (2-3 HARI)', 'selesai', 'CGK2H03789568816'),
('WOHTGG', 27, '5e21ee90ec17a6231c00fcff', 'https://invoice-staging.xendit.co/web/invoices/5e21ee90ec17a6231c00fcff', 131, 6000000, 6028131, 28000, '\n								<b>member satu</b><br>\n								081234567895 (membertauruskomputer1@gmail.com)<br>\n								bogor, Kabupaten Bogor, Jawa Barat 16911\n							', 'EXPIRED', '2020-01-18', '00:28:10', 'JNE OKE Rp. 28.000 (4-5 HARI)', 'dibatalkan', NULL),
('47HMM3', 30, '5e25caf8ec17a6231c012633', 'https://invoice-staging.xendit.co/web/invoices/5e25caf8ec17a6231c012633', 321, 3999999, 4201320, 201000, '\n								<b>noni</b><br>\n								08994155416 (nonitomagola@gmail.com)<br>\n								Dusun Amparsaga 1 km 6 rt 001 rw 002 desa amboyo inti kec. ngabang, Kabupaten Landak, Kalimantan Barat 78319\n							', 'EXPIRED', '2020-01-20', '22:45:27', 'TIKI REG Rp. 201.000 (3 HARI)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_order_dertail` int(11) NOT NULL,
  `id_orders` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE latin1_general_ci DEFAULT NULL,
  `nama_merk` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `berat` int(5) DEFAULT NULL,
  `kondisi` enum('Baru','Pernah Dipakai') COLLATE latin1_general_ci DEFAULT NULL,
  `warna` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ukuran` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_order_dertail`, `id_orders`, `id_produk`, `nama_produk`, `deskripsi`, `nama_merk`, `harga`, `berat`, `kondisi`, `warna`, `ukuran`, `jumlah`) VALUES
(10, 'H5H2SK', 2, 'ASUS', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 'ASUS', 6000000, 2000, 'Baru', '', '', 1),
(7, 'ONQ3PH', 3, 'HP Notebook 14-CK0004TX', 'Sepsifikasi : <br><br>&nbsp; &nbsp; IntelÂ® Coreâ„¢ i3-7020U Processor (2.3 GHz, 3 MB cache, 2 cores)<br>&nbsp; &nbsp; Windows 10 Home Single Language 64<br>&nbsp; &nbsp; 4 GB DDR4-2133 SDRAM (1 x 4 GB)<br>&nbsp; &nbsp; 1 TB 5400 rpm SATA<br>&nbsp; &nbsp; AMD Radeonâ„¢ 520 Graphics (2 GB GDDR5 dedicated)<br>&nbsp; &nbsp; Starting at 1.47 kg<br>&nbsp; &nbsp; 14\" diagonal HD SVA BrightView WLED-backlit (1366 x 768)<br>&nbsp; &nbsp; 1 year limited parts and labour', 'HP', 6999999, 3000, 'Baru', '', '', 1),
(8, 'ONQ3PH', 1, 'Toshiba A', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 'TOSHIBA', 5000000, 2000, 'Baru', '', '', 1),
(4, 'Z3I77S', 3, 'HP Notebook 14-CK0004TX', 'Sepsifikasi : <br><br>&nbsp; &nbsp; IntelÂ® Coreâ„¢ i3-7020U Processor (2.3 GHz, 3 MB cache, 2 cores)<br>&nbsp; &nbsp; Windows 10 Home Single Language 64<br>&nbsp; &nbsp; 4 GB DDR4-2133 SDRAM (1 x 4 GB)<br>&nbsp; &nbsp; 1 TB 5400 rpm SATA<br>&nbsp; &nbsp; AMD Radeonâ„¢ 520 Graphics (2 GB GDDR5 dedicated)<br>&nbsp; &nbsp; Starting at 1.47 kg<br>&nbsp; &nbsp; 14\" diagonal HD SVA BrightView WLED-backlit (1366 x 768)<br>&nbsp; &nbsp; 1 year limited parts and labour', 'HP', 6999999, 3000, 'Baru', '', '', 1),
(5, 'WOHTGG', 2, 'ASUS', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 'ASUS', 6000000, 2000, 'Baru', '', '', 1),
(9, '47HMM3', 4, 'ASUS A407MA', '<p>\r\n\r\nSpesifikasi :<br>- Processor : Intel Celeron N4000 Dual core<br>- Sistem Operasi: Windows 10 Home<br>- Chipset : Integrated Intel CPU<br>- Memori : 4GB DDR4L<br>- Display : 14.0\" (16:9) LED backlit HD (1366x768) Glare 60Hz Panel with 45% NTSC<br>- Support ASUS Splendid Technology<br>- Storage Hard Drives : 1TB 5400RPM SATA HDD<br>- No DVD RW<br>- Keyboard : Chiclet keyboard<br>- Card Reader : Multi-format card reader<br>- WebCam : VGA Web Camera<br>- Networking : Wi-Fi Integrated 802.11b/g/n<br>- Bluetooth : Built-in Bluetooth V4.0<br>- Audio : ASUS SonicMaster Technology<br>- Baterai : 3 Cells 36 Whrs Battery:\r\n<br></p>', 'ASUS', 3999999, 3000, 'Baru', '', '', 1);

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
  `berat` int(5) UNSIGNED DEFAULT NULL,
  `stok` int(5) NOT NULL,
  `kondisi` enum('Baru','Pernah Dipakai') COLLATE latin1_general_ci DEFAULT NULL,
  `warna` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ukuran` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_merk`, `nama_produk`, `deskripsi`, `harga`, `berat`, `stok`, `kondisi`, `warna`, `ukuran`, `gambar`) VALUES
(1, 2, 'Toshiba A', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 5000000, 2000, 12, 'Baru', '', '', '271.jpg'),
(2, 1, 'ASUS', '<p>Laptop dengan merek Acer Tipe E5 - 473G, Lalu prosesor yang digunakan merupakan produk besutan Intel dengan Intel Core i5 5200U. Untuk dapat melihat besaran kecepatan CPU Anda dapat menggunakan google dengan keyword Intel Core i5 5200U passmark. Laptop ini memiliki layar LCD berukuran diagonal 14 inci dengan teknologi LED yang kita ketahui memiliki tampilan gambar yang tidak akan pecah.</p><p>Kemudian, kapasitas RAM yang diusung laptop ini sebesar 4 <em>giga byte</em>&nbsp;dengan jenis RAM DDR3, dan kapasitas harddisk sebesar 500 <em>giga byte </em>dengan interface transfer data menggunakan kabel SATA, yaitu interface yang memiliki kecepatan transfer tertinggi saat ini setelah ATA.</p><p>Untuk komponen pheriperal lain yang ada pada produk ini adalah WI-FI, kamera, DVD RW dan Card Reader yang kompatibel dengan LAN dan menyediakan port USB.</p>', 6000000, 2000, 8, 'Baru', '', '', '404.jpg'),
(3, 3, 'HP Notebook 14-CK0004TX', 'Sepsifikasi : <br><br>&nbsp; &nbsp; IntelÂ® Coreâ„¢ i3-7020U Processor (2.3 GHz, 3 MB cache, 2 cores)<br>&nbsp; &nbsp; Windows 10 Home Single Language 64<br>&nbsp; &nbsp; 4 GB DDR4-2133 SDRAM (1 x 4 GB)<br>&nbsp; &nbsp; 1 TB 5400 rpm SATA<br>&nbsp; &nbsp; AMD Radeonâ„¢ 520 Graphics (2 GB GDDR5 dedicated)<br>&nbsp; &nbsp; Starting at 1.47 kg<br>&nbsp; &nbsp; 14\" diagonal HD SVA BrightView WLED-backlit (1366 x 768)<br>&nbsp; &nbsp; 1 year limited parts and labour', 6999999, 3000, 12, 'Baru', '', '', '25HP1.jpeg'),
(4, 1, 'ASUS A407MA', '<p>\r\n\r\nSpesifikasi :<br>- Processor : Intel Celeron N4000 Dual core<br>- Sistem Operasi: Windows 10 Home<br>- Chipset : Integrated Intel CPU<br>- Memori : 4GB DDR4L<br>- Display : 14.0\" (16:9) LED backlit HD (1366x768) Glare 60Hz Panel with 45% NTSC<br>- Support ASUS Splendid Technology<br>- Storage Hard Drives : 1TB 5400RPM SATA HDD<br>- No DVD RW<br>- Keyboard : Chiclet keyboard<br>- Card Reader : Multi-format card reader<br>- WebCam : VGA Web Camera<br>- Networking : Wi-Fi Integrated 802.11b/g/n<br>- Bluetooth : Built-in Bluetooth V4.0<br>- Audio : ASUS SonicMaster Technology<br>- Baterai : 3 Cells 36 Whrs Battery:\r\n<br></p>', 3999999, 3000, 15, 'Baru', '', '', '78ASUS1.jpeg'),
(5, 1, 'ASUS ROG GL503GE', '<p>Spesifikasi : <br>- Processor : Intel Core i7 - 8750H 2.2 GHz (9M Cache, up to 4.1 GHz)<br>- Memory : 8GB DDR4 2666MHz<br>- Storage : 128GB PCIe SSD + 1TB SSHD<br>- Graphics : Nvidia GeForce GTX 1050Ti 4GB GDDR5<br>- Display : 15.6-inch Full HD (1920x1080) TN panel, 120Hz, 3ms, 94% NTSC<br>- Optical Drive : -<br>- Operating System : Windows 10<br>- Keyboard : Illuminated Chiclet Keyboard<br>- Networking : Integrated 802.11 AC (2x2)<br>- 10/100/1000 Base T<br>- Built-in Bluetooth V4.1<br>- Audio : Built-in Stereo 3.5 W Speakers And Microphone<br>- ASUS Sonic Studio<br>- Support Windows 10 Cortana with Voice<br>- Battery : 4 Cells 48 Whrs<br>- Camera : HD Web Camera<br>- Slots/Interface :<br>1 x mini Display Port<br>1 x RJ45 LAN Jack for LAN insert<br>1 x Type C USB3.0 (USB3.1 GEN1)<br>1 x COMBO audio jack<br>4 x USB 3.0 port(s) Type A<br>1 x HDMI<br>- Power: 150W<br>- System Dimensions : 38.4 x 26.2 x 2.3 cm (WxDxH)<br>- Weight : 2.5 kg with Battery<br>- Garansi Resmi Asus 2 Tahun<br>- Bonus : Backpack ROG<br><br>Special Features:<br>- New Design with Dual Fan Cooling System<br>- NVIDIA GeForce GTX 1050 (factory-overclocked by 100MHz)<br>- IPS-level panel, 120Hz, 72% NTSC<br>- Marked QWER keys<br>- 1.8mm travel distance with 0.25mm keycap curve<br>- Hot keys: Volume up / Volume down / Mute / ROG Gaming Center<br></p>', 16999999, 4000, 15, 'Baru', 'Hitam', '15.6 Inch', '48ASUS2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id_servis` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_member` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(15) DEFAULT NULL,
  `keterangan` varchar(50) NOT NULL,
  `biaya_servis` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id_servis`, `id_member`, `tanggal`, `status`, `keterangan`, `biaya_servis`) VALUES
('SRV001', 27, '2020-01-24', NULL, 'Blu Screen', 50000),
('SRV002', 30, '2020-01-25', NULL, 'LCD Mati', NULL);

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
(1, 'Memori Vgen 4GB', 250000, 46),
(2, 'RAM DDR4 V-GeN TSUNAMI', 799999, 28);

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
(4, 'karyawan', '9e014682c94e0f2cc834bf7348bda428', 'Hesti Gemblung', 'karyawan@gmail.com', '087765544352', 'karyawan'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Drajat Wibowo', 'Tauruskomputer04@gmail.com', '089673770004', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `xendit`
--

CREATE TABLE `xendit` (
  `id` int(11) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `xendit`
--

INSERT INTO `xendit` (`id`, `keterangan`) VALUES
(5, '{\"id\":\"579c8d61f23fa4ca35e52da4\",\"external_id\":\"invoice_123124123\",\"user_id\":\"5781d19b2e2385880609791c\",\"is_high\":true,\"payment_method\":\"BANK_TRANSFER\",\"status\":\"PAID\",\"merchant_name\":\"Xendit\",\"amount\":50000,\"paid_amount\":50000,\"bank_code\":\"PERMATA\",\"paid_at\":\"2016-10-12T08:15:03.404Z\",\"payer_email\":\"wildan@xendit.co\",\"description\":\"This is a description\",\"adjusted_received_amount\":47500,\"fees_paid_amount\":0,\"updated\":\"2016-10-10T08:15:03.404Z\",\"created\":\"2016-10-10T08:15:03.404Z\",\"currency\":\"IDR\",\"payment_channel\":\"PERMATA\",\"payment_destination\":\"888888888888\"}'),
(6, ''),
(7, '{'),
(8, '579c8d61f23fa4ca35e52da4'),
(9, '579c8d61f23fa4ca35e52da4');

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
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_order_dertail`);

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
-- Indexes for table `xendit`
--
ALTER TABLE `xendit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_servis`
--
ALTER TABLE `detail_servis`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id_order_dertail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `id_sparepart` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `xendit`
--
ALTER TABLE `xendit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
