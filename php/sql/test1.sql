-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 06:55 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`) VALUES
(4, 'Shawn', 'Kew', 'shawn@gmail.com', '0183729937', 'shawn@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'manager'),
(10, 'Abc', 'Abc', 'abc@gmail.com', '0183729937', 'melaka, Malaysia.', 'e99a18c428cb38d5f260853678922e03', 'seller'),
(11, 'Asd', 'Asd', 'asd@gmail.com', '123123', 'melaka', 'e99a18c428cb38d5f260853678922e03', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`) VALUES
(93, 9, 135, 1, 'Melaka, Malaysia', '01578399283', 'no', '2019-09-23', '2019-09-30'),
(94, 9, 128, 1, 'Melaka, Malaysia', '01578399283', 'no', '2019-09-23', '2019-09-30'),
(95, 29, 127, 1, 'Melaka, malaysia.', '0183729937', 'no', '2019-09-24', '2019-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(500) NOT NULL,
  `price` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `item` varchar(500) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL,
  `path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `description`, `available`, `item`, `pCode`, `picture`, `path`) VALUES
(121, 'video1', '48', 'This is a video.', 2, 'videos', '0001', '1569232312.mp4', ''),
(122, 'Test1', '35', 'this is a video', 1, 'videos', '0002', '1569232349.mp4', ''),
(123, 'Video2', '50', 'this is a video', 3, 'videos', '0003', '1569232371.mp4', ''),
(124, 'Testing', '32', 'this is a video', 1, 'videos', '0004', '1569232430.mp4', ''),
(125, 'Video3', '22', 'This is a video.', 2, 'videos', '0005', '1569232484.mp4', ''),
(126, 'Test2', '30', 'test', 2, 'videos', '0006', '1569232517.mp4', ''),
(127, 'test3', '25', 'testing', 3, 'videos', '0007', '1569232558.mp4', ''),
(128, 'Testing1', '55', 'This is a video.', 1, 'videos', '0008', '1569232688.mp4', ''),
(129, 'Testing3', '40', 'this is a video', 2, 'videos', '0009', '1569232724.mp4', ''),
(130, 'Document', '20', 'This is a doc.', 1, 'documents', '0010', '1569232764.pdf', ''),
(132, 'Document1', '25', 'This is a doc.', 1, 'documents', '0011', '1569232866.pdf', ''),
(133, 'Doc', '37', 'test', 5, 'documents', '0012', '1569232924.pdf', ''),
(134, 'testing4', '75', 'This is a doc.', 3, 'documents', '0013', '1569232969.pdf', ''),
(135, 'Document5', '49', 'This is a doc.', 1, 'documents', '0014', '1569232992.doc', ''),
(136, 'Document2', '65', 'This is a doc.', 1, 'documents', '0015', '1569233077.pdf', ''),
(137, 'Document3', '48', 'This is a doc.', 1, 'documents', '0016', '1569233102.doc', ''),
(138, 'Document4', '53', 'This is a doc.', 1, 'documents', '0017', '1569233132.doc', ''),
(139, 'Testing5', '27', 'test', 1, 'documents', '0017', '1569233205.doc', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`) VALUES
(9, 'Henry', 'Lim', 'user@gmail.com', '01578399283', 'Melaka, Malaysia', 'e99a18c428cb38d5f260853678922e03'),
(24, 'Shen', 'Tan', 'wstan@gmail.com', '0161233457', 'A6006, Lorong Alor Akar 8, 25250 Kuantan, Pahang.', 'e99a18c428cb38d5f260853678922e03'),
(25, 'Shawn', 'Kew', 'shawn@gmail.com', '0183729937', 'No.10, Jalan D3', 'e99a18c428cb38d5f260853678922e03'),
(26, 'Abc', 'Aaa', 'fengshun_kew@hotmail.com', '0183729937', 'No.10, Jalan D3', '96e79218965eb72c92a549dd5a330112'),
(27, 'Alan', 'Bb', 'abc@hotmail.com', '0183729937', 'No.10, Jalan D3', 'e10adc3949ba59abbe56e057f20f883e'),
(28, 'Try', 'Try', 'trytry@gmail.com', '123123123', 'malaysia', 'e99a18c428cb38d5f260853678922e03'),
(29, 'Shun', 'Kew', 'shun@gmail.com', '123123123', 'Melaka, malaysia.', 'e99a18c428cb38d5f260853678922e03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
