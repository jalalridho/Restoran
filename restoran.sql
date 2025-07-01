-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 04:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addMenu` (IN `id_menu` VARCHAR(9), IN `nama_menu` VARCHAR(15), IN `harga` INT, IN `stok` INT)  BEGIN
	INSERT INTO menu (idmenu,NamaMenu, Harga, stok) VALUES (id_menu, nama_menu, harga, stok);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPelangan` (IN `nama_pelanggan` VARCHAR(30), IN `jenkel` ENUM('Laki-Laki','Perempuan'), IN `nohp` VARCHAR(15), IN `alamat` VARCHAR(100), IN `meja` INT, IN `id_pelanggan` VARCHAR(9))  NO SQL
BEGIN
	INSERT INTO pelanggan (Namapelanggan,JenisKelamin,Nohp,Alamat,meja,idpelanggan) VALUES (nama_pelanggan, jenkel, nohp, alamat, meja, id_pelanggan);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPelanggan` (IN `id_pelanggan` VARCHAR(9), IN `nama_pelanggan` VARCHAR(50), IN `jenkel` ENUM('Laki-Laki','Perempuan'), IN `nohp` VARCHAR(15), IN `alamat` VARCHAR(100), IN `meja` INT, IN `waktu` TIME)  BEGIN
	INSERT INTO pelanggan (idpelanggan, Namapelanggan, Jeniskelamin, Nohp, Alamat, meja, waktudatang) VALUES (id_pelanggan, nama_pelanggan, jenkel, nohp, alamat, meja, waktu);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPesanan` (IN `id_pesanan` VARCHAR(9), IN `id_menu` VARCHAR(9), IN `id_pelanggan` VARCHAR(9), IN `jumlah` INT, IN `id_user` VARCHAR(9))  BEGIN
	INSERT INTO pesanan (idpesanan, idmenu, idpelanggan, Jumlah, iduser, tgl_bayar) VALUES (id_pesanan, id_menu, id_pelanggan, jumlah, id_user, now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addTransaksi` (IN `id_transaksi` VARCHAR(9), IN `id_pesanan` VARCHAR(9), IN `total` INT(11), IN `bayar` INT(11))  BEGIN
	INSERT INTO transaksi (idtransaksi, idpesanan, Total,  Bayar ) VALUES (id_transaksi, id_pesanan, total, bayar);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteMenu` (`id_menu` VARCHAR(9))  BEGIN
	DELETE FROM menu WHERE idmenu = id_menu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePelanggan` (`id_pelanggan` VARCHAR(9))  BEGIN
	DELETE FROM pelanggan WHERE idpelanggan = id_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePesanan` (`id_pesanan` VARCHAR(9))  BEGIN
	DELETE FROM pesanan WHERE idpesanan = id_pesanan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMenu` (`id_menu` VARCHAR(9))  BEGIN
	SELECT * FROM menu WHERE idmenu = id_menu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrder` ()  BEGIN
	SELECT ps.idpesanan, m.NamaMenu, p.Namapelanggan, m.Harga, ps.Jumlah, u.Namauser
    FROM pesanan ps, menu m, pelanggan p, user u
    WHERE ps.idmenu = m.idmenu
    AND ps.idpelanggan = p.idpelanggan
    AND ps.iduser = u.iduser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPelanggan` ()  BEGIN
	SELECT * FROM pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getReport` ()  BEGIN
	SELECT t.idtransaksi, p.Namapelanggan, t.Bayar, ps.tgl_bayar, ps.Jumlah * menu.Harga AS total, t.Bayar - ps.Jumlah * menu.Harga AS kembali
    FROM transaksi t, pelanggan p, pesanan ps, menu
                    WHERE t.idpesanan = ps.idpesanan
                    AND ps.idpelanggan = p.idpelanggan AND ps.idmenu = menu.idmenu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTransaksi` ()  BEGIN
	SELECT ps.idpesanan ,p.namapelanggan,p.meja, p.waktudatang, m.namamenu, m.harga, ps.status, m.Harga * ps.Jumlah as totalHarga FROM pelanggan p, user u, menu m, pesanan ps, transaksi t WHERE t.idpesanan = ps.idpesanan and ps.idmenu = m.idmenu and ps.idpelanggan = p.idpelanggan and ps.iduser = u.iduser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectMenu` ()  BEGIN
	SELECT * FROM menu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectOrder` (IN `id_orderan` VARCHAR(9))  BEGIN
	SELECT ps.idpesanan, m.NamaMenu, m.idmenu , p.idpelanggan , p.Namapelanggan, m.Harga, ps.Jumlah, u.Namauser
    FROM pesanan ps, menu m, pelanggan p, user u
    WHERE ps.idmenu = m.idmenu
    AND ps.idpelanggan = p.idpelanggan
    AND ps.iduser = u.iduser
    AND ps.idpesanan = id_orderan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPelanggan` (IN `id_pelanggan` VARCHAR(9))  BEGIN
	SELECT * FROM pelanggan WHERE idpelanggan = id_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTransaksi` ()  BEGIN
	SELECT ps.idpesanan, p.Namapelanggan, ps.Jumlah * menu.Harga as Total
    FROM pelanggan p, pesanan ps, menu
    WHERE ps.idpelanggan = p.idpelanggan AND ps.idmenu = menu.idmenu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMenu` (IN `id_menu` VARCHAR(9), IN `nama_menu` VARCHAR(15), IN `harga` INT, IN `stok` INT)  BEGIN
	UPDATE menu SET NamaMenu = nama_menu, Harga = harga, stok = stok WHERE idmenu = id_menu;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePelanggan` (`id_pelanggan` VARCHAR(9), `nama_pelanggan` VARCHAR(50), `jeniskelamin` ENUM('Laki-Laki','Perempuan'), `no_hp` VARCHAR(15), `alamat` VARCHAR(100), `meja` INT)  BEGIN
	UPDATE pelanggan SET Namapelanggan = nama_pelanggan, Jeniskelamin = jeniskelamin, Nohp = nohp, Alamat = alamat, meja = meja WHERE idpelanggan = id_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePesanan` (`id_pesanan` VARCHAR(9), `id_menu` VARCHAR(9), `id_pelanggan` VARCHAR(9), `jumlah` INT)  BEGIN
	UPDATE pesanan SET idmenu = id_menu, idpelanggan = id_pelanggan, Jumlah = jumlah
    WHERE idpesanan = id_pesanan;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_harga_menu`
--

CREATE TABLE `log_harga_menu` (
  `id` int(11) NOT NULL,
  `idmenu` varchar(9) NOT NULL,
  `hargalama` int(5) NOT NULL,
  `hargabaru` int(5) NOT NULL,
  `waktuperubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_harga_menu`
--

INSERT INTO `log_harga_menu` (`id`, `idmenu`, `hargalama`, `hargabaru`, `waktuperubahan`) VALUES
(8, 'M002', 50000, 50000, '2022-03-02'),
(9, 'M001', 55000, 50000, '2022-03-02'),
(10, 'M002', 50000, 65000, '2022-03-02'),
(11, 'M003', 50000, 50000, '2022-03-02'),
(12, 'M001', 50000, 50000, '2022-03-02'),
(13, 'M003', 50000, 50000, '2022-03-02'),
(14, 'M004', 45000, 45000, '2022-03-02'),
(15, 'M005', 30000, 30000, '2022-03-02'),
(16, 'M003', 50000, 50000, '2022-03-02'),
(17, 'M003', 50000, 50000, '2022-03-02'),
(18, 'M005', 55000, 55000, '2022-03-02'),
(19, 'M006', 50000, 50000, '2022-03-02'),
(20, 'M005', 55000, 55000, '2022-03-02'),
(21, 'M006', 20000, 20000, '2022-03-04'),
(22, 'M006', 20000, 20000, '2022-03-04'),
(23, 'M006', 20000, 20000, '2022-03-04'),
(24, 'M007', 7000, 7000, '2022-03-04'),
(25, 'M005', 55000, 55000, '2022-03-04'),
(26, 'M003', 50000, 50000, '2022-03-04'),
(27, 'M003', 50000, 50000, '2022-03-04'),
(28, 'M003', 50000, 50000, '2022-03-04'),
(29, 'M001', 50000, 50000, '2022-03-04'),
(30, 'M003', 50000, 50000, '2022-03-04'),
(31, 'M003', 50000, 50000, '2022-03-04'),
(32, 'M002', 30000, 30000, '2022-03-04'),
(33, 'M002', 30000, 30000, '2022-03-04'),
(34, 'M007', 45000, 45000, '2022-03-04'),
(35, 'M004', 45000, 45000, '2022-03-04'),
(36, 'M004', 45000, 45000, '2022-03-04'),
(37, 'M004', 45000, 45000, '2022-03-04'),
(38, 'M008', 5000, 5000, '2022-03-04'),
(39, 'M007', 5000, 5000, '2022-03-04'),
(40, 'M006', 20000, 20000, '2022-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` varchar(9) NOT NULL,
  `NamaMenu` varchar(15) NOT NULL,
  `Harga` int(11) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `NamaMenu`, `Harga`, `stok`) VALUES
