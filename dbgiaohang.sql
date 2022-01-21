-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 04:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgiaohang`
--

-- --------------------------------------------------------

--
-- Table structure for table `doisoat`
--

CREATE TABLE `doisoat` (
  `mads` int(11) NOT NULL,
  `chutk` varchar(50) NOT NULL,
  `sotk` int(11) NOT NULL,
  `nganhang` varchar(100) NOT NULL,
  `chinhanh` varchar(255) NOT NULL,
  `tienTH` int(11) NOT NULL,
  `phiGH` int(11) NOT NULL,
  `phiHH` int(11) NOT NULL,
  `phiCK` int(11) NOT NULL,
  `sodu` int(11) NOT NULL,
  `makh` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doisoat`
--

INSERT INTO `doisoat` (`mads`, `chutk`, `sotk`, `nganhang`, `chinhanh`, `tienTH`, `phiGH`, `phiHH`, `phiCK`, `sodu`, `makh`, `trangthai`) VALUES
(13, 'Thuan', 123456789, 'Vietcombank', 'VietCombank Phạm Hùng', 0, 0, 0, 5500, -5500, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madh` varchar(10) NOT NULL,
  `tenNN` varchar(50) NOT NULL,
  `sdtNN` char(10) NOT NULL,
  `diachiNN` varchar(255) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `makh` int(11) NOT NULL,
  `mashipper` int(11) DEFAULT NULL,
  `img` varchar(50) NOT NULL,
  `tuychon` varchar(50) NOT NULL,
  `ghichu` varchar(100) DEFAULT NULL,
  `goicuoc` int(11) NOT NULL,
  `tienthuho` int(11) NOT NULL,
  `hinhthuc` varchar(50) NOT NULL,
  `doisoat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madh`, `tenNN`, `sdtNN`, `diachiNN`, `tensp`, `trangthai`, `makh`, `mashipper`, `img`, `tuychon`, `ghichu`, `goicuoc`, `tienthuho`, `hinhthuc`, `doisoat`) VALUES
('dh0', 'Thuan', '0879571874', 'Cao Lỗ', 'Iphone', 0, 1, 6, 'Doraemon_character.png', 'Bên nhận trả phí', NULL, 15000, 250000, 'Lấy hàng tận nơi', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `phi`
--

CREATE TABLE `phi` (
  `ten` varchar(50) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phi`
--

INSERT INTO `phi` (`ten`, `gia`) VALUES
('Giao hàng chuẩn', 30000),
('Giao hàng nhanh', 50000),
('Phí chuyển khoản', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ma` int(11) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `sdt` char(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ma`, `hoten`, `sdt`, `email`, `password`, `diachi`, `role`) VALUES
(1, 'thuy', '0324569874', 'dh51805688@student.stu.edu.vn', '25f9e794323b453885f5181f1b624d0b', '180 Cao Lỗ Phường 4 Quận 8', '1'),
(3, 'Admin', '0856974231', 'thuan18@gmail.com', '25f9e794323b453885f5181f1b624d0b', '152 Châu Thị Hóa P4 Q8', '3'),
(6, 'Shipper', '0856974231', 'thuan1@gmail.com', '25f9e794323b453885f5181f1b624d0b', '152 Châu Thị Hóa P4 Q8', '2'),
(7, 'Phạm Thanh Thuận', '0879571874', 'thanhthuan019@gmail.com', '25f9e794323b453885f5181f1b624d0b', '20 Cao Lỗ', '2'),
(8, 'Phạm Thanh', '0879571874', 'thanhthuan01900@gmail.com', '25f9e794323b453885f5181f1b624d0b', '20 Cao Lỗ', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doisoat`
--
ALTER TABLE `doisoat`
  ADD PRIMARY KEY (`mads`),
  ADD KEY `fk_ck` (`makh`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `makh` (`makh`),
  ADD KEY `fk_shipper` (`mashipper`);

--
-- Indexes for table `phi`
--
ALTER TABLE `phi`
  ADD PRIMARY KEY (`ten`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ma`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doisoat`
--
ALTER TABLE `doisoat`
  MODIFY `mads` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doisoat`
--
ALTER TABLE `doisoat`
  ADD CONSTRAINT `fk_ck` FOREIGN KEY (`makh`) REFERENCES `user` (`ma`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `user` (`ma`),
  ADD CONSTRAINT `fk_shipper` FOREIGN KEY (`mashipper`) REFERENCES `user` (`ma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
