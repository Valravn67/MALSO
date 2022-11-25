-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 07:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(15) NOT NULL,
  `JUMLAH_STOK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `NAMA_BARANG`, `JUMLAH_STOK`) VALUES
(1, 'ilsintech', 200);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `ID_BARANG_KELUAR` int(11) NOT NULL,
  `NAMA_BARANG` varchar(15) NOT NULL,
  `JUMLAH_KELUAR` int(11) NOT NULL,
  `TANGGAL_KELUAR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `ID_BARANG_MASUK` int(11) NOT NULL,
  `NAMA_BARANG` varchar(15) NOT NULL,
  `JUMLAH_MASUK` int(11) NOT NULL,
  `TANGGAL_MASUK` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `ID_PEMASUKAN` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `ID_BARANG_MASUK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `ID_PENGELUARAN` int(11) NOT NULL,
  `ID_BARANG_KELUAR` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(10) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `token` varchar(100) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `token`, `created_at`) VALUES
('mal12345', '25d55ad283aa400af464c76d713c07ad', '1fc9ef943474bd68aaf096dffeb43ac5', '2022-11-24 15:23:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`ID_BARANG_KELUAR`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`ID_BARANG_MASUK`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`ID_PEMASUKAN`),
  ADD KEY `FK_PEMASUKA_PEMASUKAN_BARANG` (`ID_BARANG`),
  ADD KEY `FK_PEMASUKA_PEMASUKAN_BARANG_M` (`ID_BARANG_MASUK`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`ID_PENGELUARAN`),
  ADD KEY `FK_PENGELUA_PENGELUAR_BARANG_K` (`ID_BARANG_KELUAR`),
  ADD KEY `FK_PENGELUA_PENGELUAR_BARANG` (`ID_BARANG`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `ID_PEMASUKAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `ID_PENGELUARAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `FK_PEMASUKA_PEMASUKAN_BARANG` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_PEMASUKA_PEMASUKAN_BARANG_M` FOREIGN KEY (`ID_BARANG_MASUK`) REFERENCES `barang_masuk` (`ID_BARANG_MASUK`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `FK_PENGELUA_PENGELUAR_BARANG` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_PENGELUA_PENGELUAR_BARANG_K` FOREIGN KEY (`ID_BARANG_KELUAR`) REFERENCES `barang_keluar` (`ID_BARANG_KELUAR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