('M001', 'Barbeque Lemon', 50000, 22),
('M002', 'Mie Cakalang', 30000, 28),
('M003', 'Udon Katsu', 50000, 6),
('M004', 'Ramen Kenzu', 45000, 60),
('M005', 'Chicken Katsu', 55000, 62),
('M006', 'Mie', 20000, 5),
('M007', 'Cilok', 5000, 15);

--
-- Triggers `menu`
--
DELIMITER $$
CREATE TRIGGER `insertlog` BEFORE UPDATE ON `menu` FOR EACH ROW BEGIN
		INSERT INTO log_harga_menu
		SET id = null,
        idmenu = new.idmenu,
		hargabaru = new.harga,
		hargalama = old.harga,
		waktuPerubahan = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` varchar(9) NOT NULL,
  `Namapelanggan` varchar(50) NOT NULL,
  `Jeniskelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `Nohp` varchar(15) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `meja` int(11) NOT NULL,
  `waktudatang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `Namapelanggan`, `Jeniskelamin`, `Nohp`, `Alamat`, `meja`, `waktudatang`) VALUES
('P001', 'Rolex Franki', 'Laki-Laki', '089688567567', 'Jl Asin No 03', 0, '08:44:45'),
('P002', 'Louis Carrie', 'Perempuan', '089688567567', 'jl hitam ', 0, '10:05:44'),
('P003', 'Sierra louis', 'Perempuan', '08938454', 'Jl kembang', 0, '10:06:55'),
('P004', 'Borish Jackson', 'Laki-Laki', '0892635', 'Jl Manual 4', 8, '10:08:29'),
('P005', 'Bu entiin', 'Perempuan', '089688567567', 'jl bahagia', 5, '14:05:43'),
('P006', 'Alek', 'Laki-Laki', '083269083', 'Jl Hitam 3', 4, '06:04:51'),
('P007', 'Georgi Simon', 'Laki-Laki', '087463543', 'Jl Kacang no 3', 0, '08:36:59'),
('P008', 'Frans Sanjaya', 'Laki-Laki', '0837265', 'Jl Putih', 0, '10:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` varchar(9) NOT NULL,
  `idmenu` varchar(9) NOT NULL,
  `idpelanggan` varchar(9) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `status` enum('paid','unpaid','','') NOT NULL DEFAULT 'unpaid',
  `tgl_bayar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idmenu`, `idpelanggan`, `Jumlah`, `iduser`, `status`, `tgl_bayar`) VALUES
