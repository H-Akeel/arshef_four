-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3305
-- Generation Time: 27 يونيو 2025 الساعة 13:50
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rap_dashboard`
--

-- --------------------------------------------------------

--
-- بنية الجدول `section_numbers`
--

CREATE TABLE `section_numbers` (
  `id` int(11) NOT NULL,
  `deqa_in` int(11) DEFAULT 0,
  `deqa_out` int(11) DEFAULT 0,
  `rabia_in` int(11) DEFAULT 0,
  `rabia_out` int(11) DEFAULT 0,
  `dk_in` int(11) DEFAULT 0,
  `dk_out` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `section_numbers`
--

INSERT INTO `section_numbers` (`id`, `deqa_in`, `deqa_out`, `rabia_in`, `rabia_out`, `dk_in`, `dk_out`) VALUES
(1, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `section_numbers`
--
ALTER TABLE `section_numbers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `section_numbers`
--
ALTER TABLE `section_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
