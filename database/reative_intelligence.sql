-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3305
-- Generation Time: 27 يونيو 2025 الساعة 13:51
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
-- Database: `reative_intelligence`
--

-- --------------------------------------------------------

--
-- بنية الجدول `intelligene_tp`
--

CREATE TABLE `intelligene_tp` (
  `ID` int(11) NOT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `book_date` varchar(255) DEFAULT NULL,
  `book_number` varchar(255) DEFAULT NULL,
  `book_subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `intelligene_tp`
--

INSERT INTO `intelligene_tp` (`ID`, `book_title`, `book_date`, `book_number`, `book_subject`) VALUES
(1, 'شركة زين العراق', '2/23/2025', '12', 'تفعيل الرقم المختصر (7998)'),
(2, 'شركة اسيا سيل', '2/24/2025', '11', 'تفعيل الرقم المختصر (7988)'),
(3, 'شركة اسيا سيل', '3/13/2025', '15', 'تفعيل خدمات sip trunk'),
(4, 'سركة اسيا سيل', '3/13/2025', '14', 'تفعيل خدمات شركة اسيا سيل'),
(5, 'تعيين احمد قيس يوسف', '', '15', ''),
(6, 'تعيين محمد علي حسين', '', '16', ''),
(7, 'تعيين امال حسن جرو', '', '17', ''),
(8, 'الى السادة في هيئة الاعلام والاتصالات', '', '69', 'طلب تخصيص   iq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intelligene_tp`
--
ALTER TABLE `intelligene_tp`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `intelligene_tp`
--
ALTER TABLE `intelligene_tp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