('PS001', 'M001', 'P001', 4, 2, 'paid', '09:16:42'),
('PS002', 'M003', 'P002', 4, 1, 'paid', '01:24:53'),
('PS003', 'M003', 'P003', 2, 1, 'unpaid', '07:17:15'),
('PS004', 'M004', 'P007', 4, 1, 'paid', '10:41:21'),
('PS005', 'M007', 'P008', 5, 1, 'paid', '10:41:06');

--
-- Triggers `pesanan`
--
DELIMITER $$
CREATE TRIGGER `log_stok_menu` BEFORE INSERT ON `pesanan` FOR EACH ROW BEGIN
	UPDATE menu SET stok = stok - new.jumlah WHERE idmenu = new.idmenu;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` varchar(9) NOT NULL,
  `idpesanan` varchar(9) NOT NULL,
  `Total` int(11) NOT NULL,
  `Bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpesanan`, `Total`, `Bayar`) VALUES
('TR001', 'PS001', 200000, 250000),
('TR002', 'PS002', 200000, 250000),
('TR003', 'PS003', 100000, 150000),
('TR004', 'PS004', 180000, 200000),
('TR005', 'PS005', 25000, 30000),
('TR006', 'PS004', 180000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `Namauser` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('admin','waiter','owner','kasir') NOT NULL DEFAULT 'waiter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `Namauser`, `username`, `password`, `level`) VALUES
(1, 'Albert Belerick', 'albert', 'albert01', 'waiter'),
(2, 'Sakayanagi', 'saka', 'saka02', 'admin'),
(3, 'Ayakonoji Kimisaki', 'ayako', 'ayako03', 'kasir'),
(4, 'Horikita Miyamizu', 'horikita', 'horikita04', 'owner'),
(10, 'Valencia Rose', 'valenc', 'valval', 'admin'),
(11, 'hanif', 'hanif', 'haha', 'kasir'),
(12, 'Roscho Frans', 'rosco', 'rosco02', 'admin'),
(13, 'Benard', 'bernard', 'Bernard02', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_harga_menu`
--
ALTER TABLE `log_harga_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idpelanggan` (`idpelanggan`),
  ADD KEY `idmenu` (`idmenu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idpesanan` (`idpesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_harga_menu`
--
ALTER TABLE `log_harga_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
