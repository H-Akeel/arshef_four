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
-- Database: `app_hasa`
--

-- --------------------------------------------------------

--
-- بنية الجدول `app_tp`
--

CREATE TABLE `app_tp` (
  `ID` int(2) NOT NULL,
  `emp_name` varchar(22) DEFAULT NULL,
  `start_date` varchar(9) DEFAULT NULL,
  `depart` varchar(3) DEFAULT NULL,
  `charact` varchar(18) DEFAULT NULL,
  `appo_order` varchar(9) DEFAULT NULL,
  `book_num` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `app_tp`
--

INSERT INTO `app_tp` (`ID`, `emp_name`, `start_date`, `depart`, `charact`, `appo_order`, `book_num`) VALUES
(1, 'احمد قيس يوسف', '8/2/2025', 'هسة', 'دعم فني', '', 0),
(2, 'امال حسن جرو حافظ', '25/2/2025', 'هسة', 'كول سنتر', '', 0),
(3, 'محمد علي حسين', '9/2/2025', 'هسه', 'كول سنتر', '', 0),
(4, 'الحسن عباس علوان', '', 'هسة', 'حماية مواقع وبرامج', 'عقد عمل', 0),
(5, 'علاعلاء عبد المهدي', '', 'هسة', 'مصمم مواقع', 'عقد عمل', 0),
(6, 'عماد حسن طارش', '5/9/2024', 'هسة', 'متابعة قنوات', 'امر اداري', 4),
(7, 'علي مظهر احمد', '', 'هسة', '', '', 0),
(8, 'مرتضى محمد عبد', '13/8/2024', 'هسة', 'مبرمج/مطور', 'امر اداري', 1),
(9, 'طه سعد إبراهيم', '1/8/2024', 'هسة', 'مبرمج/مطور', 'عقد عمل', 0),
(10, 'محمود إبراهيم لطيف', '5/9/2024', 'هسة', 'متابعة قنوات', 'امر اداري', 6),
(11, 'سجاد غالب', '', 'هسة', '', '', 0),
(12, 'مصطفى طالب', '', 'هسة', '', '', 0),
(13, 'بكر عبد المعين إبراهيم', '', 'هسة', '', '', 0),
(14, 'زياد شامل كامل', '', 'هسة', '', '', 0),
(15, 'فاطمة علاء محمد', '', 'هسة', '', '', 0),
(16, 'طيف احسان شاكر', '', 'هسة', '', '', 0),
(17, 'محمد الشمري', '', 'هسة', '', '', 0),
(18, 'علي سباهي', '', 'هسة', '', '', 0),
(19, 'رقية ضياء', '', 'هسة', '', '', 0),
(20, 'نورهان حسين', '', 'هسة', '', '', 0),
(21, 'هديل طالب', '', 'هسة', '', '', 0),
(22, 'قصي ستار', '', 'هسة', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_tp`
--
ALTER TABLE `app_tp`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_tp`
--
ALTER TABLE `app_tp`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
